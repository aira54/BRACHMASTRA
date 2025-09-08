<?php
require 'db.php'; // koneksi ke database

$success = false;
$errors = [];

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama    = trim($_POST['nama'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $telepon = trim($_POST['telepon'] ?? '');

    // Validasi sederhana
    if ($nama === '' || $email === '' || $telepon === '') {
        $errors[] = "Semua field wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    } else {
        // Simpan ke database pakai prepared statement
        $stmt = $conn->prepare("INSERT INTO registrasi_konsultasi (nama_lengkap, email, no_telepon) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $telepon);

        try {
            $success = $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) { // Duplicate entry
                $errors[] = "Email sudah terdaftar, silakan gunakan email lain.";
            } else {
                $errors[] = "Terjadi kesalahan: " . $e->getMessage();
            }
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<!-- Feedback -->
<?php if (!empty($errors)): ?>
<div class="max-w-4xl mx-auto mt-4 bg-red-100 text-red-700 p-4 rounded">
  <?php foreach ($errors as $err): ?>
    <p><?= htmlspecialchars($err) ?></p>
  <?php endforeach; ?>
</div>
<?php elseif ($success): ?>
<div class="max-w-4xl mx-auto mt-4 bg-green-100 text-green-700 p-4 rounded">
  Pendaftaran berhasil! Kami akan segera menghubungi Anda.
</div>
<?php endif; ?>


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
           class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
           Konsultasi Sekarang!!
        </a>
      </div>
    <?php endwhile; ?>
    <?php else: ?>
      <div class="col-span-3 text-center text-gray-500">
        Belum ada pengacara untuk konsultasi gratis.
      </div>
    <?php endif; ?>
    </div>
  </div>
</section>

</body>
</html>
