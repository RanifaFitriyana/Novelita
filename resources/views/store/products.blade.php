@extends('layouts.store')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold mb-8">Daftar Produk Novel</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($novels as $novel)
            <div class="bg-white rounded-lg shadow p-4">
                @if ($novel->image)
                    <img src="{{ asset('storage/' . $novel->image) }}" alt="{{ $novel->title }}" class="w-full h-40 object-cover rounded-md mb-3">
                @endif
                <h3 class="font-bold text-lg">{{ $novel->title }}</h3>
                <p class="text-sm text-gray-600">by {{ $novel->author }}</p>
                <p class="text-indigo-700 font-semibold mt-2">Rp{{ number_format($novel->price, 0, ',', '.') }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $novels->links() }}
    </div>
</div>
@endsection
