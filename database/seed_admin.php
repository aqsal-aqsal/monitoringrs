<?php
declare(strict_types=1);

require __DIR__ . '/../app/bootstrap.php';

use Config\Database;

$db = Database::connection();

$exists = $db->prepare("SELECT id_user FROM users WHERE username = :u");
$exists->execute(['u' => 'admin']);
$row = $exists->fetch();

if ($row) {
    echo "User admin sudah ada\n";
    exit(0);
}

$roleStmt = $db->query("SELECT id_role FROM roles WHERE nama_role = 'ADMIN'");
$roleId = (int)($roleStmt->fetch()['id_role'] ?? 0);
if ($roleId === 0) {
    $db->prepare("INSERT INTO roles (nama_role, created_at) VALUES ('ADMIN', NOW())")->execute();
    $roleStmt = $db->query("SELECT id_role FROM roles WHERE nama_role = 'ADMIN'");
    $roleId = (int)($roleStmt->fetch()['id_role'] ?? 0);
}

$password = 'Admin@123';
$hash = password_hash($password, PASSWORD_DEFAULT);

$ins = $db->prepare("INSERT INTO users (username, password, id_role, nama, unit, status, created_at) VALUES (:u, :h, :r, 'Administrator', NULL, 'aktif', NOW())");
$ins->execute(['u' => 'admin', 'h' => $hash, 'r' => $roleId]);

echo "User admin dibuat\n";
echo "Username: admin\n";
echo "Password: {$password}\n";
