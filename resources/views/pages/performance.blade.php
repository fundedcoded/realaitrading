<x-public-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-luxury-white">
            {{ __('Performance') }}
        </h2>
    </x-slot>

    <div class="pt-8 pb-16 bg-luxury-black min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero -->
            <div class="text-center mb-20 scroll-reveal">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-green-500/5 border border-green-500/15 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-green-400 text-[10px] font-bold tracking-[0.2em] uppercase">System Active</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif mb-6">Track <span class="text-luxury-gold text-shadow-gold">Record</span></h1>
                <p class="text-xl text-luxury-white/60 max-w-3xl mx-auto">
                    Audited, verified, and transparent performance metrics since inception.
                </p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20 stagger-grid">
                <div class="glow-card glass-card p-8 rounded-2xl border border-luxury-white/10 text-center">
                    <div class="text-4xl font-serif text-luxury-gold mb-2 count-up" data-target="24.8" data-suffix="%" data-decimals="1">0.0%</div>
                    <div class="text-xs text-luxury-white/40 uppercase tracking-wider">Avg. Monthly Return</div>
                </div>
                <div class="glow-card glass-card p-8 rounded-2xl border border-luxury-white/10 text-center">
                    <div class="text-4xl font-serif text-luxury-gold mb-2 count-up" data-target="1.2" data-decimals="1">0.0</div>
                    <div class="text-xs text-luxury-white/40 uppercase tracking-wider">Sharpe Ratio</div>
                </div>
                <div class="glow-card glass-card p-8 rounded-2xl border border-luxury-white/10 text-center">
                    <div class="text-4xl font-serif text-luxury-gold mb-2 count-up" data-target="4.5" data-suffix="%" data-decimals="1">0.0%</div>
                    <div class="text-xs text-luxury-white/40 uppercase tracking-wider">Max Drawdown</div>
                </div>
            </div>

            <!-- Monthly Returns Heatmap -->
            <div class="glow-card glass-card p-8 rounded-2xl border border-luxury-white/10 mb-20 scroll-reveal">
                <h3 class="text-xl font-serif text-luxury-white mb-6">Monthly Returns</h3>
                <div class="grid grid-cols-6 md:grid-cols-12 gap-2">
                    @php
                        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        $returns = [3.2, 5.1, -1.4, 4.8, 2.7, 6.3, 1.9, -0.8, 4.2, 3.5, 5.7, 2.1];
                    @endphp
                    @foreach($months as $i => $month)
                        @php
                            $r = $returns[$i];
                            $color = $r >= 4 ? 'bg-green-500/40 border-green-500/30' : ($r >= 0 ? 'bg-green-500/20 border-green-500/15' : 'bg-red-500/20 border-red-500/15');
                            $textColor = $r >= 0 ? 'text-green-400' : 'text-red-400';
                        @endphp
                        <div class="p-3 rounded-lg border {{ $color }} text-center">
                            <div class="text-[10px] text-luxury-white/40 uppercase mb-1">{{ $month }}</div>
                            <div class="text-sm font-mono {{ $textColor }}">{{ $r > 0 ? '+' : '' }}{{ $r }}%</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Chart Section -->
            <div class="glow-card glass-card p-8 rounded-2xl border border-luxury-white/10 relative overflow-hidden mb-20 scroll-reveal">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-serif text-luxury-white">Cumulative Performance (Live)</h3>
                    <div class="flex items-center gap-2">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        <span class="text-xs text-green-400 font-mono uppercase tracking-wider">System Active</span>
                    </div>
                </div>
                
                <div class="relative w-full h-[400px] bg-luxury-black/50 rounded-lg border border-luxury-white/5 overflow-hidden">
                    <canvas id="performanceChart" class="w-full h-full"></canvas>
                    
                    <!-- Overlay Info -->
                    <div class="absolute top-4 left-4 bg-luxury-black/80 backdrop-blur-sm p-3 rounded-lg border border-luxury-white/10">
                        <div class="text-xs text-luxury-white/40 uppercase tracking-wider mb-1">Current Return</div>
                        <div class="text-2xl font-mono text-green-400" id="currentReturn">+24.82%</div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const canvas = document.getElementById('performanceChart');
                    if (!canvas) return;
                    const ctx = canvas.getContext('2d');
                    const returnDisplay = document.getElementById('currentReturn');
                    
                    function resize() {
                        canvas.width = canvas.offsetWidth;
                        canvas.height = canvas.offsetHeight;
                    }
                    window.addEventListener('resize', resize);
                    resize();

                    let dataPoints = [];
                    const maxPoints = 100;
                    let currentVal = 100;
                    
                    for(let i=0; i<maxPoints; i++) {
                        currentVal = currentVal * (1 + (Math.random() - 0.45) * 0.01);
                        dataPoints.push(currentVal);
                    }

                    function draw() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        
                        const w = canvas.width;
                        const h = canvas.height;
                        const padding = 20;
                        
                        const minVal = Math.min(...dataPoints) * 0.99;
                        const maxVal = Math.max(...dataPoints) * 1.01;
                        const range = maxVal - minVal;
                        
                        // Draw Grid
                        ctx.strokeStyle = 'rgba(255, 255, 255, 0.05)';
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        for(let i=1; i<5; i++) {
                            const y = h - (padding + (i/5) * (h - 2*padding));
                            ctx.moveTo(0, y);
                            ctx.lineTo(w, y);
                        }
                        ctx.stroke();

                        // Draw Line
                        ctx.beginPath();
                        ctx.strokeStyle = '#C6A87C';
                        ctx.lineWidth = 2;
                        ctx.lineJoin = 'round';
                        
                        const gradient = ctx.createLinearGradient(0, 0, 0, h);
                        gradient.addColorStop(0, 'rgba(198, 168, 124, 0.2)');
                        gradient.addColorStop(1, 'rgba(198, 168, 124, 0)');

                        const getX = (i) => (i / (maxPoints - 1)) * w;
                        const getY = (val) => h - (padding + ((val - minVal) / range) * (h - 2*padding));
                        
                        ctx.moveTo(getX(0), getY(dataPoints[0]));
                        
                        for(let i=1; i<dataPoints.length; i++) {
                            ctx.lineTo(getX(i), getY(dataPoints[i]));
                        }
                        
                        ctx.stroke();
                        
                        ctx.lineTo(w, h);
                        ctx.lineTo(0, h);
                        ctx.fillStyle = gradient;
                        ctx.fill();
                        
                        // End point pulse
                        const lastX = getX(dataPoints.length - 1);
                        const lastY = getY(dataPoints[dataPoints.length - 1]);
                        
                        ctx.beginPath();
                        ctx.arc(lastX, lastY, 4, 0, Math.PI * 2);
                        ctx.fillStyle = '#fff';
                        ctx.fill();
                        
                        ctx.beginPath();
                        ctx.arc(lastX, lastY, 10, 0, Math.PI * 2);
                        ctx.fillStyle = 'rgba(255, 255, 255, 0.1)';
                        ctx.fill();
                    }

                    setInterval(() => {
                        const change = (Math.random() - 0.45) * 0.005; 
                        currentVal = currentVal * (1 + change);
                        
                        dataPoints.push(currentVal);
                        if(dataPoints.length > maxPoints) {
                            dataPoints.shift();
                        }
                        
                        const totalReturn = ((currentVal - 100) / 100 * 100).toFixed(2);
                        returnDisplay.innerText = (totalReturn > 0 ? '+' : '') + totalReturn + '%';
                        returnDisplay.className = `text-2xl font-mono ${totalReturn >= 0 ? 'text-green-400' : 'text-red-400'}`;
                        
                        draw();
                    }, 100);
                    
                    draw();
                });
            </script>
        </div>
    </div>
</x-public-layout>
