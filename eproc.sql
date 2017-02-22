-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2013 at 11:57 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eproc`
--

-- --------------------------------------------------------

--
-- Table structure for table `ep_fitur`
--

CREATE TABLE IF NOT EXISTS `ep_fitur` (
  `idFitur` int(11) NOT NULL AUTO_INCREMENT,
  `idLelang` int(11) NOT NULL,
  `fitur` varchar(60) NOT NULL,
  PRIMARY KEY (`idFitur`),
  KEY `idLelang` (`idLelang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `ep_fitur`
--

INSERT INTO `ep_fitur` (`idFitur`, `idLelang`, `fitur`) VALUES
(1, 1, 'Tahan Lama'),
(2, 1, 'Tidak Mudah Terbakar'),
(3, 2, 'Tidak Mudah Terbakar'),
(4, 2, 'Whatever'),
(5, 3, 'Gabisa dilompatin maling'),
(6, 4, 'Tidak Mudah Meledak'),
(7, 5, 'Tahan Karat'),
(8, 5, 'Cepat Dingin'),
(9, 5, 'Tidak Mudah Basi'),
(10, 5, 'Hemat Listrik'),
(11, 5, 'Tahan Lama'),
(12, 5, 'Tes Aja'),
(13, 5, 'Gitu'),
(14, 5, 'punya NPWP'),
(15, 5, 'Fiturnya Nambah'),
(16, 5, 'Bisa kan'),
(17, 5, 'Harus bisa nambah Fitur'),
(18, 5, 'Padahal bisa tambah fitur'),
(19, 6, 'Stainless Steel'),
(20, 6, 'Tahan Lama'),
(21, 6, 'Padahal bisa tambah fitur'),
(22, 6, 'Kenapa tambah kualifikasinya ga bisa'),
(23, 6, 'asdf'),
(24, 6, 'Tambahin Fitur '),
(25, 3, 'Tidak Berkarat');

-- --------------------------------------------------------

--
-- Table structure for table `ep_kategori`
--

