<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Courier
 *
 * @property int $id
 * @property int $order_id
 * @property string|null $phone
 * @property string|null $courier_id
 * @property string|null $type
 * @property string|null $distance
 * @property string|null $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Courier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereCourierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Courier extends Model
{
    protected $fillable  = [
        'order_id',
        'phone',
        'courier_id',
        'type',
        'distance',
        'duration'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
