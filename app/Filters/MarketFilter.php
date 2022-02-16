<?php

namespace App\Filters;

class MarketFilter extends ModelFilter
{
    public function city_id($value) {
        return $this->builder->whereHas('cities', function ($query) use ($value) {
            $query->where('cities.id', $value);
        });
    }

    public function is_active($value) {
        return $this->builder->where('is_active', $value);
    }
}
