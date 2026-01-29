<?php
namespace App\Models;

class User extends BaseModel
{
    protected string $table = 'users';

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->query(
            "SELECT u.id_user AS id, u.username, u.password AS password_hash, r.nama_role AS role_name, NULL AS ruangan_id
             FROM users u
             JOIN roles r ON r.id_role = u.id_role
             WHERE u.username = :username",
            ['username' => $username]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
