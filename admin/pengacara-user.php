<?php
require '../db.php'; // koneksi ke database

// Aksi hapus pengacara
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $conn->query("DELETE FROM pengacara WHERE id = $id");
    header("Location: pengacara-user.php");
    exit;
}

// Aksi hapus user
if (isset($_GET['hapus_user'])) {
    $id = (int) $_GET['hapus_user'];
    $conn->query("DELETE FROM users WHERE id = $id");
    header("Location: pengacara-user.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <link rel="icon" type="image/x-icon" href="../asset/admin.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex min-h-screen">

<?php include 'includes/admin-header.php'; ?>

<!-- Konten utama -->
<main class="flex-1 ml-64 p-6 overflow-auto">
  <div class="w-full max-w-6xl mx-auto space-y-10">

    <!-- Data Pengacara -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">
      <h2 class="text-xl font-bold mb-6 text-blue-700 text-center">Daftar Pengacara</h2>
      <div class="overflow-x-auto">
        <table class="w-full text-sm border rounded-lg overflow-hidden">
          <thead class="bg-gradient-to-r from-blue-200 to-blue-300 text-gray-700">
            <tr>
              <th class="px-4 py-3 text-left">Nama</th>
              <th class="px-4 py-3 text-left">Spesialis</th>
              <th class="px-4 py-3 text-left">Tipe</th>
              <th class="px-4 py-3 text-left">Email</th>
              <th class="px-4 py-3 text-left">Telepon</th>
              <th class="px-4 py-3 text-left">Harga Konsultasi</th>
              <th class="px-4 py-3 text-left">Deskripsi</th>
              <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            <?php
            $data = $conn->query("SELECT * FROM pengacara ORDER BY id DESC");
            while ($p = $data->fetch_assoc()):
            ?>
              <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3"><?= htmlspecialchars($p['nama']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($p['spesialis']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($p['tipe_konsultasi']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($p['email'] ?? '-') ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($p['telepon'] ?? '-') ?></td>
                <td class="px-4 py-3 font-semibold text-green-600">
                  Rp <?= number_format($p['harga_konsultasi'], 0, ',', '.') ?>
                </td>
                <td class="px-4 py-3"><?= htmlspecialchars($p['deskripsi']) ?></td>
                <td class="px-4 py-3 space-x-2">
                  <a href="update.php?id=<?= $p['id'] ?>" class="text-blue-600 hover:text-blue-800 font-medium">Update</a>
                  <a href="?hapus=<?= $p['id'] ?>" onclick="return confirm('Hapus pengacara ini?')" class="text-red-600 hover:text-red-800 font-medium">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Data User Login & Registrasi -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">
      <h2 class="text-xl font-bold mb-6 text-green-700 text-center">Data User Login & Registrasi</h2>
      <div class="overflow-x-auto">
        <table class="w-full text-sm border rounded-lg overflow-hidden">
          <thead class="bg-gradient-to-r from-green-200 to-green-300 text-gray-700">
            <tr>
              <th class="px-4 py-3 text-left">ID</th>
              <th class="px-4 py-3 text-left">Nama</th>
              <th class="px-4 py-3 text-left">Email</th>
              <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            <?php
            $users = $conn->query("SELECT * FROM users ORDER BY id DESC");
            while ($u = $users->fetch_assoc()):
            ?>
              <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3"><?= htmlspecialchars($u['id']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($u['name']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($u['email']) ?></td>
                <td class="px-4 py-3">
                  <a href="?hapus_user=<?= $u['id'] ?>" onclick="return confirm('Hapus user ini?')" class="text-red-600 hover:text-red-800 font-medium">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</main>

</body>
</html>
