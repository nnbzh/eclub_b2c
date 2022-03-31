<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
