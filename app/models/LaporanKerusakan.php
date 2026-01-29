<?php
namespace App\Models;

class LaporanKerusakan extends BaseModel
{
    protected string $table = 'laporan_kerusakan';

    public function create(int $barangId, int $userId, string $deskripsi): int
    {
        $this->query("INSERT INTO {$this->table} (id_barang, id_user, tanggal_lapor, deskripsi, status) VALUES (:b, :u, NOW(), :d, 'menunggu')", [
            'b' => $barangId,
            'u' => $userId,
            'd' => $deskripsi,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function updateStatus(int $id, string $status): void
    {
        $this->query("UPDATE {$this->table} SET status = :s WHERE id_laporan = :id", ['s' => $status, 'id' => $id]);
    }

    public function byUser(int $userId): array
    {
        $stmt = $this->query("SELECT * FROM {$this->table} WHERE id_user = :u ORDER BY tanggal_lapor DESC", ['u' => $userId]);
        return $stmt->fetchAll();
    }
}
