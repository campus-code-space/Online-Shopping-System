<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cart = Cart::where('customer_id', Auth::id())->with('cartItems.product')->first();
        
        if (!$cart) {
            // Create empty cart if none exists
            $cart = Cart::create(['customer_id' => Auth::id()]);
            $cart->load('cartItems.product');
        }
        
        return response()->json(['cart' => $cart]);
    }

    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(['customer_id' => Auth::id()]);
        $cartItem = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $validated['product_id']],
            ['quantity' => $validated['quantity']]
        );

        return response()->json(['message' => 'Item added to cart', 'cart_item' => $cartItem], 201);
    }

    public function updateItem(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        if ($cartItem->cart->customer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate(['quantity' => 'required|integer|min:1']);
        $cartItem->update($validated);
        return response()->json(['message' => 'Cart item updated', 'cart_item' => $cartItem]);
    }

    public function removeItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        if ($cartItem->cart->customer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $cartItem->delete();
        return response()->json(['message' => 'Cart item removed']);
    }
} 