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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konsultasi dengan <?= htmlspecialchars($p['nama']) ?> - Brachmastra</title>
  <?php include 'includes/header.php'; ?>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<section class="pt-24 pb-16 bg-white min-h-screen">
  <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-10 items-center">
    
    <div>
      <h2 class="text-2xl font-bold text-gray-800 mb-2">Halo, <?= htmlspecialchars($user_nama) ?> 👋</h2>
      <h1 class="text-4xl font-extrabold mb-4">
        Konsultasi dengan <span class="text-blue-600"><?= htmlspecialchars($p['nama']) ?></span>
      </h1>
      <p class="text-lg text-gray-600 mb-2">
        Spesialis: <span class="font-semibold"><?= htmlspecialchars($p['spesialis']) ?></span>
      </p>
      <p class="text-lg text-gray-600 mb-6"><?= htmlspecialchars($p['deskripsi']) ?></p>

      <?php if ($p['tipe_konsultasi'] === 'berbayar'): ?>
        <p class="text-xl font-bold text-red-600 mb-6">
          Harga Konsultasi: Rp <?= number_format($p['harga_konsultasi'], 0, ',', '.') ?>
        </p>
      <?php endif; ?>
      
      <div class="flex space-x-3">
        <button onclick="startConsult('whatsapp')" class="px-5 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">
          Konsultasi via WhatsApp
        </button>
        
        <button onclick="startConsult('email')" class="px-5 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
          Konsultasi via Email
        </button>
      </div>
    </div>
    
    <div class="flex justify-center">
      <div class="bg-blue-100 rounded-full w-72 h-72 flex items-center justify-center shadow-lg">
        <img src="<?= htmlspecialchars($p['foto']) ?>" alt="<?= htmlspecialchars($p['nama']) ?>" class="w-52 h-52 object-cover rounded-full">
      </div>
    </div>
  </div>
</section>

<!-- Popup input konsultasi -->
<div id="consultPopup" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
  <div class="bg-white p-6 rounded-lg max-w-md w-full">
    <h3 class="text-lg font-bold mb-4">Apa yang ingin Anda konsultasikan?</h3>
    <textarea id="konsultasiText" class="w-full border rounded-lg p-3 mb-4 focus:ring-2 focus:ring-blue-400" rows="4" placeholder="Tulis pertanyaan Anda..."></textarea>
    <div class="flex justify-end space-x-2">
      <button onclick="closePopup()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
      <button onclick="submitConsult()" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Kirim</button>
    </div>
  </div>
</div>

<!-- Popup pesan formal siap copy -->
<div id="messagePopup" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
  <div class="bg-white p-6 rounded-lg max-w-md w-full">
    <h3 class="text-lg font-bold mb-4">Pesan Konsultasi Siap</h3>
    <textarea id="formalMessage" class="w-full border rounded-lg p-3 mb-4" rows="6" readonly></textarea>
    <div class="flex justify-between">
      <button onclick="closeMessagePopup()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Tutup</button>
      <button onclick="copyMessage()" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Copy & Lanjutkan</button>
    </div>
    <p class="text-sm text-gray-500 mt-2">Pesan akan disalin dan WhatsApp pengacara akan terbuka.</p>
  </div>
</div>

<!-- Popup metode pembayaran -->
<div id="paymentPopup" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
  <div class="bg-white p-6 rounded-lg max-w-md w-full text-center">
    <h3 class="text-lg font-bold mb-4">Pilih Metode Pembayaran</h3>
    <button onclick="selectPayment('Transfer Bank')" class="block w-full px-4 py-2 bg-indigo-600 text-white rounded mb-3 hover:bg-indigo-700">Transfer Bank</button>
    <button onclick="selectPayment('E-Wallet')" class="block w-full px-4 py-2 bg-purple-600 text-white rounded mb-3 hover:bg-purple-700">E-Wallet</button>
    <button onclick="selectPayment('Kartu Kredit')" class="block w-full px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Kartu Kredit</button>
    <button onclick="closePaymentPopup()" class="mt-4 px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
  </div>
</div>

<!-- Toast notifikasi custom -->
<div id="toast" class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg opacity-0 transition-opacity duration-300 z-50">
  Pesan berhasil dicopy!
</div>

