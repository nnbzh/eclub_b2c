<?php

namespace App\Filters;

class FastDeliveryZoneFilter extends ModelFilter
{
    public function city_id($value)
    {
        return $this->builder->whereHas('city', function ($query) use ($value) {
            if (is_array($value)) {
                $query = $query->whereIn('cities.id', $value);
            } else {
                $query = $query->where('cities.id', $value);
            }

            return $query;
        });
    }
}
