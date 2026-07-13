<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\SiswaLoginController;
use App\Http\Requests\AdminEmailVerificationRequest;
use App\Http\Requests\SiswaEmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostinganController;

// =====================
// VERIFIKASI EMAIL ADMIN
// =====================
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/email/verifikasi', function () {
        return view('auth.verifikasi-email-admin');
    })->name('verification.notice');

    Route::get('/email/verifikasi/{id}/{hash}', function (AdminEmailVerificationRequest $permintaan) {
        $permintaan->fulfill();
        return redirect()->route('admin.dashboard')->with('pesan', 'Email berhasil diverifikasi!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/kirim-ulang', function (Request $permintaan) {
        $permintaan->user('admin')->sendEmailVerificationNotification();
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

    Route::get('/email/verifikasi/{id}/{hash}', function (SiswaEmailVerificationRequest $permintaan) {
        $permintaan->fulfill();
        return redirect()->route('siswa.dashboard')->with('pesan', 'Email berhasil diverifikasi!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/kirim-ulang', function (Request $permintaan) {
        $permintaan->user('siswa')->sendEmailVerificationNotification();
        return back()->with('pesan', 'Tautan verifikasi baru telah dikirim ke email kamu.');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Rute Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login']);
    });

    Route::middleware(['admin', 'email.verified'])->group(function () {
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

    Route::middleware(['siswa', 'email.verified'])->group(function () {
        Route::get('/dashboard', function () {
            return view('siswa.dashboard');
        })->name('dashboard');
        Route::post('/logout', [SiswaLoginController::class, 'logout'])->name('logout');
    });
});

// =====================
// RUTE POSTINGAN
// =====================
Route::middleware('auth')->group(function () {
    // Hanya pengguna yang bisa melihat daftar postingan
    Route::get('/postingan', [PostinganController::class, 'index'])
        ->middleware('permission:lihat-postingan')
        ->name('postingan.index');

    // Hanya yang punya izin menambah
    Route::get('/postingan/tambah', [PostinganController::class, 'create'])
        ->middleware('permission:tambah-postingan')
        ->name('postingan.create');

    Route::post('/postingan', [PostinganController::class, 'store'])
        ->middleware('permission:tambah-postingan')
        ->name('postingan.store');

    // Untuk ubah & hapus dicek lewat Policy di dalam Controller
    Route::get('/postingan/{postingan}/ubah', [PostinganController::class, 'edit'])
        ->name('postingan.edit');

    Route::put('/postingan/{postingan}', [PostinganController::class, 'update'])
        ->name('postingan.update');

    Route::delete('/postingan/{postingan}', [PostinganController::class, 'destroy'])
        ->name('postingan.destroy');
});

Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
