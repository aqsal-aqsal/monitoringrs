<?php
namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Helpers\Auth;
use App\Helpers\Url;
use App\Models\Ruangan;
use App\Models\LogAktivitas;

class RuanganController extends BaseController
{
    protected string $layout = 'dashboard';

    public function index(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $model = new Ruangan();
        $this->render('master/ruangan/index', ['items' => $model->all(), 'title' => 'Ruangan']);
    }

    public function create(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $this->render('master/ruangan/form', ['title' => 'Tambah Ruangan', 'item' => null]);
    }

    public function store(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $nama = trim($_POST['nama_ruangan'] ?? '');
        $gedung = $_POST['gedung'] ?? null;
        $lantai = $_POST['lantai'] ?? null;
        (new Ruangan())->create($nama, $gedung, $lantai);
        (new LogAktivitas())->record(Auth::user()['id'], 'ruangan.create');
        header('Location: ' . Url::to('/master/ruangan'));
        exit;
    }

    public function edit(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $id = (int)($_GET['id'] ?? 0);
        $model = new Ruangan();
        $item = $model->findById($id);
        if (!$item) {
            http_response_code(404);
            echo 'Not Found';
            return;
        }
        $this->render('master/ruangan/form', ['title' => 'Edit Ruangan', 'item' => $item]);
    }

    public function update(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $id = (int)($_POST['id'] ?? 0);
        $nama = trim($_POST['nama_ruangan'] ?? '');
        $gedung = $_POST['gedung'] ?? null;
        $lantai = $_POST['lantai'] ?? null;
        (new Ruangan())->updateById($id, $nama, $gedung, $lantai);
        (new LogAktivitas())->record(Auth::user()['id'], 'ruangan.update');
        header('Location: ' . Url::to('/master/ruangan'));
        exit;
    }
}
