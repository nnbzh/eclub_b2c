<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Block
 *
 * @property int $id
 * @property array|null $title
 * @property string $component_name
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Block newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Block newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Block query()
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereComponentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Block extends Model
{
    use CrudTrait, HasTranslations;

    public array $translatable = ['title'];

    protected $fillable = [
        'title',
        'component_name',
        'parent_id',
        'lft',
        'rgt',
        'depth'
    ];
}
