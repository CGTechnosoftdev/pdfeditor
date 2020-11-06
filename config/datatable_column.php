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
    	'columns'=>[
    		['data'=>'id', 'name'=> 'id', 'visible'=> false,'searchable'=> false],
    		['data'=>'DT_RowIndex', 'name'=> 'DT_RowIndex', 'orderable'=> false,'searchable'=> false,'label'=>'#'],
    		['data'=>'name', 'name'=> 'name','label'=>'Name','orderBy'=>'asc'],
    		['data'=>'status', 'name'=> 'status','label'=>'Status','orderable'=> false],
    		['data'=>'action', 'name'=> 'action', 'orderable'=> false,'label'=>'Action']
    	],
    	'order'=>[[0,'desc']]
    ],
    'sub-admin' => [
        'columns'=>[
            ['data'=>'id', 'name'=> 'id', 'visible'=> false,'searchable'=> false],
            ['data'=>'DT_RowIndex', 'name'=> 'DT_RowIndex', 'orderable'=> false,'searchable'=> false,'label'=>'#'],
            ['data'=>'first_name', 'name'=> 'first_name','label'=>'First Name','orderBy'=>'asc'],
            ['data'=>'last_name', 'name'=> 'last_name','label'=>'Last Name','orderBy'=>'asc'],
            ['data'=>'role_name', 'name'=> 'role_name','label'=>'Role','orderBy'=>'asc'],
            ['data'=>'gender_name', 'name'=> 'gender_name','label'=>'Gender','orderBy'=>'asc'],
            ['data'=>'contact_number', 'name'=> 'contact_number','label'=>'Phone Number','orderBy'=>'asc'],
            ['data'=>'status', 'name'=> 'status','label'=>'Status','orderable'=> false],
            ['data'=>'action', 'name'=> 'action', 'orderable'=> false,'label'=>'Action']
        ],
        'order'=>[[0,'desc']]
    ],
    'business-category' => [
    	'columns'=>[
    		['data'=>'id', 'name'=> 'id', 'visible'=> false,'searchable'=> false],
    		['data'=>'DT_RowIndex', 'name'=> 'DT_RowIndex', 'orderable'=> false,'searchable'=> false,'label'=>'#'],
    		['data'=>'name', 'name'=> 'name','label'=>'Name','orderBy'=>'asc'],
    		['data'=>'status', 'name'=> 'status','label'=>'Status','orderable'=> false],
    		['data'=>'action', 'name'=> 'action', 'orderable'=> false,'label'=>'Action']
    	],
    	'order'=>[[0,'desc']]
    ],
    'top100_forms' => [
    	'columns'=>[
    		['data'=>'id', 'name'=> 'id', 'visible'=> false,'searchable'=> false],
    		['data'=>'DT_RowIndex', 'name'=> 'DT_RowIndex', 'orderable'=> false,'searchable'=> false,'label'=>'S No.'],
    		['data'=>'name', 'name'=> 'name','label'=>'Name','orderBy'=>'asc'],
    		['data'=>'status', 'name'=> 'status','label'=>'Status','orderable'=> false],
    		['data'=>'action', 'name'=> 'action', 'orderable'=> false,'label'=>'Action']
    	],
    	'order'=>[[0,'desc']]
    ],
    
    'forms' => [
    	'columns'=>[
    		['data'=>'id', 'name'=> 'id', 'visible'=> false,'searchable'=> false],
    		['data'=>'DT_RowIndex', 'name'=> 'DT_RowIndex', 'orderable'=> false,'searchable'=> false,'label'=>'S No.'],
    		['data'=>'name', 'name'=> 'name','label'=>'Name','orderBy'=>'asc'],
    		['data'=>'status', 'name'=> 'status','label'=>'Status','orderable'=> false],
    		['data'=>'action', 'name'=> 'action', 'orderable'=> false,'label'=>'Action']
    	],
    	'order'=>[[0,'desc']]
    ],
    
    'faq' => [
    	'columns'=>[
    		['data'=>'id', 'name'=> 'id', 'visible'=> false,'searchable'=> false],
    		['data'=>'DT_RowIndex', 'name'=> 'DT_RowIndex', 'orderable'=> false,'searchable'=> false,'label'=>'S No.'],
    		['data'=>'question', 'name'=> 'question','label'=>'Question','orderBy'=>'asc'],
    		['data'=>'status', 'name'=> 'status','label'=>'Status','orderable'=> false],
    		['data'=>'action', 'name'=> 'action', 'orderable'=> false,'label'=>'Action']
    	],
    	'order'=>[[0,'desc']]
    ],
];
