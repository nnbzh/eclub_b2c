<?php

namespace App\Repositories\Price;

interface PriceRepositoryInterface
{
    public function updatePricesByCityId($cityId);
}
