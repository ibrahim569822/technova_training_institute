-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2026 at 06:11 AM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `created_at`, `deleted_at`) VALUES
(1, 'Technology', NULL, '2026-08-02 04:43:52', '2026-08-04 08:07:44'),
(2, 'Programming', NULL, '2026-08-02 04:43:52', '2026-08-06 06:16:07'),
(4, 'Networking', NULL, '2026-08-02 04:43:52', NULL),
(5, 'Designing', NULL, '2026-08-02 04:43:52', NULL),
(6, 'Development', NULL, '2026-08-02 04:43:52', '2026-08-09 05:56:34'),
(8, 'Fundamentals', NULL, '2026-08-02 04:43:52', NULL),
(9, 'Plastics', 'eee', '2026-08-04 05:09:44', '2026-08-04 08:07:38'),
(10, 'Regal', 'furniture', '2026-08-04 06:06:50', '2026-08-04 08:17:00'),
(11, 'electronics', 'furniture', '2026-08-04 06:16:55', '2026-08-06 06:16:00'),
(14, 'Programming', 'coding', '2026-08-06 04:32:33', NULL),
(15, 'Plastics', 'furniture', '2026-08-09 03:32:00', NULL),
(16, 'development', 'aaa', '2026-08-09 03:56:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `fee` decimal(10,2) DEFAULT 0.00,
  `trainer_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 2 COMMENT '0 = Running, 1 = Completed, 2 = Upcoming',
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `category_id`, `duration`, `fee`, `trainer_id`, `status`, `description`, `image`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(3, 'Digital Marketing', 0, '2.5 Months', 10000.00, 3, 1, '', '', '2026-07-27 06:42:12', '2026-07-30 03:42:27', NULL, 1, 1),
(4, 'Python Programming', 0, '4 Months', 18000.00, 1, 2, '', '', '2026-07-27 06:42:12', '2026-07-30 03:42:39', NULL, 1, 1),
(10, 'Web Fundamental', 4, '3 month', 25000.00, NULL, 0, 'afasdfafafa', '8019411786246769_Capture.PNG', '2026-08-09 03:39:29', '2026-08-09 03:39:29', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
