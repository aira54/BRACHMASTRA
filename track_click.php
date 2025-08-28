<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Akses tidak valid");

$user_nama           = $_POST['user_nama'] ?? '';
$jenis_konsultasi    = $_POST['jenis_konsultasi'] ?? 'konsultasi';
$pengacara_id        = (int)($_POST['pengacara_id'] ?? 0);
$pengacara_nama      = $_POST['pengacara_nama'] ?? '';
$pengacara_spesialis = $_POST['pengacara_spesialis'] ?? '';
$klik_via            = $_POST['klik_via'] ?? '';
$pertanyaan          = $_POST['pertanyaan'] ?? '';

if ($pengacara_id && $klik_via) {
    $stmt = $conn->prepare("
        INSERT INTO klik_laporan(user_nama, jenis_konsultasi, pengacara_id, pengacara_nama, pengacara_spesialis, klik_via, pertanyaan)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssissss", $user_nama, $jenis_konsultasi, $pengacara_id, $pengacara_nama, $pengacara_spesialis, $klik_via, $pertanyaan);
    $stmt->execute();
}
?>
