<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Brachmastra</title>
  <link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  
  <style>
    body { font-family: 'Poppins', sans-serif; }
    #page-loader {
      display: none;
      position: fixed;
      z-index: 9999;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(255, 255, 255, 0.9);
      justify-content: center;
      align-items: center;
    }
    .scale-icon {
      width: 80px;
      height: 80px;
      animation: swing 1s ease-in-out infinite;
    }
    @keyframes swing {
      0%   { transform: rotate(-10deg); }
      50%  { transform: rotate(10deg); }
      100% { transform: rotate(-10deg); }
    }
  </style>
</head>

<body class="bg-white text-gray-800">
<?php session_start(); ?>

<!-- Loader -->
<div id="page-loader">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="scale-icon" fill="#2563eb">
      <path d="M32 2l8 16h-4v10h-8V18h-4l8-16zM14 30l6-12 6 12H14zm24 0l6-12 6 12H38zM8 32h12v2c0 5-4 9-9 9H9c-5 0-9-4-9-9v-2h8zm36 0h12v2c0 5-4 9-9 9h-1c-5 0-9-4-9-9v-2h8zm-12 4c4 0 7 3 7 7v19h-14V43c0-4 3-7 7-7z"/>
  </svg>
</div>

<!-- Modal Login -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
  <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 text-center">
    <h2 class="text-xl font-bold text-gray-800 mb-4">⚠️ Akses Ditolak</h2>
    <p class="text-gray-600 mb-6">Silakan <span class="font-semibold text-blue-600">Login</span> atau <span class="font-semibold text-blue-600">Registrasi</span> untuk melanjutkan.</p>
    <div class="flex justify-center space-x-4">
      <a href="login.php" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Login</a>
      <a href="register.php" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Registrasi</a>
      <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</button>
    </div>
  </div>
</div>

<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col md:flex-row md:justify-between md:items-center">
    <a href="hukum.php" class="text-xl font-semibold text-blue-700">BRACHMASTRA</a>
    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6 mt-2 md:mt-0">
      <a href="hukum.php" class="text-gray-700 hover:text-blue-700">Beranda</a>
      <a href="pengacara.php" class="text-gray-700 hover:text-blue-700">Pengacara</a>
      <a href="konsultasi.php" class="text-gray-700 hover:text-blue-700">Konsultasi</a>
       <a href="tentang-kami.html" class="text-gray-700 hover:text-blue-700">Tentang Kami</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="text-white bg-red-600 px-4 py-2 rounded hover:bg-red-700">Logout</a>
      <?php else: ?>
        <a href="login.php" class="text-white bg-blue-700 px-4 py-2 rounded-lg hover:bg-blue-800">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- =============================== -->
<!-- Seluruh isi halaman kamu tetap -->
<!-- =============================== -->

<!-- Script Loader + Modal -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

    document.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function (e) {
            const url = this.getAttribute("href");

            // Skip anchor kosong
            if (!url || url === "#" || url.startsWith("javascript:")) return;

            // pengecualian: link kontak & lokasi (selalu bisa diakses)
            const bebasLogin = (
                url.startsWith("mailto:") ||
                url.startsWith("tel:") ||
                url.includes("instagram.com") ||
                url.includes("facebook.com") ||
                url.includes("hukum.php") ||
                url.includes("google.com/maps")
            );

            // jika belum login dan link bukan pengecualian
            if (!isLoggedIn && !bebasLogin && !url.includes("login.php") && !url.includes("register.php")) {
                e.preventDefault();
                openModal();
            } else {
                // tampilkan loader lalu lanjutkan
                e.preventDefault();
                document.getElementById("page-loader").style.display = "flex";
                setTimeout(function () {
                    window.location.href = url;
                }, 500);
            }
        });
    });
});

function openModal() {
    document.getElementById("loginModal").classList.remove("hidden");
    document.getElementById("loginModal").classList.add("flex");
}
function closeModal() {
    document.getElementById("loginModal").classList.remove("flex");
    document.getElementById("loginModal").classList.add("hidden");
}
</script>








 
 <!-- Hero Section -->
