<?php
namespace App\Facades\Helpers;

use Illuminate\Support\Facades\Facade;

class StringHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'string_helper';
    }
}
