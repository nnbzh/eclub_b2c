<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function products(Request $request) {
        $products = Product::query()
            ->where('name', 'like', "%{$request->q}%")
            ->paginate(10);

        return ProductResource::collection($products);
    }
}
