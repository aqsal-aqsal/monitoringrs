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
  <p class="text-sm text-gray-600">Monitoring kesiapan alat, ketepatan maintenance, dan kecepatan pelaporan.</p>
</div>
