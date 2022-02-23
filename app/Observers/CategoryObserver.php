<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function deleted(Category $category) {
        if ($category->subcategories()->exists()) {
            $category->subcategories()->update(['parent_id' => $category->parent_id ?? null]);
        }
    }
}
