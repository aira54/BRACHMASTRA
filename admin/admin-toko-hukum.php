<?php
require '../db.php';

// Hapus produk
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $conn->query("DELETE FROM toko_hukum WHERE id = $id");
    header("Location: admin-toko-hukum.php");
    exit;
}

// Tambah produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $sub_kategori = $_POST['sub_kategori'];
    $lokasi = $_POST['lokasi'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $target = "../uploads/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

    $stmt = $conn->prepare("INSERT INTO toko_hukum (nama_produk, deskripsi, harga, kategori, sub_kategori, lokasi, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdssss", $nama_produk, $deskripsi, $harga, $kategori, $sub_kategori, $lokasi, $gambar);
    $stmt->execute();
    $stmt->close();

    header("Location: admin-toko-hukum.php");
    exit;
}

// Ambil data produk
$result = $conn->query("SELECT * FROM toko_hukum ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
       <link rel="icon" type="image/x-icon" href="../asset/admin.png">

    <title>Admin - Toko Hukum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-6xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Manajemen Toko Hukum</h1>
    
    <a href="admin.php" class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mb-4">
        ← Kembali ke Admin
    </a>


    <!-- Form Tambah Produk -->
    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-lg font-semibold mb-3">Tambah Produk</h2>
        <form method="POST" enctype="multipart/form-data" class="space-y-3">
            <input type="text" name="nama_produk" placeholder="Nama Produk" required class="w-full p-2 border rounded">
            <textarea name="deskripsi" placeholder="Deskripsi" required class="w-full p-2 border rounded"></textarea>
            <input type="number" name="harga" placeholder="Harga" step="0.01" required class="w-full p-2 border rounded">

            <select name="kategori" class="w-full p-2 border rounded" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="pidana">Pidana</option>
                <option value="perdata">Perdata</option>
                <option value="bisnis">Bisnis</option>
                <option value="keluarga">Keluarga</option>
            </select>

            <input type="text" name="sub_kategori" placeholder="Sub Kategori (contoh: Pencurian, Penipuan)" required class="w-full p-2 border rounded">
            <input type="text" name="lokasi" placeholder="Lokasi (contoh: Jakarta, Bandung)" required class="w-full p-2 border rounded">

            <input type="file" name="gambar" required class="w-full p-2 border rounded">
            <button type="submit" name="tambah" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Produk</button>
        </form>
    </div>

    <!-- Tabel Produk -->
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-3">Daftar Produk</h2>
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Nama Produk</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Sub Kategori</th>
                    <th class="border p-2">Lokasi</th>
                    <th class="border p-2">Harga</th>
                    <th class="border p-2">Gambar</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="border p-2"><?= $row['id'] ?></td>
                        <td class="border p-2"><?= htmlspecialchars($row['nama_produk']) ?></td>
                        <td class="border p-2"><?= $row['kategori'] ?></td>
                        <td class="border p-2"><?= $row['sub_kategori'] ?></td>
                        <td class="border p-2"><?= $row['lokasi'] ?></td>
                        <td class="border p-2">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td class="border p-2">
                            <img src="../uploads/<?= $row['gambar'] ?>" alt="Gambar" class="h-16">
                        </td>
                       <td class="border p-2 text-center space-x-1">
    <a href="?hapus=<?= $row['id'] ?>" 
       onclick="return confirm('Hapus produk ini?')" 
       class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
       Hapus
    </a>
    <a href="update-toko-hukum.php?id=<?= $row['id'] ?>" 
       class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
       Update
    </a>
</td>

                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
