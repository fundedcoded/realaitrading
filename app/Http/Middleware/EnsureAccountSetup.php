<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountSetup
{
    /**
     * Ensure the user has verified email and set up their PIN.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Skip if already on these routes to avoid redirect loops
        $currentRoute = $request->route()->getName();
        $allowedRoutes = ['verify-code', 'verify-code.resend', 'create-pin', 'enter-pin', 'logout'];
        
        if (in_array($currentRoute, $allowedRoutes)) {
            return $next($request);
        }

        // Check email verification
        if (!$user->email_verified_at) {
            return redirect()->route('verify-code');
        }

        // Check PIN is set
        if (!$user->pin) {
            return redirect()->route('create-pin');
        }

        // Check if PIN has been entered this session
        if (!session('pin_verified') && $currentRoute !== 'enter-pin') {
            session(['needs_pin' => true]);
            return redirect()->route('enter-pin');
        }

        return $next($request);
    }
}
