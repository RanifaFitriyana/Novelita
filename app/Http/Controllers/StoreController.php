<?php

namespace App\Http\Controllers;

use App\Models\Category;

class StoreController extends Controller
{
    public function index()
    {
        // Ambil semua kategori yang aktif + novelnya yang aktif
        $categories = Category::where('is_active', true)
            ->with(['novels' => function ($query) {
                $query->where('is_active', true);
            }])
            ->get();

        return view('store.index', compact('categories'));
    }
}
