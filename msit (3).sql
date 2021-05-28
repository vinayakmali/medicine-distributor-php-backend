-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 11:08 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msit`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_target`
--

CREATE TABLE `delivery_target` (
  `del_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `med_id` int(5) NOT NULL,
  `store_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `deliveredTarget` int(5) DEFAULT NULL,
  `returnedTarget` int(5) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_target`
--

INSERT INTO `delivery_target` (`del_id`, `user_id`, `med_id`, `store_id`, `quantity`, `deliveredTarget`, `returnedTarget`, `created_at`, `updated_at`) VALUES
(3, 85, 5, 16, 120, NULL, 24, '2021-05-20 22:51:04', '0000-00-00 00:00:00'),
(5, 84, 5, 16, 232, NULL, 34, '2021-05-20 23:50:59', '0000-00-00 00:00:00'),
(6, 84, 6, 21, 21, NULL, 2, '2021-05-21 20:00:17', '2021-05-22 05:00:03'),
(7, 84, 7, 21, 21, NULL, 2, '2021-05-21 20:00:45', '2021-05-22 05:00:03'),
(8, 86, 8, 21, 34, NULL, 0, '2021-05-22 11:43:42', '2021-04-14 11:42:59'),
(9, 0, 0, 0, 0, NULL, 0, '2021-05-27 03:02:18', '0000-00-00 00:00:00'),
(10, 85, 6, 17, 345, NULL, 0, '2021-05-27 03:02:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `med_id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`med_id`, `name`, `created_at`, `updated_at`) VALUES
(5, 'Abacavir Sulfate', '2021-05-21 22:38:11', '0000-00-00 00:00:00'),
(6, 'Abarelix', '2021-05-21 22:38:23', '0000-00-00 00:00:00'),
(7, 'Abatacept', '2021-05-21 22:38:35', '0000-00-00 00:00:00'),
(8, 'Abciximab', '2021-05-21 22:38:50', '0000-00-00 00:00:00'),
(9, 'Abelcet', '2021-05-21 22:38:59', '0000-00-00 00:00:00'),
(10, 'Acthrel', '2021-05-21 22:39:08', '0000-00-00 00:00:00'),
(11, 'AdreView', '2021-05-21 22:39:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `name`, `location`, `created_at`, `updated_at`) VALUES
(16, 'Aggarwal Medical Store', 'Pune', '2021-05-21 22:41:36', '0000-00-00 00:00:00'),
(17, 'Amba Medicos', 'Mumbai', '2021-05-21 22:41:49', '0000-00-00 00:00:00'),
(18, 'Arora Medical Hall', 'Pune', '2021-05-21 22:42:01', '0000-00-00 00:00:00'),
(19, 'Chander Medical Store', 'Bibwewadi', '2021-05-21 22:42:13', '0000-00-00 00:00:00'),
(20, 'D.D Pharma', 'Dhankawadi', '2021-05-21 22:42:28', '0000-00-00 00:00:00'),
(21, 'Krishana Medical Agency', 'Pimpri', '2021-05-21 22:42:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `lon` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `lat`, `lon`, `created_at`, `updated_at`) VALUES
(84, 'Vinayak Mali', 'vinayakmali123@gmail.com', '8553989addbb3ca2c59a2ae0c621176d', 'agent', '18.5344', '73.883', '2021-05-21 22:34:32', '2021-05-27 22:41:22'),
(85, 'Bharati Surve', 'bharati.surve@gmail.com', '8553989addbb3ca2c59a2ae0c621176d', 'agent', '18.5344', '73.883', '2021-05-21 22:35:14', '2021-05-27 01:55:01'),
(86, 'Amit Shah', 'amit.shah@hotmail.com', 'e698813c4b81d59a44d5d69b5850be93', 'agent', NULL, NULL, '2021-05-21 22:35:35', '2021-05-25 01:42:58'),
(87, 'Karan Chauhan', 'karan.chauhan@hotmail.com', '8553989addbb3ca2c59a2ae0c621176d', 'admin', '18.5344', '73.883', '2021-05-21 22:36:06', '2021-05-27 22:46:25'),
(88, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', NULL, NULL, '2021-05-27 01:58:29', '0000-00-00 00:00:00'),
(89, 'Darshan', 'darshan.shahane@gmail.com', '51e4585fcef938bd3c969ab8d7e6dfbf', 'agent', NULL, NULL, '2021-05-27 01:58:29', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_target`
--
ALTER TABLE `delivery_target`
  ADD PRIMARY KEY (`del_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_target`
--
ALTER TABLE `delivery_target`
  MODIFY `del_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `med_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
