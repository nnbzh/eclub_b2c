<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductDescription
 *
 * @property int $id
 * @property int|null $product_id
 * @property array|null $description
 * @property string|null $video_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDescription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDescription whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDescription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDescription whereVideoUrl($value)
 * @mixin \Eloquent
 */
class ProductDescription extends Model
{
    use HasTranslations, CrudTrait;

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
