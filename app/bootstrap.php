<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    $prefixes = [
        'App\\Controllers\\' => __DIR__ . '/controllers/',
        'App\\Models\\' => __DIR__ . '/models/',
        'App\\Middleware\\' => __DIR__ . '/middleware/',
        'App\\Helpers\\' => __DIR__ . '/helpers/',
        'Config\\' => __DIR__ . '/../config/',
    ];
    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }
        $relativeClass = substr($class, $len);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        if (is_file($file)) {
            require $file;
            return;
        }
    }
});
