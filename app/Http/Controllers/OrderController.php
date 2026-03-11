<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->get();
        return view('order', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'email'       => 'required|email|max:100',
            'phone'       => 'required|string|max:20',
            'service'     => 'required|string',
            'description' => 'required|string|max:2000',
            'deadline'    => 'nullable|string|max:50',
            'budget'      => 'nullable|string|max:50',
        ]);

        $data = [
            'order_number' => 'SIB-' . strtoupper(uniqid()),
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'service'      => $request->service,
            'package'      => $request->package,
            'description'  => $request->description,
            'deadline'     => $request->deadline,
            'budget'       => $request->budget,
            'status'       => 'pending',
        ];

        if ($request->hasFile('file_attachment')) {
            $file = $request->file('file_attachment');
            $data['file_attachment'] = $file->storeAs('orders', time().'_'.$file->getClientOriginalName(), 'public');
        }

        $order = Order::create($data);
        return redirect()->route('order.success', $order->order_number);
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('order-success', compact('order'));
    }
}
