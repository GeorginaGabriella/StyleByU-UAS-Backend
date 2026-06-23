<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->id())
            ->with('product')
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id
        ]);

        return back()->with('success', 'Ditambahkan ke wishlist');
    }

    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id != auth()->id()) {
            abort(403, 'Akses ditolak');
        }

        $wishlist->delete();

        return back()->with('success', 'Dihapus dari wishlist');
    }
}