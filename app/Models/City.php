<?php

namespace App\Models;

use App\Traits\HasFilters;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use CrudTrait, HasFilters;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'lat',
        'lng',
        'code',
        'number',
        'is_active',
        'has_delivery',
        'has_fast_delivery',
    ];

    public function deliveryZones() {
        return $this->hasMany(DeliveryZone::class);
    }

    public function pharmacies() {
        return $this->hasMany(Pharmacy::class);
    }
}
