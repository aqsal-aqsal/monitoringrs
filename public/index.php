<?php
declare(strict_types=1);

require __DIR__ . '/../app/bootstrap.php';

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\KategoriController;
use App\Controllers\RuanganController;
use App\Controllers\BarangController;
use App\Controllers\LaporanController;
use App\Controllers\MaintenanceController;
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
        '/master/kategori' => [KategoriController::class, 'index'],
        '/master/kategori/create' => [KategoriController::class, 'create'],
        '/master/kategori/edit' => [KategoriController::class, 'edit'],
        '/master/ruangan' => [RuanganController::class, 'index'],
        '/master/ruangan/create' => [RuanganController::class, 'create'],
        '/master/ruangan/edit' => [RuanganController::class, 'edit'],
        '/master/barang' => [BarangController::class, 'index'],
        '/master/barang/create' => [BarangController::class, 'create'],
        '/master/barang/edit' => [BarangController::class, 'edit'],
        '/master/users' => [\App\Controllers\UserController::class, 'index'],
        '/laporan/saya' => [\App\Controllers\LaporanController::class, 'my'],
        '/laporan/admin' => [\App\Controllers\LaporanController::class, 'adminIndex'],
        '/maintenance' => [\App\Controllers\MaintenanceController::class, 'index'],
    ],
    'POST' => [
        '/login' => [AuthController::class, 'login'],
        '/master/kategori/store' => [KategoriController::class, 'store'],
        '/master/kategori/update' => [KategoriController::class, 'update'],
        '/master/kategori/delete' => [KategoriController::class, 'delete'],
        '/master/ruangan/store' => [RuanganController::class, 'store'],
        '/master/ruangan/update' => [RuanganController::class, 'update'],
        '/master/ruangan/delete' => [RuanganController::class, 'delete'],
        '/master/barang/store' => [BarangController::class, 'store'],
        '/master/barang/update' => [BarangController::class, 'update'],
        '/master/barang/delete' => [BarangController::class, 'delete'],
        '/master/users/store' => [\App\Controllers\UserController::class, 'store'],
        '/master/users/update' => [\App\Controllers\UserController::class, 'update'],
        '/master/users/delete' => [\App\Controllers\UserController::class, 'delete'],
        '/laporan/store' => [\App\Controllers\LaporanController::class, 'store'],
        '/laporan/update_status' => [\App\Controllers\LaporanController::class, 'updateStatus'],
        '/laporan/delete' => [\App\Controllers\LaporanController::class, 'delete'],
        '/maintenance/store' => [\App\Controllers\MaintenanceController::class, 'scheduleStore'],
        '/maintenance/update' => [\App\Controllers\MaintenanceController::class, 'updateResult'],
        '/maintenance/delete' => [\App\Controllers\MaintenanceController::class, 'delete'],
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
