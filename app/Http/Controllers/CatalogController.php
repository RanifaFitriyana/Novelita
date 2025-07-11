<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with(['novels' => function ($query) use ($request) {
            if ($request->filled('category')) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('name', $request->category);
                });
            }

            if ($request->filled('title')) {
                $query->where('title', 'like', '%' . $request->title . '%');
            }
        }])->get();

        return view('catalog.index', compact('categories'));
    }
}
