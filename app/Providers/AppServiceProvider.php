<?php

namespace App\Providers;

use App\Helpers\Config;
use App\Helpers\Roles;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Config::class, function () {
            return new Config();
        });

        $this->app->bind(Roles::class, function () {
            return new Roles();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
