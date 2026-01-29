<?php
namespace App\Models;

class LogAktivitas extends BaseModel
{
    protected string $table = 'log_aktivitas';

    public function record(int $userId, string $aksi, ?string $detail = null): void
    {
        $this->query(
            "INSERT INTO {$this->table} (user_id, aksi, detail) VALUES (:user_id, :aksi, :detail)",
            ['user_id' => $userId, 'aksi' => $aksi, 'detail' => $detail]
        );
    }
}
