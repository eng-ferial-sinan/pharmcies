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
Route::resource('/category',App\Http\Controllers\CategoryController::class);
Route::resource('/pharmacy',App\Http\Controllers\PharmacyController::class);
Route::resource('/medicine',App\Http\Controllers\MedicineController::class);
Route::resource('/order',App\Http\Controllers\OrderController::class);
Route::get('/order/setStatus',[App\Http\Controllers\OrderController::class,'setStatus']);
Route::post('/setting',[App\Http\Controllers\SettingController::class, 'update']);
Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index']);
Route::resource('/roles', App\Http\Controllers\PermissionController::class);
Route::get('/user/profile',[App\Http\Controllers\UserController::class, 'profiles']);
Route::post('/profile/updated', [App\Http\Controllers\UserController::class, 'profile']);
Route::post('/profile/updated/saveimage', [App\Http\Controllers\UserController::class, 'saveimage']);
Route::resource('/member',App\Http\Controllers\UserController::class);
Route::delete('/member/{id}/froceDestroy', [App\Http\Controllers\UserController::class, 'froceDestroy']);
Route::get('/member/{id}/restorUser', [App\Http\Controllers\UserController::class, 'restorUser']);
Route::get('/members/{id}', 'UserController@index1')->middleware('permission:user-list');
Route::get('/members/{id}', [App\Http\Controllers\UserController::class, 'user'])->middleware('permission:user-list');

Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
