<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home'; // default redirect after login

    public function boot()
    {
        $this->routes(function () {
    Route::middleware('web')
        ->group(base_path('routes/web.php'));

    Route::middleware('web')
        ->group(base_path('routes/auth.php'));

    Route::middleware('web')
        ->group(base_path('routes/admin-auth.php'));

    Route::middleware(['web', 'auth:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php')); // ✅ load admin routes
});

    }
}
