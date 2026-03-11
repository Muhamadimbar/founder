<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = Portfolio::$categories;
        return view('admin.portfolio.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:150',
            'category' => 'required|string',
        ]);

        $data = [
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'client'      => $request->client,
            'is_featured' => $request->has('is_featured'),
            'is_active'   => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->storeAs('portfolio', time().'_'.$file->getClientOriginalName(), 'public');
        } else {
            $data['image'] = '';
        }

        Portfolio::create($data);
        return redirect()->route('admin.portfolio.index')->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = Portfolio::$categories;
        return view('admin.portfolio.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title'    => 'required|string|max:150',
            'category' => 'required|string',
        ]);

        $data = [
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'client'      => $request->client,
            'is_featured' => $request->has('is_featured'),
            'is_active'   => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($portfolio->image) Storage::disk('public')->delete($portfolio->image);
            $file = $request->file('image');
            $data['image'] = $file->storeAs('portfolio', time().'_'.$file->getClientOriginalName(), 'public');
        }

        if ($request->has('remove_image') && $portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
            $data['image'] = '';
        }

        $portfolio->update($data);
        return redirect()->route('admin.portfolio.index')->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image) Storage::disk('public')->delete($portfolio->image);
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success', 'Portofolio berhasil dihapus!');
    }
}
