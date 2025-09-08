<?php
include 'includes/header.php';
require 'db.php';

// Ambil ID pengacara
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM pengacara WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$pengacara = $result->fetch_assoc();
?>

<section class="py-12 bg-gray-100 min-h-screen">
  <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <?php if ($pengacara): ?>
      <!-- Header Hijau -->
      <div class="bg-green-600 px-6 py-4 flex items-center justify-between">
        <div>
          <h1 class="text-white text-2xl font-bold"><?= htmlspecialchars($pengacara['nama']) ?></h1>
          <p class="text-green-100"><?= htmlspecialchars($pengacara['spesialis']) ?></p>
        </div>
        <div class="flex space-x-3 text-white">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>

      <!-- Konten -->
      <div class="flex flex-col md:flex-row">
        <!-- Foto -->
        <div class="md:w-1/3 bg-gray-50 flex justify-center items-center p-6">
          <img src="<?= htmlspecialchars($pengacara['foto']) ?>" 
               alt="<?= htmlspecialchars($pengacara['nama']) ?>" 
               class="w-40 h-40 rounded-full object-cover border-4 border-green-500 shadow-md">
        </div>

        <!-- Detail -->
        <div class="md:w-2/3 p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-2">Hello & Welcome</h2>
          <h3 class="text-lg font-semibold text-green-600 mb-4">I’m <?= htmlspecialchars($pengacara['nama']) ?></h3>
          <p class="text-gray-600 mb-6"><?= nl2br(htmlspecialchars($pengacara['deskripsi'])) ?></p>

       <ul class="text-gray-700 space-y-2">
    <li><strong>Pendidikan:</strong> <?= $pengacara['pendidikan'] ? htmlspecialchars($pengacara['pendidikan']) : 'Tidak tersedia' ?></li>
  <li><strong>Email:</strong> <?= $pengacara['email'] ? htmlspecialchars($pengacara['email']) : 'Tidak tersedia' ?></li>
  <li><strong>Telepon:</strong> <?= $pengacara['telepon'] ? htmlspecialchars($pengacara['telepon']) : 'Tidak tersedia' ?></li>
  <li><strong>Tipe Konsultasi:</strong> <?= $pengacara['tipe_konsultasi'] ? htmlspecialchars($pengacara['tipe_konsultasi']) : 'Tidak tersedia' ?></li>
  
</ul>



          <div class="mt-6">
            <a href="pengacara.php" 
               class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Kembali</a>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="p-8 text-center text-gray-500">Data pengacara tidak ditemukan.</div>
    <?php endif; ?>
  </div>
</section>

</body>
</html>
