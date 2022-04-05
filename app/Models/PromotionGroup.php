<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class PromotionGroup extends Model
{
    use CrudTrait, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'slug'
    ];

    public function products() {
        return $this->belongsToMany(Product::class, 'product_promotion_group')->using(ProductPromotionGroup::class);
    }
}
