<?php

namespace App\Providers;

use App\Repositores\cart\CartRepository;
use App\Repositores\cart\CookieRepository;
use App\Repositores\cart\DatabaseRepository;
use App\Repositores\cart\SessionRepository;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartRepository::class, function($app) {
         return  new DatabaseRepository();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