<section class="bg-gray-50 py-20">
  <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
    <!-- Text Content -->
    <div class="md:w-1/2 mb-10 md:mb-0">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight mb-4">Konsultasi Hukum dalam Genggaman</h1>
      <h2 class="text-lg text-blue-700 font-semibold mb-3">Aman dan Terpercaya.</h2>
      <p class="text-gray-600 mb-6">Dapatkan solusi hukum dari pengacara profesional, kapan saja dan di mana saja. Proses mudah, cepat, dan dijamin privasi Anda.</p>
      <div class="space-x-4">
        <div class="flex flex-col sm:flex-row gap-4">
  <a href="konsultasigratis.php" class="bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition text-center">
    Mulai Konsultasi Sekarang
  </a>
  <a href="mailto:bbar53905@gmail.com" class="border border-gray-400 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-100 transition text-center">
    Hubungi Kami
  </a>
</div>

      </div>
    </div>

    <!-- Image Content -->
    <div class="md:w-1/2 flex flex-col items-center relative">
  <img src="asset/logo2.png" alt="Timbangan Keadilan" class="w-40 md:w-80 z-10 relative">
  <!-- Chat Bubble -->
  <div class="mt-4 md:mt-0 md:absolute md:top-0 md:right-0 md:transform md:translate-x-8 md:-translate-y-6 bg-white border rounded-lg shadow-md p-4 w-60 text-sm text-left">
    <p class="mb-2"><span class="font-semibold text-green-600">Klien:</span> Saya butuh bantuan soal warisan.</p>
    <p><span class="font-semibold text-blue-700">Pengacara:</span> Kami siap bantu. Mari atur konsultasi pertama Anda.</p>
  </div>
</div>

</section>


  <!-- Kategori Hukum -->
 <section class="py-16 bg-white">
  <div class="max-w-6xl mx-auto px-4">
    <h3 class="text-2xl font-semibold text-center mb-10">Layanan hukum yang banyak dicari</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
      
      <!-- Kartu Pidana -->
      <a href="Jalurhukum/pidana/pidana.php" class="relative rounded-xl overflow-hidden group">
        <img src="asset/pidana.jpg" alt="Pidana" class="w-full h-48 object-cover group-hover:scale-105 transition">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14L21 3M21 3l-6 6m6-6L3 21" />
          </svg>
          <p class="font-semibold text-lg">Pidana</p>
        </div>
      </a>

      <!-- Kartu Perdata -->
      <a href="Jalurhukum/perdata/perdata.php" class="relative rounded-xl overflow-hidden group">
        <img src="asset/perdata.jpg" alt="Perdata" class="w-full h-48 object-cover group-hover:scale-105 transition">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a4 4 0 00-8 0v2H5v12h14V9h-2z" />
          </svg>
          <p class="font-semibold text-lg">Perdata</p>
        </div>
      </a>

      <!-- Kartu Keluarga -->
      <a href="Jalurhukum/keluarga/keluarga.php" class="relative rounded-xl overflow-hidden group">
        <img src="asset/Keluarga.jpg" alt="Keluarga" class="w-full h-48 object-cover group-hover:scale-105 transition">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
          <p class="font-semibold text-lg">Keluarga</p>
        </div>
      </a>

      <!-- Kartu Bisnis -->
      <a href="Jalurhukum/bisnis/bisnis.php" class="relative rounded-xl overflow-hidden group">
        <img src="asset/bisnis.jpg" alt="Bisnis" class="w-full h-48 object-cover group-hover:scale-105 transition">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m2 4v-6a2 2 0 10-4 0v6m8 0h1a2 2 0 002-2v-6a2 2 0 00-2-2h-1m-4 10h4" />
          </svg>
          <p class="font-semibold text-lg">Bisnis</p>
        </div>
      </a>

    </div>
  </div>
</section>

<!-- Section Fitur & Mockup -->
<section class="bg-white py-16">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
     <!-- Kolom Mockup -->
    <div class="flex justify-center relative">
      <img src="asset/people2.png" alt="Mockup Aplikasi Konsultasi" class="w-64 md:w-80 z-10">
  
      
    </div>
    
    <!-- Kolom Fitur -->
    <div class="space-y-6">
      <!-- Fitur 1 -->
      <div class="flex items-start space-x-4">
        <div class="text-blue-600 text-2xl">
          <i class="fas fa-clock"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Konsultasi Di Mana Aja</h3>
          <p class="text-gray-600 text-sm">Konsultasi hukum secara online 24 jam melalui chat di mana saja dan kapan saja.</p>
        </div>
      </div>
      <!-- Fitur 2 -->
      <div class="flex items-start space-x-4">
        <div class="text-blue-600 text-2xl">
          <i class="fas fa-shield-alt"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Harga Transparan</h3>
          <p class="text-gray-600 text-sm">Layanan hukum berkualitas dengan harga transparan sesuai kebutuhan Anda.</p>
        </div>
      </div>
      <!-- Fitur 3 -->
      <div class="flex items-start space-x-4">
        <div class="text-blue-600 text-2xl">
          <i class="fas fa-user-tie"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Advokat Profesional</h3>
          <p class="text-gray-600 text-sm">Konsultasikan permasalahan hukum Anda bersama Mitra Advokat berpengalaman.</p>
        </div>
      </div>
      <!-- Fitur 4 -->
      <div class="flex items-start space-x-4">
        <div class="text-blue-600 text-2xl">
          <i class="fas fa-balance-scale"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Individu & Bisnis</h3>
          <p class="text-gray-600 text-sm">Pendampingan sesuai kebutuhan, mulai urusan bisnis hingga permasalahan pribadi.</p>
        </div>
      </div>
    </div>

   
  </div>

