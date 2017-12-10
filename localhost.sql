-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2017 at 09:15 PM
-- Server version: 5.5.57-MariaDB-1ubuntu0.14.04.1
-- PHP Version: 7.0.23-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_alfamart`
--
CREATE DATABASE IF NOT EXISTS `db_alfamart` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_alfamart`;

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `check_login`(`user_name` VARCHAR(20), `user_pass` VARCHAR(30)) RETURNS tinyint(4)
    DETERMINISTIC
    COMMENT 'Check username and password entered by user'
BEGIN
DECLARE username_found TINYINT;
DECLARE password_correct TINYINT;

SELECT COUNT(*) INTO username_found FROM pengguna WHERE username = user_name;
SELECT COUNT(*) INTO password_correct FROM pengguna
	WHERE username = user_name AND password = user_pass;

return username_found + password_correct;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `jumlah_barangbelian`(`kode` INT) RETURNS tinyint(4)
    NO SQL
    COMMENT 'Hasilkan jumlah barang yang dibeli dengan kode transaksi tertent'
BEGIN
DECLARE total_jumlah TINYINT;

SELECT SUM(jumlah) INTO total_jumlah FROM barang_belian WHERE kd_transaksi = kode;

return total_jumlah;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_belian`
--

CREATE TABLE IF NOT EXISTS `barang_belian` (
  `kd_transaksi` int(11) NOT NULL,
  `kd_barang_belian` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah` tinyint(4) NOT NULL,
  `kd_produk` varchar(8) NOT NULL,
  PRIMARY KEY (`kd_barang_belian`),
  KEY `kd_transaksi` (`kd_transaksi`,`kd_produk`),
  KEY `kd_produk` (`kd_produk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `barang_belian`
--

INSERT INTO `barang_belian` (`kd_transaksi`, `kd_barang_belian`, `jumlah`, `kd_produk`) VALUES
(20, 8, 2, 'D124'),
(20, 9, 1, 'C333'),
(29, 10, 2, 'G158');

-- --------------------------------------------------------

--
-- Table structure for table `no_telp`
--

CREATE TABLE IF NOT EXISTS `no_telp` (
  `no_telp` varchar(15) NOT NULL,
  `id_member` int(11) NOT NULL,
  PRIMARY KEY (`no_telp`),
  KEY `id_member` (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(35) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_member`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `alamat`) VALUES
