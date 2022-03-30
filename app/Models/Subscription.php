<?php

namespace App\Models;

use App\Helpers\TransactionStatus;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasTranslations, CrudTrait;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'slug',
        'price',
        'special_price',
        'days_active',
        'description',
    ];

    public function isYearly() {
        return $this->slug === 'yearly';
    }

    public function isActive() {
        //userTransaction is pivot table, see User's subscriptions() relation
        return $this->userSubscription->isPaid() || $this->userSubscription->isFree();
    }

    public function isPending() {
        //userTransaction is pivot table, see User's subscriptions() relation
        return $this->userSubscription->isPending();
    }

    //SCOPES
}
