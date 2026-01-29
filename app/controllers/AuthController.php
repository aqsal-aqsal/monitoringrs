<?php
namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Url;
use App\Models\LogAktivitas;
use App\Models\User;

class AuthController extends BaseController
{
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('auth/login');
            return;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByUsername($username);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $this->render('auth/login', ['error' => 'Username atau password salah']);
            return;
        }

        Auth::login([
            'id' => (int)$user['id'],
            'username' => $user['username'],
            'role_name' => $user['role_name'],
            'ruangan_id' => $user['ruangan_id'],
        ]);

        (new LogAktivitas())->record((int)$user['id'], 'login', null);
        header('Location: ' . Url::to('/dashboard'));
        exit;
    }

    public function logout(): void
    {
        $u = Auth::user();
        if ($u) {
            (new LogAktivitas())->record((int)$u['id'], 'logout', null);
        }
        Auth::logout();
        header('Location: ' . Url::to('/login'));
        exit;
    }
}
