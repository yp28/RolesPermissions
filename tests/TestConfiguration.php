<?php return [
    'modules' => [
        'RolesPermissions',
    ],
    'module_listener_options' => [
        'config_glob_paths' => [
            __DIR__.'/testing.config.php',
        ],
        'module_paths' => [
            'RolesPermissions' => __DIR__.'/../../RolesPermissions/',
        ],
    ],
];
