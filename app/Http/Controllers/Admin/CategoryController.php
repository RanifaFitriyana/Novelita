<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => false,
            'hub_category_id' => null, // bisa diset null saat awal
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }

    public function toggleStatus(Category $category)
    {
        $category->is_active = !$category->is_active;
        $category->save();

        // Update semua novel yang termasuk dalam kategori ini
        $category->novels()->update(['is_active' => $category->is_active]);

        return redirect()->route('admin.categories.index')->with('success', 'Status kategori dan novel di dalamnya berhasil diperbarui.');
    }

    public function sync(Request $request, Category $category)
    {
        $response = Http::post('https://api.phb-umkm.my.id/api/product-category/sync', [
            'client_id' => env('client_27qv2Zwku61p'),
            'client_secret' => env('yNPf7uxRlVyhSlpOVd4wH0K5MCuI1zFF5pOqeLFN'),
            'seller_product_category_id' => (string) $category->id,
            'name' => $category->name,
            'description' => $category->description,
            'is_active' => $request->is_active == 1 ? false : true,
        ]);

        if ($response->successful() && isset($response['product_category_id'])) {
            $category->hub_category_id = $request->is_active == 1 ? null : $response['product_category_id'];
            $category->save();
        }

        return redirect()->route('admin.categories.index')->with('success', 'Sinkronisasi kategori berhasil.');
    }
}
