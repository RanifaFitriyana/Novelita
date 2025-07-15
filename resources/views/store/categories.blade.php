@extends('layouts.store')

@section('content')
<div class="bg-gradient-to-br from-indigo-50 to-white py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-center text-indigo-800 mb-12">
            📚 Kategori Novel
        </h1>
        <p class="text-center text-gray-600 max-w-xl mx-auto mb-10">
            Temukan novel pilihan terbaik berdasarkan kategori. Jelajahi cerita fiksi dan nonfiksi yang seru, penuh inspirasi, dan menghibur!
        </p>

        <div class="flex justify-center space-x-4 mb-12">
            <a href="{{ route('store.products', ['category' => 'Fiksi']) }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-full transition">
                📖 Lihat Fiksi
            </a>
            <a href="{{ route('store.products', ['category' => 'Nonfiksi']) }}"
                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-full transition">
                📘 Lihat Nonfiksi
            </a>
        </div>


        <div class="flex justify-center">
            <div class="grid gap-8"
                style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); max-width: 1200px; width: 100%;">
                @foreach ($categories as $category)
                <div class="bg-white rounded-xl shadow hover:shadow-lg border border-indigo-100 hover:border-indigo-300 transition p-6 text-center group">
                    <div class="flex items-center justify-center mb-4">
                        <div class="bg-indigo-100 p-3 rounded-full group-hover:bg-indigo-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 0a8 8 0 100 16v-2m0-14a8 8 0 01-8 8h2a6 6 0 006-6v-2z" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-lg font-semibold text-indigo-800 group-hover:text-purple-700 transition">
                        {{ $category->name }}
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">
                        {{ $category->novels->where('is_active', true)->count() }} novel aktif
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection