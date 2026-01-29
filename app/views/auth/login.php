<?php
$title = 'Masuk';
?>
<div class="max-w-md mx-auto mt-10 bg-white shadow rounded p-6">
  <h1 class="text-2xl font-semibold mb-4 text-blue-600">Masuk</h1>
  <?php if (!empty($error)): ?>
    <div class="mb-4 bg-red-100 text-red-700 px-3 py-2 rounded"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <form method="post" action="<?= \App\Helpers\Url::to('/login') ?>" class="space-y-4">
    <div>
      <label class="block text-sm mb-1">Username</label>
      <input type="text" name="username" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <div>
      <label class="block text-sm mb-1">Password</label>
      <input type="password" name="password" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded">Masuk</button>
  </form>
</div>
