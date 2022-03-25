<?php

namespace App\Repositories\Stock;

use App\Models\Product;

interface StockRepositoryInterface
{
    public function updateStocksByCityId($cityId);
    public function updateStocksByPharmacyNumber($pharmacyNumber);
    public function getExistingProductsInCity($products, $cityId);
    public function getExistingProductsInPharmacy($products, $pharmacyNumber);
}
