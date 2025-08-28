<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}

$id = (int)($_GET['id'] ?? 0);
$result = $conn->query("SELECT * FROM pengacara WHERE id = $id");
if ($result->num_rows === 0) die("Pengacara tidak ditemukan.");
$p = $result->fetch_assoc();

$user_nama = $_SESSION['user_name'];
$jenis_konsultasi = $p['jalur_hukum'] ?? $p['tipe_konsultasi'] ?? 'konsultasi';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
<title><?= htmlspecialchars($p['nama']) ?> - Konsultasi</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full text-center">
  <img src="<?= htmlspecialchars($p['foto']) ?>" class="w-28 h-28 rounded-full mx-auto mb-4 object-cover" alt="<?= htmlspecialchars($p['nama']) ?>">
  <h2 class="text-2xl font-bold text-blue-700 mb-2"><?= htmlspecialchars($p['nama']) ?></h2>
  <p class="text-gray-600 mb-4"><?= htmlspecialchars($p['spesialis']) ?></p>
  <p class="text-gray-700 mb-6"><?= htmlspecialchars($p['deskripsi']) ?></p>

  <div class="flex justify-center space-x-4">
    <?php if (!empty($p['telepon'])): ?>
      <button onclick="openConsultPopup('whatsapp')"
         class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">WhatsApp</button>
    <?php endif; ?>
    <?php if (!empty($p['email'])): ?>
      <button onclick="openConsultPopup('email')"
         class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Email</button>
    <?php endif; ?>
  </div>

  <div class="mt-6">
    <a href="konsultasi.php?show=list" class="text-blue-600 hover:underline">← Kembali</a>
  </div>
</div>

<!-- Popup Modal -->
<div id="consultPopup" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
  <div class="bg-white p-6 rounded-lg max-w-md w-full">
    <h3 class="text-lg font-bold mb-4">Apa yang akan Anda konsultasikan?</h3>
    <textarea id="konsultasiText" class="w-full border rounded p-2 mb-4" rows="4" placeholder="Tulis pertanyaan atau informasi konsultasi..."></textarea>
    <div class="flex justify-end space-x-2">
      <button onclick="closePopup()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
      <button onclick="submitConsult()" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Kirim</button>
    </div>
  </div>
</div>

<form id="trackForm" method="POST" action="track_click.php" target="hidden_iframe" style="display:none;">
  <input type="hidden" name="user_nama" value="<?= htmlspecialchars($user_nama) ?>">
  <input type="hidden" name="jenis_konsultasi" value="<?= htmlspecialchars($jenis_konsultasi) ?>">
  <input type="hidden" name="pengacara_id" value="<?= $id ?>">
  <input type="hidden" name="pengacara_nama" value="<?= htmlspecialchars($p['nama']) ?>">
  <input type="hidden" name="pengacara_spesialis" value="<?= htmlspecialchars($p['spesialis']) ?>">
  <input type="hidden" name="klik_via" id="klikVia">
  <input type="hidden" name="pertanyaan" id="pertanyaan">
</form>
<iframe name="hidden_iframe" style="display:none;"></iframe>

<script>
let selectedVia = '';

function openConsultPopup(via){
    selectedVia = via;
    document.getElementById('consultPopup').classList.remove('hidden');
}

function closePopup(){
    document.getElementById('consultPopup').classList.add('hidden');
    document.getElementById('konsultasiText').value = '';
}

function submitConsult(){
    let text = document.getElementById('konsultasiText').value.trim();
    if(!text){
        alert("Silakan tulis pertanyaan Anda!");
        return;
    }

    document.getElementById('klikVia').value = selectedVia;
    document.getElementById('pertanyaan').value = text;
    document.getElementById('trackForm').submit();

    closePopup();

    let url = '';
    if(selectedVia === 'whatsapp') {
        let msg = encodeURIComponent(
            "Saya dari web Brachmastra. " +
            "Saya hendak berkonsultasi mengenai: " + text + ".\n\n" +
            "Mohon bantuan dan arahan dari Bapak/Ibu Pengacara. " +
            "Atas perhatiannya saya ucapkan terima kasih."
        );
        url = 'https://wa.me/<?= htmlspecialchars($p['telepon']) ?>?text=' + msg;
    } else {
        let body = encodeURIComponent(
            "Saya dari web Brachmastra.\n\n" +
            "Saya hendak berkonsultasi mengenai: " + text + ".\n\n" +
            "Mohon bantuan dan arahan dari Bapak/Ibu Pengacara.\n\n" +
            "Atas perhatiannya saya ucapkan terima kasih."
        );
        url = 'mailto:<?= htmlspecialchars($p['email']) ?>?subject=' + encodeURIComponent('Konsultasi dari Web Brachmastra') + '&body=' + body;
    }

    window.open(url, '_blank');
}
</script>
</body>
</html>
