<?php

namespace App\Models;

use App\Traits\HasFilters;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFilters;

    protected $fillable = [
        'address',
        'entrance',
        'apartment',
        'floor',
        'user_id',
        'lng',
        'lat',
        'city_id',
        'is_active',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }
}
