<?php
$title = $title ?? 'Rumah Sakit';
?>
<section class="bg-white shadow rounded p-8">
  <div class="flex flex-col md:flex-row items-center gap-6">
    <div class="flex-1">
      <h1 class="text-3xl md:text-4xl font-bold text-blue-600">Monitoring & Inventaris Rumah Sakit</h1>
      <p class="mt-3 text-gray-600">Pantau kesiapan alat, ketepatan maintenance, dan kecepatan pelaporan kerusakan secara real-time.</p>
      <div class="mt-6 flex gap-3">
        <a href="<?= \App\Helpers\Url::to('/login') ?>" class="bg-blue-600 text-white px-4 py-2 rounded">Masuk</a>
        <a href="#" class="text-blue-600 underline">Pelajari lebih lanjut</a>
      </div>
    </div>
    <div class="flex-1">
      <div class="grid grid-cols-2 gap-4">
        <div class="bg-blue-50 p-4 rounded">
          <div class="text-sm text-gray-500">Status</div>
          <div class="text-xl font-semibold text-blue-600">Baik • Rusak • Maintenance</div>
        </div>
        <div class="bg-green-50 p-4 rounded">
          <div class="text-sm text-gray-500">Kesiapan</div>
          <div class="text-xl font-semibold text-green-600">Layak Pakai</div>
        </div>
        <div class="bg-yellow-50 p-4 rounded">
          <div class="text-sm text-gray-500">Jadwal</div>
          <div class="text-xl font-semibold text-yellow-600">Maintenance Berkala</div>
        </div>
        <div class="bg-red-50 p-4 rounded">
          <div class="text-sm text-gray-500">Pelaporan</div>
          <div class="text-xl font-semibold text-red-600">Cepat & Terstruktur</div>
        </div>
      </div>
    </div>
  </div>
</section>
