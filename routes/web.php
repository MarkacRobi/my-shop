<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'ItemsController@index');

Route::get('/about', 'PagesController@about');

Route::get('/services', 'PagesController@services');

//Shopping Cart
Route::get('/add-to-cart/{id}', [
    'uses' => 'CartController@getAddToCart',
    'as' => 'item.addToCart'
]);
Route::get('/remove-from-cart/{id}', [
    'uses' => 'CartController@getRemoveFromCart',
    'as' => 'item.removeFromCart'
]);
Route::get('/remove-all-by-id-from-cart/{id}', [
    'uses' => 'CartController@getRemoveAllByIdFromCart',
    'as' => 'item.removeAllByIdFromCart'
]);

Route::get('/shopping-cart', [
    'uses' => 'CartController@getCart',
    'as' => 'item.shoppingCart'
]);
//Receipt
Route::get('/shopping-cart/receipt', [
    'uses' => 'CartController@getReceipt',
    'as' => 'item.shoppingCart.receipt'
]);
//

Route::resource('posts', 'PostsController');

Route::resource('items', 'ItemsController');

Route::resource('users', 'UsersController');

Route::get('orders/potrjena', 'OrderController@indexPotrjena');
Route::resource('orders', 'OrderController');

Route::get('/dashboard', 'DashboardController@index');

Route::get('/dashboard/posts', 'DashboardController@dashboard');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'forceSSL'], function(){

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // Email Verification Routes...
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

});
