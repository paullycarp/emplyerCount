-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2019 at 03:40 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_manager`
--
CREATE DATABASE IF NOT EXISTS `employee_manager` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `employee_manager`;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `qualification_id` int(10) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `date_joined` date DEFAULT NULL,
  `gender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `employee`
--

TRUNCATE TABLE `employee`;
--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `firstname`, `lastname`, `date_of_birth`, `qualification_id`, `salary`, `date_joined`, `gender`) VALUES
(3, 'Wale', 'Ade', '2019-12-05', 1, '60000.00', '0000-00-00', 'Male'),
(6, 'Titi', 'Layo', '0000-00-00', 1, '60000.00', '0000-00-00', 'Female'),
(7, 'Paul', 'Adams', '0000-00-00', 3, '0.00', '0000-00-00', 'Male'),
(8, 'Foo', 'Bar', '0000-00-00', 1, '0.00', '0000-00-00', 'Male'),
(9, 'Tunde', 'Bar', '2019-12-03', 1, '70000.00', '0000-00-00', 'Male'),
(10, 'Adam', 'James', '0000-00-00', 1, '0.00', '0000-00-00', 'Male'),
(11, 'Wale', 'John', '0000-00-00', 2, '0.00', '0000-00-00', 'Male'),
(12, 'Xam', 'Ham', '0000-00-00', 3, '0.00', '0000-00-00', 'Male'),
(13, 'Xam', 'Ham', '0000-00-00', 3, '0.00', '0000-00-00', 'Male'),
(14, 'Bola', 'Ken', '2019-12-10', 3, '90000.00', '0000-00-00', 'Female'),
(15, 'John', 'Adams', '0000-00-00', 4, '150000.00', '0000-00-00', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `qualification`
--

TRUNCATE TABLE `qualification`;
--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`id`, `name`) VALUES
(1, 'SSCE'),
(2, 'OND'),
(3, 'HND'),
(4, 'BSC');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `user`
--

TRUNCATE TABLE `user`;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Foo', 'Bar', 'admin@example.com', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualification`
--
ALTER TABLE `qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `qualification`
--
ALTER TABLE `qualification`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
