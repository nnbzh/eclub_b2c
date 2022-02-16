<?php

namespace App\Models;

use App\Traits\HasFilters;
use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use Imageable, CrudTrait, HasFilters, Imageable;

    protected $fillable = [
        'name',
        'number',
        'is_active'
    ];

    public function cities() {
        return $this->belongsToMany(City::class, 'market_city');
    }
}
