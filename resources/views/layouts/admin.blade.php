<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminKhilaf - Management Dashboard</title>
    <!-- Modern Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8F9FA] text-[#1A1C1E] antialiased" x-data="{ notificationsOpen: false }">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-100 flex-shrink-0 hidden lg:flex flex-col sticky top-0 h-screen">
            <div class="p-6 flex items-center gap-3 cursor-default">
                <div class="bg-orange-600 p-1.5 rounded-lg shadow-sm font-bold text-white text-xs">
                    SK
                </div>
                <div>
                    <h1 class="font-extrabold text-[#1A1C1E] text-lg leading-tight">AdminKhilaf</h1>
                    <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Management Dashboard</p>
                </div>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-orange-600 font-bold' : 'text-gray-500 hover:bg-gray-50 transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.products.*') ? 'bg-orange-50 text-orange-600 font-bold' : 'text-gray-500 hover:bg-gray-50 transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Inventory
                </a>
                <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.orders*') ? 'bg-orange-50 text-orange-600 font-bold' : 'text-gray-500 hover:bg-gray-50 transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Orders
                </a>
                <a href="{{ route('admin.customers') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.customers*') ? 'bg-orange-50 text-orange-600 font-bold' : 'text-gray-500 hover:bg-gray-50 transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Customers
                </a>
                <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.reports*') ? 'bg-orange-50 text-orange-600 font-bold' : 'text-gray-500 hover:bg-gray-50 transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Reports
                </a>
            </nav>

            <div class="p-4 border-t border-gray-100 space-y-2">
                <a href="{{ route('admin.reports.export') }}" class="w-full flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-orange-100 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export Report
                </a>

                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-white border border-gray-100 text-gray-500 hover:text-red-600 hover:bg-red-50 font-bold py-3 rounded-xl transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar -->
            <header class="bg-white border-b border-gray-100 h-20 flex items-center justify-between pl-8 pr-4 sticky top-0 z-40">
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" placeholder="Search orders..." class="block w-full pl-10 pr-3 py-2 border-transparent bg-gray-50 rounded-xl focus:outline-none focus:bg-white focus:ring-2 focus:ring-orange-500 transition sm:text-sm">
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <!-- Notification Bell -->
                    <div class="relative" @click.away="notificationsOpen = false">
                        <button @click="notificationsOpen = !notificationsOpen" class="relative p-2 text-gray-400 hover:text-orange-500 hover:bg-orange-50 rounded-xl transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            @if($totalAdminNotifications > 0)
                            <span class="absolute top-2 right-2 w-4 h-4 bg-red-500 rounded-full border-2 border-white flex items-center justify-center text-[8px] text-white font-bold leading-none">
                                {{ $totalAdminNotifications }}
                            </span>
                            @endif
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="notificationsOpen" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                             class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 py-4 z-50 overflow-hidden">
                            <div class="px-5 pb-3 border-b border-gray-50 flex items-center justify-between">
                                <h3 class="font-extrabold text-sm text-[#1A1C1E]">Notifications</h3>
                                <span class="bg-orange-100 text-orange-600 text-[10px] font-extrabold px-2 py-0.5 rounded-full">{{ $totalAdminNotifications }} NEW</span>
                            </div>
                            
                            <div class="max-h-[350px] overflow-y-auto">
                                @forelse($adminNotifications as $notification)
                                <a href="{{ $notification['link'] }}" class="flex items-start gap-4 px-5 py-4 hover:bg-gray-50 transition border-b border-gray-50 last:border-0">
                                    <div class="flex-shrink-0 w-10 h-10 {{ $notification['bg'] }} {{ $notification['color'] }} rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $notification['icon'] }}"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs font-bold text-[#1A1C1E]">{{ $notification['title'] }}</p>
                                        <p class="text-[11px] text-gray-500 mt-0.5 line-clamp-2">{{ $notification['message'] }}</p>
                                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-2 italic group-hover:text-orange-500">{{ $notification['time'] }}</p>
                                    </div>
                                </a>
                                @empty
                                <div class="px-5 py-10 text-center">
                                    <div class="w-16 h-16 bg-gray-50 text-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                    </div>
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">No new notifications</p>
                                </div>
                                @endforelse
                            </div>
                            
                            <div class="px-5 pt-3 border-t border-gray-50">
                                <a href="{{ route('admin.orders') }}" class="block text-center text-[10px] font-extrabold text-orange-600 hover:text-orange-700 transition uppercase tracking-widest">View All Activities</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('profile.index') }}" class="flex items-center gap-3 pl-6 border-l border-gray-100 group">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-[#1A1C1E] group-hover:text-orange-600 transition">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-gray-400 font-semibold uppercase">Admin Manager</p>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=10b981&color=fff" alt="Profile" class="w-10 h-10 rounded-full border-2 border-orange-50 group-hover:border-orange-500 transition flex-shrink-0">
                    </a>
                </div>

            </header>

            <!-- Page Content -->
            <main class="flex-grow p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