<!-- Tombol Mengambang -->
<button onclick="toggleChat()" 
  class="fixed bottom-4 right-4 bg-blue-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-blue-700">
  💬
</button>

<!-- Bubble Chat -->
<div id="chatbot" class="fixed bottom-20 right-4 w-80 bg-white shadow-lg rounded-lg hidden">
  <div class="bg-blue-600 text-white p-3 rounded-t-lg flex justify-between items-center">
    <span>Chat CS Brachmastra</span>
    <button onclick="toggleChat()">✖</button>
  </div>
  <div id="chatbox" class="h-64 overflow-y-auto p-3 text-sm"></div>

  <!-- Quick Reply -->
  <div id="quickReply" class="flex flex-wrap gap-2 p-2 border-t bg-gray-50">
    <button onclick="sendQuick('jam buka')" class="bg-gray-200 text-sm px-2 py-1 rounded hover:bg-gray-300">Jam Buka</button>
    <button onclick="sendQuick('layanan')" class="bg-gray-200 text-sm px-2 py-1 rounded hover:bg-gray-300">Layanan</button>
    <button onclick="sendQuick('kontak')" class="bg-gray-200 text-sm px-2 py-1 rounded hover:bg-gray-300">Kontak</button>
    <button onclick="sendQuick('lokasi')" class="bg-gray-200 text-sm px-2 py-1 rounded hover:bg-gray-300">Lokasi</button>
  </div>

  <!-- Input Pesan -->
  <div class="p-3 border-t flex">
    <input id="userInput" type="text" placeholder="Tulis pesan..." 
           class="flex-1 border rounded-l p-2 text-sm">
    <button onclick="sendMessage()" 
            class="bg-blue-600 text-white px-3 rounded-r">Kirim</button>
  </div>
</div>

<script>
function toggleChat() {
  document.getElementById("chatbot").classList.toggle("hidden");
}

// Kirim pesan manual
function sendMessage() {
  let input = document.getElementById("userInput");
  let message = input.value.trim();
  if (!message) return;
  appendMessage("Anda", message, "text-right text-blue-600");
  input.value = "";
  fetchReply(message);
}

// Kirim pesan dari quick reply
function sendQuick(message) {
  appendMessage("Anda", message, "text-right text-blue-600");
  fetchReply(message);
}

// Tambahkan pesan ke chatbox
function appendMessage(sender, text, style="") {
  let chatbox = document.getElementById("chatbox");
  chatbox.innerHTML += `<div class="${style} mb-2">${sender}: ${text}</div>`;
  chatbox.scrollTop = chatbox.scrollHeight;
}

// Ambil balasan dari backend + efek mengetik
function fetchReply(message) {
  let chatbox = document.getElementById("chatbox");

  // Tambahkan placeholder "sedang mengetik..."
  let typingId = "typing_" + Date.now();
  chatbox.innerHTML += `<div id="${typingId}" class="text-left text-gray-500 italic mb-2">CS sedang mengetik...</div>`;
  chatbox.scrollTop = chatbox.scrollHeight;

  fetch("chatbot.php", {
    method: "POST",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({message: message})
  })
  .then(res => res.json())
  .then(data => {
    setTimeout(() => {
      let typingDiv = document.getElementById(typingId);
      if (typingDiv) typingDiv.remove();
      appendMessage("CS", data.reply, "text-left text-gray-700");
    }, 400); // Delay 0,4 detik
  });
}
</script>



  <!-- Footer teks -->
  <div class="mt-12 text-center">
    <h3 class="text-lg font-semibold">Platform Konsultasi <span class="text-blue-600">Hukum Online</span></h3>
    <p class="text-gray-600 text-sm max-w-2xl mx-auto mt-2">Langkah awal menuju ketenangan dimulai dari keberanian untuk bicara. Konsultasikan sekarang.</p>
  </div>
