<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel Ecommerce')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">E</span>
                        </div>
                        <span class="text-xl font-semibold text-gray-900">EcomStore</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">
                        Products
                    </a>
                    <a href="#" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">
                        Categories
                    </a>
                    <a href="#" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">
                        About
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('cart.index') }}" class="relative inline-flex items-center px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0V19a2 2 0 002 2h7a2 2 0 002-2v-4.5M9 19h6"></path>
                        </svg>
                        Cart
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">E</span>
                        </div>
                        <span class="text-xl font-semibold text-gray-900">EcomStore</span>
                    </div>
                    <p class="text-gray-600 max-w-md">
                        Your trusted online marketplace for quality products at competitive prices.
                        Shop with confidence and enjoy fast, reliable delivery.
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-600 transition-colors">Products</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Categories</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">About Us</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Shipping Info</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Returns</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-200 mt-8 pt-8 text-center">
                <p class="text-gray-600">&copy; {{ date('Y') }} EcomStore. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
