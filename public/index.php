<?php
declare(strict_types=1);

require __DIR__ . '/../app/bootstrap.php';

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Helpers\Auth;
use App\Helpers\Url;

$method = $_SERVER['REQUEST_METHOD'];
$reqPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$base = Url::base();
$path = $reqPath;
if ($base && str_starts_with($reqPath, $base)) {
    $path = substr($reqPath, strlen($base));
    if ($path === '' || $path === false) {
        $path = '/';
    }
}
$path = ($path !== '/') ? rtrim($path, '/') : $path;

$routes = [
    'GET' => [
        '/' => [HomeController::class, 'index'],
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
