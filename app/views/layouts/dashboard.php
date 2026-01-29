<?php
$title = $title ?? 'Monitoring Inventaris RS';
$user = \App\Helpers\Auth::user();
$role = $user['role_name'] ?? '';
$base = \App\Helpers\Url::base();
?><!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html, body { font-family: 'Inter', sans-serif; }
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 h-screen overflow-hidden flex">
  
  <!-- Sidebar -->
  <aside class="w-64 bg-gray-900 text-white hidden md:flex flex-col flex-shrink-0 transition-all duration-300">
    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-gray-800">
        <div class="font-bold text-xl tracking-tight flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            SimRS
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1 no-scrollbar">
        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Menu Utama</p>
        
        <a href="<?= $base ?>/dashboard" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 <?= strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false ? 'bg-gray-800 text-blue-400' : 'text-gray-300' ?>">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            Dashboard
        </a>

        <?php if ($role === 'ADMIN'): ?>
        <div class="pt-4">
            <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Master Data</p>
            <a href="<?= $base ?>/master/barang" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 <?= strpos($_SERVER['REQUEST_URI'], '/master/barang') !== false ? 'bg-gray-800 text-blue-400' : 'text-gray-300' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Data Barang
            </a>
            <a href="<?= $base ?>/master/kategori" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 <?= strpos($_SERVER['REQUEST_URI'], '/master/kategori') !== false ? 'bg-gray-800 text-blue-400' : 'text-gray-300' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Kategori Barang
            </a>
            <a href="<?= $base ?>/master/ruangan" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 <?= strpos($_SERVER['REQUEST_URI'], '/master/ruangan') !== false ? 'bg-gray-800 text-blue-400' : 'text-gray-300' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Data Ruangan
            </a>
        </div>
        <?php endif; ?>

        <div class="pt-4">
            <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Operasional</p>
            
            <?php if ($role === 'PETUGAS_RUANGAN'): ?>
            <a href="<?= $base ?>/laporan/create" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 <?= strpos($_SERVER['REQUEST_URI'], '/laporan/create') !== false ? 'bg-gray-800 text-blue-400' : 'text-gray-300' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Buat Laporan
            </a>
            <a href="<?= $base ?>/laporan/saya" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 <?= strpos($_SERVER['REQUEST_URI'], '/laporan/saya') !== false ? 'bg-gray-800 text-blue-400' : 'text-gray-300' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Riwayat Laporan
            </a>
            <?php endif; ?>

            <?php if ($role === 'ADMIN' || $role === 'TEKNISI'): ?>
            <a href="<?= $base ?>/laporan/admin" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 <?= strpos($_SERVER['REQUEST_URI'], '/laporan/admin') !== false ? 'bg-gray-800 text-blue-400' : 'text-gray-300' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Laporan Masuk
            </a>
            <a href="<?= $base ?>/maintenance" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 <?= strpos($_SERVER['REQUEST_URI'], '/maintenance') !== false ? 'bg-gray-800 text-blue-400' : 'text-gray-300' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Maintenance
            </a>
            <?php endif; ?>
        </div>

    </div>

    <!-- User Profile Bottom -->
    <div class="p-4 border-t border-gray-800">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-sm font-bold text-white">
                <?= substr($user['username'], 0, 1) ?>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate"><?= htmlspecialchars($user['username']) ?></p>
                <p class="text-xs text-gray-400 truncate"><?= $user['role_name'] ?></p>
            </div>
        </div>
        <a href="<?= $base ?>/logout" class="block w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white text-center rounded text-sm transition">
            Keluar
        </a>
    </div>
  </aside>

  <!-- Main Content Wrapper -->
  <div class="flex-1 flex flex-col min-h-0 overflow-hidden">
    
    <!-- Mobile Header -->
    <header class="bg-white border-b border-gray-200 md:hidden flex items-center justify-between p-4">
        <div class="font-bold text-lg text-gray-800">SimRS</div>
        <button onclick="document.querySelector('aside').classList.toggle('hidden'); document.querySelector('aside').classList.toggle('absolute'); document.querySelector('aside').classList.toggle('z-50'); document.querySelector('aside').classList.toggle('h-full');" class="text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </header>

    <!-- Content Scrollable Area -->
    <main class="flex-1 overflow-y-auto p-4 md:p-8">
        <div class="max-w-6xl mx-auto">
            <?php $content(); ?>
        </div>
    </main>

  </div>

</body>
</html>
