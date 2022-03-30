<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bankcard extends Model
{
    protected $fillable = [
        'number',
        'user_id',
        'month',
        'year',
        'bank',
        'country',
        'status',
        'card_id',
        'recurring_profile_id',
        'provider',
        'has_3ds',
    ];
}
