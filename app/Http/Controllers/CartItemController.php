<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function update(Request $request, CartItem $cartItem)
    {
        $userCart = Cart::where('user_id', auth()->id())->first();

        if (!$userCart || $cartItem->cart_id != $userCart->id) {
            abort(403, 'Akses ditolak');
        }

        $request->validate(['quantity' => 'required|integer|min:1']);

        $variant = $cartItem->variant;
        if ($variant && $request->quantity > $variant->stock) {
            return back()->with('error', 'Stok tidak cukup');
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Keranjang berhasil diperbarui');
    }

    public function destroy(CartItem $cartItem)
    {
        $userCart = Cart::where('user_id', auth()->id())->first();

        if (!$userCart || $cartItem->cart_id != $userCart->id) {
            abort(403, 'Akses ditolak');
        }

        $cartItem->delete();

        return back()->with('success', 'Item berhasil dihapus');
    }
}