<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(private ProductRepository $productRepository) {}

    public function list(array $filters = []) {
        return $this->productRepository->list($filters);
    }
}
