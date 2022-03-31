<?php

namespace App\Repositories;

use App\Filters\FastDeliveryZoneFilter;
use App\Models\FastDeliveryZone;

class FastDeliveryZoneRepository
{
    public function list($filters = []) {
        $query = FastDeliveryZone::query()->with('pharmacy', 'city');

        if (! empty($filters)) {
            $query->applyFilters(new FastDeliveryZoneFilter, $filters);
        }

        return $query->get();
    }
}
