<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../db.php';

// Cek koneksi database
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Cek login admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Hapus klik_laporan
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $conn->query("DELETE FROM klik_laporan WHERE id = $id");
    header("Location: admin.php");
    exit;
}

// Hapus toko_laporan
if (isset($_GET['hapus_toko'])) {
    $id = (int) $_GET['hapus_toko'];
    $conn->query("DELETE FROM toko_laporan WHERE id = $id");
    header("Location: admin.php");
    exit;
}

// Ambil data klik_laporan
$resultKlik = $conn->query("SELECT * FROM klik_laporan ORDER BY id DESC");

// Ambil data toko_laporan
$resultToko = $conn->query("SELECT * FROM toko_laporan ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Laporan</title>
  <link rel="icon" type="image/x-icon" href="../asset/admin.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex min-h-screen text-gray-800">

  <!-- Sidebar -->
  <?php include 'includes/admin-header.php'; ?>

  <!-- Konten utama -->
  <main class="flex-1 ml-64 p-6 overflow-auto max-w-6xl mx-auto space-y-12">

    <!-- Laporan Klik Konsultasi -->
<div class="bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-4 text-blue-700">Laporan Klik Konsultasi</h2>
  <div class="mb-4">
    <a href="export_laporan.php" class="bg-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-700 transition">
      Export ke Excel
    </a>
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-full table-auto text-sm border border-gray-300">
      <thead class="bg-blue-100">
        <tr>
          <th class="px-3 py-2 border">ID</th>
          <th class="px-3 py-2 border">User</th>
          <th class="px-3 py-2 border">Jenis Konsultasi</th>
          <th class="px-3 py-2 border">Pengacara</th>
          <th class="px-3 py-2 border">Spesialis</th>
          <th class="px-3 py-2 border">Via</th>
          <th class="px-3 py-2 border">Metode Bayar</th> <!-- 🆕 -->
          <th class="px-3 py-2 border">Harga</th> <!-- 🆕 -->
          <th class="px-3 py-2 border">Pertanyaan</th>
          <th class="px-3 py-2 border">Waktu</th>
          <th class="px-3 py-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y">
        <?php if ($resultKlik->num_rows > 0): ?>
          <?php while ($row = $resultKlik->fetch_assoc()): ?>
            <tr class="hover:bg-gray-50">
              <td class="px-3 py-2 border"><?= $row['id'] ?></td>
              <td class="px-3 py-2 border"><?= htmlspecialchars($row['user_nama']) ?></td>
              <td class="px-3 py-2 border"><?= htmlspecialchars($row['jenis_konsultasi']) ?></td>
              <td class="px-3 py-2 border"><?= htmlspecialchars($row['pengacara_nama'] ?? '-') ?></td>
              <td class="px-3 py-2 border"><?= htmlspecialchars($row['pengacara_spesialis'] ?? '-') ?></td>
              <td class="px-3 py-2 border"><?= htmlspecialchars($row['klik_via']) ?></td>
              <td class="px-3 py-2 border"><?= htmlspecialchars($row['metode_bayar'] ?? '-') ?></td> <!-- 🆕 -->
              <td class="px-3 py-2 border">
                <?= isset($row['harga']) && $row['harga'] > 0 ? "Rp " . number_format($row['harga'],0,',','.') : '-' ?>
              </td> <!-- 🆕 -->
              <td class="px-3 py-2 border"><?= htmlspecialchars($row['pertanyaan']) ?></td>
              <td class="px-3 py-2 border"><?= $row['created_at'] ?? '-' ?></td>
              <td class="px-3 py-2 border space-x-2">
                <a href="panel-laporan.php?hapus=<?= $row['id'] ?>" 
                   onclick="return confirm('Yakin hapus data ini?')"
                   class="text-red-600 hover:underline">Hapus</a>
                <a href="pdf_konsultasi.php?id=<?= $row['id'] ?>" 
                   class="text-blue-600 hover:underline">PDF</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="11" class="text-center p-4 text-gray-500">Belum ada data</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>


    <!-- Laporan Toko Hukum -->
    <div class="bg-white p-6 rounded shadow">
      <h2 class="text-2xl font-bold mb-4 text-blue-700">Laporan Toko Hukum</h2>
      <div class="mb-4">
        <a href="export_toko.php" class="bg-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-700 transition">
          Export ke Excel
        </a>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-sm border border-gray-300">
          <thead class="bg-blue-100">
            <tr>
              <th class="px-3 py-2 border">ID</th>
              <th class="px-3 py-2 border">Nama</th>
              <th class="px-3 py-2 border">Email</th>
              <th class="px-3 py-2 border">Produk</th>
              <th class="px-3 py-2 border">Kategori</th>
              <th class="px-3 py-2 border">Harga</th>
              <th class="px-3 py-2 border">Via</th>
              <th class="px-3 py-2 border">Pertanyaan</th>
              <th class="px-3 py-2 border">Waktu</th>
              <th class="px-3 py-2 border">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            <?php if ($resultToko->num_rows > 0): ?>
              <?php while ($row = $resultToko->fetch_assoc()): ?>
                <tr class="hover:bg-gray-50">
                  <td class="px-3 py-2 border"><?= $row['id'] ?></td>
                  <td class="px-3 py-2 border"><?= htmlspecialchars($row['user_nama']) ?></td>
                  <td class="px-3 py-2 border"><?= htmlspecialchars($row['user_email']) ?></td>
                  <td class="px-3 py-2 border"><?= htmlspecialchars($row['produk_nama']) ?></td>
                  <td class="px-3 py-2 border"><?= htmlspecialchars($row['kategori']) ?></td>
                  <td class="px-3 py-2 border"><?= htmlspecialchars($row['harga']) ?></td>
                  <td class="px-3 py-2 border"><?= htmlspecialchars($row['klik_via']) ?></td>
                  <td class="px-3 py-2 border"><?= htmlspecialchars($row['pertanyaan']) ?></td>
                  <td class="px-3 py-2 border"><?= $row['created_at'] ?? '-' ?></td>
                  <td class="px-3 py-2 border space-x-2">
                    <a href="panel-laporan.php?hapus_toko=<?= $row['id'] ?>" 
                       onclick="return confirm('Yakin hapus data ini?')" 
                       class="text-red-600 hover:underline">Hapus</a>
                    <a href="pdf_toko.php?id=<?= $row['id'] ?>" 
                       class="text-blue-600 hover:underline">PDF</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="10" class="text-center p-4 text-gray-500">Belum ada data</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </main>
</body>
</html>
