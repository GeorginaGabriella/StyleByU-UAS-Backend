<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id()
        ]);

        $user = User::find(auth()->id());
        $user->update($request->only('name', 'email'));

        return back()->with('success', 'Profil berhasil diupdate');
    }
}