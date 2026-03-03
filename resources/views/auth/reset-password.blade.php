<x-guest-layout>
    <div class="animate-in">
        <h1 class="text-3xl font-serif font-medium text-luxury-white mb-2">New Password.</h1>
        <p class="text-luxury-white/30 text-sm mb-8">Choose a strong, unique password for your account.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-5 animate-in animate-in-delay-1">
            <label for="email" class="auth-label">Email Address</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="trader@example.com" />
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-5 animate-in animate-in-delay-2">
            <label for="password" class="auth-label">New Password</label>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-8 animate-in animate-in-delay-3">
            <label for="password_confirmation" class="auth-label">Confirm Password</label>
            <input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="animate-in animate-in-delay-4">
            <button type="submit" class="auth-btn">
                Reset Password
            </button>
        </div>

        <!-- Back to Login -->
        <div class="mt-8 text-center animate-in animate-in-delay-5">
            <a href="{{ route('login') }}" class="text-sm text-luxury-gold/60 hover:text-luxury-gold transition-colors inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Sign In
            </a>
        </div>
    </form>
</x-guest-layout>
