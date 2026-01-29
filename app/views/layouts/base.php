<?php
$title = $title ?? 'Monitoring Inventaris RS';
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
  </style>
</head>
<body class="bg-gray-50 text-gray-900">
  <header class="bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
      <div class="font-semibold">Monitoring Inventaris RS</div>
      <nav class="flex items-center gap-3">
        <a href="/dashboard" class="hover:underline">Dashboard</a>
        <a href="/logout" class="bg-white text-blue-600 px-3 py-1 rounded">Keluar</a>
      </nav>
    </div>
  </header>
  <main class="max-w-7xl mx-auto px-4 py-6">
    <?php $content(); ?>
  </main>
  <footer class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-500">
    <div>© Rumah Sakit • Monitoring & Inventaris</div>
  </footer>
</body>
</html>
