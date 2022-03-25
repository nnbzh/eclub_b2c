<?php

namespace App\Repositories;

use App\Models\DeliveryMethod;

class DeliveryMethodRepository
{
    public function list($cityId = null, $user = null) {
        $query = DeliveryMethod::query()
            ->with([
                'cities' => fn($query) => $query->where('id', $cityId)
            ]);

        $query->whereHas('cities', fn($query) => $query
                ->where('delivery_method_city.is_active', true)
                ->where('city_id', $cityId));

        return $query
            ->where('is_active', true)
            ->orderBy('lft')
            ->get();
    }
}
