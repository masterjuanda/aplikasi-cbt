<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureSiswa
{
    public function handle(Request $request, Closure $next)
    {
        // Jika yang login adalah admin dan coba akses halaman siswa
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Admin tidak boleh mengakses halaman Siswa!');
        }

        // Jika bukan siswa, arahkan ke login siswa
        if (!Auth::guard('siswa')->check()) {
            return redirect()->route('siswa.login')
                ->with('error', 'Akses hanya untuk Siswa!');
        }

        return $next($request);
    }
}
