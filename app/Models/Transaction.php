<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_id',
        'bankcard_id',
        'transactionable_id',
        'transactionable_type',
        'fields_json'
    ];

    protected $casts = [
        'fields_json' => 'array'
    ];
}
