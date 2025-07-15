<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Novel;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function home()
    {
        // Bisa tampilkan ringkasan kategori dan novel (misal beberapa item terbaru)
        $categories = Category::where('is_active', true)->get();
        $novels = Novel::where('is_active', true)->latest()->take(6)->get();

        return view('store.home', compact('categories', 'novels'));
    }

    public function products(Request $request)
    {
        $query = Novel::where('is_active', true);

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        $novels = $query->latest()->paginate(12);

        return view('store.products', compact('novels'));
    }
    public function showNovel($id)
    {
        $novel = \App\Models\Novel::with('category')->findOrFail($id);
        return view('store.show', compact('novel'));
    }

    public function categories()
    {
        $categories = Category::where('is_active', true)->with('novels')->get();
        return view('store.categories', compact('categories'));
    }

    public function contact()
    {
        return view('store.contact');
    }
}
