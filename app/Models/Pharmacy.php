<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

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
