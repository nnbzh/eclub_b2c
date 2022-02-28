<?php

namespace App\Models;

use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Imageable, CrudTrait;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'lft',
        'rgt',
        'depth',
        'parent_id'
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
