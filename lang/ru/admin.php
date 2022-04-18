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
            'instance_id'       => 'ID элемента',
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
            'has_fast_delivery' => 'Есть быстрая доставка',
            'has_delivery_calculator' => 'Расчет стоимости доставки через API',
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
            'id'        => 'ID',
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
    'pharmacy' => [
        'singular'  => 'Аптека',
        'plural'    => 'Аптеки',
        'fields'    => [
            'name'          => 'Наименование',
            'number'        => 'Номер аптеки',
            'city_id'       => 'Город',
            'address'       => 'Адрес',
            'working_time'  => 'График работы',
            'lat'           => 'Широта',
            'lng'           => 'Долгота',
            'is_active'     => 'Активный',
        ],
    ],
    'rating_message' => [
        'singular'  => 'Причина отзыва',
        'plural'    => 'Причины отзыва',
        'fields'    => [
            'message'   => 'Причина',
        ],
        'relations' => [
            'rating'    => 'Оценка'
        ]
    ],
    'delivery_method' => [
        'singular'  => 'Вид доставки',
        'plural'    => 'Виды доставок',
        'fields'    => [
            'name'          => 'Наименование',
            'slug'          => 'Ключ',
            'is_active'     => 'Активный',
        ],
        'relations' => [
            'cities'    => 'Города',
            'markets'   => 'Магазины'
        ]
    ],
    'promotion_group' => [
        'singular'  => 'Группа продвижения',
        'plural'    => 'Группы продвижения',
        'fields'    => [
            'name'          => 'Наименование',
            'slug'          => 'Ключ',
        ],
    ],
    'product_promotion_group' => [
        'singular'  => 'Продвигаемый продукт',
        'plural'    => 'Продвигаемые продукты',
        'fields'    => [
        ],
    ],
    'notification_type' => [
        'singular'  => 'Тип уведомления',
        'plural'    => 'Типы уведомлений',
        'fields'    => [
            'name'          => 'Наименование',
            'slug'          => 'Ключ',
        ],
    ],
];
