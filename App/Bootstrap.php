<?php

require_once __DIR__ . '/Config/Config.php';
require_once __DIR__ . '/Helpers/Debug.php';
require_once __DIR__ . '/Helpers/Token.php';
require_once __DIR__ . '/Helpers/Secure.php';
require_once __DIR__ . '/Helpers/Session.php';

//AUTO LOADER
spl_autoload_register(function ($className) {
    $directories = [
        __DIR__ . '/Controllers',
        __DIR__ . '/Core',
        __DIR__ . '/Models',
    ];

    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    foreach ($directories as $directory) {
        $file = $directory . DIRECTORY_SEPARATOR . $classPath;
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});