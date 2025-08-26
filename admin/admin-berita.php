<?php
// admin-berita.php
$conn = new mysqli("localhost", "root", "", "brachmastra");

// Proses tambah berita
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $kategori = $_POST['kategori'];
    $tanggal = date("Y-m-d");

    // Upload gambar
    $gambar = '';
    if (!empty($_FILES['gambar']['name'])) {
        $targetDir = "../uploads/"; // folder uploads di luar Jalurhukum
        $gambar = time() . "_" . basename($_FILES["gambar"]["name"]); // supaya unik
        $targetFile = $targetDir . $gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile);
    }

    $stmt = $conn->prepare("INSERT INTO berita (judul, isi, kategori, gambar, tanggal) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $judul, $isi, $kategori, $gambar, $tanggal);
    $stmt->execute();
    header("Location: admin-berita.php");
    exit;
}

// Proses hapus berita
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $conn->query("DELETE FROM berita WHERE id = $id");
    header("Location: admin-berita.php");
    exit;
}

// Ambil semua berita
$result = $conn->query("SELECT * FROM berita ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header Admin -->
    <header class="bg-blue-600 text-white p-4 shadow">
           <link rel="icon" type="image/x-icon" href="../asset/admin.png">

        <h1 class="text-xl font-bold">Admin Panel - Manajemen Berita</h1>

       <a href="admin.php" class="inline-block bg-blue-250 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4">
        ← Kembali ke Admin
    </a>

    </header>

    <main class="max-w-6xl mx-auto p-6">

        <!-- Form Tambah Berita -->
        <div class="bg-white p-6 shadow rounded mb-6">
            <h2 class="text-lg font-semibold mb-4 text-blue-600">Tambah Berita</h2>
            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="text" name="judul" placeholder="Judul Berita" required class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <textarea name="isi" placeholder="Isi berita" required rows="5" class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                <select name="kategori" required class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="pidana">Pidana</option>
                    <option value="perdata">Perdata</option>
                    <option value="keluarga">keluarga</option>
                    <option value="bisnis">bisnis</option>
                </select>
                <input type="file" name="gambar" class="border border-gray-300 p-2 w-full rounded">
                <button type="submit" name="tambah" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Simpan Berita
                </button>
            </form>
        </div>

        <!-- Daftar Berita -->
        <div class="bg-white p-6 shadow rounded">
            <h2 class="text-lg font-semibold mb-4 text-blue-600">Daftar Berita</h2>
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-blue-100 text-blue-700">
                            <th class="border border-gray-300 p-2">Gambar</th>
                            <th class="border border-gray-300 p-2">Judul</th>
                            <th class="border border-gray-300 p-2">Kategori</th>
                            <th class="border border-gray-300 p-2">Tanggal</th>
                            <th class="border border-gray-300 p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 p-2">
                                <?php if (!empty($row['gambar'])): ?>
                                    <img src="../uploads/<?php echo $row['gambar']; ?>" class="w-20 h-12 object-cover rounded">
                                <?php else: ?>
                                    <span class="text-gray-500">Tidak ada</span>
                                <?php endif; ?>
                            </td>
                            <td class="border border-gray-300 p-2"><?php echo htmlspecialchars($row['judul']); ?></td>
                            <td class="border border-gray-300 p-2"><?php echo ucfirst(htmlspecialchars($row['kategori'])); ?></td>
                            <td class="border border-gray-300 p-2"><?php echo $row['tanggal']; ?></td>
                            <td class="border border-gray-300 p-2">
                                <a href="?hapus=<?php echo $row['id']; ?>" 
                                   class="text-red-600 hover:text-red-800 transition"
                                   onclick="return confirm('Yakin hapus berita ini?')">Hapus</a>
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
