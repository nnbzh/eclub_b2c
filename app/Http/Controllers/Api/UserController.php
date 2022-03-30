<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneNumberRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Requests\SubscribeRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UploadImageRequest;
use App\Http\Resources\UserResource;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function isPhoneUsed(PhoneNumberRequest $request) {
        $phone = $request->get('phone');

        return response()->json([
            'data' => $this->userService->isPhoneUsed($phone)
        ]);
    }

    public function setPassword(SetPasswordRequest $request) {
        $user = $request->user();
        $this->userService->update($user, $request->validated());

        return response()->json(['data' => null]);
    }

    public function subscribe(SubscribeRequest $request) {
        $user = $request->user();
        $subscription = $this->userService->subscribe($user, $request->validated());

        return response()->json(['data' => $subscription]);
    }

    public function update(UpdateUserRequest $request) {
        $user = $request->user();
        $user = $this->userService->update($user, $request->validated());

        return new UserResource($user);
    }

    public function uploadImage(UploadImageRequest $request) {
        $user   = $request->user();
        $this->userService->uploadImage($user, $request->file('image'));

        return response()->json(['data' => [
            'src' => $user->fullImgSrc
        ]]);
    }
}
