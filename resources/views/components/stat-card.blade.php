@props([
    'title',
    'value',
    'badge' => null,       // e.g. '6.3%'
    'badgeType' => 'up',   // 'up' | 'down'
    'badgeLabel' => 'than yesterday',
    'icon' => '',
])

<div class="bg-white rounded-2xl p-5 shadow-card">
    <div class="flex items-center gap-2 text-gray-400 text-xs font-medium mb-3">
        {!! $icon !!}
        {{ $title }}
    </div>
    <p class="font-display font-bold text-[22px] text-gray-800 leading-none mb-3">{{ $value }}</p>
    @if($badge)
        <span class="{{ $badgeType === 'up' ? 'badge-up' : 'badge-down' }}">
            @if($badgeType === 'up')
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M5 8V2M5 2L2 5M5 2l3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            @else
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M5 2v6M5 8L2 5M5 8l3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            @endif
            {{ $badge }}
        </span>
        <span class="text-xs text-gray-400 ml-1">{{ $badgeLabel }}</span>
    @endif
</div>
