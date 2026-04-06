@extends('layouts.admin')

@section('content')
<div class="space-y-8 pb-10">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-[#1A1C1E]">Dashboard Overview</h2>
            <p class="text-sm text-gray-400 mt-1 font-medium italic">Welcome back! Here's what's happening today.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-100 rounded-xl text-sm font-bold text-gray-500 shadow-sm">
                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ now()->format('d M, Y') }}
            </span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Sales -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-orange-50 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <div class="bg-orange-50 p-2.5 rounded-xl mb-4 inline-block">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            <text x="9" y="16" font-size="6" font-weight="bold" fill="currentColor">Rp</text>
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Sales</p>
                    <h3 class="text-2xl font-extrabold text-[#1A1C1E]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
                <div class="flex items-center gap-1 text-orange-500 font-bold bg-orange-50 px-2 py-1 rounded-lg text-[10px]">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                    +12.5%
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 text-orange-50 opacity-10 group-hover:scale-110 transition duration-500">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <div class="bg-blue-50 p-2.5 rounded-xl mb-4 inline-block">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Orders</p>
                    <h3 class="text-2xl font-extrabold text-[#1A1C1E]">{{ number_format($totalOrders) }}</h3>
                </div>
                <div class="flex items-center gap-1 text-orange-500 font-bold bg-orange-50 px-2 py-1 rounded-lg text-[10px]">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                    +8.2%
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 text-blue-50 opacity-10 group-hover:scale-110 transition duration-500">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
        </div>

        <!-- New Customers -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-purple-50 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <div class="bg-purple-50 p-2.5 rounded-xl mb-4 inline-block">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">New Customers</p>
                    <h3 class="text-2xl font-extrabold text-[#1A1C1E]">{{ number_format($newCustomers) }}</h3>
                </div>
                <div class="flex items-center gap-1 text-orange-500 font-bold bg-orange-50 px-2 py-1 rounded-lg text-[10px]">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                    +5.4%
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 text-purple-50 opacity-10 group-hover:scale-110 transition duration-500">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Top Selling -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-amber-50 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex items-start justify-between relative z-10">
                <div class="flex-1 min-w-0">
                    <div class="bg-amber-50 p-2.5 rounded-xl mb-4 inline-block">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Top Selling</p>
                    <h3 class="text-lg font-extrabold text-[#1A1C1E] truncate">{{ $topSellingProduct->name ?? 'No Sales' }}</h3>
                </div>
                @if($topSellingProduct && $topSellingProduct->image)
                <img src="{{ asset('storage/' . $topSellingProduct->image) }}" alt="Top Product" class="w-12 h-12 rounded-xl object-cover border-2 border-white shadow-sm transition group-hover:scale-110">
                @else
                <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center border-2 border-white shadow-sm">
                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Charts and Alerts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sales Trend Chart -->
        <div class="lg:col-span-2 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h4 class="text-xl font-extrabold text-[#1A1C1E]">Sales Trend</h4>
                    <p class="text-sm text-gray-400 font-medium">Revenue performance this week</p>
                </div>
                <select class="bg-gray-50 border-transparent rounded-xl text-sm font-bold text-gray-500 focus:ring-orange-500 cursor-pointer">
                    <option>Last 7 Days</option>
                    <option>Last 30 Days</option>
                </select>
            </div>
            <div id="salesChart" class="h-80 w-full"></div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h4 class="text-xl font-extrabold text-[#1A1C1E]">Low Stock Alerts</h4>
                    <p class="text-sm text-gray-400 font-medium italic">Immediate action required</p>
                </div>
                <span class="bg-red-50 text-red-500 px-3 py-1 rounded-full text-xs font-bold">{{ $lowStockProducts->count() }}</span>
            </div>
            
            <div class="space-y-4 flex-grow overflow-auto">
                @forelse($lowStockProducts as $product)
                <div class="flex items-center gap-4 p-4 rounded-2xl bg-[#F8F9FA] group hover:bg-white border border-transparent hover:border-gray-100 transition shadow-sm hover:shadow-md">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 rounded-xl object-cover" alt="{{ $product->name }}">
                    @else
                    <div class="w-12 h-12 bg-gray-200 rounded-xl flex items-center justify-center">
                         <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="flex-1">
                        <h5 class="text-sm font-bold text-[#1A1C1E]">{{ $product->name }}</h5>
                        <p class="text-xs text-red-500 font-medium">Only {{ $product->stock }} units left</p>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="text-[10px] font-extrabold uppercase tracking-widest text-orange-600 hover:text-orange-700">Restock</a>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center h-full text-center py-10">
                    <div class="bg-orange-50 p-4 rounded-full mb-4">
                        <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-gray-500">All inventory in good standing!</p>
                </div>
                @endforelse
            </div>

            <a href="{{ route('admin.products.index') }}" class="mt-8 w-full py-4 px-6 bg-white border border-gray-100 rounded-2xl text-center text-sm font-extrabold text-[#1A1C1E] hover:bg-gray-50 transition shadow-sm">
                View Inventory
            </a>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex items-center justify-between">
            <div>
                <h4 class="text-xl font-extrabold text-[#1A1C1E]">Recent Activities</h4>
                <p class="text-sm text-gray-400 font-medium mt-1">Real-time update of store transactions</p>
            </div>
            <a href="{{ route('admin.orders') }}" class="text-sm font-extrabold text-orange-600 hover:text-orange-700 flex items-center gap-1 group">
                View All 
                <svg class="w-4 h-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#F8F9FA]">
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Event</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Customer</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-right">Amount</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-center">Status</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-right">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($recentOrders as $order)
                    <tr class="hover:bg-[#F8F9FA] transition group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $order->status == 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-orange-50 text-orange-600' }}">
                                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <span class="font-bold text-[#1A1C1E]">New Order #{{ $order->order_number }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-sm font-bold text-gray-500">{{ $order->user->name ?? 'Guest' }}</span>
                        </td>
                        <td class="px-8 py-5 text-right font-extrabold text-[#1A1C1E]">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex justify-center">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-amber-50 text-amber-600',
                                        'processing' => 'bg-blue-50 text-blue-600',
                                        'shipped' => 'bg-purple-50 text-purple-600',
                                        'delivered' => 'bg-orange-50 text-orange-600',
                                        'cancelled' => 'bg-red-50 text-red-600'
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest {{ $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-500' }}">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-right font-bold text-gray-400 text-sm">
                            {{ $order->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var options = {
            series: [{
                name: 'Revenue',
                data: @json($salesData) 
            }],
            chart: {
                type: 'area',
                height: 320,
                toolbar: { show: false },
                fontFamily: 'Plus Jakarta Sans',
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [20, 100, 100, 100]
                }
            },
            colors: ['#10b981'],
            dataLabels: { enabled: false },
            grid: {
                borderColor: '#F1F5F9',
                strokeDashArray: 4,
                padding: { left: 0, right: 0 }
            },
            stroke: {
                curve: 'smooth',
                width: 3,
            },
            xaxis: {
                categories: @json($dates),
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#94A3B8', fontWeight: 600 }
                }
            },
            yaxis: {
                labels: {
                    style: { colors: '#94A3B8', fontWeight: 600 },
                    formatter: function(val) {
                        return 'Rp ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                }
            },
            tooltip: {
                theme: 'light',
                x: { show: true },
                y: {
                    formatter: function(val) {
                        return 'Rp ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#salesChart"), options);
        chart.render();
    });
</script>
@endsection
