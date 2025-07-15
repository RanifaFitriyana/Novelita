@extends('layouts.store')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold mb-8">Kategori Novel</h1>

    <ul class="list-disc list-inside space-y-3 text-indigo-700 font-semibold">
        @foreach ($categories as $category)
            <li>{{ $category->name }} ({{ $category->novels->where('is_active', true)->count() }} novel aktif)</li>
        @endforeach
    </ul>
</div>
@endsection
