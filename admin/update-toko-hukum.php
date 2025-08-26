<?php
require '../db.php';

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}
$id = (int) $_GET['id'];

// Ambil data lama
$query = $conn->query("SELECT * FROM toko_hukum WHERE id = $id");
if ($query->num_rows == 0) {
    die("Data tidak ditemukan.");
}
$data = $query->fetch_assoc();
$kategori = $data['kategori'];

// Proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk  = $_POST['nama_produk'];
    $deskripsi    = $_POST['deskripsi'];
    $harga        = $_POST['harga'];
    $kategori     = $_POST['kategori'];
    $sub_kategori = $_POST['sub_kategori'];
    $lokasi       = $_POST['lokasi'];
    $gambar_baru  = $data['gambar'];

    // Cek upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $nama_file = time() . "_" . basename($_FILES['gambar']['name']);
        $target = "../uploads/" . $nama_file;
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            $gambar_baru = $nama_file;
            // Hapus gambar lama
            if (file_exists("../uploads/" . $data['gambar'])) {
                unlink("../uploads/" . $data['gambar']);
            }
        }
    }

    // Update ke database
    $stmt = $conn->prepare("UPDATE toko_hukum SET nama_produk=?, deskripsi=?, harga=?, kategori=?, sub_kategori=?, lokasi=?, gambar=? WHERE id=?");
    $stmt->bind_param("ssissssi", $nama_produk, $deskripsi, $harga, $kategori, $sub_kategori, $lokasi, $gambar_baru, $id);
    $stmt->execute();

    header("Location: admin-toko-hukum.php?success=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="icon" type="image/x-icon" href="../asset/admin.png">

    <title>Update Produk Hukum</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-blue-700">Update Produk Hukum</h1>

    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="block font-semibold">Nama Produk</label>
            <input type="text" name="nama_produk" value="<?php echo htmlspecialchars($data['nama_produk']); ?>" class="border rounded px-3 py-2 w-full" required>
        </div>

        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="border rounded px-3 py-2 w-full" rows="4" required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
        </div>

        <div>
            <label class="block font-semibold">Harga</label>
            <input type="number" name="harga" value="<?php echo $data['harga']; ?>" class="border rounded px-3 py-2 w-full" required>
        </div>

        <div>
            <label class="block font-semibold">Kategori</label>
            <select name="kategori" id="kategori" class="border rounded px-3 py-2 w-full" required onchange="loadSubKategori()">
                <?php
                $kategori_list = ['pidana', 'perdata', 'bisnis', 'keluarga'];
                foreach ($kategori_list as $k) {
                    $selected = ($kategori == $k) ? "selected" : "";
                    echo "<option value='$k' $selected>" . ucfirst($k) . "</option>";
                }
                ?>
            </select>
        </div>

      <div>
    <label class="block font-semibold">Sub Kategori</label>
    <input type="text" name="sub_kategori" 
        value="<?php echo htmlspecialchars($data['sub_kategori'] ?? ''); ?>" 
        class="border rounded px-3 py-2 w-full" required>
</div>

<div>
    <label class="block font-semibold">Lokasi</label>
    <input type="text" name="lokasi" 
        value="<?php echo htmlspecialchars($data['lokasi'] ?? ''); ?>" 
        class="border rounded px-3 py-2 w-full" required>
</div>
        <div>
            <label class="block font-semibold">Gambar</label>
            <img src="../uploads/<?php echo $data['gambar']; ?>" alt="" class="h-32 mb-2 rounded">
            <input type="file" name="gambar" class="border rounded px-3 py-2 w-full">
        </div>

        <div class="flex justify-between">
            <a href="admin-toko-hukum.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Kembali</a>
            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>

</body>
</html>
