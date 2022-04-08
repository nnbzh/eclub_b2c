<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Stock
 *
 * @property int $id
 * @property int $sku
 * @property int|null $city_id
 * @property int $quantity
 * @property int $changed_at
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereChangedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereSku($value)
 * @mixin \Eloquent
 */
class Stock extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'city_id',
        'sku',
        'quantity',
        'changed_at'
    ];
}
