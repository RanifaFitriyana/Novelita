<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Novelita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

    <!-- Header -->
    <header class="bg-indigo-600 text-white shadow">
        <div class="container mx-auto px-4 py-5 flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-wide">Novelita Store</h1>
            <nav>
                <a href="/" class="text-white hover:underline">Home</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-10">
        @foreach ($categories as $category)
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-indigo-700 mb-6 border-b pb-1">{{ $category->name }}</h2>

                @if ($category->novels->count())
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @foreach ($category->novels as $novel)
                            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition duration-300 overflow-hidden">
                                @if ($novel->image)
                                    <img src="{{ asset('storage/' . $novel->image) }}"
                                         alt="{{ $novel->title }}"
                                         class="w-full h-48 object-cover">
                                @endif
                                <div class="p-4">
                                    <h3 class="text-lg font-bold mb-1 text-gray-800">{{ $novel->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $novel->author }}</p>
                                    <p class="text-sm mt-2 text-gray-600">{{ \Str::limit($novel->description, 100) }}</p>
                                    <div class="mt-4 text-indigo-600 font-semibold">
                                        Rp{{ number_format($novel->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">Belum ada novel dalam kategori ini.</p>
                @endif
            </section>
        @endforeach
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-10 py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Novelita Store. All rights reserved.
    </footer>

</body>
</html>
