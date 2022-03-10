<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function index(Request $request) {
        $products = $this->productService->list($request->all());

        return ProductResource::collection($products);
    }

    public function search(Request $request) {
        $this->validate($request, [
            'keyword' => 'required'
        ]);
        $products = $this->productService->search($request->keyword);

        return ProductResource::collection($products);
    }

}
