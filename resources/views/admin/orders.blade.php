@extends('layouts.admin')

@section('content')
<div class="space-y-8 pb-10">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-[#1A1C1E]">Order Management</h2>
            <p class="text-sm text-gray-400 mt-1 font-medium italic">Track and update customer transactions.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-orange-50 border border-orange-100 text-orange-600 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Filter Section -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-hide">
        <a href="{{ route('admin.orders') }}" class="px-5 py-2 rounded-xl text-xs font-extrabold uppercase tracking-widest transition {{ !request('status') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200' : 'bg-white text-gray-400 border border-gray-100 hover:bg-gray-50' }}">
            All Orders
        </a>
        <a href="{{ route('admin.orders', ['status' => 'pending']) }}" class="px-5 py-2 rounded-xl text-xs font-extrabold uppercase tracking-widest transition {{ request('status') == 'pending' ? 'bg-orange-500 text-white shadow-lg shadow-orange-200' : 'bg-white text-gray-400 border border-gray-100 hover:bg-gray-50' }}">
            Pending
        </a>
        <a href="{{ route('admin.orders', ['status' => 'processing']) }}" class="px-5 py-2 rounded-xl text-xs font-extrabold uppercase tracking-widest transition {{ request('status') == 'processing' ? 'bg-orange-500 text-white shadow-lg shadow-orange-200' : 'bg-white text-gray-400 border border-gray-100 hover:bg-gray-50' }}">
            Processing
        </a>
        <a href="{{ route('admin.orders', ['status' => 'shipped']) }}" class="px-5 py-2 rounded-xl text-xs font-extrabold uppercase tracking-widest transition {{ request('status') == 'shipped' ? 'bg-orange-500 text-white shadow-lg shadow-orange-200' : 'bg-white text-gray-400 border border-gray-100 hover:bg-gray-50' }}">
            Shipped
        </a>
        <a href="{{ route('admin.orders', ['status' => 'delivered']) }}" class="px-5 py-2 rounded-xl text-xs font-extrabold uppercase tracking-widest transition {{ request('status') == 'delivered' ? 'bg-orange-500 text-white shadow-lg shadow-orange-200' : 'bg-white text-gray-400 border border-gray-100 hover:bg-gray-50' }}">
            Delivered
        </a>
        <a href="{{ route('admin.orders', ['status' => 'cancelled']) }}" class="px-5 py-2 rounded-xl text-xs font-extrabold uppercase tracking-widest transition {{ request('status') == 'cancelled' ? 'bg-orange-500 text-white shadow-lg shadow-orange-200' : 'bg-white text-gray-400 border border-gray-100 hover:bg-gray-50' }}">
            Cancelled
        </a>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#F8F9FA]">
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Order Info</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Customer</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-right">Total Amount</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-center">Status</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                    <tr class="hover:bg-[#F8F9FA] transition group">
                        <td class="px-8 py-5">
                            <h5 class="text-sm font-extrabold text-[#1A1C1E]">#{{ $order->order_number }}</h5>
                            <p class="text-[10px] text-gray-400 font-medium">{{ $order->created_at->format('M d, Y • H:i') }}</p>
                        </td>
                        <td class="px-8 py-5">
                            <div class="font-bold text-[#1A1C1E] text-sm">{{ $order->user->name ?? 'Guest' }}</div>
                            <div class="text-[10px] text-gray-400 font-medium">{{ $order->user->email ?? '' }}</div>
                        </td>
                        <td class="px-8 py-5 text-right font-extrabold text-orange-600">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-8 py-5 text-center">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-50 text-yellow-600',
                                    'processing' => 'bg-blue-50 text-blue-600',
                                    'shipped' => 'bg-purple-50 text-purple-600',
                                    'delivered' => 'bg-orange-50 text-orange-600',
                                    'cancelled' => 'bg-red-50 text-red-600'
                                ];
                                $class = $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-600';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest {{ $class }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex justify-end gap-2">
                                @if($order->status == 'pending')
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="processing">
                                        <button type="submit" class="px-3 py-1 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg text-[10px] font-extrabold uppercase tracking-widest transition">Accept</button>
                                    </form>
                                @elseif($order->status == 'processing')
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="shipped">
                                        <button type="submit" class="px-3 py-1 bg-purple-50 text-purple-600 hover:bg-purple-600 hover:text-white rounded-lg text-[10px] font-extrabold uppercase tracking-widest transition">Ship</button>
                                    </form>
                                @elseif($order->status == 'shipped')
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="delivered">
                                        <button type="submit" class="px-3 py-1 bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white rounded-lg text-[10px] font-extrabold uppercase tracking-widest transition">Deliver</button>
                                    </form>
                                @endif
                                
                                @if(!in_array($order->status, ['delivered', 'cancelled']))
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirm('Cancel this order?')">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="p-1 px-2 text-red-400 hover:text-red-600 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center">
                            <div class="flex flex-col items-center gap-2 text-gray-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p class="text-sm font-bold uppercase tracking-widest">No orders found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="p-8 bg-[#F8F9FA] border-t border-gray-100">
            {{ $orders->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
