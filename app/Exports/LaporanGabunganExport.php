<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanGabunganExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new UsersExport(),
        ];
    }
}
