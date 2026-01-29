<?php
declare(strict_types=1);

use PDO;
use PDOException;

$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = getenv('DB_PORT') ?: '3306';
$name = getenv('DB_NAME') ?: 'monitoringrs';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$charset = getenv('DB_CHARSET') ?: 'utf8mb4';

try {
    $pdoServer = new PDO("mysql:host={$host};port={$port};charset={$charset}", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $pdoServer->exec("CREATE DATABASE IF NOT EXISTS `{$name}` CHARACTER SET {$charset} COLLATE {$charset}_general_ci");

    $pdoDb = new PDO("mysql:host={$host};port={$port};dbname={$name};charset={$charset}", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $schemaPath = __DIR__ . '/schema.sql';
    $sql = file_get_contents($schemaPath);
    if ($sql === false) {
        fwrite(STDERR, "Gagal membaca schema.sql\n");
        exit(1);
    }
    $pdoDb->exec($sql);
    echo "Migrasi selesai\n";
} catch (PDOException $e) {
    fwrite(STDERR, "Error: " . $e->getMessage() . "\n");
    exit(1);
}
