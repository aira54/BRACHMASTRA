-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2025 at 04:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brachmastra`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `kategori`, `tanggal`) VALUES
(1, 'Kasus Korupsi Besar di Jakarta', 'KPK berhasil mengungkap kasus korupsi besar yang melibatkan pejabat tinggi...', '../uploads/\r\nScreenshot 2025-05-24 082147.png', 'pidana', '2025-08-13 10:30:42'),
(6, 'Brachmastra mendampingi siswa yang terlibat tawuran ', 'Jakarta, 13 Agustus 2025 — Tawuran antar pelajar kembali pecah di kawasan depan Terminal Kota pada Rabu (13/8) siang. Bentrokan melibatkan dua kelompok pelajar dari sekolah berbeda, yakni SMK X dan SMA Y, yang saling menyerang menggunakan senjata tajam dan benda tumpul.\r\n\r\nMenurut keterangan warga, tawuran terjadi sekitar pukul 13.30 WIB, tak lama setelah jam pulang sekolah. “Awalnya cuma saling ejek, tapi lama-lama mereka bawa celurit dan tongkat kayu,” ujar Ahmad, seorang pedagang di sekitar lokasi.\r\n\r\nPetugas kepolisian yang tiba di tempat kejadian berusaha membubarkan massa dengan tembakan peringatan ke udara. Akibat bentrokan tersebut, tiga pelajar mengalami luka di bagian tangan dan kepala, sementara beberapa lainnya berhasil melarikan diri.\r\n\r\nKapolsek setempat, AKP Budi Santosa, mengonfirmasi bahwa pihaknya telah mengamankan lima pelajar yang diduga terlibat. “Kami akan memanggil pihak sekolah dan orang tua untuk pembinaan. Tawuran seperti ini tidak hanya membahayakan diri sendiri, tetapi juga mengganggu ketertiban umum,” tegasnya.\r\n\r\nSaat ini, polisi masih melakukan patroli di sekitar terminal untuk mencegah bentrokan susulan. Pihak sekolah pun diimbau memperketat pengawasan terhadap siswanya, terutama pada jam pulang sekolah.', '1755059569_Screenshot 2025-07-31 225358.png', 'pidana', '2025-08-13 00:00:00'),
(7, 'LBH Brachmastra Dampingi Korban Pelecehan', 'Jakarta – 14 Agustus 2025\r\nLembaga Bantuan Hukum (LBH) Brachmastra menyatakan komitmennya untuk memberikan pendampingan hukum kepada seorang perempuan yang menjadi korban pelecehan seksual di wilayah Jakarta Timur.\r\n\r\nKasus tersebut terungkap setelah korban melapor kepada pihak kepolisian dan menghubungi LBH Brachmastra untuk mendapatkan bantuan. Menurut keterangan pihak LBH, korban mengalami pelecehan oleh rekan kerjanya di sebuah perusahaan swasta pada akhir Juli lalu.\r\n\r\n\"Kami memastikan korban mendapatkan perlindungan hukum, bantuan psikologis, dan akses terhadap proses hukum yang adil,\" ujar Direktur LBH Brachmastra, Raka Pranata, kepada wartawan, Rabu (14/8).\r\n\r\nLBH Brachmastra juga menekankan pentingnya dukungan dari masyarakat untuk menghapus stigma terhadap korban pelecehan. “Korban tidak boleh disalahkan. Tanggung jawab ada pada pelaku, dan hukum harus ditegakkan,” tambah Raka.\r\n\r\nSaat ini, pihak kepolisian telah memeriksa sejumlah saksi dan mengamankan barang bukti untuk memperkuat proses penyidikan. LBH Brachmastra berjanji akan terus mengawal kasus ini hingga tuntas dan memastikan hak-hak korban terpenuhi.', '1755141531_Screenshot 2025-07-31 225351.png', 'pidana', '2025-08-14 00:00:00'),
(8, 'LBH Brachmastra Dampingi Siswa Korban Bullying', 'Jakarta – 20 Agustus 2025\r\nLembaga Bantuan Hukum (LBH) Brachmastra memberikan pendampingan hukum kepada seorang siswa yang menjadi korban bullying di salah satu sekolah menengah di Jakarta Selatan.\r\n\r\nKasus ini muncul setelah siswa yang bersangkutan mengalami intimidasi dan perundungan secara fisik maupun verbal oleh beberapa rekannya selama beberapa bulan terakhir. Orang tua korban kemudian menghubungi LBH Brachmastra untuk mendapatkan bantuan hukum dan perlindungan.\r\n\r\n\"Kami hadir untuk memastikan hak-hak korban terpenuhi, memberikan pendampingan hukum, dan membantu pihak sekolah menegakkan aturan anti-bullying,\" ujar Direktur LBH Brachmastra, Raka Pranata, kepada wartawan, Selasa (20/8).\r\n\r\nLBH Brachmastra juga menekankan pentingnya dukungan dari lingkungan sekolah dan masyarakat untuk mencegah bullying. “Sekolah harus menjadi tempat yang aman bagi anak-anak. Korban tidak boleh disalahkan, dan pelaku harus bertanggung jawab,” tambah Raka.\r\n\r\nSaat ini, LBH Brachmastra bersama pihak sekolah dan kepolisian sedang memproses laporan untuk memastikan kasus ini ditangani secara serius dan memberikan efek jera bagi pelaku.', '1755653294_Screenshot 2025-07-31 225358.png', 'pidana', '2025-08-20 00:00:00'),
(9, 'LBH Brachmastra Dampingi Warga dalam Kasus Perdata', 'Jakarta – 20 Agustus 2025\r\nLembaga Bantuan Hukum (LBH) Brachmastra kembali menunjukkan komitmennya dengan memberikan pendampingan hukum kepada seorang warga Jakarta Barat yang tengah menghadapi kasus perdata.\r\n\r\nKasus ini bermula dari perselisihan terkait sengketa tanah antara korban dengan pihak lain yang mengklaim kepemilikan lahan tersebut. Persoalan semakin rumit setelah adanya dugaan pemalsuan dokumen kepemilikan.\r\n\r\n\"Kami hadir untuk memastikan hak-hak klien kami terlindungi sesuai hukum yang berlaku, serta mengawal proses persidangan agar berjalan adil dan transparan,\" ujar Direktur LBH Brachmastra, Raka Pranata, Rabu (20/8).\r\n\r\nLBH Brachmastra menegaskan bahwa banyak masyarakat yang masih kurang memahami prosedur hukum perdata, seperti sengketa tanah, warisan, atau perjanjian. Hal ini sering dimanfaatkan pihak-pihak yang tidak bertanggung jawab.\r\n\r\n“Kami ingin mengingatkan bahwa kasus perdata bukan hanya soal sengketa harta, tapi juga menyangkut keadilan dan kepastian hukum bagi masyarakat,” tambah Raka.\r\n\r\nSaat ini, perkara tengah dalam tahap mediasi di pengadilan. LBH Brachmastra menyatakan akan terus mengawal proses tersebut hingga ada putusan yang berkekuatan hukum tetap.', '1755663464_Screenshot 2025-07-31 225351.png', 'perdata', '2025-08-20 00:00:00'),
(11, 'Kasus Sengketa Hak Asuh Anak, LBH Brachmastra Dampingi Ibu Muda di Surabaya', 'Surabaya, 5 September 2025 – Lembaga Bantuan Hukum (LBH) Brachmastra kembali memberikan pendampingan hukum dalam perkara keluarga. Kali ini, seorang ibu muda berinisial AN (28 tahun) menggugat mantan suaminya terkait hak asuh anak yang masih berusia 6 tahun.\r\n\r\nKasus ini bermula setelah perceraian keduanya disahkan oleh Pengadilan Agama Surabaya pada awal Juli 2025. Dalam putusan perceraian tersebut, hak asuh anak belum diputuskan secara jelas, sehingga menimbulkan perselisihan antara kedua belah pihak.\r\n\r\nMenurut Kuasa Hukum AN dari LBH Brachmastra, Advokat R. Santoso, S.H., hak asuh anak seharusnya berada pada pihak ibu selama anak masih di bawah umur, kecuali ada bukti kuat bahwa ibu tidak mampu memberikan pengasuhan yang layak.', '1757006482_Screenshot 2025-08-31 221834.png', 'keluarga', '2025-09-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `klik_laporan`
--

CREATE TABLE `klik_laporan` (
  `id` int NOT NULL,
  `user_nama` varchar(255) NOT NULL,
  `jenis_konsultasi` varchar(50) NOT NULL,
  `pengacara_id` int NOT NULL,
  `klik_via` enum('whatsapp','email') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pengacara_nama` varchar(255) NOT NULL,
  `pengacara_spesialis` varchar(255) NOT NULL,
  `pertanyaan` text NOT NULL,
  `metode_bayar` varchar(50) DEFAULT NULL,
  `harga` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `klik_laporan`
