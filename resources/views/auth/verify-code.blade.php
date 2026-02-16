<x-guest-layout>
    <!-- Status -->
    @if (session('status'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm animate-in">
            {{ session('status') }}
        </div>
    @endif

    <div class="text-center animate-in">
        <!-- Icon -->
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-luxury-gold/10 border border-luxury-gold/20 mb-6">
            <svg class="w-8 h-8 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-serif font-medium text-luxury-white mb-2">Verify Your Email.</h1>
        <p class="text-luxury-white/30 text-sm mb-2">We've sent a 6-digit code to</p>
        <p class="text-luxury-gold text-sm font-medium mb-8">{{ $email }}</p>
    </div>

    <form method="POST" action="{{ route('verify-code') }}" id="verify-form">
        @csrf

        <!-- 6-Digit Code Input -->
        <div class="mb-8 animate-in animate-in-delay-1">
            <label class="auth-label text-center block mb-4">Enter Verification Code</label>
            <div class="otp-wrapper" id="code-wrapper">
                <input
                    type="text"
                    name="code"
                    id="code-input"
                    maxlength="6"
                    inputmode="numeric"
                    autocomplete="one-time-code"
                    pattern="[0-9]*"
                    autofocus
                    class="otp-real-input"
                    placeholder=" "
                />
                <div class="otp-display" id="code-display" aria-hidden="true">
                    <div class="otp-box" data-i="0"></div>
                    <div class="otp-box" data-i="1"></div>
                    <div class="otp-box" data-i="2"></div>
                    <div class="otp-box" data-i="3"></div>
                    <div class="otp-box" data-i="4"></div>
                    <div class="otp-box" data-i="5"></div>
                </div>
            </div>
            @error('code')
                <p class="mt-3 text-sm text-red-400 text-center">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="animate-in animate-in-delay-2">
            <button type="submit" class="auth-btn">
                Verify Email
            </button>
        </div>
    </form>

    <!-- Resend -->
    <div class="mt-6 text-center animate-in animate-in-delay-3">
        <p class="text-luxury-white/20 text-sm mb-3">Didn't receive the code?</p>
        <form method="POST" action="{{ route('verify-code.resend') }}">
            @csrf
            <button type="submit" class="text-sm text-luxury-gold/60 hover:text-luxury-gold transition-colors font-medium">
                Resend Code
            </button>
        </form>
    </div>

    <!-- Timer -->
    <div class="mt-4 text-center animate-in animate-in-delay-4">
        <p class="text-[11px] text-luxury-white/15 uppercase tracking-widest">
            Code expires in <span id="timer" class="text-luxury-gold/40">10:00</span>
        </p>
    </div>

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
            gap: 0.65rem;
            pointer-events: none;
        }
        .otp-box {
            width: 3rem;
            height: 3.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            font-family: 'DM Serif Display', Georgia, serif;
            color: #f5f5f5;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 0.75rem;
            transition: all 0.15s ease;
        }
        .otp-box.filled {
            border-color: rgba(212,175,55,0.3);
            background: rgba(212,175,55,0.04);
        }
        .otp-box.active {
            border-color: rgba(212,175,55,0.5);
            box-shadow: 0 0 0 3px rgba(212,175,55,0.08);
        }
        @media (max-width: 400px) {
            .otp-display { gap: 0.4rem; }
            .otp-box { width: 2.6rem; height: 3rem; font-size: 1.15rem; }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('code-input');
            const boxes = document.querySelectorAll('#code-display .otp-box');
            const form = document.getElementById('verify-form');

            function render() {
                const val = input.value.replace(/[^0-9]/g, '');
                if (val !== input.value) input.value = val;
                boxes.forEach((box, i) => {
                    box.textContent = val[i] || '';
                    box.classList.toggle('filled', !!val[i]);
                    box.classList.toggle('active', i === val.length && document.activeElement === input);
                });
                if (val.length === 6) {
                    setTimeout(() => form.submit(), 150);
                }
            }

            input.addEventListener('input', render);
            input.addEventListener('focus', render);
            input.addEventListener('blur', () => {
                boxes.forEach(b => b.classList.remove('active'));
            });
            input.addEventListener('click', render);
            render();

            // Timer
            let timeLeft = 600;
            const timerEl = document.getElementById('timer');
            const countdown = setInterval(() => {
                timeLeft--;
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerEl.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    timerEl.textContent = 'Expired';
                    timerEl.classList.add('text-red-400/60');
                }
            }, 1000);
        });
    </script>
</x-guest-layout>
