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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/setup1','App\Http\Controllers\Api\HomeController@index');
Route::get('/braintree','App\Http\Controllers\Api\HomeController@braintree');
Route::post('/login','App\Http\Controllers\Api\UserController@login');
Route::post('/logout','App\Http\Controllers\Api\UserController@logout');
Route::post('/register','App\Http\Controllers\Api\UserController@register');
Route::get('/me','App\Http\Controllers\Api\UserController@dataUser');
Route::put('/update','App\Http\Controllers\Api\UserController@update');
Route::get('/token','App\Http\Controllers\Api\OrderController@token');
Route::get('/method','App\Http\Controllers\Api\OrderController@method');
Route::resource('/order',App\Http\Controllers\Api\OrderController::class);
