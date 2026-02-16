<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="font-serif text-2xl text-luxury-white">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <button onclick="document.getElementById('deposit-modal').showModal()" class="flex-1 md:flex-none justify-center px-5 py-2.5 bg-gradient-to-r from-luxury-gold to-luxury-gold-light text-luxury-black text-xs font-bold rounded-xl hover:shadow-lg hover:shadow-luxury-gold/20 transition-all duration-300 flex items-center gap-2 group">
                    <svg class="w-4 h-4 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Deposit
                </button>
                <button onclick="document.getElementById('withdraw-modal').showModal()" class="flex-1 md:flex-none justify-center px-5 py-2.5 bg-luxury-white/5 text-luxury-white text-xs font-bold rounded-xl hover:bg-luxury-white/10 border border-luxury-white/10 transition-all duration-300 flex items-center gap-2 group">
                    <svg class="w-4 h-4 group-hover:translate-y-0.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Withdraw
                </button>
            </div>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl mx-auto max-w-7xl animate-slide-down" x-data="{ show: true }" x-show="show" x-transition>
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-sm text-green-200 flex-1">{{ session('success') }}</p>
                <button @click="show = false" class="text-green-400 hover:text-green-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Particle Canvas Background -->
    <canvas id="dashboard-particles" class="fixed inset-0 pointer-events-none z-0" style="opacity: 0.4;"></canvas>

    <div class="py-8 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- ========================================
                 LIVE MARKET TICKER
                 ======================================== -->
            <div class="overflow-hidden rounded-xl bg-luxury-white/[0.02] border border-luxury-white/5 backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 px-4 py-2.5 bg-luxury-gold/10 border-r border-luxury-white/5">
                        <span class="text-[10px] text-luxury-gold font-bold uppercase tracking-widest">Live</span>
                    </div>
                    <div id="dash-ticker-track" class="ticker-track flex-1 overflow-hidden">
                        <div id="dash-ticker-content" class="ticker-content flex items-center py-2.5 px-4 whitespace-nowrap text-xs">
                            <span class="text-luxury-white/40">Loading live prices...</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================
                 WELCOME BANNER with animated background
                 ======================================== -->
            <div class="welcome-banner rounded-2xl p-6 md:p-8 overflow-hidden reveal-section" style="animation-delay: 0.1s;">
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute -top-20 -right-20 w-60 h-60 rounded-full bg-luxury-gold/[0.04] blur-3xl float-orb"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 rounded-full bg-luxury-blue/[0.04] blur-3xl float-orb" style="animation-delay: -3s;"></div>
                </div>
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <p class="text-xs text-luxury-gold uppercase tracking-[0.2em] font-semibold mb-2 flex items-center gap-2">
                            <span class="inline-block w-4 h-px bg-luxury-gold/50"></span>
                            Welcome back
                        </p>
                        <h1 class="text-2xl md:text-3xl font-serif text-luxury-white">
                            {{ Auth::user()->name }}
                        </h1>
                        <p class="text-sm text-luxury-white/50 mt-1 max-w-md">
                            @if((Auth::user()->accountBalance->current_balance ?? 0) > 0)
                                Your AI trading engine is actively optimizing your portfolio.
                            @else
                                Your AI trading engine is awaiting capital deployment.
                            @endif
                        </p>
                    </div>
                    <div class="flex items-center gap-6">
                        <!-- AI Status Indicator -->
                        <div class="hidden md:flex items-center gap-3 px-4 py-3 rounded-xl bg-luxury-white/[0.03] border border-luxury-white/5">
                            <div class="relative">
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                <div class="absolute inset-0 w-3 h-3 rounded-full bg-green-500 animate-ping opacity-40"></div>
                            </div>
                            <div>
                                <div class="text-[10px] text-luxury-white/40 uppercase tracking-widest">Engine</div>
                                <div class="text-xs font-bold text-green-400" id="ai-status-text">Processing...</div>
                            </div>
                        </div>
                        <div class="hidden md:block text-right">
                            <div class="text-[10px] text-luxury-white/40 uppercase tracking-widest mb-0.5">Member Since</div>
                            <div class="text-sm text-luxury-white/60 font-medium">{{ Auth::user()->created_at->format('M Y') }}</div>
                        </div>
                    </div>
                </div>
                <div class="shimmer-line h-px w-full mt-6 rounded-full"></div>
            </div>

            <!-- ========================================
                 STAT CARDS with animated counters
                 ======================================== -->
            <div class="grid md:grid-cols-3 gap-5">
                <!-- Total Equity -->
                <div class="dashboard-card stat-glow-gold p-6 rounded-2xl reveal-section" style="animation-delay: 0.2s;">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-5">
                            <span class="text-luxury-white/40 text-[11px] uppercase tracking-[0.15em] font-medium">Total Equity</span>
                            <div class="w-10 h-10 rounded-xl bg-luxury-gold/10 flex items-center justify-center float-orb">
                                <svg class="w-5 h-5 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </div>
                        </div>
                        <div class="text-4xl font-serif text-luxury-white mb-3">
                            $<span class="counter" data-target="{{ Auth::user()->accountBalance->current_balance ?? 0 }}">0.00</span>
                        </div>
                        <div class="flex items-center gap-2">
                            @if(Auth::user()->accountBalance && Auth::user()->accountBalance->current_balance > 0)
                                @php
                                    $profit = Auth::user()->accountBalance->current_balance - Auth::user()->accountBalance->principal_amount;
                                    $profitPercent = Auth::user()->accountBalance->principal_amount > 0 
                                        ? ($profit / Auth::user()->accountBalance->principal_amount) * 100 
                                        : 0;
                                @endphp
                                <div class="flex items-center gap-1 px-2 py-0.5 rounded-full {{ $profit >= 0 ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($profit >= 0)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                    <span class="text-xs font-bold">{{ $profit >= 0 ? '+' : '' }}{{ number_format($profitPercent, 2) }}%</span>
                                </div>
                                <span class="text-[11px] text-luxury-white/30">all time</span>
                            @else
                                <span class="text-xs text-luxury-white/30 italic">No active positions</span>
                            @endif
                        </div>
                        <!-- Mini sparkline -->
                        <div class="mt-4 h-8 opacity-40">
                            <canvas class="mini-sparkline w-full h-full" data-color="#D4AF37" data-values="20,35,25,45,30,55,40,60,50,65,55,70"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Principal Capital -->
                <div class="dashboard-card stat-glow-blue p-6 rounded-2xl reveal-section" style="animation-delay: 0.3s;">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-5">
                            <span class="text-luxury-white/40 text-[11px] uppercase tracking-[0.15em] font-medium">Principal</span>
                            <div class="w-10 h-10 rounded-xl bg-luxury-blue/10 flex items-center justify-center float-orb" style="animation-delay: -2s;">
                                <svg class="w-5 h-5 text-luxury-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                        <div class="text-4xl font-serif text-luxury-white mb-3">
                            $<span class="counter" data-target="{{ Auth::user()->accountBalance->principal_amount ?? 0 }}">0.00</span>
                        </div>
                        <div class="text-xs text-luxury-white/30">Deployed Capital</div>
                        <div class="mt-4 h-8 opacity-40">
                            <canvas class="mini-sparkline w-full h-full" data-color="#3B82F6" data-values="10,15,20,25,30,35,40,40,40,40,40,40"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Net Profit -->
                <div class="dashboard-card stat-glow-green p-6 rounded-2xl reveal-section" style="animation-delay: 0.4s;">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-5">
                            <span class="text-luxury-white/40 text-[11px] uppercase tracking-[0.15em] font-medium">Net Profit</span>
                            <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center float-orb" style="animation-delay: -4s;">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                        </div>
                        @php
                            $netProfit = (Auth::user()->accountBalance->current_balance ?? 0) - (Auth::user()->accountBalance->principal_amount ?? 0);
                        @endphp
                        <div class="text-4xl font-serif {{ $netProfit >= 0 ? 'text-green-400' : 'text-red-400' }} mb-3">
                            {{ $netProfit >= 0 ? '+' : '' }}$<span class="counter" data-target="{{ abs($netProfit) }}">0.00</span>
                        </div>
                        <div class="text-xs text-luxury-white/30">Total Algorithmic Return</div>
                        <div class="mt-4 h-8 opacity-40">
                            <canvas class="mini-sparkline w-full h-full" data-color="#22C55E" data-values="5,8,6,12,10,18,15,22,20,28,25,30"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================
                 PORTFOLIO PERFORMANCE CHART
                 ======================================== -->
            <div class="dashboard-card p-6 md:p-8 rounded-2xl reveal-section" style="animation-delay: 0.5s;">
                <div class="relative z-10">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
                        <div>
                            <h3 class="text-lg font-serif text-luxury-white flex items-center gap-2">
                                Global AI Performance
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-green-500/10 border border-green-500/20 text-[10px] text-green-400 font-bold uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                    Live
                                </span>
                            </h3>
                            <p class="text-xs text-luxury-white/40 mt-1">Sovereign Engine — cumulative portfolio returns</p>
                        </div>
                        <div class="flex items-center gap-1 bg-luxury-white/5 rounded-full p-1" id="period-selector">
                            <button class="period-pill active" data-period="1W">1W</button>
                            <button class="period-pill" data-period="1M">1M</button>
                            <button class="period-pill" data-period="3M">3M</button>
                            <button class="period-pill" data-period="1Y">1Y</button>
                            <button class="period-pill" data-period="ALL">All</button>
                        </div>
                    </div>
                    <div class="h-[300px] md:h-[350px] w-full relative">
                        <canvas id="portfolio-chart"></canvas>
                    </div>
                </div>
            </div>

            <!-- ========================================
                 AI ENGINE STATUS + ACTIVITY FEED
                 ======================================== -->
            <div class="grid lg:grid-cols-5 gap-5">
                
                <!-- AI Engine Status (3/5) -->
                <div class="lg:col-span-3 dashboard-card p-6 md:p-8 rounded-2xl reveal-section" style="animation-delay: 0.6s;">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-luxury-blue/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-luxury-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-serif text-luxury-white">AI Engine Status</h3>
                                    <p class="text-[11px] text-luxury-white/40">Real-time risk & performance analysis</p>
                                </div>
                            </div>
                            <!-- Animated processing indicator -->
                            <div class="flex items-center gap-1.5">
                                <div class="w-1 h-3 bg-luxury-blue/60 rounded-full animate-equalizer" style="animation-delay:0s;"></div>
                                <div class="w-1 h-5 bg-luxury-blue/60 rounded-full animate-equalizer" style="animation-delay:0.15s;"></div>
                                <div class="w-1 h-4 bg-luxury-blue/60 rounded-full animate-equalizer" style="animation-delay:0.3s;"></div>
                                <div class="w-1 h-6 bg-luxury-blue/60 rounded-full animate-equalizer" style="animation-delay:0.45s;"></div>
                                <div class="w-1 h-3 bg-luxury-blue/60 rounded-full animate-equalizer" style="animation-delay:0.6s;"></div>
                            </div>
                        </div>

                        <!-- AI Metrics Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Confidence Score -->
                            <div class="metric-card flex flex-col items-center text-center p-4 rounded-xl bg-luxury-white/[0.02] border border-luxury-white/5 hover:border-luxury-blue/20 transition-all duration-300 group cursor-default">
                                <div class="relative w-20 h-20 mb-3">
                                    <svg class="circular-progress w-full h-full" viewBox="0 0 80 80">
                                        <circle cx="40" cy="40" r="35" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="5"/>
                                        <circle class="progress-ring" cx="40" cy="40" r="35" fill="none" stroke="#3B82F6" stroke-width="5" stroke-linecap="round" 
                                                stroke-dasharray="220" stroke-dashoffset="220" data-target="3.5"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-lg font-bold text-luxury-blue group-hover:scale-110 transition-transform">98.4</span>
                                    </div>
                                </div>
                                <div class="text-[10px] text-luxury-white/40 uppercase tracking-widest">Confidence</div>
                            </div>

                            <!-- Drawdown Risk -->
                            <div class="metric-card flex flex-col items-center text-center p-4 rounded-xl bg-luxury-white/[0.02] border border-luxury-white/5 hover:border-green-500/20 transition-all duration-300 group cursor-default">
                                <div class="relative w-20 h-20 mb-3">
                                    <svg class="circular-progress w-full h-full" viewBox="0 0 80 80">
                                        <circle cx="40" cy="40" r="35" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="5"/>
                                        <circle class="progress-ring" cx="40" cy="40" r="35" fill="none" stroke="#22C55E" stroke-width="5" stroke-linecap="round"
                                                stroke-dasharray="220" stroke-dashoffset="220" data-target="219"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-lg font-bold text-green-400 group-hover:scale-110 transition-transform">0.42</span>
                                    </div>
                                </div>
                                <div class="text-[10px] text-luxury-white/40 uppercase tracking-widest">Drawdown %</div>
                            </div>

                            <!-- Sharpe Ratio -->
                            <div class="metric-card flex flex-col items-center text-center p-4 rounded-xl bg-luxury-white/[0.02] border border-luxury-white/5 hover:border-luxury-gold/20 transition-all duration-300 group cursor-default">
                                <div class="relative w-20 h-20 mb-3">
                                    <svg class="circular-progress w-full h-full" viewBox="0 0 80 80">
                                        <circle cx="40" cy="40" r="35" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="5"/>
                                        <circle class="progress-ring" cx="40" cy="40" r="35" fill="none" stroke="#D4AF37" stroke-width="5" stroke-linecap="round"
                                                stroke-dasharray="220" stroke-dashoffset="220" data-target="82"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-lg font-bold text-luxury-gold group-hover:scale-110 transition-transform">3.15</span>
                                    </div>
                                </div>
                                <div class="text-[10px] text-luxury-white/40 uppercase tracking-widest">Sharpe Ratio</div>
                            </div>

                            <!-- Active Hedges -->
                            <div class="metric-card flex flex-col items-center text-center p-4 rounded-xl bg-luxury-white/[0.02] border border-luxury-white/5 hover:border-luxury-magenta/20 transition-all duration-300 group cursor-default">
                                <div class="relative w-20 h-20 mb-3">
                                    <svg class="circular-progress w-full h-full" viewBox="0 0 80 80">
                                        <circle cx="40" cy="40" r="35" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="5"/>
                                        <circle class="progress-ring" cx="40" cy="40" r="35" fill="none" stroke="#E879F9" stroke-width="5" stroke-linecap="round"
                                                stroke-dasharray="220" stroke-dashoffset="220" data-target="165"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-lg font-bold text-luxury-magenta group-hover:scale-110 transition-transform">4</span>
                                    </div>
                                </div>
                                <div class="text-[10px] text-luxury-white/40 uppercase tracking-widest">Active Hedges</div>
                            </div>
                        </div>

                        <!-- AI Log Feed -->
                        <div class="mt-6 pt-5 border-t border-luxury-white/5">
                            <div class="flex items-center gap-2 text-[11px] text-luxury-white/30 font-mono overflow-hidden h-5" id="ai-log-feed">
                                <span class="text-luxury-blue">▸</span>
                                <span id="ai-log-text">Initializing neural network...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Feed (2/5) -->
                <div class="lg:col-span-2 dashboard-card p-6 rounded-2xl reveal-section" style="animation-delay: 0.7s;">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-lg font-serif text-luxury-white">Activity</h3>
                            <span class="text-[10px] text-luxury-white/30 uppercase tracking-widest">Recent</span>
                        </div>

                        <div class="space-y-2.5">
                            @php
                                // Gather all activities into one unified feed
                                $activities = collect();

                                // Pending withdrawals
                                foreach(Auth::user()->withdrawalRequests()->whereIn('status', ['pending', 'approved', 'rejected'])->latest()->take(5)->get() as $w) {
                                    $activities->push([
                                        'type' => 'withdrawal_' . $w->status,
                                        'amount' => $w->amount,
                                        'date' => $w->updated_at ?? $w->created_at,
                                        'created_at' => $w->created_at,
                                    ]);
                                }

                                // Transaction logs (deposits, withdrawals completed, ROI, rejections)
                                foreach(Auth::user()->transactionLogs->sortByDesc('created_at')->take(10) as $log) {
                                    $activities->push([
                                        'type' => $log->type,
                                        'amount' => $log->amount,
                                        'date' => $log->created_at,
                                        'created_at' => $log->created_at,
                                        'meta' => $log->meta,
                                    ]);
                                }

                                // Sort by date descending, take 8 unique
                                $activities = $activities->sortByDesc('created_at')->unique(function ($item) {
                                    return $item['type'] . '_' . $item['created_at']->timestamp;
                                })->take(8);
                            @endphp

                            @forelse($activities as $activity)
                                @php
                                    $typeConfig = match($activity['type']) {
                                        'deposit' => ['icon' => 'M19 14l-7 7m0 0l-7-7m7 7V3', 'color' => 'green', 'label' => 'Deposit Confirmed', 'prefix' => '+'],
                                        'deposit_rejected' => ['icon' => 'M6 18L18 6M6 6l12 12', 'color' => 'red', 'label' => 'Deposit Rejected', 'prefix' => ''],
                                        'withdrawal' => ['icon' => 'M5 10l7-7m0 0l7 7m-7-7v18', 'color' => 'green', 'label' => 'Withdrawal Complete', 'prefix' => '-'],
                                        'withdrawal_pending' => ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'yellow', 'label' => 'Withdrawal Pending', 'prefix' => '-'],
                                        'withdrawal_approved' => ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'green', 'label' => 'Withdrawal Approved', 'prefix' => '-'],
                                        'withdrawal_rejected' => ['icon' => 'M6 18L18 6M6 6l12 12', 'color' => 'red', 'label' => 'Withdrawal Rejected', 'prefix' => ''],
                                        'roi_growth' => ['icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'color' => 'blue', 'label' => 'AI Return', 'prefix' => '+'],
                                        default => ['icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'gray', 'label' => ucfirst(str_replace('_', ' ', $activity['type'])), 'prefix' => ''],
                                    };
                                    $colorClasses = match($typeConfig['color']) {
                                        'green' => 'bg-green-500/10 text-green-400',
                                        'red' => 'bg-red-500/10 text-red-400',
                                        'yellow' => 'bg-yellow-500/10 text-yellow-400',
                                        'blue' => 'bg-luxury-blue/10 text-luxury-blue',
                                        default => 'bg-luxury-white/10 text-luxury-white/40',
                                    };
                                    $amountColor = match($typeConfig['color']) {
                                        'green' => 'text-green-400',
                                        'red' => 'text-red-400',
                                        'yellow' => 'text-yellow-400',
                                        'blue' => 'text-luxury-blue',
                                        default => 'text-luxury-white/60',
                                    };
                                    $displayAmount = abs($activity['amount']);
                                    if ($activity['type'] === 'withdrawal_rejected' && isset($activity['meta']['original_amount'])) {
                                        $displayAmount = $activity['meta']['original_amount'];
                                    }
                                    if ($activity['type'] === 'deposit_rejected' && isset($activity['meta']['original_amount'])) {
                                        $displayAmount = $activity['meta']['original_amount'];
                                    }
                                @endphp
                                <div class="activity-item flex items-center justify-between" style="background: rgba({{ $typeConfig['color'] === 'green' ? '34,197,94' : ($typeConfig['color'] === 'red' ? '239,68,68' : ($typeConfig['color'] === 'yellow' ? '234,179,8' : ($typeConfig['color'] === 'blue' ? '59,130,246' : '255,255,255'))) }}, 0.04); border-color: rgba({{ $typeConfig['color'] === 'green' ? '34,197,94' : ($typeConfig['color'] === 'red' ? '239,68,68' : ($typeConfig['color'] === 'yellow' ? '234,179,8' : ($typeConfig['color'] === 'blue' ? '59,130,246' : '255,255,255'))) }}, 0.1);">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl flex items-center justify-center {{ $colorClasses }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $typeConfig['icon'] }}"></path></svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-luxury-white font-medium">{{ $typeConfig['label'] }}</div>
                                            <div class="text-[11px] text-luxury-white/30">{{ $activity['date']->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        @if($displayAmount > 0)
                                            <div class="text-sm font-mono {{ $amountColor }}">
                                                {{ $typeConfig['prefix'] }}${{ number_format($displayAmount, 2) }}
                                            </div>
                                        @endif
                                        @if(str_contains($activity['type'], 'rejected'))
                                            <div class="text-[10px] text-red-400/60 uppercase tracking-wider">Rejected</div>
                                        @elseif($activity['type'] === 'withdrawal_pending')
                                            <div class="text-[10px] text-yellow-400/60 uppercase tracking-wider">Pending</div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10">
                                    <div class="w-14 h-14 mx-auto rounded-2xl bg-luxury-white/5 flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-luxury-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    </div>
                                    <p class="text-sm text-luxury-white/30">No activity yet</p>
                                    <p class="text-[11px] text-luxury-white/20 mt-1">Deposit to get started</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================
                 DEPOSIT CTA (if empty account)
                 ======================================== -->
            @if((Auth::user()->accountBalance->current_balance ?? 0) == 0)
            <div class="dashboard-card p-8 rounded-2xl border-luxury-gold/20 overflow-hidden reveal-section" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.06) 0%, rgba(5, 5, 5, 0.8) 60%); animation-delay: 0.8s;">
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-luxury-gold/10 flex items-center justify-center flex-shrink-0 float-orb">
                            <svg class="w-7 h-7 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-serif text-luxury-white mb-1">Activate Your AI Engine</h3>
                            <p class="text-sm text-luxury-white/50">Deposit capital to initialize high-frequency trading algorithms and start generating returns.</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('deposit-modal').showModal()" class="w-full md:w-auto px-8 py-3.5 bg-gradient-to-r from-luxury-gold to-luxury-gold-light text-luxury-black font-bold rounded-xl hover:shadow-lg hover:shadow-luxury-gold/20 transition-all duration-300 text-sm whitespace-nowrap group">
                        <span class="flex items-center justify-center gap-2">
                            Deposit Capital
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </button>
                </div>
            </div>
            @endif

        </div>
    </div>

    <!-- ========================================
         DEPOSIT MODAL
         ======================================== -->
    <dialog id="deposit-modal" class="modal bg-black/80 backdrop-blur-sm p-0 rounded-2xl overflow-hidden w-full max-w-md border border-luxury-gold/20 shadow-2xl shadow-luxury-gold/10">
        <div class="dashboard-card p-8 relative" style="background: linear-gradient(160deg, rgba(10, 25, 47, 0.9) 0%, rgba(5, 5, 5, 0.95) 100%);">
            <button onclick="document.getElementById('deposit-modal').close()" class="absolute top-4 right-4 text-luxury-white/40 hover:text-luxury-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto bg-luxury-gold/10 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-serif text-luxury-white mb-2">Deposit Bitcoin</h3>
                <p class="text-luxury-white/50 text-sm">Send BTC to the address below to fund your account.</p>
            </div>
            <div class="space-y-6">
                <div class="bg-black/40 p-4 rounded-xl border border-luxury-white/10">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-luxury-white/40 uppercase tracking-widest">BTC Wallet Address</span>
                        <span class="text-xs text-luxury-gold">Network: BTC</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <code class="flex-1 bg-transparent text-luxury-white font-mono text-sm break-all" id="btc-address">bc1qxygjfg47are2su0l7kxmx28tqw62tugtn4jrdh</code>
                        <button onclick="navigator.clipboard.writeText(document.getElementById('btc-address').innerText); this.innerHTML = '✓'; setTimeout(() => this.innerHTML = 'Copy', 2000);" class="p-2 bg-luxury-white/5 hover:bg-luxury-white/10 rounded-lg text-luxury-white/60 hover:text-luxury-white transition-colors text-xs font-bold uppercase tracking-wider flex-shrink-0">
                            Copy
                        </button>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 bg-luxury-blue/5 rounded-xl border border-luxury-blue/10">
                    <svg class="w-5 h-5 text-luxury-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-xs text-luxury-blue/80 leading-relaxed">Deposits are credited after 2 network confirmations. Your AI engine initializes immediately upon funding.</p>
                </div>
                <form action="{{ route('deposit.confirm') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-luxury-gold to-luxury-gold-light text-luxury-black font-bold rounded-xl hover:shadow-lg hover:shadow-luxury-gold/20 transition-all duration-300">
                        I've Sent the Deposit
                    </button>
                </form>
            </div>
        </div>
    </dialog>

    <!-- ========================================
         WITHDRAW MODAL
         ======================================== -->
    <dialog id="withdraw-modal" class="modal bg-black/80 backdrop-blur-sm p-0 rounded-2xl overflow-hidden w-full max-w-md border border-luxury-white/10 shadow-2xl">
        <div class="dashboard-card p-8 relative" style="background: linear-gradient(160deg, rgba(10, 25, 47, 0.9) 0%, rgba(5, 5, 5, 0.95) 100%);" x-data="{
            amount: '',
            btcAddress: '',
            maxBalance: {{ Auth::user()->accountBalance->current_balance ?? 0 }},
            setMax() { this.amount = this.maxBalance; }
        }">
            <button onclick="document.getElementById('withdraw-modal').close()" class="absolute top-4 right-4 text-luxury-white/40 hover:text-luxury-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto bg-luxury-white/5 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-luxury-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                </div>
                <h3 class="text-2xl font-serif text-luxury-white mb-2">Request Withdrawal</h3>
                <p class="text-luxury-white/50 text-sm">Withdrawals are processed within 24 hours.</p>
            </div>
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div class="text-sm text-red-200">
                            @foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <form action="{{ route('withdrawal.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs text-luxury-white/40 uppercase tracking-widest mb-2">Amount (USD)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-luxury-white/40">$</span>
                        <input type="number" name="amount" x-model="amount" placeholder="0.00" step="0.01" min="0.01" :max="maxBalance" required
                            class="w-full bg-black/40 border border-luxury-white/10 rounded-xl py-3 pl-8 pr-4 text-luxury-white focus:border-luxury-gold/50 focus:ring-0 transition-colors">
                    </div>
                    <div class="flex justify-between mt-2 text-xs">
                        <span class="text-luxury-white/40">Available: ${{ number_format(Auth::user()->accountBalance->current_balance ?? 0, 2) }}</span>
                        <button type="button" @click="setMax()" class="text-luxury-gold hover:text-white transition-colors">Max</button>
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-luxury-white/40 uppercase tracking-widest mb-2">BTC Wallet Address</label>
                    <input type="text" name="btc_address" x-model="btcAddress" placeholder="Enter your BTC address" required
                        class="w-full bg-black/40 border border-luxury-white/10 rounded-xl py-3 px-4 text-luxury-white focus:border-luxury-gold/50 focus:ring-0 transition-colors">
                </div>
                <button type="submit" class="w-full py-4 bg-luxury-white/10 text-luxury-white font-bold rounded-xl hover:bg-luxury-white/20 transition-all duration-300 border border-luxury-white/10">
                    Submit Request
                </button>
            </form>
        </div>
    </dialog>

    <!-- ========================================
         DASHBOARD ANIMATIONS SCRIPT
         ======================================== -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        // ===== PARTICLE CANVAS =====
        const canvas = document.getElementById('dashboard-particles');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            let particles = [];
            const resize = () => { canvas.width = window.innerWidth; canvas.height = window.innerHeight; };
            resize();
            window.addEventListener('resize', resize);

            class Particle {
                constructor() { this.reset(); }
                reset() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.size = Math.random() * 1.5 + 0.5;
                    this.speedX = (Math.random() - 0.5) * 0.3;
                    this.speedY = (Math.random() - 0.5) * 0.3;
                    this.opacity = Math.random() * 0.5 + 0.1;
                }
                update() {
                    this.x += this.speedX;
                    this.y += this.speedY;
                    if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
                }
                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(212, 175, 55, ${this.opacity})`;
                    ctx.fill();
                }
            }

            for (let i = 0; i < 60; i++) particles.push(new Particle());

            function animate() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach(p => { p.update(); p.draw(); });
                // Draw connections
                particles.forEach((a, i) => {
                    particles.slice(i + 1).forEach(b => {
                        const dist = Math.hypot(a.x - b.x, a.y - b.y);
                        if (dist < 120) {
                            ctx.beginPath();
                            ctx.moveTo(a.x, a.y);
                            ctx.lineTo(b.x, b.y);
                            ctx.strokeStyle = `rgba(212, 175, 55, ${0.06 * (1 - dist / 120)})`;
                            ctx.lineWidth = 0.5;
                            ctx.stroke();
                        }
                    });
                });
                requestAnimationFrame(animate);
            }
            animate();
        }

        // ===== ANIMATED COUNTERS =====
        document.querySelectorAll('.counter').forEach(el => {
            const target = parseFloat(el.dataset.target);
            const duration = 1500;
            const start = performance.now();
            function tick(now) {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
                const current = target * eased;
                el.textContent = current.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                if (progress < 1) requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
        });

        // ===== MINI SPARKLINES =====
        document.querySelectorAll('.mini-sparkline').forEach(canvas => {
            const ctx = canvas.getContext('2d');
            const color = canvas.dataset.color;
            const values = canvas.dataset.values.split(',').map(Number);
            const w = canvas.width = canvas.offsetWidth;
            const h = canvas.height = canvas.offsetHeight;
            const max = Math.max(...values);
            const stepX = w / (values.length - 1);

            ctx.beginPath();
            values.forEach((v, i) => {
                const x = i * stepX;
                const y = h - (v / max) * h * 0.8 - h * 0.1;
                i === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);
            });
            ctx.strokeStyle = color;
            ctx.lineWidth = 1.5;
            ctx.stroke();

            // Fill
            ctx.lineTo(w, h);
            ctx.lineTo(0, h);
            ctx.closePath();
            const gradient = ctx.createLinearGradient(0, 0, 0, h);
            gradient.addColorStop(0, color.replace(')', ', 0.15)').replace('rgb', 'rgba'));
            gradient.addColorStop(1, 'rgba(0,0,0,0)');
            ctx.fillStyle = gradient;
            ctx.fill();
        });

        // ===== CIRCULAR PROGRESS ANIMATION =====
        setTimeout(() => {
            document.querySelectorAll('.progress-ring').forEach(circle => {
                const target = parseFloat(circle.dataset.target);
                circle.style.strokeDashoffset = target;
            });
        }, 500);

        // ===== LIVE TICKER (CoinGecko) =====
        // Ticker is initialized by app.js crypto-ticker module

        // ===== AI STATUS TEXT ROTATION =====
        const aiStatuses = [
            'Analyzing market patterns...',
            'Optimizing portfolio allocation...',
            'Scanning 24 exchanges...',
            'Hedging USD volatility...',
            'Running Monte Carlo simulation...',
            'Rebalancing positions...',
            'Updating risk parameters...',
            'Processing signal data...',
            'Evaluating arbitrage paths...',
            'Neural network converged ✓',
        ];
        const statusEl = document.getElementById('ai-status-text');
        if (statusEl) {
            let idx = 0;
            setInterval(() => {
                statusEl.style.opacity = 0;
                setTimeout(() => {
                    idx = (idx + 1) % aiStatuses.length;
                    statusEl.textContent = aiStatuses[idx];
                    statusEl.style.opacity = 1;
                }, 300);
            }, 3000);
            statusEl.style.transition = 'opacity 0.3s ease';
        }

        // ===== AI LOG FEED =====
        const logMessages = [
            'Scanning BTC/USDT orderbook depth...',
            'Signal detected: ETH momentum shift ▲',
            'Executing hedge on USD pair...',
            'Portfolio variance optimized to 0.42%',
            'Updating Sharpe ratio: 3.15 → 3.18',
            'Neural layer 4 convergence: 98.4%',
            'Risk engine: all parameters nominal',
            'Arbitrage scan: 24 exchanges, 412 pairs',
            'Rebalancing vector: [0.34, 0.28, 0.22, 0.16]',
            'Latency: 2.3ms | Throughput: 14.2K ops/s',
        ];
        const logTextEl = document.getElementById('ai-log-text');
        if (logTextEl) {
            let logIdx = 0;
            setInterval(() => {
                logTextEl.style.opacity = 0;
                setTimeout(() => {
                    logIdx = (logIdx + 1) % logMessages.length;
                    logTextEl.textContent = logMessages[logIdx];
                    logTextEl.style.opacity = 1;
                }, 200);
            }, 2500);
            logTextEl.style.transition = 'opacity 0.2s ease';
        }

        // ===== PERIOD SELECTOR =====
        document.querySelectorAll('.period-pill').forEach(pill => {
            pill.addEventListener('click', function() {
                document.querySelectorAll('.period-pill').forEach(p => p.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // ===== REVEAL ON SCROLL =====
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal-section').forEach(el => observer.observe(el));
    });
    </script>

</x-app-layout>
