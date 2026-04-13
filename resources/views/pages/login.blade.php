<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mau Kopi — Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans" x-data="loginPage()">

<div class="min-h-screen flex">

    <!-- ── LEFT: Form ── -->
    <div class="flex-1 flex flex-col justify-center px-12 lg:px-20 xl:px-28 py-12">

        <!-- Logo -->
        <div class="flex items-center gap-2.5 mb-12">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
                <rect width="28" height="28" rx="7" fill="#8B5E1A"/>
                <path d="M14 6C10.134 6 7 9.134 7 13C7 16.866 10.134 20 14 20C17.866 20 21 16.866 21 13C21 9.134 17.866 6 14 6ZM14 8C16.761 8 19 10.239 19 13C19 15.761 16.761 18 14 18C11.239 18 9 15.761 9 13C9 10.239 11.239 8 14 8Z" fill="white"/>
                <path d="M14 10C14 10 12 11.5 12 13C12 14.105 12.895 15 14 15C15.105 15 16 14.105 16 13C16 11.5 14 10 14 10Z" fill="white"/>
            </svg>
            <span class="font-display font-bold text-[18px] tracking-tight text-[#3d2609]">MAU KOPI</span>
        </div>

        <!-- Heading -->
        <div class="mb-8">
            <h1 class="font-display font-bold text-[38px] leading-tight text-gray-900 mb-3">Welcome Back!</h1>
            <p class="text-gray-400 text-[15px] leading-relaxed max-w-xs">Sign in to access your workspace and keep everything on track.</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('login.post') }}" class="space-y-5 max-w-[340px]">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email address..."
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-700 placeholder-gray-300
                           focus:outline-none focus:ring-2 focus:ring-[#8B5E1A]/25 focus:border-[#8B5E1A] transition-all"
                    required
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                <div class="relative">
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        name="password"
                        placeholder="Enter your password..."
                        class="w-full px-4 py-3 pr-11 rounded-xl border border-gray-200 text-sm text-gray-700 placeholder-gray-300
                               focus:outline-none focus:ring-2 focus:ring-[#8B5E1A]/25 focus:border-[#8B5E1A] transition-all"
                        required
                    >
                    <button
                        type="button"
                        @click="showPassword = !showPassword"
                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                    >
                        <svg x-show="!showPassword" width="18" height="18" viewBox="0 0 20 20" fill="none">
                            <path d="M2 10s3-6 8-6 8 6 8 6-3 6-8 6-8-6-8-6z" stroke="currentColor" stroke-width="1.5"/>
                            <circle cx="10" cy="10" r="2.5" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                        <svg x-show="showPassword" width="18" height="18" viewBox="0 0 20 20" fill="none" style="display:none;">
                            <path d="M3 3l14 14M8.46 8.46A3 3 0 0013.54 13.54M6 6.17C4.14 7.37 2.97 9 2.97 9s2.88 5.44 7.03 5.44c1.16 0 2.22-.3 3.13-.82M10 5c4.15 0 7.03 4 7.03 4s-.55.83-1.53 1.76" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Forgot -->
            <div class="text-right">
                <a href="#" class="text-sm text-gray-500 underline hover:text-[#8B5E1A] transition-colors">Forgot Password?</a>
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-[#8B5E1A] hover:bg-[#7a4f14] text-white text-sm font-semibold
                       transition-all shadow-sm hover:shadow-md active:scale-[0.99]"
            >
                Login
            </button>
        </form>
    </div>

    <!-- ── RIGHT: Abstract Art ── -->
    <div class="hidden lg:block w-[52%] flex-shrink-0 p-6">
        <div class="h-full rounded-[28px] overflow-hidden relative">
            <!-- Abstract swirling art using SVG + CSS gradient to mimic the design -->
            <div class="absolute inset-0 bg-[#2a1f13]"></div>

            <!-- Layered gradient blobs -->
            <div class="absolute inset-0 overflow-hidden">
                <!-- Dark olive base -->
                <div class="absolute inset-0" style="background: radial-gradient(ellipse 80% 100% at 50% 60%, #3d3020 0%, #1a1208 100%)"></div>

                <!-- Brown warm swirls -->
                <div class="absolute" style="
                    width: 200%; height: 200%;
                    top: -50%; left: -50%;
                    background:
                        conic-gradient(from 45deg at 40% 45%, transparent 0deg, #8B5E1A44 30deg, transparent 60deg,
                                       transparent 100deg, #C4906066 130deg, transparent 160deg,
                                       transparent 200deg, #5c3a0e55 230deg, transparent 260deg,
                                       transparent 300deg, #8B5E1A33 330deg, transparent 360deg);
                    filter: blur(8px);
                "></div>

                <!-- Layered wavy bands -->
                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 600 800" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <filter id="blur1"><feGaussianBlur stdDeviation="3"/></filter>
                        <filter id="blur2"><feGaussianBlur stdDeviation="6"/></filter>
                    </defs>

                    <!-- Deep background layers -->
                    <ellipse cx="300" cy="500" rx="350" ry="450" fill="#1a1208" opacity="0.8"/>

                    <!-- Gold/brown thick bands -->
                    <path d="M-50 200 Q150 100 300 180 Q450 260 650 160 Q700 150 700 200 Q650 220 450 320 Q300 400 150 340 Q50 300 -50 350 Z" fill="#8B5E1A" opacity="0.35" filter="url(#blur1)"/>
                    <path d="M-50 300 Q200 180 350 280 Q500 380 700 260 Q720 280 700 320 Q500 440 350 360 Q200 280 -50 400 Z" fill="#C49060" opacity="0.25" filter="url(#blur1)"/>
                    <path d="M-50 420 Q100 310 280 380 Q460 450 680 340 Q700 360 690 400 Q470 510 280 460 Q100 410 -50 520 Z" fill="#5c3a0e" opacity="0.4" filter="url(#blur1)"/>

                    <!-- Lighter golden accent arcs -->
                    <path d="M100 50 Q250 -30 400 80 Q550 190 650 100" stroke="#C49060" stroke-width="60" fill="none" opacity="0.15" filter="url(#blur2)" stroke-linecap="round"/>
                    <path d="M0 150 Q200 30 350 160 Q500 290 700 200" stroke="#8B5E1A" stroke-width="80" fill="none" opacity="0.2" filter="url(#blur2)" stroke-linecap="round"/>

                    <!-- Organic blob shapes -->
                    <path d="M200 600 Q350 480 500 580 Q620 660 600 750 Q500 820 350 780 Q200 740 200 600 Z" fill="#3d2609" opacity="0.6"/>
                    <path d="M-50 650 Q100 550 250 630 Q380 700 300 800 Q150 830 0 760 Z" fill="#2a1a09" opacity="0.7"/>

                    <!-- Highlight wisps -->
                    <path d="M50 400 Q200 320 320 420 Q440 520 580 460" stroke="#D4B08A" stroke-width="3" fill="none" opacity="0.2" filter="url(#blur1)"/>
                    <path d="M80 500 Q220 420 340 500 Q460 580 590 530" stroke="#C49060" stroke-width="2" fill="none" opacity="0.15"/>

                    <!-- Fine layered ribbons (mimics the wavy stacked look) -->
                    @for($i = 0; $i < 20; $i++)
                        @php
                            $y = 120 + $i * 35;
                            $amp = 20 + ($i % 5) * 12;
                            $shift = ($i % 3) * 40;
                            $colors = ['#8B5E1A', '#C49060', '#5c3a0e', '#D4B08A', '#3d2609', '#7a4f14', '#b67a40'];
                            $color = $colors[$i % count($colors)];
                            $opacity = 0.12 + ($i % 4) * 0.04;
                            $w = 2 + ($i % 3) * 1.5;
                        @endphp
                        <path
                            d="M-50 {{ $y }} Q{{ 100 + $shift }} {{ $y - $amp }} {{ 300 + $shift/2 }} {{ $y }} Q{{ 500 + $shift/3 }} {{ $y + $amp }} 700 {{ $y - $amp/2 }}"
                            stroke="{{ $color }}"
                            stroke-width="{{ $w }}"
                            fill="none"
                            opacity="{{ $opacity }}"
                        />
                    @endfor
                </svg>

                <!-- Top vignette -->
                <div class="absolute inset-x-0 top-0 h-40" style="background: linear-gradient(to bottom, #1a1208cc, transparent)"></div>
                <!-- Bottom vignette -->
                <div class="absolute inset-x-0 bottom-0 h-40" style="background: linear-gradient(to top, #0d0905cc, transparent)"></div>
            </div>
        </div>
    </div>
</div>

<script>
function loginPage() {
    return { showPassword: false }
}
</script>
</body>
</html>
