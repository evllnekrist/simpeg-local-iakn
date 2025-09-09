<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],
    
    'pengajuan' => [
        'file_upload_limit_mb' => 5,
        'file_upload_allow_mime' => array(
            'application/pdf',
            'application/octet-stream'
        ),
        'file_upload_instruct_org' => 'File, format PDF, max 5 MB',
        'file_upload_instruct_scan' => 'Scan/foto, format PDF, max 5 MB'
    ],

    'accept_mimes' => array(
        'img' => array('image/png','image/jpg','image/jpeg','image/webp','image/heic','image/heif'),
        'doc' => array(
            'application/pdf',
            'application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/excel','application/vnd.ms-excel','application/x-excel','application/x-msexcel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/csv',
            'application/mspowerpoint','application/powerpoint','application/vnd.ms-powerpoint','application/x-mspowerpoint','application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ),
    ),
    
    'accept_extensions' => array(
        'img' => array('.png','.jpg','.jpeg','.jfif','.webp','.heic','.heif'),
        'doc' => array('.pdf','.doc','.docx','.xls','.xlsx','.csv','.ppt','.pptx'), 
    ),

    'file_indexes' =>['img_main', 'file_main', 'img_specimen'],

];
