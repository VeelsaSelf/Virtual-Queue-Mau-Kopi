@props(['route', 'active' => false, 'label'])

<a
    href="{{ route($route) }}"
    class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors
        {{ $active
            ? 'bg-[#F0E8D8] text-[#7a4f14] font-semibold'
            : 'text-gray-500 font-medium hover:bg-cream-100 hover:text-gray-700'
        }}"
>
    @if($active)
        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-[3px] h-5 bg-[#8B5E1A] rounded-r-full"></span>
    @endif
    <span class="{{ $active ? 'text-[#8B5E1A]' : 'text-gray-400' }}">
        {{ $slot }}
    </span>
    {{ $label }}
</a>
