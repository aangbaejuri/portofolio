-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2025 at 05:27 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_portofolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `exp_edu`
--

CREATE TABLE `exp_edu` (
  `id` int NOT NULL,
  `tipe` enum('Pendidikan','Pengalaman') NOT NULL,
  `instansi` text NOT NULL,
  `sebagai` text NOT NULL,
  `periode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `exp_edu`
--

INSERT INTO `exp_edu` (`id`, `tipe`, `instansi`, `sebagai`, `periode`) VALUES
(1, 'Pendidikan', 'Institut Teknologi dan Bisnis Banten', 'S1 Informatika', '2023 - Present'),
(2, 'Pengalaman', 'JTProfesional', 'Project Manager', '2023 - 2024');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `kode` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `wa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `ig` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `tt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `yt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`kode`, `email`, `wa`, `ig`, `tt`, `yt`) VALUES
('aang', 'mailto:aangbaejuri.dev@gmail.com', 'https://wa.me/628993123999', 'https://instagram.com/aangbaejuri', 'https://tiktok.com/aangbaejuri', 'https://aangbaejuri.id');

-- --------------------------------------------------------

--
-- Table structure for table `postingan`
--

CREATE TABLE `postingan` (
  `id` int NOT NULL,
  `banner` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `judul` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `penulis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `keyword` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `postingan`
--

INSERT INTO `postingan` (`id`, `banner`, `judul`, `deskripsi`, `penulis`, `datetime`, `keyword`) VALUES
(1, 'upload/postingan/file_67cef975b4dfe3.91784924.png', 'Tes postingan website portofolio', '<p class=\"ql-align-justify\">Halo, selamat datang di website portofolio sederhana milik saya. Saya lahir di Kota Serang, Banten, pada 25 Mei 2003. Saat ini, saya menempuh pendidikan tinggi di Institut Teknologi dan Bisnis Banten, jurusan S1 Informatika, angkatan 2023/2024. Terimakasih telah mengunjungi website saya.</p>', 'Aang Baejuri', '2025-03-10 21:38:45', 'Tes-postingan-website-portofolio-11032025'),
(2, 'upload/postingan/166b935dc299ef8b55c296c352307d5f.png', 'Lorem Ipsum Dolor Sit Amet', '<p class=\"ql-align-justify\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam minima, laudantium neque quisquam dolore itaque molestias dolor quos. Quibusdam nemo veniam dolorem est temporibus delectus. Quia doloribus soluta dolore eos. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam minima, laudantium neque quisquam dolore itaque molestias dolor quos. Quibusdam nemo veniam dolorem est temporibus delectus. Quia doloribus soluta dolore eos. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam minima, laudantium neque quisquam dolore itaque molestias dolor quos. Quibusdam nemo veniam dolorem est temporibus delectus. Quia doloribus soluta dolore eos. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam minima, laudantium neque quisquam dolore itaque molestias dolor quos. Quibusdam nemo veniam dolorem est temporibus delectus. Quia doloribus soluta dolore eos. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam minima, laudantium neque quisquam dolore itaque molestias dolor quos. Quibusdam nemo veniam dolorem est temporibus delectus. Quia doloribus soluta dolore eos.</p>', 'Aang Baejuri', '2025-03-11 19:24:02', 'Lorem-Ipsum-Dolor-Sit-Amet');

-- --------------------------------------------------------

--
-- Table structure for table `sctn`
--

CREATE TABLE `sctn` (
  `kode` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `cv` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `foto_saya` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `bio` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `quote` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `map_lokasi` text COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `sctn`
--

INSERT INTO `sctn` (`kode`, `cv`, `foto_saya`, `nama`, `bio`, `deskripsi`, `quote`, `alamat`, `map_lokasi`) VALUES
('aang', 'view/2ad5e62e022ef5cf95c08a5943636889.png', 'view/eea1b2e7e3a4e46f07155ebd2c2d817e.jpg', 'Aang Baejuri', 'Saya adalah manusia hebat', 'Halo, selamat datang di website portofolio sederhana milik saya. Saya lahir di Kota Serang, Banten, pada 25 Mei 2003. Saat ini, saya menempuh pendidikan tinggi di Institut Teknologi dan Bisnis Banten, jurusan S1 Informatika, angkatan 2023/2024.\r\nTerimakasih telah mengunjungi website saya.', 'Narasi Tanpa Aksi Hanya Akan Menjadi Halusinasi', 'Kp.Cijeruk Des.Cijeruk Kec.Kibin Kab.Serang - Banten', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.749575322075!2d106.30782597402428!3d-6.164282460410426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e421d702e13c9c1%3A0xd855cc2fffc979d6!2sDesa%20Cijeruk!5e0!3m2!1sid!2sid!4v1723212533021!5m2!1sid!2sid');

-- --------------------------------------------------------

--
-- Table structure for table `sctn_partner`
--

CREATE TABLE `sctn_partner` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `sctn_partner`
--

INSERT INTO `sctn_partner` (`id`, `nama`, `logo`) VALUES
(1, 'INSTITUT TEKNOLOGI DAN BISNIS BANTEN', 'upload/partner/file_679e95dc3b1e97.92319656.png'),
(2, 'HIMPUNAN MAHASISWA TEKNOLOGI INFORMASI', 'upload/partner/file_679e96445b6c44.57991631.png'),
(3, 'BADAN EKSEKUTIF MAHASISWA', 'upload/partner/file_679e9610cfbe80.34938875.png'),
(5, 'HIMPUNAN MAHASISWA EKONOMI BISNIS', 'upload/partner/file_679e9655aaf995.88784189.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `ref` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `kode_akses` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `cookie_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `ref`, `kode_akses`, `password`, `cookie_token`, `terdaftar`) VALUES
(1, 'Aang Baejuri', 'Aang Baejuri', 'AANG_HMTI', '$2y$10$feV23p.zt2LYQVQfvdvzSedyF5jLL5juXLJ2rBg7klp2BBFOFm0rK', '6c631976840397cf8757ffa9a37d2bf1', '2025-01-28 22:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE `website` (
  `kode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `author` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `title` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `short_title` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `navicon` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `favicon` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`kode`, `author`, `title`, `short_title`, `navicon`, `favicon`) VALUES
('aang', 'Aang Baejuri', 'PORTOFOLIO BY AANG', 'PORTOFOLIO', 'upload/website/20250310_204538.png', 'upload/website/favicon_aang.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exp_edu`
--
ALTER TABLE `exp_edu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postingan`
--
ALTER TABLE `postingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sctn_partner`
--
ALTER TABLE `sctn_partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exp_edu`
--
ALTER TABLE `exp_edu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `postingan`
--
ALTER TABLE `postingan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sctn_partner`
--
ALTER TABLE `sctn_partner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
