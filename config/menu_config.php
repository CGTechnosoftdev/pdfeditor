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
            'active_segments' => ['', 'dashboard'],
        ],
        [
            'label' => 'Roles and Permissions',
            'icon_image' => 'role-and-rights.svg',
            'route_name' => 'roles.index',
            'active_segments' => ['roles'],
            'permissions' => ['role-list'],
        ],
        [
            'label' => 'Sub Admin Management',
            'icon_image' => 'admin.svg',
            'route_name' => 'sub-admin.index',
            'active_segments' => ['sub-admin'],
            'permissions' => ['sub-admin-list'],
        ],
        [
            'label' => 'User Management',
            'icon' => 'users',
            'route_name' => 'user.index',
            'active_segments' => ['user'],
            'permissions' => ['user-list'],
        ],
        [
            'label' => 'Subscription Plans',
            'icon' => 'money',
            'route_name' => 'subscription-plan.index',
            'active_segments' => ['subscription-plan'],
            'permissions' => ['subscription-plan-list'],
        ],
        [
            'label' => 'Promo URLs',
            'icon' => 'tag',
            'route_name' => 'promo-url.index',
            'active_segments' => ['promo-url'],
            'permissions' => ['promo-url-list'],
        ],
        [
            'label' => 'Business Category',
            'icon' => 'building',
            'route_name' => 'business-category.index',
            'active_segments' => ['business-category'],
            'permissions' => ['business-category-list'],
        ],
        [
            'label' => 'Top 100 Form',
            'icon' => 'file',
            'route_name' => 'top-100-form.index',
            'active_segments' => ['top-100-form'],
            'permissions' => ['top-100-form-list'],
        ],
        [
            'label' => 'Manage 360 Legal Forms',
            'icon' => 'file',
            'route_name' => 'legal-form.index',
            'active_segments' => ['legal-form'],
            'permissions' => ['360-legal-form-list'],
        ],
        [
            'label' => 'Email Template',
            'icon' => 'envelope',
            'route_name' => 'email-template.index',
            'active_segments' => ['email-template'],
            'permissions' => ['email-template-list'],
        ],
        [
            'label' => 'General Settings',
            'icon' => 'gears',
            'route_name' => 'general-setting.index',
            'active_segments' => ['general-setting'],
            'permissions' => ['general-setting-list'],
        ],
        [
            'label' => 'Document Template',
            'icon' => 'building',
            'route_name' => '#',
            'active_segments' => ['document-type', 'document-template'],
            'permissions' => ['document-type-list', 'document-template-list'],
            'child' => [
                [
                    'label' => 'Document Template Types',
                    'icon' => 'list',
                    'route_name' => 'document-type.index',
                    'active_segments' => ['document-type'],
                    'permission' => ['document-type-list'],
                ], [
                    'label' => 'Document Templates',
                    'icon' => 'file',
                    'route_name' => 'document-template.index',
                    'active_segments' => ['document-template'],
                    'permission' => ['document-template-list'],
                ],
            ]
        ],
        [
            'label' => 'Catalog Forms',
            'icon' => 'list-alt',
            'route_name' => '#',
            'active_segments' => ['catalog-category', 'catalog-form'],
            'permissions' => ['catalog-category-list', 'catalog-form-list'],
            'child' => [
                [
                    'label' => 'Catalog Categories',
                    'icon' => 'list',
                    'route_name' => 'catalog-category.index',
                    'active_segments' => ['catalog-category'],
                    'permission' => ['catalog-category-list'],
                ], [
                    'label' => 'Catalog Forms',
                    'icon' => 'file',
                    'route_name' => 'catalog-form.index',
                    'active_segments' => ['catalog-form'],
                    'permission' => ['catalog-form-list'],
                ],
            ]
        ],
        [
            'label' => 'Tax Forms',
            'icon' => 'percent',
            'route_name' => '#',
            'active_segments' => ['tax-type', 'tax-category', 'tax-form'],
            'permissions' => ['tax-type-list', 'tax-category-list', 'tax-form-list'],
            'child' => [
                [
                    'label' => 'Tax Types',
                    'icon' => 'list',
                    'route_name' => 'tax-type.index',
                    'active_segments' => ['tax-type'],
                    'permission' => ['tax-type-list'],
                ],
                [
                    'label' => 'Tax Categories',
                    'icon' => 'list',
                    'route_name' => 'tax-category.index',
                    'active_segments' => ['tax-category'],
                    'permission' => ['tax-category-list'],
                ], [
                    'label' => 'Tax Forms',
                    'icon' => 'file',
                    'route_name' => 'tax-form.index',
                    'active_segments' => ['tax-form'],
                    'permission' => ['tax-form-list'],
                ],
            ]
        ],
        [
            'label' => 'Tax Calendar',
            'icon' => 'calendar',
            'route_name' => 'tax-calendar.index',
            'active_segments' => ['tax-calendar'],
            'permissions' => ['tax-calendar-list'],
        ],
    ],
];
