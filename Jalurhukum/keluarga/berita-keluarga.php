<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "brachmastra");

// Ambil berita dengan kategori keluarga
$query = "SELECT * FROM berita WHERE kategori = 'keluarga' ORDER BY tanggal DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php include '../../includes/header.php'; ?>
</head>
<body class="bg-gray-50">

<section class="max-w-5xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-6">Berita Keluarga Terbaru</h2>
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="<?php echo !empty($row['gambar']) ? '../../uploads/' . $row['gambar'] : '../../uploads/default.jpg'; ?>" 
                     alt="Gambar Berita" 
                     class="w-full h-40 object-cover">

                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2">
                        <?= htmlspecialchars($row['judul']); ?>
                    </h3>
                    <p class="text-sm text-gray-600 mb-3">
                        <?= htmlspecialchars(substr($row['isi'], 0, 80)) . '...'; ?>
                    </p>
                    <a href="../../detail-berita.php?id=<?= $row['id']; ?>&from=keluarga" 
                       class="text-blue-600 hover:underline">
                       Baca Selengkapnya
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

</body>
</html>
