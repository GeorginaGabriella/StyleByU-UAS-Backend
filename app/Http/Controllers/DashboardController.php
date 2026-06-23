<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return view('dashboard.admin');
        } else {
            return view('dashboard.user');
        }
    }
}