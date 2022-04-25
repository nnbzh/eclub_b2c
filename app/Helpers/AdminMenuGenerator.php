<?php

namespace App\Helpers;

class AdminMenuGenerator
{
    public static function items()
    {
        return [
            'main' => [
                'label' => 'Главные',
                'items' => self::main()
            ],
            'content' => [
                'label' => 'Контент',
                'items' => self::content()
            ],
            'catalogue' => [
                'label' => 'Каталог',
                'items' => self::catalogue()
            ],
            'promotion' => [
                'label' => 'Продвижение',
                'items' => self::promotion()
            ]
        ];
    }

    private static function main() {
        return [
            [
                'uri' => 'dashboard',
                'icon' => 'la la-home',
                'label' => trans('backpack::base.dashboard'),
                'require_permission' => false
            ],
            [
                'uri' => 'role',
                'icon' => 'la la-user-lock',
                'label' => trans('backpack::permissionmanager.roles'),
                'require_permission' => true
            ],
            [
                'uri' => 'user',
                'icon' => 'la la-user',
                'label' => trans('admin.user.plural'),
                'require_permission' => true
            ],
        ];
    }

    private static function content() {
        return [
            [
                'uri' => 'block',
                'icon' => 'la la-list',
                'label' => trans('admin.block.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'menu_item',
                'icon' => 'la la-icons',
                'label' => trans('admin.menu_item.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'story',
                'icon' => 'la la-instagram',
                'label' => trans('admin.story.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'rating_message',
                'icon' => 'la la-comments',
                'label' => trans('admin.rating_message.plural'),
                'require_permission' => true,
            ],
        ];
    }

    private static function catalogue() {
        return [
            [
                'uri' => 'product',
                'icon' => 'la la-shopping-basket',
                'label' => trans('admin.product.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'category',
                'icon' => 'la la-list-alt',
                'label' => trans('admin.category.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'brand',
                'icon' => 'la la-star',
                'label' => trans('admin.brand.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'pharmacy',
                'icon' => 'la la-hospital-alt',
                'label' => trans('admin.pharmacy.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'market',
                'icon' => 'la la-store',
                'label' => trans('admin.market.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'city',
                'icon' => 'la la-city',
                'label' => trans('admin.city.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'delivery_method',
                'icon' => 'la la-dolly',
                'label' => trans('admin.delivery_method.plural'),
                'require_permission' => true,
            ],
        ];
    }

    private static function promotion() {
        return [
            [
                'uri' => 'promotion_group',
                'icon' => 'la la-promotion',
                'label' => trans('admin.promotion_group.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'promotion_group_product',
                'icon' => 'la la-promotion',
                'label' => trans('admin.promotion_group_product.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'promotion_group_category',
                'icon' => 'la la-promotion',
                'label' => trans('admin.promotion_group_category.plural'),
                'require_permission' => true,
            ],
            [
                'uri' => 'notification_type',
                'icon' => 'la la-promotion',
                'label' => trans('admin.notification_type.plural'),
                'require_permission' => true,
            ],
        ];
    }

    public static function canView($user, $uri) {
        return $user->can(RolePermission::PERMISSION_VIEW."_".$uri);
    }

    public static function getAllowedItems($user, $items) {
        $result = [];
        foreach ($items as $item) {
            if (self::canView($user, $item['uri'])) {
                $result[] = $item;
            }
        }

        return $result;
    }
}
