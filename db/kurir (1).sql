-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2020 at 04:58 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kurir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barcodes`
--

CREATE TABLE `barcodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `barcode_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_service_staff` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `business_id`, `is_default`, `is_service_staff`, `created_at`, `updated_at`) VALUES
(1, 'Admin#1', 'web', 1, 1, 0, '2019-06-29 14:15:46', '2019-06-29 14:15:46'),
(2, 'Kurir', 'web', 1, 0, 1, '2019-06-29 14:15:47', '2019-08-19 14:43:12'),
(3, 'kepegawaian#1', 'web', 1, 0, 0, '2020-03-18 06:18:07', '2020-03-18 06:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `save_kurir`
--

CREATE TABLE `save_kurir` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `save_kurir_d`
--

CREATE TABLE `save_kurir_d` (
  `id` int(11) NOT NULL,
  `save_kurir_id` int(11) NOT NULL,
  `barcode_id` int(11) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `delivered_date` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat_tinggal` varchar(200) NOT NULL,
  `tanggal_mulai_tugas` date NOT NULL,
  `dtm_crt` datetime NOT NULL DEFAULT current_timestamp(),
  `dtm_upd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nama_pegawai`, `email`, `no_hp`, `alamat_tinggal`, `tanggal_mulai_tugas`, `dtm_crt`, `dtm_upd`) VALUES
(4, 'Irul', 'Irul', '0', 'Bjm', '2020-03-20', '2020-03-05 10:12:53', '2020-04-01 10:31:36'),
(6, 'tes', 'super.admin@gmail.com', '0', '-', '2020-03-05', '2020-03-05 11:05:11', '2020-03-05 04:06:17'),
(7, 'Ocan', 'Ocan', '0', 'Bjm', '2020-03-20', '2020-03-08 20:37:54', '2020-03-21 07:39:35'),
(8, 'Rere', 'rere@gmail.com', '', '', '0000-00-00', '2020-03-20 11:12:16', '2020-07-16 20:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `surname` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` char(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `contact_no` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_id` int(10) UNSIGNED DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive','terminated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `surname`, `username`, `email`, `password`, `language`, `contact_no`, `address`, `remember_token`, `business_id`, `location_id`, `status`, `role`, `id_pegawai`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 'admin', 'super.admin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'id', NULL, NULL, 'oSeoBxvZSXeIgIX8M3HyXMdJMmf9DNgX5uEcqxgTBQUl4Yfq8RhJxfjmpJwr', 1, NULL, 'active', 1, NULL, NULL, '2019-06-29 14:15:46', '2020-03-09 12:23:29'),
(2, 'Mrs', 'kurir', 'irul@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'en', NULL, NULL, 'W33br15dFFAAPHJgQCqim7rXbE1VvbGBbmLQwSpTFTYS8TgFy9PyLXMPuiyt', 1, 1, 'active', 2, 4, NULL, '2019-08-18 03:52:16', '2020-07-16 13:59:17'),
(15, NULL, 'rere', 'rere@gmail.com', 'bd134207f74532a8b094676c4a2ca9ed', 'en', NULL, NULL, NULL, NULL, NULL, 'active', 2, 8, NULL, NULL, '2020-07-16 13:38:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barcodes`
--
ALTER TABLE `barcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_business_id_foreign` (`business_id`);

--
-- Indexes for table `save_kurir`
--
ALTER TABLE `save_kurir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save_kurir_d`
--
ALTER TABLE `save_kurir_d`
  ADD PRIMARY KEY (`id`),
  ADD KEY `save_kurir_id` (`save_kurir_id`),
  ADD KEY `barcode_id` (`barcode_id`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_business_id_foreign` (`business_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barcodes`
--
ALTER TABLE `barcodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `save_kurir`
--
ALTER TABLE `save_kurir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `save_kurir_d`
--
ALTER TABLE `save_kurir_d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `save_kurir_d`
--
ALTER TABLE `save_kurir_d`
  ADD CONSTRAINT `save_kurir_d_ibfk_1` FOREIGN KEY (`save_kurir_id`) REFERENCES `save_kurir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `save_kurir_d_ibfk_2` FOREIGN KEY (`barcode_id`) REFERENCES `barcodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
