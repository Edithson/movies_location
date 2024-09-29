<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::statement('PRAGMA foreign_keys = ON;');

        Gate::define('gerant_right', function (User $user){
            return $user->type_id > 1;
        });
        Gate::define('admin_right', function (User $user){
            return $user->type_id > 2;
        });
        Gate::define('individual_right', function (User $user, int $id){
            return $user->id == $id;
        });
    }
}
