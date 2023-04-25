-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2022 at 05:29 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vpmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblregqr`
--

CREATE TABLE `tblregqr` (
  `ID` int(255) NOT NULL,
  `FirstName` varchar(250) DEFAULT NULL,
  `LastName` varchar(250) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `PlateNumber` text  DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblregusers`
--

INSERT INTO `tblregqr` (`ID`, `FirstName`, `LastName`, `MobileNumber`,`PlateNumber`, `Email`, `RegDate`) VALUES
(2, 'FirstName', 'Lastname', 1234567890, 'email@gmail.com','FTE13', 'f925916e2754e5e03f75dd58a5733251', '2022-05-10 18:05:56');
('https://dione.batstate-u.edu.ph/student/backend/public/view/id_copy?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzY2hvb2x5ZWFyIjoiMjAyMS0yMDIyIiwic2VtZXN0ZXIiOiJTRUNPTkQiLCJzcmNvZGUiOiIxOC0yOTgwOCJ9.F9YaT0lKJUdtqWReGCHVm0QmoosW_gXKGWt3VP1OWsU', '2022-03-27 23:53:31');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
