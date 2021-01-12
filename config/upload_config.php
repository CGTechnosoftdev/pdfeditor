<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Upload config
    |--------------------------------------------------------------------------
    |
    | Upload config is here to decide the upload location and other config of different files all  | over site.
    */
    //form_file
    'profile_picture' => [
        'label' => 'Profile Picture',
        'file_input' => 'profile_picture',
        'disk' => 'public',
        'folder' => 'profile_picture',
        'delete_previous' => true,
        'multiple' => false,
        'placeholder' => 'default-user-picture.png',
        'new_file_name' => 'orignal_with_random',
        'allowed_extention' => 'jpg,jpeg,png,svg,gif',
        'max_allowed_size' => '2000'
    ],
    'form_file' => [
        'label' => 'Form File',
        'file_input' => 'form_file',
        'disk' => 'public',
        'folder' => 'form_file',
        'delete_previous' => true,
        'multiple' => false,
        'new_file_name' => 'orignal_with_random',
        'allowed_extention' => 'pdf',
        'max_allowed_size' => '2000'
    ],
    'template_file' => [
        'label' => 'Template File',
        'file_input' => 'template_file',
        'disk' => 'public',
        'folder' => 'template_file',
        'delete_previous' => true,
        'multiple' => false,
        'new_file_name' => 'orignal_with_random',
        'allowed_extention' => 'pdf',
        'max_allowed_size' => '2000'
    ],
    '360_legal_form' => [
        'label' => 'Form',
        'file_input' => 'form',
        'disk' => 'public',
        'folder' => '360_legal_form',
        'delete_previous' => true,
        'multiple' => false,
        'new_file_name' => 'orignal_with_random',
        'allowed_extention' => 'pdf',
        'max_allowed_size' => '2000'
    ],
    'catalog_form' => [
        'label' => 'Form',
        'file_input' => 'form',
        'disk' => 'public',
        'folder' => 'catalog_form',
        'delete_previous' => true,
        'multiple' => false,
        'new_file_name' => 'orignal_with_random',
        'allowed_extention' => 'pdf',
        'max_allowed_size' => '2000'
    ],
    'tax_form' => [
        'label' => 'Form',
        'file_input' => 'form',
        'disk' => 'public',
        'folder' => 'tax_form',
        'delete_previous' => true,
        'multiple' => false,
        'new_file_name' => 'orignal_with_random',
        'allowed_extention' => 'pdf',
        'max_allowed_size' => '2000'
    ],
    'user_document' => [
        'label' => 'Template',
        'file_input' => 'file',
        'disk' => 'public',
        'folder' => 'user_document',
        'delete_previous' => true,
        'multiple' => false,
        'new_file_name' => 'orignal_with_random',
        'allowed_extention' => 'pdf',
        'max_allowed_size' => '2000'
    ],
    'link_to_fill_invitation_logo' => [
        'label' => 'Template',
        'file_input' => 'logo',
        'disk' => 'public',
        'folder' => 'link_to_fill',
        'delete_previous' => true,
        'multiple' => false,
        'new_file_name' => 'orignal_with_random',
        'allowed_extention' => 'png,jpg,jpeg',
        'max_allowed_size' => '2000'
    ],
    'link_to_fill_business_card_image' => [
        'label' => 'Template',
        'file_input' => 'logo',
        'disk' => 'public',
        'folder' => 'link_to_fill',
        'delete_previous' => true,
        'multiple' => false,
        'new_file_name' => 'orignal_with_random',
        'allowed_extention' => 'png,jpg,jpeg',
        'max_allowed_size' => '2000'
    ],
    'business_card_picture' => [
        'label' => 'Business Card Picture',
        'file_input' => 'business_card_picture',
        'disk' => 'public',
        'folder' => 'business_card_picture',
        'delete_previous' => true,
        'multiple' => false,
        'new_file_name' => 'orignal',
        'allowed_extention' => 'jpg,jpeg,png,svg,gif',
        'max_allowed_size' => '2000'
    ],
    'own_logo' => [
        'label' => 'Own Logo',
        'file_input' => 'own_logo',
        'disk' => 'public',
        'folder' => 'business_card_picture',
        'delete_previous' => true,
        'multiple' => false,
        'new_file_name' => 'orignal',
        'allowed_extention' => 'jpg,jpeg,png,svg,gif',
        'max_allowed_size' => '2000'
    ],

    'upload_types' => 'file_attachment'
];
