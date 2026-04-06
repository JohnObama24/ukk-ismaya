@extends('layouts.app')

@section('content')
<div class="min-h-screen flex bg-white overflow-hidden">
    <!-- Left Side - Image -->
    <div class="hidden lg:flex lg:w-1/2 relative">
        <!-- Background Image -->
        <img
            src="{{ asset('images/gambar.png') }}"
            class="absolute inset-0 w-full h-full object-cover"
            alt="Auth BG"
        >

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Text Content -->
        <div class="relative z-10 flex flex-col justify-end p-16 text-white max-w-xl">
            <h1 class="text-5xl font-bold mb-4 leading-tight">
                Upgrade your snack time<br>
                with handpicked bites you'll love.
            </h1>

            <p class="text-lg text-gray-200">
                Discover new flavors, limited snacks, and special offers you won't want to miss.
            </p>
        </div>
    </div>

    <!-- Right Side - Forgot Password Form -->
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:w-1/2 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">
                    Reset Password
                </h2>
                <p class="mt-2 text-sm text-gray-500">
                    Enter your details to reset your password directly.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-4 bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-bold text-gray-900 mb-2">
                        Username
                    </label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                    >
                    @error('username')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-900 mb-2">
                        Email Address
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-gray-900 mb-2">
                        New Password
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-900 mb-2">
                        Confirm Password
                    </label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                    >
                </div>

                <!-- Button -->
                <div>
                    <button
                        type="submit"
                        class="w-full py-4 rounded-xl text-lg font-bold text-white bg-orange-600 hover:bg-orange-700 transition"
                    >
                        Reset Password
                    </button>

                    <div class="mt-4 text-center">
                        <a href="{{ route('login') }}"
                           class="text-xs text-orange-600 underline hover:text-orange-500">
                            Back to Login
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
