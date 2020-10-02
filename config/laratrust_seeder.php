<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
            'roles' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'hotels' => 'c,r,u,d',
            'destination' => 'c,r,u,d',
            'excursions' => 'c,r,u,d',
            'packages' => 'c,r,u,d',
            'plans' => 'c,r,u,d',
            'seasons' => 'c,r,u,d',
            'days' => 'c,r,u,d',
            'pages' => 'c,r,u,d',

        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'roles' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'hotels' => 'c,r,u,d',
            'destination' => 'c,r,u,d',
            'excursions' => 'c,r,u,d',
            'packages' => 'c,r,u,d',
            'plans' => 'c,r,u,d',
            'seasons' => 'c,r,u,d',
            'days' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
        ],
        'user' => [
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'a' => 'accept',
    ]
];
