<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'address',
        'block',
        'apartment',
        'floor',
        'user_id',
        'lng',
        'lat'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
