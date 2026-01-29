<?php
$title = 'Kategori Barang';
$items = $items ?? [];
?>
<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-semibold text-blue-600"><?= htmlspecialchars($title) ?></h1>
  <a href="<?= \App\Helpers\Url::to('/master/kategori/create') ?>" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah</a>
</div>
<div class="bg-white rounded shadow overflow-hidden">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-4 py-2 text-left">ID</th>
        <th class="px-4 py-2 text-left">Nama</th>
        <th class="px-4 py-2 text-left">Keterangan</th>
        <th class="px-4 py-2 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $i): ?>
        <tr class="border-t">
          <td class="px-4 py-2"><?= (int)$i['id_kategori'] ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['nama_kategori']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['keterangan'] ?? '') ?></td>
          <td class="px-4 py-2">
            <a class="text-blue-600 underline" href="<?= \App\Helpers\Url::to('/master/kategori/edit') ?>?id=<?= (int)$i['id_kategori'] ?>">Edit</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
