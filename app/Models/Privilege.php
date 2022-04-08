<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Privilege
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Privilege newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Privilege newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Privilege query()
 * @method static \Illuminate\Database\Eloquent\Builder|Privilege whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privilege whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privilege whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privilege whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privilege whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privilege whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Privilege extends Model
{
    const FREE_DELIVERY = 'free_delivery';

    protected $fillable = [
        'name',
        'key',
        'is_active'
    ];
}
