<?php

namespace App\Repositories;

use App\Filters\UserAddressFilter;
use App\Models\UserAddress;

class UserAddressRepository
{
    public function all($filters = [])
    {
        $query = UserAddress::query();

        if (!empty($filters)) {
            $query->applyFilters(new UserAddressFilter, $filters);
        }

        return $query->get();
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
