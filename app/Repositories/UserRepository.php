<?php

namespace App\Repositories;


use App\Filters\OrderFilter;
use App\Helpers\NotificationStatus;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;

class UserRepository
{
    public function findByPhone($phone) {
        return User::wherePhone($phone)->first();
    }

    public function isPhoneUsed($phone) {
        $user = User::query()->where('phone', $phone)->first();

        return $user && $user->name && $user->email && $user->password;
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

    public function getNotifications(User $user, $slug)
    {
        return $user->sentPushNotifications()
            ->whereHas('notificationType', fn($query) => $query->where('slug', $slug))
            ->orderByRaw("CASE WHEN sent_push_notifications.status='".NotificationStatus::UNREAD."'THEN 1 ELSE 2 END ASC")
            ->orderBy("created_at", "desc")
            ->simplePaginate(15);
    }

    public function getOrders(User $user, $filters = [], $relations = [])
    {
        $query = $user->orders();

        if (! empty($filters)) {
            $query->applyFilters(new OrderFilter, $filters);
        }

        return $query
            ->with($relations)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
