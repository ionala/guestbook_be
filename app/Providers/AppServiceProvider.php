<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Load web routes
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
        // Load API routes
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }
}

