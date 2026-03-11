<nav class="relative z-10 flex items-center justify-between px-6 py-4 border-b border-brand-border/50" style="background-color:#1C1917;">
    {{-- Logo --}}
    <a href="{{ route('menu.index') }}" class="flex items-center gap-3 group">
        {{-- Logo icon --}}
        <div class="w-9 h-9 flex items-center justify-center">
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-9 h-9">
                <path d="M20 4C13 4 8 9 8 16C8 19 9 21.5 11 23.5L10 34H30L29 23.5C31 21.5 32 19 32 16C32 9 27 4 20 4Z" fill="white"/>
                <path d="M15 8C15 8 13 12 15 15C17 18 15 22 15 22" stroke="#1C1917" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M20 6C20 6 18 10 20 13C22 16 20 20 20 20" stroke="#1C1917" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M25 8C25 8 23 12 25 15C27 18 25 22 25 22" stroke="#1C1917" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M10 34H30L29.5 36C29.5 37.1 28.6 38 27.5 38H12.5C11.4 38 10.5 37.1 10.5 36L10 34Z" fill="white"/>
            </svg>
        </div>
        <span class="text-white font-bold text-lg tracking-widest uppercase">Mau Kopi</span>
    </a>

    {{-- Right icons --}}
    <div class="flex items-center gap-4">
        {{-- Notification bell --}}
        <button class="text-white/70 hover:text-white transition-colors p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
        </button>

        {{-- Cart --}}
        <a href="{{ route('cart.index') }}" class="relative text-white/70 hover:text-white transition-colors p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
            @if(($cartCount ?? 0) > 0)
                <span class="absolute -top-0.5 -right-0.5 bg-brand-accent text-brand-bg text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                    {{ $cartCount }}
                </span>
            @endif
        </a>
    </div>
</nav>
