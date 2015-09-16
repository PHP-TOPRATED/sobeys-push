-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2015 at 11:21 PM
-- Server version: 5.5.40-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mwahchat_sobeys`
--

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(500) CHARACTER SET utf8 NOT NULL,
  `device_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `device_id`, `device_type`) VALUES
(20, '774a953ecfa267f859d052c9d2e11216adf19daf5190fe944f11ba44179e685c', 1),
(23, '897dcc1870ee8ce6fec202c08fcd27e1a32d98a3581ddc720630148dc5e807ca', 1),
(22, 'APA91bENsfLuZ3LoVV4mE7MgNsBNKcMzAvIv-FlhfI_PAEjY0pepjR_xkWLDeXK3hwMO5qOn7lZz2TAN_54B_wI1EVkcGUzHZHSnW6QP786B6-dU7riNWuw', 2),
(17, 'APA91bGtVyPXUnCMgvl8te9pyXMqxhf2TWOPKLr-jnph8HOoEKjEvXmdYRP4Ls0GKrGXqO6LBOm6xoCRSC6O3P4l7pxartdCeV8h3NJwLtRwlBeSKBnr-dk', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
