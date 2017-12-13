-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2017 at 07:01 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysterymanila`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branchID` int(11) NOT NULL,
  `branchname` varchar(45) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branchID`, `branchname`, `status`) VALUES
(2, 'Century Mall', 0),
(3, '30th Ayala Mall ', 0),
(4, 'Katipunan Branch ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `legendstatus`
--

CREATE TABLE `legendstatus` (
  `legendStatusID` int(11) NOT NULL,
  `legendStatus` varchar(45) NOT NULL,
  `sensorTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `legendstatus`
--

INSERT INTO `legendstatus` (`legendStatusID`, `legendStatus`, `sensorTypeID`) VALUES
(33, 'Red is the dominant color', 1),
(34, 'Normal Sensor', 11),
(35, 'No Light Captured', 12),
(36, 'On', 13),
(37, 'Off', 13),
(38, 'Cold ', 14),
(39, 'Hot ', 14);

-- --------------------------------------------------------

--
-- Table structure for table `legendstatusdetails`
--

CREATE TABLE `legendstatusdetails` (
  `legendStatusDetailID` int(11) NOT NULL,
  `legendStatusID` int(11) NOT NULL,
  `legendVariableName` varchar(45) NOT NULL,
  `legendValue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `legendstatusdetails`
--

INSERT INTO `legendstatusdetails` (`legendStatusDetailID`, `legendStatusID`, `legendVariableName`, `legendValue`) VALUES
(16, 33, 'R', 15),
(17, 33, 'G', 24),
(18, 33, 'B', 6),
(19, 34, 'Stat', 12),
(20, 35, 'Light', 10000),
(21, 36, 'Status', 1),
(22, 37, 'Status', 0),
(23, 38, 'Temp', 0),
(24, 39, 'Temp', 100);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomID` int(11) NOT NULL,
  `roomName` varchar(45) NOT NULL,
  `roomDescription` varchar(100) NOT NULL,
  `branchID` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomID`, `roomName`, `roomDescription`, `branchID`, `status`) VALUES
(1, 'Harry Potter Room', 'Harry Potter Theme', 2, 0),
(2, 'Scary Room', 'A very scary room', 2, 0),
(3, 'Magic Room', 'A magical room', 4, 0),
(5, 'Murder Room ', 'Crime Scene ', 2, 1),
(6, 'Banana ', 'Rooms', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rpi`
--

CREATE TABLE `rpi` (
  `rpiID` int(11) NOT NULL,
  `rpiName` varchar(45) NOT NULL,
  `ipAddress` varchar(45) NOT NULL,
  `roomID` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rpi`
--

INSERT INTO `rpi` (`rpiID`, `rpiName`, `ipAddress`, `roomID`, `status`) VALUES
(1, 'MyFirstRpi', '192.168.35.40', 1, 0),
(2, 'MySecondRpi', '192.145.20.50', 2, 0),
(3, 'MyThirdRpi', '192.168.75.2', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `sensorID` int(11) NOT NULL,
  `sensorName` varchar(45) NOT NULL,
  `rpiID` int(11) NOT NULL,
  `sensorTypeID` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`sensorID`, `sensorName`, `rpiID`, `sensorTypeID`, `status`) VALUES
(5, 'Color Sensor1', 1, 1, 0),
(6, 'Color Sensor2', 2, 1, 0),
(7, 'Color Sensor3', 1, 1, 0),
(8, 'Color Sensor4', 2, 1, 0),
(9, 'Normal Sensor1', 1, 11, 0),
(10, 'Photoresistor1', 1, 12, 0),
(11, 'Colored', 1, 1, 0),
(12, 'Temperature Sensor', 2, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sensortypes`
--

CREATE TABLE `sensortypes` (
  `sensorTypeID` int(11) NOT NULL,
  `sensorType` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sensortypes`
--

INSERT INTO `sensortypes` (`sensorTypeID`, `sensorType`) VALUES
(1, 'Color Switch '),
(11, 'Normal Sensor'),
(12, 'Photo Resistor'),
(13, 'Switch'),
(14, 'Temperature ');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusID` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `sensorID` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusID`, `status`, `sensorID`, `timestamp`) VALUES
(483, 'RED IS THE DOMINANT COLOR', 5, '2017-05-10 21:21:12'),
(484, 'PINK IS THE DOMINANT COLOR', 6, '2016-04-11 01:11:24'),
(485, 'BLUE IS THE DOMINANT COLOR', 5, '2015-03-12 00:01:36'),
(486, 'GREEN IS THE DOMINANT COLOR', 8, '2014-02-13 23:16:48'),
(487, 'WHITE IS THE DOMINANT COLOR', 7, '2013-01-14 22:18:00'),
(488, 'Active', 9, '2013-01-14 23:18:00'),
(489, 'Light Registered', 10, '2014-12-12 07:08:09'),
(490, 'No Light Captured', 10, '2013-12-12 07:08:07'),
(491, 'Inactive', 9, '2012-10-10 09:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `statusdetails`
--

CREATE TABLE `statusdetails` (
  `statusDetailID` int(11) NOT NULL,
  `statusID` int(11) NOT NULL,
  `variableName` varchar(45) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statusdetails`
--

INSERT INTO `statusdetails` (`statusDetailID`, `statusID`, `variableName`, `value`) VALUES
(1889, 483, 'R', 15),
(1890, 483, 'G', 24),
(1891, 483, 'B', 6),
(1892, 484, 'R', 26),
(1893, 484, 'G', 67),
(1894, 484, 'B', 5),
(1895, 485, 'R', 79),
(1896, 485, 'G', 94),
(1897, 485, 'B', 4),
(1898, 486, 'R', 85),
(1899, 486, 'G', 1),
(1900, 486, 'B', 3),
(1901, 487, 'R', 94),
(1902, 487, 'G', 2),
(1903, 487, 'B', 3),
(1904, 488, 'Stat', 1),
(1905, 489, 'Light', 2500),
(1906, 490, 'Light', 10000),
(1907, 491, 'Stat', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `userTypeID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `userTypeID`, `branchID`) VALUES
(1, 'Patrick ', '*A4B6157319038724E3560894F7F932C8886EBFCF', 1, 2),
(5, 'Johann ', '*A4B6157319038724E3560894F7F932C8886EBFCF', 2, 2),
(6, 'GameMaster ', '*A4B6157319038724E3560894F7F932C8886EBFCF', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `userTypeID` int(11) NOT NULL,
  `userType` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`userTypeID`, `userType`) VALUES
(1, 'Admin'),
(2, 'Game Master');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branchID`);

--
-- Indexes for table `legendstatus`
--
ALTER TABLE `legendstatus`
  ADD PRIMARY KEY (`legendStatusID`),
  ADD KEY `sensorTypeID` (`sensorTypeID`);

--
-- Indexes for table `legendstatusdetails`
--
ALTER TABLE `legendstatusdetails`
  ADD PRIMARY KEY (`legendStatusDetailID`),
  ADD KEY `legendStatusID` (`legendStatusID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomID`),
  ADD KEY `branchID` (`branchID`);

--
-- Indexes for table `rpi`
--
ALTER TABLE `rpi`
  ADD PRIMARY KEY (`rpiID`),
  ADD KEY `roomID` (`roomID`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`sensorID`),
  ADD KEY `rpiID` (`rpiID`),
  ADD KEY `sensorTypeID` (`sensorTypeID`);

--
-- Indexes for table `sensortypes`
--
ALTER TABLE `sensortypes`
  ADD PRIMARY KEY (`sensorTypeID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusID`),
  ADD KEY `sensorID` (`sensorID`);

--
-- Indexes for table `statusdetails`
--
ALTER TABLE `statusdetails`
  ADD PRIMARY KEY (`statusDetailID`),
  ADD KEY `statusID` (`statusID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userTypeID` (`userTypeID`,`branchID`),
  ADD KEY `branchID` (`branchID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`userTypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `legendstatus`
--
ALTER TABLE `legendstatus`
  MODIFY `legendStatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `legendstatusdetails`
--
ALTER TABLE `legendstatusdetails`
  MODIFY `legendStatusDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rpi`
--
ALTER TABLE `rpi`
  MODIFY `rpiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `sensorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sensortypes`
--
ALTER TABLE `sensortypes`
  MODIFY `sensorTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=492;
--
-- AUTO_INCREMENT for table `statusdetails`
--
ALTER TABLE `statusdetails`
  MODIFY `statusDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1908;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `userTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `legendstatus`
--
ALTER TABLE `legendstatus`
  ADD CONSTRAINT `legendstatus_ibfk_1` FOREIGN KEY (`sensorTypeID`) REFERENCES `sensortypes` (`sensorTypeID`);

--
-- Constraints for table `legendstatusdetails`
--
ALTER TABLE `legendstatusdetails`
  ADD CONSTRAINT `legendstatusdetails_ibfk_1` FOREIGN KEY (`legendStatusID`) REFERENCES `legendstatus` (`legendStatusID`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`);

--
-- Constraints for table `rpi`
--
ALTER TABLE `rpi`
  ADD CONSTRAINT `rpi_ibfk_1` FOREIGN KEY (`roomID`) REFERENCES `rooms` (`roomID`);

--
-- Constraints for table `sensors`
--
ALTER TABLE `sensors`
  ADD CONSTRAINT `sensors_ibfk_1` FOREIGN KEY (`rpiID`) REFERENCES `rpi` (`rpiID`),
  ADD CONSTRAINT `sensors_ibfk_2` FOREIGN KEY (`sensorTypeID`) REFERENCES `sensortypes` (`sensorTypeID`);

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`sensorID`) REFERENCES `sensors` (`sensorID`);

--
-- Constraints for table `statusdetails`
--
ALTER TABLE `statusdetails`
  ADD CONSTRAINT `statusdetails_ibfk_1` FOREIGN KEY (`statusID`) REFERENCES `status` (`statusID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userTypeID`) REFERENCES `usertype` (`userTypeID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
