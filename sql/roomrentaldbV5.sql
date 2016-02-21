-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2016 at 04:40 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `roomrentaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `FirstName`, `LastName`, `UserName`, `Password`, `type`) VALUES
(1, 'User', 'Admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

DROP TABLE IF EXISTS `tblbooking`;
CREATE TABLE IF NOT EXISTS `tblbooking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenantID` int(11) NOT NULL,
  `travelID` int(11) NOT NULL,
  `checkin` datetime(6) DEFAULT NULL,
  `checkOut` datetime(6) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `tenantID`, `travelID`, `checkin`, `checkOut`, `updated_at`, `created_at`, `price`) VALUES
(46, 4, 0, '2016-02-21 18:24:00.000000', '2016-02-24 18:24:00.000000', '2016-02-21 14:57:02', '2016-02-21 14:57:02', 6000);

-- --------------------------------------------------------

--
-- Table structure for table `tblbookingpackage`
--

DROP TABLE IF EXISTS `tblbookingpackage`;
CREATE TABLE IF NOT EXISTS `tblbookingpackage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblbookingpackage`
--

INSERT INTO `tblbookingpackage` (`id`, `booking_id`, `package_id`, `updated_at`, `created_at`) VALUES
(1, 46, 3, '2016-02-21 14:57:02', '2016-02-21 14:57:02'),
(2, 46, 4, '2016-02-21 14:57:02', '2016-02-21 14:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `tblbuilding`
--

DROP TABLE IF EXISTS `tblbuilding`;
CREATE TABLE IF NOT EXISTS `tblbuilding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buildingLocation` varchar(200) DEFAULT NULL,
  `buildingCatID` int(11) NOT NULL,
  `landlordID` int(11) NOT NULL,
  `desc` text NOT NULL,
  `image` text NOT NULL,
  `buildingName` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `tblbuilding`
--

INSERT INTO `tblbuilding` (`id`, `buildingLocation`, `buildingCatID`, `landlordID`, `desc`, `image`, `buildingName`, `updated_at`, `created_at`, `longitude`, `lattitude`) VALUES
(8, 'as', 5, 2, 'sa', '98141.jpg', 'sa', '2015-10-11 12:33:31', '2015-10-11 12:33:31', '57.55\r\n', '-20.2833'),
(9, 'Grand Baie', 1, 1, 'Grand bay beach', '98141.jpg', 'building2', '2015-10-11 14:23:30', '2015-10-11 14:23:30', '', ''),
(12, 'Grand Baie', 5, 3, 'Peacefully', '93644.jpg', 'Couple suite', '2015-12-02 05:55:24', '2015-12-02 05:49:58', '57.5992339', '-19.9894524'),
(13, 'Grand Baie', 3, 3, 'best ', '23570.jpg', 'coco', '2015-12-07 07:57:38', '2015-12-07 07:57:38', '57.55', '-20.2833'),
(14, 'dasdas', 1, 4, 'sadsa', '98141.jpg', 'sasd', '2016-01-26 09:03:05', '2016-01-26 09:03:05', '57.6620213', '-20.0128964'),
(15, 'MorcellementSaintAndre', 7, 2, 'Basdeo house is in MSA', '21424.jpg', 'BasdeoHouse', '2016-02-01 16:29:36', '2016-02-01 16:29:36', '', ''),
(16, 'MorcellementStAndre', 2, 2, 'MorcellementStAndre', '88224.jpeg', 'BasdeoBungalow', '2016-02-01 16:30:47', '2016-02-01 16:30:47', '', ''),
(21, 'BainBoeuf', 3, 3, 'Pied Dans L`eau.', '93679.jpg', 'BainBoeufAppartment', '2016-02-07 20:02:30', '2016-02-07 20:02:30', '57.60533010587096', '-19.986113997686154'),
(22, 'Morcellement', 1, 3, 'sad', '98141.jpg', 'asd', '2016-02-13 16:21:08', '2016-02-13 16:21:08', '57.75364637374878', '-20.271215021837108'),
(32, 'sa', 11, 3, 'sa', '22344.jpg', 'saas', '2016-02-17 08:09:56', '2016-02-17 08:09:56', '56.96938991546631', '-20.30856929689618'),
(35, 'sa', 1, 3, 'assa', '63159.jpg', 'asas', '2016-02-17 08:10:59', '2016-02-17 08:10:59', '57.72195339202881', '-20.17456745043183'),
(36, 'Triolet', 2, 3, 'very nice', '77682.jpg', 'Coconut', '2016-02-18 08:57:06', '2016-02-18 08:57:06', '57.60533094406128', '-20.003031854711356');

