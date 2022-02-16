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
                'route' => backpack_url('block'),
                'icon' => 'la la-list',
                'label' => trans('admin.block.plural'),
            ],
            [
                'route' => backpack_url('market'),
                'icon' => 'la la-store',
                'label' => trans('admin.market.plural'),
            ],
            [
                'route' => backpack_url('menu_item'),
                'icon' => 'la la-icons',
                'label' => trans('admin.menu_item.plural'),
            ]
        ];
    }
}
