<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAddress;

class UserAddressPolicy
{
    public function show(User $user, UserAddress $userAddress) {
        return $user->id == $userAddress->user_id;
    }

    public function update(User $user, UserAddress $userAddress) {
        return $user->id == $userAddress->user_id;
    }

    public function destroy(User $user, UserAddress $userAddress) {
        return $user->id == $userAddress->user_id;
    }
}
