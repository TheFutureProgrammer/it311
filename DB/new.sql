-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 02:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`student_id`, `first_name`, `last_name`, `id`, `email`, `gender`) VALUES
(4, 'Ryan', 'suguitan', 4, 'ryan@gmail.com', 'male'),
(9, 'Jb gabriel', 'Tagulao', 1, 'jb@gmail.com', 'male'),
(11, 'Rhex', 'Gel', 1, 'rex@gmail.com', 'female'),
(12, 'joshua', 'Tagulao', 6, 'rex@gmail.com', 'male'),
(13, 'anile george', 'pira', 3, 'aniel@gmail.com', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_records`
--

CREATE TABLE `deleted_records` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_records`
--

INSERT INTO `deleted_records` (`student_id`, `first_name`, `last_name`, `id`, `email`, `gender`) VALUES
(1, 'ryan', 'suguitan', 4, 'ryansuguitan15@gmail.com', 'female'),
(5, 'ryan', 'suguitan', 3, 'ryansuguitan15@gmail.com', 'male'),
(10, 'joshua', 'cacal', 3, 'joshua@gmail.com', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(255) DEFAULT NULL,
  `subject_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `subject_code`, `subject_name`) VALUES
(1, 'IT 311', 'Advance Databased'),
(2, 'IT 312', 'Information Assurance and Security'),
(3, 'IT APPDEV 2', 'Web Application'),
(4, 'IT 314', 'Advance Database'),
(5, 'IT 313', 'System Integration'),
(6, 'IT 512', 'Networking 1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `deleted_records`
--
ALTER TABLE `deleted_records`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `deleted_records`
--
ALTER TABLE `deleted_records`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD CONSTRAINT `admin_table_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user_table` (`id`);

--
-- Constraints for table `deleted_records`
--
ALTER TABLE `deleted_records`
  ADD CONSTRAINT `deleted_records_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
