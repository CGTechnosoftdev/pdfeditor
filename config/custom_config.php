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
    ],
    'date_format_arr' => [
        'Y/m/d' => 'Y/m/d',
        'Y-m-d' => 'Y-m-d',
    ],
    'time_format_arr' => [
        'h:i:s' => 'h:i:s',
        'H:i:s' => 'H:i:s',
        'h:i A' => 'h:i A'
    ]
    
];
