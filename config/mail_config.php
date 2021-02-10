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
		'subject' => 'Welcome Email',
		'keywords' => [
			"{[name]}",
			"{[email]}",
			"{[password]}"
		],
	],
	'additional_welcome_email' => [
		'source' => 'file',
		'key' => 'welcome',
		'subject' => 'Welcome Email',
		'keywords' => [
			"{[name]}",
			"{[email]}",
			"{[password]}"
		],
	],
	'reset_password' => [
		'source' => 'file',
		'key' => 'reset-password',
		'subject' => 'Reset Password',
		'keywords' => [
			"{[name]}",
			"{[email]}",
			"{[reset_button]}"
		],

	],
	'email_verification' => [
		'source' => 'file',
		'key' => 'email-verification',
		'subject' => 'Registration verification',
		'keywords' => [
			"{[name]}",
			"{[email]}",
			"{[link]}"
		],

	],
	'renewal_failed' => [
		'source' => 'file',
		'key' => 'renewal-failed',
		'subject' => 'Subscription renewal failed',
		'keywords' => [
			"{[name]}",
			"{[email]}",
			"{[reason]}"
		],

	],
	'renewal_success' => [
		'source' => 'file',
		'key' => 'renewal-success',
		'subject' => 'Subscription renewed',
		'keywords' => [
			"{[name]}",
			"{[email]}",
			"{[duration]}",
			"{[amount]}",
		],

	],
	'document_share' => [
		'source' => 'file',
		'key' => 'document_share',
		'subject' => 'Shared Document',
		'keywords' => [
			"{[name]}",
			"{[document_link]}",
			"{[document_name]}",
		],

	],
	'upper-left-corner' => [
		'source' => 'file',
		'key' => 'upper-left-corner',
		'subject' => 'Template Format1',
		'keywords' => [
			"{[name]}",

			"{[title]}",
			"{[company]}",
			"{[email]}",
			"{[phone]}",
			"{[fax]}",
		],

	],
	'left-banner' => [
		'source' => 'file',
		'key' => 'left-banner',
		'subject' => 'Template Format2',
		'keywords' => [
			"{[name]}",
			"{[title]}",
			"{[company]}",
			"{[email]}",
			"{[phone]}",
			"{[fax]}",
		],

	],
	'top-banner' => [
		'source' => 'file',
		'key' => 'top-banner',
		'subject' => 'Template Format3',
		'keywords' => [
			"{[name]}",
			"{[title]}",
			"{[company]}",
			"{[email]}",
			"{[phone]}",
			"{[fax]}",
		],

	],
	'email_reset_verification' => [
		'source' => 'file',
		'key' => 'reset-email',
		'subject' => 'Email Reset verification',
		'keywords' => [
			"{[name]}",
			"{[email]}",
			"{[reset_button]}"
		],

	],
	'phone_reset_verification' => [
		'source' => 'file',
		'key' => 'reset-phone',
		'subject' => 'Phone Reset verification',
		'keywords' => [
			"{[name]}",
			"{[email]}",
			"{[reset_button]}"
		],

	],



];
