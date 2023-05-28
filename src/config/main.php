<?php
//Autoload
spl_autoload_register(function ($class) {
    $base_dir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
    $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});


use application\components\request\Rest;
use application\components\router\Router;

return [
    'components' => [
        'request' => [
            'class' => Rest::class
        ],
        'router' => [
            'class' => Router::class,
            'routes' => [
                'test/route' => [
                    'class' => Someclass::class,
                    'method' => 'testShow'
                ]
            ]
        ]
    ]

];
