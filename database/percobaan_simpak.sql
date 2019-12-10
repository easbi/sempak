-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2019 pada 02.36
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
  `rincian_kegiatan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_rincian_kegiatan`
--

INSERT INTO `master_rincian_kegiatan` (`id_unsur_utama`, `id_subunsur`, `id_rincian_kegiatan`, `rincian_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Mengikuti pendidikan formal/sekolah dan memperoleh gelar/Ijazah Doktor (S-3)', '2019-12-03 15:18:46', '0000-00-00 00:00:00'),
(1, 1, 2, 'Mengikuti pendidikan formal/sekolah dan memperoleh gelar/Ijazah Doktor (S-2)', '2019-12-03 15:31:35', '0000-00-00 00:00:00'),
(1, 1, 3, 'Mengikuti Diklat fungsional/teknis yang mendukung tugas Widyaiswara dan memperoleh Surat Tanda Tamat Pendidikan dan Pelatahian (STTPP)/sertifikat (minimal 10 JP)', '2019-12-03 15:32:57', '0000-00-00 00:00:00');

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
  MODIFY `id_rincian_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
