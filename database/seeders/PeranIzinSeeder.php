<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PeranIzinSeeder extends Seeder
{
    public function run()
    {
        // Bersihkan cache izin agar tidak terjadi benturan data lama
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat daftar izin
        $izin = [
            'lihat-postingan',
            'tambah-postingan',
            'ubah-postingan',
            'hapus-postingan',
            'kelola-pengguna',
        ];

        foreach ($izin as $namaIzin) {
            Permission::firstOrCreate(['name' => $namaIzin]);
        }

        // 2. Buat peran dan berikan izinnya
        // Super Admin: Tidak perlu izin khusus karena diatur lewat Gate
        Role::firstOrCreate(['name' => 'super-admin']);

        // Admin: Dapat semua izin
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo($izin);

        // Penulis: Hanya izin dasar
        $penulis = Role::firstOrCreate(['name' => 'penulis']);
        $penulis->givePermissionTo([
            'lihat-postingan',
            'tambah-postingan',
        ]);
    }
}
