<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CONSTANT Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, We use constant for assets path, assets admin path.
    | error validation message
    */

    'STATUS_PENDING' => '0',
    'STATUS_ACTIVE' => '1',
    'STATUS_INACTIVE' => '2',
    'STATUS_BLOCKED' => '3',

    //yes-no constant
    'STATUS_YES' => '1',
    'STATUS_NO' => '0',

    // User Roles
    'ADMIN_ROLE' => '1',
    'USER_ROLE' => '2',
    'ADMIN_ROLE_NAME' => 'Admin',
    'USER_ROLE_NAME' => 'User',

    'MODEL_TYPE' => 'App\User',
    'TOP_100_FORM' => 'TOP_100_FORM',
    'DEFAULT_MODEL_TYPE' => 'App\Models\User',

    'DEFAULT_GENDER' => '1',

    //Payment Status constant
    'PAYMENT_STATUS_PENDING' => '0',
    'PAYMENT_STATUS_SUCCESS' => '1',
    'PAYMENT_STATUS_FAILED' => '2',

    'DEFAULT_CURRNCY' => "USD",
    'USD_SYMBOL' => "$",
    'PUBLIC_DATE_FORMAT' => "d-m-Y",
    'PUBLIC_TIME_FORMAT' => "h:i A",
    'PUBLIC_DATE_TIME_FORMAT' => "d-m-Y h:i A",

    'MODEL_TYPE' => 'App\Models\User',

    'DEFAULT_PHONECODE' => 226,
    'FORBIDDEN_MESSAGE' => "You are not authorize for this. Please contact administrator",
    'PASSWORD_REGEX_INSTRUCTION' => "8 Character minimum and must contain 1 uppercase,1 lowercase, 1 digit and 1 special character",
    'CVV_INSTRUCTION' => "The CVV/CVC code (Card Verification Value/Code) is located on the back of your credit/debit card on the right side of the white signature strip",
    'PASSWORD_REGEX' => '/(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@#$!%*?&]{8,}$)/u',

    'SUBSCRIPTION_PLAN_TYPE_TRAIL' => 0,
    'SUBSCRIPTION_PLAN_TYPE_MONTHLY' => 1,
    'SUBSCRIPTION_PLAN_TYPE_YEARLY' => 2,

    'SUBSCRIPTION_STATUS_NO' => 0,
    'SUBSCRIPTION_STATUS_YES' => 1,
    'SUBSCRIPTION_STATUS_INACTIVE' => 0,
    'SUBSCRIPTION_STATUS_ACTIVE' => 1,
    'SUBSCRIPTION_STATUS_EXPIRED' => 2,
    'SUBSCRIPTION_STATUS_TRAIL' => 3,
    'SUBSCRIPTION_STATUS_CANCELLED' => 4,

    'SUBSCRIPTION_STATUS_PENDING' => 0,
    'SUBSCRIPTION_STATUS_ACTIVE' => 1,
    'SUBSCRIPTION_STATUS_EXPIRED' => 2,
    'SUBSCRIPTION_STATUS_FAILED' => 3,
    'SUBSCRIPTION_STATUS_CANCELLED' => 4,

    'DEFAULT_AMOUNT_TYPE' => 0,
    'PAGE_NOT_DEFINE' => -1,
    'UPLOAD_USER_TEMPLATE' => 2,

];
