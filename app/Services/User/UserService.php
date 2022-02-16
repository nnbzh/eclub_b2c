<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(private UserRepository $userRepository)
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
}
