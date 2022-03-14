<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    use HasTranslations;

    public $translatable = ['description'];

    protected $fillable = [
        'id',
        'product_id',
        'description',
        'video_url'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
