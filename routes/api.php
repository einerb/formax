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


Route::group(["middleware"=> "apikey.validate"], function () {
    // GET
    Route::get('orders', 'OrderController@index');
    Route::get('orders/{id}', 'OrderController@show');
    Route::get('orders/products/{id}', 'OrderController@showProductsByOrder');

    // POST
    Route::post('products', 'ProductController@store');
    Route::post('orders', 'OrderController@store');    

    // PUT
    Route::put('orders/update/{id}', 'OrderController@update');

    // DELETE
    Route::delete('products/remove/{id}', 'ProductController@destroy');
    Route::delete('orders/remove/{id}', 'OrderController@destroy');
});
