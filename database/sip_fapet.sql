-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2020 at 12:27 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sip_fapet`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `idbuku` int(11) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `isbn` varchar(128) NOT NULL,
  `judul_buku` varchar(128) NOT NULL,
  `pengarang` varchar(128) NOT NULL,
  `kota_terbit` varchar(128) NOT NULL,
  `penerbit` varchar(128) NOT NULL,
  `tahun_buku` varchar(5) NOT NULL,
  `jml_hal` int(11) NOT NULL,
  `jml_buku` int(11) NOT NULL,
  `cover_buku` varchar(128) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`idbuku`, `kode_buku`, `isbn`, `judul_buku`, `pengarang`, `kota_terbit`, `penerbit`, `tahun_buku`, `jml_hal`, `jml_buku`, `cover_buku`, `stok`) VALUES
(14, 'BOOK296080604', '', 'BELAJAR PHP', 'EKA SAPUTRA', 'BINTUNI', 'NOKENCODE', '2011', 2000, 24, '', 21),
(15, 'BOOK757789803', '', 'BELAJAR CSS', 'EKA SAPUTRA', 'BINTUNI', 'NOKENCODE', '2012', 3000, 30, 'BOOK-20200213104857.jpg', 28),
(16, 'BOOK133257577', '', 'BELAJAR JAVA', 'EKA SAPUTRA', 'BINTUNI', 'NOKENCODE', '2013', 4000, 35, '', 33),
(17, 'BOOK1801279241', '', 'BELAJAR KOTLIN', 'EKA SAPUTRA', 'BINTUNI', 'NOKENCODE', '2014', 5000, 40, '', 40),
(18, 'BOOK1340124906', '', 'BELAJAR JAVASCRIPT BELAJAR JAVASCRIPT BELAJAR JAVASCRIPT BELAJAR JAVASCRIPT BELAJAR JAVASCRIPT BELAJAR JAVASCRIPT BELAJAR JAVASC', 'EKA SAPUTRA', 'BINTUNI', 'NOKENCODE', '2015', 6000, 45, '', 45),
(19, 'BOOK1777460878', '123', '123', '123', '123', '123', '123', 12123, 12310, '', 12310),
(20, 'BOOK1765597331', '321', '123', '123', '123', '123', '123', 1231, 1228, '', 1228);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `iddosen` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `tempat_lahir` varchar(128) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`iddosen`, `nip`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jk`, `telp`, `alamat`, `foto`) VALUES
(8, '198609262015051009', 'EKA SAPUTRA', 'BINTUNI', '1997-11-02', 'L', '092131231232', 'Jalan 8', ''),
(10, '198609262015051002', 'EKA SAPUTRA', 'BINTUNI', '1997-10-27', 'P', '092131231232', 'Jalan 2', ''),
(11, '198609262015051003', 'EKA SAPUTRA', 'BINTUNI', '1997-10-28', 'P', '092312349876', 'Jalan 3', ''),
(12, '198609262015051004', 'EKA SAPUTRA', 'BINTUNI', '1997-10-29', 'L', '092131231232', 'Jalan 4', ''),
(13, '198609262015051005', 'EKA SAPUTRA', 'BINTUNI', '1997-10-30', 'P', '092312349876', 'Jalan 5', ''),
(14, '198609262015051006', 'EKA SAPUTRA', 'BINTUNI', '1997-10-31', 'L', '092131231232', 'Jalan 6', ''),
(15, '198609262015051007', 'EKA SAPUTRA', 'BINTUNI', '1997-11-01', 'L', '092312349876', 'Jalan 7', ''),
(16, '198609262015051008', 'EKA SAPUTRA', 'BINTUNI', '1997-11-02', 'P', '092131231232', 'Jalan 8', ''),
(18, '198609262015051001', 'Eka Saputra', 'Kabupaten Teluk Bintuni', '1997-10-27', 'P', '082248577297', 'Jalur 3 SP 1 No. 13 RT 03/RW 01', '19860926 201505 1 001-Eka Saputra-20200213092651.jpg'),
(20, '198609262015051010', 'EKA SAPUTRA', 'BINTUNI', '1997-11-02', 'L', '082248577297', 'asdasdasd', '19860926 201505 1 010-EKA SAPUTRA-20200213092623.jpg'),
(21, '111111111111111111', 'EKA SAPUTRA a', 'BINTUNI', '1997-11-02', 'P', '082248577297', '111111', '');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `idmahasiswa` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(128) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenjang` varchar(5) NOT NULL,
  `program_studi` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`idmahasiswa`, `nim`, `nama_lengkap`, `jk`, `tempat_lahir`, `tanggal_lahir`, `jenjang`, `program_studi`, `foto`) VALUES
(8, '201552002', 'EKA SAPUTRA', 'P', 'BINTUNI', '1997-10-28', 'S1', 'Nutrisi Teknologi Pakan Ternak', '201552002-EKA SAPUTRA-20200211014206.jpg'),
(9, '201552003', 'EKA SAPUTRA', 'L', 'BINTUNI', '1997-10-29', 'D3', 'Budidaya Ternak', '201552003-EKA SAPUTRA-20200211020540.jpg'),
(10, '201552004', 'EKA SAPUTRA', 'P', 'BINTUNI', '1997-10-30', 'S1', 'Peternakan', '201552004-EKA SAPUTRA-20200211021809.jpg'),
(11, '201552005', 'EKA SAPUTRA', 'L', 'BINTUNI', '1997-10-31', 'S1', 'Nutrisi Teknologi Pakan Ternak', ''),
(12, '201552006', 'EKA SAPUTRA', 'L', 'BINTUNI', '1997-11-01', 'D3', 'Kesehatan Hewan', ''),
(13, '201552007', 'EKA SAPUTRA', 'P', 'BINTUNI', '1997-11-02', 'D3', 'Budidaya Ternak', ''),
(15, '20152001', 'Eka Saputra Mhs', 'L', 'Kabupaten Teluk Bintuni', '1997-11-02', 'S1', 'Nutrisi Teknologi Pakan Ternak', '20152001-Eka Saputra-20200211011848.jpg'),
(16, '201520010', 'Eka Saputra', 'P', 'Kabupaten Teluk Bintuni', '1997-11-02', 'S1', 'Nutrisi Teknologi Pakan Ternak', '201520010-Eka Saputra-20200211125952.jpg'),
(21, '201520011', 'Eka Saputra', 'L', 'Kabupaten Teluk Bintuni', '1997-11-02', 'S1', 'Teknik Informatika', '');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `idpeminjaman` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `peminjam_id` int(11) NOT NULL,
  `peminjam_kode` varchar(25) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `buku_kode` varchar(128) NOT NULL,
  `jml_pinjam` int(11) NOT NULL,
  `petugas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`idpeminjaman`, `tgl_pinjam`, `tgl_kembali`, `peminjam_id`, `peminjam_kode`, `buku_id`, `buku_kode`, `jml_pinjam`, `petugas_id`) VALUES
