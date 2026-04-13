@extends('layouts.app')
@section('title','Sales Report')
@section('page-title','Sales Report')
@section('page-subtitle','View and download sales summary by period')

@section('content')

<style>
@keyframes fadeUp {
    from { opacity:0; transform:translateY(12px); }
    to   { opacity:1; transform:translateY(0); }
}
.stat-card {
    background:#fff;
    border:1.5px solid #EDE8E0;
    border-radius:1rem;
    padding:1.25rem 1.5rem;
    flex:1;
    animation: fadeUp .35s ease both;
}
.report-table { width:100%; border-collapse:collapse; }
.report-table th {
    background:#fff;
    font-size:13px;
    font-weight:600;
    color:#374151;
    padding:13px 20px;
    text-align:left;
    border-bottom:1.5px solid #F0EBE3;
    white-space:nowrap;
}
.report-table td {
    padding:14px 20px;
    font-size:13px;
    color:#374151;
    border-bottom:1px solid #F5F0EB;
}
.report-table tbody tr:hover { background:#FDFAF7; }
.sort-icon { display:inline-flex; flex-direction:column; gap:2px; margin-left:6px; vertical-align:middle; }
.sort-icon .up   { display:block; width:0; height:0; border-left:4px solid transparent; border-right:4px solid transparent; border-bottom:4px solid #9ca3af; }
.sort-icon .down { display:block; width:0; height:0; border-left:4px solid transparent; border-right:4px solid transparent; border-top:4px solid #9ca3af; }
.page-btn {
    width:36px; height:36px; border-radius:8px; border:1.5px solid #E5DDD5;
    background:#fff; font-size:13px; font-weight:500; color:#6b7280;
    display:inline-flex; align-items:center; justify-content:center; cursor:pointer;
    transition:background .15s, border-color .15s;
}
.page-btn:hover { background:#FDF6EE; border-color:#C49060; color:#8B5E1A; }
.page-btn.active { background:#8B5E1A; border-color:#8B5E1A; color:#fff; font-weight:700; }
.page-btn:disabled { opacity:.4; cursor:default; }
</style>

@php
$rows = [
    ['date'=>'01 February 2026','orders'=>43,'items'=>71,'revenue'=>'Rp 2.150.000','avg'=>'Rp. 50.000'],
    ['date'=>'02 February 2026','orders'=>43,'items'=>71,'revenue'=>'Rp 3.240.000','avg'=>'Rp. 52.000'],
    ['date'=>'03 February 2026','orders'=>43,'items'=>71,'revenue'=>'Rp 2.150.000','avg'=>'Rp. 50.000'],
    ['date'=>'04 February 2026','orders'=>43,'items'=>71,'revenue'=>'Rp 3.240.000','avg'=>'Rp. 52.000'],
    ['date'=>'05 February 2026','orders'=>43,'items'=>71,'revenue'=>'Rp 2.150.000','avg'=>'Rp. 50.000'],
    ['date'=>'06 February 2026','orders'=>43,'items'=>71,'revenue'=>'Rp 3.240.000','avg'=>'Rp. 52.000'],
    ['date'=>'07 February 2026','orders'=>43,'items'=>71,'revenue'=>'Rp 2.150.000','avg'=>'Rp. 50.000'],
    ['date'=>'08 February 2026','orders'=>43,'items'=>71,'revenue'=>'Rp 3.240.000','avg'=>'Rp. 52.000'],
    ['date'=>'09 February 2026','orders'=>43,'items'=>71,'revenue'=>'Rp 2.150.000','avg'=>'Rp. 50.000'],
    ['date'=>'10 February 2026','orders'=>43,'items'=>71,'revenue'=>'Rp 3.240.000','avg'=>'Rp. 52.000'],
];
@endphp

<div x-data="{ tab: 'date' }">

    {{-- ══ Stat cards ══ --}}
    <div style="display:flex; gap:1rem; margin-bottom:1.5rem;">

        {{-- Total Revenue --}}
        <div class="stat-card" style="animation-delay:.00s">
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:.75rem;">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" style="color:#9ca3af">
                    <circle cx="10" cy="10" r="9" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M10 6v8M7.5 8.5C7.5 7.4 8.6 7 10 7s2.5.7 2.5 1.5S11.4 10 10 10s-2.5.7-2.5 1.5S8.6 13 10 13s2.5-.4 2.5-1.5"
                          stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
                <span style="font-size:13px; color:#6b7280; font-weight:500;">Total Revenue</span>
            </div>
            <p style="font-size:24px; font-weight:700; color:#1f2937; margin-bottom:.5rem;">Rp 19.420.000</p>
            <div style="display:flex; align-items:center; gap:6px;">
                <span style="display:inline-flex; align-items:center; gap:3px; padding:2px 8px; border-radius:999px;
                             background:#ECFDF5; color:#10b981; font-size:11px; font-weight:600;">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                        <path d="M5 8V2M2 5l3-3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    6.3%
                </span>
                <span style="font-size:12px; color:#9ca3af;">than last month</span>
            </div>
        </div>

        {{-- Total Orders --}}
        <div class="stat-card" style="animation-delay:.06s">
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:.75rem;">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" style="color:#9ca3af">
                    <path d="M3 5h14M3 10h14M3 15h8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <span style="font-size:13px; color:#6b7280; font-weight:500;">Total Orders</span>
            </div>
            <p style="font-size:24px; font-weight:700; color:#1f2937; margin-bottom:.5rem;">876 Orders</p>
            <div style="display:flex; align-items:center; gap:6px;">
                <span style="display:inline-flex; align-items:center; gap:3px; padding:2px 8px; border-radius:999px;
                             background:#ECFDF5; color:#10b981; font-size:11px; font-weight:600;">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                        <path d="M5 8V2M2 5l3-3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    4.1%
                </span>
                <span style="font-size:12px; color:#9ca3af;">than last month</span>
            </div>
        </div>

        {{-- Average Order Value --}}
        <div class="stat-card" style="animation-delay:.12s">
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:.75rem;">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" style="color:#9ca3af">
                    <rect x="2" y="10" width="3" height="8" rx="1" stroke="currentColor" stroke-width="1.5"/>
                    <rect x="8.5" y="6" width="3" height="12" rx="1" stroke="currentColor" stroke-width="1.5"/>
                    <rect x="15" y="2" width="3" height="16" rx="1" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                <span style="font-size:13px; color:#6b7280; font-weight:500;">Average Order Value</span>
            </div>
            <p style="font-size:24px; font-weight:700; color:#1f2937; margin-bottom:.5rem;">Rp 22.180</p>
            <div style="display:flex; align-items:center; gap:6px;">
                <span style="display:inline-flex; align-items:center; gap:3px; padding:2px 8px; border-radius:999px;
                             background:#FFF1F2; color:#f43f5e; font-size:11px; font-weight:600;">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                        <path d="M5 2v6M2 5l3 3 3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    6.3%
                </span>
                <span style="font-size:12px; color:#9ca3af;">than last month</span>
            </div>
        </div>

        {{-- Total Items Sold --}}
        <div class="stat-card" style="animation-delay:.18s">
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:.75rem;">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" style="color:#9ca3af">
                    <rect x="2" y="2" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                    <rect x="11" y="2" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                    <rect x="2" y="11" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                    <rect x="11" y="11" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                <span style="font-size:13px; color:#6b7280; font-weight:500;">Total Items Sold</span>
            </div>
            <p style="font-size:24px; font-weight:700; color:#1f2937; margin-bottom:.5rem;">1.314 Items</p>
            <div style="display:flex; align-items:center; gap:6px;">
                <span style="display:inline-flex; align-items:center; gap:3px; padding:2px 8px; border-radius:999px;
                             background:#ECFDF5; color:#10b981; font-size:11px; font-weight:600;">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                        <path d="M5 8V2M2 5l3-3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    5.2%
                </span>
                <span style="font-size:12px; color:#9ca3af;">than last month</span>
            </div>
        </div>
    </div>

    {{-- ══ Filter & Export row ══ --}}
    <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:1.25rem; flex-wrap:wrap;">

        {{-- View tabs --}}
        <div style="display:flex; gap:0.5rem;">
            @foreach(['date'=>'By Date','menu'=>'By Menu','staff'=>'By Staff'] as $key=>$label)
            <button
                @click="tab='{{ $key }}'"
                :class="tab==='{{ $key }}'
                    ? 'bg-[#8B5E1A] text-white shadow-sm border-transparent'
                    : 'bg-white text-gray-500 border-gray-200 hover:border-[#C49060] hover:text-[#8B5E1A]'"
                class="px-5 py-2 rounded-xl text-sm font-medium border transition-all duration-200 whitespace-nowrap"
            >{{ $label }}</button>
            @endforeach
        </div>

        {{-- Date range picker --}}
        <div style="display:flex; align-items:center; gap:10px; padding:0.55rem 1rem;
                    border-radius:0.875rem; border:1.5px solid #E5DDD5; background:#fff;
                    font-size:13px; color:#374151; cursor:pointer; margin-left:auto;
                    transition:border-color .2s;"
             onmouseover="this.style.borderColor='#C49060'"
             onmouseout="this.style.borderColor='#E5DDD5'">
            <svg width="15" height="15" viewBox="0 0 16 16" fill="none" style="color:#9ca3af; flex-shrink:0;">
                <rect x="1" y="2.5" width="14" height="12.5" rx="2" stroke="currentColor" stroke-width="1.4"/>
                <path d="M1 6.5h14" stroke="currentColor" stroke-width="1.4"/>
                <path d="M5 1v3M11 1v3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
            </svg>
            <span>01 Feb 2026 - 28 Feb 2026</span>
        </div>

        {{-- Export button --}}
        <button style="display:inline-flex; align-items:center; gap:8px;
                       padding:0.6rem 1.25rem; border-radius:0.875rem;
                       background:#8B5E1A; border:none; color:#fff;
                       font-size:13px; font-weight:600; cursor:pointer; transition:background .2s;"
                onmouseover="this.style.background='#7a4f14'"
                onmouseout="this.style.background='#8B5E1A'">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                <path d="M8 1v9M5 7l3 3 3-3" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 12v2a1 1 0 001 1h10a1 1 0 001-1v-2" stroke="white" stroke-width="1.6" stroke-linecap="round"/>
            </svg>
            Export
        </button>
    </div>

    {{-- ══ Table ══ --}}
    <div style="background:#fff; border-radius:1rem; border:1.5px solid #EDE8E0; overflow:hidden;">
        <table class="report-table">
            <thead>
                <tr>
                    @foreach(['Date','Orders','Items Sold','Revenue','Avg. Order Value'] as $col)
                    <th>
                        {{ $col }}
                        <span class="sort-icon">
                            <span class="up"></span>
                            <span class="down"></span>
                        </span>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                <tr>
                    <td>{{ $row['date'] }}</td>
                    <td>{{ $row['orders'] }}</td>
                    <td>{{ $row['items'] }}</td>
                    <td>{{ $row['revenue'] }}</td>
                    <td>{{ $row['avg'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div style="display:flex; align-items:center; justify-content:space-between;
                    padding:14px 20px; border-top:1.5px solid #F0EBE3;">
            <div style="display:flex; align-items:center; gap:0.5rem; font-size:13px; color:#6b7280;">
                <span>Showing</span>
                <select style="padding:4px 28px 4px 10px; border-radius:8px; border:1.5px solid #E5DDD5;
                               background:#fff; font-size:13px; color:#374151; outline:none; cursor:pointer;
                               appearance:none; -webkit-appearance:none;
                               background-image:url(\"data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E\");
                               background-repeat:no-repeat; background-position:right 8px center;">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span>of 38 entries</span>
            </div>
            <div style="display:flex; align-items:center; gap:6px;">
                <button class="page-btn" disabled>
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none">
                        <path d="M6 1L1 6l5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none">
                        <path d="M1 1l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

</div>

@endsection