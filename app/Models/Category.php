<?php

namespace App\Models;

use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CrudTrait, HasTranslations, Imageable;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'is_active',
        'lft',
        'rgt',
        'depth',
        'parent_id'
    ];

    public function subcategories() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
