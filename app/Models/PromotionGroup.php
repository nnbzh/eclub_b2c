<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PromotionGroup
 *
 * @property int $id
 * @property array $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroup whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromotionGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PromotionGroup extends Model
{
    use CrudTrait, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'slug'
    ];

    public function products() {
        return $this->belongsToMany(Product::class, 'promotion_group_product')->using(PromotionGroupProduct::class);
    }

    public function categories() {
        return $this->belongsToMany(Product::class, 'promotion_group_category')->using(PromotionGroupProduct::class);
    }
}
