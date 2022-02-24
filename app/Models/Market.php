<?php

namespace App\Models;

use App\Traits\HasFilters;
use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use Imageable, CrudTrait, HasFilters, HasTranslations;

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
