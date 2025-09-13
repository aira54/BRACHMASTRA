<?php
require 'db.php'; // koneksi ke database

$success = false;


?>
<?php include 'includes/header.php'; ?>


<!-- Daftar Pengacara Gratis -->
<section id="daftarPengacaraGratis" class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <h3 class="text-3xl font-bold text-center text-gray-800 mb-8">Pengacara Konsultasi Gratis</h3>
    <div class="grid md:grid-cols-3 gap-8">
    <?php
    $result = $conn->query("SELECT * FROM pengacara WHERE tipe_konsultasi = 'gratis'");
    if ($result && $result->num_rows > 0):
      while ($p = $result->fetch_assoc()):
    ?>
      <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 hover:border-blue-500 hover:shadow-xl hover:scale-105 transition transform duration-300 text-center">
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

        <a href="popup-konsultasi.php?id=<?= $p['id'] ?>&from=konsultasi" 
           class="mt-5 inline-block bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition text-sm font-semibold">
          Konsultasi Gratis
        </a>
      </div>
    <?php
      endwhile;
    else:
    ?>
      <div class="col-span-3 text-center text-gray-500 py-10">
        Belum ada pengacara untuk konsultasi gratis.
      </div>
    <?php endif; ?>
    </div>
  </div>
</section>

<!-- Daftar Pengacara Berbayar -->
<section id="daftarPengacaraBerbayar" class="py-12 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <h3 class="text-3xl font-bold text-center text-gray-800 mb-8">Pengacara Konsultasi Berbayar</h3>
    <div class="grid md:grid-cols-3 gap-8">
    <?php
    $result = $conn->query("SELECT * FROM pengacara WHERE tipe_konsultasi = 'berbayar'");
    if ($result && $result->num_rows > 0):
      while ($p = $result->fetch_assoc()):
    ?>
      <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 hover:border-yellow-400 hover:shadow-xl hover:scale-105 transition transform duration-300 text-center">
        <img src="<?= htmlspecialchars($p['foto']) ?>" 
             class="w-28 h-28 rounded-full mx-auto mb-4 object-cover shadow-md border-2 border-yellow-100" 
             alt="<?= htmlspecialchars($p['nama']) ?>">

        <h4 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($p['nama']) ?></h4>
        <p class="text-sm text-yellow-600 font-medium mt-1"><?= htmlspecialchars($p['spesialis']) ?></p>
        <p class="text-sm text-gray-600 mt-2">
          <?php
            $desc  = trim($p['deskripsi'] ?? '');
            $words = preg_split('/\s+/', $desc, -1, PREG_SPLIT_NO_EMPTY);
            $short = count($words) > 12 ? implode(' ', array_slice($words, 0, 12)) . '...' : $desc;
            echo htmlspecialchars($short);
          ?>
        </p>

        <a href="popup-konsultasi.php?id=<?= $p['id'] ?>&from=konsultasi" 
           class="mt-5 inline-block bg-yellow-500 text-white px-5 py-2 rounded-lg shadow hover:bg-yellow-600 transition text-sm font-semibold">
          Konsultasi Berbayar
        </a>
      </div>
    <?php
      endwhile;
    else:
    ?>
      <div class="col-span-3 text-center text-gray-500 py-10">
        Belum ada pengacara untuk konsultasi berbayar.
      </div>
    <?php endif; ?>
    </div>
  </div>
</section>

</body>
</html>
