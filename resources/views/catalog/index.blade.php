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

    <form method="GET" action="{{ route('catalog') }}">
        <label>Kategori:
            <select name="category">
                <option value="">Semua</option>
                @foreach ($categories as $cat)
                <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </label>

        <label>Cari Judul:
            <input type="text" name="title" value="{{ request('title') }}">
        </label>

        <button type="submit">Filter</button>
    </form>

    <hr>

    @foreach ($categories as $category)
    <h2>{{ $category->name }}</h2>
    @forelse ($category->novels as $novel)
    <div>
        <strong>{{ $novel->title }}</strong> oleh {{ $novel->author }} <br>
        Harga: Rp {{ number_format($novel->price, 0, ',', '.') }} <br>
        <p id="status-{{ $novel->id }}">
            Status: <strong>{{ $novel->is_active ? 'Aktif' : 'Nonaktif' }}</strong>
        </p>

        <button
            onclick="toggleNovel({{ $novel->id }})"
            id="btn-{{ $novel->id }}">
            {{ $novel->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
        </button>

        <hr>
    </div>
    @empty
    <p>Tidak ada novel dalam kategori ini.</p>
    @endforelse
    @endforeach

    <script>
        function toggleNovel(id) {
            fetch(`/api/novels/${id}/toggle`, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const statusText = data.is_active ? 'Aktif' : 'Nonaktif';
                        const buttonText = data.is_active ? 'Nonaktifkan' : 'Aktifkan';

                        document.getElementById('status-' + id).innerHTML = 'Status: <strong>' + statusText + '</strong>';
                        document.getElementById('btn-' + id).innerText = buttonText;
                    }
                })
                .catch(error => {
                    alert("Gagal mengubah status novel");
                    console.error(error);
                });
        }
    </script>
</body>

</html>