<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SubscriptionSponsor;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneNumberRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Requests\SubscribeRequest;
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

        return response()->noContent();
    }

    public function subscribe(SubscribeRequest $request) {
        $user = $request->user();
        $subscription = $this->userService->subscribe($user, $request->validated());

        return response()->json(['data' => $subscription]);
    }
}
