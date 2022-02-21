<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Services\Brand\BrandService;

class BrandController extends Controller
{
    public function __construct(private BrandService $brandService)
    {
    }

    public function brands() {
        $brands = $this->brandService->list();

        return BrandResource::collection($brands);
    }
}
