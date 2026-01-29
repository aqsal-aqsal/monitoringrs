<?php
declare(strict_types=1);

session_start();

spl_autoload_register(function ($class) {
    $prefixes = [
        'App\\Controllers\\' => __DIR__ . '/../app/controllers/',
        'App\\Models\\' => __DIR__ . '/../app/models/',
        'App\\Middleware\\' => __DIR__ . '/../app/middleware/',
        'App\\Helpers\\' => __DIR__ . '/../app/helpers/',
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

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Helpers\Auth;

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';

$routes = [
    'GET' => [
        '/' => function () {
            if (Auth::check()) {
                header('Location: /dashboard');
            } else {
                header('Location: /login');
            }
            exit;
        },
        '/login' => [AuthController::class, 'login'],
        '/logout' => [AuthController::class, 'logout'],
        '/dashboard' => [DashboardController::class, 'index'],
    ],
    'POST' => [
        '/login' => [AuthController::class, 'login'],
    ],
];

if (!isset($routes[$method][$path])) {
    http_response_code(404);
    echo 'Not Found';
    exit;
}

$handler = $routes[$method][$path];
if (is_array($handler)) {
    [$controllerClass, $action] = $handler;
    $controller = new $controllerClass();
    $controller->$action();
    exit;
}

if (is_callable($handler)) {
    $handler();
    exit;
}

http_response_code(500);
echo 'Invalid route';
