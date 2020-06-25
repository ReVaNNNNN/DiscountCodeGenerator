<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(
            'App\Services\DiscountCode\ResultInterface',
            'App\Services\DiscountCode\FileHandler'
        );

        $this->app->bind(
            'App\Services\DiscountCode\GeneratorInterface',
            'App\Services\DiscountCode\Generator'
        );
    }
}
