<?php

namespace App\Repositories;

use App\Models\UserAddress;

class UserAddressRepository
{
    public function getByUserId($userId) {
        return UserAddress::query()->where('user_id', $userId)->get();
    }

    public function create(array $data)
    {
        return UserAddress::query()->create($data);
    }

    public function update(UserAddress $userAddress, array $data) {
        $userAddress->fill($data);
        $userAddress->saveOrFail();

        return $userAddress;
    }

    public function delete(UserAddress $userAddress) {
        $userAddress->delete();
    }
}
