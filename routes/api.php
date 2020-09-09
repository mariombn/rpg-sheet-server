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
Route::get('/v1/', function(){
    return ['success' => false];
})->name('login');

Route::post('/v1/auth/singup', 'UserController@singup')->name('auth-singup');
Route::post('/v1/auth/singin', 'UserController@singin')->name('auth-singin');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')
    ->get('/v1/system/getAll', 'SystemController@getAll')
    ->name('system-getall');
