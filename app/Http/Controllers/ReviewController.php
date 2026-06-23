<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $reviews = Review::with('user')
            ->where('product_id', $productId)
            ->latest()
            ->get();

        return view('reviews.index', compact('product', 'reviews'));
    }

    public function create($productId, $orderId)
    {
        $product = Product::findOrFail($productId);

        $order = Order::where('id', $orderId)
            ->where('user_id', auth()->id())
            ->where('status', 'completed')
            ->firstOrFail();

        return view('reviews.create', compact('product', 'order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('user_id', auth()->id())
            ->where('status', 'completed')
            ->firstOrFail();

        $existingReview = Review::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->where('order_id', $request->order_id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Review sudah pernah diberikan');
        }

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return redirect()->route('reviews.index', $request->product_id)
            ->with('success', 'Review berhasil ditambahkan');
    }
}