(53, '2020-02-18', '2020-02-25', 18, '198609262015051001', 14, 'BOOK296080604', 1, 1),
(54, '2020-02-18', '2020-02-23', 18, '198609262015051001', 20, 'BOOK1765597331', 1, 1),
(58, '2020-02-18', '2020-02-05', 12, '201552006', 15, 'BOOK757789803', 1, 1),
(60, '2020-02-18', '2020-02-24', 12, '201552006', 14, 'BOOK296080604', 1, 1);

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `kurang_stok` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
	UPDATE buku set buku.stok = buku.stok-new.jml_pinjam WHERE buku.idbuku = new.buku_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `idpengembalian` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `telat` int(11) NOT NULL,
  `denda` varchar(15) NOT NULL,
  `peminjam_id` int(11) NOT NULL,
  `peminjam_kode` varchar(25) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `buku_kode` varchar(128) NOT NULL,
  `jml_kembali` int(11) NOT NULL,
  `peminjaman_id` int(11) NOT NULL,
  `petugas_id` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`idpengembalian`, `tgl_kembali`, `telat`, `denda`, `peminjam_id`, `peminjam_kode`, `buku_id`, `buku_kode`, `jml_kembali`, `peminjaman_id`, `petugas_id`, `is_deleted`) VALUES
