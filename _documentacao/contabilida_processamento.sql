-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2015 at 12:54 PM
-- Server version: 5.6.23
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cryogene_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `contabilida_processamento`
--

CREATE TABLE IF NOT EXISTS `contabilida_processamento` (
  `id_pr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pr_tabela` char(50) NOT NULL,
  `pr_base` char(30) NOT NULL,
  `pr_field_total` char(30) NOT NULL,
  `pr_field_filter` char(30) NOT NULL,
  `pr_data_format` char(10) NOT NULL,
  `pr_cc_debito` char(15) NOT NULL,
  `pr_cc_credito` char(15) NOT NULL,
  UNIQUE KEY `id_pr` (`id_pr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
