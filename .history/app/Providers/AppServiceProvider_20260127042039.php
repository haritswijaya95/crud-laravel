<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


// app/Providers/RouteServiceProvider.php

    public const HOME = '/'; // Ubah dari /dashboard ke /produk
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
    $this->configureRateLimiting();

    $this->routes(function () {
        Route::middleware('api')
            ->prefix('api') // Pastikan ada prefix 'api' ini
            ->group(base_path('routes/api.php'));

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    });
}
}
