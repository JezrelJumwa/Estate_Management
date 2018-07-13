-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2018 at 12:13 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentals`
--
CREATE DATABASE IF NOT EXISTS `rentals` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rentals`;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `BookingId` int(11) NOT NULL AUTO_INCREMENT,
  `BookingStatus` varchar(100) NOT NULL,
  PRIMARY KEY (`BookingId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BookingId`, `BookingStatus`) VALUES
(1, 'AVAILABE'),
(2, 'UNAVAILABE');

-- --------------------------------------------------------

--
-- Table structure for table `estate`
--

DROP TABLE IF EXISTS `estate`;
CREATE TABLE IF NOT EXISTS `estate` (
  `EstateId` int(11) NOT NULL AUTO_INCREMENT,
  `EstateName` varchar(100) NOT NULL,
  `EstateLocation` varchar(100) NOT NULL,
  `HouseId` int(11) NOT NULL,
  PRIMARY KEY (`EstateId`),
  KEY `HouseId` (`HouseId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estate`
--

INSERT INTO `estate` (`EstateId`, `EstateName`, `EstateLocation`, `HouseId`) VALUES
(1, 'Pangan', 'Westalands', 1);

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

DROP TABLE IF EXISTS `house`;
CREATE TABLE IF NOT EXISTS `house` (
  `HouseId` int(11) NOT NULL AUTO_INCREMENT,
  `HouseNumber` int(11) NOT NULL,
  `Rent` varchar(100) NOT NULL,
  `HouseType` varchar(100) NOT NULL,
  `FilePath` varchar(100) NOT NULL,
  `FileName` varchar(100) NOT NULL,
  PRIMARY KEY (`HouseId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`HouseId`, `HouseNumber`, `Rent`, `HouseType`, `FilePath`, `FileName`) VALUES
(1, 1, '23000', 'Bangalo', 'files/image_1.jpg', 'image_i.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `housebooking`
--

DROP TABLE IF EXISTS `housebooking`;
CREATE TABLE IF NOT EXISTS `housebooking` (
  `HouseBookingId` int(11) NOT NULL AUTO_INCREMENT,
  `SystemUserId` int(11) NOT NULL,
  `HouseId` int(11) NOT NULL,
  `BookingId` int(11) NOT NULL,
  PRIMARY KEY (`HouseBookingId`),
  KEY `HouseId` (`HouseId`),
  KEY `BookingId` (`BookingId`),
  KEY `SystemUserId` (`SystemUserId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `housebooking`
--

INSERT INTO `housebooking` (`HouseBookingId`, `SystemUserId`, `HouseId`, `BookingId`) VALUES
(1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `StatusId` int(11) NOT NULL AUTO_INCREMENT,
  `StatusName` varchar(100) NOT NULL,
  PRIMARY KEY (`StatusId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`StatusId`, `StatusName`) VALUES
(1, 'ACTIVE'),
(2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `systemright`
--

DROP TABLE IF EXISTS `systemright`;
CREATE TABLE IF NOT EXISTS `systemright` (
  `SystemRightId` int(11) NOT NULL AUTO_INCREMENT,
  `SystemRoleId` int(11) NOT NULL,
  `MenuName` varchar(100) NOT NULL,
  `Page` varchar(100) NOT NULL,
  PRIMARY KEY (`SystemRightId`),
  KEY `SystemRoleId` (`SystemRoleId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemright`
--

INSERT INTO `systemright` (`SystemRightId`, `SystemRoleId`, `MenuName`, `Page`) VALUES
(1, 1, 'REGISTER USER', '?pg=01'),
(2, 1, 'USER LIST', '?pg=02'),
(3, 1, 'REGISTER HOUSE', '?pg=03'),
(4, 1, 'LIST HOUSES', '?pg=04'),
(5, 1, 'REGISTER ESTATE', '?pg=05'),
(6, 1, 'LIST ESTATE', '?pg=06'),
(7, 2, 'REGISTER TENANTS', '?pg=01'),
(8, 2, 'LIST TENANTS', '?pg=02'),
(9, 2, 'REGISTER HOUSE', '?pg=03'),
(10, 2, 'LIST HOUSES', '?PG=04');

-- --------------------------------------------------------

--
-- Table structure for table `systemroles`
--

DROP TABLE IF EXISTS `systemroles`;
CREATE TABLE IF NOT EXISTS `systemroles` (
  `SystemRoleId` int(11) NOT NULL AUTO_INCREMENT,
  `SystemUserId` int(11) NOT NULL,
  `SystemRoleName` varchar(100) NOT NULL,
  PRIMARY KEY (`SystemRoleId`),
  KEY `SystemUserId` (`SystemUserId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemroles`
--

INSERT INTO `systemroles` (`SystemRoleId`, `SystemUserId`, `SystemRoleName`) VALUES
(1, 1, 'ADMINISTRATOR'),
(2, 2, 'LANDLORD'),
(3, 3, 'TENANT');

-- --------------------------------------------------------

--
-- Table structure for table `systemusercridentials`
--

DROP TABLE IF EXISTS `systemusercridentials`;
CREATE TABLE IF NOT EXISTS `systemusercridentials` (
  `SystemUserCridentialsId` int(11) NOT NULL AUTO_INCREMENT,
  `SystemUserId` int(11) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`SystemUserCridentialsId`),
  KEY `SystemUserId` (`SystemUserId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemusercridentials`
--

INSERT INTO `systemusercridentials` (`SystemUserCridentialsId`, `SystemUserId`, `Password`) VALUES
(1, 1, 'a45da96d0bf6575970f2d27af22be28a'),
(2, 2, 'a45da96d0bf6575970f2d27af22be28a');

-- --------------------------------------------------------

--
-- Table structure for table `systemusers`
--

DROP TABLE IF EXISTS `systemusers`;
CREATE TABLE IF NOT EXISTS `systemusers` (
  `SystemUserId` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `OtherName` varchar(100) NOT NULL,
  `IdNumber` int(11) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  PRIMARY KEY (`SystemUserId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemusers`
--

INSERT INTO `systemusers` (`SystemUserId`, `FirstName`, `LastName`, `OtherName`, `IdNumber`, `Gender`) VALUES
(1, 'Jezrel', 'Jumwa', 'Kililo', 33513668, 'Male'),
(2, 'Sammy', 'Khamusali', 'Ongaya', 28265641, 'Male'),
(3, 'Julius', 'Muteti', 'Mwanyalo', 1234567, 'Male'),
(4, 'Julius', 'Ngamate', 'Wanyoike', 243562, 'Male'),
(5, 'Agnettah', 'Wasai', 'Mwaviswa', 11313910, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `systemuserstatus`
--

DROP TABLE IF EXISTS `systemuserstatus`;
CREATE TABLE IF NOT EXISTS `systemuserstatus` (
  `SystemUserStatusId` int(11) NOT NULL AUTO_INCREMENT,
  `SystemUserId` int(11) NOT NULL,
  `StatusId` int(11) NOT NULL,
  PRIMARY KEY (`SystemUserStatusId`),
  KEY `SystemUserId` (`SystemUserId`),
  KEY `StatusId` (`StatusId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemuserstatus`
--

INSERT INTO `systemuserstatus` (`SystemUserStatusId`, `SystemUserId`, `StatusId`) VALUES
(1, 1, 1),
(2, 2, 1),
(8, 3, 1),
(9, 4, 1),
(13, 5, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estate`
--
ALTER TABLE `estate`
  ADD CONSTRAINT `estate_ibfk_1` FOREIGN KEY (`HouseId`) REFERENCES `house` (`HouseId`);

--
-- Constraints for table `housebooking`
--
ALTER TABLE `housebooking`
  ADD CONSTRAINT `housebooking_ibfk_1` FOREIGN KEY (`HouseId`) REFERENCES `house` (`HouseId`),
  ADD CONSTRAINT `housebooking_ibfk_2` FOREIGN KEY (`BookingId`) REFERENCES `booking` (`BookingId`),
  ADD CONSTRAINT `housebooking_ibfk_3` FOREIGN KEY (`SystemUserId`) REFERENCES `systemusers` (`SystemUserId`);

--
-- Constraints for table `systemright`
--
ALTER TABLE `systemright`
  ADD CONSTRAINT `systemright_ibfk_1` FOREIGN KEY (`SystemRoleId`) REFERENCES `systemroles` (`SystemRoleId`);

--
-- Constraints for table `systemroles`
--
ALTER TABLE `systemroles`
  ADD CONSTRAINT `systemroles_ibfk_1` FOREIGN KEY (`SystemUserId`) REFERENCES `systemusers` (`SystemUserId`);

--
-- Constraints for table `systemusercridentials`
--
ALTER TABLE `systemusercridentials`
  ADD CONSTRAINT `systemusercridentials_ibfk_1` FOREIGN KEY (`SystemUserId`) REFERENCES `systemusers` (`SystemUserId`);

--
-- Constraints for table `systemuserstatus`
--
ALTER TABLE `systemuserstatus`
  ADD CONSTRAINT `systemuserstatus_ibfk_1` FOREIGN KEY (`SystemUserId`) REFERENCES `systemusers` (`SystemUserId`),
  ADD CONSTRAINT `systemuserstatus_ibfk_2` FOREIGN KEY (`StatusId`) REFERENCES `status` (`StatusId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
