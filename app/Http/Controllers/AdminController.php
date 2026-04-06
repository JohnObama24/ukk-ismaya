<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Total Sales (Sum of total_price from completed/delivered orders)
        // Adjust status check based on what you consider a "sale" (e.g., 'delivered', 'shipped', 'processing')
        // For now, let's assume any non-pending order counts as a sale or potential sale, or strictly 'delivered'.
        // Let's use all orders that are NOT pending or cancelled for revenue calculation.
        $totalRevenue = \App\Models\Order::whereNotIn('status', ['pending', 'cancelled'])->sum('total_price');
        
        // 2. Total Orders (Count of all orders)
        $totalOrders = \App\Models\Order::count();
        
        // 3. New Customers (Users registered in the last 30 days)
        $newCustomers = \App\Models\User::where('role', 'user')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        $totalUsers = \App\Models\User::where('role', 'user')->count();

        // 4. Low Stock Products (Stock < 10)
        $lowStockProducts = \App\Models\Product::where('stock', '<', 10)
            ->take(5)
            ->get();
            
        // 5. Recent Activities (Latest 5 orders)
        $recentOrders = \App\Models\Order::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 6. Top Selling Snack (Most ordered product) - Simplified logic
        // We need a join with order_items to calculate this accurately.
        $topSellingProduct = \App\Models\Product::withCount('orderItems') // Assuming relationship exists, or we use a join
            ->orderBy('order_items_count', 'desc')
            ->first();

        // 7. Sales Chart Data (Last 7 Days)
        $salesData = [];
        $dates = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates[] = now()->subDays($i)->format('D'); // Mon, Tue, etc.
            $dailySales = \App\Models\Order::whereDate('created_at', $date)
                ->whereNotIn('status', ['pending', 'cancelled'])
                ->sum('total_price');
            $salesData[] = $dailySales;
        }

        return view('admin.dashboard', compact(
            'totalRevenue', 
            'totalOrders', 
            'newCustomers', 
            'totalUsers',
            'lowStockProducts', 
            'recentOrders',
            'topSellingProduct',
            'salesData',
            'dates'
        ));
    }

    public function orders(Request $request)
    {
        $query = \App\Models\Order::with(['user', 'items.product']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.orders', compact('orders'));
    }

    public function customers()
    {
        $customers = \App\Models\User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.customers', compact('customers'));
    }

    public function reports()
    {
        // 1. Lifetime Revenue
        $lifetimeRevenue = \App\Models\Order::whereNotIn('status', ['pending', 'cancelled'])->sum('total_price');
        
        // 2. Average Order Value
        $orderCount = \App\Models\Order::whereNotIn('status', ['pending', 'cancelled'])->count();
        $averageOrderValue = $orderCount > 0 ? $lifetimeRevenue / $orderCount : 0;

        // 3. Category Sales Distribution
        $categoryStats = \App\Models\Category::select('categories.name')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereNotIn('orders.status', ['pending', 'cancelled'])
            ->selectRaw('SUM(order_items.quantity * order_items.price) as revenue')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        // 4. Monthly Sales Trends (Last 6 Months)
        $monthlyTrends = [];
        $monthLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthLabels[] = $date->format('M Y');
            $revenue = \App\Models\Order::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->whereNotIn('status', ['pending', 'cancelled'])
                ->sum('total_price');
            $monthlyTrends[] = (float)$revenue;
        }

        // 5. Top 5 Best Selling Snacks
        $topProducts = \App\Models\Product::select('products.*')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereNotIn('orders.status', ['pending', 'cancelled'])
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->groupBy('products.id', 'products.name', 'products.slug', 'products.description', 'products.price', 'products.stock', 'products.category_id', 'products.image', 'products.created_at', 'products.updated_at')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        return view('admin.reports', compact(
            'lifetimeRevenue',
            'averageOrderValue',
            'categoryStats',
            'monthlyTrends',
            'monthLabels',
            'topProducts'
        ));
    }

    public function downloadReport()
    {
        $orders = \App\Models\Order::with('user')
            ->whereNotIn('status', ['pending', 'cancelled'])
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = "sales_report_" . now()->format('Y-m-d_H-i') . ".csv";
        $handle = fopen('php://output', 'w');
        
        // Add UTF-8 BOM for Excel compatibility
        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Headers
        fputcsv($handle, ['Order Number', 'Customer', 'Date', 'Total Revenue', 'Status']);

        foreach ($orders as $order) {
            fputcsv($handle, [
                $order->order_number,
                $order->user->name,
                $order->created_at->format('Y-m-d H:i'),
                $order->total_price,
                strtoupper($order->status)
            ]);
        }

        return response()->stream(
            function () use ($handle) {
                fclose($handle);
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ]
        );
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}
