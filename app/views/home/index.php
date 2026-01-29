<?php
$base = \App\Helpers\Url::base();
?>
<!-- Hero Section -->
<section class="relative bg-white pt-20 pb-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Text Content -->
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-sm font-medium mb-6">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    Sistem Manajemen Aset Medis v2.0
                </div>
                <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 tracking-tight mb-6 leading-tight">
                    Monitoring Aset RS <br>
                    <span class="text-blue-600">Tanpa Hambatan</span>
                </h1>
                <p class="text-xl text-gray-500 mb-8 leading-relaxed">
                    Platform terintegrasi untuk memantau kondisi, lokasi, dan jadwal maintenance peralatan medis secara real-time. Tingkatkan efisiensi pelayanan sekarang.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?= $base ?>/login" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 md:text-lg transition shadow-lg shadow-blue-600/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Akses Dashboard
                    </a>
                    <a href="#features" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 md:text-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pelajari Fitur
                    </a>
                </div>
            </div>
            
            <!-- Hero Image / Illustration -->
            <div class="relative">
                <div class="absolute -top-4 -right-4 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob"></div>
                <div class="absolute -bottom-8 -left-4 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-2000"></div>
                
                <div class="relative bg-gray-900 rounded-2xl shadow-2xl border border-gray-800 p-2 transform rotate-2 hover:rotate-0 transition duration-500">
                    <!-- Mockup Header -->
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-gray-800">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        <div class="flex-1 text-center text-xs text-gray-500 font-mono">dashboard.monitor-rs.local</div>
                    </div>
                    <!-- Mockup Content -->
                    <div class="bg-gray-900 p-6 rounded-b-xl">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <div class="h-2 w-24 bg-gray-700 rounded mb-2"></div>
                                <div class="h-4 w-32 bg-gray-600 rounded"></div>
                            </div>
                            <div class="h-8 w-8 bg-blue-600 rounded-lg"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-gray-800 p-4 rounded-lg border border-gray-700">
                                <div class="h-8 w-8 bg-green-900/50 rounded-lg mb-3 flex items-center justify-center">
                                    <div class="h-4 w-4 bg-green-500 rounded-full"></div>
                                </div>
                                <div class="h-2 w-16 bg-gray-600 rounded mb-2"></div>
                                <div class="h-6 w-12 bg-gray-500 rounded"></div>
                            </div>
                            <div class="bg-gray-800 p-4 rounded-lg border border-gray-700">
                                <div class="h-8 w-8 bg-red-900/50 rounded-lg mb-3 flex items-center justify-center">
                                    <div class="h-4 w-4 bg-red-500 rounded-full"></div>
                                </div>
                                <div class="h-2 w-16 bg-gray-600 rounded mb-2"></div>
                                <div class="h-6 w-12 bg-gray-500 rounded"></div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="h-12 bg-gray-800 rounded-lg border border-gray-700"></div>
                            <div class="h-12 bg-gray-800 rounded-lg border border-gray-700"></div>
                            <div class="h-12 bg-gray-800 rounded-lg border border-gray-700"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Floating Card -->
                <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-xl border border-gray-100 max-w-xs animate-bounce" style="animation-duration: 3s;">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-gray-900">Maintenance Selesai</div>
                            <div class="text-xs text-gray-500">USG Ruang Melati 01</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trusted By Section -->
<section class="border-y border-gray-100 bg-gray-50/50 py-10">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm font-medium text-gray-500 mb-6">DIPERCAYA OLEH INSTALASI PELAYANAN MEDIS</p>
        <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
            <!-- Dummy Logos -->
            <div class="flex items-center gap-2 text-xl font-bold text-gray-800"><span class="w-6 h-6 bg-blue-600 rounded"></span> MedikaUtama</div>
            <div class="flex items-center gap-2 text-xl font-bold text-gray-800"><span class="w-6 h-6 bg-green-600 rounded-full"></span> HealthCare+</div>
            <div class="flex items-center gap-2 text-xl font-bold text-gray-800"><span class="w-6 h-6 bg-red-500 transform rotate-45"></span> PrimaSehat</div>
            <div class="flex items-center gap-2 text-xl font-bold text-gray-800"><span class="w-6 h-6 bg-purple-600 rounded-tr-xl"></span> BioLab</div>
            <div class="flex items-center gap-2 text-xl font-bold text-gray-800"><span class="w-6 h-6 bg-orange-500 rounded-lg"></span> FarmaKlinik</div>
        </div>
    </div>
