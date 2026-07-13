<?php

namespace App\Providers;

use App\Models\Postingan;
use App\Policies\PostinganPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Postingan::class => PostinganPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Aturan khusus: Super Admin bisa mengakses semuanya
        Gate::before(function ($pengguna, $kemampuan) {
            if ($pengguna->hasRole('super-admin')) {
                return true;
            }
        });
    }
}
