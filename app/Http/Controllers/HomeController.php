<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        
        $products = Product::where('is_active', true)
            ->with(['category', 'brand'])
            ->latest()
            ->take(8)
            ->get();
            
        $categories = Category::all();

        return view('home.index', compact('banners', 'products', 'categories'));
    }
}