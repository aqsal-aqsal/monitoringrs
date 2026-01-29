<?php
namespace App\Models;

use Config\Database;
use PDO;

abstract class BaseModel
{
    protected PDO $db;
    protected string $table;
    protected string $idColumn = 'id';

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
        $stmt = $this->query("SELECT * FROM {$this->table} WHERE {$this->idColumn} = :id", ['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function all(): array
    {
        $stmt = $this->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }
}
