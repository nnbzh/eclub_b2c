<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CrudTrait, HasRoles;

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

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function findForPassport($value) {
        $value = \StringFormatter::onlyDigits($value);

        return User::query()->where('phone', $value)->first();
    }

    public function getAddressAttribute() {
        return $this->addresses()->where('is_active', true)->first();
    }

    public function addresses() {
        return $this->hasMany(UserAddress::class);
    }

    public function deviceTokens() {
        return $this->hasMany(DeviceToken::class);
    }

    public function privileges() {
        return $this->belongsToMany(Privilege::class, 'user_privilege');
    }

    public function hasPrivilege($key) {
        return $this->privileges()->where('is_active', true)->where('key', $key)->exists();
    }
}
