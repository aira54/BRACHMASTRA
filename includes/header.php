<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/../config.php"; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Brachmastra</title>
  <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>asset/brachmastra.png">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

  <style>
    body { font-family: 'Poppins', sans-serif; }
    .scrolled { box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .social-icon {
      transition: transform 0.2s, opacity 0.2s;
    }
    .social-icon:hover {
      transform: scale(1.2);
      opacity: 0.8;
    }

    /* Loader style */
    #loader {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }
    .spinner {
      border: 6px solid #f3f3f3;
      border-top: 6px solid #3498db;
      border-radius: 50%;
      width: 50px; height: 50px;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>

<body class="bg-white text-gray-800">

<!-- Loader -->
<div id="loader">
  <div class="spinner"></div>
</div>

<!-- KONTEN UTAMA -->
<div id="main-content" style="display:none;">

<!-- NAVBAR -->
<header class="fixed top-0 left-0 w-full z-50">

<div class="bg-blue-900 text-white text-sm">
  <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center px-4 py-2 space-y-2 sm:space-y-0">
    
    <!-- Menu kiri -->
    <div class="flex flex-wrap space-x-4 text-xs sm:text-sm">
      <a href="<?= BASE_URL ?>tentang-kami.php" class="hover:underline">Tentang Kami</a>
      <a href="<?= BASE_URL ?>pengacara.php" class="hover:underline">Mitra Pengacara</a>
    </div>

    <!-- Sosial Media -->
    <div class="flex flex-wrap items-center gap-2 sm:gap-4 text-xs sm:text-sm">
      <span class="whitespace-nowrap">Ikuti Kami:</span>
      <div class="flex gap-2 text-base sm:text-lg">
        <a href="https://instagram.com/whobaraghe" target="_blank" class="social-icon text-gray-200 hover:text-pink-400">
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="https://x.com/brachmastra" target="_blank" class="social-icon text-gray-200 hover:text-black">
          <i class="fa-brands fa-x-twitter"></i>
        </a>
        <a href="https://facebook.com/brachmastra" target="_blank" class="social-icon text-gray-200 hover:text-blue-500">
          <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="https://tiktok.com/@brachmastra" target="_blank" class="social-icon text-gray-200 hover:text-gray-100">
          <i class="fa-brands fa-tiktok"></i>
        </a>
      </div>
    </div>

  </div>
</div>


  <!-- Strip Bawah -->
  <nav id="navbar" class="bg-white transition-shadow duration-300">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
      
      <!-- Logo -->
      <a href="<?= BASE_URL ?>hukum.php" class="text-xl font-bold text-blue-700">BRACHMASTRA</a>

      <!-- Menu Navigasi -->
      <div class="hidden md:flex space-x-6">
        <a href="<?= BASE_URL ?>hukum.php" class="text-gray-700 hover:text-blue-600">Beranda</a>
        <a href="<?= BASE_URL ?>layanan.php" class="text-gray-700 hover:text-blue-600">Layanan Hukum</a>
        <a href="<?= BASE_URL ?>konsultasi.php" class="text-gray-700 hover:text-blue-600">Konsultasi</a>
      </div>

      <!-- User / Login -->
      <div class="hidden md:flex items-center space-x-4">
        <?php if (isset($_SESSION['user_id'])): ?>
          <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="<?= BASE_URL ?>admin/admin.php" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Admin Panel</a>
          <?php endif; ?>
          <span class="text-sm text-gray-600">Halo, <span class="font-semibold"><?= htmlspecialchars($_SESSION['user_name']) ?></span></span>
          <a href="<?= BASE_URL ?>logout.php" class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600">Logout</a>
        <?php else: ?>
          <a href="<?= BASE_URL ?>login.php" class="px-4 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white transition">Masuk</a>
          <a href="<?= BASE_URL ?>register.php" class="px-4 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition">Daftar</a>
        <?php endif; ?>
      </div>

      <!-- Hamburger -->
      <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">☰</button>
    </div>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="hidden md:hidden mt-2 space-y-2 px-4 pb-4">
      <a href="<?= BASE_URL ?>hukum.php" class="block text-gray-700 hover:text-blue-600">Beranda</a>
      <a href="<?= BASE_URL ?>layanan.php" class="block text-gray-700 hover:text-blue-600">Layanan Hukum</a>
      <a href="<?= BASE_URL ?>konsultasi.php" class="block text-gray-700 hover:text-blue-600">Konsultasi</a>
      
      <?php if (isset($_SESSION['user_id'])): ?>
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a href="<?= BASE_URL ?>admin/admin.php" class="block bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Admin Panel</a>
        <?php endif; ?>
        <span class="block text-sm text-gray-600">Halo, <span class="font-semibold"><?= htmlspecialchars($_SESSION['user_name']) ?></span></span>
        <a href="<?= BASE_URL ?>logout.php" class="block bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600">Logout</a>
      <?php else: ?>
        <a href="<?= BASE_URL ?>login.php" class="block px-4 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white">Masuk</a>
        <a href="<?= BASE_URL ?>register.php" class="block px-4 py-1 bg-green-600 text-white rounded hover:bg-green-700">Daftar</a>
      <?php endif; ?>
    </div>
  </nav>
</header>

<!-- Jarak isi biar tidak ketutup navbar -->
<div class="pt-28"></div>

</div> <!-- end main-content -->

<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    const navbar = document.getElementById("navbar");

    // Toggle menu mobile
    menuToggle.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
    });

    // Efek shadow saat scroll
    window.addEventListener("scroll", function () {
        if (window.scrollY > 10) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });

    // Loader hilang setelah 0.7 detik
    setTimeout(function(){
      document.getElementById("loader").style.display = "none";
      document.getElementById("main-content").style.display = "block";
    }, 700);
});
</script>

</body>
</html>
