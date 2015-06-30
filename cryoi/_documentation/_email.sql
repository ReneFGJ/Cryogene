-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2015 at 09:46 PM
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
-- Table structure for table `_email`
--

CREATE TABLE IF NOT EXISTS `_email` (
  `id_ma` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ma_email` text NOT NULL,
  `ma_assunto` char(100) NOT NULL,
  `ma_texto` text,
  `ma_data` int(11) NOT NULL,
  `ma_hora` char(8) NOT NULL,
  `ma_status` char(1) NOT NULL,
  `ma_ip` char(15) NOT NULL,
  `ma_conta` char(3) NOT NULL,
  `ma_enviado` int(11) NOT NULL,
  `ma_enviado_hora` char(8) NOT NULL,
  `ma_hed` text NOT NULL,
  `ma_contrato` char(8) NOT NULL,
  UNIQUE KEY `id_ma` (`id_ma`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
