<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Aplicant;
use App\Observers\AplicantObserver;

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
        // Aplicant::observe(AplicantObserver::class);
    }
}
