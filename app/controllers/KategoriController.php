<?php
namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Helpers\Auth;
use App\Helpers\Url;
use App\Models\KategoriBarang;
use App\Models\LogAktivitas;

class KategoriController extends BaseController
{
    protected string $layout = 'dashboard';

    public function index(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $model = new KategoriBarang();
        $list = $model->all();
        $this->render('master/kategori/index', ['items' => $list, 'title' => 'Kategori Barang']);
    }

    public function store(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $nama = trim($_POST['nama_kategori'] ?? '');
        $ket = $_POST['keterangan'] ?? null;
        if ($nama === '') {
            // TODO: Handle error nicely
            header('Location: ' . Url::to('/master/kategori'));
            exit;
        }
        (new KategoriBarang())->create($nama, $ket);
        (new LogAktivitas())->record(Auth::user()['id'], 'kategori.create');
        header('Location: ' . Url::to('/master/kategori'));
        exit;
    }

    public function update(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $id = (int)($_POST['id'] ?? 0);
        $nama = trim($_POST['nama_kategori'] ?? '');
        $ket = $_POST['keterangan'] ?? null;
        (new KategoriBarang())->updateById($id, $nama, $ket);
        (new LogAktivitas())->record(Auth::user()['id'], 'kategori.update');
        header('Location: ' . Url::to('/master/kategori'));
        exit;
    }

    public function delete(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $id = (int)($_POST['id'] ?? 0);
        (new KategoriBarang())->delete($id);
        (new LogAktivitas())->record(Auth::user()['id'], 'kategori.delete');
        header('Location: ' . Url::to('/master/kategori'));
        exit;
    }
}
