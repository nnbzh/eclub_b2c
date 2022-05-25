<?php

namespace App\Helpers;

use App\Models\Pharmacy;
use App\Repositories\MarketRepository;
use App\Services\Price\PriceService;
use App\Services\Stock\StockService;

class ProductPreprocessorHelper
{
    public function __construct(
        private PriceService $priceService,
        private StockService $stockService,
    ) {}

    public function process($products, $cityId, $pharmacyNumber = null, $inStock = true) {
        if ($inStock) {
            $stocks = $this->stockService->getExistingProductsInCity($products, $cityId);
            $products   = $this->mapWithStocks($products, $stocks->pluck('quantity', 'sku'));
        }

        $prices     = $this->priceService->getPriceForProductsByCityId($products, $cityId);
        $products   = $this->mapWithPrices($products, $prices->groupBy('sku'));

        return $products;
    }

    public function getExistingInPharmacy($products, Pharmacy $pharmacy) {
        $stocks = $this->stockService->getExistingProductsInPharmacy($products, $pharmacy->number);
        $products   = $products->whereIn('sku', $stocks->pluck('sku'));
        $products   = $this->mapWithStocks($products, $stocks->pluck('quantity', 'sku'));
        $prices     = $this->priceService->getPriceForProductsByCityId($products, $pharmacy->city_id);
        $products   = $this->mapWithPrices($products, $prices->groupBy('sku'));

        return $products;
    }

    private function mapWithStocks($products, $stocks)
    {
        $products->map(function ($product) use ($stocks) {
            $product->quantity = $stocks[$product->sku] ?? 0;

            return $product;
        });

        return $products;
    }

    private function mapWithPrices($products, $prices)
    {
        $markets = (new MarketRepository)->list()->keyBy('number');
        $prices = $prices->map(function ($productPrices) use ($markets) {
            return $productPrices->map(function ($item) use ($markets) {
                $item->market_name = $markets[$item->market_number]->name ?? null;
                $item->market_image = $markets[$item->market_number]->logo ?? null;

                return $item;
            });
        });
        $products->map(function ($product) use ($prices) {
            $product->prices = $prices[$product->sku] ?? null;

            return $product;
        });

        return $products;
    }
}
