<?php
namespace App\Models;

use Config\Database;
use PDO;

abstract class BaseModel
{
    protected PDO $db;
    protected string $table;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    protected function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->query("SELECT * FROM {$this->table} WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function all(): array
    {
        $stmt = $this->query("SELECT * FROM {$this->table} WHERE deleted_at IS NULL");
        return $stmt->fetchAll();
    }
}
