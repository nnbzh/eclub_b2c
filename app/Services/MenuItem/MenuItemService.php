<?php

namespace App\Services\MenuItem;

use App\Repositories\MenuItemRepository;

class MenuItemService
{
    public function __construct(private MenuItemRepository $menuItemRepository) {}

    public function list() {
        return $this->menuItemRepository->list();
    }
}
