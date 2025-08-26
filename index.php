<?php
session_start();
if(!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
<title>BRACHMASTRA - Beranda</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white">
<nav class="bg-white shadow p-4 flex justify-between">
  <h1 class="text-xl font-bold text-blue-700">BRACHMASTRA</h1>
  <div class="flex items-center space-x-4">
    <span class="text-sm text-gray-700">Halo, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
    <a href="logout.php" class="bg-red-500 text-white px-3 py-1 rounded">Logout</a>
  </div>
</nav>
<div class="p-6">
  <h2 class="text-2xl font-semibold mb-4">Selamat datang di BRACHMASTRA</h2>
  <p>Ini adalah halaman yang hanya bisa diakses setelah login.</p>
  <div class="mt-6">
    <a href="hukum.php" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
      KONSULTASI SEKARANG!
    </a>
  </div>
</div>
</body>
</html>
