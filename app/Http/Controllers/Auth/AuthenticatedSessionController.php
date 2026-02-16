<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\VerificationCodeMail;
use App\Models\EmailVerificationCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Record login activity
        $user->update([
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        // Check if email is verified
        if (!$user->email_verified_at) {
            // Send a new verification code
            $code = EmailVerificationCode::generateFor($user->email);
            \App\Services\ResendMailService::sendVerificationCode($user->email, $code->code, $user->name);
            return redirect()->route('verify-code');
        }

        // Check if PIN is set up
        if (!$user->pin) {
            return redirect()->route('create-pin');
        }

        // Check if PIN was provided (for users with PIN set)
        if (!$request->has('pin') || !$request->pin) {
            // Need to show PIN entry — store a flag in session
            $request->session()->put('needs_pin', true);
            return redirect()->route('enter-pin');
        }

        // Verify PIN
        if (!Hash::check($request->pin, $user->pin)) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['pin' => 'Invalid PIN.']);
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Show the PIN entry form.
     */
    public function showEnterPin(): View|RedirectResponse
    {
        if (!session('needs_pin') && !Auth::check()) {
            return redirect()->route('login');
        }

        return view('auth.enter-pin');
    }

    /**
     * Verify the PIN entry.
     */
    public function verifyPin(Request $request): RedirectResponse
    {
        $request->validate([
            'pin' => ['required', 'string', 'size:4'],
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!Hash::check($request->pin, $user->pin)) {
            return back()->withErrors(['pin' => 'Invalid PIN. Please try again.']);
        }

        $request->session()->forget('needs_pin');
        $request->session()->put('pin_verified', true);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
