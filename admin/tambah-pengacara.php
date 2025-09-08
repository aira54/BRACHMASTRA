<?php
require '../db.php'; // akses koneksi database di luar folder admin

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama       = $_POST['nama'];
    $spesialis  = $_POST['spesialis'];
    $email      = $_POST['email'];
    $telepon    = $_POST['telepon'];
    $tipe       = $_POST['tipe_konsultasi'];
    $deskripsi  = $_POST['deskripsi'];
    $pendidikan = $_POST['pendidikan'];
    $harga      = (int) $_POST['harga_konsultasi']; // ✅ harga dari form

    // Upload foto
    $fotoName = time() . '_' . $_FILES['foto']['name'];
    $tmp      = $_FILES['foto']['tmp_name'];
    $folder   = '../uploads/' . $fotoName;
    $fotoPath = 'uploads/' . $fotoName;

    if (move_uploaded_file($tmp, $folder)) {
        $stmt = $conn->prepare("INSERT INTO pengacara 
            (nama, spesialis, email, telepon, tipe_konsultasi, deskripsi, pendidikan, harga_konsultasi, foto) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssis", $nama, $spesialis, $email, $telepon, $tipe, $deskripsi, $pendidikan, $harga, $fotoPath);
        $stmt->execute();

        header("Location: admin.php");
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengacara</title>
    <link rel="icon" type="image/x-icon" href="../asset/admin.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex min-h-screen">

    <!-- Sidebar -->
    <?php include 'includes/admin-header.php'; ?>

    <!-- Konten utama -->
    <main class="flex-1 ml-64 p-6 overflow-auto flex items-center justify-center">
        <div class="bg-white w-full max-w-3xl rounded-xl shadow-md p-8">
            <h1 class="text-2xl font-bold text-blue-700 mb-6 text-center">Form Tambah Pengacara</h1>

            <form method="POST" action="tambah-pengacara.php" enctype="multipart/form-data" class="space-y-6">
    <!-- Nama & Spesialis -->
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="nama" required 
                   class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label class="block mb-1 font-medium">Spesialis</label>
            <input type="text" name="spesialis" required 
                   class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
    </div>

    <!-- Pendidikan -->
    <div>
        <label class="block mb-1 font-medium">Pendidikan</label>
        <input type="text" name="pendidikan" required 
               class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- Email & Telepon -->
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" required 
                   class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label class="block mb-1 font-medium">Telepon (contoh: 6281234567890)</label>
            <input type="text" name="telepon" required 
                   class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
    </div>

    <!-- Tipe Konsultasi & Harga -->
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block mb-1 font-medium">Tipe Konsultasi</label>
            <select name="tipe_konsultasi" required 
                    class="w-full border border-gray-300 px-3 py-2 rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="gratis">Gratis</option>
                <option value="berbayar">Berbayar</option>
            </select>
        </div>
        <div>
            <label class="block mb-1 font-medium">Harga Konsultasi (Rp)</label>
            <input type="number" name="harga_konsultasi" value="0" min="0" 
                   class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
    </div>

    <!-- Foto -->
    <div>
        <label class="block mb-1 font-medium">Foto (Upload)</label>
        <input type="file" name="foto" accept="image/*" required 
               class="w-full border border-gray-300 px-3 py-2 rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- Deskripsi -->
    <div>
        <label class="block mb-1 font-medium">Deskripsi</label>
        <textarea name="deskripsi" rows="4" required 
                  class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
    </div>

    <!-- Tombol Simpan -->
    <div class="text-center">
        <button type="submit" 
                class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200">
            Simpan Pengacara
        </button>
    </div>
</form>

        </div>
    </main>

</body>
</html>
