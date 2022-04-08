<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Price
 *
 * @property int $id
 * @property int $sku
 * @property int|null $city_id
 * @property int $market_number
 * @property int $price
 * @property int $sub_price
 * @property int $changed_at
 * @method static \Illuminate\Database\Eloquent\Builder|Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price query()
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereChangedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereMarketNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereSubPrice($value)
 * @mixin \Eloquent
 */
class Price extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'sku',
        'price',
        'sub_price',
        'market_number',
        'changed_at',
        'sub_price',
        'city_id'
    ];
}
