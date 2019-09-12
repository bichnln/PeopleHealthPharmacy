-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 12, 2019 at 03:32 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PHP`
--

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `eID` varchar(30) NOT NULL,
  `eName` varchar(40) DEFAULT NULL,
  `eRole` varchar(30) DEFAULT NULL,
  `ePassWord` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Inventory_Record`
--

CREATE TABLE `Inventory_Record` (
  `itemID` int(10) NOT NULL,
  `itemName` varchar(40) DEFAULT NULL,
  `itemPrice` decimal(5,2) DEFAULT NULL,
  `itemStock` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Sales_Record`
--

CREATE TABLE `Sales_Record` (
  `eID` varchar(30) NOT NULL,
  `itemID` int(10) NOT NULL,
  `salesDate` datetime NOT NULL,
  `qty` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Supplier`
--

CREATE TABLE `Supplier` (
  `supID` varchar(30) NOT NULL,
  `supName` varchar(40) DEFAULT NULL,
  `phoneNo` varchar(15) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Supplier_Inventory`
--

CREATE TABLE `Supplier_Inventory` (
  `itemID` int(10) NOT NULL,
  `supID` varchar(30) NOT NULL,
  `supDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`eID`),
  ADD UNIQUE KEY `eID` (`eID`);

--
-- Indexes for table `Inventory_Record`
--
ALTER TABLE `Inventory_Record`
  ADD PRIMARY KEY (`itemID`),
  ADD UNIQUE KEY `itemID` (`itemID`);

--
-- Indexes for table `Sales_Record`
--
ALTER TABLE `Sales_Record`
  ADD PRIMARY KEY (`eID`,`itemID`,`salesDate`);

--
-- Indexes for table `Supplier`
--
ALTER TABLE `Supplier`
  ADD PRIMARY KEY (`supID`),
  ADD UNIQUE KEY `supID` (`supID`);

--
-- Indexes for table `Supplier_Inventory`
--
ALTER TABLE `Supplier_Inventory`
  ADD PRIMARY KEY (`itemID`,`supID`,`supDate`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
