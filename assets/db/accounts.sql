-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2022 at 04:00 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rjavancena`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(15) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `birthmonth` int(2) NOT NULL,
  `birthday` int(2) NOT NULL,
  `birthyear` int(4) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `house` varchar(100) NOT NULL,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `userlevel` varchar(50) NOT NULL DEFAULT 'Cashier',
  `status` varchar(50) NOT NULL DEFAULT 'Active',
  `theme` varchar(50) NOT NULL DEFAULT 'light',
  `interface` varchar(50) NOT NULL DEFAULT 'sidebar close',
  `date` date DEFAULT curdate(),
  `time` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `middlename`, `fullname`, `username`, `password`, `email`, `contact`, `birthmonth`, `birthday`, `birthyear`, `birthdate`, `house`, `street`, `barangay`, `city`, `province`, `address`, `userlevel`, `status`, `theme`, `interface`, `date`, `time`) VALUES
(1, 'Jed', 'Terrazola', '', 'Jed Terrazola', 'shins', '$2y$10$AgMHM3rAEjIolUvZY9bDpukCirnGbrDUnGmOu/T17g.i7ZitM9ku.', 'jed.terrazola.r@gmail.com', '9999999998', 3, 3, 2001, '2001-03-03', 'Blk 100 Lot 6 Area B Purok 9', 'Masuerte', 'Bagong Buhay I', 'San Jose del Monte', 'Bulacan', 'Blk 100 Lot 6 Area B Purok 9 Masuerte, Brgy. Bagong Buhay I, San Jose del Monte, Bulacan', 'admin', 'Inactive', 'light', 'sidebar close', '2022-07-19', '21:07:13'),
(2, 'Jed', 'Terrazola', '', 'Jed Terrazola', 'admin_shinxzxzxz', '$2y$10$Eu0YWt.ouseOB6IFzX0u1uJfKBN2DuLUpS254WG1npiz7rFxaL7li', 'jed.terrazola.r@gmail.com', '9125694558', 3, 10, 2001, '2001-03-10', 'Blk 100 Lot 6 Area B Purok 9', 'Masuerte', 'Bagong Buhay I', 'San Jose del Monte', 'Bulacan', 'Blk 100 Lot 6 Area B Purok 9 Masuerte, Brgy. Bagong Buhay I, San Jose del Monte, Bulacan', 'admin', 'Active', 'light', 'sidebar close', '2022-07-19', '21:08:02'),
(3, 'Nathaniel', 'Torres', '', 'Nathaniel Torres', 'nat13torr', '$2y$10$lWoOG1eWGg4iqMWDuhLy3O8UB1P31yXgCWTCfaJ7HR9mDUm8bFFru', 'nat13torr@gmail.com', '09888888888', 9, 9, 2001, '2001-09-09', 'Blk 100 Lot 69 Area B Purok 8', 'Masipag', 'Bagong Buhay I', 'San Jose del Monte', 'Bulacan', 'Blk 100 Lot 69 Area B Purok 8 Masipag, Brgy. Bagong Buhay I, San Jose del Monte, Bulacan', 'cashier', 'Inactive', 'light', 'sidebar close', '2022-07-19', '21:36:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
