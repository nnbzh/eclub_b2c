<?php

namespace App\Repositories\Stock;

interface StockRepositoryInterface
{
    public function updateStocksByCityId($cityId);
    public function updateStocksByPharmacyNumber($pharmacyNumber);
}
