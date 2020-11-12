<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mail config
    |--------------------------------------------------------------------------
    |
    | Mail config is here to decide the email sent  | over site.
    */
    'welcome_email' => [
    	'source' => 'file',
    	'key' => 'welcome',
    	'subject'=>'Welcome Email',
    	'keywords' => [
    		"{[name]}",
    		"{[email]}",
    		"{[password]}"
    	],
    ],
    'reset_password' => [
    	'source' => 'file',
    	'key' => 'reset-password',
    	'subject'=>'Reset Password',
    	'keywords' => [
    		"{[name]}",
    		"{[email]}",
    		"{[reset_button]}"
        ],
        
	],
	'email_verification' => [
    	'source' => 'file',
    	'key' => 'email-verification',
    	'subject'=>'Registration verification',
    	'keywords' => [
    		"{[name]}",
    		"{[email]}",
    		"{[link]}"
        ],
        
	],
	
];
