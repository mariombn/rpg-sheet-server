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

    // Private Routes
    Route::group(['middleware' => ['apiJwt']], function(){
        Route::get('v1/users', 'UserController@index');
        Route::post('v1/auth/logout', 'AuthController@logout');
        Route::post('v1/auth/refresh', 'AuthController@refresh');
        Route::post('v1/auth/me', 'AuthController@me');
    });
});
