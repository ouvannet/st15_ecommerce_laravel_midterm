<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('session_id', session()->getId())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum('subtotal');

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_address' => 'required|string',
            'payment_method' => 'required|in:cash_on_delivery,bank_transfer',
        ]);

        $cartItems = CartItem::with('product')
            ->where('session_id', session()->getId())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum('subtotal');

        $order = null;
        DB::transaction(function () use ($request, $cartItems, $total, &$order) {
            // Create order
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_address' => $request->customer_address,
                'payment_method' => $request->payment_method,
                'total_amount' => $total,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);

                // Update product stock
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            // Clear cart
            CartItem::where('session_id', session()->getId())->delete();
        });

        // Redirect to success page with order number in URL
        return redirect()->route('checkout.success', ['order_number' => $order->order_number])
                        ->with('success', 'Order placed successfully!');
    }

    public function success(Request $request)
    {
        $orderNumber = $request->get('order_number');

        if (!$orderNumber) {
            return redirect()->route('home')->with('error', 'Invalid order reference.');
        }

        $order = Order::with(['orderItems.product.category'])
                     ->where('order_number', $orderNumber)
                     ->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }

        return view('checkout.success', compact('order'));
    }
}
