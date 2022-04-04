<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneNumberRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Requests\SubscribeRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UploadImageRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Models\Product;
use App\Services\User\UserService;
use Illuminate\Http\Request;

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

    public function me(Request $request) {
        $user = $request->user();
        $user->load('image');

        return new UserResource($user);
    }

    public function like(Request $request, Product $product) {
        $user = $request->user();
        $this->userService->like($user, $product);

        return response()->json(['data' => [
            'success' => true
        ]]);
    }

    public function products(Request $request) {
        $user       = $request->user();
        $products   = $this->userService->getUserProducts($user);

        return ProductResource::collection($products);
    }

    public function orders(Request $request) {
        return OrderResource::collection($request->user->orders()->get());
    }
}
