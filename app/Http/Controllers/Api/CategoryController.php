<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {
    }

    public function index(Request $request) {
        return CategoryResource::collection($this->categoryService->list($request->type ?? null));
    }

    public function show(Request $request, Category $category) {
        return new CategoryResource($category->load('subcategories'));
    }
}
