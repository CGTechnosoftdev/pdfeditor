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
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
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
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
        ],
        'order' => [[0, 'desc']]
    ],
    'business-category' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
        ],
        'order' => [[0, 'desc']]
    ],
    'top100_forms' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => 'S No.'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
        ],
        'order' => [[0, 'desc']]
    ],

    'forms' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => 'S No.'],
            ['data' => 'name', 'name' => 'name', 'label' => 'Name', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
        ],
        'order' => [[0, 'desc']]
    ],

    'faq' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => 'S No.'],
            ['data' => 'question', 'name' => 'question', 'label' => 'Question', 'orderBy' => 'asc'],
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
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
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
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
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
        ],
        'order' => [[0, 'desc']]
    ],
    'email_template' => [
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'label' => '#'],
            ['data' => 'title', 'name' => 'title', 'label' => 'Title', 'orderBy' => 'asc'],
            ['data' => 'subject', 'name' => 'subject', 'label' => 'Subject', 'orderBy' => 'asc'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
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
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
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
            ['data' => 'status', 'name' => 'status', 'label' => 'Status', 'orderable' => false],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'label' => 'Action']
        ],
        'order' => [[0, 'desc']]
    ],
];
