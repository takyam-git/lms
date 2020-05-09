<?php
namespace App\Facades\Helpers;

use Illuminate\Support\Facades\Facade;

class EloquentHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'eloquent_helper';
    }
}
