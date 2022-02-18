<?php

namespace App\Repositories;

use App\Filters\MarketFilter;
use App\Models\Market;

class MarketRepository
{
    public function list(array $filters = []) {
        $query = Market::query()->with('image');

        if (! empty($filters)) {
            $query->applyFilters(new MarketFilter, $filters);
        }

        return $query->orderBy('lft')->get();
    }
}
