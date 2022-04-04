<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class CancelMessage extends Model
{
    use HasTranslations;

    public $translatable = ['message'];

    protected $fillable = [
        'message',
        'is_active',
        'lft',
        'parent_id',
        'rgt',
        'depth'
    ];
}
