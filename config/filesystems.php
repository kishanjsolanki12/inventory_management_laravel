<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'local-out' => [
            'driver' => 'local',
            'root' => storage_path('app/out'),
        ],
        'local-stock-picture' => [
            'driver' => 'local',
            'root' => storage_path('app/stock_picture'),
        ],
        
        'local-xml' => [
            'driver' => 'local',
            'root' => public_path('XML'),
        ],
        'local-stock-report' => [
            'driver' => 'local',
            'root' => storage_path('app/stock_report'),
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],
        'ftp' => [
                'driver' => 'ftp',
                'host' => 'ftp.stackcp.com',
                'username' => 'order-hub-2.com',
                'password' => '1d38896b830f',

                // Optional FTP Settings...
                // 'port' => 21,
                 'root' => '/public/in',
                // 'passive' => true,
                // 'ssl' => true,
                // 'timeout' => 30,
            ],
             'ftp-out' => [
                'driver' => 'ftp',
                'host' => 'ftp.stackcp.com',
                'username' => 'order-hub-2.com',
                'password' => '1d38896b830f',

                // Optional FTP Settings...
                // 'port' => 21,
                 'root' => '/public/out',
                // 'passive' => true,
                // 'ssl' => true,
                // 'timeout' => 30,
            ],
            
            'remote-sftp' => [
                'driver' => 'sftp',
                'host' => '52.232.76.29',
                'port' => 22,
                'username' => 'ylbx.displayplan.tst',
                'password' => 'hSD15pg5uB',
                'visibility' => 'public', // set to public to use permPublic, or private to use permPrivate
                'permPublic' => 0755, // whatever you want the public permission is, avoid 0777
                'root' => '/home/ylbx.displayplan.tst',
                'timeout' => 30,
                'directoryPerm' => 0755, // whatever you want
            ],
            'remote-sftp-out' => [
                'driver' => 'sftp',
                'host' => '52.232.76.29',
                'port' => 22,
                'username' => 'ylbx.displayplan.tst',
                'password' => 'hSD15pg5uB',
                'visibility' => 'public', // set to public to use permPublic, or private to use permPrivate
                'permPublic' => 0755, // whatever you want the public permission is, avoid 0777
                'root' => '/home/ylbx.displayplan.tst/out',
                'timeout' => 30,
                'directoryPerm' => 0755, // whatever you want
            ],
            'access-ftp' => [
                'driver' => 'ftp',
                'host' => 'tb.displayplan.com',
                'port' => '990',
                'username' => 'orderhub',
                'password' => 'YxhNrW9u7ZUqbRkW',
                'visibility' => 'public', // set to public to use permPublic, or private to use permPrivate
                'permPublic' => 0755, // whatever you want the public permission is, avoid 0777
                'root' => '/',
                'timeout' => 90,
                'directoryPerm' => 0755, // whatever you want
                'ssl' => false,
            ],
            /*'remote-sftp' => [
                'driver' => 'sftp',
                'host' => '52.178.116.98',
                'port' => 22,
                'username' => 'ylbx.displayplan.prd',
                'password' => 'DZpgixd14U',
                'visibility' => 'public', // set to public to use permPublic, or private to use permPrivate
                'permPublic' => 0755, // whatever you want the public permission is, avoid 0777
                'root' => '/home/ylbx.displayplan.prd',
                'timeout' => 30,
                'directoryPerm' => 0755, // whatever you want
            ],*/
           'sftp-out' => [
            'driver' => 'sftp',
            'host' => '52.178.116.98',
            'port' => 22,
            'username' => 'ylbx.displayplan.prd',
            'password' => 'DZpgixd14U',
            //'privateKey' => 'path/to/or/contents/of/privatekey',
            'root' => '/home/ylbx.displayplan.prd/out',
            'permPublic' => 0766, /// <- this one did the trick
            'visibility' => 'public',
            //'timeout' => 30,
            'directoryPerm' => 0755, // whatever you want
        ]
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
        public_path('product_images') => storage_path('app/product_images'),
    ],

];
