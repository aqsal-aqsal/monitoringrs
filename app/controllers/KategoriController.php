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

    public function create(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $this->render('master/kategori/form', ['title' => 'Tambah Kategori', 'item' => null]);
    }

    public function store(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $nama = trim($_POST['nama_kategori'] ?? '');
        $ket = $_POST['keterangan'] ?? null;
        if ($nama === '') {
            $this->render('master/kategori/form', ['title' => 'Tambah Kategori', 'item' => null, 'error' => 'Nama kategori wajib']);
            return;
        }
        $id = (new KategoriBarang())->create($nama, $ket);
        (new LogAktivitas())->record(Auth::user()['id'], 'kategori.create');
        header('Location: ' . Url::to('/master/kategori'));
        exit;
    }

    public function edit(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $id = (int)($_GET['id'] ?? 0);
        $model = new KategoriBarang();
        $item = $model->findById($id);
        if (!$item) {
            http_response_code(404);
            echo 'Not Found';
            return;
        }
        $this->render('master/kategori/form', ['title' => 'Edit Kategori', 'item' => $item]);
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
}
