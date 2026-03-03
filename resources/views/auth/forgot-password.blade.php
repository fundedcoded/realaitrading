<x-guest-layout>
    <div class="animate-in">
        <h1 class="text-3xl font-serif font-medium text-luxury-white mb-2">Reset Password.</h1>
        <p class="text-luxury-white/30 text-sm mb-8">Enter your email and we'll send you a secure link to reset your password.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm animate-in">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6 animate-in animate-in-delay-1">
            <label for="email" class="auth-label">Email Address</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="trader@example.com" />
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="animate-in animate-in-delay-2">
            <button type="submit" class="auth-btn">
                Send Reset Link
            </button>
        </div>

        <!-- Back to Login -->
        <div class="mt-8 text-center animate-in animate-in-delay-3">
            <a href="{{ route('login') }}" class="text-sm text-luxury-gold/60 hover:text-luxury-gold transition-colors inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Sign In
            </a>
        </div>
    </form>
</x-guest-layout>
