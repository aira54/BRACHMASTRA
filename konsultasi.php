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
<?php include 'includes/header.php'; ?>


<!-- Daftar Pengacara Gratis -->
<section id="daftarPengacaraGratis" class="py-10 bg-white">
  <div class="max-w-6xl mx-auto px-4">
    <h3 class="text-2xl font-semibold text-center mb-6">Pengacara Konsultasi Gratis</h3>
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
        <a href="popup-konsultasi.php?id=<?= $p['id'] ?>&from=konsultasi" 
   class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Konsultasi Gratis</a>

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

<!-- Daftar Pengacara Berbayar -->
<section id="daftarPengacaraBerbayar" class="py-10 bg-gray-50">
  <div class="max-w-6xl mx-auto px-4">
    <h3 class="text-2xl font-semibold text-center mb-6">Pengacara Konsultasi Berbayar</h3>
    <div class="grid md:grid-cols-3 gap-6">
    <?php
    $result = $conn->query("SELECT * FROM pengacara WHERE tipe_konsultasi = 'berbayar'");
    if ($result && $result->num_rows > 0):
      while ($p = $result->fetch_assoc()):
    ?>
      <div class="bg-white p-6 rounded-lg shadow text-center">
        <img src="<?= htmlspecialchars($p['foto']) ?>" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover" alt="<?= htmlspecialchars($p['nama']) ?>">
        <h4 class="text-lg font-bold text-blue-700"><?= htmlspecialchars($p['nama']) ?></h4>
        <p class="text-sm text-gray-600"><?= htmlspecialchars($p['spesialis']) ?></p>
        <p class="text-sm text-gray-600"><?= htmlspecialchars($p['deskripsi']) ?></p>
        <a href="popup-konsultasi.php?id=<?= $p['id'] ?>&from=konsultasi" 
   class="mt-4 inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Konsultasi Berbayar</a>

      </div>
    <?php
      endwhile;
    else:
    ?>
      <div class="col-span-3 text-center text-gray-500">Belum ada pengacara untuk konsultasi berbayar.</div>
       <?php endif; ?>
    </div>
  </div>
</section>

</body>
</html>
