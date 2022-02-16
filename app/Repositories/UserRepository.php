<?php

namespace App\Repositories;


use App\Models\User;

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
}
