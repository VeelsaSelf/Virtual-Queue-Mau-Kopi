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

    <!-- ── RIGHT: Image ── -->
    <div class="hidden lg:block flex-shrink-0 p-6" style="width: 660px;">
        <div class="overflow-hidden rounded-[28px]" style="height: 944px;">
            {{-- Ganti src dengan path gambar kamu, misal: asset('images/login-bg.jpg') --}}
            <img
                src="{{ asset('images/image 263.png') }}"
                alt="Login background"
                class="w-full h-full object-cover"
            >
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