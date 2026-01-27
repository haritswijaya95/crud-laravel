<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Import Route jika diperlukan, tapi jangan panggil method yang tidak ada
use Illuminate\Support\Facades\Route; 

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
        // HAPUS baris $this->configureRateLimiting()
        // HAPUS baris $this->routes(...)
        
        // Biarkan kosong atau isi dengan konfigurasi lain yang valid
    }
}