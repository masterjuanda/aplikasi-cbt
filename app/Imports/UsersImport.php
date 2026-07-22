<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
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
}
