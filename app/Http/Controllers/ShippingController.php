<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;

class ShippingController extends Controller
{
    public function index()
    {
        $shippings = ShippingMethod::all();

        return view('shipping.index', compact('shippings'));
    }
}