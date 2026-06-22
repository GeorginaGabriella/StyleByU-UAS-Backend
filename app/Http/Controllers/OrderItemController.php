<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function index(Order $order)
    {
        if ($order->user_id != auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $items = OrderItem::where('order_id', $order->id)->with('product', 'variant')->get();

        return view('order_items.index', compact('order', 'items'));
    }
}