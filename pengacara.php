<?php include 'includes/header.php'; ?>
  <!-- Form Pencarian -->
  <section class="bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 text-center">
      <h3 class="text-2xl font-semibold mb-4">Cari Pengacara</h3>
      <form method="GET" action="pengacara.php" class="flex flex-col md:flex-row items-center justify-center gap-4">
        <input type="text" name="q" placeholder="Masukkan nama atau spesialisasi" 
               value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" 
               class="w-full md:w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Cari</button>
      </form>
    </div>
  </section>

  <!-- Hasil Pencarian -->
  <section class="py-12 bg-white">
    <div class="max-w-6xl mx-auto px-4">
      <div class="grid md:grid-cols-3 gap-6" id="pengacaraList">
        <?php
        require 'db.php'; // koneksi ke database

        // Tangani pencarian
        $search = isset($_GET['q']) ? trim($_GET['q']) : '';
        if ($search !== '') {
          $stmt = $conn->prepare("SELECT * FROM pengacara WHERE nama LIKE ? OR spesialis LIKE ?");
          $like = "%$search%";
          $stmt->bind_param("ss", $like, $like);
          $stmt->execute();
          $result = $stmt->get_result();
        } else {
          $result = $conn->query("SELECT * FROM pengacara");
        }

        if ($result && $result->num_rows > 0):
          while ($p = $result->fetch_assoc()):
        ?>
          <div class="relative bg-gray-50 p-6 rounded-lg shadow-md text-center border border-gray-200">
            <!-- Tombol ? di pojok kiri atas -->
            <a href="background-pengacara.php?id=<?= $p['id'] ?>" 
               class="absolute top-2 left-2 bg-blue-600 text-white w-6 h-6 flex items-center justify-center rounded-full text-sm font-bold hover:bg-blue-700">
              ?
            </a>

            <img src="<?= htmlspecialchars($p['foto']) ?>" 
                 alt="<?= htmlspecialchars($p['nama']) ?>" 
                 class="w-24 h-24 mx-auto rounded-full mb-4 object-cover">

            <h4 class="text-lg font-semibold text-blue-700"><?= htmlspecialchars($p['nama']) ?></h4>
            <p class="text-sm text-gray-600">Spesialisasi: <?= htmlspecialchars($p['spesialis']) ?></p>
            <p class="text-sm text-gray-600">
  <?php
    $desc  = trim($p['deskripsi'] ?? '');
    $words = preg_split('/\s+/', $desc, -1, PREG_SPLIT_NO_EMPTY);
    $short = count($words) > 7 ? implode(' ', array_slice($words, 0, 7)) . '...' : $desc;
    echo htmlspecialchars($short);
  ?>
</p>

          </div>
        <?php
          endwhile;
        else:
        ?>
          <div class="col-span-3 text-center text-gray-500">Tidak ditemukan pengacara yang cocok.</div>
        <?php endif; ?>
      </div>
    </div>
  </section>
</body>
</html>
