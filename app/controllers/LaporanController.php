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
        
        // Load Barangs for Modal
        $barangs = (new Barang())->getAll(); // Use getAll to get details if needed, or just all()

        $this->render('laporan/index', [
            'items' => $list, 
            'title' => 'Laporan Saya',
            'barangs' => $barangs
        ]);
    }

    public function store(): void
    {
        AuthMiddleware::requireRole(['PETUGAS_RUANGAN', 'ADMIN']); // Admin also might want to report? Default: Petugas
        $barangId = (int)($_POST['id_barang'] ?? 0);
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        
        if ($barangId === 0 || empty($deskripsi)) {
            header('Location: ' . Url::to('/laporan/saya'));
            exit;
        }

        $u = Auth::user();
        (new LaporanKerusakan())->create($barangId, (int)$u['id'], $deskripsi);
        (new LogAktivitas())->record((int)$u['id'], 'laporan.create');
        header('Location: ' . Url::to('/laporan/saya'));
        exit;
    }

    public function adminIndex(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $model = new LaporanKerusakan();
        $list = $model->getAll();
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

    public function delete(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            (new LaporanKerusakan())->delete($id);
            (new LogAktivitas())->record(Auth::user()['id'], 'laporan.delete');
        }
        header('Location: ' . Url::to('/laporan/admin'));
        exit;
    }
}
