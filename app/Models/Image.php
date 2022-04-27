<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string|null $imageable_type
 * @property int|null $imageable_id
 * @property array|null $src
 * @property array|null $src_second
 * @property string|null $lang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $full_img_src
 * @property-read array $translations
 * @property-read Model|\Eloquent $imageable
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    use HasTranslations, CrudTrait;

    public $translatable = ['src'];

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'lang',
        'src',
        'src_second',
        'depth',
        'parent_id',
        'lft',
        'rgt',
    ];

    public function imageable() {
        return $this->morphTo();
    }

    public function getFirstImgSrcAttribute() {
        if (is_null($this->src)) {
            return null;
        }

        if (filter_var($this->src, FILTER_VALIDATE_URL)) {
            return $this->src;
        }

        return config('filesystems.disks.s3.endpoint')."/europharm2$this->src";
    }

    public function getSecondImgSrcAttribute() {
        if (is_null($this->src_second)) {
            return null;
        }

        if (filter_var($this->src_second, FILTER_VALIDATE_URL)) {
            return $this->src_second;
        }

        return config('filesystems.disks.s3.endpoint')."/europharm2$this->src_second";
    }
}
