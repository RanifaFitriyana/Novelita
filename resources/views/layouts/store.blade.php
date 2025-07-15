<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Novelita Store - @yield('title', 'Beranda')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans leading-relaxed">

    <header class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white shadow sticky top-0 z-50">
        <div class="container mx-auto px-6 py-5 flex items-center justify-between">
            <h1 class="text-2xl md:text-3xl font-bold tracking-wide flex items-center gap-2">
                📚 <span>Novelita Store</span>
            </h1>
            <nav class="space-x-6 text-sm md:text-base font-medium">
                <a href="{{ route('store.home') }}" class="hover:text-indigo-200 transition">Home</a>
                <a href="{{ route('store.products') }}" class="hover:text-indigo-200 transition">Produk</a>
                <a href="{{ route('store.categories') }}" class="hover:text-indigo-200 transition">Kategori</a>
                <a href="{{ route('store.contact') }}" class="hover:text-indigo-200 transition">Kontak</a>
                @auth
                <span>Halo, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:text-gray-300">Logout</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a>
                <a href="{{ route('register') }}" class="ml-4 text-white hover:text-gray-300">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-indigo-800 text-white py-6 mt-10">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-sm">
            <p>&copy; {{ date('Y') }} Novelita Store. All rights reserved.</p>
            <p class="mt-2 md:mt-0">Made with 💜 in Indonesia</p>
        </div>
    </footer>

</body>

</html>