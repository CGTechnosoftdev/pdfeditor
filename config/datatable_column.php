<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Datatable columns and other config
    |--------------------------------------------------------------------------
    |
    | This is the list of columns shows in your country datatable and other config
    |
    */
    'roles' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'sub-admin' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'first_name', 'name' => 'first_name', 'label' => 'First Name', 'orderBy' => 'asc'],
            ['data' => 'last_name', 'name' => 'last_name', 'label' => 'Last Name', 'orderBy' => 'asc'],
            ['data' => 'role_name', 'name' => 'role_name', 'label' => 'Role', 'orderBy' => 'asc'],
            ['data' => 'gender_name', 'name' => 'gender_name', 'label' => 'Gender', 'orderBy' => 'asc'],
            ['data' => 'contact_number', 'name' => 'contact_number', 'label' => 'Phone Number', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'business-category' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'top100_forms' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => 'S No.'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],

    'forms' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => 'S No.'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],

    'faq' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => 'S No.'],
            ['data' => 'question', 'name' => 'question', 'label' => 'Question', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'subscription_plan' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'formated_yearly_amount', 'name' => 'formated_yearly_amount', 'label' => 'Yearly Amount', 'orderBy' => 'asc'],
            ['data' => 'formated_monthly_amount', 'name' => 'formated_monthly_amount', 'label' => 'Monthly Amount', 'orderBy' => 'asc'],
            ['data' => 'formated_discount_percent', 'name' => 'formated_discount_percent', 'label' => 'Discount Percent', 'orderBy' => 'asc'],
            ['data' => 'max_team_member', 'name' => 'max_team_member', 'label' => 'Max Team Member', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'promo_url' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'subscription_plan_name', 'name' => 'subscription_plan_name', 'label' => 'Plan Name', 'orderBy' => 'asc'],
            ['data' => 'promotion_name', 'name' => 'promotion_name', 'label' => 'Promotion Name', 'orderBy' => 'asc'],
            ['data' => 'formated_yearly_amount', 'name' => 'formated_yearly_amount', 'label' => 'Yearly Amount', 'orderBy' => 'asc'],
            ['data' => 'formated_monthly_amount', 'name' => 'formated_monthly_amount', 'label' => 'Monthly Amount', 'orderBy' => 'asc'],
            ['data' => 'promo_url', 'name' => 'promo_url', 'label' => 'Promo URL', 'orderable' => false, 'searchable' => false],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'email_template' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'title', 'name' => 'title', 'label' => 'Title', 'orderBy' => 'asc'],
            ['data' => 'subject', 'name' => 'subject', 'label' => 'Subject', 'orderBy' => 'asc'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'user' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'first_name', 'name' => 'first_name', 'label' => 'First Name', 'orderBy' => 'asc'],
            ['data' => 'last_name', 'name' => 'last_name', 'label' => 'Last Name', 'orderBy' => 'asc'],
            ['data' => 'email', 'name' => 'email', 'label' => 'Email', 'orderBy' => 'asc'],
            ['data' => 'plan_name', 'name' => 'plan_name', 'label' => 'Plan Name', 'orderBy' => 'asc'],
            ['data' => 'subscription_status_name', 'name' => 'subscription_status_name', 'label' => 'Subscription Status', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'document-type' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'uploaded_documents_count', 'name' => 'uploaded_documents_count', 'label' => 'Uploaded Documents', 'searchable' => false, 'orderable' => false],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'document-template' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'document_type_name', 'name' => 'document_type_name', 'label' => 'Document Type', 'orderBy' => 'asc'],
            ['data' => 'template_file_url', 'name' => 'template_file_url', 'label' => 'File', 'searchable' => false, 'orderable' => false],
            ['data' => 'is_popular_status', 'name' => 'is_popular_status', 'label' => 'Is Popular', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    '360-legal-form' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'form_url', 'name' => 'form_url', 'label' => 'Form', 'searchable' => false, 'orderable' => false],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'user-billing-history' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'reference_id', 'name' => 'reference_id', 'label' => 'Transaction ID', 'orderBy' => 'asc'],
            ['data' => 'transaction_date_time', 'name' => 'transaction_date_time', 'label' => 'Transaction Date/Time', 'orderBy' => 'asc'],
            ['data' => 'payment_method', 'name' => 'payment_method', 'label' => 'Payment Method', 'orderBy' => 'asc'],
            ['data' => 'plan_name', 'name' => 'plan_name', 'label' => 'Plan Name', 'orderBy' => 'asc'],
            ['data' => 'plan_amount', 'name' => 'plan_amount', 'label' => 'Plan Amount', 'orderBy' => 'asc'],
            ['data' => 'payment_status', 'name' => 'payment_status', 'label' => 'Payment Status', 'orderBy' => 'asc'],
        ],
        'order' => [[0, 'desc']]
    ],

    'subscription-payment' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'date_billed', 'name' => 'date_billed', 'label' => 'Date Billed', 'orderBy' => 'asc'],
            ['data' => 'date_paid', 'name' => 'date_paid', 'label' => 'Date Paid', 'orderBy' => 'asc'],
            ['data' => 'billing_period', 'name' => 'billing_period', 'label' => 'Billing Period', 'orderable' => false, 'orderBy' => 'asc'],
            ['data' => 'plan_amount', 'name' => 'plan_amount', 'label' => 'Amount', 'orderable' => false, 'orderBy' => 'asc'],
            ['data' => 'payment_status', 'name' => 'payment_status', 'label' => 'Payment Status', 'orderable' => false, 'orderBy' => 'asc'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action'],
        ],
        'order' => [[0, 'desc']]
    ],
    'catalog-category' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'parent_name', 'name' => 'parent_name', 'label' => 'Parent Category', 'orderBy' => 'asc'],
            ['data' => 'type_name', 'name' => 'type_name', 'label' => 'Catalog Type', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'catalog-form' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'category_name', 'name' => 'category_name', 'label' => 'Category', 'orderBy' => 'asc'],
            ['data' => 'form_url', 'name' => 'form_url', 'label' => 'Form', 'searchable' => false, 'orderable' => false],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'tax-type' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'tax-category' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'parent_name', 'name' => 'parent_name', 'label' => 'Parent Category', 'orderBy' => 'asc'],
            ['data' => 'type_name', 'name' => 'type_name', 'label' => 'Tax Type', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'tax-form' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'category_name', 'name' => 'category_name', 'label' => 'Category', 'orderBy' => 'asc'],
            ['data' => 'form_url', 'name' => 'form_url', 'label' => 'Form', 'searchable' => false, 'orderable' => false],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'tax-form-version' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'form_url', 'name' => 'form_url', 'label' => 'Form', 'searchable' => false, 'orderable' => false],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'tax-calendar' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'date', 'name' => 'date', 'label' => 'Date', 'orderBy' => 'asc'],
            ['data' => 'tax_for_name', 'name' => 'tax_for_name', 'label' => 'Tax For', 'orderBy' => 'asc'],
            ['data' => 'form_name', 'name' => 'form_name', 'label' => 'Linked Form', 'searchable' => false, 'orderable' => false],
            ['data' => 'description', 'name' => 'description', 'label' => 'Description', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'usps-request' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'request_by', 'name' => 'request_by', 'label' => 'User', 'orderBy' => 'asc'],
            ['data' => 'from_name', 'name' => 'from_name', 'label' => 'From Name', 'orderBy' => 'asc'],
            ['data' => 'to_name', 'name' => 'to_name', 'label' => 'To Name', 'orderBy' => 'asc'],
            ['data' => 'created_at', 'name' => 'created_at', 'label' => 'Date', 'orderBy' => 'asc'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],
    'usps-request-status' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'mail_status', 'name' => 'mail_status', 'label' => 'Mail Status', 'orderBy' => 'asc'],
            ['data' => 'description', 'name' => 'description', 'label' => 'Description', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Actions']
        ],
        'order' => [[0, 'desc']]
    ],

];
