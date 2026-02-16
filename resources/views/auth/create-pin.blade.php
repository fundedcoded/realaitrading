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
            <div class="flex justify-center gap-4" id="pin-inputs">
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="0" inputmode="numeric" autofocus />
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="1" inputmode="numeric" />
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="2" inputmode="numeric" />
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="3" inputmode="numeric" />
            </div>
            <input type="hidden" name="pin" id="pin-hidden" />
            @error('pin')
                <p class="mt-3 text-sm text-red-400 text-center">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm PIN -->
        <div class="mb-8 animate-in animate-in-delay-2">
            <label class="auth-label text-center block mb-4">Confirm PIN</label>
            <div class="flex justify-center gap-4" id="pin-confirm-inputs">
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="0" inputmode="numeric" />
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="1" inputmode="numeric" />
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="2" inputmode="numeric" />
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="3" inputmode="numeric" />
            </div>
            <input type="hidden" name="pin_confirmation" id="pin-confirm-hidden" />
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupPinInputs(containerId, hiddenId) {
                const inputs = document.querySelectorAll(`#${containerId} input`);
                const hidden = document.getElementById(hiddenId);

                function updateHidden() {
                    let val = '';
                    inputs.forEach(input => val += input.value);
                    hidden.value = val;
                }

                inputs.forEach((input, index) => {
                    input.addEventListener('input', function(e) {
                        this.value = this.value.replace(/[^0-9]/g, '');
                        if (this.value && index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                        updateHidden();
                    });

                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Backspace' && !this.value && index > 0) {
                            inputs[index - 1].focus();
                            inputs[index - 1].value = '';
                            updateHidden();
                        }
                    });

                    input.addEventListener('paste', function(e) {
                        e.preventDefault();
                        const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '');
                        for (let i = 0; i < Math.min(pastedData.length, inputs.length); i++) {
                            inputs[i].value = pastedData[i];
                        }
                        if (pastedData.length >= inputs.length) {
                            inputs[inputs.length - 1].focus();
                            // Auto-advance to confirm section
                            if (containerId === 'pin-inputs') {
                                setTimeout(() => {
                                    document.querySelector('#pin-confirm-inputs input').focus();
                                }, 100);
                            }
                        }
                        updateHidden();
                    });

                    // When last digit of first PIN is entered, auto-focus confirm
                    if (containerId === 'pin-inputs' && index === inputs.length - 1) {
                        input.addEventListener('input', function() {
                            if (this.value) {
                                setTimeout(() => {
                                    document.querySelector('#pin-confirm-inputs input').focus();
                                }, 100);
                            }
                        });
                    }
                });
            }

            setupPinInputs('pin-inputs', 'pin-hidden');
            setupPinInputs('pin-confirm-inputs', 'pin-confirm-hidden');
        });
    </script>
</x-guest-layout>
