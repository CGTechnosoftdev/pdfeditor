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
	
    'MODEL_TYPE' => 'App\User',
    'TOP_100_FORM' => 'TOP_100_FORM',
	'DEFAULT_MODEL_TYPE' => 'App\Models\User',

    'DEFAULT_GENDER' => '1',
	
    //Payment Status constant
    'PAYMENT_STATUS_PENDING'=>'0',
    'PAYMENT_STATUS_SUCCESS'=>'1',
    'PAYMENT_STATUS_FAILED'=>'2',
    
    'DEFAULT_CURRNCY' => "USD",
    'PUBLIC_DATE_FORMAT' => "d-m-Y",
    'PUBLIC_TIME_FORMAT' => "h:i A",
    'PUBLIC_DATE_TIME_FORMAT' => "d-m-Y h:i A",
   
    'MODEL_TYPE' => 'App\Models\User',

    'DEFAULT_PHONECODE' => 226,
    'PASSWORD_REGEX_INSTRUCTION' => "Your password must contain 1 uppercase,1 lowercase, 1 digit and 1 special character",
    'PASSWORD_REGEX' => '/(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@#$!%*?&]{8,}$)/u',

    'DEFAULT_AMOUNT_TYPE' => 0,
    
];

