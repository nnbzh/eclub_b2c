<?php

namespace App\Providers;

use App\Helpers\StringFormatterHelper;
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
        $this->app->bind('string_formatter', StringFormatterHelper::class);
        $this->app->bind(
            \Backpack\PermissionManager\app\Http\Controllers\UserCrudController::class, //this is package controller
            \App\Http\Controllers\Admin\UserCrudController::class //this should be your own controller
        );
        $this->app
            ->when(PriceService::class)
            ->needs(PriceRepositoryInterface::class)
            ->give(function () {
                return config('services.tarantool.enabled') ? new TarantoolPriceRepository : new PriceRepository;
            });
        $this->app
            ->when(StockService::class)
            ->needs(StockRepositoryInterface::class)
            ->give(function () {
                return config('services.tarantool.enabled') ? new TarantoolStockRepository : new StockRepository;
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
