<?php
namespace App\Models;

class Maintenance extends BaseModel
{
    protected string $table = 'maintenance';

    public function getAll(): array
    {
        $sql = "SELECT m.*, b.nama_barang, b.kode_barang 
                FROM {$this->table} m
                JOIN barang b ON m.id_barang = b.id_barang
                ORDER BY m.tanggal_jadwal DESC";
        return $this->query($sql)->fetchAll();
    }

    public function schedule(int $barangId, string $tanggalJadwal, string $teknisi): int
    {
        $this->query("INSERT INTO {$this->table} (id_barang, tanggal_jadwal, teknisi, status) VALUES (:b, :t, :teknisi, 'terjadwal')", [
            'b' => $barangId,
            't' => $tanggalJadwal,
            'teknisi' => $teknisi,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function updateResult(int $id, ?string $hasil, string $status, ?string $tanggalRealisasi): void
    {
        $this->query("UPDATE {$this->table} SET hasil = :h, status = :s, tanggal_realisasi = :tr WHERE id_maintenance = :id", [
            'h' => $hasil,
            's' => $status,
            'tr' => $tanggalRealisasi,
            'id' => $id,
        ]);
    }
}
