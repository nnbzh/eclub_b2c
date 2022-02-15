<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddress\StoreUserAddressRequest;
use App\Http\Requests\UserAddress\UpdateUserAddressRequest;
use App\Http\Resources\UserAddressResource;
use App\Models\UserAddress;
use App\Services\UserAddress\UserAddressService;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function __construct(private UserAddressService $userAddressService) {}

    public function show(UserAddress $address) {
        $this->authorize('show', $address);

        return new UserAddressResource($address);
    }

    public function store(StoreUserAddressRequest $request) {
        $validated              = $request->validated();
        $validated['user_id']   = $request->user()->id;
        $userAddress = $this->userAddressService->create($validated);

        return new UserAddressResource($userAddress);
    }

    public function index(Request $request) {
        $data = $request->merge(['user_id' => $request->user()->id])->all();
        $userAddresses = $this->userAddressService->all($data);

        return UserAddressResource::collection($userAddresses);
    }

    public function update(UpdateUserAddressRequest $request, UserAddress $address) {
        $this->authorize('update', $address);
        $userAddress = $this->userAddressService->update($address, $request->validated());

        return new UserAddressResource($userAddress);
    }

    public function destroy(UserAddress $address) {
        $this->authorize('destroy', $address);
        $this->userAddressService->delete($address);

        return response()->noContent();
    }
}
