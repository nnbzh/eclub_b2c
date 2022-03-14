<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use CrudTrait, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'is_active',
    ];
}
