<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Print Button -->
    <div class="no-print fixed top-4 right-4 flex space-x-2">
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Print Invoice
        </button>
        <a href="{{ route('orders.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back
        </a>
    </div>

    <!-- Invoice -->
    <div class="max-w-3xl mx-auto my-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 text-white px-8 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">ShopModern</h1>
                    <p class="text-blue-200 mt-1">Invoice</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold">#{{ $order->order_number }}</p>
                    <p class="text-blue-200">{{ $order->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="px-8 py-6 border-b border-gray-200">
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Billed To</h3>
                    <p class="mt-2 text-gray-900 font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-gray-600">{{ auth()->user()->email }}</p>
                </div>
                <div class="text-right">
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Order Status</h3>
                    <p class="mt-2">
                        @if($order->status == 'delivered')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">Delivered</span>
                        @elseif($order->status == 'shipped')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">Shipped</span>
                        @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">{{ ucfirst($order->status) }}</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="px-8 py-6">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 text-sm font-medium text-gray-500 uppercase tracking-wide">Item</th>
                        <th class="text-center py-3 text-sm font-medium text-gray-500 uppercase tracking-wide">Qty</th>
                        <th class="text-right py-3 text-sm font-medium text-gray-500 uppercase tracking-wide">Price</th>
                        <th class="text-right py-3 text-sm font-medium text-gray-500 uppercase tracking-wide">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr class="border-b border-gray-100">
                        <td class="py-4 text-gray-900">{{ $item->product ? $item->product->name : 'Product Unavailable' }}</td>
                        <td class="py-4 text-center text-gray-600">{{ $item->quantity }}</td>
                        <td class="py-4 text-right text-gray-600">${{ number_format($item->price, 2) }}</td>
                        <td class="py-4 text-right text-gray-900 font-medium">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="bg-gray-50 px-8 py-6">
            <div class="flex justify-end">
                <div class="w-64">
                    <div class="flex justify-between py-2 border-t-2 border-gray-300">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span class="text-lg font-bold text-blue-600">${{ number_format($order->total_price, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-100 px-8 py-4 text-center text-sm text-gray-500">
            <p>Thank you for shopping with ShopModern!</p>
            <p class="mt-1">For questions, contact support@shopmodern.com</p>
        </div>
    </div>
</body>
</html>
