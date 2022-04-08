<?php

namespace App\Repositories;

use App\Models\DeliveryMethod;

class DeliveryMethodRepository
{
    public function list($cityId = null, $user = null, $marketNumber = null) {
        $query = DeliveryMethod::query()
            ->with([
                'cities' => fn($query) => $query->where('id', $cityId)
            ]);

        $query->whereHas('cities', fn($query) => $query
                ->where('delivery_method_city.is_active', true)
                ->where('city_id', $cityId));

        if ($marketNumber) {
            $query->whereHas('markets', fn($query) => $query->where('markets.number', $marketNumber));
        }

        return $query
            ->where('is_active', true)
            ->orderBy('lft')
            ->get();
    }
}
