<?php
return [

    'permissions' => [
        
        'users' => [
            'open',
            'close',
        ],

        'list_items' => [
            'open',
            'read',
            'close',
        ],
    ],

    'roles' => [
        'admin' => 'Администратор',
        'user'  => 'Пользователь',
    ],

    'role_permissions' => [

        'admin' => [
            'list_items_open',
            'users_open',
        ],

        'user'  => [
            'list_items_open',
        ],
    ]
];
