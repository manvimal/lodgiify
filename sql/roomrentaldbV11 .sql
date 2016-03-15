-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2016 at 07:39 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roomrentaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `hash` text,
  `expiryHash` datetime DEFAULT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `FirstName`, `LastName`, `UserName`, `Password`, `type`, `hash`, `expiryHash`, `Email`) VALUES
(1, 'User', 'Admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', '', NULL, 'lokeshpravin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

DROP TABLE IF EXISTS `tblbooking`;
CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL,
  `tenantID` int(11) NOT NULL,
  `buildingID` int(11) NOT NULL,
  `checkin` datetime(6) DEFAULT NULL,
  `checkOut` datetime(6) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `price` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `tenantID`, `buildingID`, `checkin`, `checkOut`, `updated_at`, `created_at`, `price`) VALUES
(51, 4, 44, '2016-03-15 11:54:00.000000', '2016-03-18 02:00:00.000000', '2016-03-15 07:54:55', '2016-03-15 07:54:55', 0),
(53, 4, 42, '2016-03-08 00:30:00.000000', '2016-03-11 00:30:00.000000', '2016-03-15 10:55:31', '2016-03-15 10:55:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblbookingpackage`
--

DROP TABLE IF EXISTS `tblbookingpackage`;
CREATE TABLE `tblbookingpackage` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbookingpackage`
--

INSERT INTO `tblbookingpackage` (`id`, `booking_id`, `package_id`, `updated_at`, `created_at`) VALUES
(89, 51, 17, '2016-03-15 07:54:55', '2016-03-15 07:54:55'),
(90, 52, 16, '2016-03-15 09:36:11', '2016-03-15 09:36:11'),
(91, 53, 16, '2016-03-15 10:55:30', '2016-03-15 10:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblbuilding`
--

DROP TABLE IF EXISTS `tblbuilding`;
CREATE TABLE `tblbuilding` (
  `id` int(11) NOT NULL,
  `buildingLocation` varchar(200) DEFAULT NULL,
  `buildingCatID` int(11) NOT NULL,
  `landlordID` int(11) NOT NULL,
  `desc` text NOT NULL,
  `image` text NOT NULL,
  `buildingName` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbuilding`
--

INSERT INTO `tblbuilding` (`id`, `buildingLocation`, `buildingCatID`, `landlordID`, `desc`, `image`, `buildingName`, `updated_at`, `created_at`, `longitude`, `lattitude`) VALUES
(15, 'Morcellement Saint Andre', 7, 2, 'Basdeo house is in MSA', '21424.jpg', 'BasdeoHouse', '2016-03-15 17:55:28', '2016-02-01 16:29:36', '', ''),
(21, 'BainBoeuf', 3, 3, 'Pied Dans L`eau.', '93679.jpg', 'BainBoeufAppartment', '2016-02-07 20:02:30', '2016-02-07 20:02:30', '57.60533010587096', '-19.986113997686154'),
(42, 'Mahebourgsssss', 1, 2, 'goods', '18432.jpg', 'MahebourgHotel', '2016-03-14 06:18:25', '2016-02-25 13:31:28', '57.78660535812378', '-20.26992678284155'),
(44, 'Pointe Aux Sables', 5, 2, 'Une grande maison pied dans l’eau de 5 chambres à coucher en location à Pointe aux sables.', '98966.jpg', 'Villa Anakao', '2016-03-14 14:43:05', '2016-03-14 14:43:05', '57.44966542348266', '-20.17056937843984');

-- --------------------------------------------------------

--
-- Table structure for table `tblbuildingcat`
--

DROP TABLE IF EXISTS `tblbuildingcat`;
CREATE TABLE `tblbuildingcat` (
  `id` int(11) NOT NULL,
  `buildingCatName` varchar(100) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbuildingcat`
--

INSERT INTO `tblbuildingcat` (`id`, `buildingCatName`, `updated_at`, `created_at`) VALUES
(1, 'Hotel', '2016-03-14 15:09:14.000000', NULL),
(2, 'Bungalow', NULL, NULL),
(3, 'Appartment', NULL, NULL),
(4, 'Commercial Building', '2016-02-10 18:02:58.000000', NULL),
(5, 'Villa', '2016-02-10 18:05:32.000000', NULL),
(6, 'Penthouse', '2016-02-10 18:01:18.000000', NULL),
(7, 'House', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbuildingfacility`
--

DROP TABLE IF EXISTS `tblbuildingfacility`;
CREATE TABLE `tblbuildingfacility` (
  `id` int(11) NOT NULL,
  `buildingid` int(11) DEFAULT NULL,
  `facilityid` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(24, 21, 9, '2016-02-18 09:08:11', '2016-02-18 09:08:11'),
(25, 37, 9, '2016-02-22 04:40:22', '2016-02-22 04:40:22'),
(26, 37, 12, '2016-02-22 04:40:22', '2016-02-22 04:40:22'),
(27, 38, 11, '2016-02-25 07:10:33', '2016-02-25 07:10:33'),
(28, 39, 9, '2016-02-25 07:16:39', '2016-02-25 07:16:39'),
(29, 40, 10, '2016-02-25 07:18:29', '2016-02-25 07:18:29'),
(30, 41, 12, '2016-02-25 13:29:58', '2016-02-25 13:29:58'),
(32, 42, 10, '2016-02-25 13:31:28', '2016-02-25 13:31:28'),
(33, 42, 12, '2016-03-10 12:27:40', '2016-03-10 12:27:40'),
(34, 15, 9, '2016-03-14 06:10:01', '2016-03-14 06:10:01'),
(35, 44, 9, '2016-03-14 14:43:05', '2016-03-14 14:43:05'),
(36, 44, 11, '2016-03-14 14:43:05', '2016-03-14 14:43:05'),
(37, 44, 10, '2016-03-14 14:55:58', '2016-03-14 14:55:58'),
(38, 44, 12, '2016-03-14 14:56:04', '2016-03-14 14:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `tblfacility`
--

DROP TABLE IF EXISTS `tblfacility`;
CREATE TABLE `tblfacility` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
CREATE TABLE `tbllandlord` (
  `id` int(11) NOT NULL,
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
  `userStatus` int(2) DEFAULT '0',
  `hash` text,
  `expiryHash` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllandlord`
--

INSERT INTO `tbllandlord` (`id`, `FirstName`, `LastName`, `Password`, `Email`, `Address`, `Country`, `PostalCode`, `UserName`, `Phone`, `Gender`, `DOB`, `updated_at`, `created_at`, `type`, `userStatus`, `hash`, `expiryHash`) VALUES
(2, 'Lokesh', 'Basdeo', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.co', 'Morcellemet saint andre', 'Mauritius', '7cu007', 'Lokesh', 57139151, 'M', '1993-05-20', '2016-03-10 12:39:13', '2016-02-25 08:53:37', 'Landlord', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpackage`
--

DROP TABLE IF EXISTS `tblpackage`;
CREATE TABLE `tblpackage` (
  `id` int(11) NOT NULL,
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
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpackage`
--

INSERT INTO `tblpackage` (`id`, `buildingid`, `packageName`, `packageDesc`, `newPrice`, `capacityAdult`, `Promotion`, `capacityChildren`, `roomCategoryID`, `oldPrice`, `promotionDescription`, `promotionExpiryDate`, `basic`, `adultPrice`, `ChildPrice`, `updated_at`, `created_at`) VALUES
(1, 13, '6test', 'package test', 10000, 2, 1, 1, 1, 0, 's', '2015-12-16 00:00:00.000000', 0, 0, 0, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(9, 13, 'sasda', 'as', 56565, 54, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:45:07.000000', '2016-02-03 16:45:07.000000'),
(10, 13, 'sasda', 'as', 56565, 54, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:45:07.000000', '2016-02-03 16:45:07.000000'),
(11, 16, 'Family', 'Promotional.', 120, 4, NULL, NULL, 1, 200, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-07 20:04:30.000000', '2016-02-07 20:04:30.000000'),
(12, 13, 'test', 'test', 1000, 2, NULL, NULL, 9, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-19 09:11:17.000000', '2016-02-19 09:11:17.000000'),
(14, 42, 'testinga', 'ads', 0, 0, NULL, 0, 9, 0, '', '0000-00-00 00:00:00.000000', 0, 2000, 1000, '2016-03-06 07:49:00.000000', '2016-03-06 07:49:00.000000'),
(16, 42, 'MbgPackage', 'Free', 2000, 1, NULL, 0, 10, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-03-12 06:32:32.000000', '2016-03-12 06:32:32.000000'),
(17, 44, 'Normal Package', 'Normal package with normal tariff', 5000, 2, NULL, 0, 10, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-03-14 14:45:23.000000', '2016-03-14 14:45:23.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tblroom`
--

DROP TABLE IF EXISTS `tblroom`;
CREATE TABLE `tblroom` (
  `id` int(11) NOT NULL,
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
  `landlordID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblroom`
--

INSERT INTO `tblroom` (`id`, `buildingID`, `roomCatID`, `desc`, `capacity`, `price`, `startDate`, `endDate`, `isOccupied`, `updated_at`, `created_at`, `roomName`, `landlordID`) VALUES
(5, 13, 2, 'Pied dans l`eau', 4, '4000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-12-07 07:58:18', '2015-12-07 07:58:18', 'Seaside', 3),
(8, 21, 1, 'Pied Dans L`eau.', 0, '250', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-25 14:10:14', '2016-02-07 20:03:24', 'SeaView', 3),
(14, 27, 9, 'sa', 0, '250', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-14 09:42:02', '2016-02-14 09:42:02', 'z', 3),
(15, 38, 10, 'sadasd', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-25 07:11:43', '2016-02-25 07:11:43', 'asdas', 3),
(16, 39, 9, 'asd', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-25 07:16:53', '2016-02-25 07:16:53', 'das', 3),
(17, 39, 9, 'asd', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-25 07:16:58', '2016-02-25 07:16:58', 'das', 3),
(18, 40, 9, 'das', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-25 07:18:40', '2016-02-25 07:18:40', 'asdasd', 3),
(19, 40, 9, 'das', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-25 07:18:45', '2016-02-25 07:18:45', 'asdasd', 3),
(20, 42, 10, 'pravin', 2, '10000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-03-14 06:18:35', '2016-02-25 14:08:06', 'Amazing', 2),
(23, 15, 9, 'sadsa', 25, '250', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-03-14 06:16:19', '2016-03-14 06:16:19', 'xyz', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblroombooking`
--

DROP TABLE IF EXISTS `tblroombooking`;
CREATE TABLE `tblroombooking` (
  `id` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `bookingId` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblroombooking`
--

INSERT INTO `tblroombooking` (`id`, `roomId`, `bookingId`, `updated_at`, `created_at`) VALUES
(2, 20, 53, '2016-03-15 10:55:31', '2016-03-15 10:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `tblroomcat`
--

DROP TABLE IF EXISTS `tblroomcat`;
CREATE TABLE `tblroomcat` (
  `id` int(11) NOT NULL,
  `roomCatName` varchar(200) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
CREATE TABLE `tblroomfacility` (
  `id` int(11) NOT NULL,
  `roomid` int(11) DEFAULT NULL,
  `facilityid` int(11) DEFAULT NULL,
  `updated_at` datetime(6) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblroomfacility`
--

INSERT INTO `tblroomfacility` (`id`, `roomid`, `facilityid`, `updated_at`, `created_at`) VALUES
(11, 5, 9, '2016-02-14 08:43:03.000000', '2016-02-14 08:43:03.000000'),
(12, 5, 10, '2016-02-14 08:55:07.000000', '2016-02-14 08:55:07.000000'),
(13, 5, 11, '2016-02-14 09:32:27.000000', '2016-02-14 09:32:27.000000'),
(20, 12, 9, '2016-02-14 09:57:51.000000', '2016-02-14 09:57:51.000000'),
(21, 12, 10, '2016-02-14 09:57:51.000000', '2016-02-14 09:57:51.000000'),
(22, 12, 11, '2016-02-14 09:57:55.000000', '2016-02-14 09:57:55.000000'),
(26, 10, 9, '2016-02-14 09:58:18.000000', '2016-02-14 09:58:18.000000'),
(27, 10, 10, '2016-02-14 09:58:18.000000', '2016-02-14 09:58:18.000000'),
(28, 10, 11, '2016-02-14 09:58:18.000000', '2016-02-14 09:58:18.000000'),
(32, 8, 9, '2016-02-14 12:16:48.000000', '2016-02-14 12:16:48.000000'),
(33, 8, 10, '2016-02-14 12:16:48.000000', '2016-02-14 12:16:48.000000'),
(34, 8, 11, '2016-02-14 12:16:48.000000', '2016-02-14 12:16:48.000000'),
(35, 5, 12, '2016-02-18 09:14:40.000000', '2016-02-18 09:14:40.000000'),
(36, 15, 9, '2016-02-25 07:11:43.000000', '2016-02-25 07:11:43.000000'),
(37, 17, 10, '2016-02-25 07:16:58.000000', '2016-02-25 07:16:58.000000'),
(38, 19, 10, '2016-02-25 07:18:45.000000', '2016-02-25 07:18:45.000000'),
(39, 20, 9, '2016-02-25 14:08:06.000000', '2016-02-25 14:08:06.000000'),
(40, 20, 11, '2016-02-26 18:42:27.000000', '2016-02-26 18:42:27.000000'),
(41, 20, 12, '2016-02-26 18:42:27.000000', '2016-02-26 18:42:27.000000'),
(42, 20, 10, '2016-02-26 18:43:00.000000', '2016-02-26 18:43:00.000000'),
(45, 23, 9, '2016-03-14 06:16:19.000000', '2016-03-14 06:16:19.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbltenant`
--

DROP TABLE IF EXISTS `tbltenant`;
CREATE TABLE `tbltenant` (
  `id` int(11) NOT NULL,
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
  `userStatus` int(11) NOT NULL DEFAULT '1',
  `hash` text,
  `expiryHash` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltenant`
--

INSERT INTO `tbltenant` (`id`, `FirstName`, `LastName`, `Password`, `Email`, `Address`, `Country`, `PostalCode`, `UserName`, `Phone`, `Gender`, `DOB`, `updated_at`, `created_at`, `type`, `userStatus`, `hash`, `expiryHash`) VALUES
(4, 'Lokesh', 'Basdeo', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.com', 'Morcellement saint Andre', 'Mauritius', '742CU001', 'Pravin', 57139151, 'M', '1993-05-20', '2016-03-14 06:28:06', '2015-10-01 15:48:57', 'tenant', 1, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbltravel`
--

DROP TABLE IF EXISTS `tbltravel`;
CREATE TABLE `tbltravel` (
  `id` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `pickUpTime1` datetime(6) DEFAULT NULL,
  `pickUpLocation1` varchar(225) DEFAULT NULL,
  `pickUpDestination1` varchar(225) DEFAULT NULL,
  `pickUpTime2` datetime(6) DEFAULT NULL,
  `pickUpLocation2` varchar(100) DEFAULT NULL,
  `pickUpDestination2` varchar(100) DEFAULT NULL,
  `dispach` varchar(100) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbluserstarreview`
--

DROP TABLE IF EXISTS `tbluserstarreview`;
CREATE TABLE `tbluserstarreview` (
  `id` int(11) NOT NULL,
  `tenantid` int(11) NOT NULL,
  `bookingid` int(11) NOT NULL,
  `numofstar` int(11) NOT NULL,
  `totalpoints` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluserstarreview`
--

INSERT INTO `tbluserstarreview` (`id`, `tenantid`, `bookingid`, `numofstar`, `totalpoints`, `created_at`, `updated_at`) VALUES
(17, 4, 51, 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 4, 53, 5, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicle`
--

DROP TABLE IF EXISTS `tblvehicle`;
CREATE TABLE `tblvehicle` (
  `id` int(8) NOT NULL,
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
  `price` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
CREATE TABLE `tblvehiclecat` (
  `id` int(11) NOT NULL,
  `vehiclecatname` varchar(200) DEFAULT NULL,
  `vehiclecatnameType` varchar(200) NOT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
CREATE TABLE `tblvehicleowner` (
  `id` int(11) NOT NULL,
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
  `userStatus` int(2) NOT NULL DEFAULT '1',
  `hash` text,
  `expiryHash` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvehicleowner`
--

INSERT INTO `tblvehicleowner` (`id`, `FirstName`, `LastName`, `Password`, `Email`, `Address`, `Country`, `PostalCode`, `UserName`, `Phone`, `Gender`, `DOB`, `updated_at`, `created_at`, `type`, `userStatus`, `hash`, `expiryHash`) VALUES
(3, 'Prav', 'Basdeo', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.com', 'Morcellement saint andre', 'Mauritius', '7CU0017', 'Prav', 57139151, 'M', '1993-05-20', '2016-03-14 15:10:39', '2016-02-25 10:12:45', 'vehicleowner', 1, '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbookingpackage`
--
ALTER TABLE `tblbookingpackage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbuilding`
--
ALTER TABLE `tblbuilding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbuildingcat`
--
ALTER TABLE `tblbuildingcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbuildingfacility`
--
ALTER TABLE `tblbuildingfacility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfacility`
--
ALTER TABLE `tblfacility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllandlord`
--
ALTER TABLE `tbllandlord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpackage`
--
ALTER TABLE `tblpackage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblroom`
--
ALTER TABLE `tblroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblroombooking`
--
ALTER TABLE `tblroombooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblroomcat`
--
ALTER TABLE `tblroomcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblroomfacility`
--
ALTER TABLE `tblroomfacility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltenant`
--
ALTER TABLE `tbltenant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltravel`
--
ALTER TABLE `tbltravel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluserstarreview`
--
ALTER TABLE `tbluserstarreview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblvehicle`
--
ALTER TABLE `tblvehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblvehiclecat`
--
ALTER TABLE `tblvehiclecat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblvehicleowner`
--
ALTER TABLE `tblvehicleowner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `tblbookingpackage`
--
ALTER TABLE `tblbookingpackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `tblbuilding`
--
ALTER TABLE `tblbuilding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `tblbuildingcat`
--
ALTER TABLE `tblbuildingcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tblbuildingfacility`
--
ALTER TABLE `tblbuildingfacility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `tblfacility`
--
ALTER TABLE `tblfacility`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbllandlord`
--
ALTER TABLE `tbllandlord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblpackage`
--
ALTER TABLE `tblpackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tblroom`
--
ALTER TABLE `tblroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tblroombooking`
--
ALTER TABLE `tblroombooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblroomcat`
--
ALTER TABLE `tblroomcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblroomfacility`
--
ALTER TABLE `tblroomfacility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `tbltenant`
--
ALTER TABLE `tbltenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbltravel`
--
ALTER TABLE `tbltravel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbluserstarreview`
--
ALTER TABLE `tbluserstarreview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tblvehicle`
--
ALTER TABLE `tblvehicle`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tblvehiclecat`
--
ALTER TABLE `tblvehiclecat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblvehicleowner`
--
ALTER TABLE `tblvehicleowner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
