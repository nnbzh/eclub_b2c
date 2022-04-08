<?php

namespace App\Services\DeviceToken;

use App\Repositories\DeviceTokenRepository;

class DeviceTokenService
{
    public function __construct(private DeviceTokenRepository $deviceTokenRepository)
    {
    }

    public function create($token, $user) {
        return $this->deviceTokenRepository->create([
            'value'     => $token,
            'user_id'   => $user?->id
        ]);
    }

    public function delete(mixed $token)
    {
        $token = $this->deviceTokenRepository->findByToken($token);
        $token?->delete();
    }
}
