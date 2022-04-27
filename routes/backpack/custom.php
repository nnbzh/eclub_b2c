<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('menu_item', 'MenuItemCrudController');
    Route::crud('market', 'MarketCrudController');
    Route::crud('block', 'BlockCrudController');
    Route::crud('city', 'CityCrudController');
    Route::crud('story', 'StoryCrudController');
    Route::crud('brand', 'BrandCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('pharmacy', 'PharmacyCrudController');
    Route::crud('rating_message', 'RatingMessageCrudController');
    Route::crud('delivery_method', 'DeliveryMethodCrudController');
    Route::crud('promotion_group', 'PromotionGroupCrudController');
    Route::crud('promotion_group_product', 'PromotionGroupProductCrudController');
    Route::crud('promotion_group_category', 'PromotionGroupCategoryCrudController');
    Route::crud('notification_type', 'NotificationTypeCrudController');
    Route::crud('product_description', 'ProductDescriptionCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('image', 'ImageCrudController');
}); // this should be the absolute last line of this file
