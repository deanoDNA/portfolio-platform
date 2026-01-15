<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class PublicPortfolioController extends Controller
{
    public function show(Portfolio $portfolio)
    {
        $portfolio->load(['country', 'region', 'district']);

        return view('portfolio.public.show', compact('portfolio'));
    }
}
