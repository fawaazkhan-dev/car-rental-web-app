-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2022 at 07:17 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `AccountType` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Username`, `Password`, `AccountType`) VALUES
('mess', '$2y$10$OYx3199fRJSuD.HlrKau9ORo5hXCwv.ZD9g.k8JYJcWxyUDOhP5Ty', NULL),
('messi', '$2y$10$hXbfjc8ZI1AxA4LsENGx2ul534gk2PFukv2RqZMSmbl6djOg6LRQW', 'customer'),
('ronaldo', '0', '0'),
('sega', '$2y$10$dUK5OM5tUvDHMCUZzaHC8uSZL3oDu5yBgMPiUjP5CmjWjuIZ.Ntem', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `bookdetails`
--

CREATE TABLE `bookdetails` (
  `Book_Id` int(10) NOT NULL,
  `PickUpDate` date NOT NULL,
  `ReturnDate` date NOT NULL,
  `ActualReturnDate` date NOT NULL,
  `BookingStatus` varchar(30) NOT NULL,
  `Reg_No` varchar(25) NOT NULL,
  `Customer_Id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `Reg_No` varchar(25) NOT NULL,
  `Make` varchar(15) NOT NULL,
  `Model` varchar(15) NOT NULL,
  `Year` int(5) NOT NULL,
  `Milege` int(10) NOT NULL,
  `CostPerDay` int(10) NOT NULL,
  `LateFeePerDay` int(10) NOT NULL,
  `Location` varchar(40) NOT NULL,
  `Category_Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`Reg_No`, `Make`, `Model`, `Year`, `Milege`, `CostPerDay`, `LateFeePerDay`, `Location`, `Category_Name`) VALUES
('ABX102543', 'Toyota', 'Supra', 2016, 10050, 900, 950, 'moka', 'Compact'),
('ABX155354', 'Honda', 'Civic', 2016, 16600, 900, 950, 'reduit', 'Economy'),
('ASD152671', 'Mazda', 'Mazda-3', 2018, 10000, 750, 800, 'rose belle', 'Standard');

-- --------------------------------------------------------

--
-- Table structure for table `carcategory`
--

CREATE TABLE `carcategory` (
  `Category_Name` varchar(10) NOT NULL,
  `NumOfLaguage` int(35) NOT NULL,
  `NumOfSeat` int(10) NOT NULL,
  `TypeOfcar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carcategory`
--

INSERT INTO `carcategory` (`Category_Name`, `NumOfLaguage`, `NumOfSeat`, `TypeOfcar`) VALUES
(' Full', 4, 5, 'Petrol'),
('Compact', 3, 5, 'Petrol'),
('Economy', 2, 5, 'Petrol'),
('Electric S', 3, 5, 'Petrol'),
('Luxury', 5, 5, 'Diesel'),
('Mid size ', 3, 5, 'Diesel'),
('Mid van ', 5, 7, 'Petrol'),
('Mid-size-S', 2, 5, 'Petrol'),
('Standard', 3, 5, 'Electric'),
('SUV', 2, 8, 'Petrol');

-- --------------------------------------------------------

--
-- Table structure for table `carinsurance`
--

CREATE TABLE `carinsurance` (
  `Insurance_Code` int(10) NOT NULL,
  `InsuranceName` varchar(25) NOT NULL,
  `CostType` varchar(20) NOT NULL,
  `CostPerDay` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_Id` int(10) NOT NULL,
  `License_No` int(10) NOT NULL,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Phone_number` int(25) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Sex` varchar(10) NOT NULL,
  `Country` varchar(30) DEFAULT NULL,
  `Street` varchar(40) DEFAULT NULL,
  `City` varchar(25) DEFAULT NULL,
  `Username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_Id`, `License_No`, `First_Name`, `Last_Name`, `Phone_number`, `Email`, `Sex`, `Country`, `Street`, `City`, `Username`) VALUES
(1, 215134, 'ronaldo', 'cristiano', 59270754, 'cr7@gmail.com', 'male', 'portugal', 'Railway road', 'Belle vue maurel', 'Ronaldo'),
(2, 12345, 'segaren', 'cooroopdass', 597836458, 'scooroopdass@gmail.com', 'male', 'mauritius', 'railway', 'belle vue maurel', 'null'),
(8, 201236, 'Messi', 'Louis', 78945612, 'messi@gmail.com', 'male', NULL, NULL, NULL, 'messi'),
(9, 789456, 'Segaren', 'Cooroopdoss', 1234, 'messi@gmail.com', 'male', NULL, NULL, NULL, 'sega');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `Owner_id` int(10) NOT NULL,
  `Status` int(5) NOT NULL,
  `First_Name` varchar(25) NOT NULL,
  `Last_Name` varchar(25) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `PhoneNumber` int(10) NOT NULL,
  `Sex` char(8) NOT NULL,
  `Street` varchar(25) NOT NULL,
  `City` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_Id` int(10) NOT NULL,
  `Book_Id` int(10) DEFAULT NULL,
  `Date` date NOT NULL,
  `Amount` int(10) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Direction` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Review_id` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Flagged` int(11) NOT NULL,
  `Banned` int(11) NOT NULL,
  `Comment` varchar(30) NOT NULL,
  `Rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `bookdetails`
--
ALTER TABLE `bookdetails`
  ADD PRIMARY KEY (`Book_Id`),
  ADD KEY `test4` (`Customer_Id`),
  ADD KEY `test5` (`Reg_No`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`Reg_No`),
  ADD KEY `test` (`Category_Name`);

--
-- Indexes for table `carcategory`
--
ALTER TABLE `carcategory`
  ADD PRIMARY KEY (`Category_Name`);

--
-- Indexes for table `carinsurance`
--
ALTER TABLE `carinsurance`
  ADD PRIMARY KEY (`Insurance_Code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_Id`),
  ADD KEY `test3` (`Username`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`Owner_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_Id`),
  ADD KEY `test2` (`Book_Id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Review_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookdetails`
--
ALTER TABLE `bookdetails`
  MODIFY `Book_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carinsurance`
--
ALTER TABLE `carinsurance`
  MODIFY `Insurance_Code` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `Owner_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Review_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookdetails`
--
ALTER TABLE `bookdetails`
  ADD CONSTRAINT `test5` FOREIGN KEY (`Reg_No`) REFERENCES `car` (`Reg_No`);

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `test` FOREIGN KEY (`Category_Name`) REFERENCES `carcategory` (`Category_name`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `test3` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `test2` FOREIGN KEY (`Book_Id`) REFERENCES `bookdetails` (`Book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
