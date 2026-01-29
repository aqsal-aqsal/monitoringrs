<?php
namespace App\Models;

class Ruangan extends BaseModel
{
    protected string $table = 'ruangan';
    protected string $idColumn = 'id_ruangan';

    public function create(string $nama, ?string $gedung, ?string $lantai): int
    {
        $this->query("INSERT INTO {$this->table} (nama_ruangan, gedung, lantai) VALUES (:n, :g, :l)", [
            'n' => $nama,
            'g' => $gedung,
            'l' => $lantai,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function updateById(int $id, string $nama, ?string $gedung, ?string $lantai): void
    {
        $this->query("UPDATE {$this->table} SET nama_ruangan = :n, gedung = :g, lantai = :l WHERE id_ruangan = :id", [
            'n' => $nama,
            'g' => $gedung,
            'l' => $lantai,
            'id' => $id,
        ]);
    }
}
