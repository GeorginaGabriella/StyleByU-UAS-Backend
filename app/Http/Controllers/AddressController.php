<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->get();
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'recipient_name' => 'required',
            'phone' => 'required',
            'full_address' => 'required',
            'city' => 'required'
        ]);

        Address::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'recipient_name' => $request->recipient_name,
            'phone' => $request->phone,
            'full_address' => $request->full_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code
        ]);

        return redirect()->route('addresses.index')
            ->with('success', 'Alamat berhasil ditambahkan');
    }

    public function edit(Address $address)
    {
        if ($address->user_id != auth()->id()) {
            abort(403);
        }

        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        if ($address->user_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'recipient_name' => 'required',
            'phone' => 'required',
            'full_address' => 'required',
            'city' => 'required'
        ]);

        $address->update($request->only([
            'title',
            'recipient_name',
            'phone',
            'full_address',
            'city',
            'postal_code'
        ]));

        return redirect()->route('addresses.index')
            ->with('success', 'Alamat berhasil diupdate');
    }

    public function destroy(Address $address)
    {
        if ($address->user_id != auth()->id()) {
            abort(403);
        }

        $address->delete();

        return back()->with('success', 'Alamat berhasil dihapus');
    }
}