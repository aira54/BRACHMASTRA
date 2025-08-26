<?php
include __DIR__ . '/../../db.php';

// Ambil pengacara gratis & berbayar khusus hukum pidana
$queryGratis = "SELECT * FROM pengacara WHERE spesialis = 'Hukum keluarga' AND tipe_konsultasi = 'gratis'";
$queryBerbayar = "SELECT * FROM pengacara WHERE spesialis = 'Hukum keluarga' AND tipe_konsultasi = 'berbayar'";

$resultGratis = $conn->query($queryGratis);
$resultBerbayar = $conn->query($queryBerbayar);
?>
<script src="https://cdn.tailwindcss.com"></script>
<nav class="bg-white shadow p-4">
  <div class="max-w-6xl mx-auto flex justify-between items-center">
    <a href="../../hukum.php" class="text-xl font-semibold text-blue-700">BRACHMASTRA</a>
    <div>
      <a href="keluarga.php" class="text-sm text-gray-700 hover:text-blue-600 font-medium px-4">Kembali</a>
    </div>
  </div>
</nav>

<div class="mt-12 px-4 max-w-6xl mx-auto">
  <h2 class="text-2xl font-bold mb-6 text-center">Konsultasi Hukum keluarga</h2>

  <!-- Pengacara Gratis -->
  <h3 class="text-xl font-bold text-blue-600 mb-4">Konsultasi Gratis</h3>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
    <?php if ($resultGratis && $resultGratis->num_rows > 0): ?>
      <?php while ($row = $resultGratis->fetch_assoc()): ?>
        <?php
        $fotoPath = $row['foto'];
        if (!str_starts_with($fotoPath, 'uploads/') && !str_starts_with($fotoPath, '../uploads/')) {
            $fotoPath = '../../uploads/' . $fotoPath; 
        } elseif (str_starts_with($fotoPath, 'uploads/')) {
            $fotoPath = '../../' . $fotoPath;
        }
        ?>
        <div class="bg-gray-50 rounded-lg shadow p-6 flex flex-col items-center">
          <img src="<?= htmlspecialchars($fotoPath) ?>" 
               alt="<?= htmlspecialchars($row['nama']) ?>" 
               class="w-24 h-24 object-cover rounded-full mb-4">
          <h3 class="text-lg font-bold text-blue-600"><?= htmlspecialchars($row['nama']) ?></h3>
          <p class="text-sm text-gray-700"><?= htmlspecialchars($row['spesialis']) ?></p>
          <p class="text-sm text-gray-600"><?= htmlspecialchars($row['email'] ?? '-') ?></p>
          <p class="text-sm text-gray-600"><?= htmlspecialchars($row['telepon'] ?? '-') ?></p>
          <p class="text-center text-gray-600 text-sm mt-2 mb-4">
            <?= htmlspecialchars($row['deskripsi']) ?>
          </p>
         <a href="../../popup-konsultasi.php?id=<?= $row['id'] ?>&from=keluarga" 
   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
   Konsultasi
</a>


        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="col-span-full text-gray-500 text-center">Belum ada pengacara gratis.</p>
    <?php endif; ?>
  </div>

  <!-- Pengacara Berbayar -->
  <h3 class="text-xl font-bold text-yellow-600 mb-4">Konsultasi Berbayar</h3>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if ($resultBerbayar && $resultBerbayar->num_rows > 0): ?>
      <?php while ($row = $resultBerbayar->fetch_assoc()): ?>
        <?php
        $fotoPath = $row['foto'];
        if (!str_starts_with($fotoPath, 'uploads/') && !str_starts_with($fotoPath, '../uploads/')) {
            $fotoPath = '../../uploads/' . $fotoPath; 
        } elseif (str_starts_with($fotoPath, 'uploads/')) {
            $fotoPath = '../../' . $fotoPath;
        }
        ?>
        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
          <img src="<?= htmlspecialchars($fotoPath) ?>" 
               alt="<?= htmlspecialchars($row['nama']) ?>" 
               class="w-24 h-24 object-cover rounded-full mb-4">
          <h3 class="text-lg font-bold text-blue-600"><?= htmlspecialchars($row['nama']) ?></h3>
          <p class="text-sm text-gray-700"><?= htmlspecialchars($row['spesialis']) ?></p>
          <p class="text-sm text-gray-600"><?= htmlspecialchars($row['email'] ?? '-') ?></p>
          <p class="text-sm text-gray-600"><?= htmlspecialchars($row['telepon'] ?? '-') ?></p>
          <p class="text-center text-gray-600 text-sm mt-2 mb-4">
            <?= htmlspecialchars($row['deskripsi']) ?>
          </p>
        <a href="../../popup-konsultasi.php?id=<?= $row['id'] ?>&from=keluarga" 
   class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 text-sm">
   Konsultasi
</a>


          </button>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="col-span-full text-gray-500 text-center">Belum ada pengacara berbayar.</p>
    <?php endif; ?>
  </div>
</div>

<!-- POPUP Form -->
<div id="popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
  <div class="bg-white rounded-lg p-6 w-96 relative">
    <button onclick="closePopup()" class="absolute top-2 right-2 text-gray-500">&times;</button>
    <h3 class="text-lg font-bold mb-4 text-blue-700">Form Konsultasi</h3>
    <form method="POST" action="registrasi.php">
      <input type="hidden" name="pengacara_id" id="pengacara_id">
      <input type="hidden" name="tipe" id="tipe">
      <div class="mb-3">
        <label class="block text-sm">Nama Anda</label>
        <input type="text" name="nama" required class="w-full border px-3 py-2 rounded">
      </div>
      <div class="mb-3">
        <label class="block text-sm">Email</label>
        <input type="email" name="email" required class="w-full border px-3 py-2 rounded">
      </div>
      <div class="mb-3">
        <label class="block text-sm">Telepon</label>
        <input type="text" name="telepon" required class="w-full border px-3 py-2 rounded">
      </div>
      <div class="mb-3">
        <label class="block text-sm">Pertanyaan</label>
        <textarea name="pertanyaan" rows="3" required class="w-full border px-3 py-2 rounded"></textarea>
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Kirim</button>
    </form>
  </div>
</div>

<script>
function openPopup(id, tipe) {
  document.getElementById('popup').classList.remove('hidden');
  document.getElementById('pengacara_id').value = id;
  document.getElementById('tipe').value = tipe;
}
function closePopup() {
  document.getElementById('popup').classList.add('hidden');
}
</script>
