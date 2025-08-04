<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('session_id', session()->getId())
            ->get();

        $total = $cartItems->sum('subtotal');

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $cartItem = CartItem::where('session_id', session()->getId())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Not enough stock available.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'session_id' => session()->getId(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cartItem->product->stock,
        ]);

        if ($cartItem->session_id !== session()->getId()) {
            abort(403);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated!');
    }

    public function remove(CartItem $cartItem)
    {
        if ($cartItem->session_id !== session()->getId()) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Item removed from cart!');
    }
}
