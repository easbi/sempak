-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2019 pada 08.01
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `percobaan_simpak`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_rincian_angka_kredit`
--

CREATE TABLE `master_rincian_angka_kredit` (
  `id_rinci_ak` int(11) NOT NULL,
  `id_unsur_utama` int(11) NOT NULL,
  `id_subunsur` int(11) NOT NULL,
  `id_rincian_kegiatan` int(11) NOT NULL,
  `id_tingkatan_wi` int(11) NOT NULL,
  `angka_kredit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_rincian_kegiatan`
--

CREATE TABLE `master_rincian_kegiatan` (
  `id_unsur_utama` int(11) NOT NULL,
  `id_subunsur` int(11) NOT NULL,
  `id_rincian_kegiatan` int(11) NOT NULL,
  `rincian_kegiatan` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_rincian_kegiatan`
--

INSERT INTO `master_rincian_kegiatan` (`id_unsur_utama`, `id_subunsur`, `id_rincian_kegiatan`, `rincian_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Mengikuti pendidikan formal/sekolah dan memperoleh ijazah/gelar Doktor (S-3)', '2019-12-10 04:19:23', '2019-12-09 21:18:02'),
(1, 1, 2, 'Mengikuti pendidikan formal/sekolah dan memperoleh ijazah/gelar Magister (S-2)', '2019-12-09 21:19:10', '2019-12-09 21:19:10'),
(1, 2, 3, 'Mengikuti Diklat fungsional/teknis yang mendukung tugas Widyaiswara dan memperoleh Surat Tanda Tamat Pendidikan dan Pelatihan (STTPP)/sertifikat (minimal 10 JP)', '2019-12-09 21:20:26', '2019-12-09 21:20:26'),
(2, 3, 4, 'Menyusun Bahan Diklat dalam bentuk : Bahan ajar', '2019-12-09 21:21:07', '2019-12-09 21:21:07'),
(2, 3, 5, 'Menyusun Bahan Diklat dalam bentuk : Bahan tayang', '2019-12-09 21:21:17', '2019-12-09 21:21:17'),
(2, 3, 6, 'Menyusun Bahan Diklat dalam bentuk : Bahan peraga', '2019-12-09 21:21:29', '2019-12-09 21:21:29'),
(2, 3, 7, 'Menyusun Bahan Diklat dalam bentuk : GBPP/RBPMD dan SAP/RP', '2019-12-09 21:21:51', '2019-12-09 21:21:51'),
(2, 3, 8, 'Menyusun soal/materi ujian Diklat untuk : Pre test - Post test', '2019-12-09 21:29:22', '2019-12-09 21:29:22'),
(2, 3, 9, 'Menyusun soal/materi ujian Diklat untuk : Komprehensif test', '2019-12-09 21:29:57', '2019-12-09 21:29:57'),
(2, 3, 10, 'Menyusun soal/materi ujian Diklat untuk : Kasus', '2019-12-09 21:30:04', '2019-12-09 21:30:04'),
(2, 4, 11, 'Melaksanakan tatap muka Diklat (PNS)', '2019-12-09 21:30:31', '2019-12-09 21:30:31'),
(2, 4, 12, 'Melaksanakan tatap muka Diklat (Non PNS)', '2019-12-09 21:30:50', '2019-12-09 21:30:50'),
(2, 4, 13, 'Melaksanakan Pembimbingan', '2019-12-09 21:31:40', '2019-12-09 21:31:40'),
(2, 4, 14, 'Melaksanakan pendampingan OL / PKL / Benchmarking', '2019-12-09 21:32:04', '2019-12-09 21:32:04'),
(2, 4, 15, 'Melaksanakan pendampingan Penulisan Kertas Kerja / Proyek Perubahan', '2019-12-09 21:32:29', '2019-12-09 21:32:29'),
(2, 4, 16, 'Memeriksa Hasil Ujian Diklat untuk : Pre test - Post test', '2019-12-09 21:33:00', '2019-12-09 21:33:00'),
(2, 4, 17, 'Memeriksa Hasil Ujian Diklat untuk : Komprehensif test', '2019-12-09 21:33:14', '2019-12-09 21:33:14'),
(2, 4, 18, 'Memeriksa Hasil Ujian Diklat untuk : Kasus', '2019-12-09 21:33:23', '2019-12-09 21:33:23'),
(2, 4, 19, 'Melakukan coaching pada proses penyelenggaraan Diklat', '2019-12-09 21:33:55', '2019-12-09 21:33:55'),
(3, 5, 20, 'Terlibat dalam mengevaluasi penyelenggaraan Diklat di instansinya', '2019-12-09 21:34:27', '2019-12-09 21:34:27'),
(3, 5, 21, 'Terlibat dalam pengevaluasian kinerja Widyaiswara', '2019-12-09 21:34:50', '2019-12-09 21:34:50'),
(3, 6, 22, 'Terlibat dalam pelaksanaan Analisis Kebutuhan Diklat (AKD)', '2019-12-09 21:37:40', '2019-12-09 21:37:40'),
(3, 6, 23, 'Terlibat dalam penyusunan Kurikulum Diklat', '2019-12-09 21:37:51', '2019-12-09 21:37:51'),
(3, 6, 24, 'Terlibat dalam penyusunan Modul Diklat', '2019-12-09 21:38:04', '2019-12-09 21:38:04'),
(4, 7, 25, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Buku dengan ISBN diterbitkan secara nasional', '2019-12-09 21:39:45', '2019-12-09 21:39:45'),
(4, 7, 26, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Non Buku, yang dimuat dalam Jurnal Ilmiah Internasional', '2019-12-09 21:40:56', '2019-12-09 21:40:56'),
(4, 7, 27, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Non Buku, yang dimuat dalam Jurnal Ilmiah Nasional terakreditasi', '2019-12-09 21:41:14', '2019-12-09 21:41:14'),
(4, 7, 28, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Non Buku, yang dimuat dalam Jurnal Ilmiah Nasional tidak terakreditasi', '2019-12-09 21:41:39', '2019-12-09 21:41:39'),
(4, 7, 29, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Non Buku, yang dimuat dalam Majalah Ilmiah', '2019-12-09 21:42:28', '2019-12-09 21:42:28'),
(4, 7, 30, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Non Buku, yang dimuat dalam Buku Proceeding Internasional', '2019-12-09 21:49:14', '2019-12-09 21:49:14'),
(4, 7, 31, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Non Buku, yang dimuat dalam Buku Proceeding Nasional', '2019-12-09 21:52:35', '2019-12-09 21:52:35'),
(4, 7, 32, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Non Buku, yang dimuat dalam Buku Proceeding Instansi', '2019-12-09 21:52:50', '2019-12-09 21:52:50'),
(4, 7, 33, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Non Buku, yang dimuat dalam Makalah dalam pertemuan ilmiah Internasional', '2019-12-09 21:53:37', '2019-12-09 21:53:37'),
(4, 7, 34, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Non Buku, yang dimuat dalam Makalah dalam pertemuan ilmiah Nasional', '2019-12-09 21:53:49', '2019-12-09 21:53:49'),
(4, 7, 35, 'Membuat Karya Tulis/karya Ilmiah dalam Bidang spesialisasi keahliannya dan lingkup kediklatan, dalam bentuk: Non Buku, yang dimuat dalam Makalah dalam pertemuan ilmiah Instansi', '2019-12-09 21:54:01', '2019-12-09 21:54:01'),
(4, 8, 36, 'Menemukan inovasi yang dipatenkan sesuai bidang spesialisasi dan telah masuk dalam daftar paten', '2019-12-09 21:54:53', '2019-12-09 21:54:53'),
(4, 9, 37, 'Menyusun buku pedoman / ketentuan pelaksanaan / ketentuan teknis di bidang kediklatan', '2019-12-09 21:55:27', '2019-12-09 21:55:27'),
(4, 10, 38, 'Melaksanakan Orasi Ilmiah sesuai spesialisasinya', '2019-12-09 21:55:49', '2019-12-09 21:55:49'),
(5, 11, 39, 'Mengikuti seminar / lokakarya / konferensi di bidang keDiklatan, sebagai Narasumber/pembahas/penyaji/ketua panitia', '2019-12-09 23:40:24', '2019-12-09 23:40:24'),
(5, 11, 40, 'Mengikuti seminar / lokakarya / konferensi di bidang keDiklatan, sebagai Moderator/peserta/anggota panitia', '2019-12-09 23:40:51', '2019-12-09 23:40:51'),
(5, 12, 41, 'Menjadi anggota organisasi profesi, sebagai Pengurus', '2019-12-09 23:41:29', '2019-12-09 23:41:29'),
(5, 12, 42, 'Menjadi anggota organisasi profesi, sebagai Anggota', '2019-12-09 23:41:38', '2019-12-09 23:41:38'),
(5, 13, 43, 'Membimbing Widyaiswara di bawah jenjang jabatannya', '2019-12-09 23:42:03', '2019-12-09 23:42:03'),
(5, 14, 44, 'Menulis artikel di Surat Kabar Nasional', '2019-12-09 23:42:25', '2019-12-09 23:42:25'),
(5, 14, 45, 'Menulis artikel di Surat Kabar Provinsi/Kabupaten/Kota', '2019-12-09 23:42:53', '2019-12-09 23:42:53'),
(5, 15, 46, 'Menulis artikel di Website', '2019-12-09 23:43:18', '2019-12-09 23:43:18'),
(5, 16, 47, 'Memperoleh gelar kesarjanaan lainnya yang tidak sesuai bidang spesialisasinya dan/atau ebih dari satu kali pada jenjang pendidikan yang sama pada program Doktor (S-3)', '2019-12-09 23:44:22', '2019-12-09 23:44:22'),
(5, 16, 48, 'Memperoleh gelar kesarjanaan lainnya yang tidak sesuai bidang spesialisasinya dan/atau ebih dari satu kali pada jenjang pendidikan yang sama pada program Magister (S-2)', '2019-12-09 23:44:41', '2019-12-09 23:44:41'),
(5, 16, 49, 'Memperoleh gelar kesarjanaan lainnya yang tidak sesuai bidang spesialisasinya dan/atau ebih dari satu kali pada jenjang pendidikan yang sama pada program Sarjana (S-1)', '2019-12-09 23:44:59', '2019-12-09 23:44:59'),
(5, 17, 50, 'Memperoleh penghargaan Satya Lencana Karya Satya, lamanya 30 (tiga puluh) tahun', '2019-12-09 23:45:50', '2019-12-09 23:45:50'),
(5, 17, 51, 'Memperoleh penghargaan Satya Lencana Karya Satya, lamanya 20 (dua puluh) tahun', '2019-12-09 23:46:04', '2019-12-09 23:46:04'),
(5, 17, 52, 'Memperoleh penghargaan Satya Lencana Karya Satya, lamanya 10 (sepuluh) tahun', '2019-12-09 23:46:17', '2019-12-09 23:46:17'),
(5, 17, 53, 'Memperoleh penghargaan lainnya dari pemerintah', '2019-12-09 23:46:38', '2019-12-09 23:46:38'),
(5, 17, 54, 'Memperoleh gelar kehormatan akademis', '2019-12-09 23:46:58', '2019-12-09 23:46:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_subunsurs`
--

CREATE TABLE `master_subunsurs` (
  `id_unsur` int(11) NOT NULL,
  `id_sub_unsur` bigint(20) UNSIGNED NOT NULL,
  `kegiatan_sub_unsur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_subunsurs`
--

INSERT INTO `master_subunsurs` (`id_unsur`, `id_sub_unsur`, `kegiatan_sub_unsur`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pendidikan formal/sekolah dan memperoleh ijazah/gelar', '2019-12-02 16:00:00', NULL),
(1, 2, 'Diklat fungsional/teknis yang mendukung tugas Widyaiswara dan memperoleh Surat Tanda Tamat Pendidikan dan Pelatihan (STTPP)/sertifikat', '2019-12-02 16:00:00', NULL),
(2, 3, 'Persiapan', NULL, NULL),
(2, 4, 'Pelaksanaan', NULL, NULL),
(3, 5, 'Evaluasi Diklat', NULL, NULL),
(3, 6, 'Pengembangan Diklat', NULL, NULL),
(4, 7, 'Pembuatan Karya Tulis/karya Ilmiah dalam bidang spesialisasi dan keahliannya dan lingkup kediklatan', NULL, NULL),
(4, 8, 'Penemuan inovasi yang dipatenkan dan telah masuk daftar paten sesuai bidang spesialisasi keahliannya', NULL, NULL),
(4, 9, 'Penyusunan buku pedoman/ketentuan pelaksanaan/ketentuan teknsi di bidang kediklatan', NULL, NULL),
(4, 10, 'Pelaksanaan Orasi Ilmiah sesuai spesialisasinya', NULL, NULL),
(5, 11, 'Peran serta dalam seminar/lokakarya/konferensi di bidang keDiklatan', NULL, NULL),
(5, 12, 'Keanggotaan dalam organisasi profesi', NULL, NULL),
(5, 13, 'Pembimbingan kepada Widyaiswara di bawah jenjang jabatannya', NULL, NULL),
(5, 14, 'Penulisan artikel pada surat kabar', NULL, NULL),
(5, 15, 'Penulisan artikel pada website', NULL, NULL),
(5, 16, 'Perolehan gelar/ijazah kesarjanaan lainnya', NULL, NULL),
(5, 17, 'Perolehan penghargaan/tanda jasa', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_tingkatan_wi`
--

CREATE TABLE `master_tingkatan_wi` (
  `id_tingkatan_wi` int(11) NOT NULL,
  `nama_tingkatan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_tingkatan_wi`
--

INSERT INTO `master_tingkatan_wi` (`id_tingkatan_wi`, `nama_tingkatan`) VALUES
(1, 'Widyaiswara Ahli Pertama'),
(2, 'Widyaiswara Ahli Muda'),
(3, 'Widyaiswara Ahli Madya'),
(4, 'Widyaiswara Ahli Utama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_unsur_utama`
--

CREATE TABLE `master_unsur_utama` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unsur_utama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_unsur_utama`
--

INSERT INTO `master_unsur_utama` (`id`, `unsur_utama`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan', '2019-12-02 04:03:33', '2019-12-02 04:03:33'),
(2, 'Pelaksanaan Dikjartih PNS', '2019-12-02 04:04:37', '2019-12-02 04:04:37'),
(3, 'Evaluasi dan Pengembangan Diklat', '2019-12-02 04:05:47', '2019-12-02 04:05:47'),
(4, 'Pengembangan Profesi', '2019-12-02 04:06:06', '2019-12-02 04:06:06'),
(5, 'Penunjang Tugas Widyaiswara', '2019-12-02 04:06:30', '2019-12-02 04:06:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_02_104042_create_metadata_table', 1),
(2, '2019_12_03_075614_create_subunsurs_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_rinci_ak` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `angka_kredit_usul` int(11) NOT NULL,
  `id_penilai1` int(11) NOT NULL,
  `id_penilai2` int(11) NOT NULL,
  `angka_kredit1` int(11) NOT NULL,
  `angka_kredit2` int(11) NOT NULL,
  `status1` int(11) NOT NULL,
  `status2` int(11) NOT NULL,
  `ket_status1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_status2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `master_rincian_angka_kredit`
--
ALTER TABLE `master_rincian_angka_kredit`
  ADD PRIMARY KEY (`id_rinci_ak`);

--
-- Indeks untuk tabel `master_rincian_kegiatan`
--
ALTER TABLE `master_rincian_kegiatan`
  ADD PRIMARY KEY (`id_rincian_kegiatan`);

--
-- Indeks untuk tabel `master_subunsurs`
--
ALTER TABLE `master_subunsurs`
  ADD PRIMARY KEY (`id_sub_unsur`);

--
-- Indeks untuk tabel `master_tingkatan_wi`
--
ALTER TABLE `master_tingkatan_wi`
  ADD PRIMARY KEY (`id_tingkatan_wi`);

--
-- Indeks untuk tabel `master_unsur_utama`
--
ALTER TABLE `master_unsur_utama`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `master_rincian_kegiatan`
--
ALTER TABLE `master_rincian_kegiatan`
  MODIFY `id_rincian_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `master_subunsurs`
--
ALTER TABLE `master_subunsurs`
  MODIFY `id_sub_unsur` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `master_tingkatan_wi`
--
ALTER TABLE `master_tingkatan_wi`
  MODIFY `id_tingkatan_wi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `master_unsur_utama`
--
ALTER TABLE `master_unsur_utama`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
