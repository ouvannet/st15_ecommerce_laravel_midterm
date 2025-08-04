@extends('layouts.app')

@section('title', 'Checkout - EcomStore')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
        <p class="text-gray-600 mt-2">Complete your order by providing your details below</p>
    </div>

    <!-- Progress Steps -->
    <div class="mb-8">
        <div class="flex items-center">
            <div class="flex items-center text-primary-600">
                <div class="flex items-center justify-center w-8 h-8 bg-primary-500 text-white rounded-full text-sm font-semibold">
                    1
                </div>
                <span class="ml-2 text-sm font-medium">Cart</span>
            </div>
            <div class="flex-1 h-px bg-primary-200 mx-4"></div>
            <div class="flex items-center text-primary-600">
                <div class="flex items-center justify-center w-8 h-8 bg-primary-500 text-white rounded-full text-sm font-semibold">
                    2
                </div>
                <span class="ml-2 text-sm font-medium">Checkout</span>
            </div>
            <div class="flex-1 h-px bg-gray-200 mx-4"></div>
            <div class="flex items-center text-gray-400">
                <div class="flex items-center justify-center w-8 h-8 bg-gray-200 text-gray-600 rounded-full text-sm font-semibold">
                    3
                </div>
                <span class="ml-2 text-sm font-medium">Complete</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Checkout Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Customer Information</h2>

            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Personal Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Personal Details</h3>

                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('customer_name') border-red-300 @enderror"
                               placeholder="Enter your full name">
                        @error('customer_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('customer_email') border-red-300 @enderror"
                               placeholder="Enter your email address">
                        @error('customer_email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Shipping Address</h3>

                    <div>
                        <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">Complete Address *</label>
                        <textarea id="customer_address" name="customer_address" rows="4" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('customer_address') border-red-300 @enderror"
                                  placeholder="Enter your complete shipping address including street, city, state, and postal code">{{ old('customer_address') }}</textarea>
                        @error('customer_address')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Payment Method</h3>

                    <div class="space-y-3">
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                            <input type="radio" name="payment_method" value="cash_on_delivery"
                                   {{ old('payment_method', 'cash_on_delivery') == 'cash_on_delivery' ? 'checked' : '' }}
                                   class="text-primary-600 focus:ring-primary-500 border-gray-300">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="font-medium text-gray-900">Cash on Delivery</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Pay when your order arrives at your doorstep</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                            <input type="radio" name="payment_method" value="bank_transfer"
                                   {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}
                                   class="text-primary-600 focus:ring-primary-500 border-gray-300">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    <span class="font-medium text-gray-900">Bank Transfer</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Transfer payment to our bank account</p>
                            </div>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-primary-500 hover:bg-primary-600 text-white py-4 px-6 rounded-lg font-semibold text-lg transition-colors flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Place Order
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Order Summary</h2>

            <!-- Items List -->
            <div class="space-y-4 mb-6">
                @foreach($cartItems as $item)
                    <div class="flex items-center space-x-4 py-3 border-b border-gray-100 last:border-b-0">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-medium text-gray-900 truncate">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-600">Qty: {{ $item->quantity }} × ${{ number_format($item->product->price, 2) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">${{ number_format($item->subtotal, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Totals -->
            <div class="space-y-3 pt-4 border-t border-gray-200">
                <div class="flex justify-between text-gray-600">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Shipping</span>
                    <span class="text-green-600 font-medium">Free</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Tax</span>
                    <span>$0.00</span>
                </div>
                <div class="flex justify-between text-xl font-bold text-gray-900 pt-3 border-t border-gray-200">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
            </div>

            <!-- Security Features -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="space-y-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                        SSL encrypted checkout
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        30-day money back guarantee
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                        </svg>
                        Free shipping on all orders
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
