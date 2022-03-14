<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasTranslations, CrudTrait;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'slug',
        'price'
    ];
}
