<?php
$title = 'Edit Pengguna';
$base = \App\Helpers\Url::base();
$user = $user ?? [];
?>

<div class="max-w-2xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="<?= $base ?>/dashboard" class="text-gray-500 hover:text-gray-700 text-sm font-medium">Dashboard</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <a href="<?= $base ?>/master/users" class="ml-1 text-gray-500 hover:text-gray-700 text-sm font-medium md:ml-2">Pengguna</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-gray-900 text-sm font-medium md:ml-2">Edit</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Edit Pengguna</h1>
            <p class="mt-1 text-sm text-gray-500">Perbarui informasi pengguna.</p>
        </div>

        <form action="<?= $base ?>/master/users/update" method="POST" class="space-y-6">
            <input type="hidden" name="id" value="<?= $user['id_user'] ?>">
            
            <!-- Nama Lengkap -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <div class="mt-1">
                    <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($user['nama']) ?>" required class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-2 border">
                </div>
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <div class="mt-1">
                    <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-2 border">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                <div class="mt-1 relative">
                    <input type="password" name="password" id="password" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-2 border" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>
                <p class="mt-1 text-xs text-gray-500">Isi hanya jika ingin mereset password user ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Role -->
                <div>
                    <label for="id_role" class="block text-sm font-medium text-gray-700">Role / Peran</label>
                    <div class="mt-1">
                        <select id="id_role" name="id_role" required class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg border">
                            <?php foreach ($roles as $r): ?>
                                <option value="<?= $r['id_role'] ?>" <?= $user['id_role'] == $r['id_role'] ? 'selected' : '' ?>><?= $r['nama_role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Unit / Ruangan -->
                <div>
                    <label for="unit" class="block text-sm font-medium text-gray-700">Unit / Ruangan</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="text" name="unit" id="unit" list="list-ruangan" value="<?= htmlspecialchars($user['unit'] ?? '') ?>" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-2 border" placeholder="Pilih atau ketik unit...">
                        <datalist id="list-ruangan">
                            <?php foreach ($ruanganList as $ruang): ?>
                                <option value="<?= htmlspecialchars($ruang['nama_ruangan']) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status Akun</label>
                <div class="mt-1">
                    <select id="status" name="status" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg border">
                        <option value="aktif" <?= ($user['status'] ?? 'aktif') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="nonaktif" <?= ($user['status'] ?? 'aktif') === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200 flex justify-end gap-3">
                <a href="<?= $base ?>/master/users" class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
