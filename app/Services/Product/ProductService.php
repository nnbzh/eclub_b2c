<?php

namespace App\Services\Product;

use App\Facades\Helpers\ProductPreprocessor;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(private ProductRepository $productRepository) {}

    public function list(array $filters = []) {
        $products   = $this->productRepository->list($filters);
        $processed  = ProductPreprocessor::process($products->getCollection(), 1);
        $products   = $products->setCollection($processed);

        return $products;
    }
}
