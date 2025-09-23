<?php
session_start();
if(!isset($_SESSION['user_id'])) {
  header('Location: register.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BRACHMASTRA - Beranda</title>
<link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">

<!-- Header -->
<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-50 to-blue-100 py-16">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
    
    <!-- Text -->
    <div>
      <h1 class="text-4xl md:text-5xl font-extrabold text-blue-700 leading-tight mb-6">
        Mari buat konsultasi hukummu lebih mudah & cepat
      </h1>
      <p class="text-gray-700 text-lg mb-8">
        BRACHMASTRA menyediakan layanan kontak konsultan hukum dengan pengacara profesional. 
        Dapatkan solusi tepat untuk masalah hukummu dengan cepat dan terpercaya.
      </p>
      <a href="hukum.php" 
         class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition">
        Konsultasi Sekarang
      </a>
    </div>

    <!-- Image -->
    <div class="flex justify-center">
      <img src="asset/logo2.png" alt="Konsultasi Hukum" class="rounded-xl shadow-lg w-full max-w-md">
    </div>
  </div>
</section>

<!-- Welcome Section -->
<section class="py-12 bg-white">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Selamat datang, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>
    <p class="text-gray-600">
      Kamu berhasil login ke BRACHMASTRA. Mulailah konsultasi dan temukan jalur hukum terbaik untuk masalahmu.
    </p>
  </div>
</section>

</body>
</html>
