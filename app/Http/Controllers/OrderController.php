<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id != auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $order->load('items.product', 'items.variant', 'address', 'shippingMethod', 'payment.method');
        return view('orders.show', compact('order'));
    }

    public function store()
    {
        $checkoutData = session('checkout_data');

        if (!$checkoutData) {
            return redirect()->route('cart.index')->with('error', 'Session checkout expired');
        }

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        if ($cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'address_id' => $checkoutData['address_id'],
            'shipping_method_id' => $checkoutData['shipping_method_id'],
            'total_amount' => $checkoutData['total_amount'],
            'shipping_cost' => $checkoutData['shipping_cost'],
            'status' => 'pending'
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);

            if ($item->product_variant_id) {
                ProductVariant::where('id', $item->product_variant_id)
                    ->decrement('stock', $item->quantity);
            } else {
                Product::where('id', $item->product_id)
                    ->decrement('stock', $item->quantity);
            }
        }

        Payment::create([
            'order_id' => $order->id,
            'payment_method_id' => $checkoutData['payment_method_id'],
            'status' => 'pending'
        ]);

        $cart->items()->delete();

        session()->forget('checkout_data');

        return redirect()->route('orders.show', $order->id)->with('success', 'Order berhasil dibuat!');
    }

    public function adminIndex()
    {
        $orders = Order::with('user', 'payment')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,packed,shipped,completed'
        ]);

        $order->update(['status' => $request->status]);

        if ($request->status == 'paid' && $order->payment?->status !== 'paid') {
            $order->payment()->update(['status' => 'paid']);
        }

        return back()->with('success', 'Status order diupdate');
    }
}