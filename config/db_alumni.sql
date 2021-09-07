-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2021 at 06:03 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alumni`
--

CREATE TABLE `tbl_alumni` (
  `nis` varchar(25) NOT NULL,
  `nama` char(45) NOT NULL,
  `tempat_lahir` char(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jns_kelamin` varchar(30) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `notlpn` varchar(13) NOT NULL,
  `email` varchar(40) NOT NULL,
  `nama_jurusan` char(30) NOT NULL,
  `thn_lulus` varchar(5) NOT NULL,
  `status` char(30) NOT NULL,
  `nama_instansi` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_alumni`
--

INSERT INTO `tbl_alumni` (`nis`, `nama`, `tempat_lahir`, `tgl_lahir`, `jns_kelamin`, `agama`, `alamat`, `notlpn`, `email`, `nama_jurusan`, `thn_lulus`, `status`, `nama_instansi`, `foto`) VALUES
('2012450001', 'mamat', 'bekasi', '2021-06-01', 'Laki - Laki', 'Islam', 'jl.bintara 11\r\nbintara 11', '+628991966553', 'ariframdan99@gmail.com', 'Akuntansi', '2017', 'Bekerja', 'jauh', '427018793_alumni.png'),
('2012450002', 'benito', 'jakarta', '2017-02-07', 'Laki - Laki', 'Islam', 'jl.bintara 11\r\nbintara 11', '081287412180', 'user1@user.com', 'Rekayasa Perangkat Lunak', '2017', 'Bekerja', 'jauh', '424632729_1bed4f7a385149430d20b8e38dd44368.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Akuntansi'),
(2, 'TKJ'),
(3, 'Administrasi Perkantoran'),
(4, 'Jasa Boga'),
(5, 'Multimedia'),
(6, 'Pemasaran'),
(7, 'Rekayasa Perangkat Lunak');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kuisioner`
--

CREATE TABLE `tbl_kuisioner` (
  `id_kuis` int(11) NOT NULL,
  `nis` varchar(25) NOT NULL,
  `p1` varchar(500) NOT NULL,
  `p2` varchar(500) NOT NULL,
  `p3` varchar(500) NOT NULL,
  `p4` varchar(500) NOT NULL,
  `p5` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loker`
--

CREATE TABLE `tbl_loker` (
  `id_loker` varchar(12) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `tgl_bataswaktu` date NOT NULL,
  `instansi` varchar(40) NOT NULL,
  `isi` text NOT NULL,
  `link_web` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_loker`
--

INSERT INTO `tbl_loker` (`id_loker`, `judul`, `tgl_dibuat`, `tgl_bataswaktu`, `instansi`, `isi`, `link_web`, `gambar`) VALUES
('LKR001', 'judul', '2021-06-13', '2021-06-16', 'a', '<p>assda</p>\r\n', 'www.ini.com', '1843184655_2Q==(4).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pertanyaan`
--

CREATE TABLE `tbl_pertanyaan` (
  `id_tanya` int(11) NOT NULL,
  `pertanyaan` varchar(250) NOT NULL,
  `isi1` varchar(250) NOT NULL,
  `isi2` varchar(250) NOT NULL,
  `isi3` varchar(250) NOT NULL,
  `isi4` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` varchar(12) NOT NULL,
  `nama` char(40) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `notlpn` varchar(13) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `alamat`, `notlpn`, `username`, `password`, `status`) VALUES
('A001', 'arif', 'bintara', '0812765341', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
('A002', 'jepri', 'jl.bintara 11\r\nbintara 11', '081287412180', 'admin', '7815696ecbf1c96e6894b779456d330e', 'Kepala Sekolah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_alumni`
--
ALTER TABLE `tbl_alumni`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tbl_loker`
--
ALTER TABLE `tbl_loker`
  ADD PRIMARY KEY (`id_loker`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
