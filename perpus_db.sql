-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2026 at 06:14 AM
-- Server version: 8.0.45-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_admin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username_admin` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password_admin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `akses_level` enum('1','2','3') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_delete_admin` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_admin`, `username_admin`, `password_admin`, `akses_level`, `is_delete_admin`, `created_at`, `updated_at`) VALUES
('ADM000', 'Developer', 'developer', '$2y$10$UFpKyVWB.ywHmVCUiMZbPOLpYFPACXdPlBP9n2CEpIpdldFlCg.5m', '1', '0', '2026-05-03 04:37:59', '2026-05-03 04:37:59'),
('ADM001', 'Supri', 'suprianto', '$2y$10$muRS3rBuj0Vek1kY2SD1uuj4Ewo9AHSmbcSPClg0J95Yfdk.HybUG', '3', '0', '2026-05-24 04:44:33', '2026-05-24 04:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `id_anggota` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_anggota` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_tlp` varchar(13) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password_anggota` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_delete_anggota` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`id_anggota`, `nama_anggota`, `jenis_kelamin`, `no_tlp`, `alamat`, `email`, `password_anggota`, `is_delete_anggota`, `created_at`, `updated_at`) VALUES
('AGT001', 'Al Hillal Akbar', 'L', '0895321018017', 'Kavling Pratama Jl. Tuna No 13 RT 010 RW 005', 'alhilalakbar@gmail.com', '$2y$10$vToAeOCLfFYE45.cpY501efsYH21hETk2obZk718evkKQwzZBsP6G', '0', '2026-05-24 05:41:19', '2026-05-24 05:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id_buku` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `judul_buku` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pengarang` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `penerbit` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tahun` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah_eksemplar` int NOT NULL,
  `id_kategori` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_rak` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cover_buku` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `e_book` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_delete_buku` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun`, `jumlah_eksemplar`, `id_kategori`, `keterangan`, `id_rak`, `cover_buku`, `e_book`, `is_delete_buku`, `created_at`, `updated_at`) VALUES
('BKU001', 'Web Programming', 'Ani Oktarini Sari, Ari Abdilah, Sunarti', 'Graha Ilmu', '2019', 106, 'KTG002', '', 'RAK001', 'Cover-Buku-260524052259.jpg', 'E-Book-260524052259.pdf', '0', '2026-05-24 05:22:59', '2026-05-24 05:22:59'),
('BKU002', 'Dilan: Dia Adalah Dilanku Tahun 1990', 'Pidi Baiq', 'PT Mizan Pustaka', '2014', 333, 'KTG001', '', 'RAK001', 'Cover-Buku-260524053137.jpg', 'E-Book-260524053137.pdf', '0', '2026-05-24 05:31:37', '2026-05-24 05:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_peminjaman`
--

CREATE TABLE `tbl_detail_peminjaman` (
  `no_peminjaman` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `id_buku` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `status_pinjam` enum('Sedang Dipinjam','Sudah Dikembalikan') COLLATE utf8mb4_general_ci NOT NULL,
  `perpanjangan` int NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_kategori` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_delete_kategori` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`, `is_delete_kategori`, `created_at`, `updated_at`) VALUES
('KTG001', 'Novel', '0', '2026-05-23 11:13:33', '2026-05-23 11:13:33'),
('KTG002', 'Textbook', '0', '2026-05-24 04:50:36', '2026-05-24 04:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peminjaman`
--

CREATE TABLE `tbl_peminjaman` (
  `no_peminjaman` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_anggota` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `total_pinjam` int NOT NULL,
  `id_admin` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `status_transaksi` enum('Selesai','Berjalan') COLLATE utf8mb4_general_ci NOT NULL,
  `status_ambil_buku` enum('Belum Diambil','Sudah Diambil') COLLATE utf8mb4_general_ci NOT NULL,
  `qr_code` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengembalian`
--

CREATE TABLE `tbl_pengembalian` (
  `no_pengembalian` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `no_peminjaman` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `id_buku` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `denda` double NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `id_admin` varchar(6) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rak`
--

CREATE TABLE `tbl_rak` (
  `id_rak` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_rak` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_delete_rak` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rak`
--

INSERT INTO `tbl_rak` (`id_rak`, `nama_rak`, `is_delete_rak`, `created_at`, `updated_at`) VALUES
('RAK001', 'Rak 1', '0', '2026-05-24 04:53:47', '2026-05-24 04:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp_peminjaman`
--

CREATE TABLE `tbl_temp_peminjaman` (
  `id_anggota` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_buku` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah_temp` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_temp_peminjaman`
--

INSERT INTO `tbl_temp_peminjaman` (`id_anggota`, `id_buku`, `jumlah_temp`) VALUES
('AGT001', 'BKU003', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_rak` (`id_rak`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  ADD PRIMARY KEY (`no_peminjaman`);

--
-- Indexes for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD PRIMARY KEY (`no_pengembalian`);

--
-- Indexes for table `tbl_rak`
--
ALTER TABLE `tbl_rak`
  ADD PRIMARY KEY (`id_rak`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
