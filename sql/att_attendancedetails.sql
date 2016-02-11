-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2016 at 06:47 PM
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
  `siteName` text NOT NULL,
  `activityDate` varchar(20) NOT NULL,
  `activityTime` varchar(20) NOT NULL,
  `activityStatus` text NOT NULL,
  `outstationStatus` text NOT NULL,
  `attendanceStatus` text NOT NULL,
  `latLongIn` varchar(255) NOT NULL,
  `latLongOut` varchar(255) NOT NULL,
  `imgIn` varchar(255) NOT NULL,
  `imgOut` varchar(255) NOT NULL,
  `hours` int(11) NOT NULL,
  `lateIn` int(11) NOT NULL,
  `earlyOut` int(11) NOT NULL,
  `anomaly` int(11) NOT NULL,
  PRIMARY KEY (`attID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `att_attendancedetails`
--

INSERT INTO `att_attendancedetails` (`managerID`, `clusterID`, `attID`, `managerName`, `siteName`, `activityDate`, `activityTime`, `activityStatus`, `outstationStatus`, `attendanceStatus`, `latLongIn`, `latLongOut`, `imgIn`, `imgOut`, `hours`, `lateIn`, `earlyOut`, `anomaly`) VALUES
(134, 5, 38, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:15', 'IN', '', '', '5.5198816, 100.4812709', '', '', '', 0, 0, 0, 0),
(134, 5, 39, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:19', 'OUT', '', '', '5.5198920, 100.4812733', '', '', '', 0, 0, 0, 0),
(134, 5, 40, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:19', 'IN', '', '', '5.5198920, 100.4812733', '', '', '', 0, 0, 0, 0),
(134, 5, 41, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:20', 'OUT', '', '', '5.5198720, 100.4812859', '', '', '', 0, 0, 0, 0),
(134, 5, 42, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:21', 'IN', '', '', '5.5198702, 100.4812889', '', '', '', 0, 0, 0, 0),
(134, 5, 43, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:21', 'OUT', '', '', '5.5198702, 100.4812889', '', '', '', 0, 0, 0, 0),
(134, 5, 44, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:21', 'IN', '', '', '5.5198702, 100.4812889', '', '', '', 0, 0, 0, 0),
(134, 5, 45, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:22', 'OUT', '', '', '5.5198703, 100.4812796', '', '', '', 0, 0, 0, 0),
(134, 5, 46, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:23', 'IN', '', '', '5.5198832, 100.4812775', '', '', '', 0, 0, 0, 0),
(134, 5, 47, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:25', 'OUT', '', '', '5.5198853, 100.4812981', '', '', '', 0, 0, 0, 0),
(134, 5, 48, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:26', 'IN', '', '', '5.5198686, 100.4812890', '', '', '', 0, 0, 0, 0),
(134, 5, 49, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:26', 'OUT', '', '', '5.5198686, 100.4812890', '', '', '', 0, 0, 0, 0),
(134, 5, 50, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:28', 'IN', '', '', '5.5198692, 100.4812765', '', '', '', 0, 0, 0, 0),
(134, 5, 51, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:29', 'OUT', '', '', '5.5198658, 100.4812725', '', '', '', 0, 0, 0, 0),
(134, 5, 52, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:30', 'IN', '', '', '5.5198787, 100.4812619', '', '', '', 0, 0, 0, 0),
(134, 5, 53, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:30', 'OUT', '', '', '5.5198788, 100.4812625', '', '', '', 0, 0, 0, 0),
(134, 5, 54, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:31', 'IN', '', '', '5.5198682, 100.4812664', '', '', '', 0, 0, 0, 0),
(134, 5, 55, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:32', 'OUT', '', '', '5.5198682, 100.4812664', '', '', '', 0, 0, 0, 0),
(134, 5, 56, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:33', 'IN', '', '', '5.5198756, 100.4812647', '', '', '', 0, 0, 0, 0),
(134, 5, 57, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:35', 'OUT', '', '', '5.5198654, 100.4812724', '', '', '', 0, 0, 0, 0),
(134, 5, 58, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:35', 'IN', '', '', '5.5198654, 100.4812724', '', '', '', 0, 0, 0, 0),
(134, 5, 59, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:07', 'OUT', '', '', '5.5198884, 100.4812821', '', '', '', 0, 0, 0, 0),
(134, 5, 60, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:08', 'IN', '', '', '5.5198741, 100.4812725', '', '', '', 0, 0, 0, 0),
(134, 5, 61, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:08', 'OUT', '', '', '5.5198741, 100.4812725', '', '', '', 0, 0, 0, 0),
(134, 5, 62, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:12', 'IN', '', '', '5.5198813, 100.4812588', '', '', '', 0, 0, 0, 0),
(134, 5, 63, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:14', 'OUT', '', '', '5.5198744, 100.4812670', '', 'images/attendance/28-01-2016-12.48-134-IN.jpg', '', 0, 0, 0, 0),
(134, 5, 64, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:48', 'IN', '', '', '5.5198672, 100.4812983', '', '', '', 0, 0, 0, 0),
(134, 5, 65, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:56', 'OUT', '', '', '5.5198764, 100.4812786', '', '', '', 0, 0, 0, 0),
(197, 0, 66, 'Operation Manager', '', '28-01-2016', ' 12:57', 'IN', '', '', '5.5198731, 100.4812723', '', '', '', 0, 0, 0, 0),
(197, 0, 67, 'Operation Manager', '', '28-01-2016', ' 12:57', 'OUT', '', '', '5.5198731, 100.4812723', '', '', '', 0, 0, 0, 0),
(134, 5, 68, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '29-01-2016', ' 10:49', 'IN', '', '', '5.5198762°, 100.4812698°', '', '', '', 0, 0, 0, 0),
(197, 0, 69, 'Operation Manager', '', '29-01-2016', ' 19:30', 'IN', '', '', '5.5198692, 100.4812795', '', '', '', 0, 0, 0, 0),
(134, 5, 70, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '30-01-2016', ' 10:27', 'OUT', '', '', '5.5198700, 100.4812880', '', '', '', 0, 0, 0, 0),
(134, 5, 71, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '30-01-2016', ' 10:43', 'IN', '', '', '5.5198716, 100.4812763', '', '', '', 0, 0, 0, 0),
(134, 5, 72, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '30-01-2016', ' 10:43', 'OUT', '', '', '5.5198716, 100.4812763', '', '', '', 0, 0, 0, 0),
(134, 5, 73, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '30-01-2016', ' 10:44', 'IN', '', '', '5.5198716, 100.4812763', '', '', '', 0, 0, 0, 0),
(134, 5, 74, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '30-01-2016', ' 10:45', 'OUT', '', '', '5.5198716, 100.4812763', '', '', '', 0, 0, 0, 0),
(167, 1, 75, 'Mrs Nurul Fitriyanie Abdullah', '', '30-01-2016', ' 10:47', 'IN', '', '', '5.5198715, 100.4812865', '', '', '', 0, 0, 0, 0),
(167, 1, 76, 'Mrs Nurul Fitriyanie Abdullah', '', '30-01-2016', ' 10:47', 'OUT', '', '', '5.5198715, 100.4812865', '', '', '', 0, 0, 0, 0),
(134, 5, 78, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '30-01-2016', ' 11:02', 'IN', '', '', '5.5198696, 100.4812807', '', '', '', 0, 0, 0, 0),
(134, 5, 79, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '30-01-2016', ' 11:04', 'OUT', '', '', '5.5198761, 100.4812810', '', '', '', 0, 0, 0, 0),
(167, 1, 86, 'Mrs Nurul Fitriyanie Abdullah', '', '30-01-2016', ' 11:38', 'IN', '', '', '5.5198723, 100.4812744', '', 'images/attendance/30-01-2016-11.38-167-IN.jpg', '', 0, 0, 0, 0),
(197, 0, 88, 'Operation Manager', '', '29-01-2016', ' 15:44', 'OUT', '', '', '5.5198738, 100.4812616', '', 'images/attendance/30-01-2016-15.44-197-OUT.jpg', '', 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
