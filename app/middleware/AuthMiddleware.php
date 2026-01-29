<?php
namespace App\Middleware;

use App\Helpers\Url;

class AuthMiddleware
{
    public static function requireAuth(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . Url::to('/login'));
            exit;
        }
    }

    public static function requireRole(array $allowedRoles): void
    {
        self::requireAuth();
        $role = $_SESSION['user']['role_name'] ?? null;
        if (!$role || !in_array($role, $allowedRoles, true)) {
            http_response_code(403);
            echo 'Forbidden';
            exit;
        }
    }
}
