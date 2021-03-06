<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PharmacyResource;
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
            'brand_id'      => 'nullable|exists:brands,id',
            'city_id'       => 'required|int|exists:cities,id',
            'category_id'   => 'nullable|array',
            'category_id.*' => 'nullable|int|exists:categories,id',
        ]);
        $products = $this->productService->list($validated);

        return ProductResource::collection($products);
    }

    public function show(Request $request, Product $product) {
        $this->validate($request, [
            'city_id' => 'required|int|exists:cities,id'
        ]);
        $product = \ProductPreprocessor::process(collect([$product->load('description')]), $request->city_id);

        if (! $product->first()) {
            abort(400, 'Нет в наличии');
        }

        return new ProductResource($product->first());
    }

    public function search(Request $request) {
        $this->validate($request, [
            'keyword' => 'required',
            'city_id' => 'required|int|exists:cities,id'
        ]);
        $products = $this->productService->search($request->keyword, $request->city_id);

        return ProductResource::collection($products);
    }

    public function getPickupPharmacies(Request $request) {
        $request->validate([
            'lat'       => 'required',
            'lng'       => 'required',
            'city_id'   => 'required',
            'products'  => 'required|array|min:1'
        ]);
        $pharmacies = $this->productService->getPickupPharmacies($request->city_id,$request->lat,$request->lng,$request->products);

        return PharmacyResource::collection($pharmacies);
    }

}
