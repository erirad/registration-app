-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2019 at 05:33 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nfq-backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `served` tinyint(1) NOT NULL DEFAULT '0',
  `duration` int(11) NOT NULL,
  `login_key` varchar(8) NOT NULL,
  `consultant_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `created_at`, `updated_at`, `served`, `duration`, `login_key`, `consultant_id`) VALUES
(1, 'Jacob', '2019-09-22 15:51:28', '2019-09-22 16:02:19', 1, 651, '7f924f8c', 1),
(2, 'Eric', '2019-09-22 15:51:36', '2019-09-22 16:07:34', 1, 958, '4d1bf837', 1),
(3, 'Larry', '2019-09-22 15:51:46', '2019-09-22 16:02:22', 1, 636, '4ba913', 2),
(4, 'Benjamin', '2019-09-22 15:51:59', '2019-09-22 16:02:24', 1, 625, 'e777d129', 3),
(5, 'Dennis', '2019-09-22 15:52:12', '2019-09-22 16:02:25', 1, 613, 'f877aa70', 4),
(6, 'Peter', '2019-09-22 15:52:22', '2019-09-22 16:07:40', 1, 918, 'ee098894', 2),
(7, 'Carl', '2019-09-22 15:52:31', '2019-09-22 16:07:42', 1, 911, 'cedcdbf3', 3),
(8, 'Keith', '2019-09-22 15:52:41', '2019-09-22 16:07:43', 1, 902, '43ed9999', 4),
(9, 'Gerald', '2019-09-22 15:52:54', '2019-09-22 16:11:29', 1, 1115, 'ca9802bb', 3),
(10, 'Terry', '2019-09-22 15:53:02', '2019-09-22 16:11:29', 1, 1107, 'a29b33dd', 1),
(11, 'Austin', '2019-09-22 15:53:12', '2019-09-22 16:11:30', 1, 1098, '1b1383bb', 2),
(12, 'Jesse', '2019-09-22 15:53:20', '2019-09-22 16:11:31', 1, 1091, '0682df1b', 4),
(13, 'Gary', '2019-09-22 16:30:18', '2019-09-22 16:31:13', 1, 54, '3db56ad0', 4),
(14, 'Stephen', '2019-09-22 16:41:48', '2019-09-22 17:24:03', 1, 2535, '54ab0a42', 4),
(15, 'Larry', '2019-09-22 16:44:49', '2019-09-22 17:24:04', 1, 2355, '90dffe66', 3),
(16, 'Brandon', '2019-09-22 16:42:05', '2019-09-22 17:24:03', 1, 2518, 'ac40b90c', 2),
(17, 'Frank', '2019-09-22 16:44:48', '2019-09-22 17:24:04', 1, 2356, 'cd58018f', 3);

-- --------------------------------------------------------

--
-- Table structure for table `consultants`
--

CREATE TABLE `consultants` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultants`
--

INSERT INTO `consultants` (`id`, `name`) VALUES
(1, 'James'),
(2, 'Robert'),
(3, 'Michael'),
(4, 'Christopher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_consultant` (`consultant_id`);

--
-- Indexes for table `consultants`
--
ALTER TABLE `consultants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `consultants`
--
ALTER TABLE `consultants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `client_consultant` FOREIGN KEY (`consultant_id`) REFERENCES `consultants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