(37, '2020-02-24', 19, '19000', 12, '201552006', 15, 'BOOK757789803', 1, 58, 1, 0),
(38, '2020-02-24', 1, '1000', 18, '198609262015051001', 20, 'BOOK1765597331', 1, 54, 1, 0);

--
-- Triggers `pengembalian`
--
DELIMITER $$
CREATE TRIGGER `stok_kurang` AFTER DELETE ON `pengembalian` FOR EACH ROW BEGIN
	UPDATE buku set buku.stok = buku.stok-old.jml_kembali WHERE buku.idbuku = old.buku_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER INSERT ON `pengembalian` FOR EACH ROW BEGIN
	UPDATE buku set buku.stok = buku.stok+new.jml_kembali WHERE buku.idbuku = new.buku_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `idpengunjung` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `pengunjung_kode` varchar(25) NOT NULL,
  `pengunjung_nama` varchar(128) NOT NULL,
  `pengunjung_status` enum('Dosen','Mahasiswa') NOT NULL,
  `pengunjung_ket` text NOT NULL,
  `petugas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`idpengunjung`, `tanggal`, `pengunjung_kode`, `pengunjung_nama`, `pengunjung_status`, `pengunjung_ket`, `petugas_id`) VALUES
(2, '2020-02-25', '201552002', 'EKA SAPUTRA', 'Mahasiswa', 'belajar dan mau pinjam buku', 1),
(3, '2020-02-25', '198609262015051002', 'EKA SAPUTRA', 'Dosen', 'baca baca saja', 1),
(4, '2020-02-24', '198609262015051002', 'EKA SAPUTRA', 'Dosen', 'a', 1),
(5, '2020-02-25', '198609262015051002', 'EKA SAPUTRA', 'Dosen', 's', 1),
(6, '2020-02-24', '201552006', 'EKA SAPUTRA', 'Mahasiswa', 'a', 1),
(7, '2020-02-25', '201552006', 'EKA SAPUTRA', 'Mahasiswa', 'aa', 1),
(8, '2020-02-23', '201552006', 'EKA SAPUTRA', 'Mahasiswa', 'aaa', 1),
(9, '2020-02-25', '201552006', 'EKA SAPUTRA', 'Mahasiswa', 'aaaa', 1),
(10, '2020-02-25', '201552006', 'EKA SAPUTRA', 'Mahasiswa', 'aaaa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_peminjaman`
--

