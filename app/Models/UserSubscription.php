<?php

namespace App\Models;

use App\Helpers\SubscriptionSponsor;
use App\Models\Interfaces\IBillable;
use App\Traits\Billable;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\UserSubscription
 *
 * @property int $id
 * @property int $user_id
 * @property int $subscription_id
 * @property string|null $sponsor
 * @property \Illuminate\Support\Carbon $started_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property int $price
 * @property-read \App\Models\Subscription $subscription
 * @property-read \App\Models\Transaction|null $transaction
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereSponsor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereUserId($value)
 * @mixin \Eloquent
 */
class UserSubscription extends Pivot implements IBillable
{
    use Billable;

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'price',
        'started_at',
        'expires_at',
        'sponsor'
    ];

    protected $dates = [
        'started_at',
        'expires_at'
    ];

    public function subscription() {
        return $this->belongsTo(Subscription::class);
    }

    public function isFree() {
        return in_array($this->sponsor, SubscriptionSponsor::getFreeSubscriptionSponsors());
    }
}
