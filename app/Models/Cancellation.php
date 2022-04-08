<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cancellation
 *
 * @property int $id
 * @property int|null $order_id
 * @property int $cancel_message_id
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Cancellation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cancellation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cancellation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cancellation whereCancelMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cancellation whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cancellation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cancellation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cancellation whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cancellation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cancellation extends Model
{
    protected $fillable = [
        'order_id',
        'cancel_message_id',
        'comment'
    ];
}
