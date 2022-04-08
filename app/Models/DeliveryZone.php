<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeliveryZone
 *
 * @property int $id
 * @property int $city_id
 * @property array|null $coordinates
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereCoordinates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeliveryZone extends Model
{
    protected $fillable = [
        'city_id',
        'coordinates'
    ];

    protected $casts = [
        'coordinates' => 'array'
    ];
}
