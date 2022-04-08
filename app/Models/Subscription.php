<?php

namespace App\Models;

use App\Helpers\TransactionStatus;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property array $name
 * @property string|null $description
 * @property string $slug
 * @property int $price
 * @property int|null $special_price
 * @property int $days_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereDaysActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereSpecialPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