<form id="trackForm" method="POST" action="track_click.php" target="hidden_iframe" style="display:none;">
  <input type="hidden" name="user_nama" value="<?= htmlspecialchars($user_nama) ?>">
  <input type="hidden" name="jenis_konsultasi" value="<?= htmlspecialchars($jenis_konsultasi) ?>">
  <input type="hidden" name="pengacara_id" value="<?= $id ?>">
  <input type="hidden" name="pengacara_nama" value="<?= htmlspecialchars($p['nama']) ?>">
  <input type="hidden" name="pengacara_spesialis" value="<?= htmlspecialchars($p['spesialis']) ?>">
  <input type="hidden" name="klik_via" id="klikVia">
  <input type="hidden" name="pertanyaan" id="pertanyaan">
  <input type="hidden" name="metode_bayar" id="metodeBayar"> <!-- 🆕 -->
  <input type="hidden" name="harga" value="<?= (int)($p['harga_konsultasi'] ?? 0) ?>"> <!-- 🆕 -->
</form>

<iframe name="hidden_iframe" style="display:none;"></iframe>

<script>
let selectedVia = '';
let paymentConfirmed = false;

// Fungsi awal pilih konsultasi
function startConsult(via){
    selectedVia = via;
    let tipe = "<?= $p['tipe_konsultasi'] ?>";
    if(tipe === 'berbayar' && !paymentConfirmed){
        document.getElementById('paymentPopup').classList.remove('hidden');
        return;
    }
    openConsultPopup(via);
}

function selectPayment(method){
    paymentConfirmed = true;
    document.getElementById('metodeBayar').value = method; // simpan metode ke hidden form
    closePaymentPopup();
    showToast("Pembayaran via " + method + " dipilih. Silakan lanjut konsultasi.");
    openConsultPopup(selectedVia);
}


function closePaymentPopup(){
    document.getElementById('paymentPopup').classList.add('hidden');
}

function openConsultPopup(via){
    document.getElementById('consultPopup').classList.remove('hidden');
    document.getElementById('konsultasiText').focus();
}

// Fungsi popup input
function closePopup(){
    document.getElementById('consultPopup').classList.add('hidden');
    document.getElementById('konsultasiText').value = '';
}

function submitConsult(){
    let text = document.getElementById('konsultasiText').value.trim();
    if(!text){
        showToast("Silakan tulis pertanyaan Anda!");
        return;
    }

    closePopup();

    let msg = "Halo, saya <?= addslashes($user_nama) ?> dari web Brachmastra.\n\n" +
              "Saya ingin berkonsultasi mengenai:\n" + text + "\n\n" +
              "Mohon arahan dari Bapak/Ibu Pengacara.\nTerima kasih.";

    document.getElementById('formalMessage').value = msg;
    document.getElementById('messagePopup').classList.remove('hidden');
}

function closeMessagePopup(){
    document.getElementById('messagePopup').classList.add('hidden');
}

function copyMessage(){
    let msg = document.getElementById('formalMessage');
    msg.select();
    msg.setSelectionRange(0, 99999);
    document.execCommand("copy");
    showToast("Pesan berhasil dicopy. WhatsApp pengacara akan terbuka.");

    document.getElementById('klikVia').value = selectedVia;
    document.getElementById('pertanyaan').value = msg.value;
    document.getElementById('trackForm').submit();

    let phone = "<?= preg_replace('/[^0-9]/', '', $p['telepon']) ?>";
    if (!phone.startsWith("62")) phone = "62" + phone.replace(/^0+/, "");

    if(selectedVia === 'whatsapp'){
        let url = "https://wa.me/" + phone + "?text=" + encodeURIComponent(msg.value);
        window.open(url, "_blank");
    } else if(selectedVia === 'email'){
        let email = "<?= $p['email'] ?? '' ?>";
        window.location.href = "mailto:" + email + "?subject=Konsultasi&body=" + encodeURIComponent(msg.value);
    }

    closeMessagePopup();
}

// Toast helper
function showToast(message){
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.classList.add('opacity-100');
    setTimeout(()=>{ toast.classList.remove('opacity-100'); }, 2000);
}

// Enter → submit
document.getElementById('konsultasiText').addEventListener('keydown', function(e) {
    if(e.key === 'Enter' && !e.shiftKey){
        e.preventDefault();
        setTimeout(submitConsult, 50);
    }
});
</script>

</body>
</html>
