<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'sku',
        'price',
        'sub_price',
        'market_number',
        'changed_at',
        'sub_price',
        'city_id'
    ];
}
