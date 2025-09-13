<?php
// Koneksi database
require 'db.php';

// Ambil nilai filter/pencarian
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$sub_kategori = isset($_GET['sub_kategori']) ? $_GET['sub_kategori'] : '';
$lokasi = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';

// Query dasar
$sql = "SELECT * FROM toko_hukum WHERE 1=1";

// Tambahkan filter kategori
if ($kategori !== '') {
    $kategori_safe = $conn->real_escape_string($kategori);
    $sql .= " AND kategori = '$kategori_safe'";
}

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
<?php include 'includes/header.php'; ?>
<body class="bg-gray-50">

<!-- Header -->
<div class="bg-white shadow p-4 flex justify-between items-center">
  <div class="flex items-center gap-4">
    <a href="hukum.php" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">
      ← Kembali
    </a>
    <h1 class="text-xl font-bold text-blue-800">Toko Hukum</h1>
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

      <!-- Kategori -->
      <div>
        <h3 class="font-semibold mb-2">Kategori</h3>
        <select name="kategori" class="border rounded px-3 py-2 w-full">
          <option value="">Semua</option>
          <option value="Pidana" <?= $kategori=="Pidana"?"selected":""; ?>>Pidana</option>
          <option value="Perdata" <?= $kategori=="Perdata"?"selected":""; ?>>Perdata</option>
          <option value="Keluarga" <?= $kategori=="Keluarga"?"selected":""; ?>>Keluarga</option>
          <option value="Bisnis" <?= $kategori=="Bisnis"?"selected":""; ?>>Bisnis</option>
        </select>
      </div>

      <!-- Sub Kategori -->
      <div>
        <h3 class="font-semibold mb-2">Sub Kategori</h3>
        <select name="sub_kategori" class="border rounded px-3 py-2 w-full">
          <option value="">Semua</option>
          <option value="Pidana Umum" <?= $sub_kategori=="Pidana Umum"?"selected":""; ?>>Pidana Umum</option>
          <option value="Korupsi" <?= $sub_kategori=="Korupsi"?"selected":""; ?>>Korupsi</option>
          <option value="Narkotika" <?= $sub_kategori=="Narkotika"?"selected":""; ?>>Narkotika</option>
          <option value="Pembunuhan" <?= $sub_kategori=="Pembunuhan"?"selected":""; ?>>Pembunuhan</option>
          <option value="Pencurian" <?= $sub_kategori=="Pencurian"?"selected":""; ?>>Pencurian</option>
        </select>
      </div>

      <!-- Lokasi -->
      <div>
        <h3 class="font-semibold mb-2">Lokasi</h3>
        <select name="lokasi" class="border rounded px-3 py-2 w-full">
          <option value="">Semua</option>
          <option value="Jakarta" <?= $lokasi=="Jakarta"?"selected":""; ?>>Jakarta</option>
          <option value="Bandung" <?= $lokasi=="Bandung"?"selected":""; ?>>Bandung</option>
          <option value="Surabaya" <?= $lokasi=="Surabaya"?"selected":""; ?>>Surabaya</option>
        </select>
      </div>

      <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded w-full">Terapkan</button>
    </form>
  </aside>

  <!-- Daftar Toko Hukum -->
  <main class="md:col-span-3 space-y-4">
    <h2 class="text-gray-600">Menampilkan 
      <span class="text-blue-700 font-bold">
        <?= $result->num_rows; ?>
      </span> Layanan Hukum
    </h2>

    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
      <div class="bg-white rounded shadow p-4 flex flex-col md:flex-row gap-4">
        <img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" 
             alt="<?= htmlspecialchars($row['nama_produk']); ?>" 
             class="w-full md:w-48 h-32 object-cover rounded">

        <div class="flex flex-col justify-between flex-1">
          <div>
            <span class="text-blue-700 font-bold uppercase text-sm">
              <?= htmlspecialchars($row['kategori']); ?> - <?= htmlspecialchars($row['sub_kategori']); ?> - <?= htmlspecialchars($row['lokasi']); ?>
            </span>
            <h3 class="font-bold text-lg"><?= htmlspecialchars($row['nama_produk']); ?></h3>
            <p class="text-gray-700">
              <?= substr(strip_tags($row['deskripsi']),0,120) ?>...
            </p>
          </div>
          <div class="flex justify-between items-center mt-2">
            <span class="text-blue-800 font-bold">
              Rp <?= number_format($row['harga'],0,',','.'); ?>
            </span>
            <a href="detail-toko.php?id=<?= $row['id']; ?>&from=umum ?>" 
               class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">
              Lihat Layanan
            </a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-gray-500">Tidak ada layanan ditemukan.</p>
    <?php endif; ?>
  </main>

</div>

</body>
</html>
