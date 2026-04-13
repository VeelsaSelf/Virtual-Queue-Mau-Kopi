@php
    $icons = [
        'clock' => '<circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M10 6v4l2.5 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
        'chef' => '<path d="M10 3a3 3 0 00-3 3v1H5a2 2 0 00-2 2v7h14V9a2 2 0 00-2-2h-2V6a3 3 0 00-3-3z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>',
        'order' => '<path d="M3 10a7 7 0 1014 0A7 7 0 003 10z" stroke="currentColor" stroke-width="1.5"/><path d="M10 7v3l2 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
        'payment' => '<rect x="2" y="5" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M2 9h16" stroke="currentColor" stroke-width="1.5"/>',
    ];
    $bgColors = [
        'clock' => 'bg-amber-50 text-amber-600',
        'chef' => 'bg-red-50 text-red-500',
        'order' => 'bg-blue-50 text-blue-500',
        'payment' => 'bg-purple-50 text-purple-500',
    ];
@endphp

<div class="flex gap-3 px-5 py-3.5 hover:bg-gray-50 transition-colors cursor-pointer">
    <div class="w-9 h-9 rounded-full {{ $bgColors[$icon] ?? 'bg-gray-100 text-gray-500' }} flex items-center justify-center flex-shrink-0 mt-0.5">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
            {!! $icons[$icon] ?? '' !!}
        </svg>
    </div>
    <div class="flex-1 min-w-0">
        <div class="flex items-start justify-between gap-2">
            <p class="text-sm font-semibold text-gray-800 leading-snug">{{ $title }}</p>
            @if($unread ?? false)
                <span class="w-2 h-2 bg-[#3B82F6] rounded-full flex-shrink-0 mt-1.5"></span>
            @endif
        </div>
        <p class="text-xs text-gray-400 mt-0.5 leading-relaxed">{{ $desc }}</p>
    </div>
</div>
