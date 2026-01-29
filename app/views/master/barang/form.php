<?php
$title = $title ?? 'Barang';
$item = $item ?? null;
$kats = $kats ?? [];
$ruangs = $ruangs ?? [];
?>
<h1 class="text-2xl font-semibold text-blue-600 mb-4"><?= htmlspecialchars($title) ?></h1>
<form method="post" action="<?= \App\Helpers\Url::to($item ? '/master/barang/update' : '/master/barang/store') ?>" class="bg-white p-6 rounded shadow">
  <?php if ($item): ?>
    <input type="hidden" name="id" value="<?= (int)$item['id_barang'] ?>">
  <?php endif; ?>
  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm mb-1">Kode</label>
      <input name="kode_barang" value="<?= htmlspecialchars($item['kode_barang'] ?? '') ?>" class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm mb-1">Nama</label>
      <input name="nama_barang" value="<?= htmlspecialchars($item['nama_barang'] ?? '') ?>" class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm mb-1">Kategori</label>
      <select name="id_kategori" class="w-full border rounded px-3 py-2">
        <?php foreach ($kats as $k): ?>
          <option value="<?= (int)$k['id_kategori'] ?>" <?= ($item && (int)$item['id_kategori'] === (int)$k['id_kategori']) ? 'selected' : '' ?>><?= htmlspecialchars($k['nama_kategori']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label class="block text-sm mb-1">Ruangan</label>
      <select name="id_ruangan" class="w-full border rounded px-3 py-2">
        <?php foreach ($ruangs as $r): ?>
          <option value="<?= (int)$r['id_ruangan'] ?>" <?= ($item && (int)$item['id_ruangan'] === (int)$r['id_ruangan']) ? 'selected' : '' ?>><?= htmlspecialchars($r['nama_ruangan']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label class="block text-sm mb-1">Merk</label>
      <input name="merk" value="<?= htmlspecialchars($item['merk'] ?? '') ?>" class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm mb-1">Tahun Pengadaan</label>
      <input name="tahun_pengadaan" value="<?= htmlspecialchars($item['tahun_pengadaan'] ?? '') ?>" class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm mb-1">Nilai Aset</label>
      <input name="nilai_aset" value="<?= htmlspecialchars($item['nilai_aset'] ?? '') ?>" class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm mb-1">Status</label>
      <select name="status_barang" class="w-full border rounded px-3 py-2">
        <?php
        $statuses = ['baik','rusak','maintenance','tidak_layak'];
        $cur = $item['status_barang'] ?? 'baik';
        foreach ($statuses as $s): ?>
          <option value="<?= $s ?>" <?= $cur === $s ? 'selected' : '' ?>><?= ucfirst(str_replace('_',' ',$s)) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="mt-4 flex gap-2">
    <button class="bg-blue-600 text-white px-4 py-2 rounded"><?= $item ? 'Simpan' : 'Tambah' ?></button>
    <a href="<?= \App\Helpers\Url::to('/master/barang') ?>" class="px-4 py-2 border rounded">Batal</a>
  </div>
</form>
