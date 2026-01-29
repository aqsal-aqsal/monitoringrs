<?php
$title = $title ?? 'HOSMON - Hospital Monitoring System';
$base = \App\Helpers\Url::base();
?><!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title) ?></title>
  <link rel="icon" type="image/png" href="<?= $base ?>/img/rslogo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html, body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-900">
  <header class="bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
      <div class="font-semibold">HOSMON</div>
      <nav class="flex items-center gap-4">
        <?php
        $base = \App\Helpers\Url::base();
        ?>
        <?php if (\App\Helpers\Auth::check()):
              $user = \App\Helpers\Auth::user();
              $role = $user['role_name'] ?? '';
          ?>
            <a href="<?= $base ?>/dashboard" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-50 transition shadow-sm">
                Dashboard
            </a>
          <?php else: ?>
            <a href="<?= $base ?>/login" class="bg-white text-blue-600 px-3 py-1 rounded text-sm font-medium hover:bg-blue-50 transition">Masuk</a>
          <?php endif; ?>
      </nav>
    </div>
  </header>
  <main class="<?= isset($fullWidth) && $fullWidth ? '' : 'max-w-7xl mx-auto px-4 py-6' ?>">
    <?php $content(); ?>
  </main>
  <?php if (!isset($hideFooter)): ?>
  <footer class="<?= isset($fullWidth) && $fullWidth ? 'bg-gray-900 text-gray-400 py-12' : 'max-w-7xl mx-auto px-4 py-6 text-sm text-gray-500' ?>">
    <?php if (isset($fullWidth) && $fullWidth): ?>
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-2 mb-4 text-white font-bold text-xl">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    HOSMON
                </div>
                <p class="text-sm">Hospital Monitoring System Terpadu.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Product</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Overview</a></li>
                    <li><a href="#" class="hover:text-white">Features</a></li>
                    <li><a href="#" class="hover:text-white">Solutions</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Resources</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Blog</a></li>
                    <li><a href="#" class="hover:text-white">Newsletter</a></li>
                    <li><a href="#" class="hover:text-white">Help Center</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Terms</a></li>
                    <li><a href="#" class="hover:text-white">Privacy</a></li>
                    <li><a href="#" class="hover:text-white">Cookies</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 mt-12 pt-8 border-t border-gray-800 text-sm flex justify-between items-center">
            <div>© 2026 HOSMON. All rights reserved.</div>
            <div class="flex gap-4">
                <a href="#" class="hover:text-white">Twitter</a>
                <a href="#" class="hover:text-white">LinkedIn</a>
                <a href="#" class="hover:text-white">Facebook</a>
            </div>
        </div>
    <?php else: ?>
        <div>© HOSMON • Hospital Monitoring System</div>
    <?php endif; ?>
  </footer>
  <?php endif; ?>
</body>
</html>
