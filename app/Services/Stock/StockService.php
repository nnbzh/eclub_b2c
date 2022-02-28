<?php

namespace App\Services\Stock;

use App\Repositories\Stock\StockRepositoryInterface;

class StockService
{
    public function __construct(private StockRepositoryInterface $stockRepository) {}

    public function updateStocksByCityId($cityId) {
        $this->stockRepository->updateStocksByCityId($cityId);
    }

    public function updateStocksByPharmacyNumber($pharmacyNumber) {
        $this->stockRepository->updateStocksByPharmacyNumber($pharmacyNumber);
    }
}
