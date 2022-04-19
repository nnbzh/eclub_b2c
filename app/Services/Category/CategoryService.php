<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function list($type = '') {
        return $this->categoryRepository->all();
    }
}
