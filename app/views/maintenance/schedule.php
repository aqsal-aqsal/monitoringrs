<?php
$title = $title ?? 'Jadwalkan Maintenance';
$barangs = $barangs ?? [];
?>
<h1 class="text-2xl font-semibold text-blue-600 mb-4"><?= htmlspecialchars($title) ?></h1>
<form method="post" action="<?= \App\Helpers\Url::to('/maintenance/store') ?>" class="bg-white p-6 rounded shadow max-w-xl">
  <div class="mb-3">
    <label class="block text-sm mb-1">Barang</label>
    <select name="id_barang" class="w-full border rounded px-3 py-2">
      <?php foreach ($barangs as $b): ?>
        <option value="<?= (int)$b['id_barang'] ?>"><?= htmlspecialchars($b['nama_barang']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="block text-sm mb-1">Tanggal Jadwal</label>
    <input type="date" name="tanggal_jadwal" value="<?= date('Y-m-d') ?>" class="w-full border rounded px-3 py-2">
  </div>
  <div class="mb-3">
    <label class="block text-sm mb-1">Teknisi</label>
    <input name="teknisi" class="w-full border rounded px-3 py-2" placeholder="Nama teknisi">
  </div>
  <div class="flex gap-2">
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    <a href="<?= \App\Helpers\Url::to('/maintenance') ?>" class="px-4 py-2 border rounded">Batal</a>
  </div>
</form>
