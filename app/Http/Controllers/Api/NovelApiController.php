<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use Illuminate\Http\Request;

class NovelApiController extends Controller
{
    public function index(Request $request)
    {
        $novels = Novel::with('category')
            ->when($request->has('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('name', $request->category);
                });
            })
            ->where('is_active', true)
            ->get();

        return response()->json($novels);
    }

    public function toggleActive($id)
    {
        $novel = \App\Models\Novel::findOrFail($id);
        $novel->is_active = !$novel->is_active;
        $novel->save();

        return response()->json([
            'success' => true,
            'is_active' => $novel->is_active,
            'message' => $novel->is_active ? 'Novel diaktifkan' : 'Novel dinonaktifkan'
        ]);
    }
}
