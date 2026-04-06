@extends('layouts.admin')

@section('content')
<div class="space-y-8 pb-10">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-[#1A1C1E]">Customer Management</h2>
            <p class="text-sm text-gray-400 mt-1 font-medium italic">View and manage your registered customers.</p>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#F8F9FA]">
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Customer Name</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Email Address</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-center">Joined Date</th>
                        <th class="px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-[#F8F9FA] transition group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-600 font-extrabold text-sm">
                                    {{ substr($customer->name, 0, 1) }}
                                </div>
                                <h5 class="text-sm font-extrabold text-[#1A1C1E]">{{ $customer->name }}</h5>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-sm text-gray-500 font-medium">{{ $customer->email }}</span>
                        </td>
                        <td class="px-8 py-5 text-center text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                            {{ $customer->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-orange-50 text-orange-600">
                                Active Customer
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center text-gray-400 font-bold uppercase tracking-widest text-xs">
                            No customers found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($customers->hasPages())
        <div class="p-8 bg-[#F8F9FA] border-t border-gray-100">
            {{ $customers->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
