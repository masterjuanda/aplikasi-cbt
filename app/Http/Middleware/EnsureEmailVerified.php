<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailVerified
{
    public function handle(Request $request, Closure $next)
    {
        // Cek guard admin
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            if (!$admin->hasVerifiedEmail()) {
                return redirect()->route('admin.verification.notice');
            }
        }

        // Cek guard siswa
        if (Auth::guard('siswa')->check()) {
            $siswa = Auth::guard('siswa')->user();
            if (!$siswa->hasVerifiedEmail()) {
                return redirect()->route('siswa.verification.notice');
            }
        }

        return $next($request);
    }
}
