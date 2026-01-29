<?php
namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Helpers\Auth;
use App\Helpers\Url;
use App\Models\Barang;
use App\Models\LaporanKerusakan;
use App\Models\LogAktivitas;

class LaporanController extends BaseController
{
    protected string $layout = 'dashboard';

    public function my(): void
    {
        AuthMiddleware::requireRole(['PETUGAS_RUANGAN', 'ADMIN']);
        $u = Auth::user();
        $model = new LaporanKerusakan();
        $list = $model->byUser((int)$u['id']);
        $this->render('laporan/index', ['items' => $list, 'title' => 'Laporan Saya']);
    }

    public function create(): void
    {
        AuthMiddleware::requireRole(['PETUGAS_RUANGAN']);
        $barangs = (new Barang())->all();
        $this->render('laporan/form', ['title' => 'Lapor Kerusakan', 'barangs' => $barangs]);
    }

    public function store(): void
    {
        AuthMiddleware::requireRole(['PETUGAS_RUANGAN']);
        $barangId = (int)($_POST['id_barang'] ?? 0);
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $u = Auth::user();
        $id = (new LaporanKerusakan())->create($barangId, (int)$u['id'], $deskripsi);
        (new LogAktivitas())->record((int)$u['id'], 'laporan.create');
        header('Location: ' . Url::to('/laporan/saya'));
        exit;
    }

    public function adminIndex(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $model = new LaporanKerusakan();
        $list = $model->all();
        $this->render('laporan/admin', ['items' => $list, 'title' => 'Laporan Kerusakan']);
    }

    public function updateStatus(): void
    {
        AuthMiddleware::requireRole(['ADMIN', 'TEKNISI']);
        $id = (int)($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? 'diproses';
        (new LaporanKerusakan())->updateStatus($id, $status);
        (new LogAktivitas())->record(Auth::user()['id'], 'laporan.update_status');
        header('Location: ' . Url::to('/laporan/admin'));
        exit;
    }
}
