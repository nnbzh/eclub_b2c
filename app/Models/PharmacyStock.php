<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PharmacyStock
 *
 * @property int $id
 * @property int $sku
 * @property int|null $pharmacy_id
 * @property int $quantity
 * @property int $changed_at
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyStock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyStock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyStock query()
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyStock whereChangedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyStock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyStock wherePharmacyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyStock whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyStock whereSku($value)
 * @mixin \Eloquent
 */
class PharmacyStock extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'pharmacy_id',
        'sku',
        'quantity',
        'changed_at'
    ];
}
