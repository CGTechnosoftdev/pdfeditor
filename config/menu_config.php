<?php

return [

    /*
    |--------------------------------------------------------------------------
    | menus can be manage here
    |--------------------------------------------------------------------------
    */
    'admin_sidebar' => [
        [
            'label' => 'Dashboard',
            'icon' => 'dashboard',
            'route_name' => 'dashboard',
            'active_segments' => ['','dashboard'],
        ],
        [
            'label' => 'Roles and Rights',
            'icon' => 'key',
            'route_name' => 'roles.index',
            'active_segments' => ['roles'],
            'permissions'=>['role-list'],
        ],
        [
            'label' => 'Top 100 Form',
            'icon' => 'key',
            'route_name' => 'top-100-form.index',
            'active_segments' => ['top-100-form'],
            'permissions'=>['role-list'],
        ],
        // [
        //     'label' => 'User',
        //     'icon' => 'user',
        //     'route_name' => 'roles.index',
        //     'active_segments' => ['user','user-subscription'],
        //     'permissions'=>['user-list','user-subscription'],
        //     'child'=> [
        //         [
        //             'label' => 'Users',
        //             'icon' => 'users',
        //             'route_name' => 'roles.index',
        //             'active_segments' => ['user'],
        //             'permission'=>['user-list'],
        //         ],
        //         [
        //             'label' => 'Subscriptions',
        //             'icon' => 'lock',
        //             'route_name' => 'roles.index',
        //             'active_segments' => ['user-subscription'],
        //             'permission'=>['user-subscription'],
        //         ],
        //     ]
        // ],
    ],
];
