<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show the current user's cart.
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('front.cart', compact('cartItems'));
    }

    // Add a product to the cart (or bump its quantity if already there).
    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);
        $quantity = $request->quantity ?? 1;

        // Don't let them add more than we have in stock.
        if ($product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        // Already in the cart? Increase the quantity (re-checking stock).
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $quantity;

            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Not enough stock available.');
            }

            $cart->update([
                'quantity' => $newQuantity,
                'price' => $product->discounted_price,
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->discounted_price,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    // Change the quantity of a cart line.
    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Scope to the current user so nobody can edit someone else's cart.
        $cart = Cart::where('user_id', Auth::id())->findOrFail($cartId);

        if ($cart->product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated.');
    }

    // Remove a line from the cart.
    public function remove($cartId)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($cartId);
        $cart->delete();

        return back()->with('success', 'Product removed from cart.');
    }
}
