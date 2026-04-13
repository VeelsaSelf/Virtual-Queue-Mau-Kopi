@extends('layouts.app')
@section('title','Orders')
@section('page-title','Orders')
@section('page-subtitle','Monitor and manage all customer orders')

@section('content')

<style>
@keyframes fadeUp {
    from { opacity:0; transform:translateY(16px); }
    to   { opacity:1; transform:translateY(0); }
}
.order-card {
    border: 1.5px solid #EDE8E0;
    transition: box-shadow .18s ease, border-color .18s ease;
}
.order-card:hover {
    box-shadow: 0 4px 20px rgba(139,94,26,.10);
    border-color: #D4B08A;
}
.order-card.is-selected {
    border-color: #93C5FD;
    box-shadow: 0 0 0 1px #93C5FD, 0 4px 16px rgba(147,197,253,.18);
}
</style>

@php
$orders = [];
foreach (range(71, 75) as $id) {
    $orders[] = [
        'id'    => $id,
        'name'  => 'Miguela Veloso',
        'date'  => '15-12-2025 at 10:22 AM',
        'type'  => 'Take Away',
        'items' => [
            ['name' => 'Iced Latte',                'qty' => 1, 'price' => 'Rp 35.000'],
            ['name' => 'Chicken Teriyaki Rice Bowl', 'qty' => 1, 'price' => 'Rp 42.000'],
            ['name' => 'Chocolate Brownies',         'qty' => 1, 'price' => 'Rp 25.000'],
        ],
        'total' => 'Rp 80.000',
    ];
}

$detailItems = [
    [
        'name'  => 'Iced Latte',
        'sub'   => 'Medium • Less Sugar • Normal Ice',
        'price' => 'Rp 35.000',
        'img'   => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=120&h=120&fit=crop',
    ],
    [
        'name'  => 'Chicken Teriyaki Rice Bowl',
        'sub'   => 'Regular Rice • Mild Spicy Level',
        'price' => 'Rp 42.000',
        'img'   => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=120&h=120&fit=crop',
    ],
    [
        'name'  => 'Chocolate Brownie',
        'sub'   => 'Served Warm • Add Vanilla Ice Cream',
        'note'  => 'Catatan: Es krimnya tolong dipisah',
        'price' => 'Rp 25.000',
        'img'   => 'https://images.unsplash.com/photo-1606312619070-d48b4c652a52?w=120&h=120&fit=crop',
    ],
];
@endphp

