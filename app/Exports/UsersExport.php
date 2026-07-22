<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithEvents, WithTitle
{

    public function title(): string
    {
        return 'Data Pengguna';
    }

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

    // Lebar kolom tetap
    public function columnWidths(): array
    {
        return [
            'A' => 8,   // ID
            'B' => 25,  // Nama
            'C' => 30,  // Email
            'D' => 20   // Tanggal
        ];
    }

    // Atur gaya setelah lembar dibuat
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'color' => ['rgb' => 'FFFFFF']
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '2C5C97']
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                // Batas garis seluruh sel
                $event->sheet->getStyle('A1:D' . $event->sheet->getHighestRow())
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            }
        ];
    }
}
