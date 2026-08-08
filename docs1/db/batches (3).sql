-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2026 at 05:33 AM
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
-- Database: `technova_training_institute`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date NOT NULL,
  `Price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Discount_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1= Fixed,2 = Percentage',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `batch_name` varchar(100) NOT NULL,
  `total_seats` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Upcoming, 1 = Running, 2 = Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `course_id`, `trainer_id`, `Start_date`, `End_date`, `Price`, `Discount`, `Discount_type`, `start_time`, `end_time`, `room`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `batch_name`, `total_seats`, `status`) VALUES
(1, 3, 4, '2026-08-13', '2026-08-20', 0.33, 0.27, 2, '10:09:00', '00:06:00', '12', '2026-08-04 04:10:00', '2026-08-04 04:24:49', 3, NULL, '2026-08-04 00:24:49', 'fdwefer', 12, 1),
(2, 3, 4, '2026-08-05', '2026-08-19', 1222.00, 0.01, 2, '00:22:00', '10:26:00', '12', '2026-08-04 04:24:11', '2026-08-04 04:30:43', 3, NULL, '2026-08-04 00:30:43', 'sacfd', 12, 0),
(3, 3, 4, '2026-08-21', '2026-08-19', 12222.00, 0.01, 1, '00:24:00', '10:27:00', '12', '2026-08-04 04:24:46', '2026-08-04 05:17:19', 3, NULL, '2026-08-04 01:17:19', 'fdwefer', 213, 0),
(4, 3, 4, '2026-08-21', '2026-08-09', 122.00, 5.00, 2, '01:55:00', '00:55:00', '13', '2026-08-04 04:56:03', '2026-08-05 07:54:12', 3, NULL, '2026-08-05 03:54:12', 'fdwefer', 12, 1),
(5, 3, 5, '2026-08-11', '2026-09-19', 10000.00, 0.00, 1, '12:39:00', '12:39:00', '12', '2026-08-05 15:39:27', '2026-08-05 15:43:12', 3, 3, NULL, 'Digital Marketing - Aug 2026', 12, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batches_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
