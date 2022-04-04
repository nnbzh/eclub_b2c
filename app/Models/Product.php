<?php

namespace App\Models;

use App\Traits\HasFilters;
use App\Traits\Imageable;
use App\Traits\Reviewable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use CrudTrait, Imageable, HasTranslations, HasFilters, Reviewable, Searchable;

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
}
