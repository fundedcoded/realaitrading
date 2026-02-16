<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCodeMail;
use App\Models\EmailVerificationCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class VerificationCodeController extends Controller
{
    /**
     * Show the verification code entry page.
     */
    public function show(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->email_verified_at) {
            // Already verified, check if PIN is set
            if (!$user->pin) {
                return redirect()->route('create-pin');
            }
            return redirect()->route('dashboard');
        }

        return view('auth.verify-code', [
            'email' => $user->email,
        ]);
    }

    /**
     * Verify the submitted code.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $user = Auth::user();

        $verification = EmailVerificationCode::where('email', $user->email)
            ->where('code', $request->code)
            ->first();

        if (!$verification) {
            return back()->withErrors(['code' => 'Invalid verification code. Please try again.']);
        }

        if ($verification->isExpired()) {
            $verification->delete();
            return back()->withErrors(['code' => 'This code has expired. Please request a new one.']);
        }

        // Mark email as verified
        $user->email_verified_at = now();
        $user->save();

        // Clean up
        $verification->delete();

        // Redirect to PIN creation if no PIN set
        if (!$user->pin) {
            return redirect()->route('create-pin');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Resend the verification code.
     */
    public function resend(): RedirectResponse
    {
        $user = Auth::user();

        $code = EmailVerificationCode::generateFor($user->email);

        \App\Services\ResendMailService::sendVerificationCode($user->email, $code->code, $user->name);

        return back()->with('status', 'A new verification code has been sent to your email.');
    }

    /**
     * Show the create PIN page.
     */
    public function showCreatePin(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->pin) {
            return redirect()->route('dashboard');
        }

        return view('auth.create-pin');
    }

    /**
     * Store the user's PIN.
     */
    public function storePin(Request $request): RedirectResponse
    {
        $request->validate([
            'pin' => ['required', 'string', 'size:4', 'regex:/^[0-9]{4}$/'],
            'pin_confirmation' => ['required', 'same:pin'],
        ]);

        $user = Auth::user();
        $user->pin = bcrypt($request->pin);
        $user->save();

        return redirect()->route('dashboard')->with('status', 'Your PIN has been created successfully.');
    }
}
