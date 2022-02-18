<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository
{
    public function list() {
        return City::query()->orderBy('name')->get();
    }
}
