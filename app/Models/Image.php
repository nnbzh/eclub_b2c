<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasTranslations;

    public $translatable = ['src'];

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'lang',
        'src'
    ];

    public function imageable() {
        return $this->morphTo();
    }
}
