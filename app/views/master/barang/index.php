<?php
$title = 'Data Barang';
$items = $items ?? [];
$kats = $kats ?? [];
$ruangs = $ruangs ?? [];
$base = \App\Helpers\Url::base();
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($title) ?></h1>
            <p class="mt-1 text-sm text-gray-500">Kelola inventaris barang dan aset.</p>
        </div>
        <div>
            <button onclick="openModal('create')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Barang
            </button>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                        <th class="px-6 py-4">Barang</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4">Info Aset</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (empty($items)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                Belum ada data barang
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($items as $item): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($item['nama_barang']) ?></div>
                                    <div class="text-xs text-gray-500 font-mono"><?= htmlspecialchars($item['kode_barang']) ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?= htmlspecialchars($item['nama_kategori'] ?? '-') ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="font-medium"><?= htmlspecialchars($item['nama_ruangan'] ?? '-') ?></div>
                                    <div class="text-xs text-gray-500"><?= htmlspecialchars($item['gedung'] ?? '') ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div><?= htmlspecialchars($item['merk'] ?? '-') ?></div>
                                    <div class="text-xs text-gray-500">Th: <?= htmlspecialchars($item['tahun_pengadaan'] ?? '-') ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                    $statusClass = match($item['status_barang']) {
                                        'baik' => 'bg-green-100 text-green-800',
                                        'rusak_ringan' => 'bg-yellow-100 text-yellow-800',
                                        'rusak_berat' => 'bg-red-100 text-red-800',
                                        'hilang' => 'bg-gray-100 text-gray-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass ?>">
                                        <?= ucwords(str_replace('_', ' ', $item['status_barang'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        <button onclick='openModal("edit", <?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>)' class="text-blue-600 hover:text-blue-900 font-semibold">Edit</button>
                                        <form action="<?= $base ?>/master/barang/delete" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                            <input type="hidden" name="id" value="<?= $item['id_barang'] ?>">
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="barangModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">Tambah Barang</h3>
                <form id="barangForm" method="POST" class="space-y-4">
                    <input type="hidden" name="id" id="barangId">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Kode & Nama -->
                        <div>
                            <label for="kode_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
                            <input type="text" name="kode_barang" id="kode_barang" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                        </div>
                        <div>
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                        </div>

                        <!-- Kategori & Ruangan -->
                        <div>
                            <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="id_kategori" id="id_kategori" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kats as $k): ?>
                                    <option value="<?= $k['id_kategori'] ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="id_ruangan" class="block text-sm font-medium text-gray-700">Ruangan</label>
                            <select name="id_ruangan" id="id_ruangan" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                                <option value="">Pilih Ruangan</option>
                                <?php foreach ($ruangs as $r): ?>
                                    <option value="<?= $r['id_ruangan'] ?>"><?= htmlspecialchars($r['nama_ruangan']) ?> (<?= htmlspecialchars($r['gedung'] ?? '-') ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Merk & Tahun -->
                        <div>
                            <label for="merk" class="block text-sm font-medium text-gray-700">Merk/Type</label>
                            <input type="text" name="merk" id="merk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                        </div>
                        <div>
                            <label for="tahun_pengadaan" class="block text-sm font-medium text-gray-700">Tahun Pengadaan</label>
                            <input type="number" name="tahun_pengadaan" id="tahun_pengadaan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                        </div>

                        <!-- Nilai Aset & Status -->
                        <div>
                            <label for="nilai_aset" class="block text-sm font-medium text-gray-700">Nilai Aset (Rp)</label>
                            <input type="number" name="nilai_aset" id="nilai_aset" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                        </div>
                        <div>
                            <label for="status_barang" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status_barang" id="status_barang" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                                <option value="baik">Baik</option>
                                <option value="rusak_ringan">Rusak Ringan</option>
                                <option value="rusak_berat">Rusak Berat</option>
                                <option value="hilang">Hilang</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="document.getElementById('barangForm').submit()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" id="saveButton">
                    Simpan
                </button>
                <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(mode, data = null) {
    const modal = document.getElementById('barangModal');
    const form = document.getElementById('barangForm');
    const title = document.getElementById('modal-title');
    const saveBtn = document.getElementById('saveButton');
    
    modal.classList.remove('hidden');

    if (mode === 'create') {
        title.innerText = 'Tambah Barang';
        form.action = '<?= $base ?>/master/barang/store';
        form.reset();
        document.getElementById('barangId').value = '';
        saveBtn.innerText = 'Simpan';
    } else {
        title.innerText = 'Edit Barang';
        form.action = '<?= $base ?>/master/barang/update';
        
        document.getElementById('barangId').value = data.id_barang;
        document.getElementById('kode_barang').value = data.kode_barang;
        document.getElementById('nama_barang').value = data.nama_barang;
        document.getElementById('id_kategori').value = data.id_kategori;
        document.getElementById('id_ruangan').value = data.id_ruangan;
        document.getElementById('merk').value = data.merk || '';
        document.getElementById('tahun_pengadaan').value = data.tahun_pengadaan || '';
        document.getElementById('nilai_aset').value = data.nilai_aset || '';
        document.getElementById('status_barang').value = data.status_barang;
        
        saveBtn.innerText = 'Update';
    }
}

function closeModal() {
    document.getElementById('barangModal').classList.add('hidden');
}
</script>
