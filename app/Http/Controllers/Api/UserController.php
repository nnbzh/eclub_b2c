<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneNumberRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;

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
}
