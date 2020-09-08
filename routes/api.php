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

//TODO: Ultilizar Grupos nas rotas
Route::post('/v1/auth/singup', 'MockController@singup')->name('auth-singup');
Route::post('/v1/auth/singin', 'MockController@singin')->name('auth-singin');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
