<?php
$title = 'Barang';
$items = $items ?? [];
?>
<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-semibold text-blue-600"><?= htmlspecialchars($title) ?></h1>
  <a href="<?= \App\Helpers\Url::to('/master/barang/create') ?>" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah</a>
</div>
<div class="bg-white rounded shadow overflow-hidden">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-4 py-2 text-left">Kode</th>
        <th class="px-4 py-2 text-left">Nama</th>
        <th class="px-4 py-2 text-left">Status</th>
        <th class="px-4 py-2 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $i): ?>
        <tr class="border-t">
          <td class="px-4 py-2"><?= htmlspecialchars($i['kode_barang']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['nama_barang']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['status_barang']) ?></td>
          <td class="px-4 py-2">
            <a class="text-blue-600 underline" href="<?= \App\Helpers\Url::to('/master/barang/edit') ?>?id=<?= (int)$i['id_barang'] ?>">Edit</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
