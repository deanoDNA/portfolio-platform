<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Portfolio;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $portfolio = Portfolio::where('user_id', $user->id)->first();

        return view('dashboard.index', compact('user', 'portfolio'));
    }
}
