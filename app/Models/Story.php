<?php

namespace App\Models;

use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Story
 *
 * @property int $id
 * @property string|null $name
 * @property int $is_active
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $full_img_src
 * @property-read mixed $img_src
 * @property-read array $translations
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Story newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Story newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Story query()
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Story whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Story extends Model
{
    use CrudTrait, Imageable, HasTranslations;

    public $translatable = ['img_src'];

    protected $fillable = [
        'name',
        'is_active',
        'lft',
        'parent_id',
        'rgt',
        'depth'
    ];
}
