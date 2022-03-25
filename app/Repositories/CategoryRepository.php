<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function all() {
        return Category::query()
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('lft')
            ->get();
    }

    public function forMainPage() {
        return Category::query()
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->limit(5)
            ->orderBy('lft')
            ->get();
    }
}
