<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Services\PaymentMethod\PaymentMethodService;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    private $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService)
    {
        $this->paymentMethodService = $paymentMethodService;
    }

    public function index(Request $request) {
        $this->validate($request, [
            'city_id' => 'required|exists:cities,id'
        ]);
        $user    = \Auth::user();
        $methods = $this->paymentMethodService->list($request->city_id ?? $user->address?->id);

        return PaymentMethodResource::collection($methods);
    }
}
