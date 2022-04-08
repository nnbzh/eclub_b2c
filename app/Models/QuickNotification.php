<?php

namespace App\Models;

use App\Traits\Imageable;
use App\Traits\Pushable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QuickNotification
 *
 * @property int $id
 * @property string|null $description
 * @property array $subject
 * @property array $text
 * @property int $send_sms
 * @property int $to_all
 * @property array|null $cities
 * @property int|null $notification_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $full_img_src
 * @property-read mixed $img_src
 * @property-read array $translations
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\NotificationType|null $notificationType
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification whereCities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification whereNotificationTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification whereSendSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification whereToAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickNotification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuickNotification extends Model
{
    use CrudTrait, HasTranslations, Imageable, Pushable;

    public $translatable = ['subject', 'text'];

    protected $fillable = [
        'text',
        'subject',
        'send_sms',
        'to_all',
        'cities',
        'notification_type_id'
    ];

    protected $casts = [
        'cities' => 'array'
    ];

    public function notificationType() {
        return $this->belongsTo(NotificationType::class);
    }
}
