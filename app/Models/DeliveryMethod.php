<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use CrudTrait, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'is_active',
        'lft',
        'rgt',
        'depth',
        'parent_id'
    ];

    public function cities() {
        return $this
            ->belongsToMany(City::class, 'delivery_method_city')
            ->withPivot(['max_price', 'min_price', 'cost', 'is_active']);
    }
}
