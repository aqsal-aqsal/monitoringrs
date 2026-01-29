<?php
namespace App\Models;

class LogAktivitas extends BaseModel
{
    protected string $table = 'log_aktivitas';

    public function record(int $userId, string $aksi, ?string $detail = null): void
    {
        $this->query(
            "INSERT INTO {$this->table} (id_user, aktivitas, waktu) VALUES (:user_id, :aksi, NOW())",
            ['user_id' => $userId, 'aksi' => $aksi]
        );
    }
}
