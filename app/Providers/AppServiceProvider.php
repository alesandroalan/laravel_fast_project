<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFour();
        $this->register();
        \Gate::define('menu_users', function ($user) {
            //Administradores
//            if ($user->roles()->first()->name == 'Administradores') {
            if($user->roles()->first()->hasPermissionTo('menu_users')) {
                return true;
            }
            return false;
        });
    }
}
