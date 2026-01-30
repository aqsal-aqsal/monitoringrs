<?php
$title = 'Data Ruangan';
$items = $items ?? [];
$base = \App\Helpers\Url::base();
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($title) ?></h1>
            <p class="mt-1 text-sm text-gray-500">Kelola data ruangan dan lokasi aset.</p>
        </div>
        <div>
            <button onclick="openModal('create')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Ruangan
            </button>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                        <th class="px-6 py-4">Nama Ruangan</th>
                        <th class="px-6 py-4">Gedung</th>
                        <th class="px-6 py-4">Lantai</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (empty($items)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                Belum ada data ruangan
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($items as $item): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($item['nama_ruangan']) ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?= htmlspecialchars($item['gedung'] ?? '-') ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?= htmlspecialchars($item['lantai'] ?? '-') ?>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        <button onclick='openModal("edit", <?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>)' class="text-blue-600 hover:text-blue-900 font-semibold">Edit</button>
                                        <form action="<?= $base ?>/master/ruangan/delete" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?');">
                                            <input type="hidden" name="id" value="<?= $item['id_ruangan'] ?>">
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
<div id="ruanganModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">Tambah Ruangan</h3>
                <form id="ruanganForm" method="POST" class="space-y-4">
                    <input type="hidden" name="id" id="ruanganId">
                    
                    <div>
                        <label for="nama_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" id="nama_ruangan" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="gedung" class="block text-sm font-medium text-gray-700">Gedung</label>
                            <input type="text" name="gedung" id="gedung" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                        </div>
                        <div>
                            <label for="lantai" class="block text-sm font-medium text-gray-700">Lantai</label>
                            <input type="text" name="lantai" id="lantai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="document.getElementById('ruanganForm').submit()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" id="saveButton">
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
    const modal = document.getElementById('ruanganModal');
    const form = document.getElementById('ruanganForm');
    const title = document.getElementById('modal-title');
    const saveBtn = document.getElementById('saveButton');
    
    modal.classList.remove('hidden');

    if (mode === 'create') {
        title.innerText = 'Tambah Ruangan';
        form.action = '<?= $base ?>/master/ruangan/store';
        form.reset();
        document.getElementById('ruanganId').value = '';
        saveBtn.innerText = 'Simpan';
    } else {
        title.innerText = 'Edit Ruangan';
        form.action = '<?= $base ?>/master/ruangan/update';
        
        document.getElementById('ruanganId').value = data.id_ruangan;
        document.getElementById('nama_ruangan').value = data.nama_ruangan;
        document.getElementById('gedung').value = data.gedung || '';
        document.getElementById('lantai').value = data.lantai || '';
        
        saveBtn.innerText = 'Update';
    }
}

function closeModal() {
    document.getElementById('ruanganModal').classList.add('hidden');
}
</script>