-- --------------------------------------------------------

--
-- Table structure for table `tblbuildingcat`
--

DROP TABLE IF EXISTS `tblbuildingcat`;
CREATE TABLE IF NOT EXISTS `tblbuildingcat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buildingCatName` varchar(100) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tblbuildingcat`
--

INSERT INTO `tblbuildingcat` (`id`, `buildingCatName`, `updated_at`, `created_at`) VALUES
(1, 'Hotel', NULL, NULL),
(2, 'Bungalow', NULL, NULL),
(3, 'Appartment', NULL, NULL),
(4, 'Commercial Building', '2016-02-10 18:02:58.000000', NULL),
(5, 'Villa', '2016-02-10 18:05:32.000000', NULL),
(6, 'Penthouse', '2016-02-10 18:01:18.000000', NULL),
(7, 'House', NULL, NULL),
(11, 'Villasa', '2016-02-10 17:34:50.000000', '2016-02-10 17:34:50.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tblbuildingfacility`
--

DROP TABLE IF EXISTS `tblbuildingfacility`;
CREATE TABLE IF NOT EXISTS `tblbuildingfacility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buildingid` int(11) DEFAULT NULL,
  `facilityid` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tblbuildingfacility`
--

INSERT INTO `tblbuildingfacility` (`id`, `buildingid`, `facilityid`, `updated_at`, `created_at`) VALUES
(15, 13, 9, '2016-02-14 16:42:38', '2016-02-14 16:42:38'),
(16, 13, 10, '2016-02-14 16:42:38', '2016-02-14 16:42:38'),
(17, 13, 11, '2016-02-14 16:42:38', '2016-02-14 16:42:38'),
(18, 13, 9, '2016-02-17 08:08:27', '2016-02-17 08:08:27'),
(19, 32, 9, '2016-02-17 08:08:27', '2016-02-17 08:08:27'),
(20, 32, 10, '2016-02-17 08:10:02', '2016-02-17 08:10:02'),
(21, 32, 10, '2016-02-17 08:10:03', '2016-02-17 08:10:03'),
(22, 35, 10, '2016-02-17 08:10:59', '2016-02-17 08:10:59'),
(24, 21, 9, '2016-02-18 09:08:11', '2016-02-18 09:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `tblfacility`
--

DROP TABLE IF EXISTS `tblfacility`;
CREATE TABLE IF NOT EXISTS `tblfacility` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tblfacility`
--

