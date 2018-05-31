-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2018 at 05:08 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sched`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Account_ID` int(11) NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  `Acc_Uname` varchar(50) NOT NULL,
  `Acc_Pass` varchar(50) NOT NULL,
  `acc_type` varchar(5) NOT NULL,
  `count` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Account_ID`, `Employee_ID`, `Acc_Uname`, `Acc_Pass`, `acc_type`, `count`) VALUES
(1, 2122, 'marserrano', '12345', 'admin', 0),
(3, 123, 'marjaygab1', 'marj01', 'user', 0),
(4, 678, 'mishelkate', '12345', '', 0),
(5, 2014164791, 'alaindannpaciteng', 'nexus777esports', '', 0),
(123456, 1234567890, 'user', 'password', 'user', 0),
(123457, 123, 'marmar', 'marmar', '', 0),
(123460, 2018, 'bren', 'loria', 'user', 0),
(123461, 2019, 'alain', 'dann', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `announcement_table`
--

CREATE TABLE `announcement_table` (
  `ID` int(11) NOT NULL,
  `announcements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement_table`
--

INSERT INTO `announcement_table` (`ID`, `announcements`) VALUES
(1, 'Server Maintenance on May 3, 2018.'),
(2, 'Please contact your Server Administrator for any inconvenience.');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_ID` int(11) NOT NULL,
  `Emp_FN` varchar(30) NOT NULL,
  `Emp_LN` varchar(30) NOT NULL,
  `Emp_Address` varchar(50) NOT NULL,
  `Emp_Age` int(11) NOT NULL,
  `Emp_Department` varchar(30) NOT NULL,
  `Emp_Email` varchar(50) NOT NULL,
  `Emp_Gender` varchar(30) NOT NULL,
  `Emp_CNumber` varchar(12) NOT NULL,
  `Emp_Photo` varchar(100) NOT NULL,
  `Emp_Status` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_ID`, `Emp_FN`, `Emp_LN`, `Emp_Address`, `Emp_Age`, `Emp_Department`, `Emp_Email`, `Emp_Gender`, `Emp_CNumber`, `Emp_Photo`, `Emp_Status`) VALUES
(2122, 'Mar Christian', 'Serrano', 'Sampaguita West, Sampaguita', 20, 'CpE', 'o1b.serrano.marchristian@gmail.com', 'Male', '639208434262', '59641db9ac.jpg', 'ACTIVE'),
(123, 'Marjay', 'Tapay', '085,', 19, 'Technical', 'tapaymarjay@gmail.com', 'Male', '639153591108', '275c1c39a0.jpg', 'ACTIVE'),
(1234567890, 'alain', 'dann', 'alaindannpaciteng@gmail.com', 20, 'CpE', 'alaindannpaciteng@gmail.com', 'Male', '639232323232', '', 'INACTIVE'),
(123, 'Mar', 'Serrano', 'Sampaguita', 20, 'CpE', 'marserrano039@gmail.com', 'Male', '639232272555', '', 'INACTIVE'),
(2018, 'Bren Steven', 'Loria', 'Dubai', 20, 'CoE', 'bren.loria@gmail.com', 'Male', '09236969696', '', 'ACTIVE'),
(2019, 'Alain Dann', 'Paciteng', 'Tangway', 21, 'CpE', 'alainpaciteng@gmail.com', 'Male', '639232272555', '', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `room_id` varchar(5) NOT NULL,
  `emp_id` varchar(5) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `date` date NOT NULL,
  `u_code` varchar(5) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `time_millis` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomlist`
--

