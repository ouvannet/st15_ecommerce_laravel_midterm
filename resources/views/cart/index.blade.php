@extends('layouts.app')

@section('title', 'Shopping Cart - EcomStore')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
        <p class="text-gray-600 mt-2">Review your items and proceed to checkout</p>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Cart Items ({{ $cartItems->count() }})</h2>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start space-x-4">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden">
                                            @if($item->product->image)
                                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Product Details -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $item->product->name }}</h3>
                                                <p class="text-sm text-gray-500 mb-2">{{ $item->product->category->name }}</p>
                                                <p class="text-lg font-bold text-gray-900">${{ number_format($item->product->price, 2) }}</p>
                                            </div>

                                            <!-- Remove Button -->
                                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="ml-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-gray-400 hover:text-red-500 transition-colors p-1"
                                                        onclick="return confirm('Remove this item from cart?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Quantity and Subtotal -->
                                        <div class="flex items-center justify-between mt-4">
                                            <div class="flex items-center space-x-3">
                                                <label class="text-sm font-medium text-gray-700">Quantity:</label>
                                                <form action="{{ route('cart.update', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="quantity" onchange="this.form.submit()"
                                                            class="px-3 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                                        @for($i = 1; $i <= min(10, $item->product->stock); $i++)
                                                            <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </form>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-gray-900">${{ number_format($item->subtotal, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ $cartItems->count() }} items)</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="text-green-600 font-medium">Free</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between text-lg font-bold text-gray-900">
                                <span>Total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('checkout.index') }}"
                           class="w-full bg-primary-500 hover:bg-primary-600 text-white py-3 px-4 rounded-lg font-semibold text-center block transition-colors">
                            Proceed to Checkout
                        </a>
                        <a href="{{ route('home') }}"
                           class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-lg font-medium text-center block transition-colors">
                            Continue Shopping
                        </a>
                    </div>

                    <!-- Security Badge -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            Secure checkout guaranteed
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0V19a2 2 0 002 2h7a2 2 0 002-2v-4.5M9 19h6"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Your cart is empty</h2>
                <p class="text-gray-600 mb-8">Looks like you haven't added any items to your cart yet. Start shopping to fill it up!</p>
                <a href="{{ route('home') }}"
                   class="inline-flex items-center px-6 py-3 bg-primary-500 hover:bg-primary-600 text-white font-semibold rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Start Shopping
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
