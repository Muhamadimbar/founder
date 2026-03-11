<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Portfolio;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services'        => Service::count(),
            'contacts'        => Contact::count(),
            'unread_contacts' => Contact::where('is_read', false)->count(),
            'testimonials'    => Testimonial::count(),
            'portfolio'       => Portfolio::count(),
            'orders'          => Order::count(),
            'orders_pending'  => Order::where('status', 'pending')->count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();
        $recentOrders   = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentContacts', 'recentOrders'));
    }
}
