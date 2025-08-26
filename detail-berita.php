<?php
$conn = new mysqli("localhost", "root", "", "brachmastra");


// Pastikan ada id
if (!isset($_GET['id'])) {
    die("ID berita tidak ditemukan.");
}

$id = (int) $_GET['id'];
$result = $conn->query("SELECT * FROM berita WHERE id = $id");

if ($result->num_rows === 0) {
    die("Berita tidak ditemukan.");
}

$berita = $result->fetch_assoc();

// Tentukan link kembali
$from = isset($_GET['from']) ? $_GET['from'] : $berita['kategori'];

switch ($from) {
    case 'pidana':
        $backLink = "jalurhukum/pidana/berita-pidana.php";
        break;
    case 'perdata':
        $backLink = "jalurhukum/perdata/berita-perdata.php";
        break;
    case 'keluarga':
        $backLink = "jalurhukum/keluarga/berita-keluarga.php";
        break;
    case 'bisnis':
        $backLink = "jalurhukum/bisnis/berita-bisnis.php";
        break;
    default:
        $backLink = "index.php"; // fallback kalau tidak ada
        break;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($berita['judul']); ?></title>
     <link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded mt-6">
        <?php if (!empty($berita['gambar'])): ?>
            <img src="uploads/<?php echo $berita['gambar']; ?>" 
                 alt="Gambar Berita" 
                 class="w-full h-64 object-cover rounded mb-4">
        <?php endif; ?>

        <h1 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($berita['judul']); ?></h1>
        <p class="text-sm text-gray-500 mb-4">
            Kategori: <?php echo ucfirst($berita['kategori']); ?> | <?php echo $berita['tanggal']; ?>
        </p>

        <div class="text-gray-800 leading-relaxed">
            <?php echo nl2br(htmlspecialchars($berita['isi'])); ?>
        </div>

        <div class="mt-6">
            <a href="<?php echo $backLink; ?>" class="text-blue-600 hover:underline">← Kembali ke Berita</a>
        </div>
    </div>

</body>
</html>
