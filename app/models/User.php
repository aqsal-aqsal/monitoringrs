<?php
namespace App\Models;

class User extends BaseModel
{
    protected string $table = 'users';

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->query(
            "SELECT u.id, u.username, u.password_hash, r.name AS role_name, u.ruangan_id
             FROM users u
             JOIN roles r ON r.id = u.role_id
             WHERE u.username = :username AND u.deleted_at IS NULL",
            ['username' => $username]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
