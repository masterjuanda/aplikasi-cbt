<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\EnsureAdmin::class,
            'siswa' => \App\Http\Middleware\EnsureSiswa::class,
            'email.verified' => \App\Http\Middleware\EnsureEmailVerified::class,
        ]);

        // Tambahkan ini — beritahu Laravel kemana redirect kalau belum login
        $middleware->redirectGuestsTo(function ($request) {
            if ($request->is('admin*')) {
                return route('admin.login');
            }
            if ($request->is('siswa*')) {
                return route('siswa.login');
            }
            return route('admin.login');
        });

        $middleware->redirectUsersTo(function ($request) {
            if ($request->is('admin*')) {
                return route('admin.verification.notice');
            }
            if ($request->is('siswa*')) {
                return route('siswa.verification.notice');
            }
            return route('admin.verification.notice');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