</section>


  <!-- Berita & Testimoni -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
      <h3 class="text-2xl font-semibold text-center mb-10">Berita & Testimoni</h3>
      <div class="grid md:grid-cols-3 gap-6">
        <!-- Testimoni 1 -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <img src="asset/fasilitas-kantor.webp" alt="Testimoni Andi"
            class="rounded-md mb-4 w-full object-cover">
        
          <h4 class="text-lg font-semibold text-blue-700 mb-2">"Pelayanan cepat dan terpercaya!"</h4>
          <p class="text-gray-600 text-sm">Saya sempat bingung soal kasus warisan, dan BRACHMASTRA membantu saya
            menemukan pengacara yang tepat dalam waktu 1 hari.</p>
             <a href="#" class="text-blue-600 text-sm mt-2 inline-block hover:underline">Lihat</a>
          <p class="text-gray-500 text-xs mt-2">- Rina, Jakarta</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
          <img src="asset/1755663464_Screenshot 2025-07-31 225351.png" alt="Testimoni Andi"
            class="rounded-md mb-4 w-full object-cover">
        
          <h4 class="text-lg font-semibold text-blue-700 mb-2">Artikel: Mengenal Jalur Hukum Perdata</h4>
          <p class="text-gray-600 text-sm">Simak penjelasan dasar mengenai hukum perdata dan kapan sebaiknya kamu
            menggunakan jalur ini.</p>
          <a href="https://www.bing.com/search?q=sastra%20brachmastra%20yudha&qs=n&form=QBRE&sp=-1&ghc=1&lq=0&pq=sastra%20brachmastra%20yudha&sc=11-24&sk=&cvid=F09F3FA983B14EAA962EF768E05FA246" class="text-blue-600 text-sm mt-2 inline-block hover:underline">Baca Selengkapnya</a>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
          <img src="asset/1755752833_Screenshot 2025-07-31 225358.png" alt="Testimoni Andi"
            class="rounded-md mb-4 w-full object-cover">
          
          <h4 class="text-lg font-semibold text-blue-700 mb-2">"Pengalaman menyewa pengacara sangat mudah!"</h4>
          <p class="text-gray-600 text-sm">Dengan fitur sewa pengacara, saya bisa langsung jadwalkan konsultasi dan
            semuanya transparan.</p>
          <p class="text-gray-500 text-xs mt-2">- Andi, Bandung</p>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-gray-100 py-10 mt-10 text-center text-gray-700 text-sm">
  <div class="max-w-6xl mx-auto px-4">
    
    <!-- Kontak -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="mb-8">
  <h4 class="text-lg font-semibold text-gray-800 mb-4 text-center">Hubungi Kami</h4>
  <div class="flex justify-center space-x-6 text-2xl">
    <!-- Email -->
    <a href="mailto:info@brachmastra.com" class="text-gray-600 hover:text-red-500">
      <i class="fa-solid fa-envelope"></i>
    </a>
    <!-- Instagram -->
    <a href="https://instagram.com/brachmastra" target="_blank" class="text-gray-600 hover:text-pink-500">
      <i class="fa-brands fa-instagram"></i>
    </a>
    <!-- Facebook -->
    <a href="https://facebook.com/brachmastra" target="_blank" class="text-gray-600 hover:text-blue-600">
      <i class="fa-brands fa-facebook"></i>
    </a>
    <!-- Telepon -->
    <a href="tel:+6281234567890" class="text-gray-600 hover:text-green-600">
      <i class="fa-solid fa-phone"></i>
    </a>
  </div>
</div>


    <!-- Lokasi -->
    <div class="mb-8">
      <h4 class="text-lg font-semibold text-gray-800 mb-2">Lokasi Kami</h4>
      <div class="w-full h-64 shadow-md rounded-lg overflow-hidden border border-gray-300">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2926.1234567890123!2d112.02944!3d-6.90056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70fc...%3A0x...!2sDesa%20Kembangbilo%2C%20Tuban!5e0!3m2!1sid!2sid!4v1629898766891!5m2!1sid!2sid"
          width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>

    <!-- Copyright -->
    <p class="text-sm md:text-base text-gray-500">
      &copy; 2025 <span class="font-semibold tracking-wide text-gray-700">BRACHMASTRA</span>. Seluruh hak cipta dilindungi.
    </p>
    <p>by:barabarong</p>

  </div>
</footer>


</body>

</html>