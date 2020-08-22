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


Route::group(['namespace' => 'Api'], function () {
    
    Route::group(['namespace' => 'Auth'], function () {

        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController');
        Route::post('logout', 'LogoutController')->middleware('auth:api');
    
    });

});

Route::group(['namespace' => 'Api'], function () {

		Route::middleware(['auth:api'])->group(function () {

					Route::get('product', "ProductController@index");
					Route::get('product/sort/price/{parametr}', "ProductController@showByPrice");
					Route::get('product/sort/date/{parametr}', "ProductController@showByDate");
					Route::get('product/{id}', "ProductController@show");
					Route::get('product/category/{id_category}', "ProductController@showByCategory");
					Route::post('create/product', "ProductController@create");
					Route::delete('product/{id}', "ProductController@destroy");


					Route::get('category', "CategoryController@index");
					Route::post('create/category', "CategoryController@store");
					Route::put('update/category/{id}', "CategoryController@update");
					Route::delete('delete/category/{id}', "CategoryController@destroy");
		
		});
}); 