<?php
$title = 'Kelola Laporan Kerusakan';
$items = $items ?? [];
$base = \App\Helpers\Url::base();
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($title) ?></h1>
            <p class="mt-1 text-sm text-gray-500">Daftar seluruh laporan kerusakan masuk.</p>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Barang</th>
                        <th class="px-6 py-4">Pelapor</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (empty($items)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                Belum ada laporan
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($items as $item): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    #<?= (int)$item['id_laporan'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($item['nama_barang']) ?></div>
                                    <div class="text-xs text-gray-500 font-mono"><?= htmlspecialchars($item['kode_barang'] ?? '-') ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900"><?= htmlspecialchars($item['nama_pelapor']) ?></div>
                                    <div class="text-xs text-gray-500"><?= htmlspecialchars($item['unit'] ?? '-') ?></div>
                                    <div class="text-xs text-gray-400 mt-0.5"><?= htmlspecialchars($item['tanggal_lapor']) ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate" title="<?= htmlspecialchars($item['deskripsi']) ?>">
                                    <?= htmlspecialchars($item['deskripsi']) ?>
                                </td>
                                <td class="px-6 py-4">
                                    <form method="post" action="<?= $base ?>/laporan/update_status" class="flex items-center gap-2">
                                        <input type="hidden" name="id" value="<?= (int)$item['id_laporan'] ?>">
                                        <select name="status" onchange="this.form.submit()" class="text-xs border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 py-1 pl-2 pr-6">
                                            <?php foreach (['menunggu', 'diproses', 'selesai'] as $s): ?>
                                                <option value="<?= $s ?>" <?= $item['status'] === $s ? 'selected' : '' ?>>
                                                    <?= ucfirst($s) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="<?= $base ?>/laporan/delete" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');" class="inline">
                                        <input type="hidden" name="id" value="<?= $item['id_laporan'] ?>">
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
