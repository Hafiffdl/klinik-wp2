-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 01:22 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik-wp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `berobat`
--

CREATE TABLE `berobat` (
  `id_berobat` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tgl_berobat` date NOT NULL,
  `keluhan_pasien` varchar(200) NOT NULL,
  `hasil_diagnosa` varchar(200) NOT NULL,
  `penatalaksanaan` enum('Rawat Jalan','Rawat Inap','Rujuk','Lainnya') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berobat`
--

INSERT INTO `berobat` (`id_berobat`, `id_pasien`, `id_dokter`, `tgl_berobat`, `keluhan_pasien`, `hasil_diagnosa`, `penatalaksanaan`) VALUES
(2, 1, 3, '2022-09-28', 'Panas', 'Dada sakit', 'Rawat Jalan'),
(5, 4, 1, '2022-09-28', 'Panas', 'Covid-21', 'Rawat Jalan'),
(6, 1, 1, '2022-09-28', 'Batuk', 'Sakit Kepala', 'Rawat Jalan'),
(8, 4, 3, '2022-09-28', 'Muntah', 'Hamil', 'Rawat Inap'),
(9, 6, 3, '2022-09-28', 'Panas', 'Covid', 'Rawat Jalan'),
(10, 7, 3, '2022-09-29', 'Flu', 'Covid', 'Rawat Jalan');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`) VALUES
(1, 'Dada'),
(2, 'Dedi'),
(3, 'Desi');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`) VALUES
(1, 'Paracetamol'),
(3, 'Amongus'),
(5, 'Parahmen');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(40) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `umur` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `jenis_kelamin`, `umur`) VALUES
(1, 'Bisma', 'L', 23),
(4, 'Ahong', 'L', 22),
(5, 'Hafif', 'L', 25),
(6, 'Rendy', 'L', 23),
(7, 'Aryo', 'P', 20);

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id_resep` int(11) NOT NULL,
  `id_berobat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resep_obat`
--

INSERT INTO `resep_obat` (`id_resep`, `id_berobat`, `id_obat`) VALUES
(1, 2, 3),
(2, 2, 5),
(3, 5, 1),
(4, 5, 5),
(5, 6, 5),
(6, 9, 1),
(7, 9, 5),
(8, 10, 1),
(9, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(2, 'baru', 'd41d8cd98f00b204e9800998ecf8427e', 'Baru Nih Kak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berobat`
--
ALTER TABLE `berobat`
  ADD PRIMARY KEY (`id_berobat`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_berobat` (`id_berobat`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berobat`
--
ALTER TABLE `berobat`
  MODIFY `id_berobat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resep_obat`
--
ALTER TABLE `resep_obat`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berobat`
--
ALTER TABLE `berobat`
  ADD CONSTRAINT `berobat_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `berobat_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`);

--
-- Constraints for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD CONSTRAINT `resep_obat_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`),
  ADD CONSTRAINT `resep_obat_ibfk_2` FOREIGN KEY (`id_berobat`) REFERENCES `berobat` (`id_berobat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
