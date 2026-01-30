<?php
namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Helpers\Auth;
use App\Helpers\Url;
use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Ruangan;
use App\Models\LogAktivitas;

class BarangController extends BaseController
{
    protected string $layout = 'dashboard';

    public function index(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $model = new Barang();
        $list = $model->getAll();
        $kats = (new KategoriBarang())->all();
        $ruangs = (new Ruangan())->all();
        $this->render('master/barang/index', [
            'items' => $list, 
            'title' => 'Barang',
            'kats' => $kats,
            'ruangs' => $ruangs
        ]);
    }

    public function store(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $data = [
            'kode_barang' => $_POST['kode_barang'] ?? '',
            'nama_barang' => $_POST['nama_barang'] ?? '',
            'id_kategori' => (int)($_POST['id_kategori'] ?? 0),
            'id_ruangan' => (int)($_POST['id_ruangan'] ?? 0),
            'merk' => $_POST['merk'] ?? null,
            'tahun_pengadaan' => $_POST['tahun_pengadaan'] ?? null,
            'nilai_aset' => $_POST['nilai_aset'] ?? null,
            'status_barang' => $_POST['status_barang'] ?? 'baik',
        ];
        
        if (empty($data['kode_barang']) || empty($data['nama_barang'])) {
             // TODO: Handle error nicely
             header('Location: ' . Url::to('/master/barang'));
             exit;
        }

        (new Barang())->create($data);
        (new LogAktivitas())->record(Auth::user()['id'], 'barang.create');
        header('Location: ' . Url::to('/master/barang'));
        exit;
    }

    public function update(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $id = (int)($_POST['id'] ?? 0);
        $data = [
            'kode_barang' => $_POST['kode_barang'] ?? '',
            'nama_barang' => $_POST['nama_barang'] ?? '',
            'id_kategori' => (int)($_POST['id_kategori'] ?? 0),
            'id_ruangan' => (int)($_POST['id_ruangan'] ?? 0),
            'merk' => $_POST['merk'] ?? null,
            'tahun_pengadaan' => $_POST['tahun_pengadaan'] ?? null,
            'nilai_aset' => $_POST['nilai_aset'] ?? null,
            'status_barang' => $_POST['status_barang'] ?? 'baik',
        ];
        (new Barang())->updateById($id, $data);
        (new LogAktivitas())->record(Auth::user()['id'], 'barang.update');
        header('Location: ' . Url::to('/master/barang'));
        exit;
    }

    public function delete(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $id = (int)($_POST['id'] ?? 0);
        (new Barang())->delete($id);
        (new LogAktivitas())->record(Auth::user()['id'], 'barang.delete');
        header('Location: ' . Url::to('/master/barang'));
        exit;
    }
}
