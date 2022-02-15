<?php

namespace App\Filters;

class UserAddressFilter extends ModelFilter
{
    public function user_id($value) {
        return $this->builder->where('user_id', $value);
    }

    public function city_id($value) {
        return $this->builder->where('city_id', $value);
    }
}
