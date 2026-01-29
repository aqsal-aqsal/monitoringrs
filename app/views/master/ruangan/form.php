<?php
$title = $title ?? 'Ruangan';
$item = $item ?? null;
?>
<h1 class="text-2xl font-semibold text-blue-600 mb-4"><?= htmlspecialchars($title) ?></h1>
<form method="post" action="<?= \App\Helpers\Url::to($item ? '/master/ruangan/update' : '/master/ruangan/store') ?>" class="bg-white p-6 rounded shadow max-w-lg">
  <?php if ($item): ?>
    <input type="hidden" name="id" value="<?= (int)$item['id_ruangan'] ?>">
  <?php endif; ?>
  <div class="mb-3">
    <label class="block text-sm mb-1">Nama Ruangan</label>
    <input name="nama_ruangan" value="<?= htmlspecialchars($item['nama_ruangan'] ?? '') ?>" class="w-full border rounded px-3 py-2">
  </div>
  <div class="mb-3">
    <label class="block text-sm mb-1">Gedung</label>
    <input name="gedung" value="<?= htmlspecialchars($item['gedung'] ?? '') ?>" class="w-full border rounded px-3 py-2">
  </div>
  <div class="mb-3">
    <label class="block text-sm mb-1">Lantai</label>
    <input name="lantai" value="<?= htmlspecialchars($item['lantai'] ?? '') ?>" class="w-full border rounded px-3 py-2">
  </div>
  <div class="flex gap-2">
    <button class="bg-blue-600 text-white px-4 py-2 rounded"><?= $item ? 'Simpan' : 'Tambah' ?></button>
    <a href="<?= \App\Helpers\Url::to('/master/ruangan') ?>" class="px-4 py-2 border rounded">Batal</a>
  </div>
</form>
