<?php
$conn = new mysqli("localhost", "root", "", "brachmastra");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$user_nama       = $_POST['user_nama'] ?? '';
$jenis_konsultasi= $_POST['jenis_konsultasi'] ?? '';
$pengacara_id    = (int)($_POST['pengacara_id'] ?? 0);
$pengacara_nama  = $_POST['pengacara_nama'] ?? '';
$pengacara_spesialis = $_POST['pengacara_spesialis'] ?? '';
$klik_via        = $_POST['klik_via'] ?? '';
$pertanyaan      = $_POST['pertanyaan'] ?? '';
$metode_bayar    = $_POST['metode_bayar'] ?? null;
$harga           = (int)($_POST['harga'] ?? 0);

$stmt = $conn->prepare("INSERT INTO klik_laporan 
(user_nama, jenis_konsultasi, pengacara_id, pengacara_nama, pengacara_spesialis, klik_via, pertanyaan, metode_bayar, harga) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisssssi", 
    $user_nama, $jenis_konsultasi, $pengacara_id, $pengacara_nama, 
    $pengacara_spesialis, $klik_via, $pertanyaan, $metode_bayar, $harga
);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
