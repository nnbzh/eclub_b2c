<?php

namespace App\Models;

use App\Traits\HasFilters;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FastDeliveryZone
 *
 * @property int $id
 * @property int $pharmacy_id
 * @property array|null $coordinates
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City|null $city
 * @property-read \App\Models\Pharmacy $pharmacy
 * @method static \Illuminate\Database\Eloquent\Builder|FastDeliveryZone applyFilters(\App\Filters\ModelFilter $modelFilter, array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|FastDeliveryZone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FastDeliveryZone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FastDeliveryZone query()
 * @method static \Illuminate\Database\Eloquent\Builder|FastDeliveryZone whereCoordinates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FastDeliveryZone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FastDeliveryZone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FastDeliveryZone wherePharmacyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FastDeliveryZone whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FastDeliveryZone extends Model
{
    use HasFilters;

    protected $fillable = [
        'pharmacy_id',
        'coordinates'
    ];

    protected $casts = [
        'coordinates' => 'array'
    ];

    public function city() {
        return $this->hasOneThrough(
            City::class,
            Pharmacy::class,
            'id',
            'id',
            'pharmacy_id',
            'city_id'
        );
    }

    public function pharmacy() {
        return $this->belongsTo(Pharmacy::class);
    }
}
