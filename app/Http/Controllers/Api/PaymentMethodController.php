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
            'city_id' => 'required_without_auth|exists:cities,id'
        ]);
        $user    = \Auth::user()->address->id;
        $methods = $this->paymentMethodService->list($request->city_id);

        return PaymentMethodResource::collection($methods);
    }
}
