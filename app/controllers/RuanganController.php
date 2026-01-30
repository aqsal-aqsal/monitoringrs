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

    public function store(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $nama = trim($_POST['nama_ruangan'] ?? '');
        $gedung = $_POST['gedung'] ?? null;
        $lantai = $_POST['lantai'] ?? null;
        
        if ($nama === '') {
            // TODO: Handle error nicely
            header('Location: ' . Url::to('/master/ruangan'));
            exit;
        }

        (new Ruangan())->create($nama, $gedung, $lantai);
        (new LogAktivitas())->record(Auth::user()['id'], 'ruangan.create');
        header('Location: ' . Url::to('/master/ruangan'));
        exit;
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

    public function delete(): void
    {
        AuthMiddleware::requireRole(['ADMIN']);
        $id = (int)($_POST['id'] ?? 0);
        (new Ruangan())->delete($id);
        (new LogAktivitas())->record(Auth::user()['id'], 'ruangan.delete');
        header('Location: ' . Url::to('/master/ruangan'));
        exit;
    }
}
