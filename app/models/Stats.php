<?php
namespace App\Models;

class Stats extends BaseModel
{
    protected string $table = 'barang';

    public function totalBarang(): int
    {
        $row = $this->query("SELECT COUNT(*) AS c FROM barang WHERE deleted_at IS NULL")->fetch();
        return (int)($row['c'] ?? 0);
    }

    public function totalRusak(): int
    {
        $row = $this->query("SELECT COUNT(*) AS c FROM barang WHERE status = 'RUSAK' AND deleted_at IS NULL")->fetch();
        return (int)($row['c'] ?? 0);
    }

    public function totalMaintenance(): int
    {
        $row = $this->query("SELECT COUNT(*) AS c FROM maintenance WHERE status IN ('DIPROSES','JADWAL') AND deleted_at IS NULL")->fetch();
        return (int)($row['c'] ?? 0);
    }

    public function totalLaporanBaru(): int
    {
        $row = $this->query("SELECT COUNT(*) AS c FROM laporan_kerusakan WHERE status = 'BARU' AND deleted_at IS NULL")->fetch();
        return (int)($row['c'] ?? 0);
    }
}
