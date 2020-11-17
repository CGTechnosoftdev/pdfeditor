<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom variable as well as array
    |--------------------------------------------------------------------------
    |
    | By default, We use custom variable  for use our custom data .
    */
    'status_arr' => [
        '1' => 'Active',
        '2' => 'Inactive',

    ],
    'all_status_arr' => [
        '0' => 'Pending',
        '1' => 'Active',
        '2' => 'Inactive',
        '3' => 'Blocked',
    ],
    'yes_no_arr' => [
        '1' => 'Yes',
        '2' => 'No'
    ],
    'gender_arr' => [
        '1' => 'Male',
        '2' => 'Female',
        '3' => 'Other'
    ],
    'model_arr'=>[
        'user'=>'User',
        'role'=>'Role',
        'top-100-form' => 'Top100Form',
        'form' => 'Form',
        'faq' => 'Faq',
        'business_category' =>'BusinessCategory',
        'sub-admin'=>'User',
        'subscription_plan' => 'SubscriptionPlan',
        'promo-url' => 'PromoUrl',
        'email-template' => 'EmailTemplate',
    ],
    'date_format_arr' => [
        'd-m-Y' => 'd-m-Y',
        'm/d/Y' => 'm/d/Y',
        'Y-m-d' => 'Y-m-d',
    ],
    'time_format_arr' => [
        'h:i:s' => 'h:i:s',
        'H:i:s' => 'H:i:s',
        'h:i A' => 'h:i A'
    ],
    'paging_limit_arr' => [
        '10' => '10',
        '25' => '25',
        '50' => '50',
        '100' => '100'
    ],
    'currency_arr' => [
        [
            'key' => 'CAD',
            'label' => 'CAD',
            'symbol' => '$',
        ],
        [
            'key' => 'EUR',
            'label' => 'EUR',
            'symbol' => '€',
        ],
        [
            'key' => 'GBP',
            'label' => 'GBP',
            'symbol' => '£',
        ],
        [
            'key' => 'JPY',
            'label' => 'JPY',
            'symbol' => '¥',
        ],
        [
            'key' => 'USD',
            'label' => 'USD',
            'symbol' => '$',
        ],
    ],
    'amount_type_arr' => [
        '0' => 'Default',
        '1' => 'Custom',
    ],
    
];
