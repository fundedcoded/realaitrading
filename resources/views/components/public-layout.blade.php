<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Real AI Trading') }} | The Sovereign Edge</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700|playfair-display:400,600,700&display=swap" rel="stylesheet" />
        
        <!-- GSAP Animation Library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .text-shadow-gold {
                text-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
            }

            /* Page entrance animation */
            .page-entrance {
                animation: pageEnter 0.6s ease-out both;
            }
            @keyframes pageEnter {
                from { opacity: 0; transform: translateY(12px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* Scroll reveal */
            .scroll-reveal {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .scroll-reveal.revealed {
                opacity: 1;
                transform: translateY(0);
            }

            /* Glow card hover */
            .glow-card {
                position: relative;
                overflow: hidden;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .glow-card::before {
                content: '';
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                border-radius: inherit;
                background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(212,175,55,0.08) 0%, transparent 60%);
                opacity: 0;
                transition: opacity 0.4s;
                pointer-events: none;
                z-index: 0;
            }
            .glow-card:hover::before { opacity: 1; }
            .glow-card:hover {
                transform: translateY(-4px);
                border-color: rgba(212,175,55,0.25);
                box-shadow: 0 8px 32px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(212,175,55,0.1);
            }

            /* Footer gradient mesh */
            .footer-mesh {
                background-image:
                    radial-gradient(ellipse at 20% 50%, rgba(212,175,55,0.04) 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 20%, rgba(56,189,248,0.03) 0%, transparent 50%);
            }

            /* Footer link hover */
            .footer-link {
                position: relative;
                transition: color 0.3s, padding-left 0.3s;
            }
            .footer-link:hover {
                padding-left: 4px;
                color: #D4AF37;
            }

            /* Nav link underline effect */
            .nav-link-animated {
                position: relative;
            }
            .nav-link-animated::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 1px;
                background: linear-gradient(90deg, #D4AF37, transparent);
                transition: width 0.3s ease;
            }
            .nav-link-animated:hover::after {
                width: 100%;
            }
        </style>
    </head>
    <body class="bg-luxury-black text-luxury-white antialiased overflow-x-hidden">
        
        <!-- Navigation -->
        <nav x-data="{ open: false }" class="fixed w-full z-50 transition-all duration-300 bg-luxury-black/90 backdrop-blur-md border-b border-luxury-white/5">
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
                        <a href="{{ route('architecture') }}" class="nav-link nav-link-animated">Architecture</a>
                        <a href="{{ route('performance') }}" class="nav-link nav-link-animated">Performance</a>
                        <a href="{{ route('technology') }}" class="nav-link nav-link-animated">Technology</a>
                        <a href="{{ route('login') }}" class="nav-link nav-link-animated">Client Login</a>
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

        <!-- Live Crypto Ticker Bar -->
        <div class="fixed top-24 left-0 right-0 z-40 bg-luxury-black/80 backdrop-blur-sm border-b border-luxury-white/5">
            <div class="flex items-center h-9">
                <div class="flex-shrink-0 px-4 bg-luxury-gold/10 h-full flex items-center border-r border-luxury-white/5">
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-[9px] text-luxury-gold font-bold uppercase tracking-[0.15em]">Live</span>
                    </div>
                </div>
                <div id="pub-ticker-track" class="flex-1 overflow-hidden">
                    <div id="pub-ticker-content" class="flex items-center whitespace-nowrap text-xs py-2 px-4">
                        <span class="text-luxury-white/30 text-[11px]">Loading live prices...</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <main class="pt-[132px] page-entrance">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="footer-mesh bg-luxury-charcoal border-t border-luxury-white/5 pt-20 pb-10 relative overflow-hidden">
            <!-- Subtle decorative elements -->
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-luxury-gold/[0.02] rounded-full blur-[100px] pointer-events-none"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-luxury-blue/[0.02] rounded-full blur-[100px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                    <div class="col-span-1 md:col-span-1">
                        <a href="/" class="flex items-center gap-2 mb-6 group">
                            <img src="/images/logo.png" alt="Logo" class="h-8 w-auto opacity-80 group-hover:opacity-100 transition-opacity">
                            <span class="font-serif text-lg tracking-widest text-luxury-white group-hover:text-luxury-gold transition-colors">REAL<span class="text-luxury-gold">AI</span></span>
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
                            <li><a href="{{ route('markets') }}" class="footer-link">Markets</a></li>
                            <li><a href="{{ route('technology') }}" class="footer-link">Technology</a></li>
                            <li><a href="{{ route('security') }}" class="footer-link">Security</a></li>
                            <li><a href="{{ route('api') }}" class="footer-link">API</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-6">Company</h4>
                        <ul class="space-y-4 text-sm text-luxury-white/60">
                            <li><a href="{{ route('about') }}" class="footer-link">About Us</a></li>
                            <li><a href="{{ route('careers') }}" class="footer-link">Careers</a></li>
                            <li><a href="{{ route('legal') }}" class="footer-link">Legal</a></li>
                            <li><a href="{{ route('contact') }}" class="footer-link">Contact</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-6">Legal</h4>
                        <p class="text-luxury-white/30 text-xs leading-relaxed">
                            Trading involves risk. Past performance is not indicative of future results. Real AI Trading is a registered trademark.
                        </p>
                    </div>
                </div>
                
                <!-- Gradient divider -->
                <div class="h-px bg-gradient-to-r from-transparent via-luxury-white/10 to-transparent mb-8"></div>

                <!-- Copyright and Social -->
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-luxury-white/30 text-xs">© {{ date('Y') }} Real AI Trading. All rights reserved.</p>
                    <div class="flex gap-6">
                        <a href="#" class="text-luxury-white/30 hover:text-luxury-gold transition-colors hover:scale-110 transform duration-200"><span class="sr-only">Twitter</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg></a>
                        <a href="#" class="text-luxury-white/30 hover:text-luxury-gold transition-colors hover:scale-110 transform duration-200"><span class="sr-only">LinkedIn</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- GSAP Animations -->
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                gsap.registerPlugin(ScrollTrigger);
                
                // Scroll Animations for glass cards
                gsap.utils.toArray('.glass-card, .glow-card, .obsidian-card').forEach((card, i) => {
                    gsap.from(card, {
                        scrollTrigger: {
                            trigger: card,
                            start: "top 88%",
                        },
                        y: 40,
                        opacity: 0,
                        duration: 0.7,
                        delay: i * 0.08,
                        ease: "power2.out"
                    });
                });

                // Scroll reveal for sections
                gsap.utils.toArray('.scroll-reveal').forEach((el) => {
                    ScrollTrigger.create({
                        trigger: el,
                        start: "top 85%",
                        onEnter: () => el.classList.add('revealed'),
                        once: true
                    });
                });

                // Stagger animations for grid children
                gsap.utils.toArray('.stagger-grid').forEach(grid => {
                    gsap.from(grid.children, {
                        scrollTrigger: {
                            trigger: grid,
                            start: "top 85%",
                        },
                        y: 30,
                        opacity: 0,
                        duration: 0.6,
                        stagger: 0.12,
                        ease: "power2.out"
                    });
                });

                // Animated counters on scroll
                document.querySelectorAll('.count-up').forEach(el => {
                    const target = parseFloat(el.dataset.target);
                    const suffix = el.dataset.suffix || '';
                    const prefix = el.dataset.prefix || '';
                    const decimals = parseInt(el.dataset.decimals || '0');

                    ScrollTrigger.create({
                        trigger: el,
                        start: "top 85%",
                        once: true,
                        onEnter: () => {
                            const start = performance.now();
                            const duration = 1800;
                            function tick(now) {
                                const elapsed = now - start;
                                const progress = Math.min(elapsed / duration, 1);
                                const eased = 1 - Math.pow(1 - progress, 3);
                                const current = target * eased;
                                el.textContent = prefix + current.toFixed(decimals) + suffix;
                                if (progress < 1) requestAnimationFrame(tick);
                            }
                            requestAnimationFrame(tick);
                        }
                    });
                });

                // Glow card mouse tracking
                document.querySelectorAll('.glow-card').forEach(card => {
                    card.addEventListener('mousemove', (e) => {
                        const rect = card.getBoundingClientRect();
                        const x = ((e.clientX - rect.left) / rect.width * 100);
                        const y = ((e.clientY - rect.top) / rect.height * 100);
                        card.style.setProperty('--mouse-x', x + '%');
                        card.style.setProperty('--mouse-y', y + '%');
                    });
                });

                // Footer reveal
                gsap.from('footer', {
                    scrollTrigger: {
                        trigger: 'footer',
                        start: "top 95%",
                    },
                    opacity: 0,
                    y: 20,
                    duration: 0.8,
                    ease: "power2.out"
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
