-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 02:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riskappli`
--

-- --------------------------------------------------------

--
-- Table structure for table `resiko`
--

CREATE TABLE `resiko` (
  `id` int(11) NOT NULL,
  `resiko` varchar(255) NOT NULL,
  `divisi` enum('Keuangan','Keagamaan','Keamanan','Rumah Tangga','Pendidikan','Pembangunan') NOT NULL,
  `tingkat` enum('Tinggi, Utama','Tinggi, Sampingan','Sedang, Utama','Sedang, Sampingan','Rendah, Utama','Rendah, Sampingan') NOT NULL,
  `penyebab` varchar(255) NOT NULL,
  `sumber` enum('Internal Kampus','Internal Divisi','Eksternal Kampus','Eksternal Divisi') NOT NULL,
  `mitigasi` varchar(255) NOT NULL,
  `solusi` varchar(255) NOT NULL,
  `status` enum('approved','rejected','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resiko`
--

INSERT INTO `resiko` (`id`, `resiko`, `divisi`, `tingkat`, `penyebab`, `sumber`, `mitigasi`, `solusi`, `status`) VALUES
(3, 'Keamanan data', 'Keagamaan', 'Tinggi, Sampingan', 'agama', 'Internal Divisi', '', '', 'rejected'),
(4, 'Anggaran', 'Keuangan', 'Sedang, Sampingan', 'Makan', 'Eksternal Divisi', 'simpan anggaran', 'kurangi makan', 'approved'),
(6, 'Anggaran', 'Keuangan', 'Sedang, Sampingan', 'kurang uang dan makan', 'Internal Divisi', '', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(4, 'admin', '$2y$10$6tBMTftPOvMPq3U2CME1VuJ78IpFz0QUI8pNiN4eVxFDd2DQ6VhbC', 'Admin'),
(5, 'user', '$2y$10$zqI5Jtommo6pWW1DaB6NmeWoS0FqPbK0THbfxNoEQujmqSU/PBO.m', 'User'),
(6, 'ryanesok', '$2y$10$/s/0exCnlzChCgNvxNvX..7./B2VNdq8ihIqsV8SgkvdpLxhqpbXq', 'User'),
(7, 'computer', '$2y$10$zeMmte3p1NW8PmcVkMXEF.eWx0aGJJC1WKs3sJ./LQyJs/zbyV/C.', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resiko`
--
ALTER TABLE `resiko`
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
-- AUTO_INCREMENT for table `resiko`
--
ALTER TABLE `resiko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
