<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Real AI Trading | The Sovereign Edge</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700|playfair-display:400,600,700&display=swap" rel="stylesheet" />
        
        <!-- GSAP Animation Library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .hero-bg {
                background-image: url('/images/hero.png');
                background-size: cover;
                background-position: center;
            }
            .text-shadow-gold {
                text-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
            }
        </style>
    </head>
    <body class="bg-luxury-black text-luxury-white antialiased overflow-x-hidden">
        
        <!-- Navigation -->
        <nav x-data="{ open: false }" class="fixed w-full z-50 transition-all duration-300" :class="{ 'bg-luxury-black/90 backdrop-blur-md border-b border-luxury-white/5': open || window.scrollY > 50, 'bg-transparent': !open && window.scrollY <= 50 }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-24 items-center">
                    <div class="flex items-center">
                        <a href="/" class="flex items-center gap-3 group">
                            <img src="/images/logo.png" alt="Real AI Trading" class="h-12 w-auto opacity-90 group-hover:opacity-100 transition-opacity">
                            <span class="font-serif text-xl tracking-widest text-luxury-white group-hover:text-luxury-gold transition-colors">REAL<span class="text-luxury-gold">AI</span>TRADING</span>
                        </a>
                    </div>
                    
                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('architecture') }}" class="nav-link">Architecture</a>
                        <a href="{{ route('performance') }}" class="nav-link">Performance</a>
                        <a href="{{ route('technology') }}" class="nav-link">Technology</a>
                        <a href="{{ route('login') }}" class="nav-link">Client Login</a>
                        <a href="{{ route('register') }}" class="btn-primary ml-4">
                            Request Access
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button @click="open = !open" class="text-luxury-white hover:text-luxury-gold focus:outline-none">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-luxury-black/95 backdrop-blur-xl border-b border-luxury-gold/10">
                <div class="pt-2 pb-4 space-y-1 px-4">
                    <a href="{{ route('architecture') }}" class="block py-3 text-luxury-white hover:text-luxury-gold border-b border-white/5">Architecture</a>
                    <a href="{{ route('performance') }}" class="block py-3 text-luxury-white hover:text-luxury-gold border-b border-white/5">Performance</a>
                    <a href="{{ route('technology') }}" class="block py-3 text-luxury-white hover:text-luxury-gold border-b border-white/5">Technology</a>
                    <a href="{{ route('login') }}" class="block py-3 text-luxury-white hover:text-luxury-gold border-b border-white/5">Client Login</a>
                    <a href="{{ route('register') }}" class="block py-4 text-luxury-gold font-bold">Request Access</a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
            <!-- Neural Void Canvas -->
            <canvas id="neural-canvas" class="absolute inset-0 z-0"></canvas>
            
            <!-- Gradient Overlay for Text Readability -->
            <div class="absolute inset-0 bg-gradient-to-b from-luxury-black/30 via-transparent to-luxury-black z-0 pointer-events-none"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 w-full text-center">
                <div class="space-y-8 relative z-20">
                    <!-- Status Indicator -->
                    <div class="hero-element opacity-0 translate-y-4 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-luxury-gold/5 border border-luxury-gold/20 backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse shadow-[0_0_10px_rgba(34,197,94,0.5)]"></span>
                        <span class="text-luxury-gold text-xs tracking-[0.2em] uppercase font-bold">Systems Operational</span>
                    </div>
                    
                    <!-- Main Headline -->
                    <h1 class="text-6xl md:text-8xl lg:text-9xl font-serif font-medium tracking-tight leading-none">
                        <div class="overflow-hidden">
                            <span class="hero-text-line block translate-y-full">The <span class="text-gradient-gold italic glow-text-gold">Sovereign</span></span>
                        </div>
                        <div class="overflow-hidden">
                            <span class="hero-text-line block translate-y-full">Edge.</span>
                        </div>
                    </h1>
                    
                    <!-- Subheadline -->
                    <div class="overflow-hidden">
                        <p class="hero-element opacity-0 translate-y-4 mt-8 max-w-2xl mx-auto text-xl md:text-2xl text-luxury-white/80 font-light leading-relaxed">
                            We deploy market-grade AI that trades every market with precision. <span class="text-luxury-white font-normal">Own the AI or grow your capital through us.</span> Zero emotion. Pure execution.
                        </p>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="hero-element opacity-0 translate-y-4 mt-12 flex flex-col md:flex-row gap-6 justify-center items-center">
                        <a href="{{ route('register') }}" class="btn-primary min-w-[220px] text-sm py-4 shadow-lg shadow-luxury-blue/20 hover:shadow-luxury-blue/40">
                            Request Access
                        </a>
                        <a href="{{ route('login') }}" class="group flex items-center gap-2 px-8 py-4 rounded-full border border-luxury-white/10 hover:bg-luxury-white/5 transition-all duration-300">
                            <span class="text-luxury-white text-sm tracking-widest uppercase">Live Terminal</span>
                            <svg class="w-4 h-4 text-luxury-gold group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Intelligence Section -->
        <div class="py-32 bg-luxury-black relative overflow-hidden">
            <!-- Ambient background effects -->
            <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-luxury-white/5 to-transparent"></div>
            <div class="absolute top-1/3 -left-48 w-96 h-96 bg-luxury-gold/[0.015] rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-1/4 -right-32 w-80 h-80 bg-luxury-blue/[0.02] rounded-full blur-[100px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-16 lg:gap-20 items-center">
                    <!-- Left Content -->
                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-luxury-gold/5 border border-luxury-gold/15 mb-8">
                            <span class="w-1.5 h-1.5 rounded-full bg-luxury-gold animate-pulse"></span>
                            <span class="text-luxury-gold text-[10px] font-bold tracking-[0.2em] uppercase">Holistic Wealth AI</span>
                        </div>
                        <h2 class="text-5xl md:text-6xl font-serif leading-tight mb-8">
                            Total Wealth <br> <span class="italic text-transparent bg-clip-text bg-gradient-to-r from-luxury-white/60 via-luxury-white/40 to-luxury-white/20">Sovereignty.</span>
                        </h2>
                        <div class="space-y-5 text-[15px] text-luxury-white/50 font-light leading-relaxed mb-10">
                            <p>
                                RealAI isn't just a trading bot; it's a <strong class="text-luxury-white font-medium">multi-asset wealth architect</strong>. From high-frequency crypto arbitrage to optimizing real estate yields and tax efficiency.
                            </p>
                            <p>
                                It constantly scans global markets to identify and execute high-value opportunities that manual traders simply cannot see.
                            </p>
                        </div>

                        <!-- Asset Class Chips -->
                        <div class="flex flex-wrap gap-2 mb-10">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-luxury-gold/5 border border-luxury-gold/10 text-luxury-gold text-[10px] font-bold tracking-widest uppercase">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                                Forex
                            </div>
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-luxury-blue/5 border border-luxury-blue/10 text-luxury-blue text-[10px] font-bold tracking-widest uppercase">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                                Crypto
                            </div>
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-500/5 border border-emerald-500/10 text-emerald-400 text-[10px] font-bold tracking-widest uppercase">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Indices
                            </div>
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-luxury-magenta/5 border border-luxury-magenta/10 text-luxury-magenta text-[10px] font-bold tracking-widest uppercase">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                Commodities
                            </div>
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-500/5 border border-amber-500/10 text-amber-400 text-[10px] font-bold tracking-widest uppercase">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path></svg>
                                Real Estate
                            </div>
                        </div>

                        <!-- Live Stats Row -->
                        <div class="flex gap-8">
                            <div>
                                <div class="text-3xl font-serif text-luxury-gold">5</div>
                                <div class="text-[9px] text-luxury-white/25 uppercase tracking-widest mt-1">Asset Classes</div>
                            </div>
                            <div class="w-px bg-luxury-white/5"></div>
                            <div>
                                <div class="text-3xl font-serif text-luxury-white">200+</div>
                                <div class="text-[9px] text-luxury-white/25 uppercase tracking-widest mt-1">Instruments</div>
                            </div>
                            <div class="w-px bg-luxury-white/5"></div>
                            <div>
                                <div class="text-3xl font-serif text-luxury-white">24/5</div>
                                <div class="text-[9px] text-luxury-white/25 uppercase tracking-widest mt-1">Scanning</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Terminal -->
                    <div class="relative">
                        <!-- Terminal glow backdrop -->
                        <div class="absolute -inset-6 bg-gradient-to-br from-luxury-gold/[0.04] via-luxury-blue/[0.03] to-luxury-magenta/[0.02] rounded-3xl blur-2xl opacity-60"></div>
                        <div class="absolute -inset-1 bg-gradient-to-br from-luxury-gold/10 via-luxury-blue/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

                        <!-- Floating stat callouts -->
                        <div class="absolute -left-4 top-8 z-20 hidden lg:block">
                            <div class="px-3 py-2 rounded-xl bg-luxury-charcoal/90 border border-luxury-gold/15 backdrop-blur-sm shadow-2xl">
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></div>
                                    <span class="text-[9px] text-luxury-white/50 uppercase tracking-widest">Live</span>
                                </div>
                                <div class="text-lg font-serif text-luxury-gold mt-0.5">Active</div>
                            </div>
                        </div>
                        <div class="absolute -right-4 bottom-16 z-20 hidden lg:block">
                            <div class="px-3 py-2 rounded-xl bg-luxury-charcoal/90 border border-emerald-500/15 backdrop-blur-sm shadow-2xl">
                                <div class="text-[9px] text-luxury-white/40 uppercase tracking-widest">Uptime</div>
                                <div class="text-lg font-serif text-emerald-400 mt-0.5">99.97%</div>
                            </div>
                        </div>

                        <!-- Omni Terminal Container -->
                        <div class="rounded-2xl relative border border-luxury-white/10 overflow-hidden h-[420px] bg-black/60 backdrop-blur-xl shadow-2xl shadow-black/50">
                            <!-- Terminal Header -->
                            <div class="flex items-center justify-between px-5 py-3 border-b border-luxury-white/5 bg-white/[0.03]">
                                <div class="flex gap-2">
                                    <div class="w-3 h-3 rounded-full bg-red-500/60 hover:bg-red-500 transition-colors cursor-pointer"></div>
                                    <div class="w-3 h-3 rounded-full bg-yellow-500/60 hover:bg-yellow-500 transition-colors cursor-pointer"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-500/60 hover:bg-green-500 transition-colors cursor-pointer"></div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_8px_rgba(74,222,128,0.5)]"></div>
                                    <span class="text-[10px] text-luxury-white/40 font-mono uppercase tracking-[0.15em]">Live Execution Log</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <div class="w-1 h-1 rounded-full bg-luxury-white/20"></div>
                                    <div class="w-1 h-1 rounded-full bg-luxury-white/20"></div>
                                    <div class="w-1 h-1 rounded-full bg-luxury-white/20"></div>
                                </div>
                            </div>
                            
                            <!-- Terminal Body -->
                            <div id="omni-terminal">
                                <!-- JS will inject logs here -->
                            </div>
                            
                            <!-- Terminal Footer Gradient -->
                            <div class="absolute bottom-0 left-0 w-full h-16 bg-gradient-to-t from-black/90 via-black/40 to-transparent pointer-events-none"></div>
                            <!-- Scan line effect -->
                            <div class="absolute inset-0 pointer-events-none opacity-[0.015]" style="background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(255,255,255,0.03) 2px, rgba(255,255,255,0.03) 4px);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Unfair Advantage -->
        <div class="py-32 bg-luxury-charcoal relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-luxury-gold/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-luxury-white/5 to-transparent"></div>
            <div class="absolute top-1/4 -right-64 w-[500px] h-[500px] bg-luxury-gold/[0.02] rounded-full blur-[128px] pointer-events-none"></div>
            <div class="absolute bottom-1/4 -left-64 w-[400px] h-[400px] bg-luxury-blue/[0.02] rounded-full blur-[128px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-24">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-luxury-gold/5 border border-luxury-gold/15 mb-8">
                        <span class="w-1.5 h-1.5 rounded-full bg-luxury-gold animate-pulse"></span>
                        <span class="text-luxury-gold text-[10px] font-bold tracking-[0.2em] uppercase">Why We Win</span>
                    </div>
                    <h2 class="text-5xl md:text-7xl font-serif mb-6">The Unfair<br><span class="italic text-transparent bg-clip-text bg-gradient-to-r from-luxury-gold via-amber-400 to-luxury-gold text-shadow-gold">Advantage.</span></h2>
                    <p class="text-lg text-luxury-white/40 max-w-2xl mx-auto leading-relaxed">Manual trading is biologically flawed. Fear, greed, and fatigue destroy edge. Our systems operate with cold, mathematical precision 24/5.</p>
                </div>

                <!-- Hero Feature Card -->
                <div class="mb-8 group">
                    <div class="relative rounded-2xl overflow-hidden border border-luxury-gold/10 hover:border-luxury-gold/25 transition-all duration-700 bg-gradient-to-br from-luxury-gold/[0.04] via-transparent to-luxury-gold/[0.02]">
                        <!-- Animated corner glow -->
                        <div class="absolute top-0 right-0 w-80 h-80 bg-luxury-gold/[0.06] rounded-full blur-[100px] -mr-40 -mt-40 group-hover:bg-luxury-gold/[0.12] transition-all duration-700"></div>
                        <div class="absolute bottom-0 left-0 w-60 h-60 bg-luxury-gold/[0.03] rounded-full blur-[80px] -ml-30 -mb-30 group-hover:bg-luxury-gold/[0.08] transition-all duration-700"></div>

                        <div class="relative z-10 p-10 md:p-14 grid md:grid-cols-2 gap-10 items-center">
                            <div>
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="relative w-14 h-14">
                                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-luxury-gold to-amber-600 animate-[spin_6s_linear_infinite] opacity-50"></div>
                                        <div class="absolute inset-[2px] rounded-[14px] bg-luxury-charcoal flex items-center justify-center">
                                            <svg class="w-7 h-7 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                    </div>
                                    <span class="text-luxury-gold/40 text-xs font-bold tracking-[0.3em] uppercase">Core Advantage</span>
                                </div>
                                <h3 class="text-3xl md:text-4xl font-serif mb-5 leading-tight">Zero Emotional<br><span class="text-luxury-gold">Variance</span></h3>
                                <p class="text-luxury-white/50 leading-relaxed text-[15px] mb-8">The AI never 'revenge trades' or hesitates. It executes the plan perfectly, every single time, eliminating the psychological pitfalls of manual execution.</p>
                                <div class="flex gap-6">
                                    <div>
                                        <div class="text-3xl font-serif text-luxury-gold">100%</div>
                                        <div class="text-[10px] text-luxury-white/30 uppercase tracking-widest mt-1">Discipline Rate</div>
                                    </div>
                                    <div class="w-px bg-luxury-white/10"></div>
                                    <div>
                                        <div class="text-3xl font-serif text-luxury-white">0</div>
                                        <div class="text-[10px] text-luxury-white/30 uppercase tracking-widest mt-1">Emotional Errors</div>
                                    </div>
                                    <div class="w-px bg-luxury-white/10"></div>
                                    <div>
                                        <div class="text-3xl font-serif text-luxury-white">24/5</div>
                                        <div class="text-[10px] text-luxury-white/30 uppercase tracking-widest mt-1">Execution</div>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden md:flex items-center justify-center">
                                <!-- Concentric rings visualization -->
                                <div class="relative w-64 h-64">
                                    <div class="absolute inset-0 rounded-full border border-luxury-gold/5 animate-[spin_20s_linear_infinite]"></div>
                                    <div class="absolute inset-6 rounded-full border border-luxury-gold/10 animate-[spin_15s_linear_infinite_reverse]"></div>
                                    <div class="absolute inset-12 rounded-full border border-luxury-gold/15 animate-[spin_10s_linear_infinite]"></div>
                                    <div class="absolute inset-[4.5rem] rounded-full border border-luxury-gold/20 animate-[spin_8s_linear_infinite_reverse]"></div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-luxury-gold/20 to-luxury-gold/5 flex items-center justify-center backdrop-blur-sm border border-luxury-gold/20">
                                            <svg class="w-8 h-8 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                        </div>
                                    </div>
                                    <!-- Floating dots on rings -->
                                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-2 h-2 rounded-full bg-luxury-gold/60 shadow-[0_0_12px_rgba(212,175,55,0.4)]"></div>
                                    <div class="absolute bottom-6 right-6 w-1.5 h-1.5 rounded-full bg-luxury-gold/40"></div>
                                    <div class="absolute top-12 left-4 w-1.5 h-1.5 rounded-full bg-luxury-gold/30"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Three feature cards -->
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Card 2: 24/7 Market Vigilance -->
                    <div class="group relative rounded-2xl overflow-hidden border border-luxury-white/5 hover:border-luxury-blue/20 transition-all duration-500 bg-gradient-to-b from-luxury-blue/[0.03] to-transparent">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-luxury-blue/[0.05] rounded-full blur-[80px] -mr-20 -mt-20 group-hover:bg-luxury-blue/[0.12] transition-all duration-700"></div>
                        <div class="relative z-10 p-8 md:p-10">
                            <div class="flex items-center justify-between mb-8">
                                <div class="relative w-12 h-12">
                                    <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-luxury-blue to-blue-600 opacity-40 group-hover:opacity-70 transition-opacity"></div>
                                    <div class="absolute inset-[2px] rounded-[10px] bg-luxury-charcoal flex items-center justify-center">
                                        <svg class="w-5 h-5 text-luxury-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    </div>
                                </div>
                                <span class="text-luxury-blue/30 text-[10px] font-bold tracking-[0.2em] uppercase">Always On</span>
                            </div>
                            <h3 class="text-xl font-serif mb-3 group-hover:text-luxury-blue transition-colors">24/7 Market Vigilance</h3>
                            <p class="text-luxury-white/40 text-sm leading-relaxed mb-8">We capture moves during the London and Asian sessions while you sleep. Our algorithms monitor 28 currency pairs simultaneously.</p>
                            <div class="flex items-center gap-4 pt-6 border-t border-luxury-white/5">
                                <div>
                                    <div class="text-2xl font-serif text-luxury-blue">28</div>
                                    <div class="text-[9px] text-luxury-white/25 uppercase tracking-widest mt-0.5">Pairs Monitored</div>
                                </div>
                                <div class="w-px h-8 bg-luxury-white/5"></div>
                                <div>
                                    <div class="text-2xl font-serif text-luxury-white/80">3</div>
                                    <div class="text-[9px] text-luxury-white/25 uppercase tracking-widest mt-0.5">Sessions Covered</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Prop Firm Optimized -->
                    <div class="group relative rounded-2xl overflow-hidden border border-luxury-white/5 hover:border-luxury-magenta/20 transition-all duration-500 bg-gradient-to-b from-luxury-magenta/[0.03] to-transparent">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-luxury-magenta/[0.05] rounded-full blur-[80px] -mr-20 -mt-20 group-hover:bg-luxury-magenta/[0.12] transition-all duration-700"></div>
                        <div class="relative z-10 p-8 md:p-10">
                            <div class="flex items-center justify-between mb-8">
                                <div class="relative w-12 h-12">
                                    <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-luxury-magenta to-pink-600 opacity-40 group-hover:opacity-70 transition-opacity"></div>
                                    <div class="absolute inset-[2px] rounded-[10px] bg-luxury-charcoal flex items-center justify-center">
                                        <svg class="w-5 h-5 text-luxury-magenta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                </div>
                                <span class="text-luxury-magenta/30 text-[10px] font-bold tracking-[0.2em] uppercase">Compliant</span>
                            </div>
                            <h3 class="text-xl font-serif mb-3 group-hover:text-luxury-magenta transition-colors">Prop Firm Optimized</h3>
                            <p class="text-luxury-white/40 text-sm leading-relaxed mb-8">Specifically calibrated for the drawdown rules of major prop firms (FTMO, FundedNext). We manage risk while hitting profit targets.</p>
                            <div class="flex items-center gap-4 pt-6 border-t border-luxury-white/5">
                                <div>
                                    <div class="text-2xl font-serif text-luxury-magenta">&lt;5%</div>
                                    <div class="text-[9px] text-luxury-white/25 uppercase tracking-widest mt-0.5">Max Drawdown</div>
                                </div>
                                <div class="w-px h-8 bg-luxury-white/5"></div>
                                <div>
                                    <div class="text-2xl font-serif text-luxury-white/80">FTMO</div>
                                    <div class="text-[9px] text-luxury-white/25 uppercase tracking-widest mt-0.5">Compatible</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Institutional Risk Models -->
                    <div class="group relative rounded-2xl overflow-hidden border border-luxury-white/5 hover:border-emerald-500/20 transition-all duration-500 bg-gradient-to-b from-emerald-500/[0.03] to-transparent">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-emerald-500/[0.05] rounded-full blur-[80px] -mr-20 -mt-20 group-hover:bg-emerald-500/[0.12] transition-all duration-700"></div>
                        <div class="relative z-10 p-8 md:p-10">
                            <div class="flex items-center justify-between mb-8">
                                <div class="relative w-12 h-12">
                                    <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 opacity-40 group-hover:opacity-70 transition-opacity"></div>
                                    <div class="absolute inset-[2px] rounded-[10px] bg-luxury-charcoal flex items-center justify-center">
                                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                </div>
                                <span class="text-emerald-400/30 text-[10px] font-bold tracking-[0.2em] uppercase">Protected</span>
                            </div>
                            <h3 class="text-xl font-serif mb-3 group-hover:text-emerald-400 transition-colors">Institutional Risk Models</h3>
                            <p class="text-luxury-white/40 text-sm leading-relaxed mb-8">Dynamic position sizing based on volatility (ATR) and account equity. We never risk more than 1-2% per trade setup.</p>
                            <div class="flex items-center gap-4 pt-6 border-t border-luxury-white/5">
                                <div>
                                    <div class="text-2xl font-serif text-emerald-400">1-2%</div>
                                    <div class="text-[9px] text-luxury-white/25 uppercase tracking-widest mt-0.5">Max Risk/Trade</div>
                                </div>
                                <div class="w-px h-8 bg-luxury-white/5"></div>
                                <div>
                                    <div class="text-2xl font-serif text-luxury-white/80">ATR</div>
                                    <div class="text-[9px] text-luxury-white/25 uppercase tracking-widest mt-0.5">Volatility Based</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Industry Recognition -->
        <div class="py-32 bg-luxury-black overflow-hidden">
            <!-- "As Featured In" Logo Bar -->
            <div class="max-w-5xl mx-auto px-4 mb-16">
                <p class="text-center text-luxury-white/30 text-xs uppercase tracking-[0.3em] mb-8">As Featured In</p>
                <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
                    <div class="text-luxury-white/20 hover:text-luxury-white/50 transition-colors">
                        <span class="font-serif text-2xl tracking-widest">FORBES</span>
                    </div>
                    <div class="text-luxury-white/20 hover:text-luxury-white/50 transition-colors">
                        <span class="font-serif text-2xl tracking-widest">BLOOMBERG</span>
                    </div>
                    <div class="text-luxury-white/20 hover:text-luxury-white/50 transition-colors">
                        <span class="font-serif text-xl tracking-wider">CoinDesk</span>
                    </div>
                    <div class="text-luxury-white/20 hover:text-luxury-white/50 transition-colors">
                        <span class="font-serif text-xl tracking-wider">TechCrunch</span>
                    </div>
                    <div class="text-luxury-white/20 hover:text-luxury-white/50 transition-colors">
                        <span class="font-serif text-xl tracking-wider">CNBC</span>
                    </div>
                </div>
            </div>

            <div class="text-center mb-20">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-luxury-gold/5 border border-luxury-gold/15 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-luxury-gold animate-pulse"></span>
                    <span class="text-luxury-gold text-[10px] font-bold tracking-[0.2em] uppercase">Industry Leaders</span>
                </div>
                <h2 class="text-4xl md:text-6xl font-serif">Industry <span class="italic text-luxury-gold text-shadow-gold">Recognition</span></h2>
                <p class="text-luxury-white/40 mt-4 max-w-xl mx-auto">What the world's most influential voices in finance and technology are saying.</p>
            </div>

            <!-- Marquee Row 1 (Left) -->
            <div class="marquee-container mb-8">
                <div class="marquee-content animate-marquee-left flex gap-8">
                    <!-- CZ — Binance -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-gold/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-[#F0B90B] to-[#F0B90B]/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/cz.png" alt="Changpeng Zhao" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Changpeng Zhao</div>
                                    <div class="text-[10px] text-[#F0B90B] uppercase tracking-wider">Founder & CEO, Binance</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"AI-driven trading is the future of finance. Platforms like Real AI Trading are leading the charge in making institutional-grade algorithms accessible to everyone."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-[#F0B90B]/10 text-[#F0B90B] text-[10px] uppercase tracking-widest border border-[#F0B90B]/20 font-bold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </div>
                        </div>
                    </div>

                    <!-- Forbes -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-gold/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-luxury-white to-luxury-white/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/forbes.png" alt="Forbes" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Forbes</div>
                                    <div class="text-[10px] text-luxury-white/60 uppercase tracking-wider">Editorial Feature</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"Real AI Trading represents a new class of fintech — where deep learning meets quantitative execution. Their sub-millisecond latency infrastructure is what sets them apart."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-luxury-white/5 text-luxury-white/60 text-[10px] uppercase tracking-widest border border-luxury-white/10 font-bold">
                                Forbes Digital Assets · 2025
                            </div>
                        </div>
                    </div>

                    <!-- Chamath Palihapitiya -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-blue/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-luxury-blue to-luxury-blue/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/chamath.png" alt="Chamath Palihapitiya" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Chamath Palihapitiya</div>
                                    <div class="text-[10px] text-luxury-blue uppercase tracking-wider">CEO, Social Capital</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"The alpha generation capability here is unlike anything I've seen from traditional quant funds. This is what happens when Silicon Valley meets Wall Street."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-luxury-blue/10 text-luxury-blue text-[10px] uppercase tracking-widest border border-luxury-blue/20 font-bold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </div>
                        </div>
                    </div>

                    <!-- Raoul Pal -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-gold/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-luxury-gold to-luxury-gold/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/raoul-pal.png" alt="Raoul Pal" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Raoul Pal</div>
                                    <div class="text-[10px] text-luxury-gold uppercase tracking-wider">CEO, Real Vision</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"The convergence of AI and crypto trading is the most exciting space in finance right now. Real AI Trading's risk engine handles drawdown better than most institutional desks."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-luxury-gold/10 text-luxury-gold text-[10px] uppercase tracking-widest border border-luxury-gold/20 font-bold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </div>
                        </div>
                    </div>

                    <!-- Cathie Wood -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-magenta/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-luxury-magenta to-luxury-magenta/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/cathie-wood.png" alt="Cathie Wood" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Cathie Wood</div>
                                    <div class="text-[10px] text-luxury-magenta uppercase tracking-wider">CEO, ARK Invest</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"AI-powered trading systems will dominate the next decade. Real AI Trading's neural network approach to risk management is exactly the kind of disruptive innovation we look for."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-luxury-magenta/10 text-luxury-magenta text-[10px] uppercase tracking-widest border border-luxury-magenta/20 font-bold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </div>
                        </div>
                    </div>

                    <!-- Michael Saylor -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-gold/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-[#FF9500] to-[#FF9500]/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/michael-saylor.png" alt="Michael Saylor" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Michael Saylor</div>
                                    <div class="text-[10px] text-[#FF9500] uppercase tracking-wider">Chairman, MicroStrategy</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"The future of Bitcoin accumulation is algorithmic. Platforms with this level of execution precision and risk control are exactly what institutional capital needs."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-[#FF9500]/10 text-[#FF9500] text-[10px] uppercase tracking-widest border border-[#FF9500]/20 font-bold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Marquee Row 2 (Right) -->
            <div class="marquee-container">
                <div class="marquee-content animate-marquee-right flex gap-8">
                    <!-- Mark Cuban -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-blue/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-luxury-blue to-luxury-blue/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/mark-cuban.png" alt="Mark Cuban" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Mark Cuban</div>
                                    <div class="text-[10px] text-luxury-blue uppercase tracking-wider">Billionaire Investor</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"What excites me is the transparency — you can see every trade, every risk metric in real time. This isn't a black box; it's a glass box with bulletproof walls."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-luxury-blue/10 text-luxury-blue text-[10px] uppercase tracking-widest border border-luxury-blue/20 font-bold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </div>
                        </div>
                    </div>

                    <!-- Bloomberg -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-gold/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-luxury-white to-luxury-white/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/bloomberg.png" alt="Bloomberg" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Bloomberg Markets</div>
                                    <div class="text-[10px] text-luxury-white/60 uppercase tracking-wider">Market Analysis</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"Among the wave of AI trading startups, Real AI Trading stands out for its institutional infrastructure — colocated servers in NY4, and a risk engine that rivals prime brokerage systems."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-luxury-white/5 text-luxury-white/60 text-[10px] uppercase tracking-widest border border-luxury-white/10 font-bold">
                                Bloomberg Terminal · Q1 2025
                            </div>
                        </div>
                    </div>

                    <!-- Vitalik Buterin -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-[#627EEA]/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-[#627EEA] to-[#627EEA]/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/vitalik.png" alt="Vitalik Buterin" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Vitalik Buterin</div>
                                    <div class="text-[10px] text-[#627EEA] uppercase tracking-wider">Co-Founder, Ethereum</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"The application of transformer models to on-chain data analysis is genuinely interesting. The correlation tracking across 200+ pairs shows serious engineering depth."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-[#627EEA]/10 text-[#627EEA] text-[10px] uppercase tracking-widest border border-[#627EEA]/20 font-bold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </div>
                        </div>
                    </div>

                    <!-- Brian Armstrong -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-blue/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-[#0052FF] to-[#0052FF]/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/brian-armstrong.png" alt="Brian Armstrong" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Brian Armstrong</div>
                                    <div class="text-[10px] text-[#0052FF] uppercase tracking-wider">CEO, Coinbase</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"More institutional allocators are routing through AI-driven platforms. The execution quality and compliance framework here meets the bar for regulated capital."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-[#0052FF]/10 text-[#0052FF] text-[10px] uppercase tracking-widest border border-[#0052FF]/20 font-bold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </div>
                        </div>
                    </div>

                    <!-- CoinDesk Research -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-gold/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-luxury-gold to-luxury-gold/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/coindesk.png" alt="CoinDesk" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">CoinDesk Research</div>
                                    <div class="text-[10px] text-luxury-gold uppercase tracking-wider">Industry Report</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"In our review of 47 AI trading platforms, Real AI Trading scored highest for risk-adjusted returns and infrastructure reliability. A serious contender for institutional adoption."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-luxury-gold/10 text-luxury-gold text-[10px] uppercase tracking-widest border border-luxury-gold/20 font-bold">
                                CoinDesk Annual Report · 2025
                            </div>
                        </div>
                    </div>

                    <!-- Arthur Hayes -->
                    <div class="glass-card p-6 rounded-xl w-[360px] flex-shrink-0 border border-luxury-white/5 flex flex-col justify-between group hover:border-luxury-magenta/20 transition-colors">
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-12 h-12 flex-shrink-0">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-luxury-magenta to-luxury-magenta/60"></div>
                                    <div class="absolute inset-[1px] rounded-full bg-luxury-black overflow-hidden">
                                        <img src="/images/leaders/arthur-hayes.png" alt="Arthur Hayes" class="w-full h-full object-cover object-center">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-luxury-white font-serif leading-tight">Arthur Hayes</div>
                                    <div class="text-[10px] text-luxury-magenta uppercase tracking-wider">Co-Founder, BitMEX</div>
                                </div>
                            </div>
                            <p class="text-luxury-white/60 text-sm italic leading-relaxed">"Speed kills in this market — and sub-millisecond execution from colocated servers is the only way to play. This is real infrastructure, not a MetaTrader plugin."</p>
                        </div>
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-luxury-magenta/10 text-luxury-magenta text-[10px] uppercase tracking-widest border border-luxury-magenta/20 font-bold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-luxury-charcoal border-t border-luxury-white/5 pt-20 pb-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                    <div class="col-span-1 md:col-span-1">
                        <a href="/" class="flex items-center gap-2 mb-6">
                            <img src="/images/logo.png" alt="Logo" class="h-8 w-auto opacity-80">
                            <span class="font-serif text-lg tracking-widest text-luxury-white">REAL<span class="text-luxury-gold">AI</span></span>
                        </a>
                        <div class="space-y-3">
                            <a href="https://www.google.com/maps/place/121+Franklin+St,+Clarksville,+TN+37040,+USA/@36.527705,-87.3621379,16z/data=!4m6!3m5!1s0x8864d9b7bd962c93:0xfbb1926d615e358b!8m2!3d36.527705!4d-87.359563!16s%2Fg%2F11rg60k0gb?entry=ttu&g_ep=EgoyMDI1MTEyMy4xIKXMDSoASAFQAw%3D%3D" 
                               target="_blank"
                               rel="noopener noreferrer"
                               class="text-luxury-white/60 hover:text-luxury-gold transition-colors text-sm leading-relaxed block">
                                121 Franklin St, Clarksville, Tennessee,<br>37040, United States
                            </a>
                            <a href="mailto:support@realaitrading.com" 
                               class="text-luxury-white/60 hover:text-luxury-gold transition-colors text-sm block">
                                support@realaitrading.com
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-6">Platform</h4>
                        <ul class="space-y-4 text-sm text-luxury-white/60">
                            <li><a href="{{ route('markets') }}" class="hover:text-luxury-gold transition-colors">Markets</a></li>
                            <li><a href="{{ route('technology') }}" class="hover:text-luxury-gold transition-colors">Technology</a></li>
                            <li><a href="{{ route('security') }}" class="hover:text-luxury-gold transition-colors">Security</a></li>
                            <li><a href="{{ route('api') }}" class="hover:text-luxury-gold transition-colors">API</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-6">Company</h4>
                        <ul class="space-y-4 text-sm text-luxury-white/60">
                            <li><a href="{{ route('about') }}" class="hover:text-luxury-gold transition-colors">About Us</a></li>
                            <li><a href="{{ route('careers') }}" class="hover:text-luxury-gold transition-colors">Careers</a></li>
                            <li><a href="{{ route('legal') }}" class="hover:text-luxury-gold transition-colors">Legal</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-luxury-gold transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-6">Legal</h4>
                        <p class="text-luxury-white/30 text-xs leading-relaxed">
                            Trading involves risk. Past performance is not indicative of future results. Real AI Trading is a registered trademark.
                        </p>
                    </div>
                </div>
                
                <!-- Copyright and Social -->
                <div class="border-t border-luxury-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-luxury-white/30 text-xs">© {{ date('Y') }} Real AI Trading. All rights reserved.</p>
                    <div class="flex gap-6">
                        <a href="#" class="text-luxury-white/30 hover:text-luxury-gold transition-colors"><span class="sr-only">Twitter</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg></a>
                        <a href="#" class="text-luxury-white/30 hover:text-luxury-gold transition-colors"><span class="sr-only">LinkedIn</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- GSAP Animations -->
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                gsap.registerPlugin(ScrollTrigger);

                // Hero Animation Timeline
                const tl = gsap.timeline({ defaults: { ease: "power4.out" } });

                // 1. Text Reveal (Staggered Lines)
                tl.to(".hero-text-line", {
                    y: 0,
                    duration: 1.5,
                    stagger: 0.2,
                    delay: 0.5
                })
                // 2. Elements Fade In (Status, Subhead, Buttons)
                .to(".hero-element", {
                    y: 0,
                    opacity: 1,
                    duration: 1,
                    stagger: 0.1
                }, "-=1");

                // Scroll Animations for Sections
                gsap.utils.toArray('.glass-card').forEach((card, i) => {
                    gsap.from(card, {
                        scrollTrigger: {
                            trigger: card,
                            start: "top 85%",
                        },
                        y: 50,
                        opacity: 0,
                        duration: 0.8,
                        delay: i * 0.1
                    });
                });
            });
        </script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6920d8a33430481966e58d83/1jak4sfvk';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    </body>
</html>
