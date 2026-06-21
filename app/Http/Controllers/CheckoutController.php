<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Address;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        if ($cart->items->count() == 0) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang masih kosong');
        }

        $addresses = Address::where(
            'user_id',
            auth()->id()
        )->get();

        $shippings = ShippingMethod::all();

        $payments = PaymentMethod::where(
            'is_active',
            true
        )->get();

        $totalCart = 0;

        foreach ($cart->items as $item) {
            $totalCart +=
                $item->price *
                $item->quantity;
        }

        return view(
            'checkout.index',
            compact(
                'cart',
                'addresses',
                'shippings',
                'payments',
                'totalCart'
            )
        );
    }

    public function process(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_method_id' => 'required|exists:payment_methods,id'
        ]);

        $address = Address::find(
            $request->address_id
        );

        if ($address->user_id != auth()->id()) {
            abort(403);
        }

        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        $totalCart = 0;

        foreach ($cart->items as $item) {
            $totalCart +=
                $item->price *
                $item->quantity;
        }

        $shipping = ShippingMethod::find(
            $request->shipping_method_id
        );

        $grandTotal =
            $totalCart +
            $shipping->price;

        session([
            'checkout_data' => [
                'address_id' => $request->address_id,
                'shipping_method_id' => $request->shipping_method_id,
                'payment_method_id' => $request->payment_method_id,
                'shipping_cost' => $shipping->price,
                'total_amount' => $grandTotal
            ]
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Checkout berhasil! Menunggu proses Order oleh sistem.'
            );
    }
}