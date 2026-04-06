<?php

use Illuminate\Support\Facades\Route;

// Public Auth Routes
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::get('/forgot-password', [\App\Http\Controllers\AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [\App\Http\Controllers\AuthController::class, 'directResetPassword'])->name('password.email');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Protected Routes (Require Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
    
    Route::post('/products/{id}/reviews', [\App\Http\Controllers\ProductController::class, 'storeReview'])->name('products.reviews.store');
    
    // User-only Routes (Cart, Checkout, Wishlist)
    Route::middleware(['role:user'])->group(function () {
        Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
        Route::get('/add-to-cart/{id}', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.add');
        Route::get('/remove-from-cart/{id}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.remove');
        Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
        Route::get('/orders/{id}/invoice', [\App\Http\Controllers\OrderController::class, 'invoice'])->name('orders.invoice');
        Route::post('/orders/{id}/complete', [\App\Http\Controllers\OrderController::class, 'markAsCompleted'])->name('orders.complete');
        Route::post('/products/{id}/ratings', [\App\Http\Controllers\ProductController::class, 'storeRating'])
    ->name('products.ratings.store');
        Route::get('/checkout', [\App\Http\Controllers\CartController::class, 'checkoutPage'])->name('checkout.index');
        Route::post('/checkout', [\App\Http\Controllers\CartController::class, 'processCheckout'])->name('checkout.process');
        Route::post('/buy-now/{id}', [\App\Http\Controllers\CartController::class, 'buyNow'])->name('buy_now');
        Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
        Route::get('/wishlist/add/{productId}', [\App\Http\Controllers\WishlistController::class, 'store'])->name('wishlist.add');
        Route::get('/wishlist/remove/{productId}', [\App\Http\Controllers\WishlistController::class, 'destroy'])->name('wishlist.remove');
    });

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/orders', [\App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
    Route::patch('/admin/orders/{id}/status', [\App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
    Route::get('/admin/customers', [\App\Http\Controllers\AdminController::class, 'customers'])->name('admin.customers');
    Route::get('/admin/reports', [\App\Http\Controllers\AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/reports/export', [\App\Http\Controllers\AdminController::class, 'downloadReport'])->name('admin.reports.export');

    // Admin Product CRUD
    Route::resource('/admin/products', \App\Http\Controllers\Admin\ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
});
