<?php

namespace App\Models\Tarantool;

class Price extends TarantoolModel
{
    protected $fillable = [
        'sku',
        'price',
        'sub_price',
        'city_id',
        'changed_at'
    ];
}
