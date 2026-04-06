@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-white overflow-hidden">
        <!-- Login Form -->
        <div class="flex flex-col justify-center py-12 px-4 sm:px-6 w-full max-w-md">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">
                        Login Your Account
                    </h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Experience the best figure store in KhilafStore.
                    </p>
                </div>

                @if (session('success'))
                    <div class="mb-4 bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-10">
                    @csrf

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-bold text-gray-900 mb-2">
                            Username
                        </label>
                        <input id="username" name="username" type="text" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-900 mb-2">
                            Password
                        </label>
                        <input id="password" name="password" type="password" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="mt-2 text-xs">
                            <a href="{{ route('password.request') }}" class="text-gray-900 underline hover:text-gray-700">
                                forgot your password?
                            </a>
                        </div>
                    </div>

                    <!-- Button -->
                    <div>
                        <button type="submit"
                            class="w-full py-4 rounded-xl text-lg font-bold text-white bg-orange-500 hover:bg-orange-600 transition">
                            Login
                        </button>

                        <div class="mt-4 text-center">
                            <a href="{{ route('register') }}"
                                class="text-xs text-orange-500 underline hover:text-orange-600">
                                Don’t have an account? Sign up here
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection