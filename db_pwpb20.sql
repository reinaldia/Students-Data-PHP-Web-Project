-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 10:56 AM
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
-- Database: `db_pwpb20`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_kelas`
--

CREATE TABLE `t_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(15) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_kelas`
--

INSERT INTO `t_kelas` (`id_kelas`, `nama_kelas`, `jurusan`) VALUES
(1, 'X TELK 1', 'Teknik Elektronika'),
(2, 'X TELK 2', 'Teknik Elektronika'),
(3, 'X TELK 3', 'Teknik Elektronika'),
(4, 'X TOI 1', 'Teknik Otomasi Industri'),
(5, 'X TOI 2', 'Teknik Otomasi Industri'),
(6, 'X TKTL 1', 'Teknik Komputer Jaringan'),
(7, 'X TKTL 2', 'Teknik Komputer Jaringan'),
(8, 'X TKTL 3', 'Teknik Komputer Jaringan'),
(9, 'X TJKT 1', 'Teknik Jaringan Komputer dan Telekomunikasi'),
(10, 'X TJKT 2', 'Teknik Jaringan Komputer dan Telekomunikasi'),
(11, 'X PPLG 1', 'Pengembangan Perangkat Lunak dan Gim'),
(12, 'X PPLG 2', 'Pengembangan Perangkat Lunak dan Gim'),
(13, 'X PPLG 3', 'Pengembangan Perangkat Lunak dan Gim'),
(14, 'X DKV 1', 'Desain Komunikasi Visual'),
(15, 'X DKV 2', 'Desain Komunikasi Visual'),
(16, 'XI TAV 1', 'Teknik Audio Video'),
(17, 'XI TAV 2', 'Teknik Audio Video'),
(18, 'XI TAV 3', 'Teknik Audio Video'),
(19, 'XI TAV 4', 'Teknik Audio Video'),
(20, 'XI TITL 1', 'Teknik Instalasi Tenaga Listrik'),
(21, 'XI TITL 2', 'Teknik Instalasi Tenaga Listrik'),
(22, 'XI TOI 1', 'Teknik Otomasi Industri'),
(23, 'XI TOI 2', 'Teknik Otomasi Industri'),
(24, 'XI TKJ 1', 'Teknik Komputer Jaringan'),
(25, 'XI TKJ 2', 'Teknik Komputer Jaringan'),
(26, 'XI RPL 1', 'Rekayasa Perangkat Lunak'),
(27, 'XI RPL 2', 'Rekayasa Perangkat Lunak'),
(28, 'XI RPL 3', 'Rekayasa Perangkat Lunak'),
(29, 'XI DKV 1', 'Desain Komunikasi Visual'),
(30, 'XI DKV 2', 'Desain Komunikasi Visual'),
(31, 'XII TAV 1', 'Teknik Audio Video'),
(32, 'XII TAV 2', 'Teknik Audio Video'),
(33, 'XII TAV 3', 'Teknik Audio Video'),
(34, 'XII TAV 4', 'Teknik Audio Video'),
(35, 'XII TITL 1', 'Teknik Instalasi Tenaga Listrik'),
(36, 'XII TITL 2', 'Teknik Instalasi Tenaga Listrik'),
(37, 'XII TOI 1', 'Teknik Otomasi Industri'),
(38, 'XII TOI 2', 'Teknik Otomasi Industri'),
(39, 'XII TKJ 1', 'Teknik Komputer Jaringan'),
(40, 'XII TKJ 2', 'Teknik Komputer Jaringan'),
(41, 'XII RPL 1', 'Rekayasa Perangkat Lunak'),
(42, 'XII RPL 2', 'Rekayasa Perangkat Lunak'),
(43, 'XII DKV 1', 'Desain Komunikasi Visual'),
(44, 'XII DKV 2', 'Desain Komunikasi Visual');

-- --------------------------------------------------------

--
-- Table structure for table `t_login`
--

CREATE TABLE `t_login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_login`
--

INSERT INTO `t_login` (`id_login`, `username`, `pw`, `level`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(4, 'irafialdia', 'c9757da5801e04d239a0c844331292a6d096d215', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_siswa`
--

CREATE TABLE `t_siswa` (
  `nis` bigint(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `golongan_darah` varchar(2) NOT NULL,
  `nama_ibu_kandung` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_kelas`
--
ALTER TABLE `t_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `t_login`
--
ALTER TABLE `t_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `siswa_ibfk_1` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `t_login`
--
ALTER TABLE `t_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `t_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
