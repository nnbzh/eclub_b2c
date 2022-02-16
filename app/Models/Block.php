<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use CrudTrait, HasTranslations;

    public array $translatable = ['title'];

    protected $fillable = [
        'title',
        'component_name',
        'parent_id',
        'lft',
        'rgt',
        'depth'
    ];
}