CREATE TABLE `tbl_roomlist` (
  `room_id` varchar(5) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_bldg` varchar(100) NOT NULL,
  `room_floor` varchar(50) NOT NULL,
  `mac_address` varchar(100) NOT NULL,
  `Amenities` varchar(1000) NOT NULL,
  `Pax` int(200) NOT NULL,
  `Room_Status` varchar(100) NOT NULL,
  `timeframe_in` time NOT NULL DEFAULT '08:00:00',
  `timeframe_out` time NOT NULL DEFAULT '17:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roomlist`
--

INSERT INTO `tbl_roomlist` (`room_id`, `room_name`, `room_bldg`, `room_floor`, `mac_address`, `Amenities`, `Pax`, `Room_Status`, `timeframe_in`, `timeframe_out`) VALUES
('208', 'CpE Lab', 'Mabini Building', '2', 'DEAD:BEEF:FEED', 'Lights,Table,Chairs,Projector', 20, 'FREE', '01:00:00', '17:00:00'),
('510', 'MAC Laboratory', 'Mabini Building', '5', 'FFFF:ED23:WQPR', 'Lights,Table,Chairs,Projector', 40, 'FREE', '00:00:00', '00:00:00'),
('509', 'Mobile Laboratory', 'Mabini Building', '5', 'DDDD:1234:CBDA', 'Lights,Table,Chairs,Projector', 60, 'FREE', '04:00:00', '23:00:00'),
('101', 'Mobile Room', 'Mabini Building', '1', 'CCCC:DDDD:AAAA', 'Lights,Table,Chairs,Projector', 20, 'FREE', '04:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sched`
--

CREATE TABLE `tbl_sched` (
  `id` int(11) NOT NULL,
  `room_id` varchar(5) NOT NULL,
  `emp_id` varchar(5) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `date` date NOT NULL,
  `u_code` varchar(5) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `time_millis` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sched`
--

INSERT INTO `tbl_sched` (`id`, `room_id`, `emp_id`, `time_in`, `time_out`, `date`, `u_code`, `Status`, `time_millis`) VALUES
(43, '208', '2122', '09:00:00', '10:00:00', '2018-05-11', '79882', 0, NULL),
(44, '509', '2122', '09:00:00', '10:00:00', '2018-05-11', '38935', 0, NULL),
(45, '101', '2122', '09:00:00', '10:00:00', '2018-05-11', '68023', 0, NULL),
(48, '208', '2122', '15:00:00', '16:00:00', '2018-05-15', '20206', 0, NULL),
(49, '208', '2122', '15:00:00', '16:00:00', '2018-05-15', '55883', 0, NULL),
(50, '208', '2122', '16:00:00', '17:00:00', '2018-05-15', '39099', 0, NULL),
(51, '208', '2122', '17:00:00', '18:00:00', '2018-05-15', '91327', 0, NULL),
(52, '208', '2122', '09:00:00', '10:00:00', '2018-05-21', '79065', 0, NULL),
(53, '208', '2122', '09:00:00', '10:00:00', '2018-05-22', '36853', 0, NULL),
(54, '208', '2122', '09:00:00', '10:00:00', '2018-05-21', '94960', 0, NULL),
(55, '101', '2122', '11:00:00', '11:30:00', '2018-05-22', '99921', 0, NULL),
(56, '208', '2122', '05:00:00', '06:00:00', '2018-05-28', '18096', 0, NULL),
(57, '509', '2122', '18:00:00', '22:00:00', '2018-05-29', '123ab', 0, NULL),
(58, '509', '123', '21:00:00', '22:00:00', '2018-06-06', '75223', 1, 3600000),
(60, '208', '2122', '18:40:00', '19:00:00', '2018-05-31', '43834', 1, NULL),
(61, '208', '2122', '09:00:00', '10:00:00', '2018-06-01', '15435', 1, 1000),
(62, '509', '2122', '09:00:00', '10:00:00', '2018-06-03', '66130', 1, 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Account_ID`);

--
-- Indexes for table `announcement_table`
--
ALTER TABLE `announcement_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_sched`
--
ALTER TABLE `tbl_sched`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `Account_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123462;
--
-- AUTO_INCREMENT for table `announcement_table`
--
ALTER TABLE `announcement_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_sched`
--
ALTER TABLE `tbl_sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
