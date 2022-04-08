<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SentPushNotification
 *
 * @property int $id
 * @property string|null $token_id
 * @property int $user_id
 * @property string $status
 * @property string $pushable_type
 * @property int $pushable_id
 * @property int|null $notification_type_id
 * @property string|null $fields_json
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\NotificationType|null $notificationType
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification whereFieldsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification whereNotificationTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification wherePushableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification wherePushableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification whereTokenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SentPushNotification whereUserId($value)
 * @mixin \Eloquent
 */
class SentPushNotification extends Model
{
    protected $fillable = [
        'token_id',
        'user_id',
        'status',
        'pushable_id',
        'pushable_type',
        'fields_json',
        'notification_type_id'
    ];

    protected $casts = [
        'fields_json' => 'array'
    ];

    public function pushable() {
        return $this->morphTo();
    }

    public function notificationType() {
        return $this->belongsTo(NotificationType::class);
    }
}
