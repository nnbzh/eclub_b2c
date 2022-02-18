<?php

namespace App\Models;

use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Imageable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'is_active',
        'lft',
        'rgt',
        'depth',
        'parent_id'
    ];
}
