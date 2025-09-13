<?php include 'includes/header.php'; ?>
<!-- Form Pencarian -->
<section class="bg-gradient-to-r from-blue-50 to-blue-100 py-10">
  <div class="max-w-3xl mx-auto px-4 text-center">
    <h3 class="text-3xl font-bold text-gray-800 mb-4">Cari Pengacara</h3>
    <p class="text-gray-600 mb-6">Temukan pengacara terbaik sesuai kebutuhan Anda</p>
    <form method="GET" action="pengacara.php" 
          class="flex flex-col md:flex-row items-center justify-center gap-3">
      <input type="text" name="q" placeholder="Masukkan nama atau spesialisasi"
             value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>"
             class="w-full md:w-2/3 px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
      <button type="submit" 
              class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold shadow hover:bg-blue-700 transition">
        Cari
      </button>
    </form>
  </div>
</section>

<!-- Hasil Pencarian -->
<section class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid md:grid-cols-3 gap-8" id="pengacaraList">
      <?php
      require 'db.php';
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
      <div class="relative">
        <!-- Tombol ? di pojok kiri atas -->
        <a href="background-pengacara.php?id=<?= $p['id'] ?>"
           class="absolute top-3 left-3 bg-blue-600 text-white w-7 h-7 flex items-center justify-center rounded-full text-sm font-bold hover:bg-blue-700 transition z-10">
          ?
        </a>

        <!-- Card utama bisa diklik -->
        <a href="background-pengacara.php?id=<?= $p['id'] ?>" 
           class="block bg-white p-6 rounded-2xl shadow-lg border border-gray-100 hover:border-blue-500 hover:shadow-xl hover:scale-105 transition transform duration-300 text-center">
          
        <img src="<?= htmlspecialchars($p['foto']) ?>"
     alt="<?= htmlspecialchars($p['nama']) ?>"
     class="w-28 h-28 mx-auto rounded-full mb-4 object-cover shadow-md border-2 border-blue-100">


          <h4 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($p['nama']) ?></h4>
          <p class="text-sm text-blue-600 font-medium mt-1">Spesialisasi: <?= htmlspecialchars($p['spesialis']) ?></p>
          <p class="text-sm text-gray-600 mt-2">
            <?php
              $desc  = trim($p['deskripsi'] ?? '');
              $words = preg_split('/\s+/', $desc, -1, PREG_SPLIT_NO_EMPTY);
              $short = count($words) > 10 ? implode(' ', array_slice($words, 0, 10)) . '...' : $desc;
              echo htmlspecialchars($short);
            ?>
          </p>
        </a>
      </div>
      <?php
        endwhile;
      else:
      ?>
      <div class="col-span-3 text-center text-gray-500 py-10">
        Tidak ditemukan pengacara yang cocok.
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
</body>
</html>
