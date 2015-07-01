-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2015 at 08:45 PM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cryogene`
--

-- --------------------------------------------------------

--
-- Table structure for table `contrato_message`
--

CREATE TABLE IF NOT EXISTS `contrato_message` (
`id_rp` bigint(20) unsigned NOT NULL,
  `rp_contrato` char(8) NOT NULL,
  `rp_status` char(1) NOT NULL,
  `rp_data` int(11) NOT NULL,
  `rp_hora` char(8) NOT NULL,
  `rp_subject` char(150) NOT NULL,
  `rp_texto` text NOT NULL,
  `rp_envio_data` int(11) NOT NULL,
  `rp_envio_hora` char(8) NOT NULL,
  `rp_tipo` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contrato_message`
--
ALTER TABLE `contrato_message`
 ADD UNIQUE KEY `id_rp` (`id_rp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contrato_message`
--
ALTER TABLE `contrato_message`
MODIFY `id_rp` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
