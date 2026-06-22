<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        if (!$order->payment || $order->payment->status == 'paid') {
            return redirect()->route('orders.show', $order->id)->with('error', 'Order sudah dibayar');
        }

        return view('payments.pay', compact('order'));
    }

    public function process(Request $request, Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        $order->update(['status' => 'paid']);
        if ($order->payment) {
            $order->payment()->update(['status' => 'paid']);
        }

        return redirect()->route('orders.show', $order->id)->with('success', 'Pembayaran berhasil!');
    }
}