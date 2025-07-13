<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use App\Models\Category;
use Illuminate\Http\Request;
// Tambahan di bagian use
use Illuminate\Support\Facades\Storage;

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
            'stock' => 'required|integer|min:0', // ✅ Tambah validasi stock
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only('title', 'author', 'description', 'price', 'stock', 'category_id'); // ✅ Tambah stock

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('novel_images', 'public');
        }

        $data['is_active'] = false;

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
            'stock' => 'required|integer|min:0', // ✅ Tambah validasi stock
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only('title', 'author', 'description', 'price', 'stock', 'category_id'); // ✅ Tambah stock

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
}
