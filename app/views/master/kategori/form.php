<?php
$title = $title ?? 'Kategori';
$item = $item ?? null;
?>
<h1 class="text-2xl font-semibold text-blue-600 mb-4"><?= htmlspecialchars($title) ?></h1>
<?php if (!empty($error)): ?>
  <div class="mb-4 bg-red-100 text-red-700 px-3 py-2 rounded"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="post" action="<?= \App\Helpers\Url::to($item ? '/master/kategori/update' : '/master/kategori/store') ?>" class="bg-white p-6 rounded shadow max-w-lg">
  <?php if ($item): ?>
    <input type="hidden" name="id" value="<?= (int)$item['id_kategori'] ?>">
  <?php endif; ?>
  <div class="mb-3">
    <label class="block text-sm mb-1">Nama Kategori</label>
    <input name="nama_kategori" value="<?= htmlspecialchars($item['nama_kategori'] ?? '') ?>" class="w-full border rounded px-3 py-2">
  </div>
  <div class="mb-3">
    <label class="block text-sm mb-1">Keterangan</label>
    <textarea name="keterangan" class="w-full border rounded px-3 py-2"><?= htmlspecialchars($item['keterangan'] ?? '') ?></textarea>
  </div>
  <div class="flex gap-2">
    <button class="bg-blue-600 text-white px-4 py-2 rounded"><?= $item ? 'Simpan' : 'Tambah' ?></button>
    <a href="<?= \App\Helpers\Url::to('/master/kategori') ?>" class="px-4 py-2 border rounded">Batal</a>
  </div>
</form>
