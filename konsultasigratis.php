<?php
require 'db.php'; // koneksi ke database

$success = false;

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = trim($_POST['nama']);
  $email = trim($_POST['email']);
  $telepon = trim($_POST['telepon']);

  // Simpan ke database
  $stmt = $conn->prepare("INSERT INTO registrasi_konsultasi(nama_lengkap, email, no_telepon) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nama, $email, $telepon);
  $success = $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
  <title>Konsultasi - BRACHMASTRA</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">

<!-- Navigasi -->
<nav class="bg-white shadow p-4">
  <div class="max-w-6xl mx-auto flex justify-between items-center">
    <a href="hukum.php" class="text-xl font-semibold text-blue-700">BRACHMASTRA</a>
    <div>
      <a href="hukum.php" class="text-sm text-gray-700 hover:text-blue-600 font-medium px-4">Beranda</a>
      <a href="pengacara.php" class="text-sm text-blue-600 font-semibold px-4">Cari Pengacara</a>
    </div>
  </div>
</nav>

<?php if (!$success && (!isset($_GET['show']) || $_GET['show'] !== 'list')): ?>

<!-- Form Registrasi -->
<section class="min-h-screen flex items-center justify-center" id="formSection">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-700">Registrasi untuk Konsultasi Gratis</h2>
    <form method="POST" action="">
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium">Nama Lengkap</label>
        <input type="text" name="nama" class="w-full border border-gray-300 rounded px-3 py-2" required>
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium">Email</label>
        <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2" required>
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium">No. Telepon</label>
        <input type="tel" name="telepon" class="w-full border border-gray-300 rounded px-3 py-2" required>
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Lanjut ke Konsultasi</button>
    </form>
  </div>
</section>
<?php else: ?>
<!-- Daftar Pengacara -->
<section id="daftarPengacara" class="py-16 bg-white">
  <div class="max-w-6xl mx-auto px-4">
    <h3 class="text-2xl font-semibold text-center mb-10">Pengacara Tersedia untuk Konsultasi Gratis</h3>
    <div class="grid md:grid-cols-3 gap-6">
    <?php
    $result = $conn->query("SELECT * FROM pengacara WHERE tipe_konsultasi = 'gratis'");
    if ($result && $result->num_rows > 0):
      while ($p = $result->fetch_assoc()):
    ?>
      <div class="bg-gray-100 p-6 rounded-lg shadow text-center">
        <img src="<?= htmlspecialchars($p['foto']) ?>" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover" alt="<?= htmlspecialchars($p['nama']) ?>">
        <h4 class="text-lg font-bold text-blue-700"><?= htmlspecialchars($p['nama']) ?></h4>
        <p class="text-sm text-gray-600"><?= htmlspecialchars($p['spesialis']) ?></p>
        <p class="text-sm text-gray-600"><?= htmlspecialchars($p['deskripsi']) ?></p>
        <!-- arahkan dengan id pengacara -->
       <a href="popup-konsultasi.php?id=<?= $p['id'] ?>&from=gratis" 
   class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Konsultasi Sekarang!!</a>

      </div>
    <?php
      endwhile;
    else:
    ?>
      <div class="col-span-3 text-center text-gray-500">Belum ada pengacara untuk konsultasi gratis.</div>
    <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

</body>
</html>
