<x-guest-layout>
    <div class="animate-in">
        <h1 class="text-3xl font-serif font-medium text-luxury-white mb-2">Create Account.</h1>
        <p class="text-luxury-white/30 text-sm mb-8">Join 12,000+ traders using AI-powered execution.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5 animate-in animate-in-delay-1">
            <label for="name" class="auth-label">Full Name</label>
            <input id="name" class="auth-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe" />
            @error('name')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-5 animate-in animate-in-delay-2">
            <label for="email" class="auth-label">Email Address</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="trader@example.com" />
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-5 animate-in animate-in-delay-3">
            <label for="password" class="auth-label">Password</label>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-8 animate-in animate-in-delay-4">
            <label for="password_confirmation" class="auth-label">Confirm Password</label>
            <input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="animate-in animate-in-delay-5">
            <button type="submit" class="auth-btn">
                Create Account
            </button>
        </div>

        <!-- Login Link -->
        <div class="mt-8 text-center animate-in animate-in-delay-5">
            <span class="text-luxury-white/20 text-sm">Already have an account?</span>
            <a href="{{ route('login') }}" class="text-sm text-luxury-gold hover:text-luxury-gold/80 transition-colors ml-1 font-medium">
                Sign In
            </a>
        </div>
    </form>
</x-guest-layout>
