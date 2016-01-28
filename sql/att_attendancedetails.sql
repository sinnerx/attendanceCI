-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2016 at 06:18 AM
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
  PRIMARY KEY (`attID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `att_attendancedetails`
--

INSERT INTO `att_attendancedetails` (`managerID`, `clusterID`, `attID`, `managerName`, `siteName`, `activityDate`, `activityTime`, `activityStatus`, `outstationStatus`, `attendanceStatus`, `latLongIn`, `latLongOut`, `imgIn`, `imgOut`) VALUES
(135, 5, 1, 'Nurul Jannah Binti Jamaluddin', 'Felda Bukit Batu', '27-01-2016', ' 11:53', 'IN', '', '', '5.5198736°, 100.4812696°', '', '', ''),
(135, 5, 2, 'Nurul Jannah Binti Jamaluddin', 'Felda Bukit Batu', '27-01-2016', ' 11:53', 'OUT', '', '', '5.5198736°, 100.4812696°', '', '', ''),
(7, 1, 3, 'Rozaime Binti Abd Lahap', 'Kg Kuala, Papar', '27-01-2016', ' 11:54', 'IN', '', '', '5.5198784°, 100.4812750°', '', '', ''),
(7, 1, 4, 'Rozaime Binti Abd Lahap', 'Kg Kuala, Papar', '27-01-2016', ' 11:54', 'OUT', '', '', '5.5198784°, 100.4812750°', '', '', ''),
(167, 0, 5, 'Mrs Nurul Fitriyanie Abdullah', '', '27-01-2016', ' 11:56', 'IN', '', '', '5.5198884°, 100.4812709°', '', '', ''),
(167, 0, 6, 'Mrs Nurul Fitriyanie Abdullah', '', '27-01-2016', ' 11:56', 'OUT', '', '', '5.5198884°, 100.4812709°', '', '', ''),
(167, 1, 7, 'Mrs Nurul Fitriyanie Abdullah', '', '27-01-2016', ' 12:30', 'IN', '', '', '5.5198807°, 100.4812698°', '', '', ''),
(167, 1, 8, 'Mrs Nurul Fitriyanie Abdullah', '', '27-01-2016', ' 12:30', 'OUT', '', '', '5.5198807°, 100.4812698°', '', '', ''),
(134, 5, 9, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '27-01-2016', ' 14:43', 'IN', '', '', '5.5198666°, 100.4812665°', '', '', ''),
(134, 5, 10, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '27-01-2016', ' 14:43', 'OUT', '', '', '5.5198666°, 100.4812665°', '', '', ''),
(167, 1, 11, 'Mrs Nurul Fitriyanie Abdullah', '', '27-01-2016', ' 16:55', 'IN', '', '', '5.5198716°, 100.4812635°', '', '', ''),
(167, 1, 12, 'Mrs Nurul Fitriyanie Abdullah', '', '27-01-2016', ' 16:55', 'OUT', '', '', '5.5198716°, 100.4812635°', '', '', ''),
(23, 1, 13, 'Zurinah Binti Zulkepli', 'Kg Muhibbah, Putatan', '27-01-2016', ' 18:36', 'IN', 'Morning Login', '', '5.5198680°, 100.4812738°', '', '', ''),
(120, 5, 14, 'Arnida Mohd Ali', 'Felda Kahang Barat', '27-01-2016', ' 18:39', 'IN', 'Login ', '', '5.5198710°, 100.4812780°', '', '', ''),
(165, 5, 15, 'Azwary Bin Azmi', 'Felda Rimba Mas', '27-01-2016', ' 18:40', 'IN', 'Evening Login', '', '5.5198700°, 100.4812612°', '', '', ''),
(23, 1, 16, 'Zurinah Binti Zulkepli', 'Kg Muhibbah, Putatan', '27-01-2016', ' 18:41', 'OUT', 'Evening Logout', '', '5.5198738°, 100.4812633°', '', '', ''),
(120, 5, 17, 'Arnida Mohd Ali', 'Felda Kahang Barat', '27-01-2016', ' 18:42', 'OUT', 'Evening Logout', '', '5.5198726°, 100.4812629°', '', '', ''),
(165, 5, 18, 'Azwary Bin Azmi', 'Felda Rimba Mas', '27-01-2016', ' 18:43', 'OUT', 'Goodbye', '', '5.5198604°, 100.4812781°', '', '', ''),
(169, 3, 19, 'Mr Sabarinus Sekunil', '', '27-01-2016', ' 18:46', 'IN', 'Cluster Punch In', '', '5.5198679°, 100.4812789°', '', '', ''),
(170, 5, 20, 'Shamsul bin Jantan', '', '27-01-2016', ' 18:47', 'IN', 'cluster login', '', '5.5198621°, 100.4812749°', '', '', ''),
(189, 6, 21, 'Hairil Hasan', '', '27-01-2016', ' 18:50', 'IN', '', '', '5.5198632°, 100.4812700°', '', '', ''),
(134, 5, 22, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 10:33', 'IN', '', '', '5.5198916°, 100.4812637°', '', '', ''),
(134, 5, 23, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 10:41', 'OUT', '', '', '5.5198740°, 100.4812790°', '', '', ''),
(134, 5, 24, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 10:42', 'IN', '', '', '5.5198735°, 100.4812700°', '', '', ''),
(134, 5, 25, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 10:53', 'OUT', '', '', '5.5198773°, 100.4812843°', '', '', ''),
(134, 5, 26, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 10:54', 'IN', '', '', '5.5198995°, 100.4812705°', '', '', ''),
(134, 5, 27, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 10:55', 'OUT', '', '', '5.5198995°, 100.4812705°', '', '', ''),
(134, 5, 28, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 10:56', 'IN', '', '', '5.5199041°, 100.4812704°', '', '', ''),
(134, 5, 29, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 10:56', 'OUT', '', '', '5.5199041°, 100.4812704°', '', '', ''),
(134, 5, 30, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 10:58', 'IN', '', '', '5.5198932°, 100.4812716°', '', '', ''),
(134, 5, 31, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 10:58', 'OUT', '', '', '5.5198932°, 100.4812716°', '', '', ''),
(134, 5, 32, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:02', 'IN', '', '', '5.5198829°, 100.4812615°', '', '', ''),
(134, 5, 33, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:02', 'OUT', '', '', '5.5198829°, 100.4812615°', '', '', ''),
(134, 5, 34, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:04', 'IN', '', '', '5.5198688°, 100.4812758°', '', '', ''),
(134, 5, 35, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:04', 'OUT', '', '', '5.5198688°, 100.4812758°', '', '', ''),
(134, 5, 36, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:10', 'IN', '', '', '5.5198751°, 100.4812801°', '', '', ''),
(134, 5, 37, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:10', 'OUT', '', '', '5.5198751°, 100.4812803°', '', '', ''),
(134, 5, 38, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:15', 'IN', '', '', '5.5198816°, 100.4812709°', '', '', ''),
(134, 5, 39, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:19', 'OUT', '', '', '5.5198920°, 100.4812733°', '', '', ''),
(134, 5, 40, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:19', 'IN', '', '', '5.5198920°, 100.4812733°', '', '', ''),
(134, 5, 41, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:20', 'OUT', '', '', '5.5198720°, 100.4812859°', '', '', ''),
(134, 5, 42, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:21', 'IN', '', '', '5.5198702°, 100.4812889°', '', '', ''),
(134, 5, 43, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:21', 'OUT', '', '', '5.5198702°, 100.4812889°', '', '', ''),
(134, 5, 44, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:21', 'IN', '', '', '5.5198702°, 100.4812889°', '', '', ''),
(134, 5, 45, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:22', 'OUT', '', '', '5.5198703°, 100.4812796°', '', '', ''),
(134, 5, 46, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:23', 'IN', '', '', '5.5198832°, 100.4812775°', '', '', ''),
(134, 5, 47, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:25', 'OUT', '', '', '5.5198853°, 100.4812981°', '', '', ''),
(134, 5, 48, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:26', 'IN', '', '', '5.5198686°, 100.4812890°', '', '', ''),
(134, 5, 49, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:26', 'OUT', '', '', '5.5198686°, 100.4812890°', '', '', ''),
(134, 5, 50, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:28', 'IN', '', '', '5.5198692°, 100.4812765°', '', '', ''),
(134, 5, 51, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:29', 'OUT', '', '', '5.5198658°, 100.4812725°', '', '', ''),
(134, 5, 52, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:30', 'IN', '', '', '5.5198787°, 100.4812619°', '', '', ''),
(134, 5, 53, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:30', 'OUT', '', '', '5.5198788°, 100.4812625°', '', '', ''),
(134, 5, 54, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:31', 'IN', '', '', '5.5198682°, 100.4812664°', '', '', ''),
(134, 5, 55, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:32', 'OUT', '', '', '5.5198682°, 100.4812664°', '', '', ''),
(134, 5, 56, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:33', 'IN', '', '', '5.5198756°, 100.4812647°', '', '', ''),
(134, 5, 57, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:35', 'OUT', '', '', '5.5198654°, 100.4812724°', '', '', ''),
(134, 5, 58, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 11:35', 'IN', '', '', '5.5198654°, 100.4812724°', '', '', ''),
(134, 5, 59, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:07', 'OUT', '', '', '5.5198884°, 100.4812821°', '', '', ''),
(134, 5, 60, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:08', 'IN', '', '', '5.5198741°, 100.4812725°', '', '', ''),
(134, 5, 61, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:08', 'OUT', '', '', '5.5198741°, 100.4812725°', '', '', ''),
(134, 5, 62, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:12', 'IN', '', '', '5.5198813°, 100.4812588°', '', '', ''),
(134, 5, 63, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:14', 'OUT', '', '', '5.5198744°, 100.4812670°', '', 'images/attendance/28-01-2016-12.48-134-IN.jpg', ''),
(134, 5, 64, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:48', 'IN', '', '', '5.5198672°, 100.4812983°', '', '', ''),
(134, 5, 65, 'Nurul Maliessa Mohd Kamal', 'Felda Bukit Batu', '28-01-2016', ' 12:56', 'OUT', '', '', '5.5198764°, 100.4812786°', '', '', ''),
(197, 0, 66, 'Operation Manager', '', '28-01-2016', ' 12:57', 'IN', '', '', '5.5198731°, 100.4812723°', '', '', ''),
(197, 0, 67, 'Operation Manager', '', '28-01-2016', ' 12:57', 'OUT', '', '', '5.5198731°, 100.4812723°', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
