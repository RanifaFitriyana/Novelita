<!DOCTYPE html>
<html>

<head>
    <title>Novel Catalog</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .card {
            border: 1px solid #ccc;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .on {
            background-color: lightgreen;
        }

        .off {
            background-color: lightcoral;
        }
    </style>
</head>

<body>
    <h1>Catalog Buku Novel</h1>

    @foreach ($categories as $category)
    <h2>{{ $category->name }}</h2>
    @foreach ($category->novels as $novel)
    <div class="card">
        <h3>{{ $novel->title }} - {{ $novel->author }}</h3>
        <p>Harga: Rp {{ number_format($novel->price, 0, ',', '.') }}</p>
        <p>Status: <strong>{{ $novel->is_active ? 'Aktif' : 'Nonaktif' }}</strong></p>
        <button class="{{ $novel->is_active ? 'on' : 'off' }}" onclick="toggleNovel({{ $novel->id }}, this)">
            {{ $novel->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
        </button>
    </div>
    @endforeach
    @endforeach

    <script>
        function toggleNovel(id, button) {
            fetch(`/api/novels/${id}/toggle`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Toggle button text and style
                        const isActive = data.is_active;
                        button.innerText = isActive ? 'Nonaktifkan' : 'Aktifkan';
                        button.className = isActive ? 'on' : 'off';
                        const status = button.previousElementSibling;
                        status.innerHTML = 'Status: <strong>' + (isActive ? 'Aktif' : 'Nonaktif') + '</strong>';
                    }
                });
        }
    </script>
</body>

</html>