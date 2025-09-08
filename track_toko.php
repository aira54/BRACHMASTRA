<?php
$conn = new mysqli("localhost", "root", "", "brachmastra");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$user_nama   = $_POST['user_nama'] ?? '';
$user_email  = $_POST['user_email'] ?? '';
$produk_id   = (int)($_POST['produk_id'] ?? 0);
$produk_nama = $_POST['produk_nama'] ?? '';
$kategori    = $_POST['kategori'] ?? '';
$harga       = $_POST['harga'] ?? '';
$pertanyaan  = $_POST['pertanyaan'] ?? '';
$klik_via    = $_POST['klik_via'] ?? 'whatsapp';

$stmt = $conn->prepare("INSERT INTO toko_laporan 
    (user_nama, user_email, produk_id, produk_nama, kategori, harga, pertanyaan, klik_via) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisssss", $user_nama, $user_email, $produk_id, $produk_nama, $kategori, $harga, $pertanyaan, $klik_via,);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
