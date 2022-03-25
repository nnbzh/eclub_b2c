<?php

namespace App\Services\Market;

use App\Repositories\MarketRepository;

class MarketService
{
    public function __construct(private MarketRepository $marketRepository)
    {

    }

    public function list(array $filters = []) {
        $filters['is_active'] = true;

        return $this->marketRepository->list($filters);
    }
}
