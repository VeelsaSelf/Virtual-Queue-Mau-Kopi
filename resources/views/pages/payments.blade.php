@extends('layouts.app')
@section('title','Payments')
@section('page-title','Payments')
@section('page-subtitle','Review and confirm customer payments')

@section('content')

<style>
@keyframes fadeUp {
    from { opacity:0; transform:translateY(14px); }
    to   { opacity:1; transform:translateY(0); }
}
.pay-card {
    border: 1.5px solid #EDE8E0;
    transition: box-shadow .18s ease, border-color .18s ease;
}
.pay-card:hover {
    box-shadow: 0 4px 20px rgba(139,94,26,.09);
    border-color: #D4B08A;
}
.pay-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}
</style>

@php
$payments = [
    ['id' => 90,  'name' => 'Miguela Veloso', 'date' => '15-12-2025 at 10:22 AM', 'method' => 'Cash', 'status' => 'Pending', 'total' => 'Rp 80.000'],
    ['id' => 91,  'name' => 'Miguela Veloso', 'date' => '15-12-2025 at 10:22 AM', 'method' => 'Cash', 'status' => 'Pending', 'total' => 'Rp 80.000'],
    ['id' => 93,  'name' => 'Miguela Veloso', 'date' => '15-12-2025 at 10:22 AM', 'method' => 'Cash', 'status' => 'Pending', 'total' => 'Rp 80.000'],
    ['id' => 96,  'name' => 'Miguela Veloso', 'date' => '15-12-2025 at 10:22 AM', 'method' => 'Cash', 'status' => 'Pending', 'total' => 'Rp 80.000'],
    ['id' => 99,  'name' => 'Miguela Veloso', 'date' => '15-12-2025 at 10:22 AM', 'method' => 'Cash', 'status' => 'Pending', 'total' => 'Rp 80.000'],
    ['id' => 100, 'name' => 'Miguela Veloso', 'date' => '15-12-2025 at 10:22 AM', 'method' => 'Cash', 'status' => 'Pending', 'total' => 'Rp 80.000'],
    ['id' => 105, 'name' => 'Miguela Veloso', 'date' => '15-12-2025 at 10:22 AM', 'method' => 'Cash', 'status' => 'Pending', 'total' => 'Rp 80.000'],
];
@endphp

