<?php

namespace App\Helpers;

class AdminMenuGenerator
{
    public static function items() {
        return [
            [
                'route' => backpack_url('dashboard'),
                'icon' => 'la la-home',
                'label' => trans('backpack::base.dashboard')
            ],
            [
                'route' => backpack_url('user'),
                'icon' => 'la la-user-lock',
                'label' => trans('admin.user.plural'),
            ],
            [
                'route' => backpack_url('menu_item'),
                'icon' => 'la la-store',
                'label' => trans('admin.menu_item.plural'),
            ]
        ];
    }
}
