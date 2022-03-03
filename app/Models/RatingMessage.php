<?php

namespace App\Models;

use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class RatingMessage extends Model
{
    use CrudTrait, HasTranslations, Imageable;

    public array $translatable = ['message'];

    protected $fillable = [
        'message',
        'rating_id',
        'parent_id',
        'lft',
        'rgt',
        'depth'
    ];

    public function rating() {
        return $this->belongsTo(Rating::class);
    }
}
