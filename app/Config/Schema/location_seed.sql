-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2015 at 10:27 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pollutantDB`
--

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `Chemical_Readings` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL,
  `location_id` int(5) NOT NULL,
  `reading` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22;

--
-- Dumping data for table `Chemical_Readings`
--

INSERT INTO `Chemical_Readings` (`id`, `time`, `location_id`, `reading`) VALUES
(1, 1427428800, 1, 5.8),
(2, 1427428800, 2, 4.5),
(3, 1427428800, 3, 15.1),
(4, 1427428800, 4, 3.8),
(5, 1427428800, 5, 3.5),
(6, 1427428800, 6, 14.8),
(7, 1427428800, 7, 8.2),
(8, 1427428800, 8, 14.1),
(9, 1427428800, 9, 11.1),
(10, 1427428800, 10, 9),
(11, 1427428800, 11, 1.8),
(12, 1427428800, 12, 0),
(13, 1427428800, 13, 21.6),
(14, 1427428800, 14, 3),
(15, 1427428800, 15, 3.4),
(16, 1427428800, 16, 0.4),
(17, 1427428800, 17, 6.8),
(18, 1427428800, 18, 23.9),
(19, 1427428800, 19, 7.7),
(20, 1427428800, 20, 10),
(21, 1427428800, 21, 13.9),
(22, 1427428800, 22, 16.1);

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE IF NOT EXISTS `Location` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `Location`
--

INSERT INTO `Location` (`id`, `name`, `latitude`, `longitude`) VALUES
(1, 'Abbotsford A Columbia Street', 49.0215, -122.3266),
(2, 'Abbotsford Central', 49.0428, -122.3097),
(3, 'Agassiz Municipal Hall', 49.238, -121.7623),
(5, 'Burnaby Mountain', 49.2797, -122.9222),
(6, 'Burnaby South', 49.2153, -122.9856),
(8, 'Coquitlam Douglas College', 49.2881, -122.7914),
(9, 'Hope Airport', 49.3697, -121.4994),
(10, 'Langley Central', 49.0956, -122.5669),
(11, 'Maple Ridge Golden Ears School', 49.215, -122.5819),
(13, 'North Delta', 49.1583, -122.9017),
(14, 'North Vancouver Mahon Park', 49.3239, -123.0836),
(15, 'North Vancouver Second Narrows', 49.3017, -123.0203),
(16, 'Pitt Meadow Meadowlands School', 49.2453, -122.7089),
(17, 'Port Moody Rocky Point Park', 49.2808, -122.8492),
(18, 'Richmond South', 49.1414, -123.1083),
(19, 'Surrey East', 49.1328, -122.6942),
(20, 'Tsawwassen', 49.0099, -123.082),
(21, 'Vancouver Kitsilano', 49.2617, -123.1633),
(22, 'Vancouver Robson Square', 49.2822, -123.1219);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
