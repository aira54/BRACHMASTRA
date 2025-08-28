<?php
// Koneksi database
require '../../db.php';

// Ambil nilai filter/pencarian
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$sub_kategori = isset($_GET['sub_kategori']) ? $_GET['sub_kategori'] : '';
$lokasi = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';

// Query dasar khusus kategori bisnis
$sql = "SELECT * FROM toko_hukum WHERE kategori = 'bisnis'";

// Tambahkan pencarian
if ($cari !== '') {
    $cari_safe = $conn->real_escape_string($cari);
    $sql .= " AND (nama_produk LIKE '%$cari_safe%' OR deskripsi LIKE '%$cari_safe%')";
}

// Tambahkan filter sub kategori
if ($sub_kategori !== '') {
    $sub_safe = $conn->real_escape_string($sub_kategori);
    $sql .= " AND sub_kategori = '$sub_safe'";
}

// Tambahkan filter lokasi
if ($lokasi !== '') {
    $lokasi_safe = $conn->real_escape_string($lokasi);
    $sql .= " AND lokasi = '$lokasi_safe'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../../asset/brachmastra.png">
  <title>Toko Hukum Bisnis</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

<!-- Header -->
<div class="bg-white shadow p-4 flex justify-between items-center">
  <div class="flex items-center gap-4">
    <a href="bisnis.php" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">
      ← Kembali
    </a>
    <h1 class="text-xl font-bold text-blue-800">Toko Hukum - Bisnis</h1>
  </div>
  
  <form method="GET" class="flex">
    <input type="text" name="cari" value="<?= htmlspecialchars($cari); ?>" placeholder="Cari Layanan..." class="border rounded-l px-3 py-2 w-64 focus:outline-none">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 rounded-r">Cari</button>
  </form>
</div>

<!-- Konten -->
<div class="max-w-7xl mx-auto mt-6 grid grid-cols-1 md:grid-cols-4 gap-6">

  <!-- Filter -->
  <aside class="bg-white p-4 rounded shadow md:col-span-1">
    <h2 class="font-bold text-lg text-blue-800 mb-4">Filter</h2>
    <form method="GET" class="space-y-4">

      <div>
        <h3 class="font-semibold mb-2">Sub Kategori</h3>
        <select name="sub_kategori" class="border rounded px-3 py-2 w-full">
          <option value="">Semua</option>
          <option value="Bisnis Umum" <?php if($sub_kategori=="Bisnis Umum") echo "selected"; ?>>Bisnis Umum</option>
          <option value="Kontrak Dagang" <?php if($sub_kategori=="Kontrak Dagang") echo "selected"; ?>>Kontrak Dagang</option>
          <option value="Perusahaan" <?php if($sub_kategori=="Perusahaan") echo "selected"; ?>>Perusahaan</option>
          <option value="Sengketa Bisnis" <?php if($sub_kategori=="Sengketa Bisnis") echo "selected"; ?>>Sengketa Bisnis</option>
          <option value="Investasi" <?php if($sub_kategori=="Investasi") echo "selected"; ?>>Investasi</option>
        </select>
      </div>

      <div>
        <h3 class="font-semibold mb-2">Lokasi</h3>
        <select name="lokasi" class="border rounded px-3 py-2 w-full">
          <option value="">Semua</option>
          <option value="Jakarta" <?php if($lokasi=="Jakarta") echo "selected"; ?>>Jakarta</option>
          <option value="Bandung" <?php if($lokasi=="Bandung") echo "selected"; ?>>Bandung</option>
          <option value="Surabaya" <?php if($lokasi=="Surabaya") echo "selected"; ?>>Surabaya</option>
        </select>
      </div>

      <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded w-full">Terapkan</button>
    </form>
  </aside>

  <!-- Daftar Produk -->
  <main class="md:col-span-3 space-y-4">
    <h2 class="text-gray-600">Menampilkan <span class="text-blue-700 font-bold">
      <?= $result->num_rows; ?>
    </span> Layanan Hukum Bisnis</h2>

    <?php while($row = $result->fetch_assoc()): ?>
    <div class="bg-white rounded shadow p-4 flex flex-col md:flex-row gap-4">
     <img src="../../uploads/<?= $row['gambar']; ?>" 
     alt="<?= $row['nama_produk']; ?>" 
     class="w-full md:w-48 h-32 object-cover rounded">

      <div class="flex flex-col justify-between flex-1">
        <div>
          <span class="text-blue-700 font-bold uppercase text-sm"><?= $row['sub_kategori']; ?> - <?= $row['lokasi']; ?></span>
          <h3 class="font-bold text-lg"><?= $row['nama_produk']; ?></h3>
          <p class="text-gray-700"><?= $row['deskripsi']; ?></p>
        </div>
        <div class="flex justify-between items-center mt-2">
          <span class="text-blue-800 font-bold">Rp <?= number_format($row['harga'],0,',','.'); ?></span>
          <a href="../../detail-toko.php?id=<?= $row['id']; ?>&from=bisnis" 
             class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">Lihat Layanan</a>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </main>

</div>

</body>
</html>
