<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "brachmastra");

// Ambil berita dengan kategori pidana
$query = "SELECT * FROM berita WHERE kategori = 'bisnis' ORDER BY tanggal DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../../asset/brachmastra.png">
    <title>Berita bisnis - BRACHMASTRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
</head>
<body class="bg-gray-100">

<!-- Loader -->
<div id="page-loader">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="scale-icon" fill="#2563eb">
        <path d="M32 2l8 16h-4v10h-8V18h-4l8-16zM14 30l6-12 6 12H14zm24 0l6-12 6 12H38zM8 32h12v2c0 5-4 9-9 9H9c-5 0-9-4-9-9v-2h8zm36 0h12v2c0 5-4 9-9 9h-1c-5 0-9-4-9-9v-2h8zm-12 4c4 0 7 3 7 7v19h-14V43c0-4 3-7 7-7z"/>
    </svg>
</div>

<!-- Konten -->
<nav class="bg-white shadow p-4">
  <div class="max-w-6xl mx-auto flex justify-between items-center">
    <a href="../../hukum.php" class="text-xl font-semibold text-blue-700">BRACHMASTRA</a>
    <div>
     <a href="bisnis.php" class="text-sm text-gray-700 hover:text-blue-600 font-medium px-4">Kembali</a>
    </div>
  </div>
</nav>

<section class="max-w-5xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-6">Berita bisnis Terbaru</h2>
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">
               <img src="<?php echo !empty($row['gambar']) ? '../../uploads/' . $row['gambar'] : '../uploads/default.jpg'; ?>" 
     alt="Gambar Berita" 
     class="w-full h-40 object-cover">

                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2"><?php echo $row['judul']; ?></h3>
                    <p class="text-sm text-gray-600 mb-3"><?php echo substr($row['isi'], 0, 80) . '...'; ?></p>
                                      <a href="../../detail-berita.php?id=<?php echo $row['id']; ?>&from=bisnis" class="text-blue-600">Baca Selengkapnya</a>

                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function (e) {
            const url = this.getAttribute("href");
            if (url && url !== "#" && !url.startsWith("javascript:")) {
                e.preventDefault();
                document.getElementById("page-loader").style.display = "flex";
                setTimeout(function () {
                    window.location.href = url;
                }, 500);
            }
        });
    });
});
</script>

</body>
</html>
