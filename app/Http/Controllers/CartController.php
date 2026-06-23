<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $total = 0;

        foreach ($cart->items as $item) {
            $total += $item->price * $item->quantity;
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $variant = null;
        if ($request->product_variant_id) {
            $variant = ProductVariant::findOrFail($request->product_variant_id);

            $query = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->where('product_variant_id', $variant->id);

            $existingItem = $query->first();
            $newQty = $request->quantity;

            if ($existingItem) {
                $newQty += $existingItem->quantity;
            }

            if ($newQty > $variant->stock) {
                return back()->with('error', 'Stock variant tidak cukup');
            }
        } else {
            if ($request->quantity > $product->stock) {
                return back()->with('error', 'Stock tidak cukup');
            }
        }

        $query = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id);

        if ($variant) {
            $query->where('product_variant_id', $variant->id);
        } else {
            $query->whereNull('product_variant_id');
        }

        $item = $query->first();
        $price = $variant && $variant->price ? $variant->price : $product->price;

        if ($item) {
            $item->increment('quantity', $request->quantity);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'product_variant_id' => $variant ? $variant->id : null,
                'quantity' => $request->quantity,
                'price' => $price
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk masuk keranjang!');
    }
}