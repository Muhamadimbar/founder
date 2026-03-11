<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('is_active', true)->latest()->get();
        $categories = Portfolio::$categories;
        $featured   = Portfolio::where('is_active', true)->where('is_featured', true)->take(3)->get();
        return view('portfolio', compact('portfolios', 'categories', 'featured'));
    }
}
