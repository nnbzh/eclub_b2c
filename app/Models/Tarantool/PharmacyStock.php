<?php

namespace App\Models\Tarantool;

class PharmacyStock extends TarantoolModel
{
    protected $fillable = [
        'pharmacy_id',
        'sku',
        'quantity',
        'changed_at'
    ];
}
