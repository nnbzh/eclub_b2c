<?php

namespace App\Helpers;

use App\Services\Price\PriceService;
use App\Services\Stock\StockService;

class ProductPreprocessorHelper
{
    public function __construct(
        private PriceService $priceService,
        private StockService $stockService,
    ) {}

    public function process($products, $cityId, $pharmacyNumber = null) {
        $stocks     = $this->stockService->getExistingProductsInCity($products, $cityId);
        $products   = $products->whereIn('sku', $stocks->pluck('sku'));
        $products   = $this->mapWithStocks($products, $stocks->pluck('quantity', 'sku'));
        $prices     = $this->priceService->getPriceForProductsByCityId($products, $cityId);
        $products   = $this->mapWithPrices($products, $prices->groupBy('sku'));

        return $products;
    }

    private function mapWithStocks($products, $stocks)
    {
        $products->map(function ($product) use ($stocks) {
            $product->quantity = $stocks[$product->sku] ?? null;

            return $product;
        });

        return $products;
    }

    private function mapWithPrices($products, $prices)
    {
        $products->map(function ($product) use ($prices) {
            $product->prices = $prices[$product->sku] ?? null;

            return $product;
        });

        return $products;
    }
}
