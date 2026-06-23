<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Address;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function prepare(Request $request)
    {
        $request->validate([
            'selected_items' => 'required|array',
            'selected_items.*' => 'exists:cart_items,id'
        ]);

        session(['checkout_selected_items' => $request->selected_items]);

        return redirect()->route('checkout.index');
    }

    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $selectedIds = session('checkout_selected_items');

        if (!$selectedIds || empty($selectedIds)) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        $selectedItems = $cart->items()->whereIn('id', $selectedIds)->get();

        if ($selectedItems->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak ditemukan di keranjang.');
        }

        $addresses = Address::where('user_id', auth()->id())->get();
        $shippings = ShippingMethod::all();
        $payments = PaymentMethod::where('is_active', true)->get();

        $totalCart = 0;
        foreach ($selectedItems as $item) {
            $totalCart += $item->price * $item->quantity;
        }

        return view('checkout.index', compact('cart', 'selectedItems', 'addresses', 'shippings', 'payments', 'totalCart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'coupon_code' => 'nullable|string'
        ]);

        $address = Address::find($request->address_id);

        if ($address->user_id != auth()->id()) {
            abort(403);
        }

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $selectedIds = session('checkout_selected_items');

        $selectedItems = $cart->items()->whereIn('id', $selectedIds)->get();

        if ($selectedItems->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Item checkout tidak ditemukan.');
        }

        $totalCart = 0;

        foreach ($selectedItems as $item) {
            $totalCart += $item->price * $item->quantity;
        }

        $discount = 0;

        if ($request->filled('coupon_code')) {
            $coupon = \App\Models\Coupon::where('code', $request->coupon_code)
                ->where('is_active', true)
                ->first();

            if ($coupon) {
                $discount = $coupon->discount_amount;
            } else {
                return back()->with('error', 'Kode kupon tidak valid atau tidak aktif.')->withInput();
            }
        }

        $shipping = ShippingMethod::find($request->shipping_method_id);

        $grandTotal = ($totalCart - $discount) + $shipping->price;

        if ($grandTotal < 0) {
            $grandTotal = 0;
        }

        session([
            'checkout_data' => [
                'address_id' => $request->address_id,
                'shipping_method_id' => $request->shipping_method_id,
                'payment_method_id' => $request->payment_method_id,
                'shipping_cost' => $shipping->price,
                'discount_amount' => $discount,
                'total_amount' => $grandTotal,
                'selected_items' => $selectedIds
            ]
        ]);

        $orderController = new OrderController();
        return $orderController->store();
    }
}