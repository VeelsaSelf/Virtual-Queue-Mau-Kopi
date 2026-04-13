@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'View and download sales summary by period')

@section('content')

<style>
/* ─── Keyframes ─────────────────────────────────────────── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}
@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.88); }
    to   { opacity: 1; transform: scale(1); }
}
@keyframes barGrow {
    from { height: 0 !important; }
}
@keyframes lineIn {
    from { stroke-dashoffset: 1000; }
    to   { stroke-dashoffset: 0; }
}
@keyframes areaIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}
@keyframes progressFill {
    from { width: 0 !important; }
}
@keyframes pulseDot {
    0%,100% { transform: scale(1); opacity: 1; }
    50%       { transform: scale(1.7); opacity: 0.5; }
}
/* PERBAIKAN: Hapus translateX(-50%) dari animasi agar tidak merusak centering elemen */
@keyframes tooltipPop {
    from { opacity: 0; transform: translateY(5px) scale(0.94); }
    to   { opacity: 1; transform: translateY(0)   scale(1); }
}
@keyframes slideRankIn {
    from { opacity: 0; transform: translateX(-10px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* ─── Stat cards ────────────────────────────────────────── */
.stat-card {
    transition: transform .2s ease, box-shadow .2s ease;
}
.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(139,94,26,.13);
}

/* ─── Bar chart ─────────────────────────────────────────── */
.bar-rect {
    animation: barGrow .55s ease both;
    transform-origin: bottom;
    transition: filter .15s, transform .15s;
}
.bar-wrap:hover .bar-rect {
    filter: brightness(1.1);
    transform: scaleY(1.04);
    transform-origin: bottom;
}
.bar-tip {
    opacity: 0;
    pointer-events: none;
    transition: opacity .15s, transform .15s;
    transform: translateX(-50%) translateY(5px);
}
.bar-wrap:hover .bar-tip {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}

/* ─── Line chart ────────────────────────────────────────── */
.chart-line {
    stroke-dasharray: 1000;
    stroke-dashoffset: 1000;
    animation: lineIn 1.2s ease forwards;
}
.chart-area { animation: areaIn 1.4s ease forwards; }

/* ─── Donut ─────────────────────────────────────────────── */
.donut-seg {
    transition: stroke-width .2s ease, filter .2s ease;
    cursor: pointer;
}
.donut-seg:hover { stroke-width: 17; filter: brightness(1.1); }

/* ─── Progress bar ──────────────────────────────────────── */
.prog-fill { animation: progressFill .9s ease both; }

/* ─── Menu rows ─────────────────────────────────────────── */
.menu-row {
    border-radius: 12px;
    padding: 5px 4px;
    transition: background .18s, transform .18s;
}
.menu-row:hover { background: #faf6ef; transform: translateX(3px); }
.menu-row img   { transition: transform .2s; }
.menu-row:hover img { transform: scale(1.07); }

/* ─── Helpers ───────────────────────────────────────────── */
.anim-up  { animation: fadeUp  .5s ease both; }
.anim-in  { animation: fadeIn  .4s ease both; }
.anim-sc  { animation: scaleIn .35s ease both; }
.anim-tip { animation: tooltipPop .35s ease both; }
.pulse-dot { animation: pulseDot 2s ease-in-out infinite; }
</style>

@php
/* ── Bar chart data ── */
$hours    = ['10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00'];
$values   = [3,6,9,16,10,8,11,9,18,28,14,5];
$max      = max($values);
$peakIdx  = array_search($max, $values);          // 9  → "19:00"

/* ── Line chart data ── */
$days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
$rev  = [210000,280000,360000,295000,410000,520000,380000];
$maxR = max($rev);
$pts  = [];
foreach ($rev as $i => $v) {
    $pts[] = ['x' => ($i / (count($rev)-1)) * 100,
              'y' => 100 - (($v / $maxR) * 90) - 5];
}
$polyline = implode(' ', array_map(fn($p) => $p['x'].','.$p['y'], $pts));
$area  = 'M'.$pts[0]['x'].',100 L'.$pts[0]['x'].','.$pts[0]['y'];
foreach (array_slice($pts,1) as $p) $area .= ' L'.$p['x'].','.$p['y'];
$area .= ' L'.$pts[count($pts)-1]['x'].',100 Z';
$wedPt = $pts[2];   // Wednesday

/* ── Donut data ── */
$payments = [
    ['label'=>'Cash',       'pct'=>40,'count'=>51,'color'=>'#8B5E1A'],
    ['label'=>'E-Wallet',   'pct'=>17,'count'=>22,'color'=>'#D4B08A'],
    ['label'=>'Debit/Card', 'pct'=>25,'count'=>32,'color'=>'#BDBDBD'],
    ['label'=>'QRIS',       'pct'=>18,'count'=>23,'color'=>'#E8D0A0'],
];
$cx=50; $cy=50; $r=38;
$circ = 2*M_PI*$r; $gap = 2;

/* ── Top menu ── */
$menu = [
    ['rank'=>1,'name'=>'Iced Latte',                'price'=>'Rp 35.000','orders'=>22,'img'=>'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=80&h=80&fit=crop'],
    ['rank'=>2,'name'=>'Chicken Teriyaki Rice Bowl','price'=>'Rp 35.000','orders'=>22,'img'=>'https://images.unsplash.com/photo-1771384552858-feb0574f958d?q=80&w=200&auto=format&fit=crop'],
    ['rank'=>3,'name'=>'Chocolate Brownie',         'price'=>'Rp 35.000','orders'=>22,'img'=>'https://images.unsplash.com/photo-1606312619070-d48b4c652a52?w=80&h=80&fit=crop'],
    ['rank'=>4,'name'=>'Chocolate Brownie',         'price'=>'Rp 35.000','orders'=>22,'img'=>'https://images.unsplash.com/photo-1606312619070-d48b4c652a52?w=80&h=80&fit=crop'],
    ['rank'=>5,'name'=>'Chocolate Brownie',         'price'=>'Rp 35.000','orders'=>22,'img'=>'https://images.unsplash.com/photo-1606312619070-d48b4c652a52?w=80&h=80&fit=crop'],
];
@endphp

<div class="grid grid-cols-[1fr_300px] gap-5 min-h-full">

    {{-- ══════════ LEFT COLUMN ══════════ --}}
    <div class="space-y-5">

        {{-- ── 4 Stat Cards ── --}}
        <div class="grid grid-cols-2 gap-4">

            {{-- Revenue Today --}}
            <div class="stat-card bg-white rounded-2xl p-5 shadow-card anim-up" style="animation-delay:.05s">
                <div class="flex items-center gap-2 text-gray-400 text-xs font-medium mb-3">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.4"/><path d="M8 5v6M6.5 6.5h2a1 1 0 010 2H7a1 1 0 000 2h2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                    Revenue Today
                </div>
                <p class="font-display font-bold text-[22px] text-gray-800 leading-none mb-3">Rp 780.000</p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600">
                    <svg width="9" height="9" viewBox="0 0 10 10" fill="none"><path d="M5 8V2M5 2L2 5M5 2l3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    6.3%
                </span>
                <span class="text-xs text-gray-400 ml-1">than yesterday</span>
            </div>

            {{-- Orders Today --}}
            <div class="stat-card bg-white rounded-2xl p-5 shadow-card anim-up" style="animation-delay:.10s">
                <div class="flex items-center gap-2 text-gray-400 text-xs font-medium mb-3">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 3h10a1 1 0 011 1v8a1 1 0 01-1 1H3a1 1 0 01-1-1V4a1 1 0 011-1z" stroke="currentColor" stroke-width="1.4"/><path d="M5 7h6M5 9.5h4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                    Orders Today
                </div>
                <p class="font-display font-bold text-[22px] text-gray-800 leading-none mb-3">48 Orders</p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600">
                    <svg width="9" height="9" viewBox="0 0 10 10" fill="none"><path d="M5 8V2M5 2L2 5M5 2l3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    4.1%
                </span>
                <span class="text-xs text-gray-400 ml-1">than yesterday</span>
            </div>

            {{-- Average Order Value --}}
            <div class="stat-card bg-white rounded-2xl p-5 shadow-card anim-up" style="animation-delay:.15s">
                <div class="flex items-center gap-2 text-gray-400 text-xs font-medium mb-3">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><rect x="1" y="9" width="3" height="6" rx="1" fill="currentColor"/><rect x="6" y="5" width="3" height="10" rx="1" fill="currentColor"/><rect x="11" y="1" width="3" height="14" rx="1" fill="currentColor"/></svg>
                    Average Order Value
                </div>
                <p class="font-display font-bold text-[22px] text-gray-800 leading-none mb-3">Rp 21.800</p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-500">
                    <svg width="9" height="9" viewBox="0 0 10 10" fill="none"><path d="M5 2v6M5 8L2 5M5 8l3-3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    6.3%
                </span>
                <span class="text-xs text-gray-400 ml-1">than yesterday</span>
            </div>

            {{-- Items Sold --}}
            <div class="stat-card bg-white rounded-2xl p-5 shadow-card anim-up" style="animation-delay:.20s">
                <div class="flex items-center gap-2 text-gray-400 text-xs font-medium mb-3">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><rect x="2" y="2" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.4"/><rect x="9" y="2" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.4"/><rect x="2" y="9" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.4"/><rect x="9" y="9" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.4"/></svg>
                    Items Sold
                </div>
                <p class="font-display font-bold text-[22px] text-gray-800 leading-none mb-3">95 Items</p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600">
                    <svg width="9" height="9" viewBox="0 0 10 10" fill="none"><path d="M5 8V2M5 2L2 5M5 2l3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    5.2%
                </span>
                <span class="text-xs text-gray-400 ml-1">than yesterday</span>
            </div>
        </div>

        {{-- ── Peak Order Time ── --}}
        <div class="bg-white rounded-2xl p-5 shadow-card anim-up" style="animation-delay:.25s">
            <h3 class="font-semibold text-[15px] text-gray-800 mb-5">Peak Order Time</h3>

            <div class="relative" style="height:200px;">

                {{-- Y labels --}}
                <div class="absolute left-0 top-0 bottom-6 flex flex-col justify-between text-xs text-gray-300 text-right pr-2 w-7">
                    @foreach([30,25,20,15,10,5,0] as $y)<span>{{ $y }}</span>@endforeach
                </div>

                {{-- Bars --}}
                <div class="absolute left-8 right-0 top-0 bottom-6 flex items-end gap-1.5">
                    @foreach($values as $i => $val)
                        @php $pct = round(($val/$max)*100); $isPeak = ($i===$peakIdx); @endphp
                        {{-- PERBAIKAN: Tooltip dimasukkan ke dalam wrapper masing-masing agar otomatis sejajar di tengah bar --}}
                        <div class="bar-wrap flex-1 flex flex-col items-center justify-end h-full relative cursor-pointer">
                            
                            @if($isPeak)
                                {{-- Peak always-on tooltip --}}
                               <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-6 z-20 pointer-events-auto">
                                    <div class="anim-tip" style="animation-delay:.9s;">
                                        <div class="bg-[#2c1a06] text-white text-xs rounded-xl px-3 py-2 whitespace-nowrap shadow-tooltip text-center">
                                            <div class="font-semibold">{{ $hours[$peakIdx] }} - {{ $hours[$peakIdx+1] ?? '21:30' }}</div>
                                            <div>{{ $values[$peakIdx] }} Orders</div>
                                            <div class="flex items-center justify-center gap-1 text-gray-300 mt-0.5 text-[10px]">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><circle cx="5" cy="5" r="4" stroke="currentColor" stroke-width="1.2"/><path d="M5 3v2l1 1" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                                                Peak Time
                                            </div>
                                        </div>
                                        <div class="flex justify-center">
                                            <div class="w-0 h-0" style="border-left:5px solid transparent;border-right:5px solid transparent;border-top:6px solid #2c1a06;"></div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Per-bar hover tooltip --}}
                            <div class="bar-tip absolute bottom-full mb-1 left-1/2 bg-[#2c1a06] text-white text-[10px] rounded-lg px-2.5 py-1.5 whitespace-nowrap z-10 shadow-tooltip">
                                <div class="font-semibold">{{ $hours[$i] }}</div>
                                <div>{{ $val }} Orders</div>
                                <div class="absolute top-full left-1/2 -translate-x-1/2 w-0 h-0" style="border-left:4px solid transparent;border-right:4px solid transparent;border-top:4px solid #2c1a06;"></div>
                            </div>
                            <div class="bar-rect w-full rounded-t-md"
                                 style="height:{{ $pct }}%; background:{{ $isPeak ? '#8B5E1A' : '#E8D9C0' }}; animation-delay:{{ 0.3 + $i*0.04 }}s;"></div>
                        </div>
                    @endforeach
                </div>

                {{-- X labels --}}
                <div class="absolute left-8 right-0 bottom-0 flex gap-1.5">
                    @foreach($hours as $h)
                        <div class="flex-1 text-center text-xxs text-gray-300">{{ $h }}</div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ── Weekly Revenue + Payment Method ── --}}
        <div class="grid grid-cols-2 gap-4">

            {{-- Weekly Revenue --}}
            <div class="bg-white rounded-2xl p-5 shadow-card anim-up" style="animation-delay:.30s">
                <h3 class="font-semibold text-[15px] text-gray-800 mb-5">Weekly Revenue</h3>
                <div class="relative" style="height:160px;">

                    {{-- Y labels --}}
                    <div class="absolute left-0 top-0 bottom-6 flex flex-col justify-between text-xxs text-gray-300 pr-1 w-9">
                        @foreach([750000,600000,450000,300000,150000,0] as $l)
                            <span>{{ $l >= 1000 ? ($l/1000).'k' : '0k' }}</span>
                        @endforeach
                    </div>

                    {{-- SVG line chart --}}
                    <div class="absolute left-10 right-0 top-0 bottom-6">
                        <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full overflow-visible">
                            <defs>
                                <linearGradient id="aG" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%"   stop-color="#8B5E1A" stop-opacity=".18"/>
                                    <stop offset="100%" stop-color="#8B5E1A" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                            <path class="chart-area" d="{{ $area }}" fill="url(#aG)" style="animation-delay:.5s"/>
                            <polyline class="chart-line" points="{{ $polyline }}" fill="none" stroke="#8B5E1A" stroke-width="1.8" stroke-linejoin="round" stroke-linecap="round" style="animation-delay:.4s"/>
                            @foreach($pts as $i => $pt)
                                <circle cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}"
                                    r="{{ $i===2 ? 2.5 : 1.5 }}"
                                    fill="{{ $i===2 ? '#8B5E1A' : '#C49060' }}"
                                    class="anim-in" style="animation-delay:{{ 0.9+$i*0.06 }}s"/>
                            @endforeach
                            <line x1="{{ $wedPt['x'] }}" y1="{{ $wedPt['y'] }}" x2="{{ $wedPt['x'] }}" y2="100"
                                  stroke="#8B5E1A" stroke-width=".8" stroke-dasharray="2,2" opacity=".4"/>
                        </svg>

                        {{-- PERBAIKAN: Pisahkan logic positioning (left, translate) ke wrapper parent agar animasi scale/Y tidak bentrok --}}
                        <div class="absolute z-10 pointer-events-none -translate-x-1/2"
                             style="left:{{ $wedPt['x'] }}%; top:calc({{ $wedPt['y'] }}% - 58px);">
                             <div class="anim-tip" style="animation-delay:1.1s">
                                <div class="bg-[#2c1a06] text-white text-xs rounded-xl px-3 py-2 whitespace-nowrap shadow-tooltip text-center">
                                    <div class="font-semibold">Wednesday</div>
                                    <div>Revenue: <span class="font-bold">Rp 360.000</span></div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-0 h-0" style="border-left:5px solid transparent;border-right:5px solid transparent;border-top:6px solid #2c1a06;"></div>
                                </div>
                             </div>
                        </div>
                    </div>

                    {{-- X labels --}}
                    <div class="absolute left-10 right-0 bottom-0 flex justify-between">
                        @foreach($days as $d)<span class="text-xxs text-gray-300">{{ $d }}</span>@endforeach
                    </div>
                </div>
            </div>

            {{-- Payment Method Distribution --}}
            <div class="bg-white rounded-2xl p-5 shadow-card anim-up" style="animation-delay:.35s"
                 x-data="{ active: null }">
                <h3 class="font-semibold text-[15px] text-gray-800 mb-2">Payment Method Distribution</h3>

                {{-- Tooltip above donut --}}
                <div class="flex justify-center -mb-6 mt-2 relative z-10">
                    {{-- PERBAIKAN: Bungkus keseluruhan box dan panah tooltip dalam container `.anim-tip` flex agar terpusat rapi secara berbarengan --}}
                    <div class="inline-flex flex-col items-center anim-tip" style="animation-delay:1.2s">
                        <div class="bg-[#2c1a06] text-white text-xs rounded-xl px-3 py-2 whitespace-nowrap shadow-tooltip text-center">
                            <div class="font-semibold">17.2%</div>
                            <div>E-Wallet: <span class="font-bold">22</span></div>
                        </div>
                        <div class="w-0 h-0" style="border-left:5px solid transparent;border-right:5px solid transparent;border-top:6px solid #2c1a06;"></div>
                    </div>
                </div>

                {{-- Donut --}}
                <div class="relative flex justify-center mb-3">
                    <svg viewBox="0 0 100 100" class="w-[150px] h-[150px] -rotate-90">
                        @php $offset = 0; @endphp
                        @foreach($payments as $pi => $p)
                            @php
                                $dash  = ($p['pct']/100)*$circ - ($gap*$r*M_PI/180);
                                $space = $circ - $dash;
                            @endphp
                            <circle class="donut-seg"
                                cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}"
                                fill="transparent"
                                stroke="{{ $p['color'] }}"
                                stroke-width="14"
                                stroke-dasharray="{{ $dash }} {{ $space }}"
                                stroke-dashoffset="{{ -$offset*$circ/100 }}"
                                stroke-linecap="round"
                                style="animation:fadeIn .5s ease both; animation-delay:{{ .5+$pi*.12 }}s;"
                                @mouseenter="active={{ $pi }}"
                                @mouseleave="active=null"
                            />
                            @php $offset += $p['pct']; @endphp
                        @endforeach
                    </svg>

                    {{-- Center label --}}
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <template x-if="active===null">
                            <div class="text-center anim-sc">
                                <span class="font-display font-bold text-2xl text-gray-800 leading-none">128</span>
                                <div class="text-xs text-gray-400 mt-0.5">Transactions</div>
                            </div>
                        </template>
                        @foreach($payments as $pi => $p)
                        <template x-if="active==={{ $pi }}">
                            <div class="text-center anim-sc">
                                <span class="font-display font-bold text-xl leading-none"
                                      style="color:{{ $p['color']==='#BDBDBD'?'#888':$p['color'] }}">{{ $p['pct'] }}%</span>
                                <div class="text-xs text-gray-400 mt-0.5">{{ $p['label'] }}</div>
                                <div class="text-xs font-semibold text-gray-600">{{ $p['count'] }} txn</div>
                            </div>
                        </template>
                        @endforeach
                    </div>
                </div>

                {{-- Legend --}}
                <div class="flex flex-wrap gap-x-4 gap-y-1.5 justify-center">
                    @foreach($payments as $pi => $p)
                    <div class="flex items-center gap-1.5 cursor-pointer transition-opacity duration-150"
                         :style="active!==null && active!=={{ $pi }} ? 'opacity:.3' : 'opacity:1'"
                         @mouseenter="active={{ $pi }}"
                         @mouseleave="active=null">
                        <span class="w-2.5 h-2.5 rounded-sm" style="background:{{ $p['color'] }}"></span>
                        <span class="text-xs text-gray-500">{{ $p['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>{{-- /grid weekly+payment --}}
    </div>{{-- /left column --}}

    {{-- ══════════ RIGHT COLUMN ══════════ --}}
    <div class="space-y-4">

        {{-- Order Status Distribution --}}
        <div class="bg-white rounded-2xl p-5 shadow-card anim-up" style="animation-delay:.15s">
            <h3 class="font-semibold text-[15px] text-gray-800 mb-1">Order Status Distribution</h3>

            <div class="flex items-baseline gap-2 mb-2">
                <span class="font-display font-bold text-[26px] text-gray-800">48 Orders</span>
                <span class="flex items-center gap-1.5 text-xs text-gray-500">
                    <span class="pulse-dot w-2 h-2 rounded-full bg-amber-400 inline-block"></span>
                    Normal Traffic
                </span>
            </div>

            {{-- Animated progress bar --}}
            <div class="flex rounded-full overflow-hidden h-3 mb-4 gap-0.5">
                <div class="prog-fill rounded-l-full" style="width:71%;background:#8B5E1A;animation-delay:.5s"></div>
                <div class="prog-fill"               style="width:19%;background:#D4B08A;animation-delay:.65s"></div>
                <div class="prog-fill rounded-r-full" style="width:10%;background:#E8E0D8;animation-delay:.80s"></div>
            </div>

            <div class="space-y-2">
                @foreach([
                    ['color'=>'#8B5E1A','label'=>'Completed',  'orders'=>'34 Orders','pct'=>'71%'],
                    ['color'=>'#D4B08A','label'=>'In Progress', 'orders'=>'9 Orders', 'pct'=>'19%'],
                    ['color'=>'#E8E0D8','label'=>'Cancelled',   'orders'=>'5 Orders', 'pct'=>'10%'],
                ] as $row)
                <div class="flex items-center justify-between text-sm group cursor-default">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-sm transition-transform duration-150 group-hover:scale-125"
                              style="background:{{ $row['color'] }}"></span>
                        <span class="text-gray-600">{{ $row['label'] }}:</span>
                        <span class="font-medium text-gray-700">{{ $row['orders'] }}</span>
                    </div>
                    <span class="font-semibold text-gray-700">{{ $row['pct'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Top Selling Menu --}}
        <div class="bg-white rounded-2xl p-5 shadow-card anim-up" style="animation-delay:.20s">
            <h3 class="font-semibold text-[15px] text-gray-800 mb-4">Top Selling Menu</h3>

            <div class="space-y-1">
                @foreach($menu as $i => $item)
                <div class="menu-row flex items-center gap-3"
                     style="animation:slideRankIn .4s ease both; animation-delay:{{ .4+$i*.07 }}s">
                    <div class="relative flex-shrink-0">
                        <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}"
                             class="w-[52px] h-[52px] rounded-xl object-cover">
                        <span class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-[#2c1a06] text-white text-[9px] font-bold flex items-center justify-center">#{{ $item['rank'] }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-700 truncate leading-snug">{{ $item['name'] }}</p>
                        <p class="font-display font-bold text-[13px] text-gray-800 mt-0.5">{{ $item['price'] }}</p>
                    </div>
                    <span class="text-xs text-gray-400 flex-shrink-0">{{ $item['orders'] }} Orders</span>
                </div>
                @endforeach
            </div>
        </div>

    </div>{{-- /right column --}}
</div>{{-- /main grid --}}
@endsection