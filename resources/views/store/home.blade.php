@extends('layouts.store')

@section('content')
<div class="relative overflow-hidden bg-gradient-to-r from-indigo-50 via-white to-purple-50">
    <div class="container mx-auto px-6 py-20 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-800 mb-4 animate-fade-in-down">
            📚 Selamat Datang di <span class="text-purple-700">Novelita Store!</span>
        </h1>
        <p class="text-lg text-gray-700 max-w-2xl mx-auto mb-8 animate-fade-in-up">
            Temukan koleksi novel <span class="font-semibold text-indigo-600">fiksi & nonfiksi</span> terbaru yang menginspirasi, menyentuh hati, dan membuatmu betah membaca berjam-jam!
        </p>
        <a href="{{ route('store.products') }}"
            class="inline-block px-8 py-3 bg-indigo-600 text-white text-lg font-semibold rounded-full shadow hover:bg-indigo-700 transition-all duration-300">
            Jelajahi Novel Sekarang
        </a>
    </div>
</div>

<h2 class="text-3xl font-bold text-center text-indigo-800 mb-8">📚 Kategori Pilihan</h2>

<div class="flex justify-center">
    <div class="grid gap-6 mb-12"
        style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); max-width: 1024px; width: 100%;">
        @foreach ($categories as $category)
        <a href="{{ route('store.categories') }}"
            class="group bg-white rounded-xl border border-indigo-200 shadow-sm hover:shadow-md hover:border-indigo-400 transition duration-300 p-5 text-center flex flex-col items-center">
            {{-- Ikon kategori --}}
            <div class="bg-indigo-100 group-hover:bg-indigo-200 text-indigo-700 rounded-full p-3 mb-3 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2s-3 1.343-3 3 1.343 3 3 3zM12 14c2.21 0 4 1.79 4 4H8c0-2.21 1.79-4 4-4z" />
                </svg>
            </div>

            <span class="text-indigo-800 font-semibold text-lg group-hover:text-purple-700 transition">
                {{ $category->name }}
            </span>
        </a>
        @endforeach
    </div>
</div>

<h2 class="text-3xl font-bold mb-6 text-center text-indigo-800">✨ Novel Terbaru ✨</h2>

<div class="flex justify-center">
    <div class="grid gap-8"
        style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); max-width: 1200px; width: 100%;">
        @foreach ($novels as $novel)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
            @if ($novel->image)
            <img src="{{ asset('storage/' . $novel->image) }}" alt="{{ $novel->title }}"
                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
            @endif
            <div class="p-5">
                <h3 class="text-xl font-bold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">
                    {{ $novel->title }}
                </h3>
                <p class="text-sm text-gray-500 mb-2">by {{ $novel->author }}</p>
                <p class="text-indigo-700 font-semibold text-lg mb-4">
                    Rp{{ number_format($novel->price, 0, ',', '.') }}
                </p>
                {{-- Tombol Aksi Opsional --}}
                <a href="{{ route('store.products.show', $novel->id) }}"
                    class="inline-block mt-3 text-sm text-indigo-600 font-medium hover:underline hover:text-indigo-800 transition">
                    Lihat Detail →
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Tombol Lihat Selengkapnya --}}
<div class="text-center mt-8">
    <a href="{{ route('store.products') }}"
        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group">
        <span>Lihat Selengkapnya</span>
        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
    </a>
</div>

</div>
@endsection