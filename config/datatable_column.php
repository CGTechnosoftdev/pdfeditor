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
    	'order'=>[[1,'asc']]
    ],
    'sub-admin' => [
        'columns'=>[
            ['data'=>'id', 'name'=> 'id', 'visible'=> false,'searchable'=> false],
            ['data'=>'DT_RowIndex', 'name'=> 'DT_RowIndex', 'orderable'=> false,'searchable'=> false,'label'=>'#'],
            ['data'=>'first_name', 'name'=> 'first_name','label'=>'First Name','orderBy'=>'asc'],
            ['data'=>'last_name', 'name'=> 'last_name','label'=>'Last Name','orderBy'=>'asc'],
            ['data'=>'model_has_role.role.name', 'name'=> 'model_has_role.role.name','label'=>'Role','orderBy'=>'asc'],
            ['data'=>'contact_number', 'name'=> 'contact_number','label'=>'Phone Number','orderBy'=>'asc'],
            ['data'=>'status', 'name'=> 'status','label'=>'Status','orderable'=> false],
            ['data'=>'action', 'name'=> 'action', 'orderable'=> false,'label'=>'Action']
        ],
        'order'=>[[1,'asc']]
    ],
    'business-category' => [
    	'columns'=>[
    		['data'=>'id', 'name'=> 'id', 'visible'=> false,'searchable'=> false],
    		['data'=>'DT_RowIndex', 'name'=> 'DT_RowIndex', 'orderable'=> false,'searchable'=> false,'label'=>'#'],
    		['data'=>'name', 'name'=> 'name','label'=>'Name','orderBy'=>'asc'],
    		['data'=>'status', 'name'=> 'status','label'=>'Status','orderable'=> false],
    		['data'=>'action', 'name'=> 'action', 'orderable'=> false,'label'=>'Action']
    	],
    	'order'=>[[1,'asc']]
    ],
];
