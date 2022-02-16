<?php

namespace App\Models;

use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use Imageable, HasTranslations, CrudTrait;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'component',
        'parent_id',
        'lft',
        'rgt',
        'depth',
    ];
}
