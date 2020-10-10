<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CartManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartManager::class, function() {
            return new CartManager();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
