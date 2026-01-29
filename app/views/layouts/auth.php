<?php
$title = $title ?? 'Masuk';
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
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">
  
  <main class="flex-grow flex flex-col justify-center">
    <?php $content(); ?>
  </main>

  <footer class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-500 text-center w-full">
    <div>© 2026 Rumah Sakit • Monitoring & Inventaris</div>
  </footer>

</body>
</html>
