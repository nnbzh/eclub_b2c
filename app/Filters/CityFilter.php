<?php

namespace App\Filters;

class CityFilter extends ModelFilter
{
    public function has_fast_delivery($value) {
        return $this->builder->where('has_fast_delivery', $value);
    }
}
