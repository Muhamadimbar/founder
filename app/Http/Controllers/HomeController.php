<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderByRaw('image IS NULL ASC')->take(4)->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->take(6)->get();

        return view('home', compact('services', 'testimonials'));
    }
}
