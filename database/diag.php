<?php
declare(strict_types=1);

require __DIR__ . '/../app/bootstrap.php';
use Config\Database;

$db = Database::connection();
$tables = ['roles', 'users', 'kategori_barang', 'ruangan', 'barang', 'maintenance', 'laporan_kerusakan', 'log_aktivitas'];

foreach ($tables as $t) {
    echo "== {$t} ==\n";
    try {
        $stmt = $db->query("SHOW COLUMNS FROM {$t}");
        foreach ($stmt->fetchAll() as $col) {
            echo $col['Field'] . ' ' . $col['Type'] . "\n";
        }
    } catch (\Throwable $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
    echo "\n";
}
