<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Postingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto mt-10 px-4">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Postingan</h1>
            @can('tambah-postingan')
                <a href="{{ route('postingan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    + Tambah Postingan
                </a>
            @endcan
        </div>

        {{-- Pesan sukses --}}
        @if (session('pesan'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('pesan') }}
            </div>
        @endif

        {{-- Daftar postingan --}}
        @foreach ($daftarPostingan as $item)
            <div class="bg-white p-6 rounded-lg shadow mb-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $item->judul }}</h3>
                <p class="text-gray-600 mt-2">{{ $item->isi }}</p>

                <div class="mt-4 flex gap-3">
                    {{-- Tombol hanya muncul jika berhak --}}
                    @can('ubah', $item)
                        <a href="{{ route('postingan.edit', $item) }}"
                            class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                            Ubah
                        </a>
                    @endcan

                    @can('hapus', $item)
                        <form action="{{ route('postingan.destroy', $item) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        @endforeach

        @if ($daftarPostingan->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
                Belum ada postingan.
            </div>
        @endif

    </div>
</body>

</html>
