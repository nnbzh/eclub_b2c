<?php

namespace App\Models\Tarantool;

class Stock extends TarantoolModel
{
    protected $fillable = [
        'city_id',
        'sku',
        'quantity',
        'changed_at'
    ];
}
