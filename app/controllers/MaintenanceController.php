<?php
namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Helpers\Auth;
use App\Helpers\Url;
use App\Models\Maintenance;
use App\Models\Barang;
use App\Models\LogAktivitas;

class MaintenanceController extends BaseController
{
    protected string $layout = 'dashboard';

    public function index(): void
    {
        AuthMiddleware::requireRole(['ADMIN', 'TEKNISI']);
        $list = (new Maintenance())->all();
        $this->render('maintenance/index', ['items' => $list, 'title' => 'Maintenance']);
    }

    public function scheduleForm(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $barangs = (new Barang())->all();
        $this->render('maintenance/schedule', ['title' => 'Jadwalkan Maintenance', 'barangs' => $barangs]);
    }

    public function scheduleStore(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $barangId = (int)($_POST['id_barang'] ?? 0);
        $tanggal = $_POST['tanggal_jadwal'] ?? date('Y-m-d');
        $teknisi = $_POST['teknisi'] ?? 'Teknisi';
        (new Maintenance())->schedule($barangId, $tanggal, $teknisi);
        (new LogAktivitas())->record(Auth::user()['id'], 'maintenance.schedule');
        header('Location: ' . Url::to('/maintenance'));
        exit;
    }

    public function updateResult(): void
    {
        AuthMiddleware::requireRole(['TEKNISI']);
        $id = (int)($_POST['id'] ?? 0);
        $hasil = $_POST['hasil'] ?? null;
        $status = $_POST['status'] ?? 'selesai';
        $tanggal = $_POST['tanggal_realisasi'] ?? date('Y-m-d');
        (new Maintenance())->updateResult($id, $hasil, $status, $tanggal);
        (new LogAktivitas())->record(Auth::user()['id'], 'maintenance.update');
        header('Location: ' . Url::to('/maintenance'));
        exit;
    }
}
