-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 07:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khr`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_id` int(11) NOT NULL,
  `Fullname` varchar(50) NOT NULL,
  `Lastname` varchar(30) NOT NULL,
  `Affiliation` varchar(50) NOT NULL,
  `Phone No` varchar(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `middle` varchar(20) NOT NULL,
  `gender` varchar(12) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_id`, `Fullname`, `Lastname`, `Affiliation`, `Phone No`, `Email`, `middle`, `gender`, `Username`, `Password`, `Status`) VALUES
(36, 'Daniel', 'Padilia', '', '09237373732', 'amil@gmail.com', '', '', 'daniel', '12', 1),
(48, 'asefc', 'scfe', '', '09237373732', 'amil@gmail.com', '', 'Male', 'sefc', 'e', 1),
(49, 'esef', 'esadfece', '', '09237373732', 'amil@gmail.com', 'dd', 'Male', 'wesfdew', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `Expdate` date DEFAULT NULL,
  `events` varchar(50) NOT NULL,
  `Status` varchar(11) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `currents_dates` date NOT NULL DEFAULT current_timestamp(),
  `Duration` varchar(11) DEFAULT NULL,
  `Amount` int(20) NOT NULL,
  `MoC` int(20) NOT NULL,
  `sort` int(11) NOT NULL,
  `Customer_id` int(11) DEFAULT NULL,
  `User_id` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `date`, `Expdate`, `events`, `Status`, `code`, `currents_dates`, `Duration`, `Amount`, `MoC`, `sort`, `Customer_id`, `User_id`) VALUES
(278, '2025-06-28', '2025-06-30', 'Ramadhan Eid', 'Approved', 'INV-2025-23182', '2025-06-27', 'Whole Day', 20000, 20000, 3, NULL, 13),
(280, '2025-06-30', NULL, 'Ramadhan Eid', 'Declined', 'INV-2025-62827', '2025-06-27', 'After Noon', 0, 0, 6, 36, NULL),
(281, '2025-07-01', NULL, 'Birthday', 'Declined', 'INV-2025-19609', '2025-06-27', 'Whole Day', 0, 0, 8, 36, NULL),
(282, '2025-07-16', '2025-06-29', 'Ramadhan Eid', 'Approved', 'INV-2025-06759', '2025-06-28', 'Morning', 10000, 12222, 11, NULL, 13),
(283, '2025-06-29', '2025-06-29', 'Ramadhan Eid', 'cancel', 'INV-2025-61511', '2025-06-28', 'After Noon', 10000, 0, 14, NULL, 13),
(284, '2025-06-24', NULL, 'Birthday', 'Declined', 'INV-2025-24419', '2025-06-18', 'Morning', 0, 0, 16, 36, NULL),
(285, '2025-06-24', '2025-06-19', 'Birthday', 'Approved', 'INV-2025-89351', '2025-06-18', 'Morning', 10000, 12222, 19, 36, 13),
(286, '2025-06-26', '2025-06-19', 'Birthday', 'Declined', 'INV-2025-54971', '2025-06-18', 'Whole Day', 20000, 0, 24, 36, 13),
(287, '2025-06-27', NULL, 'Ramadhan Eid', NULL, 'INV-2025-17045', '2025-06-18', 'After Noon', 0, 0, 22, 36, NULL),
(288, '2025-06-30', NULL, 'Ramadhan Eid', 'Declined', 'INV-2025-22926', '2025-06-18', 'Whole Day', 0, 0, 23, 36, NULL),
(289, '2025-06-24', '2025-06-19', 'Birthday', 'Declined', 'INV-2025-69605', '2025-06-18', 'After Noon', 10000, 0, 26, 36, 13),
(290, '2025-06-20', NULL, 'Birthday', 'Declined', 'INV-2025-57054', '2025-06-19', 'Whole Day', 0, 0, 27, NULL, 13),
(291, '2025-06-30', '2025-06-20', 'Ramadhan Eid', 'Declined', 'INV-2025-29083', '2025-06-19', 'Whole Day', 20000, 0, 29, NULL, 13),
(293, '2025-06-23', '2025-06-23', 'Ramadhan Eid', 'Approved', 'INV-2025-31969', '2025-06-22', 'Whole Day', 20000, 200000, 35, NULL, 13),
(294, '2025-06-25', '2025-06-23', 'Wedding', 'Approved', 'INV-2025-40395', '2025-06-22', 'Morning', 10000, 12222, 38, NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `H_id` int(11) NOT NULL,
  `Event_name` varchar(400) NOT NULL,
  `Event_status` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Event_date` date NOT NULL,
  `Cid` int(11) DEFAULT NULL,
  `U_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`H_id`, `Event_name`, `Event_status`, `Amount`, `Event_date`, `Cid`, `U_id`) VALUES
(86, 'Birthday', 'Approved', 111111, '2025-06-30', 28, 13),
(87, 'Ramadhan Eid', 'Declined', 0, '2025-06-29', 28, 13),
(88, 'Ramadhan Eid', 'Approved', 20000, '2025-06-28', 0, 13),
(89, 'Ramadhan Eid', 'Approved', 20000, '2025-06-30', 36, 15),
(90, 'Ramadhan Eid', 'Approved', 12222, '2025-07-16', 0, 13),
(91, 'Ramadhan Eid', 'cancel', 10000, '2025-06-29', NULL, 13),
(92, 'Birthday', 'cancel', 0, '2025-06-24', 36, 36),
(93, 'Birthday', 'Approved', 12222, '2025-06-24', 36, 13),
(94, 'Birthday', 'cancel', 20000, '2025-06-26', 36, 13),
(95, 'dialaga', 'Approved', 500, '2025-06-24', 41, 13),
(96, 'Ramadhan Eid', 'Approved', 200000, '2025-06-23', 0, 13),
(97, 'Wedding', 'Approved', 12222, '2025-06-25', 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(7) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Fullname` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Gender` varchar(12) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `Last` varchar(20) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `role` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Username`, `Password`, `Fullname`, `Email`, `Gender`, `middle`, `Last`, `Phone`, `role`, `Status`) VALUES
(13, 'amil', '1', 'Amil', 'Guro@gmail.com', 'Male', 'O', 'Guro', '09283948833', 'Admin', 1),
(37, 'aedszce', '123', 'Zho', 'Guro@gmail.com', 'Female', 'gg', 'Fan', '09283948833', 'Staff', 1),
(39, 'bfhkdf', '1', 'Amil', 'Guro@gmail.com', 'Female', 'M', 'asdwsdw', '09283948833', 'Staff', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_events_customer` (`Customer_id`),
  ADD KEY `fk_user_id` (`User_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`H_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `H_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_customer` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`Customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
