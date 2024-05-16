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

Route::get('/product/{id}', 'App\Http\Controllers\Api\ProductController@show_product_detail');
Route::get('/product/search/{searchTerm}', 'App\Http\Controllers\Api\ProductController@search');

Route::post('/chechkout/make-order', 'App\Http\Controllers\Api\CheckoutController@make_order');
Route::delete('/chechkout/delete-order/{id}', 'App\Http\Controllers\Api\CheckoutController@delete_order');
Route::post('/chechkout/check-order', 'App\Http\Controllers\Api\CheckoutController@check_order');

Route::post('/cart/add-item/{user_id}/{product_id}/{quantity}', 'App\Http\Controllers\Api\CartController@addToCart');
Route::delete('/cart/delete-item/{user_id}/{product_id}/{quantity}', 'App\Http\Controllers\Api\CartController@deleteItem');

Route::post('/login', 'App\Http\Controllers\Api\UserController@login');
Route::post('/register', 'App\Http\Controllers\Api\UserController@register');           