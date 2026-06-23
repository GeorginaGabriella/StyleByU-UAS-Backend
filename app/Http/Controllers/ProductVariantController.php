<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index($product_id)
    {
        $product = Product::findOrFail($product_id);
        $variants = $product->variants;
        return view('variants.index', compact('product', 'variants'));
    }

    public function store(Request $request, $product_id)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'price' => 'nullable|numeric'
        ]);

        ProductVariant::create([
            'product_id' => $product_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price
        ]);

        return back()->with('success', 'Varian berhasil dibuat.');
    }

        public function edit(ProductVariant $variant)
    {
        $product = Product::findOrFail($variant->product_id);
        return view('variants.edit', compact('product', 'variant'));
    }

    public function update(Request $request, ProductVariant $variant)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'price' => 'nullable|numeric'
        ]);

        $variant->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price
        ]);

        return redirect()->route('variants.index', $variant->product_id)
            ->with('success', 'Varian berhasil diperbarui.');
    }

    public function destroy(ProductVariant $variant)
    {
        $variant->delete();
        return back()->with('success', 'Varian berhasil dihapus.');
    }
}