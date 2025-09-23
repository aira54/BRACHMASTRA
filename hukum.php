<?php include 'includes/header.php'; ?>
 
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-50 to-white py-20 relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between relative z-10">
    <!-- Text Content -->
    <div class="md:w-1/2 mb-10 md:mb-0">
      <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
        Konsultasi Hukum dalam Genggaman
      </h1>
      <h2 class="text-lg text-blue-700 font-semibold mb-3">Aman dan Terpercaya.</h2>
      <p class="text-gray-600 mb-6 leading-relaxed">
        Dapatkan kontak dari pengacara profesional dan konsultasi, kapan saja dan di mana saja. 
        Proses mudah, cepat, dan dijamin privasi Anda.
      </p>
      <div class="flex flex-col sm:flex-row gap-4">
        <a href="konsultasigratis.php" 
           class="bg-blue-700 text-white px-6 py-3 rounded-xl shadow-md hover:bg-blue-800 hover:shadow-lg transition text-center font-medium">
          Mulai Konsultasi Sekarang
        </a>
        <a href="mailto:bbar53905@gmail.com" 
           class="border border-gray-300 text-gray-800 px-6 py-3 rounded-xl hover:bg-gray-100 shadow-sm hover:shadow-md transition text-center font-medium">
          Hubungi Kami
        </a>
      </div>
    </div>

    <!-- Logo -->
    <div class="flex justify-center md:justify-end">
      <img src="asset/logo2.png" alt="Logo Brachmastra" 
           class="w-72 sm:w-96 md:w-[28rem] drop-shadow-lg"> 
    </div>
  </div>
</section>

<!-- Kategori Hukum -->
<section class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-4">
    <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Layanan hukum yang banyak dicari</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
      
      <!-- Kartu -->
      <?php 
      $kategori = [
        ["link"=>"Jalurhukum/pidana/pidana.php","img"=>"asset/pidana.jpg","label"=>"Pidana","icon"=>"M10 14L21 3M21 3l-6 6m6-6L3 21"],
        ["link"=>"Jalurhukum/perdata/perdata.php","img"=>"asset/perdata.jpg","label"=>"Perdata","icon"=>"M17 9V7a4 4 0 00-8 0v2H5v12h14V9h-2z"],
        ["link"=>"Jalurhukum/keluarga/keluarga.php","img"=>"asset/Keluarga.jpg","label"=>"Keluarga","icon"=>"M5 13l4 4L19 7"],
        ["link"=>"Jalurhukum/bisnis/bisnis.php","img"=>"asset/bisnis.jpg","label"=>"Bisnis","icon"=>"M13 16h-1v-4h-1m2 4v-6a2 2 0 10-4 0v6m8 0h1a2 2 0 002-2v-6a2 2 0 00-2-2h-1m-4 10h4"]
      ];
      foreach($kategori as $k): ?>
      <a href="<?= $k['link'] ?>" 
         class="relative rounded-2xl overflow-hidden group shadow-md hover:shadow-xl transition">
        <img src="<?= $k['img'] ?>" alt="<?= $k['label'] ?>" 
             class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent 
                    flex flex-col justify-center items-center text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $k['icon'] ?>" />
          </svg>
          <p class="font-semibold text-lg tracking-wide"><?= $k['label'] ?></p>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Section Fitur & Mockup -->
