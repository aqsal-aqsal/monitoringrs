<?php
require_once __DIR__ . '/app/bootstrap.php';

use Config\Database;
use App\Models\User;
use App\Models\Ruangan;
use App\Models\KategoriBarang;
use App\Models\Barang;
use App\Models\LaporanKerusakan;
use App\Models\Maintenance;

echo "Starting seeder...\n";

$db = Database::connection();

// 1. Clean up "MacBook" data (interpreting user request)
echo "Cleaning up 'MacBook' data...\n";
try {
    // Fix schema mismatch first
    $db->exec("ALTER TABLE barang MODIFY COLUMN status_barang ENUM('baik','rusak','maintenance','tidak_layak','rusak_ringan','rusak_berat','hilang') DEFAULT 'baik'");
    echo "Updated barang status enum schema.\n";

    $db->exec("DELETE FROM barang WHERE nama_barang LIKE '%MacBook%' OR merk LIKE '%MacBook%'");
    $db->exec("DELETE FROM kategori_barang WHERE nama_kategori LIKE '%MacBook%'");
    echo "Cleaned up any MacBook data found.\n";
} catch (Exception $e) {
    echo "Note: " . $e->getMessage() . "\n";
}

// 2. Ensure Roles
echo "Checking roles...\n";
$roles = [
    ['nama_role' => 'ADMIN'],
    ['nama_role' => 'PETUGAS_RUANGAN'],
    ['nama_role' => 'TEKNISI']
];

foreach ($roles as $role) {
    $stmt = $db->prepare("SELECT id_role FROM roles WHERE nama_role = ?");
    $stmt->execute([$role['nama_role']]);
    if (!$stmt->fetch()) {
        $stmt = $db->prepare("INSERT INTO roles (nama_role) VALUES (?)");
        $stmt->execute([$role['nama_role']]);
        echo "Created role: {$role['nama_role']}\n";
    }
}

// Get Role IDs
$roleIds = [];
$stmt = $db->query("SELECT id_role, nama_role FROM roles");
while ($row = $stmt->fetch()) {
    $roleIds[$row['nama_role']] = $row['id_role'];
}

// 3. Create Users
echo "Seeding users...\n";
$users = [
    ['nama' => 'Administrator', 'username' => 'admin', 'password' => 'admin123', 'role' => 'ADMIN', 'unit' => 'IT'],
    ['nama' => 'Petugas Mawar', 'username' => 'petugas_mawar', 'password' => 'petugas123', 'role' => 'PETUGAS_RUANGAN', 'unit' => 'Rawat Inap'],
    ['nama' => 'Petugas Melati', 'username' => 'petugas_melati', 'password' => 'petugas123', 'role' => 'PETUGAS_RUANGAN', 'unit' => 'IGD'],
    ['nama' => 'Teknisi Budi', 'username' => 'teknisi_budi', 'password' => 'teknisi123', 'role' => 'TEKNISI', 'unit' => 'IPSRS'],
    ['nama' => 'Teknisi Andi', 'username' => 'teknisi_andi', 'password' => 'teknisi123', 'role' => 'TEKNISI', 'unit' => 'IPSRS'],
];

$userModel = new User();
foreach ($users as $u) {
    if (!$userModel->findByUsername($u['username'])) {
        $userModel->create([
            'nama' => $u['nama'],
            'username' => $u['username'],
            'password' => $u['password'],
            'id_role' => $roleIds[$u['role']],
            'unit' => $u['unit'],
            'status' => 'aktif'
        ]);
        echo "Created user: {$u['username']}\n";
    }
}

// 4. Create Ruangan
echo "Seeding ruangan...\n";
$ruanganData = [
    ['nama' => 'Ruang Mawar 01', 'gedung' => 'A', 'lantai' => '1'],
    ['nama' => 'Ruang Mawar 02', 'gedung' => 'A', 'lantai' => '1'],
    ['nama' => 'Ruang Melati 01', 'gedung' => 'B', 'lantai' => '2'],
    ['nama' => 'IGD Bed 1', 'gedung' => 'Utama', 'lantai' => '1'],
    ['nama' => 'IGD Bed 2', 'gedung' => 'Utama', 'lantai' => '1'],
    ['nama' => 'Radiologi 1', 'gedung' => 'C', 'lantai' => '1'],
    ['nama' => 'Laboratorium', 'gedung' => 'C', 'lantai' => '2'],
    ['nama' => 'Poli Gigi', 'gedung' => 'D', 'lantai' => '1'],
    ['nama' => 'Poli Umum', 'gedung' => 'D', 'lantai' => '1'],
    ['nama' => 'ICU', 'gedung' => 'Utama', 'lantai' => '3'],
];

$ruanganModel = new Ruangan();
$ruanganIds = [];
foreach ($ruanganData as $r) {
    $stmt = $db->prepare("SELECT id_ruangan FROM ruangan WHERE nama_ruangan = ?");
    $stmt->execute([$r['nama']]);
    $existing = $stmt->fetch();
    if (!$existing) {
        $id = $ruanganModel->create($r['nama'], $r['gedung'], $r['lantai']);
        $ruanganIds[] = $id;
    } else {
        $ruanganIds[] = $existing['id_ruangan'];
    }
}

