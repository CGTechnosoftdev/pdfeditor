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
            'icon_image' => 'role-and-rights.svg',
            'route_name' => 'roles.index',
            'active_segments' => ['roles'],
            'permissions'=>['role-list'],
        ],
        [
            'label' => 'Sub-Admins',
            'icon_image' => 'admin.svg',
            'route_name' => 'sub-admin.index',
            'active_segments' => ['sub-admin'],
            'permissions'=>['sub-admin-list'],
        ],
        [
            'label' => 'Business Category',
            'icon' => 'building',
            'route_name' => 'business-category.index',
            'active_segments' => ['business-category'],
            'permissions'=>['business-category-list'],
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
