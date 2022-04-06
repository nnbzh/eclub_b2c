<?php

namespace App\Filters;

class ProductFilter extends ModelFilter
{
    public function brand_id($value) {
        return $this->builder->where('brand_id', $value);
    }

    public function category_id($value) {
        if (is_array($value)) {
            $this->builder->whereIn('category_id', $value);
        } else {
            $this->builder->where('category_id', $value);
        }

        return $this->builder;
    }
}
