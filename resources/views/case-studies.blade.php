<x-public-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-luxury-white">
            {{ __('Case Studies') }}
        </h2>
    </x-slot>

    <div class="py-16 bg-luxury-black">
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-20 scroll-reveal">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-green-500/5 border border-green-500/15 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                <span class="text-green-400 text-[10px] font-bold tracking-[0.2em] uppercase">Verified Results</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-serif mb-6">Proven <span class="text-luxury-gold text-shadow-gold">Results</span></h1>
            <p class="text-xl text-luxury-white/60 max-w-3xl mx-auto">Real-world performance from our institutional-grade trading algorithms.</p>
        </div>

        <!-- Case Studies Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8 stagger-grid">
                
                <!-- Case Study 1 -->
                <div class="glow-card glass-card p-8 rounded-xl border border-luxury-white/10 group relative overflow-hidden">
                    <!-- Subtle glow accent -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-luxury-gold/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    
                    <div class="mb-6 relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs uppercase tracking-widest border border-green-500/20 mb-4">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            Active Fund
                        </div>
                        <h3 class="text-3xl font-serif mb-2 group-hover:text-luxury-gold transition-colors">FTMO $200k Challenge</h3>
                        <p class="text-luxury-white/50 text-sm">EUR/USD, GBP/USD Scalping Strategy</p>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6 relative z-10">
                        <div>
                            <div class="text-xs text-luxury-white/40 uppercase tracking-wider mb-2">Total ROI</div>
                            <div class="text-3xl font-serif text-luxury-gold count-up" data-target="47.3" data-prefix="+" data-suffix="%" data-decimals="1">0.0%</div>
                        </div>
                        <div>
                            <div class="text-xs text-luxury-white/40 uppercase tracking-wider mb-2">Sharpe Ratio</div>
                            <div class="text-3xl font-serif text-green-400 count-up" data-target="2.41" data-decimals="2">0.00</div>
                        </div>
                        <div>
                            <div class="text-xs text-luxury-white/40 uppercase tracking-wider mb-2">Win Rate</div>
                            <div class="text-2xl font-serif text-luxury-white count-up" data-target="72" data-suffix="%" data-decimals="0">0%</div>
                        </div>
                        <div>
                            <div class="text-xs text-luxury-white/40 uppercase tracking-wider mb-2">Max Drawdown</div>
                            <div class="text-2xl font-serif text-luxury-white">-4.2%</div>
                        </div>
                    </div>

                    <!-- Mini sparkline -->
                    <div class="mb-6 relative z-10">
                        <canvas class="mini-sparkline-cs w-full h-12" data-color="#D4AF37" data-values="100,102,105,103,108,112,115,118,120,125,130,128,135,140,147"></canvas>
                    </div>

                    <div class="border-t border-luxury-white/5 pt-6 relative z-10">
                        <p class="text-luxury-white/60 text-sm leading-relaxed">
                            Passed the FTMO $200k challenge in 18 days using our momentum-based neural engine. The algorithm identified 43 high-probability setups, achieving a 72% win rate while maintaining strict drawdown limits.
                        </p>
                    </div>

                    <div class="mt-6 flex items-center gap-2 text-xs text-luxury-white/40 relative z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Live Since: Oct 2024</span>
                    </div>
                </div>

                <!-- Case Study 2 -->
                <div class="glow-card glass-card p-8 rounded-xl border border-luxury-white/10 group relative overflow-hidden">
                    <!-- Subtle glow accent -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-luxury-blue/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

                    <div class="mb-6 relative z-10">
                        <div class="inline-block px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs uppercase tracking-widest border border-blue-500/20 mb-4">
                            Completed
                        </div>
                        <h3 class="text-3xl font-serif mb-2 group-hover:text-luxury-blue transition-colors">Gold (XAU/USD) Swing</h3>
                        <p class="text-luxury-white/50 text-sm">Multi-Timeframe Analysis</p>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6 relative z-10">
                        <div>
                            <div class="text-xs text-luxury-white/40 uppercase tracking-wider mb-2">Total ROI</div>
                            <div class="text-3xl font-serif text-luxury-gold count-up" data-target="89.6" data-prefix="+" data-suffix="%" data-decimals="1">0.0%</div>
                        </div>
                        <div>
                            <div class="text-xs text-luxury-white/40 uppercase tracking-wider mb-2">Sharpe Ratio</div>
                            <div class="text-3xl font-serif text-green-400 count-up" data-target="3.12" data-decimals="2">0.00</div>
                        </div>
                        <div>
                            <div class="text-xs text-luxury-white/40 uppercase tracking-wider mb-2">Win Rate</div>
                            <div class="text-2xl font-serif text-luxury-white count-up" data-target="65" data-suffix="%" data-decimals="0">0%</div>
                        </div>
                        <div>
                            <div class="text-xs text-luxury-white/40 uppercase tracking-wider mb-2">Max Drawdown</div>
                            <div class="text-2xl font-serif text-luxury-white">-6.8%</div>
                        </div>
                    </div>

                    <!-- Mini sparkline -->
                    <div class="mb-6 relative z-10">
                        <canvas class="mini-sparkline-cs w-full h-12" data-color="#38BDF8" data-values="100,104,108,106,112,118,124,120,128,135,142,150,160,175,190"></canvas>
                    </div>

                    <div class="border-t border-luxury-white/5 pt-6 relative z-10">
                        <p class="text-luxury-white/60 text-sm leading-relaxed">
                            Captured the volatile Gold rally in Q3 2024. The algorithm correctly identified institutional order flow reversals, entering 27 swing positions over 4 months with an average hold time of 3.2 days.
                        </p>
                    </div>

                    <div class="mt-6 flex items-center gap-2 text-xs text-luxury-white/40 relative z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Duration: Jul - Oct 2024</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Performance Disclaimer -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 scroll-reveal">
            <div class="glass-card p-6 rounded-xl border border-luxury-white/10">
                <p class="text-xs text-luxury-white/40 leading-relaxed">
                    <strong class="text-luxury-white/60">Disclaimer:</strong> Past performance is not indicative of future results. Trading involves substantial risk of loss. The case studies presented reflect real trading outcomes but individual results may vary based on market conditions, risk tolerance, and capital allocation.
                </p>
            </div>
        </div>
    </div>

    <!-- Mini Sparkline Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.mini-sparkline-cs').forEach(canvas => {
                const ctx = canvas.getContext('2d');
                const color = canvas.dataset.color;
                const values = canvas.dataset.values.split(',').map(Number);
                const w = canvas.width = canvas.offsetWidth;
                const h = canvas.height = canvas.offsetHeight;
                const max = Math.max(...values);
                const min = Math.min(...values);
                const range = max - min || 1;
                const stepX = w / (values.length - 1);
                const padding = 4;

                // Draw smooth curve
                ctx.beginPath();
                values.forEach((v, i) => {
                    const x = i * stepX;
                    const y = h - padding - ((v - min) / range) * (h - padding * 2);
                    if (i === 0) ctx.moveTo(x, y);
                    else {
                        const prevX = (i - 1) * stepX;
                        const cpX = (prevX + x) / 2;
                        const prevY = h - padding - ((values[i-1] - min) / range) * (h - padding * 2);
                        ctx.quadraticCurveTo(prevX + (x - prevX) * 0.5, prevY, cpX, (prevY + y) / 2);
                        ctx.quadraticCurveTo(cpX, y, x, y);
                    }
                });
                ctx.strokeStyle = color;
                ctx.lineWidth = 2;
                ctx.stroke();

                // Fill gradient
                ctx.lineTo(w, h);
                ctx.lineTo(0, h);
                const gradient = ctx.createLinearGradient(0, 0, 0, h);
                gradient.addColorStop(0, color.replace(')', ', 0.15)').replace('rgb', 'rgba'));
                gradient.addColorStop(1, 'transparent');
                ctx.fillStyle = gradient;
                ctx.fill();
            });
        });
    </script>
</x-public-layout>
