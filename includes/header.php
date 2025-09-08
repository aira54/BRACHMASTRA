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
  <style>
    body { font-family: 'Poppins', sans-serif; }
    #page-loader { display: none; position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.9); justify-content: center; align-items: center; }
    .scale-icon { width: 80px; height: 80px; animation: swing 1s ease-in-out infinite; }
    @keyframes swing { 0% { transform: rotate(-10deg); } 50% { transform: rotate(10deg);} 100% { transform: rotate(-10deg);} }
  </style>
</head>

<body class="bg-white text-gray-800">

<!-- Loader -->
<div id="page-loader">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="scale-icon" fill="#2563eb">
      <path d="M32 2l8 16h-4v10h-8V18h-4l8-16zM14 30l6-12 6 12H14zm24 0l6-12 6 12H38zM8 32h12v2c0 5-4 9-9 9H9c-5 0-9-4-9-9v-2h8zm36 0h12v2c0 5-4 9-9 9h-1c-5 0-9-4-9-9v-2h8zm-12 4c4 0 7 3 7 7v19h-14V43c0-4 3-7 7-7z"/>
  </svg>
</div>

<!-- Modal Login -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
  <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 text-center">
    <h2 class="text-xl font-bold text-gray-800 mb-4">⚠️ Akses Ditolak</h2>
    <p class="text-gray-600 mb-6">Silakan <span class="font-semibold text-blue-600">Login</span> atau <span class="font-semibold text-blue-600">Registrasi</span> untuk melanjutkan.</p>
    <div class="flex justify-center space-x-4">
      <a href="<?= BASE_URL ?>login.php" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Login</a>
      <a href="<?= BASE_URL ?>register.php" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Registrasi</a>
      <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</button>
    </div>
  </div>
</div>

<!-- Navbar -->
<nav class="bg-white shadow p-4">
  <div class="max-w-7xl mx-auto flex justify-between items-center">
    
    <!-- Logo / Brand -->
    <div class="flex items-center space-x-8">
      <a href="<?= BASE_URL ?>hukum.php" class="text-lg font-bold text-blue-700">BRACHMASTRA</a>
      <a href="<?= BASE_URL ?>hukum.php" class="text-gray-700 hover:text-blue-600">Beranda</a>
      <a href="<?= BASE_URL ?>pengacara.php" class="text-gray-700 hover:text-blue-600">Pengacara</a>
      <a href="<?= BASE_URL ?>konsultasi.php" class="text-gray-700 hover:text-blue-600">Konsultasi</a>
      <a href="<?= BASE_URL ?>tentang-kami.php" class="text-gray-700 hover:text-blue-600">Tentang Kami</a>
    </div>

    <!-- User Info -->
    <div class="flex items-center space-x-4">
      <?php if (isset($_SESSION['user_id'])): ?>
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a href="<?= BASE_URL ?>admin/admin.php" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Admin Panel</a>
        <?php endif; ?>
        
        <span class="text-sm text-gray-600">Halo, <span class="font-semibold"><?= htmlspecialchars($_SESSION['user_name']) ?></span></span>
        <a href="<?= BASE_URL ?>logout.php" class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600 transition">Logout</a>
      <?php else: ?>
        <a href="<?= BASE_URL ?>login.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">Login</a>
      <?php endif; ?>
    </div>

  </div>
</nav>

<!-- Script Loader + Modal -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

    document.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function (e) {
            const url = this.getAttribute("href");
            if (!url || url === "#" || url.startsWith("javascript:")) return;

            // pengecualian: link kontak & lokasi
            const bebasLogin = (
                url.startsWith("mailto:") ||
                url.startsWith("tel:") ||
                url.includes("instagram.com") ||
                url.includes("facebook.com") ||
                url.includes("hukum.php") ||
                url.includes("google.com/maps")
            );

            if (!isLoggedIn && !bebasLogin && !url.includes("login.php") && !url.includes("register.php")) {
                e.preventDefault();
                openModal();
            } else {
                e.preventDefault();
                document.getElementById("page-loader").style.display = "flex";
                setTimeout(function () {
                    window.location.href = url;
                }, 500);
            }
        });
    });
});

function openModal() {
    document.getElementById("loginModal").classList.remove("hidden");
    document.getElementById("loginModal").classList.add("flex");
}
function closeModal() {
    document.getElementById("loginModal").classList.remove("flex");
    document.getElementById("loginModal").classList.add("hidden");
}
</script>
