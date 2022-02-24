<?php

namespace App\Models;

use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait, Imageable, HasTranslations;

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
        'supplier',
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
}
