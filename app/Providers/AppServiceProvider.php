<?php

namespace App\Providers;

use App\Helpers\ProductPreprocessorHelper;
use App\Helpers\StringFormatterHelper;
use App\Repositories\Price\PriceRepository;
use App\Repositories\Price\PriceRepositoryInterface;
use App\Repositories\Price\TarantoolPriceRepository;
use App\Repositories\Stock\StockRepository;
use App\Repositories\Stock\StockRepositoryInterface;
use App\Repositories\Stock\TarantoolStockRepository;
use App\Services\Price\PriceService;
use App\Services\Stock\StockService;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Validator;
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
        $this->provideProductDependencies();
        $this->replaceBackpackClasses();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerValidationRules();
    }

    private function bindHelpers() {
        $this->app->bind('stringFormatter', StringFormatterHelper::class);
        $this->app->bind('productPreprocessor', ProductPreprocessorHelper::class);
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

    private function replaceBackpackClasses() {
        $loader = AliasLoader::getInstance();
        $loader->alias(
            \Backpack\CRUD\app\Library\CrudPanel\CrudFilter::class,
            \App\Overrides\CrudFilter::class
        );
        $this->app->bind(
            \Backpack\PermissionManager\app\Http\Controllers\UserCrudController::class, //this is package controller
            \App\Http\Controllers\Admin\UserCrudController::class //this should be your own controller
        );
    }

    private function registerValidationRules() {
        Validator::extendImplicit('required_without_auth', function ($attribute, $value, $parameters, $validator) {
            return \Auth::check('api');
        });
    }
}
