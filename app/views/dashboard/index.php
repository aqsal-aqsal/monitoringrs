<?php
$title = 'Dashboard';
$stats = $stats ?? ['barang' => 0, 'rusak' => 0, 'maintenance' => 0, 'laporanBaru' => 0];
?>
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
  <div class="bg-white shadow rounded p-4 border-l-4 border-blue-600">
    <div class="text-sm text-gray-500">Total Barang</div>
    <div class="text-2xl font-semibold"><?= (int)$stats['barang'] ?></div>
  </div>
  <div class="bg-white shadow rounded p-4 border-l-4 border-red-600">
    <div class="text-sm text-gray-500">Barang Rusak</div>
    <div class="text-2xl font-semibold text-red-600"><?= (int)$stats['rusak'] ?></div>
  </div>
  <div class="bg-white shadow rounded p-4 border-l-4 border-yellow-500">
    <div class="text-sm text-gray-500">Maintenance Aktif</div>
    <div class="text-2xl font-semibold text-yellow-600"><?= (int)$stats['maintenance'] ?></div>
  </div>
  <div class="bg-white shadow rounded p-4 border-l-4 border-green-600">
    <div class="text-sm text-gray-500">Laporan Baru</div>
    <div class="text-2xl font-semibold text-green-600"><?= (int)$stats['laporanBaru'] ?></div>
  </div>
</div>

<div class="mt-6 bg-white shadow rounded p-6">
  <div class="text-lg font-semibold mb-3">Ringkasan</div>
  <p class="text-sm text-gray-600 mb-4">Monitoring kesiapan alat, ketepatan maintenance, dan kecepatan pelaporan.</p>
  
  <?php
  $user = \App\Helpers\Auth::user();
  $role = $user['role_name'] ?? '';
  $base = \App\Helpers\Url::base();
  ?>
  
  <div class="flex flex-wrap gap-3 mt-4">
    <?php if ($role === 'ADMIN'): ?>
        <a href="<?= $base ?>/master/barang" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">Kelola Barang</a>
        <a href="<?= $base ?>/master/ruangan" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">Kelola Ruangan</a>
        <a href="<?= $base ?>/maintenance" class="bg-yellow-500 text-white px-4 py-2 rounded text-sm hover:bg-yellow-600">Jadwal Maintenance</a>
    <?php endif; ?>

    <?php if ($role === 'PETUGAS_RUANGAN'): ?>
        <a href="<?= $base ?>/laporan/create" class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700">Lapor Kerusakan</a>
        <a href="<?= $base ?>/laporan/saya" class="bg-gray-600 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">Riwayat Laporan</a>
    <?php endif; ?>

    <?php if ($role === 'TEKNISI'): ?>
        <a href="<?= $base ?>/laporan/admin" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">Lihat Laporan Masuk</a>
        <a href="<?= $base ?>/maintenance" class="bg-yellow-500 text-white px-4 py-2 rounded text-sm hover:bg-yellow-600">Jadwal Maintenance</a>
    <?php endif; ?>
  </div>
</div>
