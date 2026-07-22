<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\LaporanGabunganExport;
use App\Imports\UsersImport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Validators\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'daftar-pengguna.xlsx');
    }

    public function exportGabungan()
    {
        return Excel::download(new LaporanGabunganExport, 'laporan-semua-data.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data berhasil diimpor!');
        } catch (ValidationException $e) {
            $kesalahan = $e->failures();
            $pesanKesalahan = [];
            foreach ($kesalahan as $k) {
                $pesanKesalahan[] = "Baris ke-{$k->row()}: " . implode(', ', $k->errors());
            }
            return redirect()->back()
                ->with('error', 'Terdapat kesalahan pada berkas:')
                ->with('detail_kesalahan', $pesanKesalahan);
        }
    }
}
