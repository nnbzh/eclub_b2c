<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CancelMessage
 *
 * @property int $id
 * @property array $message
 * @property int $is_active
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CancelMessage extends Model
{
    use HasTranslations;

    public $translatable = ['message'];

    protected $fillable = [
        'message',
        'is_active',
        'lft',
        'parent_id',
        'rgt',
        'depth'
    ];
}
