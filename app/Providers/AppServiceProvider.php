<?php

namespace App\Providers;

use App\Helpers\ProductPreprocessorHelper;
use App\Helpers\StringFormatterHelper;
use App\Models\Interfaces\Priceable;
use App\Models\Interfaces\Stockable;
use App\Models\Product;
use App\Repositories\Price\PriceRepository;
use App\Repositories\Price\PriceRepositoryInterface;
use App\Repositories\Price\TarantoolPriceRepository;
use App\Repositories\Stock\StockRepository;
use App\Repositories\Stock\StockRepositoryInterface;
use App\Repositories\Stock\TarantoolStockRepository;
use App\Services\Price\PriceService;
use App\Services\Stock\StockService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindHelpers();
        $this->bindBackpackClasses();
        $this->provideProductDependencies();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    private function bindHelpers() {
        $this->app->bind('stringFormatter', StringFormatterHelper::class);
        $this->app->bind('productPreprocessor', ProductPreprocessorHelper::class);
    }

    private function bindBackpackClasses() {
        $this->app->bind(
            \Backpack\PermissionManager\app\Http\Controllers\UserCrudController::class, //this is package controller
            \App\Http\Controllers\Admin\UserCrudController::class //this should be your own controller
        );
    }

    private function provideProductDependencies() {
        $tarantoolEnabled = config('services.tarantool.enabled');
        $this->app
            ->when(PriceService::class)
            ->needs(PriceRepositoryInterface::class)
            ->give($tarantoolEnabled ? TarantoolPriceRepository::class : PriceRepository::class);
        $this->app
            ->when(StockService::class)
            ->needs(StockRepositoryInterface::class)
            ->give($tarantoolEnabled ? TarantoolStockRepository::class : StockRepository::class);
    }
}
