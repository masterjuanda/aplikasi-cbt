<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Data Admin — sudah terverifikasi
        Admin::create([
            'name'              => 'Administrator',
            'email'             => 'admin@example.com',
            'password'          => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        // Data Siswa — sudah terverifikasi
        Siswa::create([
            'name'              => 'Budi Santoso',
            'email'             => 'budi@siswa.id',
            'password'          => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        Siswa::create([
            'name'              => 'Siti Aminah',
            'email'             => 'siti@siswa.id',
            'password'          => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);
    }
}
