@extends('layouts.app')

@section('title', 'Order Confirmation - EcomStore')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Success Header -->
    <div class="text-center mb-12">
        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
            <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <h1 class="text-4xl font-bold text-gray-900 mb-4">Order Confirmed!</h1>
        <p class="text-xl text-gray-600 mb-2">
            Thank you for your purchase, {{ $order->customer_name }}!
        </p>
        <p class="text-gray-500">
            Your order <span class="font-semibold text-primary-600">{{ $order->order_number }}</span> has been received and is being processed.
        </p>

        <!-- Shareable URL Notice -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
            <div class="flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
                <span class="text-sm text-blue-800 font-medium">
                    Bookmark this page - you can return anytime using this link
                </span>
            </div>
            <div class="mt-2">
                <div class="flex items-center justify-center space-x-2">
                    <input type="text"
                           value="{{ request()->fullUrl() }}"
                           readonly
                           class="text-xs bg-white border border-blue-300 rounded px-3 py-1 text-blue-700 font-mono"
                           id="orderUrl">
                    <button onclick="copyOrderUrl()"
                            class="text-xs bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded transition-colors">
                        Copy Link
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Summary Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Order Summary</h2>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                            <div class="flex items-center space-x-4 py-4 border-b border-gray-100 last:border-b-0">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                                        <img src="{{ $item->product->image }}"
                                             alt="{{ $item->product->name }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                                    <div class="flex items-center mt-1">
                                        <span class="text-sm text-gray-600">Qty: {{ $item->quantity }}</span>
                                        <span class="mx-2 text-gray-300">•</span>
                                        <span class="text-sm font-medium text-gray-900">${{ number_format($item->price, 2) }} each</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">${{ number_format($item->subtotal, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Total -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="space-y-2">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="text-green-600 font-medium">Free</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax</span>
                                <span>$0.00</span>
                            </div>
                            <div class="flex justify-between text-xl font-bold text-gray-900 pt-2 border-t border-gray-200">
                                <span>Total</span>
                                <span>${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Customer Information</h2>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-2">Contact Details</h3>
                            <div class="space-y-2">
                                <p class="text-gray-900 font-medium">{{ $order->customer_name }}</p>
                                <p class="text-gray-600">{{ $order->customer_email }}</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-2">Shipping Address</h3>
                            <div class="text-gray-600">
                                {!! nl2br(e($order->customer_address)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Payment Information</h2>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-center">
                        @if($order->payment_method === 'cash_on_delivery')
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Cash on Delivery</p>
                                <p class="text-sm text-gray-600">Pay when your order arrives</p>
                            </div>
                        @else
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Bank Transfer</p>
                                <p class="text-sm text-gray-600">Transfer payment to our bank account</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Status & Next Steps -->
        <div class="lg:col-span-1">
            <!-- Order Status -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Order Status</h2>
                    </div>
                </div>

                <div class="p-6">
                    <div class="text-center mb-4">
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></div>
                            {{ ucfirst($order->status) }}
                        </div>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-400 rounded-full mr-3"></div>
                            <span class="text-gray-600">Order placed</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full mr-3"></div>
                            <span class="text-gray-600">Processing</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-gray-300 rounded-full mr-3"></div>
                            <span class="text-gray-400">Shipped</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-gray-300 rounded-full mr-3"></div>
                            <span class="text-gray-400">Delivered</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Order Details</h2>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order Number</span>
                        <span class="font-semibold text-gray-900">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order Date</span>
                        <span class="font-semibold text-gray-900">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Items</span>
                        <span class="font-semibold text-gray-900">{{ $order->orderItems->sum('quantity') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Amount</span>
                        <span class="font-semibold text-primary-600">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- What's Next -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">What's Next?</h2>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary-100 text-primary-600 text-sm font-semibold">
                                    1
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-medium text-gray-900">Email Confirmation</h3>
                                <p class="text-gray-600 text-sm">Check your email for order confirmation and tracking details.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary-100 text-primary-600 text-sm font-semibold">
                                    2
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-medium text-gray-900">Processing</h3>
                                <p class="text-gray-600 text-sm">We'll prepare your items within 1-2 business days.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary-100 text-primary-600 text-sm font-semibold">
                                    3
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-medium text-gray-900">Delivery</h3>
                                <p class="text-gray-600 text-sm">Your order will arrive within 3-5 business days.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-12 text-center">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}"
               class="inline-flex items-center justify-center px-6 py-3 bg-primary-500 hover:bg-primary-600 text-white font-semibold rounded-xl transition-colors shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                </svg>
                Continue Shopping
            </a>

            <button onclick="window.print()"
                    class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1 0 001-1v-1a1 1 0 00-1-1H9a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                </svg>
                Print Order
            </button>
        </div>

        <!-- Support Information -->
        <div class="mt-8 pt-8 border-t border-gray-200">
            <p class="text-gray-600 mb-4">Need help with your order?</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center text-sm">
                <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Contact Support</a>
                <span class="hidden sm:inline text-gray-300">|</span>
                <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Track Your Order</a>
                <span class="hidden sm:inline text-gray-300">|</span>
                <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Return Policy</a>
            </div>
        </div>
    </div>
</div>

<script>
function copyOrderUrl() {
    const urlInput = document.getElementById('orderUrl');
    urlInput.select();
    urlInput.setSelectionRange(0, 99999); // For mobile devices

    try {
        document.execCommand('copy');

        // Show feedback
        const button = event.target;
        const originalText = button.textContent;
        button.textContent = 'Copied!';
        button.classList.add('bg-green-600');
        button.classList.remove('bg-blue-600');

        setTimeout(() => {
            button.textContent = originalText;
            button.classList.remove('bg-green-600');
            button.classList.add('bg-blue-600');
        }, 2000);
    } catch (err) {
        console.error('Failed to copy URL: ', err);
    }
}
</script>

<style>
@media print {
    .no-print { display: none !important; }
    body { background: white !important; }
    .shadow-lg { box-shadow: none !important; }
}
</style>
@endsection
