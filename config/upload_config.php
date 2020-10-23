<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Upload config
    |--------------------------------------------------------------------------
    |
    | Upload config is here to decide the upload location and other config of different files all  | over site.
    */
    'profile_picture' => [
        'label'=>'Profile Picture',
        'file_input' => 'profile_picture',
        'disk' => 'public',
        'folder' => 'profile_picture',
        'delete_previous' => true,
        'multiple' => false,
        'placeholder' => 'default-user-picture.png',
        'new_file_name'=>'orignal_with_random',
        'allowed_extention' => 'jpg,jpeg,png,svg,gif',
        'max_allowed_size' => '2000'
    ],
    'upload_types' => 'file_attachment'
];
