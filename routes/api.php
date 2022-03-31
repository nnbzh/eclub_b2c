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

Route::group(['middleware = auth:api'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::get('', 'UserController@me');
        Route::put('', 'UserController@update');
        Route::post('password', 'UserController@setPassword');
        Route::put('addresses/{address}/activate', 'UserAddressController@activate');
        Route::post('subscription', 'UserController@subscribe');
        Route::post('image', 'UserController@uploadImage');
        Route::group(['prefix' => 'bankcards'], function () {
            Route::post('', 'BankcardController@store');
            Route::post('paybox/callback', 'BankcardController@payboxStoreCallback')->name('bankcard.paybox.store.callback');
        });
        Route::apiResource('addresses', 'UserAddressController')->shallow();
    });
    Route::group(['prefix' => 'orders'], function() {
        Route::post('', 'OrderController@store');
        Route::post('{order}', 'OrderController@cancel')->whereNumber('order');
    });
});

Route::apiResource('products', 'ProductController')->only(['index', 'show'])->whereNumber('product');
Route::apiResource('products.reviews', 'ProductReviewController')->only(['index', 'store']);
Route::group(['prefix' => 'products'], function () {
    Route::get('search', 'ProductController@search');
});

Route::apiResource('brands', 'BrandController')->only(['index']);
Route::apiResource('categories', 'CategoryController')->only(['index','show']);
Route::apiResource('markets', 'MarketController')->only(['index']);
Route::apiResource('blocks', 'BlockController')->only(['index']);
Route::apiResource('cities', 'CityController')->only(['index']);
Route::apiResource('stories', 'StoryController')->only(['index']);
Route::apiResource('menu-items', 'MenuItemController')->only(['index']);
Route::apiResource('delivery-methods', 'DeliveryMethodController')->only(['index']);
Route::apiResource('payment-methods', 'PaymentMethodController')->only(['index']);

Route::get('slots/today', 'SlotController@today');
Route::get('slots/tomorrow', 'SlotController@tomorrow');
Route::group(['prefix' => 'delivery-zones'], function () {
    Route::group(['prefix' => 'fast'], function () {
        Route::get('check', 'FastDeliveryZoneController@isInside');
    });
});
