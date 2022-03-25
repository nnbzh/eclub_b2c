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
        $validated = $this->validate($request, [
            'brand_id'  => 'nullable|exists:brands,id',
            'city_id'   => 'required_without_auth'
        ]);

        if (empty($validated['city_id'])) {
            $validated['city_id'] = $request->user()->address?->city_id;
        }

        $products = $this->productService->list($validated);

        return ProductResource::collection($products);
    }

    public function show(Request $request, Product $product) {
        $product = \ProductPreprocessor::process(collect([$product->load('description')]), 4);

        if (! $product->first()) {
            abort(400, 'Нет в наличии');
        }

        return new ProductResource($product->first());
    }

    public function search(Request $request) {
        $this->validate($request, [
            'keyword' => 'required'
        ]);
        $products = $this->productService->search($request->keyword);

        return ProductResource::collection($products);
    }

}
