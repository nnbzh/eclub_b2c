<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Services\City\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(private CityService $cityService) {}

    public function index(Request $request) {
        $cities = $this->cityService->list();

        return CityResource::collection($cities);
    }
}
