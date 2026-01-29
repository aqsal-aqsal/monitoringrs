<?php
namespace App\Models;

class User extends BaseModel
{
    protected string $table = 'users';

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->query(
            "SELECT u.id_user AS id, u.username, u.password AS password_hash, r.nama_role AS role_name, u.unit
             FROM users u
             JOIN roles r ON r.id_role = u.id_role
             WHERE u.username = :username",
            ['username' => $username]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function getAll(): array
    {
        $sql = "SELECT u.id_user, u.nama, u.username, u.unit, u.status, r.nama_role, r.id_role
                FROM users u
                JOIN roles r ON u.id_role = r.id_role
                ORDER BY u.created_at DESC";
        return $this->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $sql = "SELECT u.*, r.nama_role 
                FROM users u
                JOIN roles r ON u.id_role = r.id_role
                WHERE u.id_user = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO users (nama, username, password, id_role, unit, status) 
                VALUES (:nama, :username, :password, :id_role, :unit, :status)";
        
        $this->query($sql, [
            'nama' => $data['nama'],
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'id_role' => $data['id_role'],
            'unit' => $data['unit'] ?? null,
            'status' => $data['status'] ?? 'aktif'
        ]);
        
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $params = [
            'nama' => $data['nama'],
            'username' => $data['username'],
            'id_role' => $data['id_role'],
            'unit' => $data['unit'] ?? null,
            'status' => $data['status'] ?? 'aktif',
            'id' => $id
        ];

        $sql = "UPDATE users SET nama = :nama, username = :username, id_role = :id_role, unit = :unit, status = :status";
        
        if (!empty($data['password'])) {
            $sql .= ", password = :password";
            $params['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        $sql .= " WHERE id_user = :id";
        
        $this->query($sql, $params);
    }

    public function delete(int $id): void
    {
        $this->query("DELETE FROM users WHERE id_user = :id", ['id' => $id]);
    }

    public function getRoles(): array
    {
        return $this->query("SELECT * FROM roles ORDER BY id_role ASC")->fetchAll();
    }
}