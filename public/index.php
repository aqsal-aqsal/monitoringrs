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
        '/laporan/saya' => [LaporanController::class, 'my'],
        '/laporan/create' => [LaporanController::class, 'create'],
        '/laporan/admin' => [LaporanController::class, 'adminIndex'],
        '/maintenance' => [MaintenanceController::class, 'index'],
        '/maintenance/schedule' => [MaintenanceController::class, 'scheduleForm'],
    ],
    'POST' => [
        '/login' => [AuthController::class, 'login'],
        '/master/kategori/store' => [KategoriController::class, 'store'],
        '/master/kategori/update' => [KategoriController::class, 'update'],
        '/master/ruangan/store' => [RuanganController::class, 'store'],
        '/master/ruangan/update' => [RuanganController::class, 'update'],
        '/master/barang/store' => [BarangController::class, 'store'],
        '/master/barang/update' => [BarangController::class, 'update'],
        '/laporan/store' => [LaporanController::class, 'store'],
        '/laporan/update_status' => [LaporanController::class, 'updateStatus'],
        '/maintenance/store' => [MaintenanceController::class, 'scheduleStore'],
        '/maintenance/update' => [MaintenanceController::class, 'updateResult'],
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
