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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts/create', [App\Http\Controllers\BlogController::class, 'create'])->name('posts.create');
Route::post('/posts', [App\Http\Controllers\BlogController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [App\Http\Controllers\BlogController::class, 'show'])->name('posts.show');