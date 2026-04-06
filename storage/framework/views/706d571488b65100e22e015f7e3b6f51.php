<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'KhilafStore')); ?></title>
    <!-- Modern Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <div class="min-h-screen flex flex-col">
        <?php if(!Route::is('login') && !Route::is('register')): ?>
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 py-2">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <?php if(auth()->check() && auth()->user()->role === 'admin'): ?>
                        <!-- Static Logo for Admins -->
                        <div class="flex items-center gap-2 cursor-default">
                            <div class="bg-orange-600 p-1.5 rounded-lg shadow-sm font-bold text-white text-xs">
                                SK
                            </div>
                            <span class="text-xl font-bold text-gray-900 tracking-tight">KhilafStore</span>
                        </div>
                        <?php else: ?>
                        <!-- Clickable Logo for Users/Guests -->
                        <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2">
                            <div class="bg-orange-600 p-1.5 rounded-lg shadow-sm font-bold text-white text-xs">
                                SK
                            </div>
                            <span class="text-xl font-bold text-gray-900 tracking-tight">KhilafStore</span>
                        </a>
                        <?php endif; ?>
                    </div>

                    <!-- Profile Section -->
                    <div class="flex items-center gap-3">
                        <?php if(auth()->check() && auth()->user()->role === 'admin'): ?>
                        <!-- Admin Profile Synchronization -->
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 pl-4 border-l border-gray-100 group">
                            <div class="text-right hidden sm:block">
                                <p class="text-xs font-bold text-[#1A1C1E] group-hover:text-orange-600 transition"><?php echo e(auth()->user()->name); ?></p>
                                <p class="text-[9px] text-gray-400 font-semibold uppercase tracking-wider">Admin Manager</p>
                            </div>
                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name)); ?>&background=f97316&color=fff" alt="Profile" class="w-9 h-9 rounded-full border-2 border-orange-50 group-hover:border-orange-500 transition flex-shrink-0">
                        </a>
                        <?php else: ?>
                        <!-- Regular User Profile Icon -->
                        <a href="<?php echo e(route('profile.index')); ?>" 
                           class="p-2 <?php echo e(request()->routeIs('profile*') ? 'text-orange-600 bg-orange-50' : 'text-gray-500 hover:text-orange-600 hover:bg-gray-100'); ?> rounded-full transition" 
                           title="My Profile">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
        <?php endif; ?>

        <!-- Page Content -->
        <main class="flex-grow">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <?php if(!Route::is('login') && !Route::is('register')): ?>
        <!-- Footer -->
        <footer class="bg-white border-t border-gray-100 mt-20 pb-10">
            <div class="max-w-7xl mx-auto pt-16 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12">
                    <!-- Brand Section -->
                    <div class="col-span-2">
                        <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2 mb-6">
                            <div class="bg-orange-600 p-1.5 rounded-lg font-bold text-white text-xs">
                                SK
                            </div>
                            <span class="text-xl font-bold text-gray-900 tracking-tight">KhilafStore</span>
                        </a>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-xs mb-6">
                            The ultimate destination for merchandise lovers. Premium quality merchandise, imported products, and lots more merchandise coming soon.
                        </p>
                        <div class="flex space-x-5">
                            <a href="#" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Links Column 1 -->
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 mb-6 uppercase tracking-wider">Quick Links</h4>
                        <ul class="space-y-4 text-sm text-gray-500">
                            <li><a href="#" class="hover:text-orange-600 transition">New Arrivals</a></li>
                            <li><a href="#" class="hover:text-orange-600 transition">Best Sellers</a></li>
                            <li><a href="#" class="hover:text-orange-600 transition">Seasonal Sale</a></li>
                            <li><a href="#" class="hover:text-orange-600 transition">Gift Cards</a></li>
                        </ul>
                    </div>

                    <!-- Links Column 2 -->
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 mb-6 uppercase tracking-wider">Support</h4>
                        <ul class="space-y-4 text-sm text-gray-500">
                            <li><a href="#" class="hover:text-orange-600 transition">Help Center</a></li>
                            <li><a href="#" class="hover:text-orange-600 transition">Shipping Info</a></li>
                            <li><a href="#" class="hover:text-orange-600 transition">Returns & Exchanges</a></li>
                            <li><a href="#" class="hover:text-orange-600 transition">Order Tracking</a></li>
                        </ul>
                    </div>

                    <!-- Links Column 3 -->
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 mb-6 uppercase tracking-wider">Contact Us</h4>
                        <ul class="space-y-4 text-sm text-gray-500">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>halo@KhilafStore.com</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>+62 812-3456-7890</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                    <p class="text-xs text-gray-400">
                        &copy; 2026 KhilafStore Inc. Semua hak dilindungi.
                    </p>
                    <div class="flex space-x-6 text-xs text-gray-400">
                        <a href="#" class="hover:text-gray-600">Privacy Policy</a>
                        <a href="#" class="hover:text-gray-600">Terms of Service</a>
                        <a href="#" class="hover:text-gray-600">Cookie Settings</a>
                    </div>
                </div>
            </div>
        </footer>
        <?php endif; ?>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\Projek-UKK\resources\views/layouts/app.blade.php ENDPATH**/ ?>