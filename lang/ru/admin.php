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
    'menu_item' => [
        'singular'  => 'Предмет меню',
        'plural'    => 'Предметы меню',
        'fields'    => [
            'name'              => 'Наименование',
            'component'         => 'JS компонент',
        ],
    ],
];