--

INSERT INTO `klik_laporan` (`id`, `user_nama`, `jenis_konsultasi`, `pengacara_id`, `klik_via`, `created_at`, `pengacara_nama`, `pengacara_spesialis`, `pertanyaan`, `metode_bayar`, `harga`) VALUES
(3, 'Administrator', 'gratis', 3, 'whatsapp', '2025-09-06 10:26:41', 'Rizky Pratama, SH', 'Hukum Bisnis', 'Halo, saya Administrator dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nNegosiasi Bisnis\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', NULL, NULL),
(5, 'Administrator', 'berbayar', 1, 'whatsapp', '2025-09-06 10:57:39', 'Ari Wibowo, SH', 'Hukum Pidana', 'Halo, saya Administrator dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nasdfg\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', 'Transfer Bank', 0),
(6, 'Administrator', 'berbayar', 23, 'whatsapp', '2025-09-06 11:00:48', 'Nadia Anatasya', 'hukum keluarga', 'Halo, saya Administrator dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nsdfgh\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', 'E-Wallet', 100000),
(7, 'Administrator', 'berbayar', 1, 'whatsapp', '2025-09-06 16:25:10', 'Ari Wibowo, SH', 'Hukum Pidana', 'Halo, saya Administrator dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nPemukulan siswa\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', 'Kartu Kredit', 0),
(8, 'Administrator', 'berbayar', 22, 'whatsapp', '2025-09-06 17:23:38', 'bara', 'Hukum Bisnis', 'Halo, saya Administrator dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nNegosiasi Antar Industri\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', 'Transfer Bank', 300000),
(9, 'Administrator', 'berbayar', 23, 'whatsapp', '2025-09-08 02:29:52', 'Nadia Anatasya', 'hukum keluarga', 'Halo, saya Administrator dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nKDRT\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', 'Transfer Bank', 100000),
(10, 'Administrator', 'berbayar', 13, 'whatsapp', '2025-09-09 03:23:16', 'moch sa\'ad', 'hukum bisnis', 'Halo, saya Administrator dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\ndfgh\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', 'Transfer Bank', 400000),
(11, 'Administrator', 'gratis', 3, 'whatsapp', '2025-09-09 03:25:43', 'Rizky Pratama, SH', 'Hukum Bisnis', 'Halo, saya Administrator dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\n123456\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', '', 0),
(12, 'Administrator', 'gratis', 3, 'whatsapp', '2025-09-09 03:27:11', 'Rizky Pratama, SH', 'Hukum Bisnis', 'Halo, saya Administrator dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nertyui\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', '', 0),
(14, 'Administrator', 'berbayar', 24, 'whatsapp', '2025-09-11 03:39:01', 'Fahri dwi ', 'hukum pidana', 'Halo, saya Administrator dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nPemukulan siswa\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', 'E-Wallet', 150000),
(15, 'Dafa', 'berbayar', 24, 'whatsapp', '2025-09-11 04:39:19', 'Fahri dwi ', 'hukum pidana', 'Halo, saya Dafa dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nPemukulan siswa\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', 'E-Wallet', 150000),
(16, 'Ridho Dana', 'berbayar', 24, 'whatsapp', '2025-09-16 03:01:56', 'Fahri dwi ', 'hukum pidana', 'Halo, saya Ridho Dana dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nPerundungan\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', 'Transfer Bank', 150000),
(17, 'Ridho Dana', 'gratis', 5, 'whatsapp', '2025-09-18 02:55:45', 'Dewi Lestari, SH, MH', 'Hukum Keluarga', 'Halo, saya Ridho Dana dari web Brachmastra.\r\n\r\nSaya ingin berkonsultasi mengenai:\r\nyyy\r\n\r\nMohon arahan dari Bapak/Ibu Pengacara.\r\nTerima kasih.', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengacara`
--

CREATE TABLE `pengacara` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `foto` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `spesialis` varchar(100) DEFAULT NULL,
  `harga_konsultasi` int NOT NULL DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `deskripsi` text,
  `pendidikan` varchar(255) DEFAULT NULL,
  `tipe_konsultasi` enum('gratis','berbayar') NOT NULL DEFAULT 'gratis'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengacara`
--

INSERT INTO `pengacara` (`id`, `nama`, `foto`, `spesialis`, `harga_konsultasi`, `email`, `telepon`, `deskripsi`, `pendidikan`, `tipe_konsultasi`) VALUES
(1, 'Ari Wibowo, SH', 'uploads/1755050740_7362.png', 'Hukum Pidana', 0, '', '', 'Advokat berpengalaman dalam menangani perkara pidana, mulai dari tahap penyelidikan, penyidikan, persidangan, hingga upaya hukum luar biasa. Berkomitmen untuk memberikan pendampingan hukum yang adil dan profesional kepada klien, baik sebagai tersangka, terdakwa, maupun korban tindak pidana.', NULL, 'berbayar'),
(3, 'Rizky Pratama, SH', 'uploads/1757389702_292342011_1222759881874106_1284211973475095040_n.jpg', 'Hukum Bisnis', 0, 'bbar53905@gmail.com', '628998379922', '12 tahun di bidang kontrak, perusahaan, dan litigasi bisnis.', '', 'gratis'),
(5, 'Dewi Lestari, SH, MH', 'https://randomuser.me/api/portraits/women/44.jpg', 'Hukum Keluarga', 0, '', '', '8 tahun membantu penyelesaian sengketa keluarga & perceraian.', NULL, 'gratis'),
(6, 'Rizky Pratama, SH', 'uploads/1757470185_Screenshot 2025-05-24 082147.png', 'Hukum Bisnis', 0, '', '', '12 tahun di bidang kontrak, perusahaan, dan litigasi bisnis.', '', 'gratis'),
(14, 'Akbar Nuril S.H', 'uploads/1754454290_Screenshot 2025-07-14 113015.png', 'hukum pidana', 0, 'ainul@gmail.com', '6285733383387', 'pengalaman 3 tahun', NULL, 'gratis'),
(20, 'Moch edi', 'uploads/1754456784_Screenshot 2025-06-18 092337.png', 'hukum keluarga', 0, 'bar53905@mail.com', '9876543', '7 tahun menangani kasus', 'Sarjana Hukum (S.H.) – Universitas Airlangga  Magister Hukum (M.H.) – Universitas Indonesia', 'gratis'),
(21, 'M.chusnul chuluq. S.H', 'uploads/1757470077_Screenshot 2025-08-25 194432.png', 'hukum perdata', 0, 'ainul@gmail.com', '6281333556363', 'pengalaman 11 tahun', '', 'gratis'),
(22, 'bara', 'uploads/1757153552_Screenshot 2025-05-24 082147.png', 'Hukum Bisnis', 300000, 'ridho@mail.com', '6281333556363', 'Sudah 21 tahun menangani negosiasi bisnis', 'Sarjana Hukum (S.H.) – Universitas Airlangga  Magister Hukum (M.H.) – Universitas Indonesia', 'berbayar'),
(23, 'Nadia Anatasya', 'uploads/1757155490_WhatsApp Image 2025-07-16 at 20.54.31_086d3ae1.jpg', 'hukum keluarga', 100000, 'nadia@mail.com', '6281333556363', 'Pengalaman 11 tahun ', 'Sarjana Hukum (S.H.) – Universitas Airlangga  Magister Hukum (M.H.) – Universitas Indonesia', 'berbayar'),
(24, 'Fahri dwi ', 'uploads/1757389928_DSCF7349.JPG', 'hukum pidana', 150000, 'hafri@gmail.com', '628998379922', 'Pengacara hukum pidana berpengalaman dalam menangani perkara kriminal, mulai dari penyidikan hingga persidangan. Fokus pada pembelaan hak klien dengan strategi hukum yang tepat dan profesional.', 'Sarjana Hukum (S.H.) – Universitas Airlangga  Magister Hukum (M.H.) – Universitas Indonesia', 'berbayar');

-- --------------------------------------------------------

--
-- Table structure for table `toko_hukum`
--

CREATE TABLE `toko_hukum` (
  `id` int NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `kategori` enum('pidana','perdata','keluarga','bisnis') NOT NULL,
  `sub_kategori` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `toko_hukum`
--

INSERT INTO `toko_hukum` (`id`, `nama_produk`, `deskripsi`, `harga`, `kategori`, `sub_kategori`, `lokasi`, `gambar`, `tanggal`) VALUES
(2, 'Penyusunan Perjanjian Bisnis', 'Pembuatan perjanjian usaha sesuai hukum yang berlaku di Indonesia.', 1200000.00, 'bisnis', 'diskusi', 'Jakarta', '1757565166_Screenshot 2025-08-29 231434.png', '2025-08-14 03:46:26'),
(3, 'Mediasi Sengketa Warisan', 'Layanan mediasi keluarga untuk pembagian harta waris.', 800000.00, 'keluarga', 'sengketa', 'Jakarta', '1756307626_Screenshot 2025-05-24 082147.png', '2025-08-14 03:46:26'),
(4, 'Gugatan Perdata', 'Pendampingan hukum untuk kasus perdata seperti wanprestasi, ganti rugi.', 1500000.00, 'perdata', 'diskusi', 'Jakarta', '1755752833_Screenshot 2025-07-31 225358.png', '2025-08-14 03:46:26'),
(5, 'Pembuatan Kontrak Kerjasama', 'Penyusunan kontrak kerjasama usaha yang sah secara hukum.', 1000000.00, 'bisnis', 'diskusi', 'Jakarta', '1757565141_Screenshot 2025-09-10 091848.png', '2025-08-14 03:46:26'),
(7, 'Pendampingan Sidang Pidana', 'Pendampingan oleh pengacara selama proses persidangan kasus pidana.', 1500000.00, 'pidana', 'Pidana umum', 'Surabaya', 'Screenshot 2025-05-24 082147.png', '2025-08-14 04:02:23'),
(11, 'Pendampingan Sidang Perdata', 'Sidang perdata tidak hanya soal menang atau kalah, tapi juga soal bagaimana hak-hak masyarakat bisa dipertahankan secara sah di hadapan hukum', 3000000.00, 'perdata', 'Sidang', 'Jakarta', '1755752806_Screenshot 2025-05-24 082147.png', '2025-08-21 05:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `toko_laporan`
--

CREATE TABLE `toko_laporan` (
  `id` int NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `produk_id` int NOT NULL,
  `produk_nama` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `pertanyaan` text NOT NULL,
  `klik_via` enum('whatsapp','email') DEFAULT 'whatsapp',
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `toko_laporan`
--

INSERT INTO `toko_laporan` (`id`, `user_nama`, `user_email`, `produk_id`, `produk_nama`, `kategori`, `harga`, `pertanyaan`, `klik_via`, `tanggal`) VALUES
(1, 'Ridho', 'ridho@mail.com', 7, 'Pendampingan Sidang Pidana', 'pidana', 'Rp 1.500.000', 'saya mau menggunakan layanan', 'whatsapp', '2025-09-04 16:22:02'),
(3, 'chusnul chuluq. S.H', 'admin@brachmastra.com', 4, 'Gugatan Perdata', 'perdata', 'Rp 1.500.000', 'dfghjk', 'whatsapp', '2025-09-05 10:15:53'),
(4, 'Akbar Nuril', 'bbar53905@gmail.com', 10, 'Pembuatan Laporan Polisi', 'pidana', 'Rp 300.000', 'tilang', 'whatsapp', '2025-09-05 15:18:15'),
(5, 'bara', 'bbar53905@gmail.com', 7, 'Pendampingan Sidang Pidana', 'pidana', 'Rp 1.500.000', 'Pendampingan', 'whatsapp', '2025-09-09 04:06:18'),
(6, 'bara', 'admin@brachmastra.com', 7, 'Pendampingan Sidang Pidana', 'pidana', 'Rp 1.500.000', 'Pendampingan Dikantor Polisi', 'whatsapp', '2025-09-09 04:08:42'),
(7, 'Akbar Nuril S.H', 'zaky@mail.com', 7, 'Pendampingan Sidang Pidana', 'pidana', 'Rp 1.500.000', 'Pendmpingan sidang', 'whatsapp', '2025-09-09 04:09:47'),
(8, 'moch sa\'ad', 'ridho@mail.com', 7, 'Pendampingan Sidang Pidana', 'pidana', 'Rp 1.500.000', 'Pendampingan sidang', 'whatsapp', '2025-09-09 04:10:40'),
(9, 'ainul bara', 'admin@brachmastra.com', 7, 'Pendampingan Sidang Pidana', 'pidana', 'Rp 1.500.000', 'Pelanggaran lantas', 'whatsapp', '2025-09-10 02:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(8, 'Raka Danasatya', 'raka@mail.com', '$2y$10$u/YaOtcm/7GZxFxXUIo2muZflGDzWFhM6r1HAVqj.ItbEbUzl7W4i', 'user'),
(12, 'Administrator', 'admin@brachmastra.com', '$2y$10$ej5H28LseS1QusMSj8q/legqPozYwLUoY42AGKbo2i8rzl8JgFYPG', 'admin'),
(15, 'Arif Panjalu', 'panjaloe@mail.com', '$2y$10$q2J92Fj1gE/ITXCpceJSX.2PXAJSkc8RfRrUl6nS1meB.Ezi7zC6i', 'user'),
(16, 'Hijri Nur Eka', 'eka@mail.com', '$2y$10$Ly0dxUd3fDelPIaljKwNEurFJYdRmRPP3ta6GmAsGDPIqLKrSekQ2', 'user'),
(17, 'Zaky Ridho', 'zaky@mail.com', '$2y$10$8QtYq7nNkfrjuQh7DdNa4..JkpOFrZqlm9oZqWhuMT2e97NxWCiHW', 'user'),
(19, 'Zaky Ridho Dana', 'dana@mail.com', '$2y$10$28R.jg7JA9cor58qrzno8.cZe4ETLmhGZT9we1pwc5BmHj8KTW2Te', 'user'),
(20, 'Ridho Dana', 'ridho@mail.com', '$2y$10$EU0U6K8dWc/Rc/LgjiT.tO0bzU7ERKNzPem5G9NnKt4uwXdf.X/iq', 'user'),
(21, 'Dimas Adi Nugroho', 'nugroho@mail.com', '$2y$10$TS1H4DTccnJGI70g4qf4k.eDq92BahQsTkefiJLcZGm.ZqQuNvODS', 'user'),
(23, 'Dimas Adi Nugroho', 'roho@mail.com', '$2y$10$sZKY1snu2CA5uAZp7OPkP.vrBLSLI31scLSMW9CSyGYKxO6rDNn3a', 'user'),
(26, 'Dafa', 'Dafa@mail.com', '$2y$10$JI6CPGD4TmsG.QCJIcuo9uNowGEC6EBrB315PJ59/rB0mJrcvi1FC', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klik_laporan`
--
ALTER TABLE `klik_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengacara`
--
ALTER TABLE `pengacara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toko_hukum`
--
ALTER TABLE `toko_hukum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toko_laporan`
--
ALTER TABLE `toko_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `klik_laporan`
--
ALTER TABLE `klik_laporan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pengacara`
--
ALTER TABLE `pengacara`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `toko_hukum`
--
ALTER TABLE `toko_hukum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `toko_laporan`
--
ALTER TABLE `toko_laporan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
