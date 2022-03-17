<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryMethodResource;
use App\Services\DeliveryMethod\DeliveryMethodService;
use Illuminate\Http\Request;

class DeliveryMethodController extends Controller
{
    public function __construct(private DeliveryMethodService $deliveryMethodService)
    {
    }

    public function index(Request $request) {
        $this->validate($request, [
            'city_id' => 'nullable|exists:cities,id'
        ]);

        return DeliveryMethodResource::collection($this->deliveryMethodService->list($request->city_id, $request->user()));
    }
}