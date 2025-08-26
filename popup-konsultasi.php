<?php
require 'db.php';

if (!isset($_GET['id'])) {
    die("ID pengacara tidak ditemukan.");
}

$id = (int) $_GET['id'];
$from = isset($_GET['from']) ? $_GET['from'] : 'konsultasi';

// ambil data pengacara
$result = $conn->query("SELECT * FROM pengacara WHERE id = $id");
if ($result->num_rows === 0) {
    die("Pengacara tidak ditemukan.");
}
$p = $result->fetch_assoc();

// tentukan link kembali sesuai asal
switch ($from) {
    case 'gratis':
        $backLink = "konsultasigratis.php?show=list";
        break;
    case 'pidana':
        $backLink = "jalurhukum/pidana/konsultasi-pidana.php?show=list";
        break;
    case 'perdata':
        $backLink = "jalurhukum/perdata/konsultasi-perdata.php?show=list";
        break;
    case 'keluarga':
        $backLink = "jalurhukum/keluarga/konsultasi-keluarga.php?show=list";
        break;
    case 'bisnis':
        $backLink = "jalurhukum/bisnis/konsultasi-bisnis.php?show=list";
        break;
    default:
        $backLink = "konsultasi.php?show=list";
        break;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($p['nama']) ?> - Konsultasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
  <img src="<?= htmlspecialchars($p['foto']) ?>" class="w-28 h-28 rounded-full mx-auto mb-4 object-cover" alt="<?= htmlspecialchars($p['nama']) ?>">
  <h2 class="text-2xl font-bold text-center text-blue-700 mb-2"><?= htmlspecialchars($p['nama']) ?></h2>
  <p class="text-center text-gray-600 mb-4"><?= htmlspecialchars($p['spesialis']) ?></p>
  <p class="text-gray-700 mb-6 text-center"><?= htmlspecialchars($p['deskripsi']) ?></p>

  <div class="flex justify-center space-x-4">
    <?php if (!empty($p['telepon'])): ?>
      <a href="https://wa.me/<?= htmlspecialchars($p['telepon']) ?>" target="_blank" 
         class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">WhatsApp</a>
    <?php endif; ?>

    <?php if (!empty($p['email'])): ?>
      <a href="mailto:<?= htmlspecialchars($p['email']) ?>" 
         class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Email</a>
    <?php endif; ?>
  </div>

  <div class="mt-6 text-center">
    <a href="<?= $backLink ?>" class="text-blue-600 hover:underline">← Kembali ke Daftar Pengacara</a>
  </div>
</div>

</body>
</html>
