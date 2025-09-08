<?php
require '../db.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = (int) $_GET['id'];

// Ambil data pengacara
$stmt = $conn->prepare("SELECT * FROM pengacara WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$pengacara = $result->fetch_assoc();

if (!$pengacara) {
    die("Data pengacara tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama       = $_POST['nama'];
    $spesialis  = $_POST['spesialis'];
    $email      = $_POST['email'];
    $telepon    = $_POST['telepon'];
    $tipe       = $_POST['tipe_konsultasi'];
    $deskripsi  = $_POST['deskripsi'];
    $pendidikan = $_POST['pendidikan'];
    $harga      = (int) $_POST['harga_konsultasi']; // ✅ ambil harga dari form

    // Default pakai foto lama
    $fotoPath = $pengacara['foto'];

    // Update foto jika ada upload baru
    if (!empty($_FILES['foto']['name'])) {
        $fotoName = time() . '_' . $_FILES['foto']['name'];
        $tmp      = $_FILES['foto']['tmp_name'];
        $folder   = '../uploads/' . $fotoName;
        $fotoPath = 'uploads/' . $fotoName;
        move_uploaded_file($tmp, $folder);
    }

    $update = $conn->prepare("UPDATE pengacara 
        SET nama=?, spesialis=?, email=?, telepon=?, tipe_konsultasi=?, deskripsi=?, pendidikan=?, harga_konsultasi=?, foto=? 
        WHERE id=?");
    $update->bind_param("ssssssssis", $nama, $spesialis, $email, $telepon, $tipe, $deskripsi, $pendidikan, $harga, $fotoPath, $id);
    $update->execute();

    header("Location: admin.php?update=success");
    exit;
}

?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
     <link rel="icon" type="image/x-icon" href="../asset/admin.png">

  <title>Edit Pengacara</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-blue-700">Edit Pengacara</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-4">
        <label class="block mb-1">Nama</label>
        <input name="nama" value="<?= htmlspecialchars($pengacara['nama']) ?>" required class="w-full border px-3 py-2 rounded">
      </div>
      <div class="mb-4">
        <label class="block mb-1">Spesialis</label>
        <input name="spesialis" value="<?= htmlspecialchars($pengacara['spesialis']) ?>" required class="w-full border px-3 py-2 rounded">
      </div>
      <div class="mb-4">
  <label class="block mb-1">Email</label>
  <input type="email" name="email" 
    value="<?= htmlspecialchars($pengacara['email'] ?? '') ?>" 
    class="w-full border px-3 py-2 rounded">
</div>

<div class="mb-4">
  <label class="block mb-1">Telepon</label>
  <input type="text" name="telepon" 
    value="<?= htmlspecialchars($pengacara['telepon'] ?? '') ?>" 
    class="w-full border px-3 py-2 rounded">
</div>
<div class="mb-4">
  <label class="block mb-1">Pendidikan</label>
  <input type="text" name="pendidikan" 
    value="<?= htmlspecialchars($pengacara['pendidikan'] ?? '') ?>" 
    class="w-full border px-3 py-2 rounded">
</div>


      <div class="mb-4">
        <label class="block mb-1">Tipe Konsultasi</label>
        <select name="tipe_konsultasi" class="w-full border px-3 py-2 rounded" required>
          <option value="gratis" <?= $pengacara['tipe_konsultasi'] === 'gratis' ? 'selected' : '' ?>>Gratis</option>
          <option value="berbayar" <?= $pengacara['tipe_konsultasi'] === 'berbayar' ? 'selected' : '' ?>>Berbayar</option>
        </select>
      </div>
      <div class="mb-4">
  <label class="block mb-1">Harga Konsultasi (Rp)</label>
  <input type="number" name="harga_konsultasi" min="0" 
    value="<?= htmlspecialchars($pengacara['harga_konsultasi']) ?>" 
    class="w-full border px-3 py-2 rounded">
</div>

      <div class="mb-4">
        <label class="block mb-1">Deskripsi</label>
        <textarea name="deskripsi" rows="4" required class="w-full border px-3 py-2 rounded"><?= htmlspecialchars($pengacara['deskripsi']) ?></textarea>
      </div>
      <div class="mb-4">
        <label class="block mb-1">Foto (jika ingin mengganti)</label>
        <input type="file" name="foto" accept="image/*" class="w-full border px-3 py-2 rounded bg-white">
      </div>
      <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
    </form>
  </div>
</body>
</html>
