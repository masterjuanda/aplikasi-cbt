<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Postingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-10 px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Ubah Postingan</h1>

        <div class="bg-white p-6 rounded-lg shadow">
            <form method="POST" action="{{ route('postingan.update', $postingan) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul', $postingan->judul) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Isi</label>
                    <textarea name="isi" rows="5"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">{{ old('isi', $postingan->isi) }}</textarea>
                    @error('isi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">
                        Update
                    </button>
                    <a href="{{ route('postingan.index') }}"
                        class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