<div x-data="paymentsPage()">

    {{-- ══ Filter row ══ --}}
    <div style="display:flex; align-items:center; gap:0.5rem; flex-wrap:wrap; margin-bottom:1.25rem;">

        {{-- Payment Method tabs --}}
        @foreach(['All','Cash','Cashless'] as $m)
        <button
            @click="method='{{ $m }}'"
            :class="method==='{{ $m }}'
                ? 'bg-[#8B5E1A] text-white shadow-sm'
                : 'bg-white text-gray-500 border border-gray-200 hover:border-[#C49060] hover:text-[#8B5E1A]'"
            class="px-5 py-2 rounded-xl text-sm font-medium transition-all duration-200 whitespace-nowrap"
        >{{ $m }}</button>
        @endforeach

        {{-- Divider --}}
        <div style="width:1px; height:1.5rem; background:#e5e7eb; margin:0 0.25rem;"></div>

        {{-- Payment Status tabs --}}
        @foreach(['All','Pending','Confirmed','Rejected'] as $s)
        <button
            @click="status='{{ $s }}'"
            :class="status==='{{ $s }}'
                ? 'bg-[#8B5E1A] text-white shadow-sm'
                : 'bg-white text-gray-500 border border-gray-200 hover:border-[#C49060] hover:text-[#8B5E1A]'"
            class="px-5 py-2 rounded-xl text-sm font-medium transition-all duration-200 whitespace-nowrap"
        >{{ $s }}</button>
        @endforeach

        {{-- Search — icon kiri --}}
        <div style="position:relative; width:14rem; flex-shrink:0; margin-left:auto;">
            <svg style="position:absolute; left:12px; top:50%; transform:translateY(-50%);
                        color:#9ca3af; pointer-events:none;"
                 width="15" height="15" viewBox="0 0 16 16" fill="none">
                <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.5"/>
                <path d="M10.5 10.5l3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <input
                type="text"
                placeholder="Search name..."
                style="width:100%; padding:0.55rem 1rem 0.55rem 2.5rem; border-radius:0.75rem;
                       background:#fff; border:1.5px solid #e5e7eb; font-size:0.875rem;
                       color:#4b5563; outline:none; transition:border-color .2s;"
                onfocus="this.style.borderColor='#8B5E1A'"
                onblur="this.style.borderColor='#e5e7eb'"
            >
        </div>
    </div>

    {{-- ══ Card grid — 3 kolom pakai inline style ══ --}}
    <div class="pay-grid">
        @foreach($payments as $idx => $p)
        <div
            class="pay-card bg-white rounded-2xl p-5"
            style="animation: fadeUp .35s ease both; animation-delay: {{ $idx * .05 }}s"
        >
            {{-- Card header --}}
            <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:1.25rem;">
                <div style="display:flex; align-items:center; gap:0.75rem;">
                    <div style="width:44px; height:44px; border-radius:0.75rem; flex-shrink:0;
                                display:flex; align-items:center; justify-content:center;
                                font-weight:700; font-size:13px; color:#fff;
                                background: linear-gradient(135deg,#C49060,#9A6530);">
                        {{ $p['id'] }}
                    </div>
                    <div>
                        <p class="font-semibold text-[13px] text-gray-800">{{ $p['name'] }}</p>
                        <p class="text-[11px] text-gray-400 mt-0.5">{{ $p['date'] }}</p>
                    </div>
                </div>
                {{-- Status dot --}}
                <div style="width:32px; height:32px; border-radius:9999px; background:#FFFBEB;
                            border:1px solid #FDE68A; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <div style="width:12px; height:12px; border-radius:9999px; background:#F59E0B;"></div>
                </div>
            </div>

            {{-- Payment info --}}
            <div style="margin-bottom:1rem; display:flex; flex-direction:column; gap:0.5rem;">
                <div style="display:flex; justify-content:space-between; font-size:13px;">
                    <span style="color:#9ca3af;">Payment Method</span>
                    <span style="color:#374151;">{{ $p['method'] }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:13px;">
                    <span style="color:#9ca3af;">Payment Status</span>
                    <span style="font-weight:600; color:#1f2937;">{{ $p['status'] }}</span>
                </div>
            </div>

            {{-- Total --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <span style="font-weight:700; font-size:15px; color:#1f2937;">Total</span>
                <span style="font-weight:700; font-size:15px; color:#1f2937;">{{ $p['total'] }}</span>
            </div>

            {{-- Buttons --}}
            <div style="display:flex; gap:0.5rem;">
                <button style="flex:1; padding:0.6rem; border-radius:0.75rem;
                               background:#FFF0F0; border:1.5px solid #FFD6D6;
                               color:#ef4444; font-size:13px; font-weight:600; cursor:pointer;
                               transition:background .2s;"
                        onmouseover="this.style.background='#fee2e2'"
                        onmouseout="this.style.background='#FFF0F0'">
                    Reject
                </button>
                <button style="flex:1; padding:0.6rem; border-radius:0.75rem;
                               background:#8B5E1A; border:none;
                               color:#fff; font-size:13px; font-weight:600; cursor:pointer;
                               transition:background .2s;"
                        onmouseover="this.style.background='#7a4f14'"
                        onmouseout="this.style.background='#8B5E1A'">
                    Confirm
                </button>
            </div>
        </div>
        @endforeach
    </div>

</div>

<script>
function paymentsPage() {
    return {
        method: 'Cash',
        status: 'Pending',
    }
}
</script>

@endsection