<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PhoneNumberRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Resources\TokenResource;
use App\Services\Auth\LoginService;
use App\Traits\IssuesToken;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use IssuesToken;

    public function __construct(private LoginService $loginService)
    {
        $this->middleware('auth:api')->only(['logout']);
    }

    public function requestOtp(PhoneNumberRequest $request) {
       $this->loginService->requestOtp($request->phone);

        return response()->noContent();
    }

    public function verifyOtp(VerifyOtpRequest $request) {
        return new TokenResource(json_decode($this->issueToken($request)->getContent()));
    }

    public function login(LoginRequest $request) {
        return new TokenResource(json_decode($this->issueToken($request, 'password')->getContent()));
    }

    public function logout(Request $request) {
        $token = $request->user()->currentAccessToken();
        $token->revoke();
        app('Laravel\Passport\RefreshTokenRepository')->revokeRefreshTokensByAccessTokenId($token->id);

        return response()->noContent();
    }
}
