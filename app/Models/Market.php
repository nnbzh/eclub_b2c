<?php

namespace App\Models;

use App\Traits\HasFilters;
use App\Traits\ImageableWithTwo;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Market
 *
 * @property int $id
 * @property string $name
 * @property int $number
 * @property int $is_active
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\City[] $cities
 * @property-read int|null $cities_count
 * @property-read mixed $full_img_src
 * @property-read mixed $img_src
 * @property-read array $translations
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Market applyFilters(\App\Filters\ModelFilter $modelFilter, array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Market newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Market newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Market query()
 * @method static \Illuminate\Database\Eloquent\Builder|Market whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Market whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Market whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Market whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Market whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Market whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Market whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Market whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Market whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Market whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Market extends Model
{
    use ImageableWithTwo, CrudTrait, HasFilters, HasTranslations;

    public $translatable = ['img_src'];

    protected $fillable = [
        'name',
        'number',
        'is_active',
        'lft',
        'rgt',
        'depth',
        'parent_id'
    ];

    public function cities() {
        return $this->belongsToMany(City::class, 'market_city');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'market_category');
    }

//    public function categories() {
//        return $this->hasManyDeep(Category::class, ['product_market', Product::class], [
//            'market_number',
//            'category_id',
//            'id'
//        ], [
//            'number',
//            'sku',
//            'sku'
//        ]);
//    }
}
