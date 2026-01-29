<?php
namespace App\Models;

class KategoriBarang extends BaseModel
{
    protected string $table = 'kategori_barang';
    protected string $idColumn = 'id_kategori';

    public function create(string $nama, ?string $keterangan): int
    {
        $this->query("INSERT INTO {$this->table} (nama_kategori, keterangan) VALUES (:n, :k)", [
            'n' => $nama,
            'k' => $keterangan,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function updateById(int $id, string $nama, ?string $keterangan): void
    {
        $this->query("UPDATE {$this->table} SET nama_kategori = :n, keterangan = :k WHERE id_kategori = :id", [
            'n' => $nama,
            'k' => $keterangan,
            'id' => $id,
        ]);
    }
}
