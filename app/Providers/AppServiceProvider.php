<?php

namespace App\Providers;

use Auth0\Login\Contract\Auth0UserRepository as Auth0UserRepositoryContract;
use Auth0\Login\Repository\Auth0UserRepository;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
        $this->app->bind(
            Auth0UserRepositoryContract::class,
            Auth0UserRepository::class
        );
    }

    public function boot()
    {
    }
}
