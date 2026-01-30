<?php
$title = 'Daftar Pengguna';
$users = $users ?? [];
$roles = $roles ?? [];
$ruanganList = $ruanganList ?? [];
$base = \App\Helpers\Url::base();
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Daftar Pengguna</h1>
            <p class="mt-1 text-sm text-gray-500">Kelola akses pengguna sistem monitoring.</p>
        </div>
        <div>
            <button onclick="openModal('create')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Pengguna
            </button>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline"><?= htmlspecialchars($_GET['error']) ?></span>
        </div>
    <?php endif; ?>

    <!-- Table Card -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <!-- Search & Filter (Optional, visual only for now) -->
        <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="relative max-w-sm w-full">
                <input type="text" placeholder="Cari pengguna..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full transition">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Unit</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                Belum ada data pengguna
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $u): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">
                                            <?= strtoupper(substr($u['nama'] ?? $u['username'], 0, 2)) ?>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($u['nama']) ?></div>
                                            <div class="text-xs text-gray-500"><?= htmlspecialchars($u['username']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                    $roleColor = match($u['nama_role']) {
                                        'ADMIN' => 'bg-blue-100 text-blue-800',
                                        'TEKNISI' => 'bg-purple-100 text-purple-800',
                                        'PETUGAS_RUANGAN' => 'bg-gray-100 text-gray-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $roleColor ?>">
                                        <?= htmlspecialchars($u['nama_role']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?= htmlspecialchars($u['unit'] ?? '-') ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if (($u['status'] ?? 'aktif') === 'aktif'): ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-50 text-green-700">
                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-green-600"></span>
                                            Aktif
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-50 text-red-700">
                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-red-600"></span>
                                            Nonaktif
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        <button onclick='openModal("edit", <?= htmlspecialchars(json_encode($u), ENT_QUOTES, 'UTF-8') ?>)' class="text-blue-600 hover:text-blue-900 font-semibold">Edit</button>
                                        <form action="<?= $base ?>/master/users/delete" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            <input type="hidden" name="id" value="<?= $u['id_user'] ?>">
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
        
        <!-- Pagination Placeholder -->
        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-500">Showing 1 to <?= count($users) ?> of <?= count($users) ?> results</div>
            <div class="flex gap-2">
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50" disabled>Previous</button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50" disabled>Next</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="userModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>

        <!-- Modal panel -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambah Pengguna</h3>
                        <div class="mt-4">
                            <form id="userForm" method="POST" class="space-y-4">
                                <input type="hidden" name="id" id="userId">
                                
                                <!-- Nama -->
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                                </div>

                                <!-- Username -->
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                    <input type="text" name="username" id="username" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700" id="passwordLabel">Password</label>
                                    <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                                    <p class="mt-1 text-xs text-gray-500 hidden" id="passwordHelp">Kosongkan jika tidak ingin mengubah password.</p>
                                </div>

                                <!-- Role & Unit Grid -->
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Role -->
                                    <div>
                                        <label for="id_role" class="block text-sm font-medium text-gray-700">Role</label>
                                        <select id="id_role" name="id_role" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                                            <option value="">Pilih Role</option>
                                            <?php foreach ($roles as $r): ?>
                                                <option value="<?= $r['id_role'] ?>"><?= $r['nama_role'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Unit -->
                                    <div>
                                        <label for="unit" class="block text-sm font-medium text-gray-700">Unit</label>
                                        <input type="text" name="unit" id="unit" list="list-ruangan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border px-3 py-2">
                                        <datalist id="list-ruangan">
                                            <?php foreach ($ruanganList as $ruang): ?>
                                                <option value="<?= htmlspecialchars($ruang['nama_ruangan']) ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>
                                    </div>
                                </div>

                                <!-- Status (Only for Edit) -->
                                <div id="statusField" class="hidden">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="document.getElementById('userForm').submit()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" id="saveButton">
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
    const modal = document.getElementById('userModal');
    const form = document.getElementById('userForm');
    const title = document.getElementById('modal-title');
    const saveBtn = document.getElementById('saveButton');
    const passwordHelp = document.getElementById('passwordHelp');
    const statusField = document.getElementById('statusField');
    const passwordInput = document.getElementById('password');

    modal.classList.remove('hidden');

    if (mode === 'create') {
        title.innerText = 'Tambah Pengguna Baru';
        form.action = '<?= $base ?>/master/users/store';
        form.reset();
        document.getElementById('userId').value = '';
        passwordInput.required = true;
        passwordHelp.classList.add('hidden');
        statusField.classList.add('hidden');
        saveBtn.innerText = 'Simpan';
    } else {
        title.innerText = 'Edit Pengguna';
        form.action = '<?= $base ?>/master/users/update';
        
        document.getElementById('userId').value = data.id_user;
        document.getElementById('nama').value = data.nama;
        document.getElementById('username').value = data.username;
        document.getElementById('id_role').value = data.id_role;
        document.getElementById('unit').value = data.unit || '';
        document.getElementById('status').value = data.status;
        
        passwordInput.value = '';
        passwordInput.required = false;
        passwordHelp.classList.remove('hidden');
        statusField.classList.remove('hidden');
        saveBtn.innerText = 'Update';
    }
}

function closeModal() {
    document.getElementById('userModal').classList.add('hidden');
}
</script>