<div class="flex gap-5 h-full" x-data="ordersPage()">

    {{-- ══════════ LEFT — Cards ══════════ --}}
    <div class="flex-1 min-w-0 flex flex-col gap-4 overflow-hidden">

        {{-- Filter row --}}
        <div class="flex items-center gap-3">

            {{-- Tabs --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                @foreach(['All','On Process','Completed'] as $t)
                <button
                    @click="tab='{{ $t }}'"
                    :class="tab==='{{ $t }}'
                        ? 'bg-[#8B5E1A] text-white shadow-sm'
                        : 'bg-white text-gray-500 border border-gray-200 hover:border-[#C49060] hover:text-[#8B5E1A]'"
                    class="px-5 py-2 rounded-xl text-sm font-medium transition-all duration-200 whitespace-nowrap"
                >{{ $t }}</button>
                @endforeach
            </div>

            {{-- Search — icon KIRI, pakai inline style --}}
            <div style="position:relative; width:16rem; flex-shrink:0; margin-left:auto;">
                <svg style="position:absolute; left:12px; top:50%; transform:translateY(-50%);
                            color:#9ca3af; pointer-events:none;"
                     width="15" height="15" viewBox="0 0 16 16" fill="none">
                    <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M10.5 10.5l3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <input
                    type="text"
                    placeholder="Search order..."
                    style="width:100%; padding:0.6rem 1rem 0.6rem 2.5rem; border-radius:0.75rem;
                           background:#fff; border:1.5px solid #e5e7eb; font-size:0.875rem;
                           color:#4b5563; outline:none; transition:border-color .2s;"
                    onfocus="this.style.borderColor='#8B5E1A'"
                    onblur="this.style.borderColor='#e5e7eb'"
                >
            </div>
        </div>

        {{-- Card grid --}}
        <div class="flex-1 overflow-y-auto pr-0.5">
            <div class="grid grid-cols-2 gap-4 pb-4">
                @foreach($orders as $idx => $o)
                <div
                    @click="select({{ $idx }})"
                    :class="selectedIdx === {{ $idx }} ? 'is-selected' : ''"
                    class="order-card bg-white rounded-2xl p-5 cursor-pointer"
                    style="animation: fadeUp .35s ease both; animation-delay: {{ $idx * .06 }}s"
                >
                    {{-- Header --}}
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl flex-shrink-0 flex items-center justify-center
                                    font-bold text-[13px] text-white"
                             style="background: linear-gradient(135deg,#C49060,#9A6530);">
                            {{ $o['id'] }}
                        </div>
                        <div class="pt-0.5 min-w-0">
                            <p class="font-semibold text-[13px] text-gray-800">{{ $o['name'] }}</p>
                            <p class="text-[11px] text-gray-400 mt-0.5">{{ $o['date'] }}</p>
                            <p class="text-[11px] text-gray-400">Order Type : {{ $o['type'] }}</p>
                        </div>
                    </div>

                    {{-- Items --}}
                    <div class="mb-3">
                        <div class="flex text-[11px] text-gray-400 font-medium mb-2">
                            <span class="flex-1">Items</span>
                            <span class="w-8 text-center">Qty</span>
                            <span class="w-24 text-right">Price</span>
                        </div>
                        @foreach($o['items'] as $item)
                        <div class="flex text-[12px] text-gray-700 mb-1.5 leading-snug">
                            <span class="flex-1">{{ $item['name'] }}</span>
                            <span class="w-8 text-center">{{ $item['qty'] }}</span>
                            <span class="w-24 text-right">{{ $item['price'] }}</span>
                        </div>
                        @endforeach
                    </div>

                    {{-- Total --}}
                    <div class="flex justify-between items-center border-t border-gray-100 pt-3 mb-4">
                        <span class="font-bold text-[14px] text-gray-800">Total</span>
                        <span class="font-bold text-[14px] text-gray-800">{{ $o['total'] }}</span>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-2">
                        <button class="flex-1 py-2.5 rounded-xl border border-gray-200 bg-white
                                       text-[12px] font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                            See Details
                        </button>
                        <button class="flex-1 py-2.5 rounded-xl bg-[#8B5E1A] text-white
                                       text-[12px] font-semibold hover:bg-[#7a4f14] transition-colors">
                            Mark as Ready
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ══════════ RIGHT — Detail Panel ══════════ --}}
    <div
        x-show="showDetail"
        x-transition:enter="transition duration-200 ease-out"
        x-transition:enter-start="opacity-0 translate-x-4"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-4"
        class="w-[320px] flex-shrink-0 bg-white rounded-2xl border border-gray-100
               shadow-[0_2px_24px_rgba(0,0,0,.08)] flex flex-col overflow-hidden"
        style="display:none;"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between px-5 pt-5 pb-4">
            <h2 class="font-bold text-[18px] text-gray-900">Order Details</h2>
            <button
                @click="showDetail = false; selectedIdx = null"
                class="w-7 h-7 flex items-center justify-center rounded-full
                       text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors"
            >
                <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                    <path d="M1 1l10 10M11 1L1 11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </button>
        </div>

        {{-- Meta --}}
        <div class="flex items-start justify-between px-5 pb-4 border-b border-gray-100">
            <div>
                <p class="font-semibold text-[13px] text-gray-900">Recipient : Miguela Veloso</p>
                <p class="text-[11px] text-gray-400 mt-1">15-12-2025 at 10:22 AM</p>
            </div>
            <div class="text-right flex-shrink-0 ml-3">
                <p class="font-bold text-[12px] text-gray-800">Order #71</p>
                <p class="text-[11px] text-gray-400 mt-0.5">Take Away</p>
            </div>
        </div>

        {{-- Items --}}
        <div class="flex-1 overflow-y-auto px-5 py-4 space-y-4">
            @foreach($detailItems as $di)
            <div class="flex items-start gap-3">
                <img src="{{ $di['img'] }}" alt="{{ $di['name'] }}"
                     class="w-14 h-14 rounded-xl object-cover flex-shrink-0
                            transition-transform duration-200 hover:scale-105">
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-[13px] text-gray-900 leading-snug">{{ $di['name'] }}</p>
                    <p class="text-[11px] text-gray-400 mt-0.5 leading-relaxed">{{ $di['sub'] }}</p>
                    @isset($di['note'])
                        <p class="text-[11px] text-gray-400 leading-relaxed">{{ $di['note'] }}</p>
                    @endisset
                    <p class="font-bold text-[13px] text-gray-900 mt-1.5">{{ $di['price'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Summary --}}
        <div class="px-5 py-4 border-t border-gray-100 space-y-2.5">
            <div class="flex justify-between text-[13px]">
                <span class="text-gray-500">Subtotal</span>
                <span class="font-semibold text-gray-800">Rp 102.000</span>
            </div>
            <div class="flex justify-between text-[13px]">
                <span class="text-gray-500">PPN (10%)</span>
                <span class="font-semibold text-gray-800">Rp 10.200</span>
            </div>
            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                <span class="font-bold text-[15px] text-gray-900">Total</span>
                <span class="font-bold text-[15px] text-gray-900">Rp 112.000</span>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="px-5 pb-5 flex gap-2.5">
            <button class="flex-1 py-3 rounded-xl bg-[#8B5E1A] text-white
                           text-[13px] font-semibold hover:bg-[#7a4f14] transition-colors shadow-sm">
                Mark as Ready
            </button>
            <button class="flex-1 py-3 rounded-xl bg-[#FFF5F5] border border-[#FFE0E0]
                           text-red-500 text-[13px] font-semibold hover:bg-red-50 transition-colors">
                Cancel
            </button>
        </div>
    </div>

</div>

<script>
function ordersPage() {
    return {
        tab: 'On Process',
        showDetail: true,
        selectedIdx: 0,
        select(idx) {
            this.selectedIdx = idx;
            this.showDetail  = true;
        }
    }
}
</script>

@endsection