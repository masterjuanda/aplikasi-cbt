<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi CBT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Sistem Informasi Sekolah</h1>
            <p class="text-gray-600 mt-2">Silakan pilih akses untuk masuk ke sistem</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-md px-4">
            <!-- Kartu Admin -->
            <a href="{{ route('admin.login') }}"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow border-l-4 border-blue-500">
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-gray-700">Panel Admin</h3>
                    <p class="text-sm text-gray-500 mt-1">Kelola data sekolah, pengguna, dan laporan</p>
                </div>
            </a>

            <!-- Kartu Siswa -->
            <a href="{{ route('siswa.login') }}"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow border-l-4 border-green-500">
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-gray-700">Akses Siswa</h3>
                    <p class="text-sm text-gray-500 mt-1">Lihat nilai, jadwal, dan materi pembelajaran</p>
                </div>
            </a>
        </div>
    </div>
</body>

</html>
