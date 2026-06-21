<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function update(Request $request, CartItem $cartItem)
    {
        $userCart = \App\Models\Cart::where('user_id', auth()->id())->first();

        if (!$userCart || $cartItem->cart_id != $userCart->id) {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $variant = $cartItem->variant;

        if ($variant && $request->quantity > $variant->stock) {
            return back()->with('error', 'Stock tidak cukup');
        }

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Cart updated');
    }

    public function destroy(CartItem $cartItem)
    {
        $userCart = \App\Models\Cart::where('user_id', auth()->id())->first();

        if (!$userCart || $cartItem->cart_id != $userCart->id) {
            abort(403, 'Akses ditolak');
        }

        $cartItem->delete();

        return back()->with('success', 'Item deleted');
    }
}
