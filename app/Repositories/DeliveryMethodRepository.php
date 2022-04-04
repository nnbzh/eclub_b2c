<?php

namespace App\Repositories;

use App\Models\DeliveryMethod;

class DeliveryMethodRepository
{
    public function list($cityId = null, $user = null, $marketId = null) {
        $query = DeliveryMethod::query()
            ->with([
                'cities' => fn($query) => $query->where('id', $cityId)
            ]);

        $query->whereHas('cities', fn($query) => $query
                ->where('delivery_method_city.is_active', true)
                ->where('city_id', $cityId));

        if ($marketId) {
            $query->whereHas('markets', fn($query) => $query->where('markets.id', $marketId));
        }

        return $query
            ->where('is_active', true)
            ->orderBy('lft')
            ->get();
    }
}
