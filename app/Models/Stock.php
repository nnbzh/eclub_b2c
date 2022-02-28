<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'city_id',
        'sku',
        'quantity',
        'changed_at'
    ];
}
