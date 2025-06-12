<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionItem;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{

    public function index()
    {
        return Subscription::with('subscriptionItems.product')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'frequency' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // First, add item to cart or create cart if it doesn't exist
        $cart = Cart::firstOrCreate(['customer_id' => Auth::id()]);
        
        // Add the item to cart
        $cartItem = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $validated['product_id']],
            ['quantity' => $validated['quantity']]
        );

        // Reload cart with items to calculate total
        $cart->load('cartItems.product');
        
        $total_price = $cart->cartItems->sum(function ($item) {
            return $item->quantity * $item->product->final_price;
        });

        // Convert dates to datetime format
        $startDate = Carbon::parse($validated['start_date'])->startOfDay();
        $endDate = Carbon::parse($validated['end_date'])->endOfDay();

        $subscription = Subscription::create([
            'customer_id' => Auth::id(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'frequency' => $validated['frequency'],
            'total_price' => $total_price,
            'status' => 'active',
            'next_delivery_date' => $startDate,
        ]);

        // Create subscription items from current cart items
        foreach ($cart->cartItems as $item) {
            SubscriptionItem::create([
                'subscription_id' => $subscription->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }

        // Clear cart items after subscription creation
        $cart->cartItems()->delete();

        return response()->json(['message' => 'Subscription created', 'subscription' => $subscription], 201);
    }

    public function show($id)
    {
        $subscription = Subscription::with('subscriptionItems.product')->findOrFail($id);
        if (Auth::user()->role !== 'admin' && $subscription->customer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $subscription;
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        if (Auth::user()->role !== 'admin' && $subscription->customer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'frequency' => 'sometimes|integer|min:1',
            'status' => 'sometimes|in:active,paused,canceled',
            'end_date' => 'sometimes|date|after:start_date',
        ]);

        if (isset($validated['end_date'])) {
            $validated['end_date'] = Carbon::parse($validated['end_date'])->endOfDay();
        }

        $subscription->update($validated);
        return response()->json(['message' => 'Subscription updated', 'subscription' => $subscription]);
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        if (Auth::user()->role !== 'admin' && $subscription->customer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $subscription->delete();
        return response()->json(['message' => 'Subscription deleted']);
    }
} 