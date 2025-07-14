<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Novel') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
            <form action="{{ route('admin.novels.update', $novel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block mb-1 font-semibold">Judul Novel</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $novel->title) }}" required class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="author" class="block mb-1 font-semibold">Penulis</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $novel->author) }}" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('author')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block mb-1 font-semibold">Kategori</label>
                    <select id="category_id" name="category_id" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $novel->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="sku" class="block mb-1 font-semibold">SKU</label>
                    <input type="text" id="sku" name="sku" value="{{ old('sku', $novel->sku) }}" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('sku')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="stock" class="block mb-1 font-semibold">Stok</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $novel->stock) }}" min="0" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('stock')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="weight" class="block mb-1 font-semibold">Berat (gram)</label>
                    <input type="number" id="weight" name="weight" value="{{ old('weight', $novel->weight) }}" min="0" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('weight')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block mb-1 font-semibold">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $novel->description) }}</textarea>
                    @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    @if($novel->image)
                        <img src="{{ asset('storage/' . $novel->image) }}" alt="Gambar Novel" class="mb-4 w-48 h-auto object-cover rounded">
                    @endif
                    <label for="image" class="block mb-1 font-semibold">Ganti Gambar Novel</label>
                    <input type="file" id="image" name="image" accept="image/*" class="w-full">
                    @error('image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block mb-1 font-semibold">Harga</label>
                    <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $novel->price) }}" required class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('price')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                    <a href="{{ route('admin.novels.index') }}" class="text-gray-600 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
