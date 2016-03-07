-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2016 at 12:23 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `digitalgaia_iris`
--

-- --------------------------------------------------------

--
-- Table structure for table `att_attendancedetails`
--

CREATE TABLE IF NOT EXISTS `att_attendancedetails` (
  `managerID` int(11) NOT NULL,
  `clusterID` int(11) NOT NULL,
  `attID` int(11) NOT NULL AUTO_INCREMENT,
  `managerName` text NOT NULL,
  `siteID` int(11) NOT NULL,
  `siteName` text NOT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `activityDate` varchar(20) DEFAULT NULL,
  `activityTime` varchar(20) NOT NULL,
  `activityDateTime` datetime DEFAULT NULL,
  `activityStatus` text NOT NULL,
  `outstationStatus` text NOT NULL,
  `attendanceStatus` text NOT NULL,
  `latLongIn` varchar(255) NOT NULL,
  `latLongOut` varchar(255) NOT NULL,
  `accuracy` double NOT NULL,
  `imgIn` varchar(255) NOT NULL,
  `imgOut` varchar(255) NOT NULL,
  `hours` float DEFAULT '0',
  `lateIn` int(11) NOT NULL,
  `earlyOut` int(11) NOT NULL,
  `anomaly` int(11) NOT NULL,
  PRIMARY KEY (`attID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=201 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
