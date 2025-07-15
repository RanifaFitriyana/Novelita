@extends('layouts.store')

@section('content')
<div class="py-16 bg-white">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-1/2">
                <img src="{{ asset('storage/' . $novel->image) }}" alt="{{ $novel->title }}" class="rounded-xl shadow">
            </div>
            <div class="w-full md:w-1/2">
                <h2 class="text-3xl font-bold text-indigo-800 mb-2">{{ $novel->title }}</h2>
                <p class="text-gray-600 mb-1">by {{ $novel->author }}</p>
                <p class="text-indigo-600 font-semibold text-2xl mb-4">Rp{{ number_format($novel->price, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-700 mb-6">
                    {{ $novel->description ?? 'Belum ada deskripsi untuk novel ini.' }}
                </p>
                <p class="text-sm text-gray-500 mb-2">Kategori: {{ $novel->category->name ?? '-' }}</p>

                <a href="{{ route('store.products') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                    ← Kembali ke Daftar Novel
                </a>
            </div>
        </div>
    </div>
</div>
@endsection