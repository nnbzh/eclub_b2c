<?php

namespace App\Filters;

class OrderFilter extends ModelFilter
{
    public function status($value) {
        $value = is_array($value) ? $value : [$value];

        return $this->builder->whereIn('status', $value);
    }
}
