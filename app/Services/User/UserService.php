<?php

namespace App\Services\User;

use App\Helpers\SubscriptionSponsor;
use App\Models\User;
use App\Repositories\BankcardRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\Services\Payment\Facades\Payment;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private SubscriptionRepository $subscriptionRepository,
        private BankcardRepository $bankcardRepository
    )
    {
    }

    public function isPhoneUsed($phone) {
        $phone = \StringFormatter::onlyDigits($phone);

        return [
            'status' => $this->userRepository->isPhoneUsed($phone)
        ];
    }

    public function update(User $user, array $data) {
        return $this->userRepository->update($user, $data);
    }

    public function subscribe(User $user, array $data, $isFree = false, int $newPrice = null, $sponsor = SubscriptionSponsor::SELF) {
        $subscription       = $this->subscriptionRepository->getById($data['subscription_id']);
        $lastSub            = $user->lastSubscription();
        $userSubscription   = $lastSub?->userSubscription;
        if ($lastSub) {
            if ($lastSub->isActive()) {
                return [
                    'status'    => false,
                    'error'     => 'subscription.already_exists'
                ];
            }
        } else {
            $userSubscription = $this->userRepository->createSubForUser($user, $subscription);
            $lastSub        = $userSubscription->subscription;
        }

        if (! $isFree) {
            $amount   = is_null($newPrice) ? $lastSub->price : $newPrice;
            $card     = $this->bankcardRepository->getById($data['bankcard_id']);
            $response = Payment::pay($amount, $userSubscription, $card->provider, $data);
            $userSubscription->update([
                'price'     => $amount,
                'sponsor'   => $sponsor
            ]);
        } else {
            $userSubscription->update([
                'price'     => 0,
                'sponsor'   => $sponsor
            ]);
        }
        $userSubscription->saveOrFail();

        return $userSubscription;
    }
}
