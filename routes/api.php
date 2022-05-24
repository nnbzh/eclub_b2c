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
        Route::get('orders', 'UserController@orders');
        Route::get('orders/active', 'UserController@activeOrders');
        Route::get('orders/delivered', 'UserController@deliveredOrders');
        Route::get('orders/pickups', 'UserController@pickupOrders');
        Route::get('products', 'UserController@products');
        Route::put('addresses/{address}/activate', 'UserAddressController@activate');
        Route::post('subscription', 'UserController@subscribe');
        Route::post('image', 'UserController@uploadImage');
        Route::get('notifications/{slug}', 'UserController@notifications');
        Route::get('notifications/unread/count', 'UserController@unreadNotificationsCount');
        Route::group(['prefix' => 'bankcards'], function () {
            Route::get('url', 'BankcardController@getUrlForAddition');
            Route::post('paybox/callback', 'BankcardController@payboxStoreCallback')->name('bankcard.paybox.store.callback');
        });
        Route::apiResource('addresses', 'UserAddressController')->shallow();
        Route::apiResource('reminders', 'ReminderController')->shallow();
        Route::post('reminders/sync', 'ReminderController@synchronize');
    });
    Route::group(['prefix' => 'orders'], function() {
        Route::post('', 'OrderController@store');
        Route::post('delivery-amount', 'OrderController@calculateDeliveryCost');
        Route::post('callback', 'OrderController@callback');
        Route::get('{order}', 'OrderController@show')->whereNumber('order');
        Route::post('{order}/cancel', 'OrderController@cancel')->whereNumber('order');
        Route::post('{order}/reviews', 'OrderReviewController@store')->whereNumber('order');
    });
});

Route::group(['prefix' => 'products'], function () {
    Route::get('', 'ProductController@index');
    Route::get('search', 'ProductController@search');
    Route::get('{product}', 'ProductController@show')->whereNumber('product');
    Route::get('{product}/reviews', 'ProductReviewController@index')->whereNumber('product');
    Route::post('{product}/reviews', 'ProductReviewController@store')->whereNumber('product');
    Route::post('{product}/like', 'UserController@like');
    Route::get('pickup-pharmacies', 'ProductController@getPickupPharmacies');
    Route::get('groups/{slug}', 'PromotionGroupController@getBySlug');
});

Route::apiResource('brands', 'BrandController')->only(['index']);
Route::apiResource('categories', 'CategoryController')->only(['index','show']);
Route::apiResource('markets', 'MarketController')->only(['index']);
Route::apiResource('blocks', 'BlockController')->only(['index']);
Route::apiResource('cities', 'CityController')->only(['index']);
Route::apiResource('stories', 'StoryController')->only(['index']);
Route::apiResource('menu-items', 'MenuItemController')->only(['index']);
Route::apiResource('delivery-methods', 'DeliveryMethodController')->only(['index']);
Route::get('delivery-methods/available', 'DeliveryMethodController@available');
Route::apiResource('payment-methods', 'PaymentMethodController')->only(['index']);
Route::apiResource('cancel-messages', 'CancelMessageController')->only(['index']);

Route::get('slots/today', 'SlotController@today');
Route::get('slots/tomorrow', 'SlotController@tomorrow');

Route::post('device-tokens', 'DeviceTokenController@store');
Route::delete('device-tokens', 'DeviceTokenController@destroy');

Route::get('notifications', 'NotificationTypeController@index');

Route::group(['prefix' => 'delivery-zones'], function () {
    Route::group(['prefix' => 'fast'], function () {
        Route::get('check', 'FastDeliveryZoneController@isInside');
    });
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('products', 'AdminController@products');
});

Route::post('order/send/push', 'OrderController@sendPushOrder');
