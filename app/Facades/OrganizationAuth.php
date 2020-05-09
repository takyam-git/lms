<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class OrganizationAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'organization_auth';
    }
}
