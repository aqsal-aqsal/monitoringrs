<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Ruangan;
use App\Helpers\Auth;
use App\Helpers\Url;
use App\Helpers\AuthMiddleware;

class UserController extends BaseController
{
    protected string $layout = 'dashboard';
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    private function ensureAdmin(): void
    {
        if (!Auth::check()) {
            header('Location: ' . Url::to('/login'));
            exit;
        }
        $user = Auth::user();
        if (($user['role_name'] ?? '') !== 'ADMIN') {
            http_response_code(403);
            echo "Akses ditolak. Hanya Admin yang dapat mengakses halaman ini.";
            exit;
        }
    }

    public function index(): void
    {
        $this->ensureAdmin();
        
        $users = $this->userModel->getAll();
        
        $this->render('users/index', [
            'users' => $users
        ]);
    }

    public function create(): void
    {
        $this->ensureAdmin();
        
        $roles = $this->userModel->getRoles();
        $ruanganModel = new Ruangan();
        $ruanganList = $ruanganModel->all();
        
        $this->render('users/create', [
            'roles' => $roles,
            'ruanganList' => $ruanganList
        ]);
    }

    public function store(): void
    {
        $this->ensureAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . Url::to('/master/users'));
            exit;
        }

        $nama = $_POST['nama'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $id_role = $_POST['id_role'] ?? '';
        $unit = $_POST['unit'] ?? null;
        
        // Validasi sederhana
        if (empty($nama) || empty($username) || empty($password) || empty($id_role)) {
            // TODO: Handle error with flash message
            header('Location: ' . Url::to('/master/users/create?error=Field wajib diisi'));
            exit;
        }

        $this->userModel->create([
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'id_role' => (int)$id_role,
            'unit' => $unit,
            'status' => 'aktif'
        ]);

        header('Location: ' . Url::to('/master/users'));
        exit;
    }

    public function edit(): void
    {
        $this->ensureAdmin();
        
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . Url::to('/master/users'));
            exit;
        }

        $user = $this->userModel->find((int)$id);
        if (!$user) {
            header('Location: ' . Url::to('/master/users'));
            exit;
        }

        $roles = $this->userModel->getRoles();
        $ruanganModel = new Ruangan();
        $ruanganList = $ruanganModel->all();

        $this->render('users/edit', [
            'user' => $user,
            'roles' => $roles,
            'ruanganList' => $ruanganList
        ]);
    }

    public function update(): void
    {
        $this->ensureAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . Url::to('/master/users'));
            exit;
        }

        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: ' . Url::to('/master/users'));
            exit;
        }

        $nama = $_POST['nama'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? ''; // Optional if empty
        $id_role = $_POST['id_role'] ?? '';
        $unit = $_POST['unit'] ?? null;
        $status = $_POST['status'] ?? 'aktif';

        $this->userModel->update((int)$id, [
            'nama' => $nama,
            'username' => $username,
            'password' => $password, // Model will handle if empty
            'id_role' => (int)$id_role,
            'unit' => $unit,
            'status' => $status
        ]);

        header('Location: ' . Url::to('/master/users'));
        exit;
    }

    public function delete(): void
    {
        $this->ensureAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . Url::to('/master/users'));
            exit;
        }

        $id = $_POST['id'] ?? null;
        if ($id) {
            // Prevent deleting self (optional but recommended)
            $currentUser = Auth::user();
            if ($currentUser['id'] != $id) {
                $this->userModel->delete((int)$id);
            }
        }

        header('Location: ' . Url::to('/master/users'));
        exit;
    }
}
