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
        // Find the cart for the user or create a new one if it doesn't exist.
        // Eager load relationships to avoid N+1 query problems.
        $cart = Cart::with('cartItems.product')
                    ->firstOrCreate(['customer_id' => Auth::id()]);
        
        return response()->json(['cart' => $cart]);
    }

    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(['customer_id' => Auth::id()]);

        // Find if the item already exists in the cart
        $cartItem = $cart->cartItems()->where('product_id', $validated['product_id'])->first();

        if ($cartItem) {
            // If it exists, increment the quantity
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            // If it doesn't exist, create a new cart item
            $cartItem = $cart->cartItems()->create([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        // Load the product relationship for the response
        $cartItem->load('product');

        return response()->json(['message' => 'Item added to cart', 'cart_item' => $cartItem], 201);
    }

    public function updateItem(Request $request, $id)
    {
        // First, find the cart item or fail with a 404 error if it doesn't exist.
        $cartItem = CartItem::findOrFail($id);

        // Authorization check: Ensure the cart item belongs to the authenticated user's cart.
        // We eager load the 'cart' relationship for this check.
        if ($cartItem->cart->customer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate(['quantity' => 'required|integer|min:1']);
        
        $cartItem->update($validated);
        $cartItem->load('product');

        return response()->json(['message' => 'Cart item updated', 'cart_item' => $cartItem]);
    }


    public function removeItem($id)
    {
        $cartItem = CartItem::findOrFail($id);

        // Authorization check
        if ($cartItem->cart->customer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cartItem->delete();
        
        return response()->json(['message' => 'Cart item removed']);
    }
}
