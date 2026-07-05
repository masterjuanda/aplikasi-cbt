<x-app-layout>

    <!-- Pesan Error / Info -->
    @if (session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm max-w-7xl mx-auto mt-6">
            {{ session('error') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Selamat Datang, Admin!</h3>
                    <p class="mt-2">Anda masuk sebagai pengguna dengan hak akses penuh.</p>

                    <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
