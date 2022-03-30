<?php

namespace App\Repositories;


use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;

class UserRepository
{
    public function isPhoneUsed($phone) {
        return User::query()->where('phone', $phone)->exists();
    }

    public function update(User $user, array $data)
    {
        $user->fill($data);
        $user->saveOrFail();

        return $user;
    }

    public function createSubForUser(User $user, Subscription $subscription, $newPrice = null) : UserSubscription {
        return $user->userSubscriptions()->create([
            'subscription_id' => $subscription->id,
            'started_at'        => now(),
            'expires_at'        => $subscription->isYearly() ? now()->addYear() : now()->addMonth(),
            'price'             => is_null($newPrice) ? $subscription->price : $newPrice
        ])
            ->load('subscription');
    }
}
