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
    		['data'=>'DT_RowIndex', 'name'=> 'DT_RowIndex', 'orderable'=> false,'searchable'=> false,'label'=>'S No.'],
    		['data'=>'name', 'name'=> 'name','label'=>'Name','orderBy'=>'asc'],
    		['data'=>'status', 'name'=> 'status','label'=>'Status','orderable'=> false],
    		['data'=>'action', 'name'=> 'action', 'orderable'=> false,'label'=>'Action']
    	],
    	'order'=>[[1,'asc']]
    ],
];
