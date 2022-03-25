<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    const FREE_DELIVERY = 'free_delivery';

    protected $fillable = [
        'name',
        'key',
        'is_active'
    ];
}
