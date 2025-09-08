<?php
require 'includes/admin-header.php';

// Hitung data dari database
$pengacara_count      = $conn->query("SELECT COUNT(*) AS total FROM pengacara")->fetch_assoc()['total'];
$user_count           = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$berita_count         = $conn->query("SELECT COUNT(*) AS total FROM berita")->fetch_assoc()['total'];
$layanan_count        = $conn->query("SELECT COUNT(*) AS total FROM toko_hukum")->fetch_assoc()['total'];
$konsultasi_count     = $conn->query("SELECT COUNT(*) AS total FROM klik_laporan")->fetch_assoc()['total'];
$pengguna_layanan     = $conn->query("SELECT COUNT(*) AS total FROM toko_laporan")->fetch_assoc()['total'];

// Tambahan: konsultasi berbayar & gratis
$konsultasi_berbayar  = $conn->query("SELECT COUNT(*) AS total FROM pengacara WHERE tipe_konsultasi='berbayar'")->fetch_assoc()['total'];
$konsultasi_gratis    = $conn->query("SELECT COUNT(*) AS total FROM pengacara WHERE tipe_konsultasi='gratis'")->fetch_assoc()['total'];
?>

<!-- Konten utama -->
<main class="flex-1 ml-64 p-8 bg-gray-50 min-h-screen">

    <h2 class="text-2xl font-bold text-gray-800 mb-8">Dashboard</h2>

    <!-- Grid Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Pengacara -->
        <div class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-2xl shadow p-6">
            <p class="text-sm opacity-80">Pengacara</p>
            <h3 class="text-2xl font-bold"><?= $pengacara_count; ?></h3>
        </div>

        <!-- User -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-2xl shadow p-6">
            <p class="text-sm opacity-80">User</p>
            <h3 class="text-2xl font-bold"><?= $user_count; ?></h3>
        </div>

        <!-- Berita -->
        <div class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white rounded-2xl shadow p-6">
            <p class="text-sm opacity-80">Berita</p>
            <h3 class="text-2xl font-bold"><?= $berita_count; ?></h3>
        </div>

        <!-- Layanan -->
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow p-6">
            <p class="text-sm opacity-80">Layanan</p>
            <h3 class="text-2xl font-bold"><?= $layanan_count; ?></h3>
        </div>

        <!-- Konsultasi -->
        <div class="bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-2xl shadow p-6">
            <p class="text-sm opacity-80">Konsultasi</p>
            <h3 class="text-2xl font-bold"><?= $konsultasi_count; ?></h3>
        </div>

        <!-- Pengguna Layanan -->
        <div class="bg-gradient-to-r from-violet-500 to-fuchsia-500 text-white rounded-2xl shadow p-6">
            <p class="text-sm opacity-80">Pengguna Layanan</p>
            <h3 class="text-2xl font-bold"><?= $pengguna_layanan; ?></h3>
        </div>

        
    <!-- Konsultasi Berbayar -->
        <div class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white rounded-2xl shadow p-6 md:col-span-2">
            <p class="text-sm opacity-80">Konsultasi Berbayar</p>
            <h3 class="text-2xl font-bold"><?= $konsultasi_berbayar; ?></h3>
        </div>

        <!-- Konsultasi Gratis -->
        <div class="bg-gradient-to-r from-lime-500 to-green-600 text-white rounded-2xl shadow p-6 md:col-span-2">
            <p class="text-sm opacity-80">Konsultasi Gratis</p>
            <h3 class="text-2xl font-bold"><?= $konsultasi_gratis; ?></h3>
        </div>

    </div>
</main>


