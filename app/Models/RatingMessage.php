<?php

namespace App\Models;

use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RatingMessage
 *
 * @property int $id
 * @property array $message
 * @property int $rating_id
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
 * @property-read \App\Models\Rating $rating
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage whereRatingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RatingMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RatingMessage extends Model
{
    use CrudTrait, HasTranslations, Imageable;

    public array $translatable = ['message'];

    protected $fillable = [
        'message',
        'rating_id',
        'parent_id',
        'lft',
        'rgt',
        'depth'
    ];

    public function rating() {
        return $this->belongsTo(Rating::class);
    }
}
