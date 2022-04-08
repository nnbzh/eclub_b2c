<?php

namespace App\Models;

use App\Traits\HasFilters;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $lat
 * @property string|null $lng
 * @property string|null $code
 * @property string|null $number
 * @property int $is_active
 * @property int $has_delivery
 * @property int $has_fast_delivery
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeliveryZone[] $deliveryZones
 * @property-read int|null $delivery_zones_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pharmacy[] $pharmacies
 * @property-read int|null $pharmacies_count
 * @method static \Illuminate\Database\Eloquent\Builder|City applyFilters(\App\Filters\ModelFilter $modelFilter, array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereHasDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereHasFastDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSlug($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    use CrudTrait, HasFilters;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'lat',
        'lng',
        'code',
        'number',
        'is_active',
        'has_delivery',
        'has_fast_delivery',
    ];

    public function deliveryZones() {
        return $this->hasMany(DeliveryZone::class);
    }

    public function pharmacies() {
        return $this->hasMany(Pharmacy::class);
    }
}
