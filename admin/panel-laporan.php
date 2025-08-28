<?php
session_start();
require '../db.php';

// Cek apakah login sebagai admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Hapus laporan
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $conn->query("DELETE FROM klik_laporan WHERE id = $id");
    header("Location: panel-laporan.php");
    exit;
}

// Ambil semua data laporan
$result = $conn->query("SELECT * FROM klik_laporan ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Laporan Klik Konsultasi</title>
  <link rel="icon" type="image/x-icon" href="../asset/admin.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  
<!-- Navbar -->
<nav class="bg-white shadow p-4 mb-6">
  <div class="max-w-6xl mx-auto flex justify-between items-center">
    <h1 class="text-lg font-bold text-blue-700">Admin Panel</h1>
    <div class="flex items-center space-x-3">
      <a href="tambah-pengacara.php" class="text-gray-700 hover:text-blue-600 text-sm">Tambah Pengacara</a>
      <a href="admin-berita.php" class="text-gray-700 hover:text-blue-600 text-sm">Panel Berita</a>
      <a href="admin-toko-hukum.php" class="text-gray-700 hover:text-blue-600 text-sm">Panel Toko</a>
      <a href="panel-laporan.php" class="text-blue-600 font-semibold text-sm">Panel Laporan</a>
      <a href="admin.php" class="bg-green-600 text-white text-xs px-3 py-1.5 rounded hover:bg-green-700 transition">← Kembali</a>
      <a href="../logout.php" class="bg-red-600 text-white text-xs px-3 py-1.5 rounded hover:bg-red-700 transition">Logout</a>
    </div>
  </div>
</nav>

<!-- Konten -->
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-6 text-blue-700">📊 Laporan Klik Konsultasi</h2>

  <div class="mb-4">
    <a href="export_laporan.php" 
       class="bg-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-700 transition">
       📥 Export ke Excel
    </a>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full table-auto text-sm">
      <thead class="bg-blue-100">
        <tr>
          <th class="px-4 py-2 text-left">ID</th>
          <th class="px-4 py-2 text-left">User</th>
          <th class="px-4 py-2 text-left">Jenis Konsultasi</th>
          <th class="px-4 py-2 text-left">Pengacara</th>
          <th class="px-4 py-2 text-left">Spesialis</th>
          <th class="px-4 py-2 text-left">Via</th>
          <th class="px-4 py-2 text-left">Pertanyaan</th>
          <th class="px-4 py-2 text-left">Waktu</th>
          <th class="px-4 py-2 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td class="px-4 py-2"><?= $row['id'] ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['user_nama']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['jenis_konsultasi']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['pengacara_nama'] ?? '-') ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['pengacara_spesialis'] ?? '-') ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['klik_via']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['pertanyaan']) ?></td>
            <td class="px-4 py-2"><?= $row['created_at'] ?? '-' ?></td>
            <td class="px-4 py-2">
              <a href="panel-laporan.php?hapus=<?= $row['id'] ?>" 
                 onclick="return confirm('Yakin ingin menghapus data ini?')" 
                 class="text-red-600 hover:underline">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="9" class="text-center p-4 text-gray-500">Belum ada data laporan</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
