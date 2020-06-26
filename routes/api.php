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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

// GET
Route::get('products', 'ProductController@index');
Route::get('orders', 'OrderController@index');
Route::get('products/{id}', 'ProductController@show');
Route::get('orders/{id}', 'OrderController@show');

// POST
Route::post('products', 'ProductController@store');
Route::post('orders', 'OrderController@store');

// PUT
Route::put('products/update/{id}', 'ProductController@update');
Route::put('orders/update/{id}', 'OrderController@update');

// DELETE
Route::delete('products/remove/{id}', 'ProductController@destroy');
Route::delete('orders/remove/{id}', 'OrderController@destroy');