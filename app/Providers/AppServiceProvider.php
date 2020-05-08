<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Repositories\CustomUserRepository;
use Auth0\Login\Contract\Auth0UserRepository;
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
            Auth0UserRepository::class,
            CustomUserRepository::class
        );
    }

    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