CREATE TABLE `tmp_peminjaman` (
  `idtmp` int(11) NOT NULL,
  `peminjam_id` int(11) NOT NULL,
  `peminjam_kode` varchar(25) NOT NULL,
  `peminjam_nama` varchar(128) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `cover_buku` varchar(128) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul_buku` varchar(128) NOT NULL,
  `jml_buku` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `jml_pinjam` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `user_name` varchar(25) DEFAULT NULL,
  `user_password` varchar(128) DEFAULT NULL,
  `user_fullname` varchar(128) DEFAULT NULL,
  `user_telp` varchar(15) DEFAULT NULL,
  `user_type` enum('super_user','administrator','user','dosen') DEFAULT NULL,
  `user_bio` text,
  `is_active` int(1) DEFAULT NULL,
  `is_block` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `user_name`, `user_password`, `user_fullname`, `user_telp`, `user_type`, `user_bio`, `is_active`, `is_block`) VALUES
(1, 'admin', '$2y$10$h6Mas3QjJTZgIfQH5jFiYOdsXKhzP0M08oVD.DXExrn.mA8RshOJa', 'SIPFaPet', '082248577297', 'super_user', 'Saya admin dengan akses super_user', 1, 0),
(122, '12345', '$2y$10$JXmq4oXHOH28ShsjO/Ok/OehEdePiwB8uVoqRnvXx8DJ6MAVj7/U6', '12345', '12345', 'administrator', NULL, 1, 0),
(123, '123', '$2y$10$l1z60oZztgNnQhGPvdm98usw58K9CbOvEGpVqpSpcIcy3YpXU3GwW', '123', '123', 'user', NULL, 1, 0),
(155, '198609262015051009', '$2y$10$2OnqyNUpA57cgjnL4xuIteAdeP4kfb71L0F9b5waXT3G1mkN8dFCS', 'EKA SAPUTRA', NULL, 'dosen', NULL, 1, 0),
(156, '198609262015051002', '$2y$10$SVp6JYoq5cZybOzbYUwfletKk0NiFX45gNFbtnlkDTKO4p2IfBFgu', 'EKA SAPUTRA', NULL, 'dosen', NULL, 1, 0),
(157, '198609262015051003', '$2y$10$UwN7SnN11mUJnexkraxrqe/V0KFIngRum1v/auVcUnj0a/XZB.01O', 'EKA SAPUTRA', NULL, 'dosen', NULL, 1, 0),
(158, '198609262015051004', '$2y$10$VWkvWMVTkhnEqMx1W/zHc.MRPsMhGAyBVme8AkTGXVgUD9kfxhfDC', 'EKA SAPUTRA', NULL, 'dosen', NULL, 1, 0),
(159, '198609262015051005', '$2y$10$mojEAEQpbMvmfva/Io.aXOn08aTXlQDUSBjVs5FLsvfF.pkH1YLDG', 'EKA SAPUTRA', NULL, 'dosen', NULL, 1, 0),
(160, '198609262015051006', '$2y$10$U45.3z4Je0i/cD8.CgtCveVdpi0YhBEfcG1r/Y7cn7Nbiu8SDCTWm', 'EKA SAPUTRA', NULL, 'dosen', NULL, 1, 0),
(161, '198609262015051007', '$2y$10$eD2POH87tfp9lmvNPORSZO06HvYjBJJJEiPJKVsAd0LWzjqVSEp2G', 'EKA SAPUTRA', NULL, 'dosen', NULL, 1, 0),
(162, '198609262015051008', '$2y$10$6k5FKoAztEPWrckWHKBZbuZ3TUtKriWOyQrTdMRRcOhpElvBZ9E0y', 'EKA SAPUTRA', NULL, 'dosen', NULL, 1, 0),
(163, '198609262015051001', '$2y$10$D2IOKHTAbXPuVkKyRqvO1epheHgdPCw1z.OANx8WgTc2gq1eNvpPu', 'Eka Saputra', NULL, 'dosen', NULL, 1, 0),
(164, '198609262015051010', '$2y$10$M48/tAki7tbva.DyP.va0uVkI1MqxgAwNJtmxh/tN1/hgUolRh1.m', 'EKA SAPUTRA', NULL, 'dosen', NULL, 1, 0),
(165, '111111111111111111', '$2y$10$wVUd4d515f/4gN1VPEetGenBam.lvBOXIDqeGBv3L.kJJ95gqyVU2', 'EKA SAPUTRA a', NULL, 'dosen', NULL, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`idbuku`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`iddosen`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`idmahasiswa`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`idpeminjaman`),
  ADD KEY `peminjam_id` (`peminjam_id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`idpengembalian`),
  ADD KEY `peminjam_id` (`peminjam_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`idpengunjung`);

--
-- Indexes for table `tmp_peminjaman`
--
ALTER TABLE `tmp_peminjaman`
  ADD PRIMARY KEY (`idtmp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `idbuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `iddosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `idmahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `idpeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `idpengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `idpengunjung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tmp_peminjaman`
--
ALTER TABLE `tmp_peminjaman`
  MODIFY `idtmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
