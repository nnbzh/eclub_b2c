<?php

namespace App\Models;

use App\Traits\HasFilters;
use App\Traits\Imageable;
use App\Traits\Reviewable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait, Imageable, HasTranslations, HasFilters, Reviewable;

    public $translatable = ['name'];

    protected $fillable = [
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
    ];

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

    public function prices() {
        return $this->hasMany(Priceable::class, 'sku', 'sku');
    }

    public function stocks() {
        return $this->hasMany(Stockable::class, 'sku', 'sku');
    }
}
