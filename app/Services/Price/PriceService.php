<?php

namespace App\Services\Price;

use App\Repositories\Price\PriceRepositoryInterface;

class PriceService
{
    public function __construct(
        private PriceRepositoryInterface $priceRepository,
    ) {}

    public function updatePricesByCityId($cityId) {
        $this->priceRepository->updatePricesByCityId($cityId);
    }
}
