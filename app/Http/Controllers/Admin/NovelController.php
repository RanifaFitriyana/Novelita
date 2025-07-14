<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class NovelController extends Controller
{
    public function index()
    {
        $novels = Novel::with('category')->get();
        return view('admin.novels.index', compact('novels'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.novels.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:255|unique:novels,sku',
            'weight' => 'required|integer|min:0',
        ]);

        $data = $request->only([
            'title', 'author', 'description', 'price',
            'category_id', 'stock', 'sku', 'weight'
        ]);

        if (empty($data['sku'])) {
            $data['sku'] = 'NOV-' . strtoupper(uniqid());
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('novel_images', 'public');
        }

        $data['is_active'] = false;
        $data['hub_product_id'] = null;

        Novel::create($data);

        return redirect()->route('admin.novels.index')->with('success', 'Novel berhasil ditambahkan.');
    }

    public function edit(Novel $novel)
    {
        $categories = Category::all();
        return view('admin.novels.edit', compact('novel', 'categories'));
    }

    public function update(Request $request, Novel $novel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:255|unique:novels,sku,' . $novel->id,
            'weight' => 'required|integer|min:0',
        ]);

        $data = $request->only([
            'title', 'author', 'description', 'price',
            'category_id', 'stock', 'sku', 'weight'
        ]);

        if (empty($data['sku'])) {
            $data['sku'] = 'NOV-' . strtoupper(uniqid());
        }

        if ($request->hasFile('image')) {
            if ($novel->image && Storage::disk('public')->exists($novel->image)) {
                Storage::disk('public')->delete($novel->image);
            }
            $data['image'] = $request->file('image')->store('novel_images', 'public');
        }

        $novel->update($data);

        return redirect()->route('admin.novels.index')->with('success', 'Novel berhasil diperbarui.');
    }

    public function destroy(Novel $novel)
    {
        if ($novel->image && Storage::disk('public')->exists($novel->image)) {
            Storage::disk('public')->delete($novel->image);
        }

        $novel->delete();

        return redirect()->route('admin.novels.index')->with('success', 'Novel berhasil dihapus.');
    }

    public function toggleStatus(Novel $novel)
    {
        $novel->is_active = !$novel->is_active;
        $novel->save();

        return redirect()->route('admin.novels.index')->with('success', 'Status novel berhasil diubah.');
    }

    public function sync(Request $request, Novel $novel)
    {
        // Contoh endpoint sinkronisasi eksternal (bisa diganti dengan real API)
        $response = Http::post('https://api.phb-umkm.my.id/api/product/sync', [
            'client_id' => env('client_27qv2Zwku61p'),
            'client_secret' => env('yNPf7uxRlVyhSlpOVd4wH0K5MCuI1zFF5pOqeLFN'),
            'seller_product_id' => (string) $novel->id,
            'name' => $novel->title,
            'description' => $novel->description,
            'price' => $novel->price,
            'stock' => $novel->stock,
            'sku' => $novel->sku,
            'image_url' => $novel->image ? asset('storage/' . $novel->image) : null,
            'weight' => $novel->weight,
            'is_active' => $request->is_active == 1 ? false : true,
            'category_id' => (string) optional($novel->category)->hub_category_id,
        ]);

        if ($response->successful() && isset($response['product_id'])) {
            $novel->hub_product_id = $request->is_active == 1 ? null : $response['product_id'];
            $novel->save();
        }

        return redirect()->route('admin.novels.index')->with('success', 'Sinkronisasi novel berhasil.');
    }
}
