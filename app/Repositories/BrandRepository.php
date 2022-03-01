<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
    public function all() {
        return Brand::query()
            ->where('is_active', true)
            ->orderBy('lft')
            ->limit(20)
            ->get();
    }

    public function forMainPage() {
        return Brand::query()
            ->where('is_active', true)
            ->orderBy('lft')
            ->limit(5)
            ->get();
    }
}
