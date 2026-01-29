<?php
$title = $title ?? 'Laporan Kerusakan';
$items = $items ?? [];
?>
<h1 class="text-2xl font-semibold text-blue-600 mb-4"><?= htmlspecialchars($title) ?></h1>
<div class="bg-white rounded shadow overflow-hidden">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-4 py-2 text-left">ID</th>
        <th class="px-4 py-2 text-left">Barang</th>
        <th class="px-4 py-2 text-left">Deskripsi</th>
        <th class="px-4 py-2 text-left">Status</th>
        <th class="px-4 py-2 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $i): ?>
        <tr class="border-t">
          <td class="px-4 py-2"><?= (int)$i['id_laporan'] ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['nama_barang']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['deskripsi']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['status']) ?></td>
          <td class="px-4 py-2">
            <form method="post" action="<?= \App\Helpers\Url::to('/laporan/update_status') ?>" class="flex items-center gap-2">
              <input type="hidden" name="id" value="<?= (int)$i['id_laporan'] ?>">
              <select name="status" class="border rounded px-2 py-1">
                <?php foreach (['menunggu','diproses','selesai'] as $s): ?>
                  <option value="<?= $s ?>" <?= $i['status'] === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                <?php endforeach; ?>
              </select>
              <button class="bg-blue-600 text-white px-3 py-1 rounded">Simpan</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
