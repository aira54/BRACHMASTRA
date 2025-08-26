<?php
// admin.php
require '../db.php';

// Hapus pengacara
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $conn->query("DELETE FROM pengacara WHERE id = $id");
    header("Location: admin.php");
    exit;
}

// Hapus user
if (isset($_GET['hapus_user'])) {
    $id = (int) $_GET['hapus_user'];
    $conn->query("DELETE FROM users WHERE id = $id");
    header("Location: admin.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Pengacara & Registrasi</title>
   <link rel="icon" type="image/x-icon" href="../asset/admin.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  

<nav class="bg-white shadow p-4 mb-6">
  <div class="max-w-6xl mx-auto flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-700">Admin Panel</h1>
    <a href="tambah-pengacara.php" class="text-blue-600 hover:underline">Tambah Pengacara</a>
     <a href="admin-berita.php" class="text-blue-600 hover:underline">panel berita</a>
       <a href="admin-toko-hukum.php" class="text-blue-600 hover:underline">panel toko</a>

  </div>
</nav>

  <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">data admin</h2>

 
 <!-- Data Pengacara -->
<div class="bg-white p-6 rounded shadow mb-10">
  <h2 class="text-lg font-semibold mb-4 text-blue-700">Daftar Pengacara</h2>
  <div class="overflow-x-auto">
    <table class="min-w-full table-auto text-sm">
      <thead class="bg-blue-100">
        <tr>
          <th class="px-4 py-2 text-left">Nama</th>
          <th class="px-4 py-2 text-left">Spesialis</th>
          <th class="px-4 py-2 text-left">Tipe</th>
          <th class="px-4 py-2 text-left">Email</th>
          <th class="px-4 py-2 text-left">Telepon</th>
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
          <td class="px-4 py-2"><?= htmlspecialchars($p['deskripsi']) ?></td>
          <td class="px-4 py-2">
            <a href="update.php?id=<?= $p['id'] ?>" class="text-blue-600 hover:underline">Update</a>
            <a href="?hapus=<?= $p['id'] ?>" onclick="return confirm('Hapus pengacara ini?')" class="text-red-600 hover:underline">Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>


  <!-- Data Registrasi Konsultasi -->
  <div class="bg-white p-6 rounded shadow mb-10">
    <h2 class="text-lg font-semibold mb-4 text-blue-700">Data Registrasi Konsultasi</h2>
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto text-sm">
        <thead class="bg-green-100">
          <tr>
            <th class="px-4 py-2 text-left">Nama</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">No Telepon</th>
            <th class="px-4 py-2 text-left">Tanggal</th>
          </tr>
        </thead>
        <tbody class="divide-y">
        <?php
        $reg = $conn->query("SELECT * FROM registrasi_konsultasi ORDER BY id DESC");
        while ($r = $reg->fetch_assoc()):
        ?>
          <tr>
            <td class="px-4 py-2"><?= htmlspecialchars($r['nama_lengkap']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($r['email']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($r['no_telepon']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($r['waktu_registrasi']) ?></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div><div class="bg-white p-6 rounded shadow mb-10">
  <h2 class="text-lg font-semibold mb-4 text-blue-700">Daftar Pengguna</h2>
  <div class="overflow-x-auto">
    <table class="min-w-full table-auto text-sm">
      <thead class="bg-blue-100">
        <tr>
          <th class="px-4 py-2 text-left">ID</th>
          <th class="px-4 py-2 text-left">Nama</th>
          <th class="px-4 py-2 text-left">Email</th>
          <th class="px-4 py-2 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y">
        <?php
        // Ambil data dari tabel users
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



</body>
</html>
