<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarketResource;
use App\Services\Market\MarketService;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function __construct(private MarketService $marketService)
    {
    }

    public function index(Request $request) {
        $this->validate($request, [
            'city_id' => 'required|int|exists:cities,id'
        ]);
        $markets = $this->marketService->list($request->all());

        return MarketResource::collection($markets);
    }
}
