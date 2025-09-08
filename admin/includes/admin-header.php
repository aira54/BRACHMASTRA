<?php
// admin-header.php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../db.php';

// Cek login admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// nama file yang sedang dibuka
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="icon" type="image/x-icon" href="../asset/admin.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex">

<!-- Sidebar -->
<aside class="w-64 bg-white shadow h-screen fixed top-0 left-0 flex flex-col">
    <div class="p-6 flex flex-col h-full">
        <h1 class="text-2xl font-bold text-blue-700 mb-8">Admin Panel</h1>
        <nav class="flex-1">
            <ul class="space-y-2">
             <li>
                    <a href="admin.php"
                       class="block px-4 py-2 rounded transition 
                       <?php echo ($current_page=='admin.php') ? 'bg-blue-200 font-semibold text-blue-800' : 'hover:bg-blue-100'; ?>">
                        Dashboard
                    </a>
                <li></li>  
            <li>
                    <a href="pengacara-user.php"
                       class="block px-4 py-2 rounded transition 
                       <?php echo ($current_page=='pengacara-user.php') ? 'bg-blue-200 font-semibold text-blue-800' : 'hover:bg-blue-100'; ?>">
                        Panel Pengacara & User
                    </a>
                <li>
                    <a href="tambah-pengacara.php"
                       class="block px-4 py-2 rounded transition 
                       <?php echo ($current_page=='tambah-pengacara.php') ? 'bg-blue-200 font-semibold text-blue-800' : 'hover:bg-blue-100'; ?>">
                        Tambah Pengacara
                    </a>
                </li>
                <li>
                    <a href="admin-berita.php"
                       class="block px-4 py-2 rounded transition 
                       <?php echo ($current_page=='admin-berita.php') ? 'bg-blue-200 font-semibold text-blue-800' : 'hover:bg-blue-100'; ?>">
                        Panel Berita
                    </a>
                </li>
                <li>
                    <a href="admin-toko-hukum.php"
                       class="block px-4 py-2 rounded transition 
                       <?php echo ($current_page=='admin-toko-hukum.php') ? 'bg-blue-200 font-semibold text-blue-800' : 'hover:bg-blue-100'; ?>">
                        Panel Toko
                    </a>
                </li>
                <li>
                    <a href="panel-laporan.php"
                       class="block px-4 py-2 rounded transition 
                       <?php echo ($current_page=='panel-laporan.php') ? 'bg-blue-200 font-semibold text-blue-800' : 'hover:bg-blue-100'; ?>">
                        Panel Laporan
                    </a>
                </li>
            </ul>
        </nav>
        <div class="mt-auto space-y-2">
            <a href="../hukum.php" class="block bg-green-600 text-white text-center px-4 py-2 rounded hover:bg-green-700 transition">← Kembali</a>
            <a href="../logout.php" class="block bg-red-600 text-white text-center px-4 py-2 rounded hover:bg-red-700 transition">Logout</a>
        </div>
    </div>
</aside>
