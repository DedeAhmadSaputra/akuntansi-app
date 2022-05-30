-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2014 at 09:32 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `brg_id` int(11) NOT NULL AUTO_INCREMENT,
  `brg_kode` char(5) NOT NULL,
  `brg_nama` varchar(20) DEFAULT NULL,
  `brg_stok` int(11) DEFAULT NULL,
  `jns_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`brg_id`),
  UNIQUE KEY `brg_kode` (`brg_kode`),
  KEY `jns_id` (`jns_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`brg_id`, `brg_kode`, `brg_nama`, `brg_stok`, `jns_id`) VALUES
(1, 'B0001', 'Kertas HVS 70gr', 1884, 1),
(2, 'B0002', 'Ballpoin Faster', 20, 1),
(3, 'B0003', 'Penghapus Steadler', 5995, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengadaan`
--

CREATE TABLE IF NOT EXISTS `detail_pengadaan` (
  `dada_id` int(11) NOT NULL AUTO_INCREMENT,
  `dada_qty` int(11) DEFAULT NULL,
  `brg_id` int(11) NOT NULL,
  `ada_id` int(11) NOT NULL,
  PRIMARY KEY (`dada_id`),
  KEY `brg_id` (`brg_id`),
  KEY `ada_id` (`ada_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `detail_pengadaan`
--

INSERT INTO `detail_pengadaan` (`dada_id`, `dada_qty`, `brg_id`, `ada_id`) VALUES
(1, 1000, 1, 1),
(2, 4000, 2, 1),
(3, 5000, 3, 2),
(4, 500, 2, 1),
(5, 100, 2, 3),
(6, 1000, 1, 4),
(7, 10, 1, 5),
(8, 20, 3, 5),
(9, 20, 2, 6);

--
-- Triggers `detail_pengadaan`
--
DROP TRIGGER IF EXISTS `t_insert_pengadaan`;
DELIMITER //
CREATE TRIGGER `t_insert_pengadaan` AFTER INSERT ON `detail_pengadaan`
 FOR EACH ROW BEGIN
	update barang set brg_stok = brg_stok + new.dada_qty WHERE brg_id = new.brg_id;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_tau`
--

CREATE TABLE IF NOT EXISTS `detail_tau` (
  `dtau_id` int(11) NOT NULL AUTO_INCREMENT,
  `dtau_qty` int(11) DEFAULT NULL,
  `brg_id` int(11) NOT NULL,
  `tau_id` int(11) NOT NULL,
  PRIMARY KEY (`dtau_id`),
  KEY `brg_id` (`brg_id`),
  KEY `tau_id` (`tau_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `detail_tau`
--

INSERT INTO `detail_tau` (`dtau_id`, `dtau_qty`, `brg_id`, `tau_id`) VALUES
(1, 50, 1, 1),
(2, 20, 2, 1),
(3, 15, 3, 2),
(4, 25, 1, 2),
(5, 5, 2, 3),
(6, 10, 3, 4),
(7, 10, 2, 5),
(8, 50, 1, 6);

--
-- Triggers `detail_tau`
--
DROP TRIGGER IF EXISTS `t_insert_tau`;
DELIMITER //
CREATE TRIGGER `t_insert_tau` AFTER INSERT ON `detail_tau`
 FOR EACH ROW BEGIN
	update barang set brg_stok = brg_stok - new.dtau_qty WHERE brg_id = new.brg_id;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jns_brg`
--

CREATE TABLE IF NOT EXISTS `jns_brg` (
  `jns_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `jns_nama` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`jns_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jns_brg`
--

INSERT INTO `jns_brg` (`jns_id`, `jns_nama`) VALUES
(1, 'Alat Tulis Kantor'),
(2, 'Bahan Bangunan');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE IF NOT EXISTS `pengadaan` (
  `ada_id` int(11) NOT NULL AUTO_INCREMENT,
  `ada_nota` char(8) NOT NULL,
  `ada_tgl` date DEFAULT NULL,
  `sup_id` int(11) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`ada_id`),
  UNIQUE KEY `ada_nota` (`ada_nota`),
  KEY `sup_id` (`sup_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`ada_id`, `ada_nota`, `ada_tgl`, `sup_id`, `user_id`) VALUES
(1, 'ADA00001', '2011-02-10', 1, 1),
(2, 'ADA00002', '2011-02-11', 2, 1),
(3, 'ADA00003', '2011-02-11', 1, 1),
(4, 'ADA00004', '2011-02-12', 1, 1),
(5, 'ADA00005', '2013-10-20', 2, 2),
(6, 'ADA00006', '2013-10-20', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplyer`
--

CREATE TABLE IF NOT EXISTS `supplyer` (
  `sup_id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_kode` char(5) NOT NULL,
  `sup_nama` varchar(20) DEFAULT NULL,
  `sup_alamat` varchar(150) DEFAULT NULL,
  `sup_telp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`sup_id`),
  UNIQUE KEY `sup_kode` (`sup_kode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `supplyer`
--

INSERT INTO `supplyer` (`sup_id`, `sup_kode`, `sup_nama`, `sup_alamat`, `sup_telp`) VALUES
(1, 'S0001', 'GRESIK INFORMATIKA S', 'JL. SINDUJOYO IX / 49 GRESIK', '03177770006'),
(2, 'S0002', 'JS-TECHNOLOGY', 'PERUM BANJARSARI BLOK J-17', '087753446386');

-- --------------------------------------------------------

--
-- Table structure for table `tau`
--

CREATE TABLE IF NOT EXISTS `tau` (
  `tau_id` int(11) NOT NULL AUTO_INCREMENT,
  `tau_nota` char(8) NOT NULL,
  `tau_tgl` date DEFAULT NULL,
  `unit_id` tinyint(4) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`tau_id`),
  UNIQUE KEY `tau_nota` (`tau_nota`),
  KEY `unit_id` (`unit_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tau`
--

INSERT INTO `tau` (`tau_id`, `tau_nota`, `tau_tgl`, `unit_id`, `user_id`) VALUES
(1, 'TAU00001', '2011-02-10', 1, 1),
(2, 'TAU00002', '2011-02-10', 2, 1),
(3, 'TAU00003', '2011-02-11', 3, 1),
(4, 'TAU00004', '2011-02-12', 4, 1),
(5, 'TAU00005', '2011-02-13', 2, 1),
(6, 'TAU00006', '2011-02-14', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `unit_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `unit_nama` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_nama`) VALUES
(1, 'PU'),
(2, 'SIMPAN PINJAM'),
(3, 'BANGSISKOM'),
(4, 'SDM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `level` char(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `level`) VALUES
(1, 'juwed', 'e10adc3949ba59abbe56e057f20f883e', '0'),
(2, 'deni', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(3, 'sutaji', 'e10adc3949ba59abbe56e057f20f883e', '2');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pengadaan_per_barang`
--
CREATE TABLE IF NOT EXISTS `v_pengadaan_per_barang` (
`brg_id` int(11)
,`brg_kode` char(5)
,`brg_nama` varchar(20)
,`total_qty` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pengadaan_per_tanggal`
--
CREATE TABLE IF NOT EXISTS `v_pengadaan_per_tanggal` (
`brg_id` int(11)
,`brg_kode` char(5)
,`brg_nama` varchar(20)
,`ada_tgl` date
,`total_qty` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_stok`
--
CREATE TABLE IF NOT EXISTS `v_stok` (
`brg_kode` char(5)
,`brg_nama` varchar(20)
,`stok` decimal(33,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tau_per_barang`
--
CREATE TABLE IF NOT EXISTS `v_tau_per_barang` (
`brg_id` int(11)
,`brg_kode` char(5)
,`brg_nama` varchar(20)
,`total_qty` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tau_per_tanggal`
--
CREATE TABLE IF NOT EXISTS `v_tau_per_tanggal` (
`brg_id` int(11)
,`brg_kode` char(5)
,`brg_nama` varchar(20)
,`tau_tgl` date
,`total_qty` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Structure for view `v_pengadaan_per_barang`
--
DROP TABLE IF EXISTS `v_pengadaan_per_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengadaan_per_barang` AS select `a`.`brg_id` AS `brg_id`,`a`.`brg_kode` AS `brg_kode`,`a`.`brg_nama` AS `brg_nama`,sum(`b`.`dada_qty`) AS `total_qty` from (`barang` `a` join `detail_pengadaan` `b` on((`a`.`brg_id` = `b`.`brg_id`))) group by `a`.`brg_id`;

-- --------------------------------------------------------

--
-- Structure for view `v_pengadaan_per_tanggal`
--
DROP TABLE IF EXISTS `v_pengadaan_per_tanggal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengadaan_per_tanggal` AS select `a`.`brg_id` AS `brg_id`,`a`.`brg_kode` AS `brg_kode`,`a`.`brg_nama` AS `brg_nama`,`c`.`ada_tgl` AS `ada_tgl`,sum(`b`.`dada_qty`) AS `total_qty` from ((`barang` `a` join `detail_pengadaan` `b` on((`a`.`brg_id` = `b`.`brg_id`))) join `pengadaan` `c` on((`b`.`ada_id` = `c`.`ada_id`))) group by `a`.`brg_id`,`c`.`ada_tgl`;

-- --------------------------------------------------------

--
-- Structure for view `v_stok`
--
DROP TABLE IF EXISTS `v_stok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stok` AS select `a`.`brg_kode` AS `brg_kode`,`a`.`brg_nama` AS `brg_nama`,(`a`.`total_qty` - `b`.`total_qty`) AS `stok` from (`v_pengadaan_per_barang` `a` left join `v_tau_per_barang` `b` on((`a`.`brg_id` = `b`.`brg_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_tau_per_barang`
--
DROP TABLE IF EXISTS `v_tau_per_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tau_per_barang` AS select `a`.`brg_id` AS `brg_id`,`a`.`brg_kode` AS `brg_kode`,`a`.`brg_nama` AS `brg_nama`,sum(`b`.`dtau_qty`) AS `total_qty` from (`barang` `a` join `detail_tau` `b` on((`a`.`brg_id` = `b`.`brg_id`))) group by `a`.`brg_id`;

-- --------------------------------------------------------

--
-- Structure for view `v_tau_per_tanggal`
--
DROP TABLE IF EXISTS `v_tau_per_tanggal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tau_per_tanggal` AS select `a`.`brg_id` AS `brg_id`,`a`.`brg_kode` AS `brg_kode`,`a`.`brg_nama` AS `brg_nama`,`c`.`tau_tgl` AS `tau_tgl`,sum(`b`.`dtau_qty`) AS `total_qty` from ((`barang` `a` join `detail_tau` `b` on((`a`.`brg_id` = `b`.`brg_id`))) join `tau` `c` on((`b`.`tau_id` = `c`.`tau_id`))) group by `a`.`brg_id`,`c`.`tau_tgl`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
