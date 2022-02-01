-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 01, 2022 at 01:10 PM
-- Server version: 10.3.32-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1264016_notulen`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_kunjungan` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `file` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `id_pegawai`, `id_kunjungan`, `waktu`, `longitude`, `latitude`, `file`, `created_at`, `updated_at`) VALUES
(1, 57, 3, '2021-12-22 19:42:43', '113.7009312', '-8.1733118', '1640176963.jpeg', '2021-12-22 19:42:43', '2021-12-22 19:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_rapat`
--

CREATE TABLE `absensi_rapat` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_rapat` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `file` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi_rapat`
--

INSERT INTO `absensi_rapat` (`id`, `id_pegawai`, `id_rapat`, `waktu`, `longitude`, `latitude`, `file`, `created_at`, `updated_at`) VALUES
(1, 61, 5, '2021-06-30 18:03:00', '112.1711151', '-8.0990875', '1625050980.jpeg', '2021-06-30 18:03:00', '2021-06-30 18:03:00'),
(2, 62, 5, '2021-06-30 18:03:20', '112.17104769999999', '-8.0991349', '1625051000.jpeg', '2021-06-30 18:03:20', '2021-06-30 18:03:20'),
(3, 59, 5, '2021-06-30 18:03:31', '112.17104769999999', '-8.0991349', '1625051011.jpeg', '2021-06-30 18:03:31', '2021-06-30 18:03:31'),
(4, 57, 7, '2021-12-26 23:58:46', '112.1507957', '-8.1078141', '1640537926.jpeg', '2021-12-26 23:58:46', '2021-12-26 23:58:46'),
(5, 58, 7, '2021-12-26 23:58:55', '112.1507957', '-8.1078141', '1640537935.jpeg', '2021-12-26 23:58:55', '2021-12-26 23:58:55'),
(6, 59, 7, '2021-12-29 22:56:34', '112.1615872', '-8.1494016', '1640793394.jpeg', '2021-12-29 22:56:34', '2021-12-29 22:56:34'),
(7, 59, 7, '2021-12-29 23:05:51', '112.1615872', '-8.1494016', '1640793951.jpeg', '2021-12-29 23:05:51', '2021-12-29 23:05:51'),
(8, 60, 9, '2021-12-30 07:31:18', '112.1708205', '-8.0990043', '1640824278.jpeg', '2021-12-30 07:31:18', '2021-12-30 07:31:18'),
(9, 77, 9, '2021-12-30 07:31:36', '112.1708205', '-8.0990043', '1640824296.jpeg', '2021-12-30 07:31:36', '2021-12-30 07:31:36'),
(10, 63, 9, '2021-12-30 07:31:54', '112.1676238', '-8.0996272', '1640824314.jpeg', '2021-12-30 07:31:54', '2021-12-30 07:31:54'),
(11, 57, 10, '2022-01-27 20:25:18', '112.1644046', '-8.0909656', '1643289918.jpeg', '2022-01-27 20:25:18', '2022-01-27 20:25:18'),
(12, 59, 10, '2022-01-27 20:25:29', '112.1643979', '-8.0909508', '1643289929.jpeg', '2022-01-27 20:25:29', '2022-01-27 20:25:29'),
(13, 61, 10, '2022-01-27 20:26:02', '112.1643979', '-8.0909508', '1643289962.jpeg', '2022-01-27 20:26:02', '2022-01-27 20:26:02'),
(14, 77, 10, '2022-01-27 20:26:40', '112.1642962', '-8.091154', '1643290000.jpeg', '2022-01-27 20:26:40', '2022-01-27 20:26:40'),
(15, 60, 7, '2022-01-27 21:10:56', '112.1642107', '-8.0911312', '1643292656.jpeg', '2022-01-27 21:10:56', '2022-01-27 21:10:56'),
(16, 61, 7, '2022-01-27 21:11:05', '112.164274', '-8.091113', '1643292665.jpeg', '2022-01-27 21:11:05', '2022-01-27 21:11:05'),
(17, 62, 7, '2022-01-27 21:11:13', '112.164274', '-8.091113', '1643292673.jpeg', '2022-01-27 21:11:13', '2022-01-27 21:11:13'),
(18, 57, 15, '2022-01-31 15:38:41', '112.1508686', '-8.1078337', '1643618321.jpeg', '2022-01-31 15:38:41', '2022-01-31 15:38:41'),
(19, 58, 15, '2022-01-31 15:38:47', '112.1508668', '-8.1078359', '1643618327.jpeg', '2022-01-31 15:38:47', '2022-01-31 15:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_kunjungan`
--

CREATE TABLE `anggota_kunjungan` (
  `id` int(11) NOT NULL,
  `id_kunjungan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=absen, 1=hadir, 2=ijin',
  `keterangan` varchar(100) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `jabatan_kunjungan` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota_kunjungan`
--

INSERT INTO `anggota_kunjungan` (`id`, `id_kunjungan`, `id_pegawai`, `status`, `keterangan`, `jabatan`, `jabatan_kunjungan`, `created_at`, `updated_at`) VALUES
(1, 2, 57, 0, '', '', 3, '2021-12-22 19:15:57', '2021-12-22 19:15:57'),
(2, 2, 58, 0, '', '', 1, '2021-12-22 19:15:57', '2021-12-22 19:15:57'),
(3, 2, 59, 0, '', '', 2, '2021-12-22 19:15:57', '2021-12-22 19:15:57'),
(4, 2, 60, 0, '', '', 5, '2021-12-22 19:15:57', '2021-12-22 19:15:57'),
(5, 2, 61, 0, '', '', 5, '2021-12-22 19:15:57', '2021-12-22 19:15:57'),
(6, 2, 19, 0, '', '', 5, '2021-12-22 19:15:57', '2021-12-22 19:15:57'),
(7, 2, 21, 0, '', '', 5, '2021-12-22 19:15:57', '2021-12-22 19:15:57'),
(9, 3, 57, 0, '', '', 0, '2021-12-22 19:42:15', '2021-12-22 19:42:15'),
(10, 3, 1, 0, '', '', 0, '2021-12-22 19:42:15', '2021-12-22 19:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_rapat`
--

CREATE TABLE `anggota_rapat` (
  `id` int(11) NOT NULL,
  `id_rapat` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=absen, 1=hadir, 2=ijin',
  `keterangan` varchar(100) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `jabatan_rapat` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota_rapat`
--

INSERT INTO `anggota_rapat` (`id`, `id_rapat`, `id_pegawai`, `status`, `keterangan`, `jabatan`, `jabatan_rapat`, `created_at`, `updated_at`) VALUES
(1, 1, 60, 0, '', '', 0, '2021-06-22 19:06:28', '2021-06-22 19:06:28'),
(2, 1, 4, 0, '', '', 0, '2021-06-22 19:06:28', '2021-06-22 19:06:28'),
(4, 2, 59, 0, '', '', 0, '2021-06-26 23:24:40', '2021-06-26 23:24:40'),
(5, 2, 3, 0, '', '', 0, '2021-06-26 23:24:40', '2021-06-26 23:24:40'),
(7, 3, 59, 0, '', '', 0, '2021-06-30 17:57:34', '2021-06-30 17:57:34'),
(8, 3, 60, 0, '', '', 0, '2021-06-30 17:57:34', '2021-06-30 17:57:34'),
(9, 3, 2, 0, '', '', 0, '2021-06-30 17:57:34', '2021-06-30 17:57:34'),
(10, 3, 4, 0, '', '', 0, '2021-06-30 17:57:34', '2021-06-30 17:57:34'),
(12, 4, 57, 0, '', '', 0, '2021-06-30 18:00:32', '2021-06-30 18:00:32'),
(13, 4, 58, 0, '', '', 0, '2021-06-30 18:00:32', '2021-06-30 18:00:32'),
(14, 4, 59, 0, '', '', 0, '2021-06-30 18:00:32', '2021-06-30 18:00:32'),
(16, 5, 57, 0, '', '', 5, '2021-06-30 18:02:23', '2021-06-30 18:02:23'),
(17, 5, 59, 0, '', '', 5, '2021-06-30 18:02:23', '2021-06-30 18:02:23'),
(18, 5, 61, 0, '', '', 5, '2021-06-30 18:02:23', '2021-06-30 18:02:23'),
(19, 5, 62, 0, '', '', 1, '2021-06-30 18:02:23', '2021-06-30 18:02:23'),
(20, 5, 77, 0, '', '', 5, '2021-06-30 18:02:23', '2021-06-30 18:02:23'),
(21, 5, 1, 0, '', '', 5, '2021-06-30 18:02:23', '2021-06-30 18:02:23'),
(22, 5, 2, 0, '', '', 5, '2021-06-30 18:02:23', '2021-06-30 18:02:23'),
(23, 5, 3, 0, '', '', 5, '2021-06-30 18:02:23', '2021-06-30 18:02:23'),
(25, 6, 57, 0, '', '', 0, '2021-06-30 18:22:03', '2021-06-30 18:22:03'),
(26, 6, 58, 0, '', '', 0, '2021-06-30 18:22:03', '2021-06-30 18:22:03'),
(27, 6, 59, 0, '', '', 0, '2021-06-30 18:22:03', '2021-06-30 18:22:03'),
(28, 6, 60, 0, '', '', 0, '2021-06-30 18:22:03', '2021-06-30 18:22:03'),
(29, 6, 61, 0, '', '', 0, '2021-06-30 18:22:03', '2021-06-30 18:22:03'),
(30, 6, 62, 0, '', '', 0, '2021-06-30 18:22:03', '2021-06-30 18:22:03'),
(56, 7, 57, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(57, 7, 58, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(58, 7, 59, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(59, 7, 60, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(60, 7, 61, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(61, 7, 62, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(62, 7, 1, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(63, 7, 2, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(64, 7, 3, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(65, 7, 4, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(66, 7, 5, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(67, 7, 6, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(68, 7, 7, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(69, 7, 8, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(70, 7, 15, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(71, 7, 20, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(72, 7, 26, 0, '', '', 0, '2021-12-29 22:55:49', '2021-12-29 22:55:49'),
(74, 9, 60, 0, '', '', 0, '2021-12-30 07:30:46', '2021-12-30 07:30:46'),
(75, 9, 63, 0, '', '', 0, '2021-12-30 07:30:46', '2021-12-30 07:30:46'),
(76, 9, 65, 0, '', '', 0, '2021-12-30 07:30:46', '2021-12-30 07:30:46'),
(77, 9, 68, 0, '', '', 0, '2021-12-30 07:30:46', '2021-12-30 07:30:46'),
(78, 9, 72, 0, '', '', 0, '2021-12-30 07:30:46', '2021-12-30 07:30:46'),
(79, 9, 77, 0, '', '', 0, '2021-12-30 07:30:46', '2021-12-30 07:30:46'),
(80, 9, 78, 0, '', '', 0, '2021-12-30 07:30:46', '2021-12-30 07:30:46'),
(81, 9, 1, 0, '', '', 0, '2021-12-30 07:30:46', '2021-12-30 07:30:46'),
(82, 9, 90, 0, '', '', 4, '2021-12-30 07:30:46', '2021-12-30 07:30:46'),
(83, 8, 58, 0, '', '', 0, '2021-12-30 07:34:47', '2021-12-30 07:34:47'),
(84, 8, 59, 0, '', '', 0, '2021-12-30 07:34:47', '2021-12-30 07:34:47'),
(85, 8, 60, 0, '', '', 0, '2021-12-30 07:34:47', '2021-12-30 07:34:47'),
(86, 8, 61, 0, '', '', 0, '2021-12-30 07:34:47', '2021-12-30 07:34:47'),
(87, 8, 12, 0, '', '', 0, '2021-12-30 07:34:47', '2021-12-30 07:34:47'),
(100, 10, 57, 0, '', '', 0, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(101, 10, 59, 0, '', '', 0, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(102, 10, 61, 0, '', '', 0, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(103, 10, 77, 0, '', '', 0, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(104, 10, 24, 0, '', '', 0, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(105, 10, 25, 0, '', '', 0, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(106, 10, 27, 0, '', '', 0, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(107, 10, 28, 0, '', '', 0, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(108, 10, 35, 0, '', '', 0, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(109, 10, 41, 0, '', '', 0, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(110, 10, 94, 0, '', '', 4, '2022-01-27 20:50:47', '2022-01-27 20:50:47'),
(111, 11, 58, 0, '', '', 0, '2022-01-27 20:56:55', '2022-01-27 20:56:55'),
(112, 11, 60, 0, '', '', 0, '2022-01-27 20:56:55', '2022-01-27 20:56:55'),
(113, 11, 61, 0, '', '', 0, '2022-01-27 20:56:55', '2022-01-27 20:56:55'),
(114, 11, 2, 0, '', '', 0, '2022-01-27 20:56:55', '2022-01-27 20:56:55'),
(115, 11, 5, 0, '', '', 0, '2022-01-27 20:56:55', '2022-01-27 20:56:55'),
(116, 11, 94, 0, '', '', 4, '2022-01-27 20:56:55', '2022-01-27 20:56:55'),
(117, 12, 58, 0, '', '', 0, '2022-01-27 21:10:23', '2022-01-27 21:10:23'),
(118, 12, 60, 0, '', '', 0, '2022-01-27 21:10:23', '2022-01-27 21:10:23'),
(119, 12, 61, 0, '', '', 0, '2022-01-27 21:10:23', '2022-01-27 21:10:23'),
(120, 12, 62, 0, '', '', 0, '2022-01-27 21:10:23', '2022-01-27 21:10:23'),
(121, 12, 4, 0, '', '', 0, '2022-01-27 21:10:23', '2022-01-27 21:10:23'),
(122, 12, 26, 0, '', '', 0, '2022-01-27 21:10:23', '2022-01-27 21:10:23'),
(123, 12, 28, 0, '', '', 0, '2022-01-27 21:10:23', '2022-01-27 21:10:23'),
(124, 12, 94, 0, '', '', 4, '2022-01-27 21:10:23', '2022-01-27 21:10:23'),
(125, 13, 57, 0, '', '', 0, '2022-01-31 15:03:40', '2022-01-31 15:03:40'),
(126, 13, 59, 0, '', '', 0, '2022-01-31 15:03:40', '2022-01-31 15:03:40'),
(127, 13, 60, 0, '', '', 0, '2022-01-31 15:03:40', '2022-01-31 15:03:40'),
(128, 13, 40, 0, '', '', 0, '2022-01-31 15:03:40', '2022-01-31 15:03:40'),
(129, 13, 94, 0, '', '', 4, '2022-01-31 15:03:40', '2022-01-31 15:03:40'),
(130, 14, 57, 0, '', '', 0, '2022-01-31 15:14:57', '2022-01-31 15:14:57'),
(131, 14, 59, 0, '', '', 0, '2022-01-31 15:14:57', '2022-01-31 15:14:57'),
(132, 14, 61, 0, '', '', 0, '2022-01-31 15:14:57', '2022-01-31 15:14:57'),
(133, 14, 16, 0, '', '', 0, '2022-01-31 15:14:57', '2022-01-31 15:14:57'),
(134, 14, 40, 0, '', '', 0, '2022-01-31 15:14:57', '2022-01-31 15:14:57'),
(135, 14, 94, 0, '', '', 4, '2022-01-31 15:14:57', '2022-01-31 15:14:57'),
(136, 15, 57, 0, '', '', 0, '2022-01-31 15:34:57', '2022-01-31 15:34:57'),
(137, 15, 58, 0, '', '', 0, '2022-01-31 15:34:57', '2022-01-31 15:34:57'),
(138, 15, 1, 0, '', '', 0, '2022-01-31 15:34:57', '2022-01-31 15:34:57'),
(139, 15, 90, 0, '', '', 4, '2022-01-31 15:34:57', '2022-01-31 15:34:57'),
(140, 16, 59, 0, '', '', 0, '2022-01-31 15:57:28', '2022-01-31 15:57:28'),
(141, 16, 2, 0, '', '', 0, '2022-01-31 15:57:28', '2022-01-31 15:57:28'),
(142, 16, 90, 0, '', '', 4, '2022-01-31 15:57:28', '2022-01-31 15:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `badan`
--

CREATE TABLE `badan` (
  `id` int(3) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `badan`
--

INSERT INTO `badan` (`id`, `nama`) VALUES
(1, 'BAMPEMPERDA'),
(2, 'BANGGAR'),
(3, 'BANMUS'),
(4, 'BK'),
(5, 'PANSUS');

-- --------------------------------------------------------

--
-- Table structure for table `bamus`
--

CREATE TABLE `bamus` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bamus`
--

INSERT INTO `bamus` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'bamus 1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'komisi 2', '2021-06-30 18:37:55', '2021-06-30 18:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `banggar`
--

CREATE TABLE `banggar` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banggar`
--

INSERT INTO `banggar` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'banggar 1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  `date_in` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barcodes`
--

INSERT INTO `barcodes` (`id`, `barcode_number`, `status`, `notes`, `month`, `date_in`, `created_at`, `updated_at`) VALUES
(53, '3q4q242345', 0, 'Pickup Barang', '2020-07', '2020-07-26', '2020-07-26 07:20:29', '2020-07-26 07:20:29'),
(54, '342s3s5343', 0, 'Pickup Barang', '2020-01', '2020-01-12', '2020-07-26 07:21:49', '2020-07-26 07:21:49'),
(55, '242422334232', 0, 'Pickup Barang', '2020-02', '2020-03-02', '2020-07-28 01:49:01', '2020-07-28 01:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `bk`
--

CREATE TABLE `bk` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bk`
--

INSERT INTO `bk` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'majelis', '2021-03-17 02:51:48', '2021-03-17 02:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_dewan`
--

CREATE TABLE `daftar_dewan` (
  `id` int(12) NOT NULL,
  `id_kunjungan` int(12) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `absen` enum('1','2','3') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fraksi`
--

CREATE TABLE `fraksi` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fraksi`
--

INSERT INTO `fraksi` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(4, 'PDI', '2021-02-01 12:32:45', '2021-02-01 12:32:45'),
(5, 'PAN', '2021-02-01 12:32:52', '2021-02-01 12:32:52'),
(6, 'Indonesia Bersatu', '2021-06-30 18:37:32', '2021-06-30 18:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `galery_rapat`
--

CREATE TABLE `galery_rapat` (
  `id` int(11) NOT NULL,
  `id_rapat` int(11) NOT NULL,
  `tipe` enum('1','2','3') NOT NULL,
  `file` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galery_rapat`
--

INSERT INTO `galery_rapat` (`id`, `id_rapat`, `tipe`, `file`, `created_at`, `updated_at`) VALUES
(1, 5, '3', 'bukti_rapat_1640825748.jpeg', '2021-12-30 07:55:48', '2021-12-30 07:55:48'),
(2, 5, '3', 'bukti_rapat_16408257481.jpeg', '2021-12-30 07:55:48', '2021-12-30 07:55:48'),
(3, 5, '3', 'bukti_rapat_16408257482.jpeg', '2021-12-30 07:55:48', '2021-12-30 07:55:48'),
(4, 5, '3', 'bukti_rapat_16408257483.jpeg', '2021-12-30 07:55:48', '2021-12-30 07:55:48'),
(5, 5, '3', 'bukti_rapat_16408257484.jpeg', '2021-12-30 07:55:48', '2021-12-30 07:55:48'),
(6, 10, '1', 'bukti_rapat_1643290496.jpg', '2022-01-27 20:34:56', '2022-01-27 20:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `komisi`
--

CREATE TABLE `komisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komisi`
--

INSERT INTO `komisi` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(3, 'komisi 3', '2021-01-30 21:39:00', '2021-01-30 21:39:00'),
(4, 'KOMISI 2', '2022-01-27 19:29:52', '2022-01-27 19:29:52'),
(5, 'KOMISI 1', '2022-01-27 19:33:10', '2022-01-27 19:33:10'),
(6, 'KOMISI 1', '2022-01-27 19:33:25', '2022-01-27 19:33:25'),
(7, 'KOMISI 3', '2022-01-27 19:38:23', '2022-01-27 19:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `tipe_kunjungan` int(11) NOT NULL,
  `id_sub_tipe_kunjungan` int(11) NOT NULL,
  `awal_waktu_pelaksanaan` date NOT NULL,
  `waktu` time NOT NULL,
  `jenis_kunjungan` int(11) NOT NULL,
  `sub_jenis_kunjungan` int(2) NOT NULL,
  `dasar` text NOT NULL,
  `tujuan` text NOT NULL,
  `ahir_waktu_pelaksanaan` date NOT NULL,
  `daerah_kunjungan` text NOT NULL,
  `pimpinan` int(3) NOT NULL,
  `wakil_ketua1` int(3) NOT NULL,
  `wakil_ketua2` int(3) NOT NULL,
  `sekretaris` int(3) NOT NULL,
  `undangan` text NOT NULL,
  `materi` text NOT NULL,
  `hasil` text NOT NULL,
  `kesimpulan` text NOT NULL,
  `penutup` text NOT NULL,
  `saran` text NOT NULL,
  `lain` text NOT NULL,
  `pelapor` int(11) NOT NULL,
  `is_edit` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`id`, `nama`, `tipe_kunjungan`, `id_sub_tipe_kunjungan`, `awal_waktu_pelaksanaan`, `waktu`, `jenis_kunjungan`, `sub_jenis_kunjungan`, `dasar`, `tujuan`, `ahir_waktu_pelaksanaan`, `daerah_kunjungan`, `pimpinan`, `wakil_ketua1`, `wakil_ketua2`, `sekretaris`, `undangan`, `materi`, `hasil`, `kesimpulan`, `penutup`, `saran`, `lain`, `pelapor`, `is_edit`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sidak Ke Pasar Hewan Kota Blitar', 3, 6, '2021-12-22', '06:57:00', 2, 1, '<p>Keluhan masyarakat soal fasilitas public</p>', '<p>Meninjau lokasi dan Kelayakan</p>', '2021-12-22', '', 0, 0, 0, 0, '<p>PNS terkait dan semua komisi 1</p>', '<p>Tinjauan fasilitas publik di Pasar Hewan Kota Blitar</p>', '<p>Adanya evaluasi lebih lanjut</p>', '<p>Evaluasi dan Penataan Ulang</p>', '<p>Sekian Terima Kasih</p>', '<p>Tidak Ada</p>', '<p>Tidak Ada</p>', 0, 1, '2021-12-22 19:00:50', '2021-12-22 19:00:50', '2021-12-26 23:51:48'),
(2, 'Studi Banding Kebersihan dan Tata Kota ', 1, 2, '2021-12-22', '08:12:00', 6, 7, '<p>Rapat Kerja Tahun 2021</p>', '<p>Mengenal dan Meniru Tata Kota Surabaya</p>', '2021-12-22', '', 58, 59, 57, 86, '<p>-</p>', '<p>Terlampir</p>', '<p>Terlampir</p>', '<p>Pelu adanya peniruan penataan kota dan taman seperti Kota Surabaya</p>', '<p>Sekian Terima Kasih</p>', '<p>Akan diadakan kunjungan lebih lagi</p>', '<p>Tidak Ada</p>', 0, 1, '2021-12-22 19:15:57', '2021-12-22 19:15:57', '2021-12-26 23:51:48'),
(3, 'Test', 1, 2, '2021-12-22', '19:40:00', 2, 1, '', '', '2021-12-22', '', 0, 0, 0, 86, '', '', '', '', '', '', '', 1, 1, '2021-12-22 19:42:15', '2021-12-22 19:42:15', '2021-12-26 23:51:48'),
(4, 'SIDAK 123', 3, 1, '2021-12-27', '09:56:00', 4, 0, '', '', '2021-12-27', '', 0, 0, 0, 0, '', '', '', '', '', '', '', 0, 1, '2021-12-26 23:58:24', '2021-12-26 23:58:24', NULL),
(5, 'Peninjauan Lapangan Progres Pembangunan Taman ke Hati', 3, 8, '2021-12-21', '09:00:00', 17, 0, '', '', '2021-12-21', '', 0, 0, 0, 0, '', '', '', '', '', '', '', 0, 1, '2021-12-30 07:55:48', '2021-12-30 07:55:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(2) NOT NULL,
  `menu` varchar(60) NOT NULL,
  `is_rapat` enum('0','1') NOT NULL,
  `is_kunjungan` enum('0','1') NOT NULL,
  `is_tinjauan` enum('0','1') NOT NULL,
  `is_sub` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `menu`, `is_rapat`, `is_kunjungan`, `is_tinjauan`, `is_sub`) VALUES
(1, 'Paripurna', '1', '0', '0', '0'),
(2, 'Komisi', '1', '1', '0', '1'),
(3, 'Bamus', '0', '0', '0', '0'),
(4, 'Banggar', '0', '0', '0', '0'),
(5, 'Fraksi', '1', '0', '0', '1'),
(6, 'Badan', '1', '1', '0', '1'),
(7, 'Studi Komparasi Setwan', '0', '1', '0', '0'),
(8, 'Pansus', '1', '1', '0', '0'),
(9, 'BK (Badan Kehormatan)', '0', '0', '0', '0'),
(10, 'Hearing/Audiensi', '1', '0', '0', '0'),
(11, 'Kerja', '0', '1', '0', '0'),
(12, 'Setwan', '1', '0', '0', '0'),
(13, 'Uji Publik', '1', '0', '0', '0'),
(14, 'Pimpinan DPRD', '0', '1', '0', '0'),
(15, 'Komisi 2', '0', '0', '1', '0'),
(16, ' Komisi 1', '0', '0', '1', '0'),
(17, 'Komisi 3', '0', '0', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `partai`
--

CREATE TABLE `partai` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partai`
--

INSERT INTO `partai` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'PDI', '2021-01-30 21:10:59', '2021-01-30 21:10:59'),
(2, 'PAN', '2021-02-01 15:42:15', '2021-02-01 15:42:15'),
(3, 'PDIP', '2022-01-27 19:28:35', '2022-01-27 19:28:35'),
(4, 'PDIP', '2022-01-27 19:28:56', '2022-01-27 19:28:56'),
(5, 'HANURA', '2022-01-27 19:32:29', '2022-01-27 19:32:29'),
(6, 'HANURA', '2022-01-27 19:32:41', '2022-01-27 19:32:41'),
(7, 'GERINDRA', '2022-01-27 19:35:40', '2022-01-27 19:35:40'),
(8, 'PKB', '2022-01-27 19:37:33', '2022-01-27 19:37:33'),
(9, 'DEMOKRAT', '2022-01-27 19:42:03', '2022-01-27 19:42:03'),
(10, 'GOLKAR', '2022-01-27 19:43:33', '2022-01-27 19:43:33'),
(11, 'PPP', '2022-01-27 19:49:27', '2022-01-27 19:49:27'),
(12, 'PKS', '2022-01-27 19:58:02', '2022-01-27 19:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `rapat`
--

CREATE TABLE `rapat` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `title` text NOT NULL,
  `event` text NOT NULL,
  `tipe` int(11) NOT NULL COMMENT '1=paripurna',
  `sub_tipe_komisi` enum('0','1','2','3','4','5','6') NOT NULL,
  `sifat` int(11) NOT NULL,
  `tempat` text NOT NULL,
  `pimpinan` int(11) NOT NULL,
  `wakil_ketua1` int(11) NOT NULL,
  `wakil_ketua2` int(11) NOT NULL,
  `sekretaris` int(11) NOT NULL,
  `is_edit` tinyint(1) NOT NULL DEFAULT 1,
  `dasar` text NOT NULL,
  `acara` text NOT NULL,
  `undangan` text NOT NULL,
  `isi_risalah` text NOT NULL,
  `hasil_kegiatan` text NOT NULL,
  `lampiran` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rapat`
--

INSERT INTO `rapat` (`id`, `tanggal`, `waktu`, `title`, `event`, `tipe`, `sub_tipe_komisi`, `sifat`, `tempat`, `pimpinan`, `wakil_ketua1`, `wakil_ketua2`, `sekretaris`, `is_edit`, `dasar`, `acara`, `undangan`, `isi_risalah`, `hasil_kegiatan`, `lampiran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2021-06-22', '19:13:00', 'RAPAT MERDEKA', '<p>HGGUJKJLKJ</p>\r\n', 5, '4', 0, 'GEDUNG A1', 0, 0, 0, 86, 1, '', '', '', '', '', '', '2021-06-22 19:06:28', '2021-06-22 19:06:28', '2021-06-30 18:22:41'),
(2, '2021-06-27', '00:23:00', 'Rapat 123', '', 2, '1', 1, 'Kantor Walikota', 0, 0, 0, 86, 1, '', '', '', '', '', '', '2021-06-26 23:24:40', '2021-06-26 23:24:40', '2021-06-30 18:22:41'),
(3, '2021-07-01', '18:57:00', 'RAPAT HARI RABU', '', 6, '', 1, 'GEDUNG WALIKOTA', 0, 0, 0, 86, 1, '', '', '', '', '', '', '2021-06-30 17:57:34', '2021-06-30 17:57:34', '2021-06-30 18:22:41'),
(4, '2021-07-01', '00:00:00', 'wwwwwww', '', 6, '', 0, 'eeeeeeeeeeeeeeee', 0, 0, 0, 87, 1, '', '', '', '', '', '', '2021-06-30 18:00:32', '2021-06-30 18:00:32', '2021-06-30 18:22:41'),
(5, '2021-07-01', '13:00:00', 'qqqqqq', '', 6, '6', 0, 'qqqqq', 62, 0, 0, 86, 1, '', '<ol>\r\n<li>Pembukaan</li>\r\n<li>Pembacaan Berita Acara Hasil Penyusunan Propemperda Tahun 2020</li>\r\n<li>Penetapan Propemperda Tahun 2020</li>\r\n<li>Penyampaian Laporan Badan Anggaran hasil pembahasan atas Raperda tentang APBD TA 2020</li>\r\n<li>Penyampaian Pendapat Akhir Fraksi terhadap Raperda tentang APBD TA 2020</li>\r\n<li>Penyampaian Pendapat Akhir Walikota Blitar terhadap Raperda tentang APBD TA 2020</li>\r\n<li>Penetapan Persetujuan Bersama atas Raperda tentang APBD 2020</li>\r\n<li>Pembacaan Do&rsquo;a&nbsp;</li>\r\n<li>P e n u t u p</li>\r\n</ol>', '', '', '', '', '2021-06-30 18:02:23', '2021-06-30 18:02:23', '2021-06-30 18:22:41'),
(6, '2021-07-02', '18:55:00', 'Paripurna Pengangkatan AKD', '', 1, '0', 1, 'gggggggg', 0, 0, 0, 86, 1, '', '', '', '', '', '', '2021-06-30 18:22:02', '2021-06-30 18:22:02', '2021-06-30 18:22:41'),
(7, '2021-07-02', '10:35:00', 'Paripurna ', '', 1, '0', 1, 'Graha Paripurna DPRD Kota Blitar', 0, 0, 0, 86, 1, '', '', '', '', '', '', '2021-06-30 18:27:35', '2021-06-30 18:27:35', NULL),
(8, '2021-12-22', '19:21:00', 'Rapat Badan Anggaran Daerah DPRD Kota Blitar 2022', '112233', 6, '0', 0, 'Gedung DPRD Kota Blitar', 58, 59, 60, 86, 1, '<p>Dasar rapat adalah petunjuk&nbsp; ketua Dewan Perwakilan Rakyat DPRD Kota Blitar 2021</p>', '<ol>\r\n<li>Pembukaan</li>\r\n<li>Pembacaan Berita Acara Hasil Penyusunan Propemperda Tahun 2020</li>\r\n<li>Penetapan Propemperda Tahun 2020</li>\r\n<li>Penyampaian Laporan Badan Anggaran hasil pembahasan atas Raperda tentang APBD TA 2020</li>\r\n<li>Penyampaian Pendapat Akhir Fraksi terhadap Raperda tentang APBD TA 2020</li>\r\n<li>Penyampaian Pendapat Akhir Walikota Blitar terhadap Raperda tentang APBD TA 2020</li>\r\n<li>Penetapan Persetujuan Bersama atas Raperda tentang APBD 2020</li>\r\n<li>Pembacaan Do&rsquo;a&nbsp;</li>\r\n<li>P e n u t u p</li>\r\n</ol>', '', '', '<p>Terlampir</p>', '<p>Rapat Badan Anggaran untuk Tahun 2022</p>\r\n', '2021-12-22 18:25:19', '2021-12-22 18:25:19', NULL),
(9, '2021-12-14', '09:00:00', 'Rapat Bapemperda Bersama Eksekutif Membahas Raperda Tentang SOTK', '001', 6, '6', 0, 'Ruang Komisi 1', 0, 0, 0, 90, 1, '', '', '', '', '', '', '2021-12-30 07:30:46', '2021-12-30 07:30:46', NULL),
(10, '2022-02-02', '09:20:00', 'RAPAT PEMBAHASAN RAPERDA TENTANG PESANTREN', '001', 6, '6', 0, 'Ruang Rapat Bapemperda', 57, 0, 0, 94, 1, '<p>Undangan</p>', '<ol>\r\n<li>Pembukaan</li>\r\n<li>Pembacaan Berita Acara Hasil Penyusunan Propemperda Tahun 2020</li>\r\n<li>Penetapan Propemperda Tahun 2020</li>\r\n<li>Penyampaian Laporan Badan Anggaran hasil pembahasan atas Raperda tentang APBD TA 2020</li>\r\n<li>Penyampaian Pendapat Akhir Fraksi terhadap Raperda tentang APBD TA 2020</li>\r\n<li>Penyampaian Pendapat Akhir Walikota Blitar terhadap Raperda tentang APBD TA 2020</li>\r\n<li>Penetapan Persetujuan Bersama atas Raperda tentang APBD 2020</li>\r\n<li>Pembacaan Do&rsquo;a&nbsp;</li>\r\n<li>P e n u t u p</li>\r\n</ol>', '', '', '<p>Rapat berjalan lancar</p>', '<p>ljbjbajkgkbjxbkhkxkhvhjvxjvdljjdhkkhxvh jbxkjbjkbcjbchhchxhb&nbsp;</p>\r\n', '2022-01-27 20:24:13', '2022-01-27 20:24:13', NULL),
(11, '2022-01-29', '17:54:00', 'Rapat Komisi 3', '', 2, '3', 0, 'Ruang Rapat Komisi 3', 0, 0, 0, 94, 1, '', '', '', '', '', '', '2022-01-27 20:56:55', '2022-01-27 20:56:55', NULL),
(12, '2022-02-01', '08:09:00', 'Rapat Bersama Mitra Kerja Terkait Pembangunan Pasar Legi', '', 2, '3', 0, 'Ruang Rapat Komisi 3', 0, 0, 0, 94, 1, '', '', '', '', '', '', '2022-01-27 21:10:23', '2022-01-27 21:10:23', NULL),
(13, '2022-02-02', '20:00:00', 'Rapat Raperda Pesantren', '001', 0, '0', 0, 'Ruang Rapat Komisi 3', 0, 0, 0, 94, 1, '', '', '', '', '', '', '2022-01-31 15:03:40', '2022-01-31 15:03:40', NULL),
(14, '2022-02-02', '13:13:00', 'rapat perda pesantren', '001', 0, '0', 0, 'ruang rapat', 0, 0, 0, 94, 1, '', '', '', '', '', '', '2022-01-31 15:14:57', '2022-01-31 15:14:57', NULL),
(15, '2022-02-01', '14:32:00', 'RAPAT SENIN', '111', 8, '0', 0, 'GEDUNG GRAHA PATRIA', 0, 0, 0, 90, 1, '', '', '', '', '', '<p>DDD</p>\r\n', '2022-01-31 15:34:57', '2022-01-31 15:34:57', NULL),
(16, '2022-02-02', '16:55:00', 'RAPAT SELASA', '003', 2, '1', 0, 'GEDUNG GRAHADI', 0, 0, 0, 90, 1, '', '', '', '', '', '<p>DD</p>\r\n', '2022-01-31 15:57:28', '2022-01-31 15:57:28', NULL);

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
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id_sub_menu` int(2) NOT NULL,
  `id_menu` int(2) NOT NULL,
  `sub_menu` varchar(60) NOT NULL,
  `is_rapat` enum('0','1') NOT NULL,
  `is_kunjungan` enum('0','1') NOT NULL,
  `is_tinjauan` enum('0','1') NOT NULL,
  `no_urut` int(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id_sub_menu`, `id_menu`, `sub_menu`, `is_rapat`, `is_kunjungan`, `is_tinjauan`, `no_urut`) VALUES
(1, 2, 'Komisi 1', '1', '1', '1', 1),
(2, 2, 'Komisi 2', '1', '1', '1', 1),
(3, 2, 'Komisi 3', '1', '1', '1', 1),
(4, 5, 'Fraksi PDIP', '1', '1', '1', 1),
(5, 5, 'Fraksi Kebangkitan Bangsa', '1', '1', '1', 2),
(6, 5, 'Fraksi Indonesia Bersatu', '1', '1', '1', 2),
(7, 6, 'Bamperda', '1', '1', '1', 1),
(8, 6, 'Pimpinan', '0', '0', '1', 1),
(9, 6, 'BK (Badan Kehormatan)', '1', '1', '0', 1),
(10, 6, 'Hearing', '0', '0', '1', 1),
(11, 6, 'Uji Publik', '0', '0', '1', 1),
(12, 6, 'Sekretaris DPRD', '0', '0', '1', 1),
(13, 6, 'Anggota', '0', '0', '1', 1),
(14, 6, 'Pansus', '1', '1', '1', 1),
(15, 6, 'Banggar', '1', '1', '1', 1),
(16, 6, 'Banmus (Badan Musyawarah)', '1', '1', '0', 1),
(17, 5, 'Fraksi PPP', '1', '1', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sub_tipe_kunjungan`
--

CREATE TABLE `sub_tipe_kunjungan` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_tipe_kunjungan`
--

INSERT INTO `sub_tipe_kunjungan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Kalimantan', '2021-02-02 10:18:56', '2021-02-02 10:18:56'),
(2, 'Surabaya', '2021-03-15 13:52:05', '2021-03-15 13:52:05'),
(3, 'Uranus', '2021-03-29 14:28:47', '2021-03-29 14:28:47'),
(4, 'Uranus', '2021-03-29 14:28:51', '2021-03-29 14:28:51'),
(5, 'ponorogo', '2021-04-13 20:51:14', '2021-04-13 20:51:14'),
(6, 'Pasar Hewan KOta Blitar', '2021-12-22 18:59:23', '2021-12-22 18:59:23'),
(7, 'Taman Ke Hati', '2021-12-30 07:53:24', '2021-12-30 07:53:24'),
(8, 'Taman Ke Hati Blitar', '2021-12-30 07:54:07', '2021-12-30 07:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nia` varchar(50) NOT NULL,
  `tipe` int(11) NOT NULL,
  `jenis_jabatan` enum('0','1','2','3','4','5','6','7') NOT NULL,
  `ttd` varchar(30) NOT NULL,
  `id_partai` int(11) NOT NULL,
  `id_komisi` int(11) NOT NULL,
  `id_badan` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nama_pegawai`, `nip`, `nia`, `tipe`, `jenis_jabatan`, `ttd`, `id_partai`, `id_komisi`, `id_badan`, `created_at`, `updated_at`) VALUES
(1, 'WALIKOTA BLITAR', '', '', 3, '3', '', 0, 0, 0, '2021-06-17 16:28:00', '2022-01-27 20:14:19'),
(2, 'WAKIL WALIKOTA BLITAR', '', '', 3, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(3, 'SEKRETATIS DAERAH KOTA BLITAR', '', '', 3, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(4, 'KOMANDAN KODIM 0808 BLITAR', '', '', 3, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(5, 'DAN YONIF 511/DY BLITAR', '', '', 3, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(6, 'KAPOLRES BLITAR KOTA', '', '', 3, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(7, 'KETUA PENGADILAN NEGERI BLITAR', '', '', 3, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(8, 'KA. KEJAKSAAN NEGERI BLITAR', '', '', 3, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(9, 'ASISTEN ADMINISTRASI PEMERINTAHAN DAN KESRA', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(10, 'ASISTEN ADMINISTRASI UMUM DAN PEMBANGUNAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(11, 'STAF AHLI BID. KEMASYARAKATAN DAN SDM', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(12, 'STAF AHLI BID. EKONOMI KEUANGAN DAN PEMBANGUNAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(13, 'STAF AHLI BID. PEMERINTAHAN, HUKUM DAN POLITIK', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(14, 'KA . BAPPEDA', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(15, 'KA. BPKAD', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(16, 'KA. BKD', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(17, 'INSPEKTUR DAERAH', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(18, 'KA. DINAS PENDIDIKAN KOTA BLITAR', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(19, 'KADIN KESEHATAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(20, 'KA. BAKESBANG, POLITIK DAN PENANGGULANGAN BENCANA', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(21, 'KADIN PEKERJAAN UMUM DAN PENATAAN RUANG', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(22, 'KADIN PERUMAHAN RAKYAT', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(23, 'KADIN SOSIAL', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(24, 'KADIN PENANAMAN MODAL, TENAGA KERJA DAN PTSP', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(25, 'KA.DP3A, P2 DAN KB ', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(26, 'KADIN LINGKUNGAN HIDUP ', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(27, 'KADIN KEPENDUDUKAN DAN PENCATATAN SIPIL', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(28, 'KADIN PERHUBUNGAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(29, 'KADIN KOMUNIKASI, INFORMATIKA DAN STATISTIK', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(30, 'KADIN KOPERASI DAN USAHA MIKRO', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(31, 'KADIN KEPEMUDAAN DAN OLAHRAGA', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(32, 'KADIN PERPUSTAKAAN DAN KEARSIPAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(33, 'KADIN PARIWISATA DAN KEBUDAYAAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(34, 'KADIN KETAHANAN PANGAN DAN PERTANIAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(35, 'DINAS PERDAGANGAN DAN PERINDUSTRIAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(36, 'KASAT POLISI PAMONG PRAJA', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(37, 'DIREKTUR RSUD MARDI WALUYO', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(38, 'KABAG TATA PEMERINTAHAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(39, 'KABAG PEREKONOMIAN DAN KESRA', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(40, 'KABAG HUKUM DAN ORGANISASI', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(41, 'KABAG UMUM', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(42, 'KABAG HUMAS  DAN PROTOKOL', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(43, 'KABAG PEMBANGUNAN DAN LAYANAN PENGADAAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(44, 'CAMAT SANANWETAN', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(45, 'CAMAT KEPANJENKIDUL', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(46, 'CAMAT SUKOREJO', '', '', 4, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(47, 'KETUA KPU KOTA BLITAR', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(48, 'KETUA BAWASLU KOTA BLITAR', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(49, 'KETUA DPC PARTAI PDIP', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(50, 'KETUA DPC PKB', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(51, 'KETUA DPC PPP', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(52, 'KETUA DPC PARTAI GERINDRA', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(53, 'KETUA DPC PARTAI DEMOKRAT', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(54, 'KETUA DPD PARTAI GOLKAR', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(55, 'KETUA DPC PARTAI HANURA', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(56, 'KETUA DPD PKS', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(57, 'dr. SYAHRUL ALIM', '', '', 1, '1', '', 3, 0, 3, '2021-06-17 16:28:00', '2022-01-27 19:57:34'),
(58, 'ELY IDAYAH VITNAWATI', '', '', 1, '1', '', 8, 0, 3, '2021-06-17 16:28:00', '2022-01-27 19:54:30'),
(59, 'AGUS ZUNAIDI,S.E.', '', '', 1, '1', '', 11, 0, 3, '2021-06-17 16:28:00', '2022-01-27 20:03:06'),
(60, 'ADI SANTOSO,S.P', '', '', 1, '1', '', 8, 4, 1, '2021-06-17 16:28:00', '2022-01-27 20:03:44'),
(61, 'ARIS DEDI ARMAN', '', '', 1, '1', '', 3, 4, 1, '2021-06-17 16:28:00', '2022-01-27 20:02:36'),
(62, 'BAYU SETYO KUNCORO', '', '', 1, '1', '', 3, 7, 2, '2021-06-17 16:28:00', '2022-01-27 20:02:06'),
(63, 'DEDIK HENDARWANTO, S.T.', '', '', 1, '1', '', 3, 5, 1, '2021-06-17 16:28:00', '2022-01-27 20:01:32'),
(64, 'dr. LAILY KHURNIAWATI', '', '', 1, '1', '', 12, 5, 3, '2021-06-17 16:28:00', '2022-01-27 19:58:39'),
(65, 'Drs. SLAMET', '', '', 1, '1', '', 7, 7, 1, '2021-06-17 16:28:00', '2022-01-27 19:56:31'),
(66, 'GALIH HENDRA ASMARA', '', '', 1, '1', '', 3, 7, 2, '2021-06-17 16:28:00', '2022-01-27 19:53:27'),
(67, 'GUNTUR PAMUNGKAS, S.M.', '', '', 1, '1', '', 11, 5, 3, '2021-06-17 16:28:00', '2022-01-27 19:50:53'),
(68, 'HM. NUHAN EKO WAHYUDI, S.H.', '', '', 1, '1', '', 11, 7, 2, '2021-06-17 16:28:00', '2022-01-27 19:50:08'),
(69, 'ITO TUBAGUS ADITYA,SE', '', '', 1, '1', '', 9, 5, 2, '2021-06-17 16:28:00', '2022-01-27 19:48:55'),
(70, 'JOHAN MARIHOT', '', '', 1, '1', '', 3, 7, 1, '2021-06-17 16:28:00', '2022-01-27 19:47:20'),
(71, 'M. HARDITA MAGDI, S.H.', '', '', 1, '1', '', 10, 4, 2, '2021-06-17 16:28:00', '2022-01-27 19:45:37'),
(72, 'NURALI', '', '', 1, '1', '', 3, 7, 3, '2021-06-17 16:28:00', '2022-01-27 19:45:08'),
(73, 'PURWANTO', '', '', 1, '1', '', 10, 4, 3, '2021-06-17 16:28:00', '2022-01-27 19:44:43'),
(74, 'RIDO HANDOKO, S.Pd', '', '', 1, '1', '', 9, 7, 3, '2021-06-17 16:28:00', '2022-01-27 19:42:29'),
(75, 'SAID NOFANDI, S.T.', '', '', 1, '1', '', 3, 5, 2, '2021-06-17 16:28:00', '2022-01-27 19:41:13'),
(76, 'SUDARWATI', '', '', 1, '1', '', 3, 4, 3, '2021-06-17 16:28:00', '2022-01-27 19:40:13'),
(77, 'TOTOK SUGIARTO', '', '', 1, '1', '', 8, 7, 2, '2021-06-17 16:28:00', '2022-01-27 19:38:59'),
(78, 'YOHAN TRI WALUYO', '', '', 1, '1', '', 7, 4, 2, '2021-06-17 16:28:00', '2022-01-27 19:37:05'),
(79, 'YOSSY YULIARDI', '', '', 1, '1', '', 5, 5, 3, '2021-06-17 16:28:00', '2022-01-27 19:34:13'),
(80, 'YUDI MEIRA, S.,T.', '', '', 1, '1', '', 3, 4, 3, '2021-06-17 16:28:00', '2022-01-27 19:31:33'),
(81, 'Drs. ABDUS SJAKUR', '', '', 1, '1', '', 8, 5, 2, '2021-06-17 16:28:00', '2022-01-27 19:57:16'),
(82, 'TENAGA AHLI FRAKSI PDIP', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(83, 'TENAGA AHLI FRAKSI KEBANGKITAN BANGSA', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(84, 'TENAGA AHLI FRAKSI PPP', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(85, 'TENAGA AHLI FRAKSI INDONESIA BERSATU', '', '', 5, '0', '', 0, 0, 0, '2021-06-17 16:28:00', '2021-06-17 16:28:00'),
(90, 'Dra. Eka Atikah', '196808121988032006', '', 2, '2', 'CmPJr68IyBh3gdeN.jpg', 0, 0, 3, '2021-12-29 13:57:02', '2022-01-27 20:08:45'),
(94, 'RENDRA BHAKTIE KUSUMA, S.H.', '198903262019021001', '', 2, '2', 'EKUzPW6smb0uRGNd.jpg', 0, 7, 1, '2022-01-27 20:10:05', '2022-01-27 20:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_pegawai`
--

CREATE TABLE `tipe_pegawai` (
  `id_tipe` int(2) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `kategori` enum('1','2','3') NOT NULL COMMENT '1 = Anggota DPRD, 2 = Mitra, 3 = Sekwan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_pegawai`
--

INSERT INTO `tipe_pegawai` (`id_tipe`, `tipe`, `kategori`) VALUES
(1, 'Anggota DPRD Kota Blitar', '1'),
(2, 'Sekretariat DPRD', '3'),
(3, 'Mitra Kerja FORKOMPIMDA', '2'),
(4, 'Mitra Kerja HORIZONTAL', '2'),
(5, 'Mitra Kerja Vertical', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `surname` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` char(4) COLLATE utf8mb4_unicode_ci DEFAULT 'en',
  `contact_no` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_id` int(10) UNSIGNED DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive','terminated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `surname`, `username`, `email`, `password`, `language`, `contact_no`, `address`, `remember_token`, `business_id`, `location_id`, `status`, `role`, `id_pegawai`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 'rendrabk999', 'rendrabk999@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'id', NULL, NULL, 'oSeoBxvZSXeIgIX8M3HyXMdJMmf9DNgX5uEcqxgTBQUl4Yfq8RhJxfjmpJwr', 1, NULL, 'active', 1, 1, NULL, '2019-06-29 14:15:46', '2022-01-27 12:26:38'),
(47, NULL, 'rita', 'rita@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'en', NULL, NULL, NULL, NULL, NULL, 'active', 2, 1, NULL, '2022-01-27 12:27:35', '2022-01-27 12:27:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `absensi_rapat`
--
ALTER TABLE `absensi_rapat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anggota_kunjungan`
--
ALTER TABLE `anggota_kunjungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rapat` (`id_kunjungan`);

--
-- Indexes for table `anggota_rapat`
--
ALTER TABLE `anggota_rapat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rapat` (`id_rapat`);

--
-- Indexes for table `badan`
--
ALTER TABLE `badan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bamus`
--
ALTER TABLE `bamus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banggar`
--
ALTER TABLE `banggar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barcodes`
--
ALTER TABLE `barcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk`
--
ALTER TABLE `bk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_dewan`
--
ALTER TABLE `daftar_dewan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fraksi`
--
ALTER TABLE `fraksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galery_rapat`
--
ALTER TABLE `galery_rapat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komisi`
--
ALTER TABLE `komisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `partai`
--
ALTER TABLE `partai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rapat`
--
ALTER TABLE `rapat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_business_id_foreign` (`business_id`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`);

--
-- Indexes for table `sub_tipe_kunjungan`
--
ALTER TABLE `sub_tipe_kunjungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `tipe_pegawai`
--
ALTER TABLE `tipe_pegawai`
  ADD PRIMARY KEY (`id_tipe`);

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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `absensi_rapat`
--
ALTER TABLE `absensi_rapat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `anggota_kunjungan`
--
ALTER TABLE `anggota_kunjungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `anggota_rapat`
--
ALTER TABLE `anggota_rapat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `badan`
--
ALTER TABLE `badan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bamus`
--
ALTER TABLE `bamus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banggar`
--
ALTER TABLE `banggar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barcodes`
--
ALTER TABLE `barcodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `bk`
--
ALTER TABLE `bk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daftar_dewan`
--
ALTER TABLE `daftar_dewan`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fraksi`
--
ALTER TABLE `fraksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `galery_rapat`
--
ALTER TABLE `galery_rapat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `komisi`
--
ALTER TABLE `komisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `partai`
--
ALTER TABLE `partai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rapat`
--
ALTER TABLE `rapat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id_sub_menu` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sub_tipe_kunjungan`
--
ALTER TABLE `sub_tipe_kunjungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tipe_pegawai`
--
ALTER TABLE `tipe_pegawai`
  MODIFY `id_tipe` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_rapat`
--
ALTER TABLE `anggota_rapat`
  ADD CONSTRAINT `anggota_rapat_ibfk_1` FOREIGN KEY (`id_rapat`) REFERENCES `rapat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
