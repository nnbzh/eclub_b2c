<?php

namespace App\Services\Product;

use App\Facades\Helpers\ProductPreprocessor;
use App\Repositories\PromotionGroupRepository;

class PromotionGroupService
{
    public function __construct(private PromotionGroupRepository $promotionGroupRepository)
    {
    }

    public function getBySlug($slug, $cityId)
    {
        $group = $this->promotionGroupRepository->findBy('slug', $slug)
            ->load(['categories.products', 'products']);

        $products = ProductPreprocessor::process($group->products, $cityId);
        $group->setRelation('products', $products->values());

        foreach ($group->categories as $category) {
            $products = ProductPreprocessor::process($category->products, $cityId);
            $category->setRelation('products', $products->values());
        }
        $group->setRelation('categories', $products->values());

        return $group;
    }
}
