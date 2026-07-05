<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Jika yang login adalah siswa dan coba akses halaman admin
        if (Auth::guard('siswa')->check()) {
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Siswa tidak boleh mengakses halaman Admin!');
        }

        // Jika bukan admin, arahkan ke login admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Akses hanya untuk Admin!');
        }

        return $next($request);
    }
}
