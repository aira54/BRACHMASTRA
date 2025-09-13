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
    case 'pidana':   $backLink = "jalurhukum/pidana/toko-hukum-pidana.php"; break;
    case 'perdata':  $backLink = "jalurhukum/perdata/toko-hukum-perdata.php"; break;
    case 'keluarga': $backLink = "jalurhukum/keluarga/toko-hukum-keluarga.php"; break;
    case 'bisnis':   $backLink = "jalurhukum/bisnis/toko-hukum-bisnis.php"; break;
    case 'umum':   $backLink = "layanan.php"; break;
    default:         $backLink = "layanan.php"; break;
}
?>
<?php include 'includes/header.php'; ?>

<!-- Detail Produk -->
<section class="pt-24 pb-16 bg-white min-h-screen">
  <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-10 items-start">
    
    <!-- Gambar Produk -->
    <div class="flex justify-center">
      <?php if (!empty($produk['gambar'])): ?>
        <img src="uploads/<?= $produk['gambar']; ?>" 
             alt="Gambar Produk" 
             class="w-full max-w-md h-80 object-cover rounded-xl shadow-lg">
      <?php else: ?>
        <div class="w-full max-w-md h-80 bg-gray-200 rounded-xl flex items-center justify-center text-gray-500">
          Tidak ada gambar
        </div>
      <?php endif; ?>
    </div>
    
    <!-- Info Produk -->
    <div>
      <h1 class="text-3xl font-extrabold text-gray-800 mb-3">
        <?= htmlspecialchars($produk['nama_produk']); ?>
      </h1>
      <p class="text-sm text-gray-500 mb-4 flex flex-col">
  <span>
    Kategori: <span class="font-medium"><?= ucfirst($produk['kategori']); ?></span> | 
    Sub: <?= htmlspecialchars($produk['sub_kategori']); ?> | 
    Lokasi: <?= htmlspecialchars($produk['lokasi']); ?> | 
    <?= $produk['tanggal']; ?>
  </span>

  <span class="mt-3 flex -space-x-2">
  <?php
  // Ambil 3 pengacara sesuai kategori produk
  $kategori = $conn->real_escape_string($produk['kategori']);
  $pengacaraRes = $conn->query("SELECT foto, nama FROM pengacara 
                                WHERE spesialis LIKE '%$kategori%' 
                                LIMIT 3");

  if ($pengacaraRes && $pengacaraRes->num_rows > 0) {
      while ($peng = $pengacaraRes->fetch_assoc()) {
          $nama = htmlspecialchars($peng['nama']);
          $foto = $peng['foto'];
          if (empty($foto)) {
              $fotoPath = "assets/default-avatar.png";
          } elseif (file_exists("uploads/" . $foto)) {
              $fotoPath = "uploads/" . $foto;
          } else {
              $fotoPath = $foto;
          }

          echo "<img src='$fotoPath' alt='$nama' 
                 title='$nama'
                 class='w-10 h-10 rounded-full border-2 border-white shadow hover:scale-110 transition'>";
      }
  } else {
      echo "<span class='text-gray-400 text-sm'>Belum ada pengacara untuk kategori ini</span>";
  }
  ?>
</span>

</p>


      <p class="text-gray-700 leading-relaxed mb-6">
        <?= nl2br(htmlspecialchars($produk['deskripsi'])); ?>
      </p>

      <p class="text-2xl font-semibold text-blue-600 mb-6">
        💰 Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>
      </p>

      <div class="flex flex-wrap gap-4">
        <a href="<?= $backLink; ?>" 
           class="px-4 py-2 rounded border border-blue-600 text-blue-600 hover:bg-blue-50 transition">
          ← Kembali ke Produk
        </a>

        <button onclick="openPopup()" 
          class="px-5 py-2 rounded bg-green-600 text-white shadow hover:bg-green-700 transition">
          Hubungi Admin
        </button>
      </div>
    </div>
  </div>
</section>

<!-- Popup Modal -->
<div id="consultPopup" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white p-6 rounded-xl max-w-md w-full shadow-lg animate-fadeIn">
    <h3 class="text-xl font-bold mb-4 text-center text-gray-800">Hubungi Admin via WhatsApp</h3>

    <input id="nama" type="text" placeholder="Nama Anda" class="w-full border rounded-lg p-3 mb-3 focus:ring-2 focus:ring-blue-400">
    <input id="email" type="email" placeholder="Email Anda" class="w-full border rounded-lg p-3 mb-3 focus:ring-2 focus:ring-blue-400">
    <textarea id="pesan" class="w-full border rounded-lg p-3 mb-4 focus:ring-2 focus:ring-blue-400" rows="4" placeholder="Tulis kebutuhan atau pertanyaan Anda..."></textarea>

    <div class="flex justify-end space-x-2">
      <button onclick="closePopup()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
      <button onclick="submitConsult()" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Kirim WA</button>
    </div>
  </div>
</div>

<!-- Hidden Form Tracking -->
<form id="trackForm" method="POST" action="track_toko.php" target="hidden_iframe" style="display:none;">
  <input type="hidden" name="user_nama" id="formNama">
  <input type="hidden" name="user_email" id="formEmail">
  <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
  <input type="hidden" name="produk_nama" value="<?= htmlspecialchars($produk['nama_produk']) ?>">
  <input type="hidden" name="kategori" value="<?= htmlspecialchars($produk['kategori']) ?>">
  <input type="hidden" name="harga" value="Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>">
  <input type="hidden" name="klik_via" value="whatsapp">
  <input type="hidden" name="pertanyaan" id="formPesan">
</form>
<iframe name="hidden_iframe" style="display:none;"></iframe>

<script>
function openPopup(){
    document.getElementById('consultPopup').classList.remove('hidden');
    document.getElementById('consultPopup').classList.add('flex');
}
function closePopup(){
    document.getElementById('consultPopup').classList.add('hidden');
    document.getElementById('consultPopup').classList.remove('flex');
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

    // isi hidden form
    document.getElementById('formNama').value = nama;
    document.getElementById('formEmail').value = email;
    document.getElementById('formPesan').value = pesan;
    document.getElementById('trackForm').submit(); // simpan ke DB

    // buat pesan WA
    let produk = "<?= addslashes($produk['nama_produk']); ?>";
    let kategori = "<?= addslashes($produk['kategori']); ?>";
    let harga = "Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>";

    let msg = `Halo Admin, saya membutuhkan layanan hukum.\n\n` +
              `Nama: ${nama}\nEmail: ${email}\n\n` +
              `Produk: ${produk}\nKategori: ${kategori}\nHarga: ${harga}\n\n` +
              `Kasus: ${pesan}`;

    let noAdmin = "+628998379922";
    let url = "https://wa.me/" + noAdmin + "?text=" + encodeURIComponent(msg);

    closePopup();
    window.open(url, "_blank");
}
</script>

<style>
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.9); }
  to { opacity: 1; transform: scale(1); }
}
.animate-fadeIn {
  animation: fadeIn 0.3s ease-out;
}
</style>

<?php include 'includes/footer.php'; ?>
</body>
</html>
