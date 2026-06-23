<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        Banner::create($request->only(['title', 'image_url', 'description']));
        return redirect()->route('banners.index')->with('success', 'Banner berhasil dibuat.');
    }

    public function show(Banner $banner)
    {
        return view('banners.show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate(['title' => 'required']);
        $banner->update($request->only(['title', 'image_url', 'description']));
        return redirect()->route('banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}