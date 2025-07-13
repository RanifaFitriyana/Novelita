<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Novelita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 font-sans leading-relaxed">

    <!-- Header -->
    <header class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white shadow sticky top-0 z-50">
        <div class="container mx-auto px-6 py-5 flex items-center justify-between">
            <h1 class="text-2xl md:text-3xl font-bold tracking-wide flex items-center gap-2">
                📚 <span>Novelita Store</span>
            </h1>
            <nav class="space-x-6 text-sm md:text-base font-medium hidden md:flex">
                <a href="#" class="hover:text-indigo-200 transition">Home</a>
                <a href="#produk" class="hover:text-indigo-200 transition">Produk</a>
                <a href="#kategori" class="hover:text-indigo-200 transition">Kategori</a>
                <a href="#kontak" class="hover:text-indigo-200 transition">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Produk -->
    <main class="container mx-auto px-4 py-12" id="produk">
        @foreach ($categories as $category)
            @if ($category->is_active && $category->novels->where('is_active', true)->count())
            <section class="mb-20" id="kategori">
                <h2 class="text-2xl md:text-3xl font-semibold text-indigo-700 mb-8 border-b-2 pb-2 border-indigo-300">
                    {{ $category->name }}
                </h2>

                <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($category->novels->where('is_active', true) as $novel)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition duration-300 overflow-hidden border border-gray-200">
                        @if ($novel->image)
                        <img src="{{ asset('storage/' . $novel->image) }}"
                             alt="{{ $novel->title }}"
                             class="w-full h-52 object-cover">
                        @endif
                        <div class="p-5 flex flex-col h-full">
                            <h3 class="text-lg font-bold mb-1 text-gray-900">{{ $novel->title }}</h3>
                            <p class="text-sm text-gray-500 mb-1">by {{ $novel->author }}</p>
                            <p class="text-sm mt-2 text-gray-600 flex-grow">{{ \Str::limit($novel->description, 100) }}</p>
                            <div class="mt-3 text-sm text-gray-600">
                                Stok: <span class="font-medium">{{ $novel->stock }}</span>
                            </div>
                            <div class="mt-2 text-indigo-600 font-bold text-lg">
                                Rp{{ number_format($novel->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        @endforeach
    </main>

    <!-- Kontak -->
    <section id="kontak" class="bg-white py-12 border-t">
        <div class="container mx-auto px-6">
            <h3 class="text-2xl md:text-3xl font-semibold mb-6 text-indigo-700">Kontak Kami</h3>
            <div class="space-y-2 text-gray-600">
                <p>📞 WhatsApp: <a href="https://wa.me/628123456789" class="text-indigo-600 hover:underline">+62 812 3456 789</a></p>
                <p>📧 Email: <a href="mailto:novelita@email.com" class="text-indigo-600 hover:underline">novelita@email.com</a></p>
                <p>📍 Lokasi: Jl. Literasi No. 42, Jakarta</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-indigo-800 text-white py-6 mt-10">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-sm">
            <p>&copy; {{ date('Y') }} Novelita Store. All rights reserved.</p>
            <p class="mt-2 md:mt-0">Made with 💜 in Indonesia</p>
        </div>
    </footer>

</body>
</html>
<script src="https://cdn.tailwindcss.com"></script>
