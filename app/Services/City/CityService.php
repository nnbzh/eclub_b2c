<?php

namespace App\Services\City;

use App\Repositories\CityRepository;

class CityService
{
    public function __construct(private CityRepository $cityRepository)
    {

    }

    public function list() {
        return $this->cityRepository->list();
    }
}
