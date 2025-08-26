<?php
require '../db.php';

// Hapus pengacara
if (isset($_GET['hapus'])) {
  $id = (int) $_GET['hapus'];
  $conn->query("DELETE FROM pengacara WHERE id = $id");
  header("Location: admin.php");
  exit;
}

// Tambah pengacara
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  $spesialis = $_POST['spesialis'];
  $tipe_konsultasi = $_POST['tipe_konsultasi'];
  $deskripsi = $_POST['deskripsi'];

  $foto = '';
  $upload_dir = '../uploads/';

  // Pastikan folder uploads/ ada
  if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
  }

  // Jika upload file
  if (!empty($_FILES['foto']['name'])) {
    $foto_nama = basename($_FILES['foto']['name']);
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_path = $upload_dir . $foto_nama;

    if (move_uploaded_file($foto_tmp, $foto_path)) {
      $foto = 'uploads/' . $foto_nama;
    } else {
      echo "Gagal mengupload foto.";
      exit;
    }

  // Jika pakai link
  } elseif (!empty($_POST['foto_link'])) {
    $foto = $_POST['foto_link'];
  }

  // Simpan ke database
  $stmt = $conn->prepare("INSERT INTO pengacara (nama, foto, spesialis, tipe_konsultasi, deskripsi) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $nama, $foto, $spesialis, $tipe_konsultasi, $deskripsi);
  $stmt->execute();

  header("Location: admin.php?success=1");
  exit;
}
?>
