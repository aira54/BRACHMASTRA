<?php
// Koneksi database
require '../../db.php';

// Ambil nilai filter/pencarian
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$sub_kategori = isset($_GET['sub_kategori']) ? $_GET['sub_kategori'] : '';
$lokasi = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';

// Query dasar
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
  <title>Toko Hukum bisnis</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
<body class="bg-gray-50">

<!-- Header -->
<div class="bg-white shadow p-4 flex justify-between items-center">
  <div class="flex items-center gap-4">
    <a href="bisnis.php" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">
      ← Kembali
    </a>
    <h1 class="text-xl font-bold text-blue-800">Toko Hukum - bisnis</h1>
  </div>
  
  <form method="GET" class="flex">
    <input type="text" name="cari" value="<?php echo htmlspecialchars($cari); ?>" placeholder="Cari Layanan..." class="border rounded-l px-3 py-2 w-64 focus:outline-none">
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
          <option value="bisnis Umum" <?php if($sub_kategori=="bisnis Umum") echo "selected"; ?>>bisnis Umum</option>
          <option value="Korupsi" <?php if($sub_kategori=="Korupsi") echo "selected"; ?>>Korupsi</option>
          <option value="Narkotika" <?php if($sub_kategori=="Narkotika") echo "selected"; ?>>Narkotika</option>
          <option value="Pembunuhan" <?php if($sub_kategori=="Pembunuhan") echo "selected"; ?>>Pembunuhan</option>
          <option value="Pencurian" <?php if($sub_kategori=="Pencurian") echo "selected"; ?>>Pencurian</option>
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

  <!-- Daftar Toko Hukum -->
  <main class="md:col-span-3 space-y-4">
    <h2 class="text-gray-600">Menampilkan <span class="text-blue-700 font-bold">
      <?php echo $result->num_rows; ?>
    </span> Layanan Hukum Pidana</h2>

    <?php while($row = $result->fetch_assoc()): ?>
    <div class="bg-white rounded shadow p-4 flex flex-col md:flex-row gap-4">
     <img src="../../uploads/<?php echo $row['gambar']; ?>" 
     alt="<?php echo $row['nama_produk']; ?>" 
     class="w-full md:w-48 h-32 object-cover rounded">

      <div class="flex flex-col justify-between flex-1">
        <div>
          <span class="text-blue-700 font-bold uppercase text-sm"><?php echo $row['sub_kategori']; ?> - <?php echo $row['lokasi']; ?></span>
          <h3 class="font-bold text-lg"><?php echo $row['nama_produk']; ?></h3>
          <p class="text-gray-700"><?php echo $row['deskripsi']; ?></p>
        </div>
        <div class="flex justify-between items-center mt-2">
          <span class="text-blue-800 font-bold">Rp <?php echo number_format($row['harga'],0,',','.'); ?></span>
          <a href="#" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">Lihat Layanan</a>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </main>

</div>

</body>
</html>
