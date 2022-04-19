<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function list($type = '') {
        return $type == 'all' ? $this->categoryRepository->all() : $this->categoryRepository->forMainPage();
    }
}
