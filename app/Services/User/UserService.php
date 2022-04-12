<?php

namespace App\Services\User;

use App\Helpers\SubscriptionSponsor;
use App\Models\Product;
use App\Models\User;
use App\Repositories\BankcardRepository;
use App\Repositories\ImageRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\Services\Payment\Facades\Payment;
use Illuminate\Http\UploadedFile;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private SubscriptionRepository $subscriptionRepository,
        private BankcardRepository $bankcardRepository,
        private ImageRepository $imageRepository,
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

    public function uploadImage(User $user, UploadedFile|null $file)
    {
        $lastImage = $user->image()->first();
        if ($lastImage) {
            $this->imageRepository->remove('s3', $lastImage);
        }
        $src    = $this->imageRepository->storeInDisk('s3', $user, $file);
        $image  = $this->imageRepository->createForImageable($user, $src);

        return $image;
    }

    public function like(User $user, Product $product)
    {
        if ($user->products()->where('id', $product->id)->doesntExist()) {
            $user->products()->attach($product);
        } else {
            $user->products()->detach($product);
        }
    }

    public function getUserProducts($user)
    {
        $products   = $user->products()->get();
        $cityId     = $user->address?->city_id ?? 1;

        return \ProductPreprocessor::process($products, $cityId);
    }

    public function getUserNotifications(User $user, $slug)
    {
        return $this->userRepository->getNotifications($user, $slug);
    }

    public function getUserOrders(User $user)
    {
        return $this->userRepository->getOrders($user);
    }
}
