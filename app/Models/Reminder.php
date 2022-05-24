<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slots',
        'days'
    ];

    protected $casts = [
        'slots' => 'array',
        'days'  => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
