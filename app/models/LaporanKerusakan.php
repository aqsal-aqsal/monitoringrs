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
        $sql = "SELECT l.*, b.nama_barang, b.kode_barang
                FROM {$this->table} l
                JOIN barang b ON l.id_barang = b.id_barang
                WHERE l.id_user = :u 
                ORDER BY l.tanggal_lapor DESC";
        return $this->query($sql, ['u' => $userId])->fetchAll();
    }

    public function getAll(): array
    {
        $sql = "SELECT l.*, b.nama_barang, b.kode_barang, u.nama as nama_pelapor, u.unit
                FROM {$this->table} l
                JOIN barang b ON l.id_barang = b.id_barang
                JOIN users u ON l.id_user = u.id_user
                ORDER BY l.tanggal_lapor DESC";
        return $this->query($sql)->fetchAll();
    }

    public function getRecent(int $limit = 5): array
    {
        $sql = "SELECT l.*, u.username, b.nama_barang 
                FROM {$this->table} l
                JOIN users u ON l.id_user = u.id_user
                JOIN barang b ON l.id_barang = b.id_barang
                ORDER BY l.tanggal_lapor DESC 
                LIMIT " . (int)$limit;
        $stmt = $this->query($sql);
        return $stmt->fetchAll() ?: [];
    }
}
