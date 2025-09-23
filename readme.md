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

- **Form Registrasi Konsultasi**  
  Pengguna dapat mendaftar untuk konsultasi dengan mengisi nama lengkap, email, dan nomor telepon.

- **Deskripsi & Profil Pengacara**  
  Setiap pengacara memiliki profil detail yang dapat diakses oleh pengguna.

## Struktur Folder (Contoh)

```
BRACHMASTRA/
├── admin/
├── asset/
├── includes/
│   └── header.php
├── Jalurhukum/
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

## Database

### Tabel `pengacara`
| id | nama | foto | spesialis | deskripsi | tipe_konsultasi |
|----|------|------|-----------|-----------|-----------------|

### Tabel `registrasi_konsultasi`
| id | nama_lengkap | email | no_telepon | created_at |
|----|--------------|-------|------------|------------|

## Cara Menjalankan

1. Jalankan Laragon/XAMPP dan pastikan MySQL aktif.
2. Import struktur database sesuai kebutuhan.
3. Akses aplikasi melalui `http://localhost/BRACHMASTRA/` di browser.

## Lisensi

Proyek ini dibuat untuk keperluan edukasi dan pengembangan aplikasi konsultasi hukum online.

🛠️ Teknologi yang Digunakan

- PHP 8.x
- MySQL / MariaDB
- TailwindCSS
- Laragon / XAMPP

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