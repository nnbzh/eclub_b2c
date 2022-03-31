<?php

namespace App\Models;

use App\Traits\HasFilters;
use Illuminate\Database\Eloquent\Model;

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
