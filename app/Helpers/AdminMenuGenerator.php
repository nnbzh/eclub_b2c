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
            ],
            [
                'route' => backpack_url('city'),
                'icon' => 'la la-city',
                'label' => trans('admin.city.plural'),
            ],
            [
                'route' => backpack_url('story'),
                'icon' => 'la la-instagram',
                'label' => trans('admin.story.plural'),
            ],
            [
                'route' => backpack_url('brand'),
                'icon' => 'la la-star',
                'label' => trans('admin.brand.plural'),
            ],
            [
                'route' => backpack_url('category'),
                'icon' => 'la la-list-alt',
                'label' => trans('admin.category.plural'),
            ],
            [
                'route' => backpack_url('product'),
                'icon' => 'la la-shopping-basket',
                'label' => trans('admin.product.plural'),
            ],
            [
                'route' => backpack_url('pharmacy'),
                'icon' => 'la la-hospital-alt',
                'label' => trans('admin.pharmacy.plural'),
            ],
            [
                'route' => backpack_url('rating_message'),
                'icon' => 'la la-comments',
                'label' => trans('admin.rating_message.plural'),
            ],
            [
                'route' => backpack_url('delivery_method'),
                'icon' => 'la la-dolly',
                'label' => trans('admin.delivery_method.plural'),
            ],
            [
                'route' => backpack_url('promotion_group'),
                'icon' => 'la la-promotion',
                'label' => trans('admin.promotion_group.plural'),
            ],
            [
                'route' => backpack_url('product_promotion_group'),
                'icon' => 'la la-promotion',
                'label' => trans('admin.product_promotion_group.plural'),
            ],
            [
                'route' => backpack_url('notification_type'),
                'icon' => 'la la-promotion',
                'label' => trans('admin.notification_type.plural'),
            ],
        ];
    }
}
