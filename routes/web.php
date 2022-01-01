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
        'prefix' => 'admin',
        'middleware' => 
        ['role:مدير','auth'],
    ], function ()
{
    Route::resource('/category',App\Http\Controllers\CategoryController::class);
    Route::resource('/product',App\Http\Controllers\ProductController::class);
    Route::get('/order/setStatus',[App\Http\Controllers\OrderController::class,'setStatus'])->name('order.setStatus');
    Route::get('/order/setUser',[App\Http\Controllers\OrderController::class,'setUser']);
    Route::resource('/order',App\Http\Controllers\OrderController::class);
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index']);
    Route::post('/settings',[App\Http\Controllers\SettingController::class, 'update']);
    Route::get('/braintree', [App\Http\Controllers\SettingController::class, 'braintreeShow']);
    Route::post('/braintree',[App\Http\Controllers\SettingController::class, 'braintreeUpdate']);
    Route::resource('/slide', App\Http\Controllers\SlideController::class);
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/shop/', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop.all');
Route::get('/shop/{id}', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\HomeController::class, 'addContact'])->name('contact.add');
Route::get('/register', [App\Http\Controllers\HomeController::class, 'register'])->name('register');
Route::get('/cart/add/{product}', [App\Http\Controllers\CustomerController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{product}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('cart.remove');
Route::post('/cart/update', [App\Http\Controllers\CustomerController::class, 'update'])->name('cart.update');
Route::get('/cart/calculate/{address}', [App\Http\Controllers\CustomerController::class, 'calculate'])->name('cart.calculate');
Route::get('/cart/', [App\Http\Controllers\CustomerController::class, 'showCart'])->name('cart.show');
Route::get('/checkout', [App\Http\Controllers\CustomerController::class, 'checkout'])->name('cart.checkout');
Route::get('paypal/payment/{id}', [App\Http\Controllers\CustomerController::class, 'payment'])->name('paypal.payment');

Route::get('/customer/account', [App\Http\Controllers\CustomerController::class, 'index'])->name('account');
Route::resource('/address', App\Http\Controllers\AddressController::class);
Route::get('/customer/orders', [App\Http\Controllers\CustomerController::class, 'orders'])->name('orders');
Route::get('/customer/orders/{order}', [App\Http\Controllers\CustomerController::class, 'show'])->name('customer.show');
Route::post('/customer/login', [App\Http\Controllers\AuthController::class, 'login'])->name('customer.login');
Route::post('/customer/register', [App\Http\Controllers\AuthController::class, 'register'])->name('customer.register');
Route::post('/customer/update', [App\Http\Controllers\AuthController::class, 'update'])->name('customer.update');
Route::get('/customer/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('customer.logout');
