<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeliveryMethod
 *
 * @property int $id
 * @property array|null $name
 * @property int $is_active
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\City[] $cities
 * @property-read int|null $cities_count
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Market[] $markets
 * @property-read int|null $markets_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryMethod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeliveryMethod extends Model
{
    use CrudTrait, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'is_active',
        'lft',
        'rgt',
        'depth',
        'parent_id'
    ];

    public function cities() {
        return $this
            ->belongsToMany(City::class, 'delivery_method_city')
            ->withPivot(['max_price', 'min_price', 'cost', 'is_active']);
    }

    public function markets() {
        return $this->belongsToMany(Market::class, 'delivery_method_market');
    }
}
