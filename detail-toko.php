<?php
$conn = new mysqli("localhost", "root", "", "brachmastra");

// Pastikan ada id
if (!isset($_GET['id'])) {
    die("ID produk tidak ditemukan.");
}

$id = (int) $_GET['id'];
$result = $conn->query("SELECT * FROM toko_hukum WHERE id = $id");

if ($result->num_rows === 0) {
    die("Produk tidak ditemukan.");
}

$produk = $result->fetch_assoc();

// Tentukan link kembali berdasarkan kategori
$from = isset($_GET['from']) ? $_GET['from'] : $produk['kategori'];

switch ($from) {
    case 'pidana':
        $backLink = "jalurhukum/pidana/toko-hukum-pidana.php";
        break;
    case 'perdata':
        $backLink = "jalurhukum/perdata/toko-hukum-perdata.php";
        break;
    case 'keluarga':
        $backLink = "jalurhukum/keluarga/toko-hukum-keluarga.php";
        break;
    case 'bisnis':
        $backLink = "jalurhukum/bisnis/toko-hukum-bisnis.php";
        break;
    default:
        $backLink = "index.php"; // fallback
        break;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($produk['nama_produk']); ?></title>
    <link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded mt-6">
        <?php if (!empty($produk['gambar'])): ?>
            <img src="uploads/<?= $produk['gambar']; ?>" 
                 alt="Gambar Produk" 
                 class="w-full h-64 object-cover rounded mb-4">
        <?php endif; ?>

        <h1 class="text-2xl font-bold mb-2"><?= htmlspecialchars($produk['nama_produk']); ?></h1>
        <p class="text-sm text-gray-500 mb-4">
            Kategori: <?= ucfirst($produk['kategori']); ?> 
            | Sub: <?= htmlspecialchars($produk['sub_kategori']); ?>
            | Lokasi: <?= htmlspecialchars($produk['lokasi']); ?>
            | <?= $produk['tanggal']; ?>
        </p>

        <div class="text-gray-800 leading-relaxed mb-4">
            <?= nl2br(htmlspecialchars($produk['deskripsi'])); ?>
        </div>

        <p class="text-lg font-semibold text-green-700 mb-4">
            💰 Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>
        </p>

        <div class="flex gap-4 mt-6">
            <a href="<?= $backLink; ?>" 
               class="text-blue-600 hover:underline">← Kembali ke Produk</a>

            <!-- Tombol Hubungi Admin -->
            <button onclick="openPopup()" 
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                Hubungi Admin
            </button>
        </div>
    </div>

<!-- Popup Modal -->
<div id="consultPopup" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
  <div class="bg-white p-6 rounded-lg max-w-md w-full">
    <h3 class="text-lg font-bold mb-4">Hubungi Admin via WhatsApp</h3>

    <input id="nama" type="text" placeholder="Nama Anda" class="w-full border rounded p-2 mb-2">
    <input id="email" type="email" placeholder="Email Anda" class="w-full border rounded p-2 mb-2">
    <textarea id="pesan" class="w-full border rounded p-2 mb-4" rows="4" placeholder="Tulis kebutuhan atau pertanyaan Anda..."></textarea>

    <div class="flex justify-end space-x-2">
      <button onclick="closePopup()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
      <button onclick="submitConsult()" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Kirim WA</button>
    </div>
  </div>
</div>

<script>
function openPopup(){
    document.getElementById('consultPopup').classList.remove('hidden');
}
function closePopup(){
    document.getElementById('consultPopup').classList.add('hidden');
    document.getElementById('nama').value = '';
    document.getElementById('email').value = '';
    document.getElementById('pesan').value = '';
}
function submitConsult(){
    let nama = document.getElementById('nama').value.trim();
    let email = document.getElementById('email').value.trim();
    let pesan = document.getElementById('pesan').value.trim();

    if(!nama || !email || !pesan){
        alert("Harap isi semua data!");
        return;
    }

    let produk = "<?= addslashes($produk['nama_produk']); ?>";
    let kategori = "<?= addslashes($produk['kategori']); ?>";
    let harga = "Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>";

    let msg = `Halo Admin, saya membutuhkan layanan hukum.\n\n` +
              `Nama: ${nama}\nEmail: ${email}\n\n` +
              `Produk: ${produk}\nKategori: ${kategori}\nHarga: ${harga}\n\n` +
              `kasus: ${pesan}`;

    // Nomor WA Admin (ganti dengan nomor asli, format 62xxx)
    let noAdmin = "+6285733383387";
    let url = "https://wa.me/" + noAdmin + "?text=" + encodeURIComponent(msg);

    closePopup();
    window.open(url, "_blank");
}
</script>

</body>
</html>
