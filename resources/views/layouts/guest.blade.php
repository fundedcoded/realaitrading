<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @keyframes float-slow {
                0%, 100% { transform: translateY(0) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(3deg); }
            }
            @keyframes pulse-ring {
                0% { transform: scale(0.8); opacity: 0.5; }
                50% { transform: scale(1.2); opacity: 0; }
                100% { transform: scale(0.8); opacity: 0.5; }
            }
            @keyframes gradient-shift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            @keyframes fade-in-up {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .auth-input {
                width: 100%;
                padding: 14px 16px;
                background: rgba(255,255,255,0.03);
                border: 1px solid rgba(255,255,255,0.08);
                border-radius: 12px;
                color: #fff;
                font-size: 15px;
                font-family: 'Outfit', sans-serif;
                transition: all 0.3s ease;
                outline: none;
            }
            .auth-input:focus {
                border-color: rgba(212,175,55,0.4);
                background: rgba(212,175,55,0.03);
                box-shadow: 0 0 0 3px rgba(212,175,55,0.08), 0 0 20px rgba(212,175,55,0.05);
            }
            .auth-input::placeholder {
                color: rgba(255,255,255,0.2);
            }
            .auth-btn {
                width: 100%;
                padding: 16px;
                background: linear-gradient(135deg, #d4af37, #c4a030);
                border: none;
                border-radius: 12px;
                color: #0a0a0a;
                font-weight: 700;
                font-size: 14px;
                letter-spacing: 2px;
                text-transform: uppercase;
                cursor: pointer;
                transition: all 0.3s ease;
                font-family: 'Outfit', sans-serif;
                position: relative;
                overflow: hidden;
            }
            .auth-btn:hover {
                background: linear-gradient(135deg, #e0be44, #d4af37);
                transform: translateY(-1px);
                box-shadow: 0 8px 30px rgba(212,175,55,0.3);
            }
            .auth-label {
                display: block;
                font-size: 11px;
                font-weight: 600;
                color: rgba(255,255,255,0.4);
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 8px;
            }
            .animate-in {
                animation: fade-in-up 0.6s ease forwards;
            }
            .animate-in-delay-1 { animation-delay: 0.1s; opacity: 0; }
            .animate-in-delay-2 { animation-delay: 0.2s; opacity: 0; }
            .animate-in-delay-3 { animation-delay: 0.3s; opacity: 0; }
            .animate-in-delay-4 { animation-delay: 0.4s; opacity: 0; }
            .animate-in-delay-5 { animation-delay: 0.5s; opacity: 0; }
        </style>
    </head>
    <body class="font-sans text-luxury-white antialiased">
        <div class="min-h-screen flex bg-luxury-black relative overflow-hidden">
            
            <!-- Left Panel — Brand Showcase (hidden on mobile) -->
            <div class="hidden lg:flex lg:w-1/2 relative items-center justify-center">
                <!-- Animated background -->
                <div class="absolute inset-0 bg-gradient-to-br from-luxury-black via-[#0d0d0d] to-luxury-black"></div>
                
                <!-- Animated orbs -->
                <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-luxury-gold/[0.04] rounded-full blur-[100px]" style="animation: float-slow 8s ease-in-out infinite;"></div>
                <div class="absolute bottom-1/3 right-1/4 w-48 h-48 bg-luxury-gold/[0.03] rounded-full blur-[80px]" style="animation: float-slow 10s ease-in-out infinite 2s;"></div>
                <div class="absolute top-1/2 right-1/3 w-32 h-32 bg-amber-500/[0.02] rounded-full blur-[60px]" style="animation: float-slow 7s ease-in-out infinite 1s;"></div>

                <!-- Grid overlay -->
                <div class="absolute inset-0 opacity-[0.02]" style="background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 60px 60px;"></div>

                <!-- Content -->
                <div class="relative z-10 max-w-md px-12 text-center">
                    <!-- Logo -->
                    <div class="mb-12">
                        <a href="/" class="inline-block">
                            <img src="/images/logo.png" alt="Logo" class="w-20 h-20 mx-auto mb-6">
                        </a>
                        <div class="text-2xl tracking-[0.3em] font-light text-luxury-white/90 uppercase">
                            Real<span class="text-luxury-gold font-medium">AI</span>Trading
                        </div>
                    </div>

                    <!-- Tagline -->
                    <h2 class="text-3xl font-serif font-medium text-luxury-white/90 leading-relaxed mb-6">
                        The <span class="italic text-luxury-gold">Sovereign</span><br>Edge.
                    </h2>
                    <p class="text-luxury-white/30 text-sm leading-relaxed mb-12">
                        Deploy institutional-grade AI that trades every market with mathematical precision. Zero emotion. Pure execution.
                    </p>

                    <!-- Trust stats -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="p-4 rounded-xl bg-luxury-white/[0.02] border border-luxury-white/[0.04]">
                            <div class="text-xl font-serif text-luxury-gold">847%</div>
                            <div class="text-[9px] text-luxury-white/20 uppercase tracking-widest mt-1">Returns</div>
                        </div>
                        <div class="p-4 rounded-xl bg-luxury-white/[0.02] border border-luxury-white/[0.04]">
                            <div class="text-xl font-serif text-luxury-white/80">94.7%</div>
                            <div class="text-[9px] text-luxury-white/20 uppercase tracking-widest mt-1">Win Rate</div>
                        </div>
                        <div class="p-4 rounded-xl bg-luxury-white/[0.02] border border-luxury-white/[0.04]">
                            <div class="text-xl font-serif text-emerald-400">12K+</div>
                            <div class="text-[9px] text-luxury-white/20 uppercase tracking-widest mt-1">Clients</div>
                        </div>
                    </div>

                    <!-- Decorative line -->
                    <div class="mt-12 flex items-center gap-4 justify-center">
                        <div class="h-px w-16 bg-gradient-to-r from-transparent to-luxury-gold/20"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-luxury-gold/30"></div>
                        <div class="h-px w-16 bg-gradient-to-l from-transparent to-luxury-gold/20"></div>
                    </div>
                </div>

                <!-- Edge glow -->
                <div class="absolute right-0 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-luxury-gold/10 to-transparent"></div>
            </div>

            <!-- Right Panel — Form -->
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center relative min-h-screen px-6 sm:px-12">
                <!-- Background effects for right panel -->
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(212,175,55,0.03)_0%,_transparent_60%)]"></div>
                
                <!-- Mobile logo (shown only on mobile) -->
                <div class="lg:hidden mb-8 text-center relative z-10 animate-in">
                    <a href="/">
                        <img src="/images/logo.png" alt="Logo" class="w-14 h-14 mx-auto mb-3">
                    </a>
                    <div class="text-sm tracking-[0.3em] font-light text-luxury-white/60 uppercase">
                        Real<span class="text-luxury-gold font-medium">AI</span>Trading
                    </div>
                </div>

                <!-- Form Container -->
                <div class="w-full max-w-md relative z-10">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <div class="absolute bottom-6 text-center">
                    <p class="text-[10px] text-luxury-white/15 uppercase tracking-widest">
                        © {{ date('Y') }} Real AI Trading. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
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
