<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(
    [
        'name' => 'api.v1',
        'namespace' => 'V1',
        'as' => 'api.',
        'middleware' => ['jwt'],
        'prefix' => 'v1',
    ],
    function () {
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
          Route::get('/getMe', 'UserController@getMe');
        });
        Route::group(
            ['prefix' => 'organization', 'as' => 'organization.'],
            function () {
                Route::get('/getList', 'OrganizationController@getList');
            }
        );
    }
);