(999, '', '0000-00-00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `tipe_akun` enum('admin','kasir','gudang','manager') NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `tipe_akun`) VALUES
('iqbal', 'iqbal', 'gudang'),
('kurniawan', 'kurniawan', 'manager'),
('ratna', 'ratna', 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `petugas_gudang`
--

CREATE TABLE IF NOT EXISTS `petugas_gudang` (
  `no_ktp` varchar(18) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `jalan` varchar(40) NOT NULL,
  `no_rumah` varchar(3) NOT NULL,
  `RT` varchar(2) NOT NULL,
  `RW` varchar(2) NOT NULL,
  `akun_username` varchar(20) NOT NULL,
  PRIMARY KEY (`no_ktp`),
  KEY `akun_username` (`akun_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas_gudang`
--

INSERT INTO `petugas_gudang` (`no_ktp`, `nama`, `jalan`, `no_rumah`, `RT`, `RW`, `akun_username`) VALUES
('555111333', 'Ratna Sukmawati', 'Jl Margahayu', '12', '02', '03', 'iqbal');

-- --------------------------------------------------------

--
-- Table structure for table `petugas_kasir`
--

CREATE TABLE IF NOT EXISTS `petugas_kasir` (
  `no_ktp` varchar(18) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `jalan` varchar(40) NOT NULL,
  `no_rumah` varchar(3) NOT NULL,
  `RT` varchar(2) NOT NULL,
  `RW` varchar(2) NOT NULL,
  `akun_username` varchar(20) NOT NULL,
  PRIMARY KEY (`no_ktp`),
  KEY `akun_username` (`akun_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas_kasir`
--

INSERT INTO `petugas_kasir` (`no_ktp`, `nama`, `jalan`, `no_rumah`, `RT`, `RW`, `akun_username`) VALUES
('555111333', 'Ratna Sukmawati', 'Jl Margahayu', '12', '02', '03', 'ratna');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `kd_produk` varchar(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `produsen` varchar(20) NOT NULL,
  `sertifikat_MUI` varchar(15) NOT NULL,
  `sertifikat_BPOM` varchar(15) NOT NULL,
  `harga` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`kd_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kd_produk`, `nama`, `produsen`, `sertifikat_MUI`, `sertifikat_BPOM`, `harga`) VALUES
('C333', 'Indomie Goreng Soto', 'PT. Indofood', '9178514', '8730895', 1500),
('C334', 'Indomie Goreng Rendang', 'PT. Indofood', '765141987', '157195157', 2000),
('C335', 'Indomie Goreng', 'PT. Indofood', '816558937', '75915792', 1500),
('D1234567', 'Serena Cookies', 'PT. Serena', '0198357', '817598', 5000),
('D124', 'Beng Beng', 'PT. Wings Food', '15792857', '21251553', 1000),
('D125', 'Beng Beng Max', 'PT. Wings Food', '767815358', '887015353', 2000),
('G158', 'Sabun Lifebouy', 'PT. Healty Care', '38758900', '98739575', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `kd_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(35) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_supplier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kd_supplier`, `nama`, `alamat`) VALUES
(1, 'PT. Wings Food', 'Jl Jakarta No.45'),
(2, 'Agen Makanan Bogor', 'Jl Puncak No.12'),
(3, 'PT. Indofood', 'Jl Subang No.22');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_produk`
--

CREATE TABLE IF NOT EXISTS `supplier_produk` (
  `kd_supplier_produk` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_supplai` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `no_ktp` varchar(18) DEFAULT NULL,
  `kd_produk` varchar(8) DEFAULT NULL,
  `kd_supplier` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_supplier_produk`),
  KEY `no_ktp` (`no_ktp`,`kd_produk`,`kd_supplier`),
  KEY `kd_produk` (`kd_produk`),
  KEY `kd_supplier` (`kd_supplier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `supplier_produk`
--

INSERT INTO `supplier_produk` (`kd_supplier_produk`, `tanggal_supplai`, `jumlah`, `no_ktp`, `kd_produk`, `kd_supplier`) VALUES
(2, '2017-12-09', 2, '555111333', 'D124', 1),
(3, '2017-12-09', 3, '555111333', 'D124', 2),
(4, '2017-12-09', 4, '555111333', 'D124', 1),
(5, '2017-12-09', 5, '555111333', 'D124', 1),
(6, '2017-12-09', 6, '555111333', 'D124', 1),
(7, '2017-12-09', 7, '555111333', 'D124', 1),
(8, '2017-12-10', 500, '555111333', 'C335', 3);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `kd_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `no_ktp` varchar(18) DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_transaksi`),
  KEY `no_ktp` (`no_ktp`,`id_member`),
  KEY `id_member` (`id_member`),
  KEY `no_ktp_2` (`no_ktp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kd_transaksi`, `tanggal`, `no_ktp`, `id_member`) VALUES
(18, '2017-12-10', '555111333', 999),
(20, '2017-12-10', '555111333', 999),
(21, '2017-12-10', '555111333', 999),
(22, '2017-12-10', '555111333', 999),
(23, '2017-12-10', '555111333', 999),
(24, '2017-12-10', '555111333', 999),
(25, '2017-12-10', '555111333', 999),
(27, '2017-12-10', '555111333', 999),
(29, '2017-12-10', '555111333', 999);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembayaran`
--

CREATE TABLE IF NOT EXISTS `transaksi_pembayaran` (
  `kd_transaksi` int(11) NOT NULL,
  `biaya_admin` int(11) NOT NULL,
  `biaya_tagihan` int(11) NOT NULL,
  `jenis_pembayaran` enum('online','listrik') NOT NULL,
  `id_pelanggan_PLN` varchar(15) NOT NULL,
  `no_tagihan` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_pembayaran`
--

INSERT INTO `transaksi_pembayaran` (`kd_transaksi`, `biaya_admin`, `biaya_tagihan`, `jenis_pembayaran`, `id_pelanggan_PLN`, `no_tagihan`) VALUES
(18, 10000, 200000, 'listrik', '555555', ''),
(21, 5000, 80000, 'online', '', '1111111'),
(22, 2000, 100000, 'listrik', '22222222', ''),
(23, 2000, 100000, 'listrik', '22222222', ''),
(24, 2000, 200000, 'listrik', '22222222', ''),
(25, 2000, 200000, 'listrik', '22222222', ''),
(27, 2000, 200000, 'listrik', '22222222', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembelian`
--

CREATE TABLE IF NOT EXISTS `transaksi_pembelian` (
  `kd_transaksi` int(11) NOT NULL,
  PRIMARY KEY (`kd_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_pembelian`
--

INSERT INTO `transaksi_pembelian` (`kd_transaksi`) VALUES
(20),
(29);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_belian`
--
ALTER TABLE `barang_belian`
  ADD CONSTRAINT `barang_belian_ibfk_1` FOREIGN KEY (`kd_transaksi`) REFERENCES `transaksi` (`kd_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_belian_ibfk_2` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `no_telp`
--
ALTER TABLE `no_telp`
  ADD CONSTRAINT `no_telp_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `pelanggan` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier_produk`
--
ALTER TABLE `supplier_produk`
  ADD CONSTRAINT `supplier_produk_ibfk_1` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_produk_ibfk_2` FOREIGN KEY (`kd_supplier`) REFERENCES `supplier` (`kd_supplier`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_produk_ibfk_3` FOREIGN KEY (`no_ktp`) REFERENCES `petugas_gudang` (`no_ktp`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `pelanggan` (`id_member`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`no_ktp`) REFERENCES `petugas_kasir` (`no_ktp`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD CONSTRAINT `transaksi_pembayaran_ibfk_1` FOREIGN KEY (`kd_transaksi`) REFERENCES `transaksi` (`kd_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD CONSTRAINT `transaksi_pembelian_ibfk_1` FOREIGN KEY (`kd_transaksi`) REFERENCES `transaksi` (`kd_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
