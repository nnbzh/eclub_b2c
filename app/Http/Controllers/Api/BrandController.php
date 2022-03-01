<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Services\Brand\BrandService;
use Illuminate\Support\Facades\Request;

class BrandController extends Controller
{
    public function __construct(private BrandService $brandService)
    {
    }

    public function index(Request $request) {
        $brands = $this->brandService->list($request->type);

        return BrandResource::collection($brands);
    }
}
