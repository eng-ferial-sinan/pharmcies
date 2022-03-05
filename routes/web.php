<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

    Route::group([
        'middleware' => 
        ['role:مدير','auth'],
    ], function ()
{
    Route::resource('/product',App\Http\Controllers\ProductController::class);
    Route::resource('/order',App\Http\Controllers\OrderController::class);
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index']);
    Route::post('/settings',[App\Http\Controllers\SettingController::class, 'update']);
    Route::get('/braintree', [App\Http\Controllers\SettingController::class, 'braintreeShow']);
    Route::post('/braintree',[App\Http\Controllers\SettingController::class, 'braintreeUpdate']);
    Route::resource('/roles', App\Http\Controllers\RoleController::class);
    Route::get('/user/profile',[App\Http\Controllers\UserController::class, 'profiles']);
    Route::post('/profile/updated', [App\Http\Controllers\UserController::class, 'profile']);
    Route::post('/profile/updated/saveimage', [App\Http\Controllers\UserController::class, 'saveimage']);
    Route::resource('/member',App\Http\Controllers\UserController::class);
    Route::resource('/contact',App\Http\Controllers\ContactController::class);
    Route::delete('/member/{id}/froceDestroy', [App\Http\Controllers\UserController::class, 'froceDestroy']);
    Route::get('/member/{id}/restorUser', [App\Http\Controllers\UserController::class, 'restorUser']);
    Route::get('/members/{id}', 'UserController@index1');
    Route::get('/members/{id}', [App\Http\Controllers\UserController::class, 'user']);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

    Route::get('/reports', [App\Http\Controllers\ReportController::class,'index']);
    
});

