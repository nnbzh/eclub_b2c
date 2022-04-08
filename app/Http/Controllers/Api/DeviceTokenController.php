<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DeviceToken\DeviceTokenService;
use Illuminate\Http\Request;

class DeviceTokenController extends Controller
{
    public function __construct(private DeviceTokenService $deviceTokenService)
    {
    }

    public function store(Request $request) {
        $this->validate($request, [
            'token'     => 'required|string',
        ]);
        $user = $request->user() ?? null;
        $this->deviceTokenService->create($request->token, $user);

        return response()->json(['data' => null]);
    }

    public function destroy(Request $request) {
        $this->validate($request, [
            'token'     => 'required|string',
        ]);
        $this->deviceTokenService->delete($request->token);

        return response()->json(['data' => null]);
    }
}
