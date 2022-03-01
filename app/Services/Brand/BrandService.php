<?php

namespace App\Services\Brand;

use App\Repositories\BrandRepository;

class BrandService
{
    public function __construct(private BrandRepository $brandRepository)
    {
    }

    public function list($type = '') {
        return $type == 'all' ? $this->brandRepository->all() : $this->brandRepository->forMainPage();
    }
}
