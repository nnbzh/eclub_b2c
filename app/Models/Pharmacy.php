<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pharmacy
 *
 * @property int $id
 * @property int|null $number
 * @property int|null $city_id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $working_time
 * @property string|null $lat
 * @property string|null $lng
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City|null $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FastDeliveryZone[] $fastDeliveryZones
 * @property-read int|null $fast_delivery_zones_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereWorkingTime($value)
 * @mixin \Eloquent
 */
class Pharmacy extends Model
{
    use CrudTrait;

    protected $fillable = [
        'address',
        'city_id',
        'number',
        'name',
        'is_active',
        'lat',
        'lng',
        'working_time'
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function fastDeliveryZones() {
        return $this->hasMany(FastDeliveryZone::class);
    }
}
