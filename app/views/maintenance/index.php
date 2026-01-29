<?php
$title = $title ?? 'Maintenance';
$items = $items ?? [];
?>
<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-semibold text-blue-600"><?= htmlspecialchars($title) ?></h1>
  <?php if (\App\Helpers\Auth::check() && \App\Helpers\Auth::user()['role_name'] === 'ADMIN'): ?>
    <a href="<?= \App\Helpers\Url::to('/maintenance/schedule') ?>" class="bg-blue-600 text-white px-4 py-2 rounded">Jadwalkan</a>
  <?php endif; ?>
</div>
<div class="bg-white rounded shadow overflow-hidden">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-4 py-2 text-left">ID</th>
        <th class="px-4 py-2 text-left">Barang</th>
        <th class="px-4 py-2 text-left">Teknisi</th>
        <th class="px-4 py-2 text-left">Jadwal</th>
        <th class="px-4 py-2 text-left">Realisasi</th>
        <th class="px-4 py-2 text-left">Status</th>
        <th class="px-4 py-2 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $i): ?>
        <tr class="border-t">
          <td class="px-4 py-2"><?= (int)$i['id_maintenance'] ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['nama_barang']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['teknisi'] ?? '') ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['tanggal_jadwal'] ?? '') ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['tanggal_realisasi'] ?? '') ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($i['status']) ?></td>
          <td class="px-4 py-2">
            <?php if (\App\Helpers\Auth::check() && \App\Helpers\Auth::user()['role_name'] === 'TEKNISI'): ?>
              <form method="post" action="<?= \App\Helpers\Url::to('/maintenance/update') ?>" class="flex items-center gap-2">
                <input type="hidden" name="id" value="<?= (int)$i['id_maintenance'] ?>">
                <select name="status" class="border rounded px-2 py-1">
                  <?php foreach (['terjadwal','selesai','terlewat'] as $s): ?>
                    <option value="<?= $s ?>" <?= $i['status'] === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                  <?php endforeach; ?>
                </select>
                <input type="date" name="tanggal_realisasi" value="<?= htmlspecialchars($i['tanggal_realisasi'] ?? date('Y-m-d')) ?>" class="border rounded px-2 py-1">
                <input type="text" name="hasil" value="<?= htmlspecialchars($i['hasil'] ?? '') ?>" placeholder="Hasil" class="border rounded px-2 py-1">
                <button class="bg-blue-600 text-white px-3 py-1 rounded">Simpan</button>
              </form>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
