<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
  <title>Pengacara</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
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
    <!-- Ikon Timbangan (SVG) -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="scale-icon" fill="#2563eb">
        <path d="M32 2l8 16h-4v10h-8V18h-4l8-16zM14 30l6-12 6 12H14zm24 0l6-12 6 12H38zM8 32h12v2c0 5-4 9-9 9H9c-5 0-9-4-9-9v-2h8zm36 0h12v2c0 5-4 9-9 9h-1c-5 0-9-4-9-9v-2h8zm-12 4c4 0 7 3 7 7v19h-14V43c0-4 3-7 7-7z"/>
    </svg>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function (e) {
            const url = this.getAttribute("href");

            // Pastikan bukan link kosong atau JS
            if (url && url !== "#" && !url.startsWith("javascript:")) {
                e.preventDefault(); // Hentikan pindah halaman sementara
                document.getElementById("page-loader").style.display = "flex";

                // Setelah 2 detik baru pindah halaman
                setTimeout(function () {
                    window.location.href = url;
                }, 500);
            }
        });
    });
});
</script>
<body class="bg-white text-gray-800">
  <!-- Navigasi -->
<nav class="bg-white shadow p-4">
  <div class="max-w-7xl mx-auto flex justify-between items-center">
    
    <!-- Kiri: Menu -->
    <div class="flex items-center space-x-8">
      <a href="hukum.php" class="text-lg font-bold text-blue-700">BRACHMASTRA</a>
      <a href="hukum.php" class="text-gray-700 hover:text-blue-600 text-sm">Beranda</a>
      <a href="pengacara.php" class="text-gray-700 hover:text-blue-600 text-sm">Pengacara</a>
      <a href="konsultasi.php" class="text-gray-700 hover:text-blue-600 text-sm">Konsultasi</a>
      <a href="tentang-kami.html" class="text-gray-700 hover:text-blue-600 text-sm">Tentang Kami</a>
    </div>

    <!-- Kanan: Tombol kembali -->
    <div>
      <a href="hukum.php" class="bg-red-600 text-white text-sm px-4 py-2 rounded hover:bg-red-700 transition">
        Kembali
      </a>
    </div>

  </div>
</nav>
  <!-- Form Pencarian -->
  <section class="bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 text-center">
      <h3 class="text-2xl font-semibold mb-4">Cari Pengacara</h3>
      <form method="GET" action="pengacara.php" class="flex flex-col md:flex-row items-center justify-center gap-4">
        <input type="text" name="q" placeholder="Masukkan nama atau spesialisasi" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" class="w-full md:w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
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
          <div class="bg-gray-50 p-6 rounded-lg shadow-md text-center border border-gray-200">
            <img src="<?= htmlspecialchars($p['foto']) ?>" alt="<?= htmlspecialchars($p['foto']) ?>" class="w-24 h-24 mx-auto rounded-full mb-4 object-cover">
            <h4 class="text-lg font-semibold text-blue-700"><?= htmlspecialchars($p['nama']) ?></h4>
            <p class="text-sm text-gray-600">Spesialisasi: <?= htmlspecialchars($p['spesialis']) ?></p>
            <p class="text-sm text-gray-600"><?= htmlspecialchars($p['deskripsi']) ?></p>
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
