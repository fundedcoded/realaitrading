<x-public-layout>
    <!-- Hero Section -->
    <div class="relative min-h-[60vh] flex items-center justify-center overflow-hidden pt-20">
        <!-- Background Effects -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-luxury-black"></div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-luxury-gold/5 rounded-full blur-[100px] -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-luxury-blue/5 rounded-full blur-[100px] -ml-20 -mb-20"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 w-full text-center">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-luxury-gold/5 border border-luxury-gold/20 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-luxury-gold animate-pulse"></span>
                    <span class="text-luxury-gold text-xs tracking-[0.2em] uppercase font-bold">Secure Payment Gateway</span>
                </div>
                
                <h1 class="text-5xl md:text-7xl font-serif font-medium tracking-tight leading-none text-luxury-white">
                    Activate Your <span class="text-gradient-gold italic">Account</span>
                </h1>
                
                <p class="max-w-2xl mx-auto text-xl text-luxury-white/60 font-light leading-relaxed">
                    Complete your deposit to unlock the full power of the Sovereign Edge AI. Your capital is held in a segregated, secure wallet.
                </p>
            </div>
        </div>
    </div>

    <!-- Deposit Content -->
    <div class="relative py-20 bg-luxury-charcoal border-t border-luxury-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Payment Card -->
            <div class="glass-card p-8 md:p-12 rounded-2xl border border-luxury-gold/20 bg-luxury-black/50 backdrop-blur-xl shadow-[0_0_50px_rgba(0,0,0,0.3)]">
                
                <!-- Step 1: Wallet Address -->
                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 rounded-full bg-luxury-gold/10 flex items-center justify-center border border-luxury-gold/20 text-luxury-gold font-serif text-xl">1</div>
                        <h3 class="text-2xl font-serif text-luxury-white">Send Bitcoin (BTC)</h3>
                    </div>
                    
                    <div class="bg-black/40 rounded-xl p-6 border border-luxury-white/10 flex flex-col md:flex-row items-center gap-6">
                        <!-- QR Code Placeholder -->
                        <div class="w-32 h-32 bg-white p-2 rounded-lg flex-shrink-0">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=bc1qxygjfg47are2su0l7kxmx28tqw62tugtn4jrdh" alt="BTC QR Code" class="w-full h-full">
                        </div>
                        
                        <div class="flex-grow w-full">
                            <label class="text-xs text-luxury-white/40 uppercase tracking-widest mb-2 block">BTC Wallet Address</label>
                            <div class="relative group">
                                <input type="text" readonly value="bc1qxygjfg47are2su0l7kxmx28tqw62tugtn4jrdh" 
                                       class="w-full bg-luxury-black border border-luxury-white/10 rounded-lg py-3 px-4 text-luxury-gold font-mono text-sm focus:outline-none focus:border-luxury-gold/50 transition-colors"
                                       id="btc-wallet">
                                <button onclick="copyToClipboard()" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-luxury-white/40 hover:text-luxury-gold transition-colors" title="Copy Address">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </button>
                                <div id="copy-feedback" class="absolute -top-8 right-0 bg-luxury-gold text-luxury-black text-xs font-bold px-2 py-1 rounded opacity-0 transition-opacity">Copied!</div>
                            </div>
                            <p class="text-xs text-luxury-white/30 mt-2">
                                <span class="text-red-400">Important:</span> Send only BTC to this address. Sending any other asset may result in permanent loss.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Confirmation -->
                <div class="mb-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 rounded-full bg-luxury-blue/10 flex items-center justify-center border border-luxury-blue/20 text-luxury-blue font-serif text-xl">2</div>
                        <h3 class="text-2xl font-serif text-luxury-white">Confirm Payment</h3>
                    </div>
                    
                    <div class="space-y-4 text-luxury-white/70 leading-relaxed">
                        <p>Once you have sent the Bitcoin, please take a screenshot of the transaction confirmation from your wallet app or exchange.</p>
                        <p>Email this screenshot to our secure support channel for immediate activation:</p>
                        
                        <a href="mailto:support@realaitrading.com" class="inline-flex items-center gap-3 text-luxury-gold hover:text-white transition-colors text-lg font-medium mt-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            support@realaitrading.com
                        </a>
                    </div>
                </div>

            </div>

            <!-- Trust Badges -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="flex flex-col items-center text-center p-6 rounded-xl bg-white/5 border border-white/5">
                    <svg class="w-8 h-8 text-luxury-gold mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <h4 class="text-luxury-white font-bold text-sm uppercase tracking-wider mb-2">Secure Storage</h4>
                    <p class="text-luxury-white/40 text-xs">98% of assets are held in cold storage wallets.</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 rounded-xl bg-white/5 border border-white/5">
                    <svg class="w-8 h-8 text-luxury-gold mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <h4 class="text-luxury-white font-bold text-sm uppercase tracking-wider mb-2">Instant Activation</h4>
                    <p class="text-luxury-white/40 text-xs">Account activated within 15 minutes of confirmation.</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 rounded-xl bg-white/5 border border-white/5">
                    <svg class="w-8 h-8 text-luxury-gold mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <h4 class="text-luxury-white font-bold text-sm uppercase tracking-wider mb-2">24/7 Support</h4>
                    <p class="text-luxury-white/40 text-xs">Our team is ready to assist you at any time.</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("btc-wallet");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(copyText.value);
            
            var feedback = document.getElementById("copy-feedback");
            feedback.style.opacity = "1";
            setTimeout(function() {
                feedback.style.opacity = "0";
            }, 2000);
        }
    </script>
</x-public-layout>
