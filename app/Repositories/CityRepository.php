<?php

namespace App\Repositories;

use App\Filters\CityFilter;
use App\Models\City;

class CityRepository
{
    public function findById($id) {
        return City::query()->findOrFail($id);
    }

    public function list($filters = [], $relations = []) {
        $query = City::query()
            ->with($relations)
            ->where('is_active', true);

        if (! empty($filters)) {
            $query->applyFilters(new CityFilter, $filters);
        }

        return $query->orderBy('name')->get();
    }
}
