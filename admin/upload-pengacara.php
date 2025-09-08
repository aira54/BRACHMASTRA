<?php
require '../db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Ambil data lama
$stmt = $conn->prepare("SELECT * FROM pengacara WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $tipe = $_POST['tipe_konsultasi'];
    $deskripsi = $_POST['deskripsi'];
    $pendidikan = $_POST['pendidikan'];

    $fotoPath = $data['foto']; // default foto lama

    if (!empty($_FILES['foto']['name'])) {
        $fotoName = time() . '_' . $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = '../uploads/' . $fotoName;
        $fotoPath = 'uploads/' . $fotoName;
        move_uploaded_file($tmp, $folder);
    }

    $stmt = $conn->prepare("UPDATE pengacara 
        SET nama=?, spesialis=?, email=?, telepon=?, tipe_konsultasi=?, deskripsi=?, pendidikan=?, foto=? 
        WHERE id=?");
    $stmt->bind_param("ssssssssi", $nama, $spesialis, $email, $telepon, $tipe, $deskripsi, $pendidikan, $fotoPath, $id);
    $stmt->execute();

    header("Location: admin.php?update=success");
    exit;
}
?>
