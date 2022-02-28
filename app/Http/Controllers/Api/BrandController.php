<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Services\Brand\BrandService;

class BrandController extends Controller
{
    public function __construct(private BrandService $brandService)
    {
    }

    public function index() {
        $brands = $this->brandService->list();

        return BrandResource::collection($brands);
    }
}
