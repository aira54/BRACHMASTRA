<?php
// pidana.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Pidana</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
#page-loader {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255, 255, 255, 0.9);
    justify-content: center;
    align-items: center;
}

/* Animasi goyang timbangan */
.scale-icon {
    width: 80px;
    height: 80px;
    animation: swing 1s ease-in-out infinite;
}

@keyframes swing {
    0%   { transform: rotate(-10deg); }
    50%  { transform: rotate(10deg); }
    100% { transform: rotate(-10deg); }
}
</style>

<!-- Loader -->
<div id="page-loader">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="scale-icon" fill="#2563eb">
        <path d="M32 2l8 16h-4v10h-8V18h-4l8-16zM14 30l6-12 6 12H14zm24 0l6-12 6 12H38zM8 32h12v2c0 5-4 9-9 9H9c-5 0-9-4-9-9v-2h8zm36 0h12v2c0 5-4 9-9 9h-1c-5 0-9-4-9-9v-2h8zm-12 4c4 0 7 3 7 7v19h-14V43c0-4 3-7 7-7z"/>
    </svg>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function (e) {
            const url = this.getAttribute("href");

            if (
                url &&
                url !== "#" &&
                !url.startsWith("javascript:") &&
                !this.target &&
                this.host === window.location.host &&
                e.button === 0 &&
                !e.ctrlKey && !e.metaKey
            ) {
                e.preventDefault();
                document.getElementById("page-loader").style.display = "flex";

                setTimeout(function () {
                    window.location.href = url;
                }, 700); // Durasi loading 0.7 detik
            }
        });
    });
});
</script>



<body class="bg-gray-100">

    <nav class="bg-white shadow p-4">
  <div class="max-w-6xl mx-auto flex justify-between items-center">
    <a href="../../hukum.php" class="text-xl font-semibold text-blue-700">BRACHMASTRA</a>
    <div>
     <a href="../../hukum.php" class="text-sm text-gray-700 hover:text-blue-600 font-medium px-4">Kembali</a>
    </div>
  </div>
</nav>

<div class="max-w-6xl mx-auto py-10 px-4">
   
       

        <!-- Menu lain -->
<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Toko Hukum (Lebar 2 kolom) -->
        <a href="toko-hukum-pidana.php" class="block rounded-lg overflow-hidden shadow-lg hover:scale-105 transform transition sm:col-span-3">
            <img src="../../asset/100.webp" alt="Toko Hukum" class="w-full h-48 object-cover">
            <div class="p-6 bg-white">
                <h3 class="text-2xl font-bold">Layanan Hukum 🏛️</h3>
                <p class="mt-2 text-gray-600">Melayani kebutuhan hukum seperti pendampingan persidangan,  pembuatan dokumen, dan lainnya.</p>
            </div>
        </a>

        <!-- Konsultasi -->
        <a href="konsultasi-pidana.php" class="block rounded-lg overflow-hidden shadow-lg hover:scale-105 transform transition sm:col-span-2">
            <img src="../../asset/103.jpg" alt="Konsultasi" class="w-full h-48 object-cover">
            <div class="p-4 bg-white">
                <h3 class="text-lg font-bold">Konsultasi 💬</h3>
                <p class="text-sm text-gray-600">Layanan konsultasi hukum gratis atau berbayar dengan pengacara.</p>
            </div>
        </a>

        <!-- Berita -->
        <a href="berita-pidana.php" class="block rounded-lg overflow-hidden shadow-lg hover:scale-105 transform transition sm:col-span-1">
            <img src="../../asset/101.webp" alt="Berita" class="w-full h-48 object-cover">
            <div class="p-4 bg-white">
                <h3 class="text-lg font-bold">Berita 📰</h3>
                <p class="text-sm text-gray-600">Informasi terkini seputar hukum dan peradilan di Indonesia.</p>
            </div>
        </a>

    </div>
</div>



</body>
</html>
