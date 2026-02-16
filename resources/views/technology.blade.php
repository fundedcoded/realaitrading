<x-public-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-luxury-white">
            {{ __('Technology') }}
        </h2>
    </x-slot>

    <div class="pt-8 pb-16 bg-luxury-black min-h-screen">
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-20 scroll-reveal">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-luxury-gold/5 border border-luxury-gold/15 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-luxury-gold animate-pulse"></span>
                <span class="text-luxury-gold text-[10px] font-bold tracking-[0.2em] uppercase">Institutional Grade</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-serif mb-6">Our <span class="text-luxury-gold text-shadow-gold">Technology</span> Stack</h1>
            <p class="text-xl text-luxury-white/60 max-w-3xl mx-auto">Institutional-grade infrastructure powering algorithmic trading strategies.</p>
        </div>

        <!-- Deep Learning Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-32">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="scroll-reveal">
                    <span class="text-luxury-gold text-xs font-bold tracking-[0.2em] uppercase mb-4 block">Neural Engine</span>
                    <h2 class="text-4xl md:text-5xl font-serif mb-6">Deep Learning Core</h2>
                    <p class="text-luxury-white/60 leading-relaxed mb-8">
                        Our proprietary neural network processes over 50,000 data points per second, identifying high-probability trade setups across multiple asset classes and timeframes simultaneously.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-luxury-gold shadow-[0_0_8px_rgba(212,175,55,0.5)]"></span>
                            <span class="text-luxury-white/80">Transformer Architecture (Custom GPT-based)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-luxury-gold shadow-[0_0_8px_rgba(212,175,55,0.5)]"></span>
                            <span class="text-luxury-white/80">Reinforcement Learning for Position Sizing</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-luxury-gold shadow-[0_0_8px_rgba(212,175,55,0.5)]"></span>
                            <span class="text-luxury-white/80">Multi-Timeframe Analysis</span>
                        </li>
                    </ul>
                </div>
                <div class="relative scroll-reveal">
                    <div class="absolute -inset-4 bg-luxury-gold/20 blur-3xl rounded-full opacity-20 animate-pulse"></div>
                    <div class="glow-card glass-card p-8 rounded-2xl border border-luxury-white/10 relative">
                        <div class="font-mono text-xs text-luxury-white/60 space-y-3">
                            <div class="flex justify-between border-b border-luxury-white/5 pb-2">
                                <span>Architecture</span>
                                <span class="text-luxury-gold">Transformer v4.2</span>
                            </div>
                            <div class="flex justify-between border-b border-luxury-white/5 pb-2">
                                <span>Parameters</span>
                                <span class="text-luxury-gold">1.2B</span>
                            </div>
                            <div class="flex justify-between border-b border-luxury-white/5 pb-2">
                                <span>Training Data</span>
                                <span class="text-luxury-gold">12 Years Tick Data</span>
                            </div>
                            <div class="flex justify-between border-b border-luxury-white/5 pb-2">
                                <span>Inference Speed</span>
                                <span class="text-green-400">< 2ms</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Model Accuracy</span>
                                <span class="text-luxury-gold count-up" data-target="94.7" data-suffix="%" data-decimals="1">0.0%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colocated Execution Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-32 bg-luxury-charcoal/30 py-20 rounded-2xl">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="order-2 md:order-1 relative stagger-grid">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="glow-card glass-card p-6 rounded-lg border border-luxury-white/5">
                            <div class="text-2xl font-mono text-luxury-gold mb-2 count-up" data-target="0.3" data-suffix="ms" data-decimals="1">0.0ms</div>
                            <div class="text-xs text-luxury-white/40 uppercase">NY4 Equinix</div>
                        </div>
                        <div class="glow-card glass-card p-6 rounded-lg border border-luxury-white/5">
                            <div class="text-2xl font-mono text-luxury-gold mb-2 count-up" data-target="0.8" data-suffix="ms" data-decimals="1">0.0ms</div>
                            <div class="text-xs text-luxury-white/40 uppercase">LD4 London</div>
                        </div>
                        <div class="glow-card glass-card p-6 rounded-lg border border-luxury-white/5">
                            <div class="text-2xl font-mono text-luxury-gold mb-2 count-up" data-target="1.2" data-suffix="ms" data-decimals="1">0.0ms</div>
                            <div class="text-xs text-luxury-white/40 uppercase">TY3 Tokyo</div>
                        </div>
                        <div class="glow-card glass-card p-6 rounded-lg border border-luxury-white/5">
                            <div class="text-2xl font-mono text-luxury-gold mb-2 count-up" data-target="0.5" data-suffix="ms" data-decimals="1">0.0ms</div>
                            <div class="text-xs text-luxury-white/40 uppercase">Singapore Equinix</div>
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2 scroll-reveal">
                    <span class="text-luxury-blue text-xs font-bold tracking-[0.2em] uppercase mb-4 block">Latency Arbitration</span>
                    <h2 class="text-4xl md:text-5xl font-serif mb-6">Colocated <span class="text-luxury-blue">Execution</span></h2>
                    <p class="text-luxury-white/60 leading-relaxed mb-6">
                        Our servers sit inside the exchange data centers. Sub-millisecond execution speed means we capture opportunities before they vanish.
                    </p>
                    <div class="glass-card p-4 rounded-lg border border-luxury-white/5 inline-block">
                        <div class="flex items-center gap-6 text-sm">
                            <div>
                                <span class="text-luxury-white/60">Uptime</span>
                                <span class="text-green-400 font-mono ml-2 count-up" data-target="99.99" data-suffix="%" data-decimals="2">0.00%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Risk Engine Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="scroll-reveal">
                    <span class="text-luxury-magenta text-xs font-bold tracking-[0.2em] uppercase mb-4 block">Risk Management</span>
                    <h2 class="text-4xl md:text-5xl font-serif mb-6">The Fortress <span class="text-luxury-magenta">Risk Engine</span></h2>
                    <p class="text-luxury-white/60 leading-relaxed mb-6">
                        Our 47-factor risk model monitors portfolio exposure in real-time, dynamically adjusting position sizes and hedge ratios to maintain optimal risk-adjusted returns.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-luxury-magenta shadow-[0_0_8px_rgba(236,72,153,0.5)]"></span>
                            <span class="text-luxury-white/80">Dynamic position sizing based on volatility</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-luxury-magenta shadow-[0_0_8px_rgba(236,72,153,0.5)]"></span>
                            <span class="text-luxury-white/80">Real-time correlation tracking across 200+ pairs</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-luxury-magenta shadow-[0_0_8px_rgba(236,72,153,0.5)]"></span>
                            <span class="text-luxury-white/80">Stops trading 5 mins before news</span>
                        </li>
                    </ul>
                </div>
                <div class="relative scroll-reveal">
                    <div class="glow-card glass-card p-8 rounded-2xl border border-luxury-white/10">
                        <h3 class="text-sm text-luxury-white/40 uppercase tracking-widest mb-6">Live Risk Metrics</h3>
                        <div class="space-y-5">
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-luxury-white/60">Portfolio Exposure</span>
                                    <span class="text-green-400 font-mono">24%</span>
                                </div>
                                <div class="w-full h-1.5 bg-luxury-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-500 to-green-400 rounded-full transition-all duration-1000" style="width: 24%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-luxury-white/60">Drawdown Buffer</span>
                                    <span class="text-luxury-gold font-mono">87%</span>
                                </div>
                                <div class="w-full h-1.5 bg-luxury-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-luxury-gold to-luxury-gold-light rounded-full transition-all duration-1000" style="width: 87%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-luxury-white/60">Hedge Coverage</span>
                                    <span class="text-luxury-blue font-mono">92%</span>
                                </div>
                                <div class="w-full h-1.5 bg-luxury-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-400 rounded-full transition-all duration-1000" style="width: 92%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-luxury-white/60">System Health</span>
                                    <span class="text-green-400 font-mono">100%</span>
                                </div>
                                <div class="w-full h-1.5 bg-luxury-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-400 rounded-full transition-all duration-1000" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
