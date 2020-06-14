-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2018 at 07:21 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `potongan_rplxi1`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(40) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `harga_awal` int(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `jenis_barang`, `merek`, `harga_awal`, `stok`, `keterangan`) VALUES
('B0001', 'Handphone', 'Elektronik', 'ASUS', 50000, 10, 'Bagus'),
('B0002', 'Laptop', 'Elektronik', 'ACER', 100000, 20, 'Bagus');

-- --------------------------------------------------------

--
-- Stand-in structure for view `diskon`
-- (See below for the actual view)
--
CREATE TABLE `diskon` (
`kode_potongan` varchar(40)
,`kode_barang` varchar(40)
,`nama_barang` varchar(100)
,`periode_diskon_mulai` date
,`periode_diskon_akhir` date
,`harga_awal` int(50)
,`harga_setelah_diskon` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `potongan`
--

CREATE TABLE `potongan` (
  `kode_potongan` varchar(40) NOT NULL,
  `kode_barang` varchar(40) NOT NULL,
  `periode_diskon_mulai` date NOT NULL,
  `periode_diskon_akhir` date NOT NULL,
  `besar_diskon` int(11) NOT NULL,
  `harga_setelah_diskon` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `potongan`
--

INSERT INTO `potongan` (`kode_potongan`, `kode_barang`, `periode_diskon_mulai`, `periode_diskon_akhir`, `besar_diskon`, `harga_setelah_diskon`, `keterangan`) VALUES
('P0002', 'B0002', '2018-05-19', '2018-05-19', 10, 90000, 'jakndaksjnasdn'),
('P0003', 'B0002', '2018-05-10', '2018-05-31', 10, 90000, 'kjasndkjnaskdnjasd'),
('P0004', 'B0001', '2018-05-19', '2018-05-25', 100, 0, 'ahsbdjha'),
('P0005', 'B0001', '2018-05-30', '2018-05-10', 90, 5000, 'asnkdjasnkjdn'),
('P0006', 'B0001', '2018-05-17', '2018-05-24', 90, 5000, 'asdjas'),
('P0007', 'B0001', '2018-05-10', '2018-05-22', 10, 45000, 'Nanananananaan'),
('P0008', 'B0001', '2018-05-19', '2018-05-21', 50, 25000, 'Diskon Promo 1!'),
('P0009', 'B0002', '2018-05-22', '2018-05-14', 30, 70000, 'Promo');

-- --------------------------------------------------------

--
-- Structure for view `diskon`
--
DROP TABLE IF EXISTS `diskon`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `diskon`  AS  select `potongan`.`kode_potongan` AS `kode_potongan`,`barang`.`kode_barang` AS `kode_barang`,`barang`.`nama_barang` AS `nama_barang`,`potongan`.`periode_diskon_mulai` AS `periode_diskon_mulai`,`potongan`.`periode_diskon_akhir` AS `periode_diskon_akhir`,`barang`.`harga_awal` AS `harga_awal`,`potongan`.`harga_setelah_diskon` AS `harga_setelah_diskon` from (`potongan` join `barang` on((`potongan`.`kode_barang` = `barang`.`kode_barang`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `potongan`
--
ALTER TABLE `potongan`
  ADD PRIMARY KEY (`kode_potongan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
