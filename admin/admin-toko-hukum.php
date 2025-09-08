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
    $gambar = time() . '_' . $_FILES['gambar']['name'];
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
    <title>Admin - Toko Hukum</title>
    <link rel="icon" type="image/x-icon" href="../asset/admin.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen text-gray-800">

    <!-- Sidebar -->
    <?php include 'includes/admin-header.php'; ?>

    <!-- Konten utama -->
    <main class="flex-1 ml-64 p-6 overflow-auto">

        <h1 class="text-2xl font-bold mb-6 text-blue-700">Manajemen Toko Hukum</h1>

        <!-- Form Tambah Produk -->
        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="text-lg font-semibold mb-4 text-blue-600">Tambah Produk</h2>
            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <div class="grid md:grid-cols-2 gap-4">
                    <input type="text" name="nama_produk" placeholder="Nama Produk" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <input type="number" name="harga" placeholder="Harga" step="0.01" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <textarea name="deskripsi" placeholder="Deskripsi" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                <div class="grid md:grid-cols-3 gap-4">
                    <select name="kategori" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="pidana">Pidana</option>
                        <option value="perdata">Perdata</option>
                        <option value="bisnis">Bisnis</option>
                        <option value="keluarga">Keluarga</option>
                    </select>
                    <input type="text" name="sub_kategori" placeholder="Sub Kategori" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <input type="text" name="lokasi" placeholder="Lokasi" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <input type="file" name="gambar" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                <div class="text-right">
                    <button type="submit" name="tambah" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Tambah Produk</button>
                </div>
            </form>
        </div>

        <!-- Tabel Produk -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold mb-4 text-blue-600">Daftar Produk</h2>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
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
                            <tr class="hover:bg-gray-50">
                                <td class="border p-2"><?= $row['id'] ?></td>
                                <td class="border p-2"><?= htmlspecialchars($row['nama_produk']) ?></td>
                                <td class="border p-2"><?= $row['kategori'] ?></td>
                                <td class="border p-2"><?= $row['sub_kategori'] ?></td>
                                <td class="border p-2"><?= $row['lokasi'] ?></td>
                                <td class="border p-2">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                <td class="border p-2">
                                    <img src="../uploads/<?= $row['gambar'] ?>" alt="Gambar" class="h-16 w-20 object-cover rounded">
                                </td>
                                <td class="border p-2 text-center space-x-1">
                                    <a href="?hapus=<?= $row['id'] ?>" 
                                       onclick="return confirm('Hapus produk ini?')" 
                                       class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                       Hapus
                                    </a>
                                    <a href="update-toko-hukum.php?id=<?= $row['id'] ?>" 
                                       class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                       Update
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>
</html>
