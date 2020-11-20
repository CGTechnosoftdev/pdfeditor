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
];