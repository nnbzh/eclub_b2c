<?php

namespace App\Models;

use App\Traits\HasFilters;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserAddress
 *
 * @property int $id
 * @property int $user_id
 * @property string $address
 * @property string|null $apartment
 * @property int|null $floor
 * @property string|null $entrance
 * @property string|null $lat
 * @property string|null $lng
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_active
 * @property string|null $name
 * @property-read \App\Models\City $city
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress applyFilters(\App\Filters\ModelFilter $modelFilter, array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereApartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereEntrance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUserId($value)
 * @mixin \Eloquent
 */
class UserAddress extends Model
{
    use HasFilters;

    protected $fillable = [
        'address',
        'entrance',
        'apartment',
        'floor',
        'user_id',
        'lng',
        'lat',
        'city_id',
        'is_active',
        'name',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }
}
