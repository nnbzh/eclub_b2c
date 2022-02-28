<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyStock extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'pharmacy_id',
        'sku',
        'quantity',
        'changed_at'
    ];
}
