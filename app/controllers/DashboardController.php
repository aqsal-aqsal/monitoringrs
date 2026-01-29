<?php
namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\Stats;

class DashboardController extends BaseController
{
    protected string $layout = 'dashboard';

    public function index(): void
    {
        AuthMiddleware::requireAuth();
        $statsModel = new Stats();

        $totalBarang = $statsModel->totalBarang();
        $totalRusak = $statsModel->totalRusak();
        $totalMaintenance = $statsModel->totalMaintenance();
        $totalLaporanBaru = $statsModel->totalLaporanBaru();

        $this->render('dashboard/index', [
            'stats' => [
                'barang' => $totalBarang,
                'rusak' => $totalRusak,
                'maintenance' => $totalMaintenance,
                'laporanBaru' => $totalLaporanBaru,
            ],
        ]);
    }
}
