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

Route::namespace('Api\v1')->group(function () {
    // Public Routes
    Route::post('v1/auth/login', 'AuthController@login');
    Route::post('v1/singup', 'UserController@store');
    Route::get('v1/users', 'UserController@index');

    // Private Routes
    Route::group(['middleware' => ['apiJwt']], function () {
        //Route::get('v1/users', 'UserController@index');
        Route::get('v1/me', 'AuthController@me');


        Route::get('v1/systems', 'SystemController@index');

            Route::get('v1/campaigns', 'CampaignController@index')->name('campaigns-index');
        Route::get('v1/campaigns/{id}', 'CampaignController@show')->name('campaigns-show');
        Route::post('v1/campaigns', 'CampaignController@store')->name('campaigns-store');
        Route::put('v1/campaigns/{id}', 'CampaignController@update')->name('campaigns-update');
        Route::delete('v1/campaigns/{id}', 'CampaignController@destroy')->name('campaigns-destroy');

        Route::post('v1/auth/logout', 'AuthController@logout');
        Route::post('v1/auth/refresh', 'AuthController@refresh');
        Route::post('v1/auth/me', 'AuthController@me');
    });
});
