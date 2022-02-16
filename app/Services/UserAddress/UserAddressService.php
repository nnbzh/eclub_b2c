<?php

namespace App\Services\UserAddress;

use App\Models\UserAddress;
use App\Repositories\UserAddressRepository;

class UserAddressService
{
    public function __construct(private UserAddressRepository $userAddressRepository)
    {
    }

    public function all($filters = []) {
        return $this->userAddressRepository->all($filters);
    }

    public function create(array $data)
    {
        return $this->userAddressRepository->create($data);
    }

    public function update(UserAddress $userAddress, array $data)
    {
        return $this->userAddressRepository->update($userAddress, $data);
    }

    public function delete(UserAddress $userAddress) {
        $this->userAddressRepository->delete($userAddress);
    }
}
