@extends('layouts.app')

@section('title', 'Shop Premium Products - EcomStore')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Discover Amazing Products
            </h1>
            <p class="text-xl md:text-2xl text-primary-100 mb-8 max-w-3xl mx-auto">
                Shop from our curated collection of premium products with unbeatable prices and fast delivery
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Professional Filters Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden sticky top-24">
                <!-- Filter Header -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Refine Search</h3>
                        </div>
                        @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                            <a href="{{ route('home') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                                Clear All
                            </a>
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    <form method="GET" action="{{ route('home') }}" class="space-y-8">
                        <!-- Search Section -->
                        <div class="space-y-3">
                            <label for="search" class="block text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                Product Search
                            </label>
                            <div class="relative group">
                                <input type="text" id="search" name="search" value="{{ request('search') }}"
                                       class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all duration-200 text-gray-900 placeholder-gray-500"
                                       placeholder="Search for products...">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                @if(request('search'))
                                    <button type="button" onclick="document.getElementById('search').value=''; this.closest('form').submit();"
                                            class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Price Range Section -->
                        <div class="space-y-4">
                            <label class="block text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                Price Range
                            </label>
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="relative">
                                        <label class="block text-xs font-medium text-gray-600 mb-2">Minimum</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">$</span>
                                            <input type="number" name="min_price" value="{{ request('min_price') }}"
                                                   class="w-full pl-8 pr-3 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all duration-200 text-gray-900"
                                                   placeholder="0">
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <label class="block text-xs font-medium text-gray-600 mb-2">Maximum</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">$</span>
                                            <input type="number" name="max_price" value="{{ request('max_price') }}"
                                                   class="w-full pl-8 pr-3 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all duration-200 text-gray-900"
                                                   placeholder="∞">
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Price Filters -->
                                <div class="grid grid-cols-2 gap-2">
                                    <button type="button" onclick="setPriceRange(0, 50)"
                                            class="px-3 py-2 text-xs font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                                        Under $50
                                    </button>
                                    <button type="button" onclick="setPriceRange(50, 100)"
                                            class="px-3 py-2 text-xs font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                                        $50 - $100
                                    </button>
                                    <button type="button" onclick="setPriceRange(100, 500)"
                                            class="px-3 py-2 text-xs font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                                        $100 - $500
                                    </button>
                                    <button type="button" onclick="setPriceRange(500, null)"
                                            class="px-3 py-2 text-xs font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                                        Over $500
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3 pt-4 border-t border-gray-200">
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white py-3.5 px-6 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                                Apply Filters
                            </button>

                            @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                                <a href="{{ route('home') }}"
                                   class="w-full block text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-6 rounded-xl font-medium transition-colors">
                                    Reset All Filters
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
        function setPriceRange(min, max) {
            document.querySelector('input[name="min_price"]').value = min || '';
            document.querySelector('input[name="max_price"]').value = max || '';
        }
        </script>

        <!-- Products Grid -->
        <div class="lg:col-span-3">
            <!-- Professional Category Filter Pills -->
            <div class="mb-8">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <!-- Category Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Shop by Category</h3>
                        </div>
                    </div>

                    <!-- Category Pills -->
                    <div class="p-6">
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                            <!-- All Categories -->
                            <a href="{{ route('home', array_merge(request()->except('category'), ['category' => ''])) }}"
                               class="group flex flex-col items-center p-4 rounded-xl transition-all duration-200 {{ !request('category') ? 'bg-primary-500 text-white shadow-lg' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }}">
                                <div class="w-12 h-12 {{ !request('category') ? 'bg-white/20' : 'bg-gradient-to-br from-gray-100 to-gray-200' }} rounded-xl flex items-center justify-center mb-3 group-hover:scale-105 transition-transform">
                                    <svg class="w-6 h-6 {{ !request('category') ? 'text-white' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-center">All Products</span>
                                <span class="text-xs {{ !request('category') ? 'text-white/80' : 'text-gray-500' }} mt-1">
                                    {{ $categories->sum(function($cat) { return $cat->products->count(); }) }} items
                                </span>
                            </a>

                            <!-- Individual Categories -->
                            @foreach($categories as $category)
                                <a href="{{ route('home', array_merge(request()->except('category'), ['category' => $category->id])) }}"
                                   class="group flex flex-col items-center p-4 rounded-xl transition-all duration-200 {{ request('category') == $category->id ? 'bg-primary-500 text-white shadow-lg' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }}">
                                    <div class="w-12 h-12 {{ request('category') == $category->id ? 'bg-white/20' : 'bg-gradient-to-br ' . ($category->slug == 'electronics' ? 'from-blue-100 to-blue-200' : ($category->slug == 'clothing' ? 'from-purple-100 to-purple-200' : ($category->slug == 'books' ? 'from-green-100 to-green-200' : 'from-orange-100 to-orange-200'))) }} rounded-xl flex items-center justify-center mb-3 group-hover:scale-105 transition-transform">
                                        @switch($category->slug)
                                            @case('electronics')
                                                <svg class="w-6 h-6 {{ request('category') == $category->id ? 'text-white' : 'text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                @break
                                            @case('clothing')
                                                <svg class="w-6 h-6 {{ request('category') == $category->id ? 'text-white' : 'text-purple-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                @break
                                            @case('books')
                                                <svg class="w-6 h-6 {{ request('category') == $category->id ? 'text-white' : 'text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                                @break
                                            @case('home-garden')
                                                <svg class="w-6 h-6 {{ request('category') == $category->id ? 'text-white' : 'text-orange-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                </svg>
                                                @break
                                            @default
                                                <svg class="w-6 h-6 {{ request('category') == $category->id ? 'text-white' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                        @endswitch
                                    </div>
                                    <span class="text-sm font-semibold text-center">{{ $category->name }}</span>
                                    <span class="text-xs {{ request('category') == $category->id ? 'text-white/80' : 'text-gray-500' }} mt-1">
                                        {{ $category->products->count() }} items
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        @if(request('category'))
                            {{ $categories->find(request('category'))->name ?? 'Products' }}
                        @else
                            All Products
                        @endif
                    </h2>
                    <p class="text-gray-600 mt-1">{{ $products->total() }} products found</p>
                </div>

                <!-- Active Filters -->
                @if(request()->hasAny(['search', 'min_price', 'max_price']))
                    <div class="mt-4 sm:mt-0">
                        <div class="flex flex-wrap gap-2">
                            @if(request('search'))
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                    Search: "{{ request('search') }}"
                                    <a href="{{ route('home', request()->except('search')) }}" class="ml-2 text-primary-600 hover:text-primary-800">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                            @if(request('min_price') || request('max_price'))
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                    Price: ${{ request('min_price', '0') }} - ${{ request('max_price', '∞') }}
                                    <a href="{{ route('home', request()->except(['min_price', 'max_price'])) }}" class="ml-2 text-primary-600 hover:text-primary-800">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
                        <!-- Product Image -->
                        <div class="aspect-square bg-gray-100 overflow-hidden relative">
                            <img src="{{ $product->image }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

                            <!-- Category Badge Overlay -->
                            <div class="absolute top-3 left-3">
                                <span class="inline-block px-2 py-1 text-xs font-medium text-white bg-black/60 backdrop-blur-sm rounded-full">
                                    {{ $product->category->name }}
                                </span>
                            </div>

                            <!-- Stock Status -->
                            @if($product->stock <= 5 && $product->stock > 0)
                                <div class="absolute top-3 right-3">
                                    <span class="inline-block px-2 py-1 text-xs font-medium text-white bg-orange-500 rounded-full">
                                        Only {{ $product->stock }} left
                                    </span>
                                </div>
                            @elseif($product->stock == 0)
                                <div class="absolute top-3 right-3">
                                    <span class="inline-block px-2 py-1 text-xs font-medium text-white bg-red-500 rounded-full">
                                        Out of Stock
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors">
                                {{ $product->name }}
                            </h3>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ Str::limit($product->description, 100) }}
                            </p>

                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-baseline space-x-2">
                                    <span class="text-2xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">
                                        {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
                                    </p>
                                </div>
                            </div>

                            @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-3">
                                    @csrf
                                    <div class="flex items-center space-x-3 hidden">
                                        <label for="quantity-{{ $product->id }}" class="text-sm font-medium text-gray-700">Qty:</label>
                                        <select name="quantity" id="quantity-{{ $product->id }}"
                                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                            @for($i = 1; $i <= min(10, $product->stock); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <button type="submit"
                                            class="w-full bg-primary-500 hover:bg-primary-600 text-white py-2.5 px-4 rounded-lg font-medium transition-colors flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0V19a2 2 0 002 2h7a2 2 0 002-2v-4.5M9 19h6"></path>
                                        </svg>
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full bg-gray-100 text-gray-400 py-2.5 px-4 rounded-lg font-medium cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-16">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                            <p class="text-gray-600 mb-6">Try adjusting your search or filter criteria</p>
                            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg font-medium transition-colors">
                                View All Products
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Professional Pagination -->
            @if($products->hasPages())
                <div class="mt-12">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                            <!-- Results Info -->
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <span>Showing</span>
                                <span class="font-semibold text-gray-900">{{ $products->firstItem() }}</span>
                                <span>to</span>
                                <span class="font-semibold text-gray-900">{{ $products->lastItem() }}</span>
                                <span>of</span>
                                <span class="font-semibold text-gray-900">{{ $products->total() }}</span>
                                <span>results</span>
                            </div>

                            <!-- Pagination Links -->
                            <div class="flex items-center space-x-2">
                                @if ($products->onFirstPage())
                                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </span>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}" class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </a>
                                @endif

                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <span class="px-4 py-2 bg-primary-500 text-white rounded-lg font-semibold shadow-lg">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors font-medium">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}" class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
