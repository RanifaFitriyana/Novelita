<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Novel') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-6 rounded shadow">
            <a href="{{ route('admin.novels.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                ➕ Tambah Novel
            </a>

            <table class="table-auto w-full border border-collapse border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-sm text-gray-700">
                        <th class="border px-4 py-2">Gambar</th>
                        <th class="border px-4 py-2">Judul</th>
                        <th class="border px-4 py-2">Deskripsi</th>
                        <th class="border px-4 py-2">Penulis</th>
                        <th class="border px-4 py-2">Kategori</th>
                        <th class="border px-4 py-2">Harga</th>
                        <th class="border px-4 py-2">Stok</th>
                        <th class="border px-4 py-2">SKU</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Sinkron</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($novels as $novel)
                    <tr class="text-sm">
                        <td class="border px-4 py-2 text-center">
                            @if($novel->image)
                            <img src="{{ asset('storage/' . $novel->image) }}" alt="Gambar" class="w-20 h-24 object-cover rounded">
                            @else
                            <span class="text-gray-400">Tidak ada</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2 font-semibold">{{ $novel->title }}</td>
                        <td class="border px-4 py-2 text-gray-600">{{ \Illuminate\Support\Str::limit($novel->description, 60) }}</td>
                        <td class="border px-4 py-2">{{ $novel->author ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $novel->category->name ?? '-' }}</td>
                        <td class="border px-4 py-2">Rp{{ number_format($novel->price, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-center">{{ $novel->stock ?? '-' }}</td>
                        <td class="border px-4 py-2 text-center">{{ $novel->sku ?? '-' }}</td>

                        {{-- Status --}}
                        <td class="border px-4 py-2 text-center">
                            <form action="{{ route('admin.novels.toggleStatus', $novel->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded text-white {{ $novel->is_active ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}">
                                    {{ $novel->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>

                        {{-- Sinkronisasi --}}
                        <td class="border px-4 py-2 text-center">
                            <form action="{{ route('admin.novels.sync', $novel) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded text-white bg-green-600 hover:bg-green-700">
                                    Sinkronkan
                                </button>
                            </form>
                        </td>

                        {{-- Aksi --}}
                        <td class="border px-4 py-2 whitespace-nowrap">
                            <a href="{{ route('admin.novels.edit', $novel->id) }}" class="text-indigo-600 hover:underline mr-2">✏️ Edit</a>
                            <form action="{{ route('admin.novels.destroy', $novel->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus novel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center py-4 text-gray-600">Belum ada data novel.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
