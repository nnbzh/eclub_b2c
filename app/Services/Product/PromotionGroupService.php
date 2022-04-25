<?php

namespace App\Services\Product;

use App\Facades\Helpers\ProductPreprocessor;
use App\Repositories\PromotionGroupRepository;

class PromotionGroupService
{
    public function __construct(private PromotionGroupRepository $promotionGroupRepository)
    {
    }

    public function getBySlug($slug, $cityId) {
        $group      = $this->promotionGroupRepository->findBy('slug', $slug)->load(['categories', 'products']);
        $products   = ProductPreprocessor::process($group->products()->get(), $cityId);

        $group->setRelation('products', $products->values());

        return $group;
    }
}
