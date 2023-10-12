-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2023 at 07:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restbuku`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(8) NOT NULL,
  `id_penerbit` varchar(10) NOT NULL,
  `id_buku` varchar(10) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `penulis` varchar(128) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(5) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `id_penerbit`, `id_buku`, `judul`, `penulis`, `harga`, `stok`, `cover`, `created_at`, `updated_at`) VALUES
(1, 'NUMED', 'NUMED001', 'Asuhan Kebidanan Maternitas', 'Erling Halland', 45000.00, -1, 'default.jpg', NULL, '2023-10-09 13:29:19'),
(2, 'PARAD', 'PARAD001', 'Hukum Pidana dan Hukum Perdata', 'Mason Greenwood', 76000.00, 7, 'default.jpg', NULL, NULL),
(3, 'PARAD', 'PARAD002', 'Korupsi Desa', 'Mason Mount', 90000.00, 8, 'default.jpg', '2023-10-09 11:54:52', '2023-10-09 13:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `id` int(8) NOT NULL,
  `id_penjualan` varchar(10) NOT NULL,
  `id_buku` varchar(10) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`id`, `id_penjualan`, `id_buku`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 'CUST00001', 'NUMED001', 2, 90000.00, '2023-10-09 13:29:19', '2023-10-09 13:29:19'),
(2, 'CUST00001', 'PARAD002', 1, 90000.00, '2023-10-09 13:29:19', '2023-10-09 13:29:19'),
(3, 'CUST00002', 'PARAD002', 2, 180000.00, '2023-10-09 13:37:51', '2023-10-09 13:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-09-08-032518', 'App\\Database\\Migrations\\Penerbit', 'default', 'App', 1696824069, 1),
(2, '2023-09-10-001411', 'App\\Database\\Migrations\\Buku', 'default', 'App', 1696824069, 1),
(3, '2023-09-12-063555', 'App\\Database\\Migrations\\Penjualan', 'default', 'App', 1696824069, 1),
(4, '2023-09-12-064516', 'App\\Database\\Migrations\\DetailPenjualan', 'default', 'App', 1696824069, 1),
(5, '2023-09-12-181640', 'App\\Database\\Migrations\\Tempdetailpenjualan', 'default', 'App', 1696824069, 1),
(6, '2023-09-13-045152', 'App\\Database\\Migrations\\Users', 'default', 'App', 1696824069, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id` int(5) NOT NULL,
  `id_penerbit` varchar(10) NOT NULL,
  `nama_penerbit` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `prov` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kec` varchar(50) DEFAULT NULL,
  `kel` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(6) DEFAULT NULL,
  `alamat` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id`, `id_penerbit`, `nama_penerbit`, `no_hp`, `prov`, `kota`, `kec`, `kel`, `kode_pos`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'NUMED', 'Nuha Medika', '08111222333', 'Daerah Istimewa Yogyakarta', 'Yogyakarta', 'Mergangsan', 'Wirogunan', '55151', 'Mergangsan Yogyakarta', '2023-10-09 11:02:17', '2023-10-09 11:02:17'),
(2, 'PARAD', 'Paradigma Yogyakarta', '08222333444', 'Daerah Istimewa Yogyakarta', 'Yogyakarta', 'Mergangsan', 'Wirogunan', '55151', 'Mergangsan Yogyakarta', '2023-10-09 11:02:17', '2023-10-09 11:02:17'),
(3, 'THAFA', 'Thafa Media', '088111222333', 'Daerah Istimewa Yogyakarta', 'Sleman', NULL, '44444', NULL, 'alamat lengkap', '2023-10-09 11:27:49', '2023-10-09 11:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(8) NOT NULL,
  `id_penjualan` varchar(10) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_penjualan`, `total`, `created_at`, `updated_at`) VALUES
(4, 'CUST00001', 180000.00, '2023-10-09 13:29:19', '2023-10-09 13:29:19'),
(5, 'CUST00002', 180000.00, '2023-10-09 13:37:51', '2023-10-09 13:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `tempdetailpenjualan`
--

CREATE TABLE `tempdetailpenjualan` (
  `id` int(8) NOT NULL,
  `id_penjualan` varchar(10) NOT NULL,
  `id_buku` varchar(10) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_buku` (`id_buku`),
  ADD KEY `buku_id_penerbit_foreign` (`id_penerbit`);

--
-- Indexes for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detailpenjualan_id_buku_foreign` (`id_buku`),
  ADD KEY `detailpenjualan_id_penjualan_foreign` (`id_penjualan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_penerbit` (`id_penerbit`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `tempdetailpenjualan`
--
ALTER TABLE `tempdetailpenjualan`
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
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tempdetailpenjualan`
--
ALTER TABLE `tempdetailpenjualan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_id_penerbit_foreign` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`);

--
-- Constraints for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD CONSTRAINT `detailpenjualan_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `detailpenjualan_id_penjualan_foreign` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
