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

        'admin' => [],

        'user'  => [],
    ]
];
