<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

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

/*
Route::get('/', function () {
return view('welcome');
});
*/


Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('products');
Route::get('/product', 'App\Http\Controllers\ProductController@show_product_detail')->name('product_detail');


Route::get('/cart', 'App\Http\Controllers\CartController@show_cart')->name('cart');
Route::get('/add-to-cart', 'App\Http\Controllers\CartController@addToCart')->name('cart.add');
Route::get('/cart/remove/', 'App\Http\Controllers\CartController@removeCartItem')->name('cart.remove');
Route::post('/cart/update/', 'App\Http\Controllers\CartController@updateCartItemQuantity')->name('cart.update');

Route::get('/checkout', 'App\Http\Controllers\CheckoutController@show_checkout') ->name('checkout');
Route::post('/checkout/update/', 'App\Http\Controllers\CheckoutController@update_checkout') ->name('checkout.update');
Route::post('/checkout/make/', 'App\Http\Controllers\CheckoutController@make_order') ->name('checkout.make');

Route::get('/login', 'App\Http\Controllers\UserController@show_login') ->name('login');
Route::post('/login', 'App\Http\Controllers\UserController@login') ->name('login.submit');
Route::post('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');
Route::get('/register', 'App\Http\Controllers\UserController@showRegistration')->name('register');
Route::post('/register', 'App\Http\Controllers\UserController@register')->name('register.submit');
Route::get('/search', 'App\Http\Controllers\ProductController@show_search') ->name('search');
Route::get('/search_results', 'App\Http\Controllers\ProductController@search') ->name('search.submit');

Route::get('/admin', 'App\Http\Controllers\AdminController@show_admin')->name('admin');
Route::post('/products/create', 'App\Http\Controllers\AdminController@create_product')->name('product.create');
Route::get('/products/create', 'App\Http\Controllers\AdminController@view_create_product')->name('product.create');
Route::get('/products/{id}/edit', 'App\Http\Controllers\AdminController@show_edit_product')->name('product.edit');
Route::put('/products/{id}', 'App\Http\Controllers\AdminController@update_product')->name('product.update');
Route::get('/products/delete/{id}', 'App\Http\Controllers\AdminController@delete_product')->name('product.delete');


Route::get('/change_password', 'App\Http\Controllers\UserController@showChangePass')->name('password.change');
Route::post('/change_password', 'App\Http\Controllers\UserController@ChangePassword')->name('password.change.submit');

Route::post('/change_information', 'App\Http\Controllers\UserController@ChangeInfo')->name('information.submit');

