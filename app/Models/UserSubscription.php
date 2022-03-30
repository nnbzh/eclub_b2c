<?php

namespace App\Models;

use App\Helpers\SubscriptionSponsor;
use App\Models\Interfaces\IBillable;
use App\Traits\Billable;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
