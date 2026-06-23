<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        $shippings = ShippingMethod::all();
        return view('shipping.index', compact('shippings'));
    }

    public function edit(ShippingMethod $shipping)
    {
        return view('shipping.edit', compact('shipping'));
    }

    public function update(Request $request, ShippingMethod $shipping)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'estimated_days' => 'required|integer'
        ]);

        $shipping->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'estimated_days' => $request->estimated_days
        ]);

        return redirect()->route('admin.shipping.index')->with('success', 'Data ongkir berhasil diperbarui.');
    }
}