-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2019 at 02:36 AM
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
  `eName` varchar(40) NOT NULL,
  `eRole` varchar(30) NOT NULL,
  `ePassword` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Inventory_Record`
--

CREATE TABLE `Inventory_Record` (
  `itemID` int(10) NOT NULL,
  `itemName` varchar(40) NOT NULL,
  `itemPrice` decimal(5,2) NOT NULL,
  `itemStock` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Sales_Record`
--

CREATE TABLE `Sales_Record` (
  `eID` varchar(30) NOT NULL,
  `itemID` int(10) NOT NULL,
  `salesDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `qty` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Supplier`
--

CREATE TABLE `Supplier` (
  `supID` varchar(30) NOT NULL,
  `supName` varchar(40) NOT NULL,
  `phoneNo` varchar(15) NOT NULL,
  `address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Supplier_Inventory`
--

CREATE TABLE `Supplier_Inventory` (
  `itemID` int(10) NOT NULL,
  `supID` varchar(30) NOT NULL,
  `supDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`eID`);

--
-- Indexes for table `Inventory_Record`
--
ALTER TABLE `Inventory_Record`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `Sales_Record`
--
ALTER TABLE `Sales_Record`
  ADD PRIMARY KEY (`eID`,`itemID`,`salesDate`),
  ADD KEY `itemID` (`itemID`);

--
-- Indexes for table `Supplier`
--
ALTER TABLE `Supplier`
  ADD PRIMARY KEY (`supID`);

--
-- Indexes for table `Supplier_Inventory`
--
ALTER TABLE `Supplier_Inventory`
  ADD PRIMARY KEY (`itemID`,`supID`,`supDate`),
  ADD KEY `supID` (`supID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Inventory_Record`
--
ALTER TABLE `Inventory_Record`
  MODIFY `itemID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Sales_Record`
--
ALTER TABLE `Sales_Record`
  MODIFY `itemID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Supplier_Inventory`
--
ALTER TABLE `Supplier_Inventory`
  MODIFY `itemID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Sales_Record`
--
ALTER TABLE `Sales_Record`
  ADD CONSTRAINT `sales_record_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `Inventory_Record` (`itemID`);

--
-- Constraints for table `Supplier_Inventory`
--
ALTER TABLE `Supplier_Inventory`
  ADD CONSTRAINT `supplier_inventory_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `Inventory_Record` (`itemID`),
  ADD CONSTRAINT `supplier_inventory_ibfk_2` FOREIGN KEY (`supID`) REFERENCES `Supplier` (`supID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
