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
            <div class="flex justify-center gap-3" id="code-inputs">
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="0" inputmode="numeric" autofocus />
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="1" inputmode="numeric" />
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="2" inputmode="numeric" />
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="3" inputmode="numeric" />
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="4" inputmode="numeric" />
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-serif bg-luxury-white/[0.03] border border-luxury-white/[0.08] rounded-xl text-luxury-white focus:border-luxury-gold/40 focus:bg-luxury-gold/[0.03] focus:shadow-[0_0_0_3px_rgba(212,175,55,0.08)] outline-none transition-all" data-index="5" inputmode="numeric" />
            </div>
            <input type="hidden" name="code" id="code-hidden" />
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

    <script>
        // Auto-advance digit inputs
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('#code-inputs input');
            const hiddenInput = document.getElementById('code-hidden');
            const form = document.getElementById('verify-form');

            function updateHidden() {
                let code = '';
                inputs.forEach(input => code += input.value);
                hiddenInput.value = code;
            }

            inputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    // Only allow digits
                    this.value = this.value.replace(/[^0-9]/g, '');
                    
                    if (this.value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    updateHidden();

                    // Auto-submit when all filled
                    if (index === inputs.length - 1 && this.value) {
                        updateHidden();
                        if (hiddenInput.value.length === 6) {
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

                // Handle paste
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '');
                    for (let i = 0; i < Math.min(pastedData.length, inputs.length); i++) {
                        inputs[i].value = pastedData[i];
                    }
                    if (pastedData.length >= inputs.length) {
                        inputs[inputs.length - 1].focus();
                    } else {
                        inputs[Math.min(pastedData.length, inputs.length - 1)].focus();
                    }
                    updateHidden();
                    if (pastedData.length === 6) {
                        form.submit();
                    }
                });
            });

            // Timer
            let timeLeft = 600; // 10 minutes
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
