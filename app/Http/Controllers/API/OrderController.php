<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'customer') {
            return Order::where('customer_id', $user->id)->with('orderItems.product')->get();
        } elseif ($user->role === 'delivery_agent') {
            return Order::where('delivery_agent_id', $user->id)->with('orderItems.product')->get();
        } elseif ($user->role === 'admin') {
            return Order::with('orderItems.product')->get();
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'customer') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);

        $cart = Cart::where('id', $validated['cart_id'])->where('customer_id', Auth::id())->with('cartItems.product')->firstOrFail();
        $total_price = $cart->cartItems->sum(function ($item) {
            return $item->quantity * $item->product->final_price;
        });

        $order = Order::create([
            'customer_id' => Auth::id(),
            'total_price' => $total_price,
            'status' => 'pending',
            'delivery_status' => 'pending',
        ]);

        foreach ($cart->cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->final_price,
            ]);
        }

        // Clear cart items
        $cart->cartItems()->delete();

        return response()->json(['message' => 'Order created', 'order' => $order], 201);
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        if (!in_array(Auth::user()->role, ['admin', 'customer', 'delivery_agent']) ||
            (Auth::user()->role === 'customer' && $order->customer_id !== Auth::id()) ||
            (Auth::user()->role === 'delivery_agent' && $order->delivery_agent_id !== Auth::id())) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $order;
    }

    public function updateStatus(Request $request, $id)
    {
        if (!in_array(Auth::user()->role, ['admin', 'delivery_agent'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order = Order::findOrFail($id);
        $validated = $request->validate([
            'status' => 'sometimes|in:pending,paid,shipped,delivered,canceled',
            'delivery_status' => 'sometimes|in:pending,out_for_delivery,delivered',
            'delivery_date' => 'nullable|date',
            'delivery_agent_id' => 'nullable|exists:users,id',
        ]);

        $order->update($validated);
        return response()->json(['message' => 'Order updated', 'order' => $order]);
    }
}