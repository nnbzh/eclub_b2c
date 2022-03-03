<?php

namespace App\Helpers;

use App\Services\Price\PriceService;
use App\Services\Stock\StockService;

class ProductPreprocessorHelper
{
    public function __construct(private PriceService $priceService, private StockService $stockService) {}

    public function process($products, $options = []) {
        $stocks     = $this->stockService->getExistingProductsInCity($products, 1);

        return $products;
    }
}
