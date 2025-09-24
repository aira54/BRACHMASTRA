# BRACHMASTRA

**BRACHMASTRA** adalah sebuah platform konsultasi hukum online yang memudahkan masyarakat untuk mencari, memilih, dan berkonsultasi dengan pengacara profesional secara daring. Proyek ini dibangun menggunakan PHP, MySQL, dan TailwindCSS, serta berjalan di lingkungan Laragon.

## Fitur Utama

- **Registrasi & Login**  
  Pengguna dapat mendaftar dan masuk untuk mengakses layanan konsultasi.

- **Pencarian & Filter Pengacara**  
  Cari pengacara berdasarkan nama atau spesialisasi (Pidana, Perdata, Keluarga, Bisnis).

- **Daftar Pengacara Dinamis**  
  Data pengacara diambil langsung dari database MySQL dan ditampilkan secara dinamis.

- **Konsultasi Gratis & Berbayar**  
  Pengacara dikategorikan berdasarkan tipe konsultasi (gratis atau berbayar).

- **Deskripsi & Profil Pengacara**  
  Setiap pengacara memiliki profil detail yang dapat diakses oleh pengguna.

## Struktur Folder (Contoh)

```
BRACHMASTRA/
├── admin/
    └──includes/
            └──header-admin.php
              footer-admin.php
      admin-berita.php
      admin-toko-hukum.php
          ----
├── asset/
├── includes/
│   └── header.php
        footer.php
├── Jalurhukum/
       └── pidana/
├── konsultasi.php
├── konsultasigratis.php
├── Login.php
├── pengacara.php
├── hukum.php
├── register.php
├── db.php
├── readme.md
└── ...
```

## Cara Menjalankan

1. Jalankan Laragon/XAMPP dan pastikan MySQL aktif.
2. Import struktur database sesuai kebutuhan.
3. Akses aplikasi melalui `http://localhost/BRACHMASTRA/` di browser.

## Lisensi

Proyek ini dibuat untuk keperluan edukasi dan pengembangan aplikasi konsultasi hukum online.

🛠️ Teknologi yang Digunakan

- PHP 8.x
- MySQL 
- TailwindCSS
- Laragon 

📸 Preview

> Tambahkan screenshot halaman utama, daftar pengacara, dan form konsultasi di sini.

![halaman utama](/docs/image.png)
---
![alt text](/docs/image-1.png)
---
![alt text](/docs/image-2.png)
---
![halaman registrasi](/docs/image-3.png)
---
![halaman login](/docs/image-4.png)
---
![user terlogin](/docs/image-5.png)
---
![user terlogin dashboard](/docs/image-6.png)
---
![user terlogin konsultasi](/docs/image-7.png)
---
![alt text](/docs/image-8.png)

---
## 🗂️ Flowchart Alur Sistem

![flowchart](/docs/Pengantar%20Konsultasi%20Brachmastra.drawio.png)

---

## 🗂️ UI Figma 

https://www.figma.com/design/vQQ3KVjKucHGwm6ESrbwJo/TA-BRACHMASTRA?node-id=0-1&t=1UP0W2QPfKxH498T-1

---

![UI](docs/UI%20by%20Figma.png)