@extends('layouts.store')

@section('content')
<div class="bg-gradient-to-br from-white via-indigo-50 to-white py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-center text-indigo-800 mb-10">📚 Daftar Produk Novel</h1>

        <div class="flex justify-center">
            <div class="grid gap-6"
                style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); max-width: 1200px; width: 100%;">
                @foreach ($novels as $novel)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4 group">
                    @if ($novel->image)
                    <img src="{{ asset('storage/' . $novel->image) }}" alt="{{ $novel->title }}"
                        class="w-full h-44 object-cover rounded-md mb-3 group-hover:scale-105 transition-transform duration-300">
                    @endif

                    <h3 class="font-bold text-lg text-gray-800 group-hover:text-indigo-700 transition">
                        {{ $novel->title }}
                    </h3>
                    <p class="text-sm text-gray-500">by {{ $novel->author }}</p>
                    <p class="text-indigo-700 font-semibold mt-2">
                        Rp{{ number_format($novel->price, 0, ',', '.') }}
                    </p>

                    {{-- Tombol Aksi Opsional --}}
                    <a href="{{ route('store.products.show', $novel->id) }}"
                        class="inline-block mt-3 text-sm text-indigo-600 font-medium hover:underline hover:text-indigo-800 transition">
                        Lihat Detail →
                    </a>

                </div>
                @endforeach
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $novels->links() }}
        </div>
    </div>
</div>
@endsection