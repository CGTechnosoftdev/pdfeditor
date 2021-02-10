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
        '0' => 'No'
    ],
    'gender_arr' => [
        '1' => 'Male',
        '2' => 'Female',
        '3' => 'Other'
    ],
    'plan_type_arr' => [
        '2' => 'Yearly',
        '1' => 'Monthly',
    ],
    'payment_status_arr' => [
        '0' => 'Pending',
        '1' => 'Success',
        '2' => 'Failed',
    ],
    'share_type' => [
        '1' => 'Email',
        '2' => 'Link'
    ],
    'subscription_status_arr' => [
        '0' => 'Inactive',
        '1' => 'Active',
        '2' => 'Expired',
        '3' => 'In Trail',
        '4' => 'Cancelled',
    ],
    'active_subscription_status_arr' => [
        '1' => 'Active',
        '3' => 'In Trail',
    ],
    'model_arr' => [
        'user' => 'User',
        'role' => 'Role',
        'top-100-form' => 'Top100Form',
        'form' => 'Form',
        'faq' => 'Faq',
        'business_category' => 'BusinessCategory',
        'sub-admin' => 'User',
        'subscription_plan' => 'SubscriptionPlan',
        'promo-url' => 'PromoUrl',
        'email-template' => 'EmailTemplate',
        'document_type' => 'DocumentType',
        'document_template' => 'DocumentTemplate',
        'legal_form' => 'LegalForm',
        'catalog-category' => 'CatalogFormCategory',
        'catalog-form' => 'CatalogForm',
        'tax-type' => 'TaxFormType',
        'tax-category' => 'TaxFormCategory',
        'tax-form' => 'TaxForm',
        'tax-form-version' => 'TaxFormVersion',
        'tax-calendar' => 'TaxCalendar',

    ],
    'date_format_arr' => [
        'd-m-Y' => 'd-m-Y',
        'm/d/Y' => 'm/d/Y',
        'Y-m-d' => 'Y-m-d',
        'M d,Y' => 'M d, Y',
    ],
    'js_date_format_arr' => [
        'd-m-Y' => 'dd-mm-yyyy',
        'm/d/Y' => 'dd/mm/yyyy',
        'Y-m-d' => 'yyyy/mm/dd',
        'M d,Y' => 'M dd, yyyy',
    ],
    'daterangepicker_date_format_arr' => [
        'd-m-Y' => 'DD-MM-YYYY',
        'm/d/Y' => 'DD/MM/YYYY',
        'Y-m-d' => 'YYYY/MM/DD',
        'M d,Y' => 'MMM DD, YYYY',
    ],
    'time_format_arr' => [
        'h:i:s' => 'h:i:s',
        'H:i:s' => 'H:i:s',
        'h:i A' => 'h:i A'
    ],
    'time_hours' => [
        0 => '12 Hours',
        1 => '24 Hours',
    ],
    'paging_limit_arr' => [
        '10' => '10',
        '25' => '25',
        '50' => '50',
        '100' => '100',
        '-1' => 'All'
    ],
    'currency_arr' => [
        // [
        //     'key' => 'CAD',
        //     'label' => 'CAD',
        //     'symbol' => '$',
        // ],
        // [
        //     'key' => 'EUR',
        //     'label' => 'EUR',
        //     'symbol' => '€',
        // ],
        // [
        //     'key' => 'GBP',
        //     'label' => 'GBP',
        //     'symbol' => '£',
        // ],
        // [
        //     'key' => 'JPY',
        //     'label' => 'JPY',
        //     'symbol' => '¥',
        // ],
        [
            'key' => 'USD',
            'label' => 'USD',
            'symbol' => '$',
        ],
        [
            'key' => 'INR',
            'label' => 'INR',
            'symbol' => '₹',
        ],
    ],
    'stripe_config' => [
        'publishable_key' => 'pk_test_51HmGOzDCwgb6dlp7EiX42eI63FYyMYCDlM8BnMNPNGInZ8mRvZRjbmOKyFwraspS0YWqJzv25YCjOGOdswUoSbHH00N8GQ6qkD',
        'secret_key' => 'sk_test_51HmGOzDCwgb6dlp7THIZBQBOnOloJbFSUi9PLqqYh6lWBZrBxhsijlXlVkvzD8bIbZMdiGmUqukuR7KqZkR8MJD000Vs0iqVep',
    ],
    'amount_type_arr' => [
        '0' => 'Default',
        '1' => 'Custom',
    ],
    'catalog_types' => [
        'form-catalog' => 'Form Catalog',
        'document-catalog' => 'Document Catalog',
        'medical-catalog' => 'Medical Catalog',
        'legal-catalog' => 'Legal Catalog',
    ],
    'tax_for_arr' => [
        '1' => 'Employer',
        '2' => 'Freelancer',
        '3' => 'Employee',
    ],
    'authentication_method' => [
        'phone-number' => 'Phone Number',
        'social-media' => 'Social Media',
        'photo' => 'Photo',
    ],
    'user_advance_setting_templates' => [
        'casual' => 'Casual',
        'formal' => 'Formal',
        'informal' => 'Informal',

    ],
    'automatic_reminder_duration_arr' => [
        '1' => 'In 1 Day',
        '2' => 'In 2 Day',
        '3' => 'In 3 Day',
        '4' => 'In 4 Day',
        '5' => 'In 5 Day',
        '6' => 'In 6 Day',
        '7' => 'In 7 Day',
    ],
    'repeat_reminder_duration_arr' => [
        '1' => 'In 1 Day',
        '2' => 'In 2 Day',
        '3' => 'In 3 Day',
        '4' => 'In 4 Day',
        '5' => 'In 5 Day',
        '6' => 'In 6 Day',
        '7' => 'In 7 Day',
    ],
    'tag_color_arr' => [
        '#44A7D9' => '#44A7D9',
        '#37DED3' => '#37DED3',
        '#DEBC37' => '#DEBC37',
        '#76C958' => '#76C958',
        '#F57171' => '#F57171',
        '#FFA155' => '#FFA155',
        '#46BFBF' => '#46BFBF',
        '#98A2C5' => '#98A2C5',
        '#4B77CE' => '#4B77CE',
        '#F2CF22' => '#F2CF22',
    ],

    'usps_delivery_methods' => [
        1 => [
            'name' => 'USPS First Class Mail',
            'amount' => '5'
        ],
        2 => [
            'name' => 'USPS Certified Mail',
            'amount' => '10'
        ]
    ],

    'document_operations' => [
        '1' => 'Can View',
        '2' => 'Can Edit',
    ],
    'notify_status' => [
        '1' => "Notify",
        '0' => "Don't Notify",
    ],
    'invitation_email_template' => [
        '1' => [
            'name' => 'Casual',
            'subject' => '{[your_name]} has shared documents with you via PDFWriter',
            'message' => "Hi {[recipient_name]}, 

I've shared documents with you via PDFWriter. 

Changes made to these documents will be visible to everyone they are shared with. 

If you have any questions, email me at {[your_email]}",
        ],
        '2' => [
            'name' => 'Formal',
            'subject' => '{[your_name]} has shared documents with you',
            'message' => "Dear {[recipient_name]}, 

{[your_name]} has shared documents with you via PDFWriter. 

Changes made to these documents will be visible to everyone they are shared with. 

If you have any questions, contact {[your_email]}"
        ],
        '3' => [
            'name' => 'Informal',
            'subject' => '{[your_name]} has shared documents with you via PDFWriter',
            'message' => "Hello {[recipient_name]},

{[your_name]} has shared documents with you via PDFWriter. 

Changes made to these documents will be visible to everyone they are shared with. 

If you have any questions, contact {[your_email]}"
        ],
    ],
    'template_style'  => [
        0 => [
            'caption' => 'Upper-Left Corner',
            'email_template' => 'upper-left-corner',
        ],
        1 => [
            'caption' => 'Left Banner',
            'email_template' => 'left-banner',
        ],
        2 => [
            'caption' => 'Top Banner',
            'email_template' => 'top-banner',
        ],

    ],
    'is_use_email_template' => [
        'yes' => 1,
        'no' => 0,
    ],
    'grant_access_arr' => [
        0 => 'closed',
        1 => '3 days',
        2 => '7 days',
        3 => '30 days',
    ],
    'on_off_arr' => [
        '1' => 'On',
        '0' => 'Off'
    ],
    'audit_trail_message' => [
        '1' => [
            'type' => 'upload_create',
            'operations' => [
                'document' => 'You uploaded the document {document_name}.',
                'file_url' => 'You create document from the  url {document_name}.',
                'add_folder' => 'You create new folder.',
                'tags_data' => 'You save tags data for {document_name}',
                'save_smart_folder' => 'You save smart folder.',
                'link_to_fill_publish' => 'You publish the link.',
                'usps_request' => 'You submit USPS request for {document_name}',


            ]
        ],
        '2' => [
            'type' => 'rename',
            'operations' => [
                'document' => 'You rename the document {from_document} to {to_document}.',


            ]
        ],
        '3' => [
            'type' => 'delete',
            'operations' => [
                'smart_folder' => 'You delete the smart folder.',
            ]
        ],
        '4' => [
            'type' => 'trash',
            'operations' => [
                'move_to_trash' => 'You move the document in trash {document_name}.',
                'restore' => 'You restore the document {document_name}.',
                'empty' => 'You empty the trash list.'
            ]
        ],
        '5' => [
            'type' => 'share',
            'operations' => [
                'send_for_review' => 'You send the document for review {document_name}.',
                'share_document' => 'You shared the document {document_name}.',
            ]
        ],
        '6' => [
            'type' => 'download',
            'operations' => [
                'document' => 'You download the document {document_name}.',

            ]
        ],
        '7' => [
            'type' => 'print',
            'operations' => [
                'document' => 'You print the document {document_name}.',

            ]
        ],
        '8' => [
            'type' => 'account',
            'operations' => [
                'login' => 'You login the pdf-writer web application using {ip_address} at {login_time}.',
                'logout' => 'You logout the pdf-writer web application {ip_address} at {logout_time}.',

            ]
        ],
    ],
    'audit_number' => [
        'upload_create' => 1,
        'rename' => 2,
        'delete' => 3,
        'trash' => 4,
        'share' => 5,
        'download' => 6,
        'print' => 7,
        'account' => 8,
    ]


];
