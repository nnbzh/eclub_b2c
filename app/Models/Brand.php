<?php

namespace App\Models;

use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Brand
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property int $is_active
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property-read mixed $full_img_src
 * @property-read mixed $img_src
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereSlug($value)
 * @mixin \Eloquent
 */
class Brand extends Model
{
    use Imageable, CrudTrait;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'lft',
        'rgt',
        'depth',
        'parent_id'
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
