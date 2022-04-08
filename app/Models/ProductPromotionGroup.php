<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ProductPromotionGroup
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
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPromotionGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPromotionGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPromotionGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPromotionGroup whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPromotionGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPromotionGroup whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPromotionGroup whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPromotionGroup whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPromotionGroup wherePromotionGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPromotionGroup whereRgt($value)
 * @mixin \Eloquent
 */
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

    public function getNameAttribute() {
        return $this->product?->name;
    }
}