// 5. Create Kategori
echo "Seeding kategori...\n";
$kategoriData = [
    ['nama' => 'Elektronik Medis', 'ket' => 'Alat elektronik kesehatan'],
    ['nama' => 'Furniture RS', 'ket' => 'Meja, kursi, bed pasien'],
    ['nama' => 'Instrumen Bedah', 'ket' => 'Alat-alat operasi'],
    ['nama' => 'Alat Diagnostik', 'ket' => 'Stetoskop, tensimeter, dll'],
    ['nama' => 'IT & Komputer', 'ket' => 'Laptop, PC, Printer untuk admin'],
];

$kategoriModel = new KategoriBarang();
$kategoriIds = [];
foreach ($kategoriData as $k) {
    $stmt = $db->prepare("SELECT id_kategori FROM kategori_barang WHERE nama_kategori = ?");
    $stmt->execute([$k['nama']]);
    $existing = $stmt->fetch();
    if (!$existing) {
        $id = $kategoriModel->create($k['nama'], $k['ket']);
        $kategoriIds[] = $id;
    } else {
        $kategoriIds[] = $existing['id_kategori'];
    }
}

// 6. Create Barang (Generate 15 items)
echo "Seeding barang...\n";
$barangModel = new Barang();
$items = [
    ['nama' => 'Bed Pasien Elektrik', 'merk' => 'Paramount', 'nilai' => 15000000],
    ['nama' => 'Monitor Pasien', 'merk' => 'Mindray', 'nilai' => 25000000],
    ['nama' => 'USG 4D', 'merk' => 'GE Health', 'nilai' => 450000000],
    ['nama' => 'EKG 12 Lead', 'merk' => 'Philips', 'nilai' => 35000000],
    ['nama' => 'Infusion Pump', 'merk' => 'Terumo', 'nilai' => 12000000],
    ['nama' => 'Defibrillator', 'merk' => 'Zoll', 'nilai' => 85000000],
    ['nama' => 'Kursi Roda', 'merk' => 'Avico', 'nilai' => 1500000],
    ['nama' => 'Tensimeter Digital', 'merk' => 'Omron', 'nilai' => 1200000],
    ['nama' => 'Lampu Operasi', 'merk' => 'Drager', 'nilai' => 120000000],
    ['nama' => 'Ventilator', 'merk' => 'Hamilton', 'nilai' => 350000000],
    ['nama' => 'Laptop Admin', 'merk' => 'Asus', 'nilai' => 8000000], 
    ['nama' => 'Printer Thermal', 'merk' => 'Epson', 'nilai' => 2500000],
];

$barangIds = [];
// Create at least 15 items
for ($i = 0; $i < 15; $i++) {
    $item = $items[$i % count($items)];
    $kode = 'BRG-' . date('Y') . '-' . str_pad((string)($i + 1), 4, '0', STR_PAD_LEFT);
    
    // Check if code exists
    $stmt = $db->prepare("SELECT id_barang FROM barang WHERE kode_barang = ?");
    $stmt->execute([$kode]);
    if (!$stmt->fetch()) {
        $data = [
            'kode_barang' => $kode,
            'nama_barang' => $item['nama'] . ' #' . ($i + 1),
            'id_kategori' => $kategoriIds[array_rand($kategoriIds)],
            'id_ruangan' => $ruanganIds[array_rand($ruanganIds)],
            'merk' => $item['merk'],
            'tahun_pengadaan' => rand(2020, 2024),
            'nilai_aset' => $item['nilai'],
            'status_barang' => ['baik', 'baik', 'baik', 'rusak_ringan', 'rusak_berat'][rand(0, 4)]
        ];
        $id = $barangModel->create($data);
        $barangIds[] = $id;
        echo "Created barang: {$data['nama_barang']}\n";
    }
}

// Reload barang ids from DB to be sure
$stmt = $db->query("SELECT id_barang FROM barang");
$barangIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

// 7. Create Laporan Kerusakan
echo "Seeding laporan...\n";
$laporanModel = new LaporanKerusakan();
// Need users with role PETUGAS_RUANGAN or any user
$stmt = $db->prepare("SELECT id_user FROM users WHERE id_role = ?");
$stmt->execute([$roleIds['PETUGAS_RUANGAN']]);
$petugasIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

if (!empty($petugasIds) && !empty($barangIds)) {
    for ($i = 0; $i < 10; $i++) {
        $barangId = $barangIds[array_rand($barangIds)];
        $userId = $petugasIds[array_rand($petugasIds)];
        $deskripsi = "Kerusakan pada bagian " . ['kabel power', 'layar', 'roda', 'tombol', 'sensor'][rand(0, 4)];
        
        $laporanModel->create($barangId, $userId, $deskripsi);
        echo "Created laporan for barang ID $barangId\n";
    }
}

// 8. Create Maintenance Schedules
echo "Seeding maintenance...\n";
$maintenanceModel = new Maintenance();
if (!empty($barangIds)) {
    for ($i = 0; $i < 10; $i++) {
        $barangId = $barangIds[array_rand($barangIds)];
        $teknisi = ['Budi', 'Andi', 'Citra'][rand(0, 2)];
        $tanggal = date('Y-m-d', strtotime('+' . rand(1, 30) . ' days'));
        
        $maintenanceModel->schedule($barangId, $tanggal, $teknisi);
        echo "Created maintenance schedule for barang ID $barangId\n";
    }
}

echo "Seeding completed!\n";
