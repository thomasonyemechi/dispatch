<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        //money format blade directive in naira naira html code
        Blade::directive('money', function ($amount) {
            return '&#8358;' . number_format($amount, 2, '.', ',');
        });
    }
}
