<x-guest-layout>
    <div class="text-center animate-in">
        <!-- Icon -->
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-luxury-gold/10 border border-luxury-gold/20 mb-6">
            <svg class="w-8 h-8 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-serif font-medium text-luxury-white mb-2">Create Your PIN.</h1>
        <p class="text-luxury-white/30 text-sm mb-8">Set a 4-digit PIN for secure, quick access to your account.</p>
    </div>

    <form method="POST" action="{{ route('create-pin') }}" id="pin-form">
        @csrf

        <!-- PIN Input -->
        <div class="mb-6 animate-in animate-in-delay-1">
            <label class="auth-label text-center block mb-4">Enter 4-Digit PIN</label>
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

        <!-- Confirm PIN -->
        <div class="mb-8 animate-in animate-in-delay-2">
            <label class="auth-label text-center block mb-4">Confirm PIN</label>
            <div class="otp-wrapper" id="pin-confirm-wrapper">
                <input
                    type="password"
                    name="pin_confirmation"
                    id="pin-confirm-input"
                    maxlength="4"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    class="otp-real-input"
                    placeholder=" "
                />
                <div class="otp-display" id="pin-confirm-display" aria-hidden="true">
                    <div class="otp-box otp-box-lg" data-i="0"></div>
                    <div class="otp-box otp-box-lg" data-i="1"></div>
                    <div class="otp-box otp-box-lg" data-i="2"></div>
                    <div class="otp-box otp-box-lg" data-i="3"></div>
                </div>
            </div>
            @error('pin_confirmation')
                <p class="mt-3 text-sm text-red-400 text-center">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="animate-in animate-in-delay-3">
            <button type="submit" class="auth-btn">
                Set PIN & Continue
            </button>
        </div>

        <!-- Info -->
        <div class="mt-6 text-center animate-in animate-in-delay-4">
            <p class="text-[11px] text-luxury-white/20 leading-relaxed">
                You'll use this PIN every time you log in. Keep it secure and never share it with anyone.
            </p>
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
            function setupPinField(inputId, displayId, onComplete) {
                const input = document.getElementById(inputId);
                const boxes = document.querySelectorAll(`#${displayId} .otp-box-lg`);

                function render() {
                    const val = input.value.replace(/[^0-9]/g, '');
                    if (val !== input.value) input.value = val;
                    boxes.forEach((box, i) => {
                        box.textContent = val[i] ? '●' : '';
                        box.classList.toggle('filled', !!val[i]);
                        box.classList.toggle('active', i === val.length && document.activeElement === input);
                    });
                    if (val.length === 4 && onComplete) {
                        onComplete();
                    }
                }

                input.addEventListener('input', render);
                input.addEventListener('focus', render);
                input.addEventListener('blur', () => {
                    boxes.forEach(b => b.classList.remove('active'));
                });
                input.addEventListener('click', render);
                render();
            }

            // PIN field — auto-focus to confirm when 4 digits entered
            setupPinField('pin-input', 'pin-display', () => {
                setTimeout(() => document.getElementById('pin-confirm-input').focus(), 100);
            });

            // Confirm field — no auto action, user clicks submit
            setupPinField('pin-confirm-input', 'pin-confirm-display', null);
        });
    </script>
</x-guest-layout>
