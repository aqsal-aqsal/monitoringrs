<?php
namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\Stats;
use App\Models\LaporanKerusakan;

class DashboardController extends BaseController
{
    protected string $layout = 'dashboard';

    public function index(): void
    {
        AuthMiddleware::requireAuth();
        $statsModel = new Stats();
        $laporanModel = new LaporanKerusakan();

        $totalBarang = $statsModel->totalBarang();
        $totalRusak = $statsModel->totalRusak();
        $totalMaintenance = $statsModel->totalMaintenance();
        $totalLaporanBaru = $statsModel->totalLaporanBaru();
        $recentLaporan = $laporanModel->getRecent(5);

        $this->render('dashboard/index', [
            'stats' => [
                'barang' => $totalBarang,
                'rusak' => $totalRusak,
                'maintenance' => $totalMaintenance,
                'laporanBaru' => $totalLaporanBaru,
            ],
            'recentLaporan' => $recentLaporan
        ]);
    }
}
