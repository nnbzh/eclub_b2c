<?php

namespace App\Models;

use App\Helpers\NotificationStatus;
use App\Helpers\TransactionStatus;
use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $phone
 * @property string|null $name
 * @property string|null $gender
 * @property string|null $birthdate
 * @property string|null $email
 * @property string $lang
 * @property int $send_mail
 * @property int $send_notification
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $phone_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserAddress[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeviceToken[] $deviceTokens
 * @property-read int|null $device_tokens_count
 * @property-read mixed $address
 * @property-read mixed $full_img_src
 * @property-read mixed $img_src
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Privilege[] $privileges
 * @property-read int|null $privileges_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserSubscription[] $userSubscriptions
 * @property-read int|null $user_subscriptions_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSendMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSendNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SentPushNotification[] $sentPushNotifications
 * @property-read int|null $sent_push_notifications_count
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CrudTrait, HasRoles, Imageable, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'phone_verified_at',
        'email_verified_at',
        'gender',
        'birthdate',
        'lang',
        'send_mail',
        'send_notification',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'date',
    ];

    //RELATIONS
    public function addresses() {
        return $this->hasMany(UserAddress::class);
    }

    public function deviceTokens() {
        return $this->hasMany(DeviceToken::class);
    }

    public function privileges() {
        return $this->belongsToMany(Privilege::class, 'user_privilege');
    }

    public function subscriptions() {
        return $this->belongsToMany(Subscription::class, 'user_subscription')
            ->withPivot(
                'id',
                'started_at',
                'expires_at',
                'price'
            )
            ->using(UserSubscription::class)
            ->as('userSubscription');
    }

    public function userSubscriptions() {
        return $this->hasMany(UserSubscription::class);
    }

    public function lastSubscription() : Subscription|null {
        return $this->subscriptions()
            ->wherePivot('expires_at', '>=', now()->toDateString())
            ->orderByPivot('expires_at', 'desc')
            ->first();
    }

    public function lastActiveSubscription() : Subscription|null {
        $sub = $this->subscriptions()
            ->wherePivot('expires_at', '>=', now()->toDateString())
            ->orderByPivot('expires_at', 'desc')
            ->first();

        if (is_null($sub) || ! $sub->isActive()) {
            return null;
        }

        return $sub;
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'user_product');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function sentPushNotifications() {
        return $this->hasMany(SentPushNotification::class);
    }

    public function unreadSentPushNotifications() {
        return $this->sentPushNotifications()->where('status', NotificationStatus::UNREAD);
    }

    //MUTATORS
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = \Hash::make($value);
    }

    //ACCESSORS
    public function getAddressAttribute() {
        return $this->addresses()->where('is_active', true)->first();
    }

    public function getUnreadNotificationsCountAttribute() {
        return $this->unreadSentPushNotifications()->count();
    }

    //FUNCTIONS
    public function findForPassport($value) {
        $value = \StringFormatter::onlyDigits($value);

        return User::query()->where('phone', $value)->first();
    }

    public function hasPrivilege($key) {
        return $this->privileges()->where('is_active', true)->where('key', $key)->exists();
    }

    public function isPushEnabled() {
        return $this->deviceTokens()->exists() && $this->send_notification;
    }
}
