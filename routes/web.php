<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\SiswaLoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// =====================
// VERIFIKASI EMAIL ADMIN
// =====================
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/email/verifikasi', function () {
        return view('auth.verifikasi-email-admin');
    })->name('verification.notice');

    Route::get('/email/verifikasi/{id}/{hash}', function (EmailVerificationRequest $permintaan) {
        $permintaan->fulfill();
        return redirect()->route('admin.dashboard')->with('pesan', 'Email berhasil diverifikasi!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/kirim-ulang', function (Request $permintaan) {
        $permintaan->user()->sendEmailVerificationNotification();
        return back()->with('pesan', 'Tautan verifikasi baru telah dikirim ke email kamu.');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// =====================
// VERIFIKASI EMAIL SISWA
// =====================
Route::middleware('auth:siswa')->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/email/verifikasi', function () {
        return view('auth.verifikasi-email-siswa');
    })->name('verification.notice');

    Route::get('/email/verifikasi/{id}/{hash}', function (EmailVerificationRequest $permintaan) {
        $permintaan->fulfill();
        return redirect()->route('siswa.dashboard')->with('pesan', 'Email berhasil diverifikasi!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/kirim-ulang', function (Request $permintaan) {
        $permintaan->user()->sendEmailVerificationNotification();
        return back()->with('pesan', 'Tautan verifikasi baru telah dikirim ke email kamu.');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// Halaman Utama - Pilihan Akses
Route::get('/', function () {
    return view('welcome');
});

// Rute Admin
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login']);
    });

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    });
});

// Rute Siswa
Route::prefix('siswa')->name('siswa.')->group(function () {

    Route::middleware('guest:siswa')->group(function () {
        Route::get('/login', [SiswaLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [SiswaLoginController::class, 'login']);
    });

    Route::middleware('siswa')->group(function () {
        Route::get('/dashboard', function () {
            return view('siswa.dashboard');
        })->name('dashboard');
        Route::post('/logout', [SiswaLoginController::class, 'logout'])->name('logout');
    });
});
