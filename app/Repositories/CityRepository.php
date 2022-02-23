<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository
{
    public function list() {
        return City::query()->where('is_active', true)->orderBy('name')->get();
    }
}
