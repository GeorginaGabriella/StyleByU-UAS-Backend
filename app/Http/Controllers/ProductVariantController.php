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

        return back()->with('success', 'Variant created successfully.');
    }

    public function destroy(ProductVariant $variant)
    {
        $variant->delete();
        return back()->with('success', 'Variant deleted successfully.');
    }
}
