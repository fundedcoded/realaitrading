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
            <div class="flex justify-center gap-4" id="enter-pin-inputs">
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="0" inputmode="numeric" autofocus />
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="1" inputmode="numeric" />
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="2" inputmode="numeric" />
                <input type="password" maxlength="1" class="w-14 h-16 text-center text-2xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="3" inputmode="numeric" />
            </div>
            <input type="hidden" name="pin" id="enter-pin-hidden" />
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('#enter-pin-inputs input');
            const hiddenInput = document.getElementById('enter-pin-hidden');
            const form = document.getElementById('enter-pin-form');

            function updateHidden() {
                let val = '';
                inputs.forEach(input => val += input.value);
                hiddenInput.value = val;
            }

            inputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    updateHidden();

                    // Auto-submit when all 4 digits entered
                    if (index === inputs.length - 1 && this.value) {
                        updateHidden();
                        if (hiddenInput.value.length === 4) {
                            form.submit();
                        }
                    }
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
                    updateHidden();
                    if (pastedData.length >= 4) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-guest-layout>
