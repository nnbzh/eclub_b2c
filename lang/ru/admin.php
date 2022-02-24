<?php

return [
    'common' => [
        'created_at'    => 'Дата создания',
        'updated_at'    => 'Дата обновления'
    ],
    'user' => [
        'singular'  => 'Пользователь',
        'plural'    => 'Пользователи',
        'fields'    => [
            'phone'             => 'Телефон',
            'email'             => 'Почта',
            'name'              => 'ФИО',
            'password'          => 'Пароль',
            'birthdate'         => 'Дата рождения',
            'lang'              => 'Язык',
            'send_mail'         => 'Отправлять письмо на почту',
            'send_notification' => 'Отправлять уведомления',
        ],
    ],
    'market' => [
        'singular'  => 'Магазин',
        'plural'    => 'Магазины',
        'fields'    => [
            'name'      => 'Наименование',
            'number'    => 'Номер в CRM',
            'is_active' => 'Активный',
        ],
        'relations'     => [
            'city'          => 'Города',
            'categories'    => 'Категории',
        ],
    ],
    'menu_item' => [
        'singular'  => 'Предмет меню',
        'plural'    => 'Предметы меню',
        'fields'    => [
            'name'              => 'Наименование',
            'component'         => 'JS компонент',
        ],
    ],
    'block' => [
        'singular'  => 'Блок главной страницы',
        'plural'    => 'Блоки главной страницы',
        'fields'    => [
            'title'             => 'Наименование блока',
            'component_name'    => 'Наименование компонента',
        ],
    ],
    'city' => [
        'singular'  => 'Город',
        'plural'    => 'Города',
        'fields'    => [
            'name'      => 'Наименование',
            'lat'       => 'Широта',
            'lng'       => 'Долгота',
            'code'      => 'Код',
            'number'    => 'Номер',
            'is_active' => 'Активный',
            'has_delivery' => 'Есть доставка',
        ],
    ],
    'story' => [
        'singular'  => 'История',
        'plural'    => 'Истории',
        'fields'    => [
            'name'      => 'Наименование',
            'is_active' => 'Активный',
        ],
    ],
    'image' => [
        'singular'  => 'Картинка',
        'plural'    => 'Картинки',
        'fields'    => [
            'src'       => 'Наименование',
            'is_active' => 'Активный',
        ],
    ],
    'brand' => [
        'singular'  => 'Бренд',
        'plural'    => 'Бренды',
        'fields'    => [
            'name'      => 'Наименование',
            'is_active' => 'Активный',
        ],
    ],
    'category' => [
        'singular'  => 'Категория',
        'plural'    => 'Категории',
        'fields'    => [
            'name'      => 'Наименование',
            'is_active' => 'Активный',
        ],
        'relations'    => [
            'subcategories' => 'Подкатегории',
            'parent'        => 'Родительская категория',
        ],
    ],
    'product' => [
        'singular'  => 'Продукт',
        'plural'    => 'Продукты',
        'fields'    => [
            'name'          => 'Наименование',
            'sku'           => 'SKU',
            'barcode'       => 'Штрихкод',
            'sub_limit'     => 'Лимит по подписке',
            'country'       => 'Страна',
            'is_active'     => 'Активный',
            'is_special'    => 'Специальный',
            'by_recipe'     => 'По рецепту',
        ],
        'relations'    => [
            'category'  => 'Категория',
            'brand'     => 'Бренд',
        ],
    ],
];
