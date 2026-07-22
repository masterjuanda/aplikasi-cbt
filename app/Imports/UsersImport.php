<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Cek apakah email sudah ada, kalau ada skip
        $existing = User::where('email', $row['alamat_email'])->first();
        if ($existing) {
            return null;
        }

        return new User([
            'name'     => $row['nama_lengkap'],
            'email'    => $row['alamat_email'],
            'password' => bcrypt($row['kata_sandi'] ?? '123456')
        ]);
    }

    // Aturan validasi
    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:100',
            'alamat_email' => 'required|email',
        ];
    }

    // Pesan kesalahan khusus
    public function customValidationMessages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'alamat_email.required' => 'Email wajib diisi',
            'alamat_email.email'    => 'Format email tidak valid',
        ];
    }
}
