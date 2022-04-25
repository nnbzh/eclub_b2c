<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\PromotionGroupProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $promotion_group_id
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property-read mixed $name
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\PromotionGroup $promotionGroup
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroupProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroupProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroupProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroupProduct whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroupProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroupProduct whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroupProduct whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroupProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroupProduct wherePromotionGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroupProduct whereRgt($value)
 * @mixin \Eloquent
 */
class PromotionGroupCategory extends Pivot
{
    use CrudTrait;

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'promotion_group_id',
        'lft',
        'rgt',
        'parent_id',
        'depth'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function promotionGroup() {
        return $this->belongsTo(PromotionGroup::class);
    }

    public function getNameAttribute() {
        return $this->product?->name;
    }
}
