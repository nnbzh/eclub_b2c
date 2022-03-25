<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuItemResource;
use App\Services\MenuItem\MenuItemService;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function __construct(private MenuItemService $menuItemService) {}

    public function index(Request $request) {
        return MenuItemResource::collection($this->menuItemService->list());
    }
}
