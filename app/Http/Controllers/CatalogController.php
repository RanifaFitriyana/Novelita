<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::with('novels')->get();
        return view('catalog.index', compact('categories'));
    }
}