</section>

<!-- Features Grid -->
<section id="features" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Solusi Lengkap Manajemen Aset</h2>
            <p class="text-gray-500 text-lg">Kelola ratusan aset medis dengan mudah melalui satu platform terintegrasi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="group relative bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-purple-700 transform scale-x-0 group-hover:scale-x-100 transition duration-500"></div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-6 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Monitoring Real-time</h3>
                <p class="text-gray-500 mb-6 leading-relaxed">Pantau kondisi seluruh alat medis dari dashboard pusat. Deteksi kerusakan lebih awal.</p>
                <a href="#" class="inline-flex items-center text-purple-600 font-semibold hover:text-purple-700">
                    Pelajari lebih lanjut <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <!-- Feature 2 -->
            <div class="group relative bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-green-700 transform scale-x-0 group-hover:scale-x-100 transition duration-500"></div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Jadwal Maintenance</h3>
                <p class="text-gray-500 mb-6 leading-relaxed">Sistem otomatis mengingatkan jadwal perawatan berkala untuk setiap aset.</p>
                <a href="#" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700">
                    Pelajari lebih lanjut <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <!-- Feature 3 -->
            <div class="group relative bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-700 transform scale-x-0 group-hover:scale-x-100 transition duration-500"></div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Pelaporan Cepat</h3>
                <p class="text-gray-500 mb-6 leading-relaxed">Petugas ruangan dapat melaporkan kerusakan aset via mobile dalam hitungan detik.</p>
                <a href="#" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700">
                    Pelajari lebih lanjut <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Showcase Section -->
<section class="py-24 bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-blue-600 font-semibold tracking-wide uppercase text-sm">Dashboard Terpusat</span>
            <h2 class="mt-2 text-3xl lg:text-4xl font-bold text-gray-900">Kontrol Penuh dalam Satu Layar</h2>
            <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">Tidak perlu lagi membuka banyak file excel. Semua data inventaris dan maintenance tersedia real-time.</p>
        </div>
        
        <div class="relative mx-auto max-w-5xl">
            <!-- Mockup Device -->
            <div class="bg-gray-900 rounded-3xl shadow-2xl border-4 border-gray-800 p-2 relative z-10">
                 <div class="flex items-center gap-2 px-4 py-3 border-b border-gray-800">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-b-xl p-8 aspect-video flex items-center justify-center">
                    <div class="text-center">
                         <svg class="w-24 h-24 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                         <p class="text-gray-500 text-lg">Dashboard Interface Preview</p>
                    </div>
                </div>
            </div>
            
            <!-- Decor Blobs -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-blue-500/20 blur-3xl -z-10 rounded-full"></div>
        </div>

        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-gray-900 mb-2">500+</div>
                <div class="text-gray-500">Aset Terdata</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-gray-900 mb-2">99%</div>
                <div class="text-gray-500">Uptime Alat Medis</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-gray-900 mb-2">24/7</div>
                <div class="text-gray-500">Monitoring Sistem</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-blue-600">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Siap Meningkatkan Kualitas Pelayanan?</h2>
        <p class="text-blue-100 text-lg mb-8">Bergabunglah dengan rumah sakit modern lainnya yang telah beralih ke sistem digital.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="<?= $base ?>/login" class="px-8 py-4 bg-white text-blue-600 rounded-lg font-bold hover:bg-gray-50 transition shadow-lg">Mulai Sekarang</a>
            <a href="#" class="px-8 py-4 bg-blue-700 text-white rounded-lg font-bold hover:bg-blue-800 transition border border-blue-500">Hubungi Tim IT</a>
        </div>
    </div>
</section>
