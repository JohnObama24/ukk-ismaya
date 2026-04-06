<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('layouts.admin', function ($view) {
            $lowStockCount = \App\Models\Product::where('stock', '<', 10)->count();
            $recentOrdersCount = \App\Models\Order::where('created_at', '>=', now()->subHours(24))->count();
            $totalNotifications = $lowStockCount + $recentOrdersCount;

            $notifications = collect();

            if ($lowStockCount > 0) {
                $notifications->push([
                    'type' => 'stock',
                    'title' => 'Low Stock Alert',
                    'message' => $lowStockCount . ' snacks are running low on stock.',
                    'time' => 'Action required',
                    'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                    'color' => 'text-red-500',
                    'bg' => 'bg-red-50',
                    'link' => route('admin.dashboard') // Link to dashboard where low stock is listed
                ]);
            }

            if ($recentOrdersCount > 0) {
                $notifications->push([
                    'type' => 'order',
                    'title' => 'New Orders',
                    'message' => 'You have ' . $recentOrdersCount . ' new orders in the last 24h.',
                    'time' => 'Check latest',
                    'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
                    'color' => 'text-blue-500',
                    'bg' => 'bg-blue-50',
                    'link' => route('admin.orders')
                ]);
            }

            $view->with('adminNotifications', $notifications)
                 ->with('totalAdminNotifications', $totalNotifications);
        });
    }
}
