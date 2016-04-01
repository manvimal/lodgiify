-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2016 at 12:54 AM
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
(90, 52, 16, '2016-03-15 09:36:11', '2016-03-15 09:36:11'),
(92, 2, 17, '2016-03-19 18:07:06', '2016-03-19 18:07:06'),
(94, 7, 17, '2016-03-23 10:47:35', '2016-03-23 10:47:35'),
(101, 15, 18, '2016-03-24 17:11:55', '2016-03-24 17:11:55'),
(102, 18, 18, '2016-03-25 03:12:00', '2016-03-25 03:12:00');

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
(15, 'Morcellement Saint Andre', 7, 2, 'Basdeo house is in MSA', '21424.jpg', 'BasdeoHouse', '2016-03-27 04:15:09', '2016-02-01 16:29:36', '', ''),
(42, 'Mahebourgsssss', 1, 2, 'goods', '18432.jpg', 'MahebourgHotel', '2016-03-14 06:18:25', '2016-02-25 13:31:28', '57.78660535812378', '-20.26992678284155'),
(44, 'Pointe Aux Sables', 5, 2, 'Une grande maison pied dans l’eau de 5 chambres à coucher en location à Pointe aux sables.', '98966.jpg', 'Villa Anakao', '2016-03-14 14:43:05', '2016-03-14 14:43:05', '57.44966542348266', '-20.17056937843984'),
(47, 'Pereybere', 5, 2, 'The Athena private pool villas consists of  four villa types ranging from one, two, three and four bedrooms. Perfect holiday spot for honeymooners and family get away.', '40144.jpg', 'Athena Villas #1', '2016-03-23 15:52:15', '2016-03-23 15:52:15', '57.60590988211334', '-20.00159017732299');

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
(16, 13, 10, '2016-02-14 16:42:38', '2016-02-14 16:42:38'),
(17, 13, 11, '2016-02-14 16:42:38', '2016-02-14 16:42:38'),
(20, 32, 10, '2016-02-17 08:10:02', '2016-02-17 08:10:02'),
(21, 32, 10, '2016-02-17 08:10:03', '2016-02-17 08:10:03'),
(22, 35, 10, '2016-02-17 08:10:59', '2016-02-17 08:10:59'),
(26, 37, 12, '2016-02-22 04:40:22', '2016-02-22 04:40:22'),
(27, 38, 11, '2016-02-25 07:10:33', '2016-02-25 07:10:33'),
(29, 40, 10, '2016-02-25 07:18:29', '2016-02-25 07:18:29'),
(30, 41, 12, '2016-02-25 13:29:58', '2016-02-25 13:29:58'),
(32, 42, 10, '2016-02-25 13:31:28', '2016-02-25 13:31:28'),
(36, 44, 11, '2016-03-14 14:43:05', '2016-03-14 14:43:05'),
(37, 44, 10, '2016-03-14 14:55:58', '2016-03-14 14:55:58'),
(46, 15, 10, '2016-03-23 12:00:46', '2016-03-23 12:00:46'),
(49, 47, 10, '2016-03-23 15:52:15', '2016-03-23 15:52:15'),
(50, 47, 11, '2016-03-23 15:52:15', '2016-03-23 15:52:15');

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
(10, 'meal', 'room', '2016-02-14 00:00:00.000000', '2016-02-14 00:00:00.000000'),
(11, 'Parking', 'Space', '2016-02-14 09:29:38.000000', '2016-02-14 09:29:57.000000'),
(13, 'AC', 'Room', '2016-03-25 13:59:21.000000', '2016-03-25 13:59:21.000000'),
(16, 'testd', 'adsd', '2016-03-27 06:59:47.000000', '2016-03-27 06:59:47.000000');

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
(2, 'Lokeshupdated', 'Basdeoupdated', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.co', 'Morcellemet saint andre', 'Mauritius', '7cu007', 'Lokesh', 57139151, 'M', '1993-05-20', '2016-04-01 18:32:52', '2016-02-25 08:53:37', 'Landlord', 1, NULL, NULL);

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
(22, 44, 'Normal Package', 'Overnight Accommodation with Two- 2 Day Adult Pass to the National Aquarium in Baltimore with access to 4D Immersion Film on the first day, a plush Lord and Lady Puffin , Complimentary Self Parking', 0, NULL, NULL, NULL, 10, 2500, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-03-25 03:48:41.000000', '2016-03-25 03:48:41.000000');

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
(1, 42, 9, 'Pied dans l`eau.', 2, '2500', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-04-01 17:49:51', '2016-04-01 17:49:51', 'Sea View', 2);

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
(12, 5, 10, '2016-02-14 08:55:07.000000', '2016-02-14 08:55:07.000000'),
(13, 5, 11, '2016-02-14 09:32:27.000000', '2016-02-14 09:32:27.000000'),
(21, 12, 10, '2016-02-14 09:57:51.000000', '2016-02-14 09:57:51.000000'),
(22, 12, 11, '2016-02-14 09:57:55.000000', '2016-02-14 09:57:55.000000'),
(27, 10, 10, '2016-02-14 09:58:18.000000', '2016-02-14 09:58:18.000000'),
(28, 10, 11, '2016-02-14 09:58:18.000000', '2016-02-14 09:58:18.000000'),
(37, 17, 10, '2016-02-25 07:16:58.000000', '2016-02-25 07:16:58.000000'),
(38, 19, 10, '2016-02-25 07:18:45.000000', '2016-02-25 07:18:45.000000'),
(39, 1, 10, '2016-04-01 17:49:51.000000', '2016-04-01 17:49:51.000000'),
(41, 1, 13, '2016-04-01 17:50:13.000000', '2016-04-01 17:50:13.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tblsession`
--

DROP TABLE IF EXISTS `tblsession`;
CREATE TABLE `tblsession` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `logindatetime` datetime(6) NOT NULL,
  `logoutdatetime` datetime(6) NOT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsession`
--

INSERT INTO `tblsession` (`id`, `username`, `logindatetime`, `logoutdatetime`, `updated_at`, `created_at`, `type`) VALUES
(4, 'Pravin', '2016-04-02 02:13:31.000000', '2016-04-02 02:13:47.000000', '2016-03-18 18:57:37.000000', '2016-03-18 18:57:37.000000', 'tenant'),
(6, 'Lokesh', '2016-04-01 22:22:48.000000', '2016-04-01 22:34:45.000000', '2016-03-19 09:43:08.000000', '2016-03-19 09:43:08.000000', 'Landlord'),
(8, 'Prav', '2016-04-01 22:22:24.000000', '2016-04-01 22:22:31.000000', '2016-03-19 18:35:46.000000', '2016-03-19 18:35:46.000000', 'vehicleowner'),
(9, 'Jdoe', '2016-04-01 23:10:34.000000', '2016-04-01 23:10:42.000000', '2016-03-30 16:05:00.000000', '2016-03-30 16:05:00.000000', 'Landlord');

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
(4, 'Lokesh', 'Basdeo', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.com', 'Morcellement saint Andre', 'Mauritius', '742CU001', 'Pravin', 57139151, 'M', '1993-05-20', '2016-04-01 19:52:20', '2015-10-01 15:48:57', 'tenant', 1, '', '0000-00-00 00:00:00');

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
(24, 4, 55, 5, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 4, 2, 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 4, 8, 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 4, 14, 5, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 4, 19, 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  `price` double NOT NULL DEFAULT '0',
  `description` varchar(100) DEFAULT NULL,
  `driver` tinyint(1) DEFAULT '0',
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvehicle`
--

INSERT INTO `tblvehicle` (`id`, `vehicleCatID`, `vehicleName`, `vehicleOwnerID`, `models`, `color`, `numOfSeats`, `transmission`, `image`, `updated_at`, `created_at`, `price`, `description`, `driver`, `location`) VALUES
(21, 1, 'Toyota', 3, 'Yaris', 'red', 5, 'Automatic', '48328.jpg', '2016-02-13 09:41:40', '2016-02-13 09:41:40', 20, NULL, 0, NULL),
(24, 1, 'Toyota', 3, 'Corolla 08', 'Grey', 5, 'Manual', '44685.jpg', '2016-03-18 19:16:17', '2016-03-18 19:16:17', 50, 'power window, AC, good conditioning, Gps, power start.', 1, NULL),
(25, 1, 'Nissan ', 3, 'GTR', 'Blue', 2, 'Manual', '74801.jpg', '2016-03-24 06:12:16', '2016-03-24 06:12:16', 10, 'N/a', 1, NULL),
(26, 1, 'Honda', 3, 'V354', 'Green', 4, 'Automatic', '99403.jpg', '2016-03-24 06:19:09', '2016-03-24 06:19:09', 25, 'n/a', 1, NULL),
(27, 1, 'Ford', 3, 'Mustang', 'Red', 5, 'Manual', '62882.jpg', '2016-03-24 06:26:01', '2016-03-24 06:26:01', 150, 'Pro driver', 1, NULL),
(28, 1, 'BMW', 3, 'X6', 'White', 5, 'Manual', '80734.jpg', '2016-03-24 13:05:30', '2016-03-24 13:05:30', 150, 'Anti-Lock Brakes / Driver Airbag / Passenger Airbag / Side Airbag / Power Windows / A/C:front / Navi', 0, NULL),
(29, 1, 'Mitsubishi', 3, 'Vitara', 'Blue', 5, 'Manual', '65117.jpg', '2016-03-25 04:30:50', '2016-03-25 04:30:50', 25, ' Its performance and fuel economy is above average, while technology and connectivity falls on an av', 0, NULL),
(30, 1, 'Toyota ', 3, 'Acura MDX', 'White', 8, 'Automatic', '655555.jpg', '2016-03-25 04:34:24', '2016-03-25 04:34:24', 200, 'he added features, increased seating and cargo capacity, and upscale interior hues complement with e', 1, NULL),
(31, 6, 'Volswagen', 3, 'V350', 'Grey', 13, 'Manual', '68820.jpg', '2016-03-25 04:48:57', '2016-03-25 04:48:57', 350, 'Transport efficient', 1, NULL),
(32, 6, 'Nissan', 3, 'J02', 'White', 14, 'Manual', '98814.png', '2016-03-25 04:51:08', '2016-03-25 04:51:08', 250, 'REserve Now!', 1, NULL),
(33, 1, 'LandRover', 3, ' Free Lander', 'Brown', 7, 'Manual', '8455561.jpg', '2016-03-25 07:37:25', '2016-03-25 07:37:25', 150, 'Fuel Type: Petrol\r\nYear: 2001\r\nMileage: 110000 Km', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblvehiclebooking`
--

DROP TABLE IF EXISTS `tblvehiclebooking`;
CREATE TABLE `tblvehiclebooking` (
  `id` int(11) NOT NULL,
  `vehicleid` int(11) DEFAULT NULL,
  `tenantid` int(11) DEFAULT NULL,
  `fromdate` datetime DEFAULT NULL,
  `todate` datetime DEFAULT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  `price` float DEFAULT NULL,
  `pickuplat` float DEFAULT NULL,
  `pickuplong` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvehiclebooking`
--

INSERT INTO `tblvehiclebooking` (`id`, `vehicleid`, `tenantid`, `fromdate`, `todate`, `created_at`, `updated_at`, `price`, `pickuplat`, `pickuplong`) VALUES
(14, 28, 4, '2016-03-24 21:20:00', '2016-03-30 02:00:00', '2016-03-24 17:20:55.000000', '2016-03-24 17:20:55.000000', 7500, NULL, NULL),
(15, 30, 4, '2016-03-25 08:52:00', '2016-03-31 03:00:00', '2016-03-25 04:52:58.000000', '2016-03-25 04:52:58.000000', 10000, -19.9869, 57.612),
(16, 21, 4, '2016-03-25 09:04:00', '2016-03-29 02:30:00', '2016-03-25 05:04:53.000000', '2016-03-25 05:04:53.000000', 1000, NULL, NULL),
(17, 24, 4, '2016-03-25 19:06:00', '2016-03-31 21:30:00', '2016-03-25 15:07:21.000000', '2016-03-25 15:07:21.000000', 2500, -20.0314, 57.5705),
(21, 32, 4, '2016-03-25 20:20:00', '2016-03-31 02:00:00', '2016-03-25 16:20:55.000000', '2016-03-25 16:20:55.000000', 12500, -20.1823, 57.687),
(22, 26, 4, '2016-03-27 20:26:00', '2016-03-27 22:30:00', '2016-03-27 16:27:48.000000', '2016-03-27 16:27:48.000000', 1250, -20.0275, 57.5599),
(23, 29, 4, '2016-04-01 12:30:00', '2016-04-02 12:30:00', '2016-04-01 08:31:19.000000', '2016-04-01 08:31:19.000000', 600, NULL, NULL);

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
-- Indexes for table `tblsession`
--
ALTER TABLE `tblsession`
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
-- Indexes for table `tblvehiclebooking`
--
ALTER TABLE `tblvehiclebooking`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tblbookingpackage`
--
ALTER TABLE `tblbookingpackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `tblbuilding`
--
ALTER TABLE `tblbuilding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `tblbuildingcat`
--
ALTER TABLE `tblbuildingcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblbuildingfacility`
--
ALTER TABLE `tblbuildingfacility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `tblfacility`
--
ALTER TABLE `tblfacility`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbllandlord`
--
ALTER TABLE `tbllandlord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblpackage`
--
ALTER TABLE `tblpackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tblroom`
--
ALTER TABLE `tblroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblroombooking`
--
ALTER TABLE `tblroombooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblroomcat`
--
ALTER TABLE `tblroomcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblroomfacility`
--
ALTER TABLE `tblroomfacility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `tblsession`
--
ALTER TABLE `tblsession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tblvehicle`
--
ALTER TABLE `tblvehicle`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tblvehiclebooking`
--
ALTER TABLE `tblvehiclebooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tblvehiclecat`
--
ALTER TABLE `tblvehiclecat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblvehicleowner`
--
ALTER TABLE `tblvehicleowner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
