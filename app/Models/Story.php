<?php

namespace App\Models;

use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use CrudTrait, Imageable, HasTranslations;

    public $translatable = ['img_src'];

    protected $fillable = [
        'name',
        'is_active',
        'lft',
        'parent_id',
        'rgt',
        'depth'
    ];
}
