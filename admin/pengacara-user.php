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
<body class="bg-gray-50 text-gray-800 flex">

<?php include 'includes/admin-header.php'; ?>

<!-- Konten utama -->
<main class="flex-1 ml-64 p-6 overflow-auto grid place-items-start justify-center">
  <div class="w-full max-w-5xl">


    <!-- Data Pengacara -->
<div class="bg-white p-6 rounded-2xl shadow mb-10">
  <h2 class="text-lg font-semibold mb-4 text-blue-700 text-center">Daftar Pengacara</h2>
  <div class="overflow-x-auto">
    <table class="min-w-full table-auto text-sm border">
      <thead class="bg-blue-100 text-gray-700">
        <tr>
          <th class="px-4 py-2 text-left">Nama</th>
          <th class="px-4 py-2 text-left">Spesialis</th>
          <th class="px-4 py-2 text-left">Tipe</th>
          <th class="px-4 py-2 text-left">Email</th>
          <th class="px-4 py-2 text-left">Telepon</th>
          <th class="px-4 py-2 text-left">Harga Konsultasi</th> <!-- ✅ Tambahan -->
          <th class="px-4 py-2 text-left">Deskripsi</th>
          <th class="px-4 py-2 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y">
        <?php
        $data = $conn->query("SELECT * FROM pengacara ORDER BY id DESC");
        while ($p = $data->fetch_assoc()):
        ?>
          <tr>
            <td class="px-4 py-2"><?= htmlspecialchars($p['nama']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($p['spesialis']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($p['tipe_konsultasi']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($p['email'] ?? '-') ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($p['telepon'] ?? '-') ?></td>
            <td class="px-4 py-2">
              Rp <?= number_format($p['harga_konsultasi'], 0, ',', '.') ?> <!-- ✅ Format harga -->
            </td>
            <td class="px-4 py-2"><?= htmlspecialchars($p['deskripsi']) ?></td>
            <td class="px-4 py-2 space-x-2">
              <a href="update.php?id=<?= $p['id'] ?>" class="text-blue-600 hover:underline">Update</a>
              <a href="?hapus=<?= $p['id'] ?>" onclick="return confirm('Hapus pengacara ini?')" class="text-red-600 hover:underline">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>


    <!-- Data User Login & Registrasi -->
    <div class="bg-white p-6 rounded-2xl shadow mb-10">
      <h2 class="text-lg font-semibold mb-4 text-blue-700 text-center">Data User Login & Registrasi</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-sm border">
          <thead class="bg-green-100 text-gray-700">
            <tr>
              <th class="px-4 py-2 text-left">ID</th>
              <th class="px-4 py-2 text-left">Nama</th>
              <th class="px-4 py-2 text-left">Email</th>
              <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            <?php
            $users = $conn->query("SELECT * FROM users ORDER BY id DESC");
            while ($u = $users->fetch_assoc()):
            ?>
              <tr>
                <td class="px-4 py-2"><?= htmlspecialchars($u['id']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($u['name']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($u['email']) ?></td>
                <td class="px-4 py-2">
                  <a href="?hapus_user=<?= $u['id'] ?>" onclick="return confirm('Hapus user ini?')" class="text-red-600 hover:underline">Hapus</a>
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