CREATE TABLE IF NOT EXISTS `ep_kategori` (
  `idKategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(40) NOT NULL,
  PRIMARY KEY (`idKategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ep_kategori`
--

INSERT INTO `ep_kategori` (`idKategori`, `kategori`) VALUES
(1, 'Perlengkapan Dapur'),
(2, 'Furniture'),
(3, 'Dekorasi'),
(4, 'Electronik'),
(5, 'Peralatan Olahraga & Musik'),
(6, 'Perlengkapan Pencahayaan'),
(7, 'Perlengkapan Toilet'),
(8, 'Mebel & Lemari'),
(9, 'Bahan Baku & Material Bangunan'),
(10, 'Jendela, Pintu, & Kusen'),
(11, 'Lantai / Keramik'),
(12, 'Atap / Genteng'),
(13, 'Pagar'),
(14, 'Kebun & Halaman');

-- --------------------------------------------------------

--
-- Table structure for table `ep_kualifikasi`
--

CREATE TABLE IF NOT EXISTS `ep_kualifikasi` (
  `idKualifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `idLelang` int(11) NOT NULL,
  `kualifikasi` text NOT NULL,
  PRIMARY KEY (`idKualifikasi`),
  KEY `idLelang` (`idLelang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `ep_kualifikasi`
--

INSERT INTO `ep_kualifikasi` (`idKualifikasi`, `idLelang`, `kualifikasi`) VALUES
(1, 1, '*Telah melunasi kewajiban pajak tahun terakhir (SPT/PPh) serta memiliki laporan bulanan PPh Pasal 25 atau Pasal 21/Pasal 23 atau PPN sekurangkurangnya 3 (tiga) bulan yang lalu. Bulan Juli, Agustus, september Tahun 2013'),
(2, 1, '* Setiap Barang Impor harus dilampiri scan Letter Of Autorization (L.A) yang masih berlaku dan dilegalisir dari Agen Tunggal'),
(3, 1, '*Surat dukungan agen resmi/ distributor resmi.(Fotocopy surat pengangkatan/ penunjukan sebagai agen/ distributor resmi terhadap jenis produk yang ditawarkan harus dilampirkan) bermaterei 6000'),
(4, 1, '*Surat pernyataan perusahaan yang bersangkutan dan manajemennya atau peserta perorangan, tidak dalam pengawasan pengadilan, tidak bangkrut dan tidak sedang dihentikan kegiatan usahanya'),
(5, 1, '* Surat pernyataan salah satu dan/atau semua pengurus dan badan usahanya atau peserta perorangan tidak masuk dalam Daftar Hitam'),
(6, 1, '* peserta berbentuk badan usaha harus memperoleh paling sedikit 1 (satu) pekerjaan sebagai penyedia dalam kurun waktu 4 (empat) tahun terakhir, baik di lingkungan pemerintah maupun swasta termasuk pengalaman subkontrak, kecuali bagi penyedia yang baru berdiri kurang dari 3 (tiga) tahun;'),
(7, 1, '* persyaratan lainnya sesuai dengan LDP'),
(8, 2, 'Punya NPWP'),
(9, 4, 'Harus Punya NPWP'),
(10, 5, 'Direkturnya Harus Ganteng'),
(11, 6, 'Punya NPWP'),
(12, 6, 'Direkturnya Ganteng'),
(13, 6, 'Ga ada di Blacklist');

-- --------------------------------------------------------

--
-- Table structure for table `ep_lelang`
--

CREATE TABLE IF NOT EXISTS `ep_lelang` (
  `idLelang` int(11) NOT NULL AUTO_INCREMENT,
  `idKategori` int(11) NOT NULL,
  `idPemenang` int(11) DEFAULT NULL,
  `idAdmin` int(11) NOT NULL,
  `idTahap` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `hargaMin` int(11) NOT NULL,
  `hargaMax` int(11) NOT NULL,
  `tanggalPosting` date NOT NULL,
  `tanggalDeadline` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `SIUP` varchar(20) NOT NULL,
  PRIMARY KEY (`idLelang`),
  KEY `idPemenang` (`idPemenang`),
  KEY `idAdmin` (`idAdmin`),
  KEY `idTahap` (`idTahap`),
  KEY `idKategori` (`idKategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ep_lelang`
--

INSERT INTO `ep_lelang` (`idLelang`, `idKategori`, `idPemenang`, `idAdmin`, `idTahap`, `nama`, `hargaMin`, `hargaMax`, `tanggalPosting`, `tanggalDeadline`, `lokasi`, `SIUP`) VALUES
(1, 9, 2, 1, 4, 'Pengadaan Batu Bata', 200000000, 300000000, '2013-11-21', '2013-12-31', 'Malang', 'Perusahaan Kecil'),
(2, 1, 2, 1, 8, 'Pengadaan Kompor', 200000000, 200000000, '2013-11-23', '2013-12-31', 'Malang', 'Perusahaan Non Kecil'),
(3, 13, 2, 1, 12, 'Pagar Dari Besi', 200000000, 250000000, '2013-11-24', '2013-11-23', 'Jombang', 'Perusahaan Non Kecil'),
(4, 1, 4, 1, 15, 'Gas LPG', 100000000, 150000000, '2013-11-24', '2014-01-31', 'Malang', 'Perusahaan Non Kecil'),
(5, 1, 2, 1, 18, 'Kulkas Untuk Semua', 100000000, 100000000, '2013-11-24', '2013-11-30', 'Surabaya', 'Perusahaan Kecil'),
(6, 1, NULL, 1, 21, 'Garpu dan Sendok', 10000000, 10000000, '2013-11-24', '2013-12-31', 'Banyuwangi', 'Perusahaan Kecil'),
(7, 1, NULL, 1, 25, 'Pengadaan Garpu', 200000000, 250000000, '2013-11-28', '2013-12-31', 'Banyuwangi', 'Perusahaan Kecil');

-- --------------------------------------------------------

--
-- Table structure for table `ep_member`
--

CREATE TABLE IF NOT EXISTS `ep_member` (
  `idMember` int(11) NOT NULL AUTO_INCREMENT,
  `idPrioritas` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `avatar` varchar(40) DEFAULT NULL,
  `agency` varchar(40) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `cv` varchar(40) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `tanggalDaftar` date NOT NULL,
  `aktivasi` tinyint(1) DEFAULT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `blacklist` tinyint(1) DEFAULT NULL,
  `alasanBlacklist` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idMember`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `idPrioritas` (`idPrioritas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ep_member`
--

INSERT INTO `ep_member` (`idMember`, `idPrioritas`, `username`, `email`, `password`, `avatar`, `agency`, `alamat`, `cv`, `fax`, `tanggalDaftar`, `aktivasi`, `npwp`, `blacklist`, `alasanBlacklist`) VALUES
(1, 1, 'admin', 'admin@ciputri.com', '21232f297a57a5a743894a0e4a801fc3', 'admin.jpg', 'Ciputri Malang', NULL, NULL, NULL, '2013-11-15', 1, NULL, NULL, NULL),
(2, 2, 'fadeltd', 'fadeltd@hotmail.com', '0523c27e98a9abfd66c42f309a70c176', 'd6TVRdyuGJ.jpg', 'PT MITRA PEMBANGUNAN', 'Bekasi', 'GCFbqRG1qk.pdf', '02199056123', '2013-11-15', 0, '02.682.710.5-542.000', NULL, NULL),
(3, 2, 'indra', 'darkiendra@gmail.com', 'e24f6e3ce19ee0728ff1c443e4ff488d', 'member.jpg', 'PT MAJU KARYA', 'Malang', NULL, '03418856123', '2013-11-15', 0, '02.682.710.5-542.001', NULL, NULL),
(4, 2, 'harim', 'harim@ciputri.com', '044b8e7cc52bce80fe9afd70f8f4d44e', 'member.jpg', 'CV PEMBANGUNAN PEMBAHARUAAN', 'Jakarta', 'AD-ART-2011.doc', '0216214123', '2013-11-15', 0, '02.682.710.5-542.002', NULL, NULL),
(5, 2, 'leon', 'leon@ciputri.com', '5c443b2003676fa5e8966030ce3a86ea', 'member.jpg', 'PT BATU BATA GROUPS', 'Surabaya', NULL, '03317213145', '2013-11-15', 0, '02.682.710.5-542.003', NULL, NULL),
(6, 2, 'atiqo', 'atiqo@ciputri.com', '2935fcd35963d14ae823b2bbb65a414a', 'member.jpg', 'PT SUKA MAJU', 'Jombang', NULL, '03313262645', '2013-11-15', 0, '02.682.710.5-542.004', NULL, NULL),
(7, 2, 'userbaru', 'userbaru@gmail.com', '51b7613b184c2503b6c45670b6140661', 'member.jpg', 'PT SUKA GANTENG', 'Kediri', 'Permohonan-Keringanan-SPP-dan-DBP.doc', '02199056123', '2013-11-23', 0, '02.682.710.5-542.005', NULL, NULL),
(8, 2, 'asdf', 'asdf@asdf.asdf', '912ec803b2ce49e4a541068d495ab570', 'member.jpg', 'asdf', NULL, 'zmMkACTY3h.pdf', 'asdf', '2013-11-26', 0, 'asdf', NULL, NULL),
(9, 2, 'ghjkl', 'ghjkl@ghjkl.ghjkl', '3a8703f560b3768e0277094c58c686e1', 'member.jpg', 'ghjkl', 'Malang', 'Nina-Bobok_NA-NB.pdf', 'ghjkl', '2013-11-26', 0, 'ghjkl', NULL, ''),
(10, 2, 'fadsada', 'asd123@a.c', '6d366f3c2e57ca6fd001ecbd64e653c7', 'member.jpg', 'fadsada', NULL, '', 'fadsada', '2013-11-29', 0, 'fadsada', NULL, NULL),
(11, 2, 'qwerty', 'qwerty@a.a', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'vPnmp70sSz.jpg', 'qwerty', 'qwerty', '', 'qwerty', '2013-11-29', 0, 'qwerty', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ep_namatahap`
--

CREATE TABLE IF NOT EXISTS `ep_namatahap` (
  `idNamaTahap` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`idNamaTahap`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ep_namatahap`
--

INSERT INTO `ep_namatahap` (`idNamaTahap`, `nama`) VALUES
(1, 'Pengajuan Penawaran'),
(2, 'Evaluasi Penawaran & Kualifikasi'),
(3, 'Penetapan dan Pengumuman Pemenang'),
(4, 'Penandatanganan Kontrak');

-- --------------------------------------------------------

--
-- Table structure for table `ep_pesan`
--

CREATE TABLE IF NOT EXISTS `ep_pesan` (
  `idPesan` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `judul` varchar(30) NOT NULL,
  `pesan` text NOT NULL,
  `tanggapan` text,
  `kodeTiket` varchar(10) NOT NULL,
  PRIMARY KEY (`idPesan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ep_pesan`
--

INSERT INTO `ep_pesan` (`idPesan`, `username`, `email`, `tanggal`, `judul`, `pesan`, `tanggapan`, `kodeTiket`) VALUES
(1, 'fadeltd', 'fadeltd@hotmail.com', '2013-11-29', 'Kenapa aku Ganteng?', 'Iya ini semua orang bilangnya aku ganteng', 'makasih loh ya', 'aZ1Bx3l1lk'),
(2, 'indra', 'darkiendra@gmail.com', '2013-11-29', 'tes aja', 'tes 1234', 'uyea', 'GsANdafa51'),
(3, 'fadeltd', 'fadeltd@hotmail.com', '2013-11-29', 'asd', 'tes', NULL, 'Hs6EboJ51w'),
(4, 'asdf', 'asdf@asdf.asdf', '2013-11-29', 'asd', 'asd', NULL, 'rfdoWLGCQ9'),
(5, 'afsa', 'asf', '2013-11-29', 'afasa', 'asffs', NULL, 'fjMtCuhvvi'),
(6, 'teslagi', 'tesasd', '2013-11-29', 'asdf', 'asdf', NULL, 'GI6h4FAClj'),
(7, 'a', 'b', '2013-11-29', 'c', 'd', NULL, 'KzsCYzfKjV');

-- --------------------------------------------------------

--
-- Table structure for table `ep_pesertalelang`
--

CREATE TABLE IF NOT EXISTS `ep_pesertalelang` (
  `idPesertaLelang` int(11) NOT NULL AUTO_INCREMENT,
  `idLelang` int(11) NOT NULL,
  `idMember` int(11) NOT NULL,
  `kualifikasi` tinyint(1) DEFAULT NULL,
  `fitur` int(11) NOT NULL,
  `rating` float DEFAULT NULL,
  `hargaPenawaran` bigint(20) NOT NULL,
  `hargaFix` bigint(20) NOT NULL,
  `pemenang` tinyint(1) DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idPesertaLelang`),
  KEY `idLelang` (`idLelang`),
  KEY `idMember` (`idMember`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ep_pesertalelang`
--

INSERT INTO `ep_pesertalelang` (`idPesertaLelang`, `idLelang`, `idMember`, `kualifikasi`, `fitur`, `rating`, `hargaPenawaran`, `hargaFix`, `pemenang`, `alasan`) VALUES
(1, 1, 2, 1, 0, 0, 200000000, 250000000, 1, 'Direkturnya Ganteng Banget tau ga sih'),
(2, 1, 3, NULL, 0, 0, 250000000, 0, NULL, ''),
(3, 2, 2, 1, 2, 6, 250000000, 250000000, 1, 'Direkturnya Ganteng Banget tau ga sih'),
(4, 2, 7, NULL, 0, 1, 250000000, 0, NULL, ''),
(5, 2, 4, NULL, 0, 3, 250000000, 0, NULL, ''),
(6, 2, 5, NULL, 0, 7, 250000000, 0, NULL, ''),
(7, 3, 2, 1, 1, NULL, 200000000, 250000000, 1, 'Ganteng Banget sumpah'),
(8, 4, 2, NULL, 1, NULL, 100000000, 0, NULL, NULL),
(9, 4, 3, NULL, 1, NULL, 150000000, 0, NULL, NULL),
(10, 4, 4, NULL, 1, 0.5, 150000000, 150000000, 1, 'Ganteng!'),
(11, 5, 2, 1, 12, 12.4, 60000000, 60000000, 1, 'Karena Ganteng'),
(12, 5, 4, NULL, 1, 0.5, 150000000, 0, NULL, NULL),
(13, 5, 5, NULL, 1, 1.1, 90000000, 0, NULL, NULL),
(14, 5, 3, NULL, 6, 8, 80000000, 0, NULL, NULL),
(15, 6, 2, NULL, 6, 11, 5000000, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ep_prioritasmember`
--

CREATE TABLE IF NOT EXISTS `ep_prioritasmember` (
  `idPrioritas` int(11) NOT NULL AUTO_INCREMENT,
  `prioritas` varchar(25) NOT NULL,
  PRIMARY KEY (`idPrioritas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ep_prioritasmember`
--

INSERT INTO `ep_prioritasmember` (`idPrioritas`, `prioritas`) VALUES
(1, 'admin'),
(2, 'member');

-- --------------------------------------------------------

--
-- Table structure for table `ep_tahap`
--

CREATE TABLE IF NOT EXISTS `ep_tahap` (
  `idTahap` int(11) NOT NULL AUTO_INCREMENT,
  `idLelang` int(11) NOT NULL,
  `idNamaTahap` int(11) NOT NULL,
  `tanggalMulai` date NOT NULL,
  `tanggalSelesai` date NOT NULL,
  `historyPerubahan` int(11) NOT NULL,
  PRIMARY KEY (`idTahap`),
  KEY `idLelang` (`idLelang`),
  KEY `idNamaTahap` (`idNamaTahap`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `ep_tahap`
--

INSERT INTO `ep_tahap` (`idTahap`, `idLelang`, `idNamaTahap`, `tanggalMulai`, `tanggalSelesai`, `historyPerubahan`) VALUES
(1, 1, 1, '2013-11-20', '2013-11-28', 0),
(2, 1, 2, '2013-11-21', '2013-11-28', 0),
(3, 1, 3, '2013-11-21', '2013-11-28', 0),
(4, 1, 4, '2013-11-21', '2013-11-28', 0),
(5, 2, 1, '2013-11-23', '2013-11-23', 0),
(6, 2, 2, '2013-11-23', '2013-11-23', 0),
(7, 2, 3, '2013-11-23', '2013-11-23', 0),
(8, 2, 4, '2013-11-23', '2013-11-23', 0),
(9, 3, 1, '2013-11-23', '2013-11-23', 0),
(10, 3, 2, '2013-11-23', '2013-11-23', 0),
(11, 3, 3, '2013-11-23', '2013-11-23', 0),
(12, 3, 4, '2013-11-23', '2013-11-23', 0),
(13, 4, 1, '2013-11-24', '2013-11-24', 0),
(14, 4, 2, '2013-11-24', '2013-11-24', 0),
(15, 4, 3, '2013-11-24', '2013-11-24', 0),
(16, 4, 4, '2013-11-24', '2013-11-24', 0),
(17, 5, 1, '2013-11-24', '2013-11-24', 0),
(18, 5, 2, '2013-11-24', '2013-11-24', 0),
(19, 5, 3, '2013-11-24', '2013-11-24', 0),
(20, 5, 4, '2013-11-24', '2013-11-24', 0),
(21, 6, 1, '2013-11-24', '2013-11-24', 0),
(22, 6, 2, '2013-11-24', '2013-11-24', 0),
(23, 6, 3, '2013-11-24', '2013-11-24', 0),
(24, 6, 4, '2013-11-24', '2013-11-24', 0),
(25, 7, 1, '2013-11-28', '2013-11-28', 0),
(26, 7, 2, '2013-11-28', '2013-11-28', 0),
(27, 7, 3, '2013-11-28', '2013-11-28', 0),
(28, 7, 4, '2013-11-28', '2013-11-28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ep_telp`
--

CREATE TABLE IF NOT EXISTS `ep_telp` (
  `idTelp` int(11) NOT NULL AUTO_INCREMENT,
  `idMember` int(11) NOT NULL,
  `noTelp` varchar(20) NOT NULL,
  PRIMARY KEY (`idTelp`),
  KEY `idMember` (`idMember`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ep_telp`
--

INSERT INTO `ep_telp` (`idTelp`, `idMember`, `noTelp`) VALUES
(1, 2, '08123456789'),
(2, 3, '08123456789'),
(3, 4, '08123456789'),
(4, 5, '08123456789'),
(5, 6, '08123456789'),
(6, 7, '08881234567'),
(7, 7, '034112249'),
(8, 4, '08123456789'),
(9, 3, '08123456789'),
(10, 3, '034112249'),
(11, 11, 'qwerty');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ep_fitur`
--
ALTER TABLE `ep_fitur`
  ADD CONSTRAINT `ep_fitur_ibfk_1` FOREIGN KEY (`idLelang`) REFERENCES `ep_lelang` (`idLelang`);

--
-- Constraints for table `ep_kualifikasi`
--
ALTER TABLE `ep_kualifikasi`
  ADD CONSTRAINT `ep_kualifikasi_ibfk_1` FOREIGN KEY (`idLelang`) REFERENCES `ep_lelang` (`idLelang`);

--
-- Constraints for table `ep_lelang`
--
ALTER TABLE `ep_lelang`
  ADD CONSTRAINT `ep_lelang_ibfk_2` FOREIGN KEY (`idPemenang`) REFERENCES `ep_member` (`idMember`),
  ADD CONSTRAINT `ep_lelang_ibfk_3` FOREIGN KEY (`idAdmin`) REFERENCES `ep_member` (`idMember`),
  ADD CONSTRAINT `ep_lelang_ibfk_4` FOREIGN KEY (`idTahap`) REFERENCES `ep_tahap` (`idTahap`),
  ADD CONSTRAINT `ep_lelang_ibfk_5` FOREIGN KEY (`idKategori`) REFERENCES `ep_kategori` (`idKategori`);

--
-- Constraints for table `ep_member`
--
ALTER TABLE `ep_member`
  ADD CONSTRAINT `ep_member_ibfk_1` FOREIGN KEY (`idPrioritas`) REFERENCES `ep_prioritasmember` (`idPrioritas`);

--
-- Constraints for table `ep_pesertalelang`
--
ALTER TABLE `ep_pesertalelang`
  ADD CONSTRAINT `ep_pesertalelang_ibfk_1` FOREIGN KEY (`idLelang`) REFERENCES `ep_lelang` (`idLelang`),
  ADD CONSTRAINT `ep_pesertalelang_ibfk_2` FOREIGN KEY (`idMember`) REFERENCES `ep_member` (`idMember`);

--
-- Constraints for table `ep_tahap`
--
ALTER TABLE `ep_tahap`
  ADD CONSTRAINT `ep_tahap_ibfk_1` FOREIGN KEY (`idLelang`) REFERENCES `ep_lelang` (`idLelang`),
  ADD CONSTRAINT `ep_tahap_ibfk_2` FOREIGN KEY (`idNamaTahap`) REFERENCES `ep_namatahap` (`idNamaTahap`);

--
-- Constraints for table `ep_telp`
--
ALTER TABLE `ep_telp`
  ADD CONSTRAINT `ep_telp_ibfk_1` FOREIGN KEY (`idMember`) REFERENCES `ep_member` (`idMember`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
