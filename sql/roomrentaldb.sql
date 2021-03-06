-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2016 at 05:37 PM
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
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `adminFirstName` varchar(100) DEFAULT NULL,
  `adminLastName` varchar(100) DEFAULT NULL,
  `adminUserName` varchar(100) DEFAULT NULL,
  `adminPassword` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `tenantID`, `travelID`, `checkin`, `checkOut`, `updated_at`, `created_at`, `price`) VALUES
(35, 1, 0, '2016-02-08 12:09:00.000000', '2016-02-10 12:09:00.000000', '2016-02-08 08:18:41', '2016-02-08 08:18:41', 400);

-- --------------------------------------------------------

--
-- Table structure for table `tblbookingpackage`
--

DROP TABLE IF EXISTS `tblbookingpackage`;
CREATE TABLE IF NOT EXISTS `tblbookingpackage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblbookingpackage`
--

INSERT INTO `tblbookingpackage` (`id`, `booking_id`, `package_id`) VALUES
(1, 35, 11);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tblbuilding`
--

INSERT INTO `tblbuilding` (`id`, `buildingLocation`, `buildingCatID`, `landlordID`, `desc`, `image`, `buildingName`, `updated_at`, `created_at`, `longitude`, `lattitude`) VALUES
(8, 'as', 5, 2, 'sa', '', 'sa', '2015-10-11 12:33:31', '2015-10-11 12:33:31', '57.55\r\n', '-20.2833'),
(9, 'Grand Baie', 1, 1, 'Grand bay beach', '98141.jpg', 'building2', '2015-10-11 14:23:30', '2015-10-11 14:23:30', '', '-19.986113997686154'),
(12, 'Grand Baie', 5, 3, 'Peacefully', '93644.jpg', 'Couple suite', '2015-12-02 05:55:24', '2015-12-02 05:49:58', '57.5992339', '-19.9894524'),
(13, 'Grand Baie', 3, 3, 'best ', '23570.jpg', 'coco', '2015-12-07 07:57:38', '2015-12-07 07:57:38', '57.55', '-20.2833'),
(14, 'dasdas', 1, 4, 'sadsa', '', 'sasd', '2016-01-26 09:03:05', '2016-01-26 09:03:05', '57.6620213', '-20.0128964'),
(15, 'MorcellementSaintAndre', 7, 2, 'Basdeo house is in MSA', '21424.jpg', 'BasdeoHouse', '2016-02-01 16:29:36', '2016-02-01 16:29:36', '57.60533010587096', '-19.986113997686154'),
(16, 'MorcellementStAndre', 2, 2, 'MorcellementStAndre', '88224.jpeg', 'BasdeoBungalow', '2016-02-01 16:30:47', '2016-02-01 16:30:47', '57.60533010587096', '-19.986113997686154'),
(21, 'BainBoeuf', 3, 3, 'Pied Dans L`eau.', '93679.jpg', 'BainBoeufAppartment', '2016-02-07 20:02:30', '2016-02-07 20:02:30', '57.60533010587096', '-19.986113997686154');

-- --------------------------------------------------------

--
-- Table structure for table `tblbuildingcat`
--

DROP TABLE IF EXISTS `tblbuildingcat`;
CREATE TABLE IF NOT EXISTS `tblbuildingcat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buildingCatName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tblbuildingcat`
--

INSERT INTO `tblbuildingcat` (`id`, `buildingCatName`) VALUES
(1, 'Hotel'),
(2, 'Bungalow'),
(3, 'Appartment'),
(4, 'Commercial Building'),
(5, 'Villa'),
(6, 'Penthouse'),
(7, 'House');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbllandlord`
--

INSERT INTO `tbllandlord` (`ID`, `FirstName`, `LastName`, `Password`, `Email`, `Address`, `Country`, `PostalCode`, `UserName`, `Phone`, `Gender`, `DOB`, `updated_at`, `created_at`, `type`) VALUES
(1, 'vimal', 'basdeo', '3aaa3e9689c75ecd1c217d1fc5c47239', 'man.vimal@yahoo.com', 'sdd', 'Aruba', 'ssa', 'manvimal', 57139156, 'M', '2015-10-15', '2015-10-01 15:48:57', '2015-10-01 15:48:57', ''),
(2, 'Manish', 'Basdeo', 'eab99f6eb415a4834a42914a69e7b69c', 'man.vimal@yahoo.com', 'Morcellement Saint Andre, Kalimaye road', 'Mauritius', '742CU001', 'man.vimal', 57139156, 'M', '2015-10-13', '2015-10-11 06:03:55', '2015-10-11 06:03:55', ''),
(3, 'Lokesh', 'Basdeo', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.com', 'Morcellement saint Andre', 'Mauritius', '1234567', 'Lokesh', 57139151, 'M', '1993-05-20', '2015-10-18 07:09:20', '2015-10-18 07:09:20', 'landlord'),
(4, 'John', 'Doe', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.com', 'Morcellemet saint andre', 'Bahrain', 'sa', 'John', 54789654, 'M', '2000-02-20', '2016-01-26 06:24:49', '2016-01-26 06:24:49', 'landlord'),
(5, 'dasads', 'sadasd', '827ccb0eea8a706c4c34a16891f84e7b', 'LokeshBasdeo@gmail.com', 'Morcellemet saint andre', 'Barbados', 'sadasd', 'sdaasd', 57458965, 'M', '0522-05-26', '2016-01-26 06:29:51', '2016-01-26 06:29:51', 'LandLord');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tblpackage`
--

