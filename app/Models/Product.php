<?php

namespace App\Models;

use App\Traits\HasFilters;
use App\Traits\Imageable;
use App\Traits\Reviewable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int|null $sku
 * @property string|null $barcode
 * @property array|null $name
 * @property int|null $category_id
 * @property int|null $sub_limit
 * @property int $is_active
 * @property int $is_special
 * @property int $by_recipe
 * @property int|null $brand_id
 * @property string|null $country
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $unit_type
 * @property-read \App\Models\Brand|null $brand
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\ProductDescription|null $description
 * @property-read mixed $average_rating
 * @property-read mixed $full_img_src
 * @property-read mixed $img_src
 * @property-read array $translations
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Market[] $markets
 * @property-read int|null $markets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Rating[] $ratings
 * @property-read int|null $ratings_count
 * @property-read \App\Models\Review|null $review
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product applyFilters(\App\Filters\ModelFilter $modelFilter, array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereByRecipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsSpecial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use CrudTrait, Imageable, HasTranslations, HasFilters, Reviewable, Searchable;

    const PER_PAGE = 30;

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'barcode',
        'sku',
        'name',
        'category_id',
        'sub_limit',
        'is_active',
        'is_special',
        'by_recipe',
        'brand_id',
        'country',
        'unit_code',
        'unit_type',
    ];

    public function searchableAs()
    {
        return 'mobile-app_PRODUCTS';
    }

    public function toSearchableArray()
    {
        return [
            'name'      => $this->name,
            'barcode'   => $this->barcode
        ];
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function markets() {
        return $this->belongsToMany(Market::class, 'product_market',
            'sku',
            'market_number',
        'sku',
        'number');
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function description() {
        return $this->hasOne(ProductDescription::class);
    }

    public function ratings() {
        return $this->hasManyThrough(
            Rating::class,
            Review::class,
            'reviewable_id',
            'id',
            'id',
            'rating_id'
        )->where('reviewable_type', $this->getMorphClass());
    }

    public function getAverageRatingAttribute() {
        return round($this->ratings()->avg('rating'), 2);
    }

    public function getProductDescriptionAttribute() {
        return $this->description()->first()?->description;
    }
}
