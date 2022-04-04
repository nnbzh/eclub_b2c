<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{
    protected $fillable = [
        'order_id',
        'cancel_message_id',
        'comment'
    ];
}