INSERT INTO `tblfacility` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(9, 'wifi', 'room', '2016-02-14 00:00:00.000000', '2016-02-14 00:00:00.000000'),
(10, 'meal', 'room', '2016-02-14 00:00:00.000000', '2016-02-14 00:00:00.000000'),
(11, 'Parking', 'Space', '2016-02-14 09:29:38.000000', '2016-02-14 09:29:57.000000'),
(12, 'AC', 'Room', '2016-02-18 09:13:26.000000', '2016-02-18 09:13:26.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbllandlord`
--

DROP TABLE IF EXISTS `tbllandlord`;
CREATE TABLE IF NOT EXISTS `tbllandlord` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Password` varchar(300) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `PostalCode` varchar(50) DEFAULT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Phone` int(20) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbllandlord`
--

INSERT INTO `tbllandlord` (`ID`, `FirstName`, `LastName`, `Password`, `Email`, `Address`, `Country`, `PostalCode`, `UserName`, `Phone`, `Gender`, `DOB`, `updated_at`, `created_at`, `type`) VALUES
(2, 'Manish', 'Basdeo', 'eab99f6eb415a4834a42914a69e7b69c', 'man.vimal@yahoo.com', 'Morcellement Saint Andre, Kalimaye road', 'Mauritius', '742CU001', 'man.vimal', 57139156, 'M', '2015-10-13', '2015-10-11 06:03:55', '2015-10-11 06:03:55', ''),
(3, 'Lokesh', 'Basdeo', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.com', 'Morcellement saint Andre', 'Mauritius', '1234567', 'Lokesh', 57139151, 'M', '1993-05-20', '2015-10-18 07:09:20', '2015-10-18 07:09:20', 'landlord');

-- --------------------------------------------------------

--
-- Table structure for table `tblpackage`
--

DROP TABLE IF EXISTS `tblpackage`;
CREATE TABLE IF NOT EXISTS `tblpackage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buildingid` int(11) DEFAULT NULL,
  `packageName` varchar(255) DEFAULT NULL,
  `packageDesc` varchar(255) DEFAULT NULL,
  `newPrice` double DEFAULT NULL,
  `capacityAdult` int(11) DEFAULT NULL,
  `Promotion` tinyint(1) DEFAULT NULL,
  `capacityChildren` int(11) DEFAULT NULL,
  `roomCategoryID` int(11) NOT NULL,
  `oldPrice` double NOT NULL,
  `promotionDescription` varchar(255) NOT NULL,
  `promotionExpiryDate` datetime(6) NOT NULL,
  `basic` tinyint(1) NOT NULL DEFAULT '0',
  `adultPrice` double NOT NULL,
  `ChildPrice` double NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tblpackage`
--

INSERT INTO `tblpackage` (`id`, `buildingid`, `packageName`, `packageDesc`, `newPrice`, `capacityAdult`, `Promotion`, `capacityChildren`, `roomCategoryID`, `oldPrice`, `promotionDescription`, `promotionExpiryDate`, `basic`, `adultPrice`, `ChildPrice`, `updated_at`, `created_at`) VALUES
(1, 13, '6test', 'package test', 10000, 2, 1, 1, 1, 0, 's', '2015-12-16 00:00:00.000000', 0, 0, 0, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 15, 'Basic', 'Basic package', 100, 3, 20, 2, 2, 0, 'Test', '0000-00-00 00:00:00.000000', 0, 0, 0, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(3, 12, 'Promotional', 'Nice', 2000, 1, NULL, NULL, 1, 2000, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-01 18:43:05.000000', '2016-02-01 18:43:05.000000'),
(4, 12, 'Promotional', 'Nice', 2000, 1, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-01 18:43:42.000000', '2016-02-01 18:43:42.000000'),
(5, 12, 'testdsds', '3232', 32, 23, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:40:28.000000', '2016-02-03 16:40:28.000000'),
(6, 12, 'sadasasd', 'sadasd', 256, 0, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:42:41.000000', '2016-02-03 16:42:41.000000'),
(7, 12, 'daasd', 'dasasd', 2652, 256, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:43:32.000000', '2016-02-03 16:43:32.000000'),
(8, 12, 'daasd', 'dasasd', 2652, 256, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:43:32.000000', '2016-02-03 16:43:32.000000'),
(9, 13, 'sasda', 'as', 56565, 54, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:45:07.000000', '2016-02-03 16:45:07.000000'),
(10, 13, 'sasda', 'as', 56565, 54, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:45:07.000000', '2016-02-03 16:45:07.000000'),
(11, 16, 'Family', 'Promotional.', 120, 4, NULL, NULL, 1, 200, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-07 20:04:30.000000', '2016-02-07 20:04:30.000000'),
(12, 13, 'test', 'test', 1000, 2, NULL, NULL, 9, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-19 09:11:17.000000', '2016-02-19 09:11:17.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tblroom`
--

DROP TABLE IF EXISTS `tblroom`;
CREATE TABLE IF NOT EXISTS `tblroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buildingID` int(11) DEFAULT NULL,
  `roomCatID` int(11) DEFAULT NULL,
  `desc` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `isOccupied` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `roomName` varchar(100) NOT NULL,
  `landlordID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tblroom`
--

INSERT INTO `tblroom` (`id`, `buildingID`, `roomCatID`, `desc`, `capacity`, `price`, `startDate`, `endDate`, `isOccupied`, `updated_at`, `created_at`, `roomName`, `landlordID`) VALUES
(5, 13, 2, 'Pied dans l`eau', 4, '4000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-12-07 07:58:18', '2015-12-07 07:58:18', 'Seaside', 3),
(7, 12, 1, 'good', 0, '2000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-07 19:57:15', '2016-02-07 19:57:15', 'Seaview', 3),
(8, 21, 1, 'Nice facility.', 0, '250', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-07 20:03:24', '2016-02-07 20:03:24', 'SeaView', 3),
(9, 12, 9, 'asd', 0, '250', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-13 13:55:28', '2016-02-13 13:55:28', 'asdads', 3),
(10, 12, 10, 'asd', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-13 14:11:23', '2016-02-13 14:11:23', 'dsasd', 3),
(11, 12, 9, 'asd', 0, '85', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-13 15:47:28', '2016-02-13 15:47:28', 'dsa', 3),
(12, 12, 9, 'asd', 0, '85', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-13 15:49:08', '2016-02-13 15:49:08', 'dsa', 3),
(13, 12, 9, 'asd', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-13 15:50:25', '2016-02-13 15:50:25', 'sad', 3),
(14, 27, 9, 'sa', 0, '250', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-14 09:42:02', '2016-02-14 09:42:02', 'z', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblroombooking`
--

DROP TABLE IF EXISTS `tblroombooking`;
CREATE TABLE IF NOT EXISTS `tblroombooking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomId` int(11) NOT NULL,
  `bookingId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblroomcat`
--

DROP TABLE IF EXISTS `tblroomcat`;
CREATE TABLE IF NOT EXISTS `tblroomcat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomCatName` varchar(200) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblroomcat`
--

INSERT INTO `tblroomcat` (`id`, `roomCatName`, `updated_at`, `created_at`) VALUES
(9, 'Single', '2016-02-10 18:03:15', '2016-02-10 11:04:40'),
(10, 'Double', '2016-02-10 11:04:53', '2016-02-10 11:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `tblroomfacility`
--

DROP TABLE IF EXISTS `tblroomfacility`;
CREATE TABLE IF NOT EXISTS `tblroomfacility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomid` int(11) DEFAULT NULL,
  `facilityid` int(11) DEFAULT NULL,
  `updated_at` datetime(6) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `tblroomfacility`
--

INSERT INTO `tblroomfacility` (`id`, `roomid`, `facilityid`, `updated_at`, `created_at`) VALUES
(11, 5, 9, '2016-02-14 08:43:03.000000', '2016-02-14 08:43:03.000000'),
(12, 5, 10, '2016-02-14 08:55:07.000000', '2016-02-14 08:55:07.000000'),
(13, 5, 11, '2016-02-14 09:32:27.000000', '2016-02-14 09:32:27.000000'),
(16, 7, 9, '2016-02-14 09:56:43.000000', '2016-02-14 09:56:43.000000'),
(17, 11, 11, '2016-02-14 09:57:24.000000', '2016-02-14 09:57:24.000000'),
(18, 7, 11, '2016-02-14 09:57:29.000000', '2016-02-14 09:57:29.000000'),
(19, 7, 10, '2016-02-14 09:57:33.000000', '2016-02-14 09:57:33.000000'),
(20, 12, 9, '2016-02-14 09:57:51.000000', '2016-02-14 09:57:51.000000'),
(21, 12, 10, '2016-02-14 09:57:51.000000', '2016-02-14 09:57:51.000000'),
(22, 12, 11, '2016-02-14 09:57:55.000000', '2016-02-14 09:57:55.000000'),
(23, 13, 9, '2016-02-14 09:57:58.000000', '2016-02-14 09:57:58.000000'),
(26, 10, 9, '2016-02-14 09:58:18.000000', '2016-02-14 09:58:18.000000'),
(27, 10, 10, '2016-02-14 09:58:18.000000', '2016-02-14 09:58:18.000000'),
(28, 10, 11, '2016-02-14 09:58:18.000000', '2016-02-14 09:58:18.000000'),
(30, 11, 9, '2016-02-14 10:03:51.000000', '2016-02-14 10:03:51.000000'),
(31, 11, 10, '2016-02-14 10:03:51.000000', '2016-02-14 10:03:51.000000'),
(32, 8, 9, '2016-02-14 12:16:48.000000', '2016-02-14 12:16:48.000000'),
(33, 8, 10, '2016-02-14 12:16:48.000000', '2016-02-14 12:16:48.000000'),
(34, 8, 11, '2016-02-14 12:16:48.000000', '2016-02-14 12:16:48.000000'),
(35, 5, 12, '2016-02-18 09:14:40.000000', '2016-02-18 09:14:40.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbltenant`
--

DROP TABLE IF EXISTS `tbltenant`;
CREATE TABLE IF NOT EXISTS `tbltenant` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Password` varchar(300) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `PostalCode` varchar(50) DEFAULT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Phone` int(20) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `type` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbltenant`
--

INSERT INTO `tbltenant` (`ID`, `FirstName`, `LastName`, `Password`, `Email`, `Address`, `Country`, `PostalCode`, `UserName`, `Phone`, `Gender`, `DOB`, `updated_at`, `created_at`, `type`) VALUES
(4, 'Lokesh', 'Basdeo', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.com', 'Morcellement saint Andre', 'Mauritius', '742CU001', 'Pravin', 57139151, 'M', '1993-05-20', '2015-10-01 15:48:57', '2015-10-01 15:48:57', 'tenant');

-- --------------------------------------------------------

--
-- Table structure for table `tbltravel`
--

DROP TABLE IF EXISTS `tbltravel`;
CREATE TABLE IF NOT EXISTS `tbltravel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookingID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `pickUpTime1` datetime(6) NOT NULL,
  `pickUpLocation1` varchar(11) NOT NULL,
  `pickUpDestination1` varchar(11) NOT NULL,
  `pickUpTime2` datetime(6) NOT NULL,
  `pickUpLocation2` varchar(100) NOT NULL,
  `pickUpDestination2` varchar(100) DEFAULT NULL,
  `dispach` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbltravel`
--

INSERT INTO `tbltravel` (`id`, `bookingID`, `vehicleID`, `pickUpTime1`, `pickUpLocation1`, `pickUpDestination1`, `pickUpTime2`, `pickUpLocation2`, `pickUpDestination2`, `dispach`) VALUES
(1, 35, 19, '2016-02-10 00:00:00.000000', 'Morcellemen', 'Port Louis', '2016-02-25 00:00:00.000000', 'Port Louis', 'Port Louis', 'true'),
(2, 35, 19, '2016-02-10 00:00:00.000000', 'Morcellemen', 'Port Louis', '2016-02-25 00:00:00.000000', 'Port Louis', 'Port Louis', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicle`
--

DROP TABLE IF EXISTS `tblvehicle`;
CREATE TABLE IF NOT EXISTS `tblvehicle` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `vehicleCatID` int(8) NOT NULL,
  `vehicleName` varchar(100) NOT NULL,
  `vehicleOwnerID` int(8) NOT NULL,
  `models` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `numOfSeats` int(8) NOT NULL,
  `transmission` varchar(100) NOT NULL,
  `image` text,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tblvehicle`
--

INSERT INTO `tblvehicle` (`id`, `vehicleCatID`, `vehicleName`, `vehicleOwnerID`, `models`, `color`, `numOfSeats`, `transmission`, `image`, `updated_at`, `created_at`, `price`) VALUES
(19, 1, 'dasasd', 1, 'asdas', 'yellow', 2, 'Automatic', '', '2015-12-03 17:20:42', '2015-12-03 17:06:45', 0),
(20, 2, '3223', 1, 'asdasd', 'red', 23, 'Automatic', '', '2015-12-03 17:20:33', '2015-12-03 17:09:02', 0),
(21, 1, 'Toyota', 1, 'Yaris', 'red', 5, 'Automatic', '48328.jpg', '2016-02-13 09:41:40', '2016-02-13 09:41:40', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tblvehiclecat`
--

DROP TABLE IF EXISTS `tblvehiclecat`;
CREATE TABLE IF NOT EXISTS `tblvehiclecat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiclecatname` varchar(200) DEFAULT NULL,
  `vehiclecatnameType` varchar(200) NOT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tblvehiclecat`
--

INSERT INTO `tblvehiclecat` (`id`, `vehiclecatname`, `vehiclecatnameType`, `updated_at`, `created_at`) VALUES
(1, 'Car', 'Car', NULL, NULL),
(2, NULL, 'Lorry', NULL, NULL),
(5, 'Motorcycle', 'Motorcycle', '2016-02-09 15:28:51.000000', '2016-02-09 15:28:51.000000'),
(6, 'Van', 'Van', '2016-02-09 15:41:19.000000', '2016-02-09 15:41:19.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicleowner`
--

DROP TABLE IF EXISTS `tblvehicleowner`;
CREATE TABLE IF NOT EXISTS `tblvehicleowner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Password` varchar(300) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `PostalCode` varchar(50) DEFAULT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Phone` int(20) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblvehicleowner`
--

INSERT INTO `tblvehicleowner` (`id`, `FirstName`, `LastName`, `Password`, `Email`, `Address`, `Country`, `PostalCode`, `UserName`, `Phone`, `Gender`, `DOB`, `updated_at`, `created_at`, `type`) VALUES
(1, 'Pravin', 'Basdeo', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.com', 'Morcellement saintAndre', 'Mauritius', '1514565', 'Prav', 57139151, 'M', '1993-05-20', '2016-01-29 07:39:40', '2015-11-28 16:56:31', 'vehicleOwner');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
