-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2018 at 11:54 AM
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
  `acc_type` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Account_ID`, `Employee_ID`, `Acc_Uname`, `Acc_Pass`, `acc_type`) VALUES
(1, 2122, 'marserrano', '1234', 'admin'),
(3, 123, 'marjaygab1', '12345', 'user');

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
  `Emp_Email` varchar(30) NOT NULL,
  `Emp_Gender` varchar(30) NOT NULL,
  `Emp_CNumber` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_ID`, `Emp_FN`, `Emp_LN`, `Emp_Address`, `Emp_Age`, `Emp_Department`, `Emp_Email`, `Emp_Gender`, `Emp_CNumber`) VALUES
(21221, 'Mar', 'Serranosa', 'Sampaguita', 20, 'CpE', 'mar@gmail.com', 'Male', '639208434262'),
(123, 'Marjay', 'Tapay', '085,', 19, 'Technical', 'tapaymarjay@gmail.com', 'Male', '639153591108');

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

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`room_id`, `emp_id`, `time_in`, `time_out`, `date`, `u_code`, `Status`, `time_millis`) VALUES
('699', '69', '07:00:00', '09:30:00', '2017-03-01', '30082', 1, 9000000);

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
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sched`
--

INSERT INTO `tbl_sched` (`id`, `room_id`, `emp_id`, `time_in`, `time_out`, `date`, `u_code`, `Status`) VALUES
(1, '303', '2343', '10:00:00', '11:00:00', '2018-03-22', '2365T', 0),
(2, '503', '342', '07:00:00', '08:00:00', '2018-03-23', '21452', 0),
(4, '352', '2134', '10:30:00', '12:00:00', '2018-03-30', '21435', 1),
(5, '502', '25367', '11:00:00', '12:00:00', '2018-03-22', '15632', 1),
(6, '211', '7652', '07:30:00', '08:30:00', '2018-03-23', 'DFG67', 1),
(7, '110', '2014', '13:00:00', '15:00:00', '2018-03-16', 'cd456', 0),
(8, '510', '1616', '07:30:00', '10:30:00', '2018-03-16', 'ab123', 0),
(9, '303', '111', '02:00:00', '03:00:00', '2018-03-22', '18466', 1),
(10, '303', '111', '15:00:00', '16:00:00', '2018-03-22', '35246', 1),
(12, '411', '111', '08:00:00', '09:00:00', '2018-04-01', '67306', 1),
(13, '412', '111', '08:00:00', '09:00:00', '2018-04-01', '27083', 1),
(14, '611', '123', '10:00:00', '11:00:00', '2019-03-22', '46174', 1),
(15, '303', '123', '10:00:00', '11:00:00', '2018-03-23', '97105', 1),
(16, '304', '111', '02:00:00', '03:00:00', '2018-03-22', '36023', 1),
(21, '303', '123', '10:00:00', '11:00:00', '2018-03-23', '50387', 1),
(22, '305', '111', '10:00:00', '11:00:00', '2018-03-22', '73008', 1),
(23, '333', '111', '10:00:00', '11:00:00', '2018-03-14', '12345', 1),
(24, '399', '123', '07:00:00', '07:30:00', '2018-03-10', '59896', 1),
(25, '399', '123', '07:00:00', '07:30:00', '2018-03-10', '67864', 1),
(27, '699', '6969', '07:00:00', '09:30:00', '2018-03-01', '27836', 1),
(28, '699', '69', '07:00:00', '09:30:00', '2017-03-01', '30082', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Account_ID`);

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
  MODIFY `Account_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_sched`
--
ALTER TABLE `tbl_sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
