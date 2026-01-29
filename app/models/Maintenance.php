<?php
namespace App\Models;

class Maintenance extends BaseModel
{
    protected string $table = 'maintenance';

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
