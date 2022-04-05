<?php

namespace App\Repositories;

use App\Models\PromotionGroup;

class PromotionGroupRepository
{
    public function findBy($column, $value): PromotionGroup {
        return PromotionGroup::query()->where($column, $value)->firstOrFail();
    }
}
