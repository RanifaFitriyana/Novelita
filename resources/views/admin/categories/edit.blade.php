<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-semibold" for="name">Nama Kategori</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block mb-1 font-semibold">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $category->description ?? '') }}</textarea>
                    @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update
                </button>
                <a href="{{ route('admin.categories.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>