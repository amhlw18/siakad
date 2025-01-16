<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Gate::define('superadmin', function (User $user) {
            return in_array($user->role, [1, 6]);
        });

        Gate::define('bendahara', function (User $user) {
            return in_array($user->role, [2]);
        });

        Gate::define('dosen', function (User $user) {
            return in_array($user->role, [3]);
        });

        Gate::define('mahasiswa', function (User $user) {
            return in_array($user->role, [1, 4, 5, 6]);
        });

        Gate::define('prodi', function (User $user) {
            return in_array($user->role, [1, 5, 6]);
        });

//        Gate::define('shared', function (User $user) {
//            return in_array($user->role, [1, 2]); // SuperAdmin dan Bendahara
//        });

    }
}
