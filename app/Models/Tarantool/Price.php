<?php

namespace App\Models\Tarantool;

class Price extends TarantoolModel
{
    protected $fillable = [
        'sku',
        'price',
        'sub_price',
        'market_number',
        'city_id',
        'changed_at'
    ];
}
