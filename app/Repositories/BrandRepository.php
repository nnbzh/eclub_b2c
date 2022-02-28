<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
    public function list() {
        return Brand::query()
            ->where('is_active', true)
            ->orderBy('lft')
            ->limit(20)
            ->get();
    }
}
