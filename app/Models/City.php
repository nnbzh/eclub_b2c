<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'lat',
        'lng',
        'code',
        'number',
        'is_active',
        'has_delivery',
    ];
}
