<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- Import the DB facade for transactions

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Order::with('orderItems.product');

        // REFACTORED: Cleaner query building instead of multiple return statements
        if ($user->role === 'customer') {
            $query->where('customer_id', $user->id);
        } elseif ($user->role === 'delivery_agent') {
            $query->where('delivery_agent_id', $user->id);
        } elseif ($user->role !== 'admin') {
            // If the role is not any of the above, return an empty set or deny access
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        // Admins see all orders, others see their filtered list.
        return $query->latest()->get();
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'customer') {
            return response()->json(['message' => 'Only customers can create orders.'], 403);
        }

        $cart = Cart::where('customer_id', Auth::id())->with('cartItems.product')->first();
        
        // Check if the cart is empty or doesn't exist
        if (!$cart || $cart->cartItems->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty.'], 400);
        }

        // UPDATED: Wrap the entire creation process in a database transaction
        $order = DB::transaction(function () use ($cart) {
            $total_price = $cart->cartItems->sum(function ($item) {
                // Ensure product exists and price is valid before calculation
                return $item->quantity * $item->product->final_price;
            });

            $order = Order::create([
                'customer_id' => Auth::id(),
                'total_price' => $total_price,
                'status' => 'pending', // e.g., waiting for payment
                'delivery_status' => 'pending', // e.g., waiting for shipment
            ]);

            foreach ($cart->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->final_price, // Storing price at time of purchase
                ]);
            }

            // Clear cart items now that the order is successful
            $cart->cartItems()->delete();

            return $order;
        });
        
        // Eager load the relationships for the response
        $order->load('orderItems.product');

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        $user = Auth::user();

        // REFACTORED: Cleaner authorization logic
        $isOwner = ($user->role === 'customer' && $order->customer_id === $user->id);
        $isAssignedAgent = ($user->role === 'delivery_agent' && $order->delivery_agent_id === $user->id);
        $isAdmin = ($user->role === 'admin');

        if ($isOwner || $isAssignedAgent || $isAdmin) {
            return $order;
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        // SECURITY FIX: Stricter authorization for delivery agents
        $isAssignedAgent = ($user->role === 'delivery_agent' && $order->delivery_agent_id === $user->id);
        $isAdmin = ($user->role === 'admin');

        if (!$isAdmin && !$isAssignedAgent) {
             return response()->json(['message' => 'You are not authorized to update this order.'], 403);
        }

        $validated = $request->validate([
            'status' => 'sometimes|in:pending,paid,shipped,delivered,canceled',
            'delivery_status' => 'sometimes|in:pending,out_for_delivery,delivered',
            'delivery_date' => 'nullable|date',
            'delivery_agent_id' => 'nullable|exists:users,id,role,delivery_agent', // Ensure only users with 'delivery_agent' role can be assigned
        ]);

        $order->update($validated);

        return response()->json(['message' => 'Order updated successfully', 'order' => $order]);
    }
}