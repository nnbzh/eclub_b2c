<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductPromotionGroup extends Pivot
{
    use CrudTrait;

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'promotion_group_id',
        'lft',
        'rgt',
        'parent_id',
        'depth'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function promotionGroup() {
        return $this->belongsTo(PromotionGroup::class);
    }
}
