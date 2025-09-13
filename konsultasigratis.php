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
  <div class="max-w-7xl mx-auto px-6">
    <h3 class="text-3xl font-bold text-center text-gray-800 mb-10">
      Pengacara Tersedia untuk Konsultasi Gratis
    </h3>
    <div class="grid md:grid-cols-3 gap-8">
    <?php
    $result = $conn->query("SELECT * FROM pengacara WHERE tipe_konsultasi = 'gratis'");
    if ($result && $result->num_rows > 0):
      while ($p = $result->fetch_assoc()):
    ?>
      <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 hover:border-blue-500 hover:shadow-xl hover:scale-105 transition transform duration-300 text-center relative">
        <!-- Tombol ? -->
      
    

        <img src="<?= htmlspecialchars($p['foto']) ?>" 
             class="w-28 h-28 rounded-full mx-auto mb-4 object-cover shadow-md border-2 border-blue-100" 
             alt="<?= htmlspecialchars($p['nama']) ?>">

        <h4 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($p['nama']) ?></h4>
        <p class="text-sm text-blue-600 font-medium mt-1"><?= htmlspecialchars($p['spesialis']) ?></p>
        <p class="text-sm text-gray-600 mt-2">
          <?php
            $desc  = trim($p['deskripsi'] ?? '');
            $words = preg_split('/\s+/', $desc, -1, PREG_SPLIT_NO_EMPTY);
            $short = count($words) > 12 ? implode(' ', array_slice($words, 0, 12)) . '...' : $desc;
            echo htmlspecialchars($short);
          ?>
        </p>

        <!-- Tombol Aksi -->
        <a href="popup-konsultasi.php?id=<?= $p['id'] ?>&from=gratis" 
           class="mt-5 inline-block bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition text-sm font-semibold">
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
