<?php

namespace App\Providers;

use App\Helpers\EloquentHelper;
use App\Helpers\StringHelper;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    private const CLASSES = [
        'eloquent_helper' => EloquentHelper::class,
        'string_helper' => StringHelper::class,
    ];
    public function register()
    {
        foreach (static::CLASSES as $alias => $serviceClass) {
            $this->app->singleton($serviceClass);
            $this->app->alias($serviceClass, $alias);
        }
    }
}
