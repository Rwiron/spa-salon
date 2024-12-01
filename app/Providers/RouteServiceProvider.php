<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        Route::aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
    }
}