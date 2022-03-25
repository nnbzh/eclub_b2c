<?php

namespace App\Models\Tarantool;

use Illuminate\Database\Eloquent\Model;

abstract class TarantoolModel extends Model
{
    protected $connection = 'tarantool';

    public $timestamps = false;
}
