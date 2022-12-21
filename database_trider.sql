-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 10:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_trider`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `origin_point` varchar(255) NOT NULL,
  `destination_point` varchar(255) NOT NULL,
  `client_phone` tinytext NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `driver_phone` tinytext NOT NULL,
  `fare` int(32) NOT NULL,
  `toda` tinytext NOT NULL,
  `date_booked` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_list`
--

CREATE TABLE `client_list` (
  `user_id` int(11) NOT NULL,
  `client_firstname` varchar(255) NOT NULL,
  `client_middlename` varchar(255) NOT NULL,
  `client_lastname` varchar(255) NOT NULL,
  `client_suffix` varchar(11) NOT NULL,
  `gender` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`user_id`, `client_firstname`, `client_middlename`, `client_lastname`, `client_suffix`, `gender`) VALUES
(4, 'Asdasd', 'Asdas', 'Asda', 'jrszk', 'Male'),
(8, 'Client', 'One', 'Juan', 'jr', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `driver_list`
--

CREATE TABLE `driver_list` (
  `user_id` int(255) NOT NULL,
  `driver_firstname` varchar(255) NOT NULL,
  `driver_middlename` varchar(255) NOT NULL,
  `driver_lastname` varchar(255) NOT NULL,
  `driver_sufix` varchar(11) NOT NULL,
  `gender` tinytext NOT NULL,
  `plate_number` varchar(255) NOT NULL,
  `license` varchar(255) NOT NULL,
  `toda` tinytext NOT NULL,
  `mtop` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver_list`
--

INSERT INTO `driver_list` (`user_id`, `driver_firstname`, `driver_middlename`, `driver_lastname`, `driver_sufix`, `gender`, `plate_number`, `license`, `toda`, `mtop`) VALUES
(11, 'Mark Jayson', 'Qwerty', 'Algarne', 'jr', 'Male', '89564651312', '89465435', 'SATODA', '3001'),
(17, 'Mark Jayson', 'One', 'Algarne', 'jr', 'Male', '5656464', '549561', 'satoda', '3005');

-- --------------------------------------------------------

--
-- Table structure for table `user_list`
--

CREATE TABLE `user_list` (
  `user_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_list`
--

INSERT INTO `user_list` (`user_id`, `username`, `password`, `phone_number`, `email`, `position`) VALUES
(2, 'admin', '$2y$10$r4O/4/VnlqIdJ8l6v80FE.nNu0Un8xf39dR/sXfSk9FGFkWnz8tZq', '09123456789', 'admin@example.com', 'Administrator'),
(8, 'client1', '$2y$10$Ss6UsDvdPg/aQEBz2zXAa.XvgA3.e5t21MfLLyVwqUn8QDZ2Zgs6m', '09125321455', 'client1@example.com', 'User'),
(11, 'satoda', '$2y$10$kJNjKClcoNHURBARdMxaRefs0H0ZG/oKdQedmLZ8xkQBkFEJeDzg6', '09998989898', 'MarkJayson@example.com', 'Co-Admin'),
(17, 'mj1122', '$2y$10$Sx0Wi5Ak0D/uKSgaqref6ehxuY.4El4KJzPzQkNhAsyxZDhlMS4hu', '09125345551', 'MarkJayson848484@example.com', 'Driver');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `action` varchar(255) NOT NULL,
  `logDate` date NOT NULL,
  `logTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`log_id`, `user_id`, `username`, `action`, `logDate`, `logTime`) VALUES
(1, 4, 'dasdas', 'Register', '2022-12-15', '12:07:14'),
(2, 2, 'admin', 'Login', '2022-12-15', '12:22:53'),
(3, 2, 'admin', 'Login', '2022-12-15', '12:23:02'),
(4, 2, 'admin', 'Logout', '2022-12-15', '12:26:16'),
(5, 2, 'admin', 'Login', '2022-12-15', '12:26:19'),
(6, 2, 'admin', 'Logout', '2022-12-15', '12:27:24'),
(7, 2, 'admin', 'Login', '2022-12-15', '12:27:27'),
(8, 2, 'admin', 'Logout', '2022-12-15', '12:30:41'),
(9, 2, 'admin', 'Login', '2022-12-15', '12:30:43'),
(10, 2, 'admin', 'Logout', '2022-12-15', '12:31:24'),
(11, 2, 'admin', 'Login', '2022-12-15', '12:31:26'),
(12, 2, 'admin', 'Logout', '2022-12-15', '12:37:46'),
(13, 2, 'admin', 'Login', '2022-12-15', '12:37:48'),
(14, 2, 'admin', 'Logout', '2022-12-15', '12:38:40'),
(15, 2, 'admin', 'Login', '2022-12-15', '12:39:54'),
(16, 2, 'admin', 'Login', '2022-12-15', '12:42:07'),
(17, 2, 'admin', 'Logout', '2022-12-15', '01:44:41'),
(18, 2, 'admin', 'Login', '2022-12-15', '01:45:02'),
(19, 5, 'dsaaa', 'Register', '2022-12-15', '03:49:55'),
(20, 6, 'dsaaaasd', 'Registered Asdas Asdas Asd to client list', '2022-12-15', '04:02:09'),
(21, 7, 'asd', 'Registered Asd Asdas Asdasd to client list', '2022-12-15', '04:05:30'),
(22, 2, 'admin', 'Login', '2022-12-19', '04:53:14'),
(23, 2, 'admin', 'Login', '2022-12-19', '05:36:52'),
(24, 2, 'admin', 'Logout', '2022-12-19', '05:36:57'),
(25, 2, 'admin', 'Login', '2022-12-19', '05:37:01'),
(26, 2, 'admin', 'Logout', '2022-12-19', '05:51:40'),
(27, 2, 'admin', 'Login', '2022-12-19', '05:51:43'),
(28, 2, 'admin', 'Logout', '2022-12-19', '06:01:58'),
(29, 8, 'client1', 'Register', '2022-12-19', '06:04:53'),
(30, 8, 'client1', 'Login', '2022-12-19', '06:05:03'),
(31, 8, 'client1', 'Login', '2022-12-19', '06:07:48'),
(32, 8, 'client1', 'Login', '2022-12-19', '06:08:23'),
(33, 8, 'client1', 'Logout', '2022-12-19', '06:14:09'),
(34, 2, 'admin', 'Login', '2022-12-19', '06:14:15'),
(35, 2, 'admin', 'Logout', '2022-12-19', '07:07:33'),
(36, 4, 'admin_toda', 'Login', '2022-12-19', '07:07:39'),
(37, 4, 'admin_toda', 'Logout', '2022-12-19', '07:17:40'),
(38, 2, 'admin', 'Login', '2022-12-19', '07:17:44'),
(39, 2, 'admin', 'Logout', '2022-12-19', '07:25:18'),
(40, 4, 'admin_toda', 'Login', '2022-12-19', '07:25:23'),
(41, 4, 'admin_toda', 'Logout', '2022-12-19', '07:29:03'),
(42, 4, 'satoda', 'Login', '2022-12-19', '07:29:14'),
(43, 4, 'satoda', 'Logout', '2022-12-19', '07:31:35'),
(44, 2, 'admin', 'Login', '2022-12-19', '07:31:40'),
(45, 2, 'admin', 'Logout', '2022-12-19', '07:32:24'),
(46, 2, 'admin', 'Login', '2022-12-19', '07:32:28'),
(47, 2, 'admin', 'Logout', '2022-12-19', '07:32:42'),
(48, 4, 'satoda', 'Login', '2022-12-19', '07:32:47'),
(49, 4, 'satoda', 'Logout', '2022-12-19', '07:35:17'),
(50, 4, 'satoda', 'Login', '2022-12-19', '07:35:23'),
(51, 4, 'satoda', 'Logout', '2022-12-19', '07:37:07'),
(52, 11, 'satoda', 'Register', '2022-12-19', '07:47:29'),
(53, 11, 'satoda', 'Login', '2022-12-19', '07:56:31'),
(54, 11, 'satoda', 'Login', '2022-12-19', '07:57:11'),
(55, 11, 'satoda', 'Logout', '2022-12-19', '08:30:45'),
(56, 2, 'admin', 'Login', '2022-12-19', '08:31:03'),
(57, 2, 'admin', 'Logout', '2022-12-19', '08:34:25'),
(58, 11, 'satoda', 'Login', '2022-12-19', '08:34:40'),
(59, 11, 'satoda', 'Logout', '2022-12-19', '08:37:52'),
(60, 2, 'admin', 'Login', '2022-12-19', '08:38:42'),
(61, 2, 'admin', 'Logout', '2022-12-19', '09:23:25'),
(62, 2, 'admin', 'Login', '2022-12-19', '09:36:41'),
(63, 17, 'mj1122', 'Registered Mark Jayson One Algarne to driver list', '2022-12-19', '09:44:10'),
(64, 2, 'admin', 'Logout', '2022-12-19', '09:44:45'),
(65, 8, 'client1', 'Login', '2022-12-19', '11:31:15'),
(66, 2, 'admin', 'Login', '2022-12-20', '11:22:10'),
(67, 2, 'admin', 'Logout', '2022-12-20', '11:23:12'),
(68, 8, 'client1', 'Login', '2022-12-20', '11:23:26'),
(69, 8, 'client1', 'Login', '2022-12-20', '11:29:29'),
(70, 8, 'client1', 'Login', '2022-12-20', '11:32:07'),
(71, 8, 'client1', 'Login', '2022-12-20', '12:27:09'),
(72, 8, 'client1', 'Login', '2022-12-20', '02:22:45'),
(73, 8, 'client1', 'Login', '2022-12-20', '02:40:42'),
(74, 8, 'client1', 'Login', '2022-12-20', '04:05:14'),
(75, 8, 'client1', 'Logout', '2022-12-20', '04:06:07'),
(76, 8, 'client1', 'Login', '2022-12-20', '04:06:35'),
(77, 8, 'client1', 'Login', '2022-12-20', '04:07:27'),
(78, 8, 'client1', 'Logout', '2022-12-20', '04:38:35'),
(79, 2, 'admin', 'Login', '2022-12-20', '04:38:45'),
(80, 2, 'admin', 'Logout', '2022-12-20', '04:50:19'),
(81, 11, 'satoda', 'Login', '2022-12-20', '04:50:23'),
(82, 11, 'satoda', 'Logout', '2022-12-20', '04:50:32'),
(83, 8, 'client1', 'Login', '2022-12-20', '04:50:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `driver_list`
--
ALTER TABLE `driver_list`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