<section class="bg-gradient-to-r from-white via-blue-50 to-white py-20">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
    <!-- Mockup -->
    <div class="flex justify-center relative">
      <img src="asset/people2.png" alt="Mockup Aplikasi Konsultasi" 
           class="w-64 md:w-80 z-10 drop-shadow-xl">
    </div>
    
    <!-- Fitur -->
    <div class="space-y-6">
      <?php 
      $fitur = [
        ["icon"=>"fa-clock","judul"=>"Konsultasi Di Mana Aja","desc"=>"Konsultasi hukum secara online 24 jam melalui chat Whatsapp di mana saja dan kapan saja."],
        ["icon"=>"fa-shield-alt","judul"=>"Harga Transparan","desc"=>"Layanan hukum berkualitas dengan harga transparan sesuai kebutuhan Anda."],
        ["icon"=>"fa-user-tie","judul"=>"Advokat Profesional","desc"=>"Konsultasikan permasalahan hukum Anda bersama Mitra Advokat berpengalaman."],
        ["icon"=>"fa-balance-scale","judul"=>"Individu & Bisnis","desc"=>"Pendampingan sesuai kebutuhan, mulai urusan bisnis hingga permasalahan pribadi."]
      ];
      foreach($fitur as $f): ?>
      <div class="flex items-start space-x-4 bg-white/70 backdrop-blur-sm p-4 rounded-xl shadow-sm hover:shadow-md transition">
        <div class="text-blue-600 text-2xl">
          <i class="fas <?= $f['icon'] ?>"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-gray-800"><?= $f['judul'] ?></h3>
          <p class="text-gray-600 text-sm leading-relaxed"><?= $f['desc'] ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>



<!-- Footer teks -->
<div class="mt-12 text-center">
  <h3 class="text-lg font-semibold">Platform Konsultasi <span class="text-blue-600">Hukum Online</span></h3>
  <p class="text-gray-600 text-sm max-w-2xl mx-auto mt-2">Langkah awal menuju ketenangan dimulai dari keberanian untuk bicara. Konsultasikan sekarang.</p>
</div>

<!-- Berita & Testimoni -->
<section class="py-16 bg-gray-50">
  <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Seputar Brachmastra</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <?php
      $conn = new mysqli("localhost", "root", "", "brachmastra");
      $result = $conn->query("SELECT id, judul, isi, gambar, kategori, tanggal 
                              FROM berita ORDER BY tanggal DESC LIMIT 6");
      if ($result && $result->num_rows > 0):
          while ($row = $result->fetch_assoc()):
      ?>
      <div class="bg-white shadow-md rounded-2xl p-4 hover:shadow-xl transition flex flex-col">
        <?php if (!empty($row['gambar'])): ?>
          <img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" 
               alt="Gambar Berita" 
               class="w-full h-40 object-cover rounded-lg mb-4">
        <?php endif; ?>
        <h3 class="text-lg font-semibold text-blue-700 mb-2">
          <?= htmlspecialchars($row['judul']); ?>
        </h3>
        <p class="text-gray-600 text-sm flex-grow">
          <?= htmlspecialchars(substr(strip_tags($row['isi']), 0, 100)) . '...'; ?>
        </p>
        <a href="detail-berita.php?id=<?= $row['id']; ?>&from=umum<?= urlencode($row['kategori']); ?>" 
           class="mt-3 inline-block text-blue-600 hover:underline text-sm font-medium">Baca Selengkapnya</a>
      </div>
      <?php endwhile; else: ?>
        <p class="col-span-3 text-center text-gray-500">Belum ada berita tersedia.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<footer class="bg-gray-100 pt-12 pb-6 mt-16 text-gray-700 text-sm">
  <div class="max-w-6xl mx-auto px-6">

    <!-- Hubungi Kami -->
    <div class="mb-8 text-center">
      <h4 class="text-lg font-semibold text-gray-800 mb-4">Hubungi Kami</h4>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

     <div>
        <h4 class="text-lg font-semibold text-gray-800 mb-2">Lokasi Kami</h4>
        <div class="w-full h-52 shadow-md rounded-lg overflow-hidden border border-gray-300">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2926.1234567890123!2d112.02944!3d-6.90056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70fc...%3A0x...!2sDesa%20Kembangbilo%2C%20Tuban!5e0!3m2!1sid!2sid!4v1629898766891!5m2!1sid!2sid"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="border-t border-gray-300 pt-6 text-center">
      <p class="text-sm md:text-base text-gray-500">
        &copy; 2025 <span class="font-semibold tracking-wide text-gray-700">BRACHMASTRA</span>. Seluruh hak cipta dilindungi.
      </p>
      <p class="mt-1 text-xs text-gray-400">by: barabarong</p>
    </div>

  </div>
</footer>
</body>
</html>
