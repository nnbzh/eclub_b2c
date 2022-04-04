<?php

namespace App\Repositories;

use App\Filters\ProductFilter;
use App\Models\Product;

class ProductRepository
{
    public function list(array $filters = []) {
        $query = Product::query()
            ->with([
                'image',
                'brand',
                'category',
                'ratings'
            ]);

        if (! empty($filters)) {
            $query->applyFilters(new ProductFilter, $filters);
        }

        $query->orderBy('lft');

        return $query->simplePaginate(100);
    }

    public function getBy($column, $value) {
        $query = Product::query();

        if (is_array($value)) {
            $query->whereIn($column, $value);
        } else {
            $query->where($column, $value);
        }

        return $query->get();
    }

    public function search(string $keyword)
    {
        return Product::search($keyword)->simplePaginate(100);
    }
}
