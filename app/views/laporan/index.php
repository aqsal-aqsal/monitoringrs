<?php
$title = $title ?? 'Laporan';
$items = $items ?? [];
?>
<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-semibold text-blue-600"><?= htmlspecialchars($title) ?></h1>
  <a href="<?= \App\Helpers\Url::to('/laporan/create') ?>" class="bg-blue-600 text-white px-4 py-2 rounded">Buat Laporan</a>
</div>
<div class="bg-white rounded shadow overflow-hidden">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-4 py-2 text-left">ID</th>
        <th class="px-4 py-2 text-left">Barang</th>
        <th class="px-4 py-2 text-left">Deskripsi</th>
        <th class="px-4 py-2 text-left">Status</th>
        <th class="px-4 py-2 text-left">Tanggal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $i): ?>
        <tr class="border-t">
          <td class="px-4 py-2"><?= (int)$i['id_laporan'] ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['id_barang']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['deskripsi']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['status']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['tanggal_lapor']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
