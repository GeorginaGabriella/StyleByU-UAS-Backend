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
            abort(403);
        }

        $qty = $request->quantity;
        $variantId = $request->product_variant_id;

        if ($variantId === '' || $variantId === null) {
            $variantId = null;
        }

        $harga = $cartItem->product->price;
        if ($variantId) {
            $cekVariant = \App\Models\ProductVariant::find($variantId);
            if ($cekVariant && $cekVariant->price != null) {
                $harga = $cekVariant->price;
            }
        }

        $cartItem->product_variant_id = $variantId;
        $cartItem->quantity = $qty;
        $cartItem->price = $harga;
        $cartItem->save();

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function destroy(CartItem $cartItem)
    {
        $userCart = Cart::where('user_id', auth()->id())->first();

        if (!$userCart || $cartItem->cart_id != $userCart->id) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Item dihapus.');
    }
}