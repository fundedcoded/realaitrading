<x-guest-layout>
    <div class="text-center animate-in">
        <!-- Icon -->
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-luxury-gold/10 border border-luxury-gold/20 mb-6">
            <svg class="w-8 h-8 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-serif font-medium text-luxury-white mb-2">Enter Your PIN.</h1>
        <p class="text-luxury-white/30 text-sm mb-8">Enter your 4-digit PIN to access your dashboard.</p>
    </div>

    <form method="POST" action="{{ route('enter-pin') }}" id="enter-pin-form">
        @csrf

        <!-- PIN Input -->
        <div class="mb-8 animate-in animate-in-delay-1">
            <div class="otp-wrapper" id="pin-wrapper">
                <input
                    type="password"
                    name="pin"
                    id="pin-input"
                    maxlength="4"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    autofocus
                    class="otp-real-input"
                    placeholder=" "
                />
                <div class="otp-display" id="pin-display" aria-hidden="true">
                    <div class="otp-box otp-box-lg" data-i="0"></div>
                    <div class="otp-box otp-box-lg" data-i="1"></div>
                    <div class="otp-box otp-box-lg" data-i="2"></div>
                    <div class="otp-box otp-box-lg" data-i="3"></div>
                </div>
            </div>
            @error('pin')
                <p class="mt-3 text-sm text-red-400 text-center">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="animate-in animate-in-delay-2">
            <button type="submit" class="auth-btn">
                Unlock Dashboard
            </button>
        </div>

        <!-- Logout fallback -->
        <div class="mt-6 text-center animate-in animate-in-delay-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-luxury-white/20 hover:text-luxury-white/40 transition-colors">
                    Sign in with a different account
                </button>
            </form>
        </div>
    </form>

    <style>
        .otp-wrapper { position: relative; }
        .otp-real-input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            z-index: 10;
            font-size: 18px;
            caret-color: transparent;
            cursor: pointer;
        }
        .otp-display {
            display: flex;
            justify-content: center;
            gap: 1rem;
            pointer-events: none;
        }
        .otp-box-lg {
            width: 3.5rem;
            height: 4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-family: 'DM Serif Display', Georgia, serif;
            color: #f5f5f5;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 0.75rem;
            transition: all 0.15s ease;
        }
        .otp-box-lg.filled {
            border-color: rgba(212,175,55,0.3);
            background: rgba(212,175,55,0.04);
        }
        .otp-box-lg.active {
            border-color: rgba(212,175,55,0.5);
            box-shadow: 0 0 0 3px rgba(212,175,55,0.08);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('pin-input');
            const boxes = document.querySelectorAll('#pin-display .otp-box-lg');
            const form = document.getElementById('enter-pin-form');

            function render() {
                const val = input.value.replace(/[^0-9]/g, '');
                if (val !== input.value) input.value = val;
                boxes.forEach((box, i) => {
                    box.textContent = val[i] ? '●' : '';
                    box.classList.toggle('filled', !!val[i]);
                    box.classList.toggle('active', i === val.length && document.activeElement === input);
                });
                if (val.length === 4) {
                    setTimeout(() => form.submit(), 200);
                }
            }

            input.addEventListener('input', render);
            input.addEventListener('focus', render);
            input.addEventListener('blur', () => {
                boxes.forEach(b => b.classList.remove('active'));
            });
            input.addEventListener('click', render);
            render();
        });
    </script>
</x-guest-layout>
