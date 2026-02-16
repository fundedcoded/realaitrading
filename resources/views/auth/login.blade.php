<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm animate-in">
            {{ session('status') }}
        </div>
    @endif

    <div class="animate-in">
        <h1 class="text-3xl font-serif font-medium text-luxury-white mb-2">Welcome back.</h1>
        <p class="text-luxury-white/30 text-sm mb-8">Sign in to access your trading terminal.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-5 animate-in animate-in-delay-1">
            <label for="email" class="auth-label">Email Address</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="trader@example.com" />
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-5 animate-in animate-in-delay-2">
            <label for="password" class="auth-label">Password</label>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me + Forgot -->
        <div class="flex items-center justify-between mb-8 animate-in animate-in-delay-3">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-luxury-white/10 bg-luxury-white/[0.03] text-luxury-gold focus:ring-luxury-gold/30 focus:ring-offset-0" name="remember">
                <span class="ms-2 text-sm text-luxury-white/30">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-luxury-gold/60 hover:text-luxury-gold transition-colors" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        @error('pin')
            <div class="mb-4 p-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                {{ $message }}
            </div>
        @enderror

        <!-- Submit -->
        <div class="animate-in animate-in-delay-4">
            <button type="submit" class="auth-btn">
                Sign In
            </button>
        </div>

        <!-- Register Link -->
        <div class="mt-8 text-center animate-in animate-in-delay-5">
            <span class="text-luxury-white/20 text-sm">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-sm text-luxury-gold hover:text-luxury-gold/80 transition-colors ml-1 font-medium">
                Request Access
            </a>
        </div>
    </form>
</x-guest-layout>