INSERT INTO `tblpackage` (`id`, `buildingid`, `packageName`, `packageDesc`, `newPrice`, `capacityAdult`, `Promotion`, `capacityChildren`, `roomCategoryID`, `oldPrice`, `promotionDescription`, `promotionExpiryDate`, `basic`, `adultPrice`, `ChildPrice`, `updated_at`, `created_at`) VALUES
(1, 13, '6test', 'package test', 10000, 2, 1, 1, 1, 0, 's', '2015-12-16 00:00:00.000000', 0, 0, 0, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 15, 'Basic', 'Basic package', 100, 3, 20, 2, 2, 0, 'Test', '0000-00-00 00:00:00.000000', 0, 0, 0, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(3, 12, 'Promotional', 'Nice', 2000, 1, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-01 18:43:05.000000', '2016-02-01 18:43:05.000000'),
(4, 12, 'Promotional', 'Nice', 2000, 1, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-01 18:43:42.000000', '2016-02-01 18:43:42.000000'),
(5, 12, 'testdsds', '3232', 32, 23, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:40:28.000000', '2016-02-03 16:40:28.000000'),
(6, 12, 'sadasasd', 'sadasd', 256, 0, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:42:41.000000', '2016-02-03 16:42:41.000000'),
(7, 12, 'daasd', 'dasasd', 2652, 256, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:43:32.000000', '2016-02-03 16:43:32.000000'),
(8, 12, 'daasd', 'dasasd', 2652, 256, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:43:32.000000', '2016-02-03 16:43:32.000000'),
(9, 13, 'sasda', 'as', 56565, 54, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:45:07.000000', '2016-02-03 16:45:07.000000'),
(10, 13, 'sasda', 'as', 56565, 54, NULL, NULL, 1, 0, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-03 16:45:07.000000', '2016-02-03 16:45:07.000000'),
(11, 16, 'Family', 'Promotional.', 120, 4, NULL, NULL, 1, 200, '', '0000-00-00 00:00:00.000000', 0, 0, 0, '2016-02-07 20:04:30.000000', '2016-02-07 20:04:30.000000');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tblroom`
--

INSERT INTO `tblroom` (`id`, `buildingID`, `roomCatID`, `desc`, `capacity`, `price`, `startDate`, `endDate`, `isOccupied`, `updated_at`, `created_at`, `roomName`, `landlordID`) VALUES
(5, 13, 2, 'Pied dans l`eau', 4, '4000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-12-07 07:58:18', '2015-12-07 07:58:18', 'Seaside', 3),
(7, 12, 1, 'good', 0, '2000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-07 19:57:15', '2016-02-07 19:57:15', 'Seaview', 3),
(8, 21, 1, 'Nice facility.', 0, '250', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-02-07 20:03:24', '2016-02-07 20:03:24', 'SeaView', 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblroomcat`
--

INSERT INTO `tblroomcat` (`id`, `roomCatName`, `updated_at`, `created_at`) VALUES
(1, 'single', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'double', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbltenant`
--

INSERT INTO `tbltenant` (`ID`, `FirstName`, `LastName`, `Password`, `Email`, `Address`, `Country`, `PostalCode`, `UserName`, `Phone`, `Gender`, `DOB`, `updated_at`, `created_at`, `type`) VALUES
(1, 'Pravin', 'Basdeo', '827ccb0eea8a706c4c34a16891f84e7b', 'lokeshpravin@gmail.com', 'Morcellement saint Andre, Kalimaye Road', 'Mauritius', '7CU007', 'Pravin', 57139151, 'M', '1993-05-20', '2015-10-01 15:55:32', '2015-10-01 15:55:32', 'tenant'),
(2, 'lokesh', 'Basdeo', 'eab99f6eb415a4834a42914a69e7b69c', 'lokesh.pravin@yahoo.com', 'Morcellement Saint Andre, Kalimaye road', 'Mauritius', '742CU001', 'lokesh.pravin', 57070977, 'M', '2015-10-13', '2015-10-11 15:21:37', '2015-10-11 15:21:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbltravel`
--

DROP TABLE IF EXISTS `tbltravel`;
CREATE TABLE IF NOT EXISTS `tbltravel` (
  `id` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `pickUpTime1` datetime(6) NOT NULL,
  `pickUpLocation1` varchar(11) NOT NULL,
  `pickUpDestination1` varchar(11) NOT NULL,
  `pickUpTime2` datetime(6) NOT NULL,
  `pickUpLocation2` varchar(11) NOT NULL,
  `pickUpDestination2` varchar(100) DEFAULT NULL,
  `dispach` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tblvehicle`
--

INSERT INTO `tblvehicle` (`id`, `vehicleCatID`, `vehicleName`, `vehicleOwnerID`, `models`, `color`, `numOfSeats`, `transmission`, `image`, `updated_at`, `created_at`) VALUES
(19, 1, 'dasasd', 1, 'asdas', 'yellow', 2, 'Automatic', '', '2015-12-03 17:20:42', '2015-12-03 17:06:45'),
(20, 2, '3223', 1, 'asdasd', 'red', 23, 'Automatic', '', '2015-12-03 17:20:33', '2015-12-03 17:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `tblvehiclecat`
--

DROP TABLE IF EXISTS `tblvehiclecat`;
CREATE TABLE IF NOT EXISTS `tblvehiclecat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiclecatname` varchar(200) DEFAULT NULL,
  `vehiclecatnameType` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblvehiclecat`
--

INSERT INTO `tblvehiclecat` (`id`, `vehiclecatname`, `vehiclecatnameType`) VALUES
(1, '', 'Car'),
(2, NULL, 'Lorry');

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
