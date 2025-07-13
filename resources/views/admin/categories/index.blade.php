<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-6 rounded shadow">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah Kategori</a>

            <table class="table-auto w-full border border-collapse border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Nama Kategori</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <td class="border px-4 py-2">{{ $category->name }}</td>
                        <td class="border px-4 py-2 text-center">
                            <form action="{{ route('admin.categories.toggleStatus', $category->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded text-white {{ $category->is_active ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td class="border px-4 py-2 whitespace-nowrap">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">Belum ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
