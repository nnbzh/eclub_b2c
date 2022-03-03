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
Route::group(['prefix' => 'auth'], function() {
    Route::get('check', 'UserController@isPhoneUsed');
    Route::post('otp', 'AuthController@requestOtp')->middleware(['throttle:5']);
    Route::post('otp/verify', 'AuthController@verifyOtp');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
});

Route::group(['prefix' => 'user'], function() {
    Route::group(['middleware = auth:api'], function() {
        Route::post('password', 'UserController@setPassword');
        Route::apiResource('addresses', 'UserAddressController')->names([
            'index'     => 'addresses.list',
            'store'     => 'addresses.create',
            'update'    => 'addresses.edit',
            'destroy'   => 'addresses.delete',
            'show'      => 'addresses.details',
        ]);
        Route::put('addresses/{address}/activate', 'UserAddressController@activate');
    });
});

Route::group(['prefix' => 'categories'], function () {
});

Route::group(['prefix' => 'brands'], function () {
    Route::apiResource('', 'BrandController')->only(['index']);
});
Route::apiResource('categories', 'CategoryController')->only(['index','show']);
Route::apiResource('markets', 'MarketController')->only(['index']);
Route::apiResource('blocks', 'BlockController')->only(['index']);
Route::apiResource('cities', 'CityController')->only(['index']);
Route::apiResource('stories', 'StoryController')->only(['index']);
Route::apiResource('menu-items', 'MenuItemController')->only(['index']);
Route::apiResource('products', 'ProductController')->only(['index']);
