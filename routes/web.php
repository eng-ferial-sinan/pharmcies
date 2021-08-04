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
Route::resource('/category',App\Http\Controllers\CategoryController::class);
Route::resource('/pharmacy',App\Http\Controllers\PharmacyController::class);
Route::resource('/medicine',App\Http\Controllers\MedicineController::class);
Route::resource('/order',App\Http\Controllers\OrderController::class);
Route::post('/setting',[App\Http\Controllers\SettingController::class, 'update']);
Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index']);
Route::resource('/role', App\Http\Controllers\PermissionController::class);
Route::post('/profile/updated', [App\Http\Controllers\UserController::class, 'profile']);
Route::post('/profile/updated/saveimage', [App\Http\Controllers\UserController::class, 'saveimage']);
Route::resource('/member',App\Http\Controllers\UserController::class);
Route::delete('/member/{id}/froceDestroy', [App\Http\Controllers\UserController::class, 'froceDestroy']);
Route::get('/member/{id}/restorUser', [App\Http\Controllers\UserController::class, 'restorUser']);
Route::get('/members/{id}', 'UserController@index1')->middleware('permission:user-list');
// Route::get('/category/{id}', [App\Http\Controllers\admin\CategoryController::class, 'category'])->name('category');
Route::get('/members/{id}', [App\Http\Controllers\UserController::class, 'user'])->middleware('permission:user-list');

Route::get('/home',function(){  return view('home');});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::group(['prefix' => 'admin' ,'middleware'=>'auth' ], function () {
//     Route::post('/category', [App\Http\Controllers\admin\CategoryController::class, 'store'])->name('category.store');
//     Route::post('/category/{id}/delete',[App\Http\Controllers\admin\CategoryController::class, 'delete']);    

// });
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/posts/create', [App\Http\Controllers\BlogController::class, 'create'])->name('posts.create');
Route::post('/posts', [App\Http\Controllers\BlogController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [App\Http\Controllers\BlogController::class, 'show'])->name('posts.show');