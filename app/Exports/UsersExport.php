<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    // Ambil data dari model
    public function collection()
    {
        return User::select('id', 'name', 'email', 'created_at')->get();
    }

    // Judul kolom
    public function headings(): array
    {
        return [
            'ID',
            'Nama Lengkap',
            'Alamat Email',
            'Tanggal Dibuat'
        ];
    }

    // Sesuaikan format data
    public function map($user): array
    {
        return [
            $user->id,
            strtoupper($user->name),
            $user->email,
            $user->created_at->format('d/m/Y H:i')
        ];
    }
}
