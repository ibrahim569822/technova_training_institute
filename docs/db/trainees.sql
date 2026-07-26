-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2026 at 06:57 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Table structure for table `trainees`
--

CREATE TABLE `trainees` (
  `id` int(11) NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '1 = Male, 2 = Female, 3 = Other',
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainees`
--

INSERT INTO `trainees` (`id`, `gender`, `dob`, `address`, `education`, `registration_date`, `full_name`, `email`, `phone`, `password`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(2, 2, '2000-08-24', '456 Oak Avenue, Los Angeles, CA', 'Bachelor of Business Administration', '2025-01-12', 'Emily Johnson', 'emily.johnson@example.com', '+12025550102', '$2y$10$dummyHashedPassword002', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(3, 1, '1997-03-15', '789 Pine Road, Chicago, IL', 'Diploma in Information Technology', '2025-01-15', 'Michael Brown', 'michael.brown@example.com', '+12025550103', '$2y$10$dummyHashedPassword003', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(4, 2, '1999-11-30', '321 Maple Street, Houston, TX', 'Master of Computer Science', '2025-01-18', 'Sophia Davis', 'sophia.davis@example.com', '+12025550104', '$2y$10$dummyHashedPassword004', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(5, 3, '2001-02-20', '654 Cedar Lane, Phoenix, AZ', 'Bachelor of Arts', '2025-01-20', 'Alex Taylor', 'alex.taylor@example.com', '+12025550105', '$2y$10$dummyHashedPassword005', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(6, 1, '1996-07-08', '987 Birch Drive, Dallas, TX', 'Bachelor of Engineering', '2025-01-22', 'David Wilson', 'david.wilson@example.com', '+12025550106', '$2y$10$dummyHashedPassword006', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(7, 2, '1998-12-18', '159 Elm Street, Miami, FL', 'Bachelor of Science', '2025-01-25', 'Olivia Martinez', 'olivia.martinez@example.com', '+12025550107', '$2y$10$dummyHashedPassword007', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(8, 1, '1995-09-09', '753 Walnut Avenue, Seattle, WA', 'Master of Information Systems', '2025-01-27', 'James Anderson', 'james.anderson@example.com', '+12025550108', '$2y$10$dummyHashedPassword008', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(9, 2, '2002-04-14', '852 Cherry Street, Boston, MA', 'Bachelor of Education', '2025-02-01', 'Emma Thomas', 'emma.thomas@example.com', '+12025550109', '$2y$10$dummyHashedPassword009', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(10, 3, '1999-06-28', '951 Spruce Court, Denver, CO', 'Bachelor of Commerce', '2025-02-05', 'Jordan Lee', 'jordan.lee@example.com', '+12025550110', '$2y$10$dummyHashedPassword010', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(11, 1, '1994-01-18', '14 Lake View Road, Austin, TX', 'Bachelor of Mechanical Engineering', '2025-02-08', 'Daniel Carter', 'daniel.carter@example.com', '+12025550111', '$2y$10$dummyHashedPassword011', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(12, 2, '2001-10-05', '88 River Street, Portland, OR', 'Bachelor of Nursing', '2025-02-10', 'Grace Walker', 'grace.walker@example.com', '+12025550112', '$2y$10$dummyHashedPassword012', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(13, 1, '1997-06-21', '225 Highland Avenue, Atlanta, GA', 'Diploma in Graphic Design', '2025-02-12', 'Ryan Hall', 'ryan.hall@example.com', '+12025550113', '$2y$10$dummyHashedPassword013', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(14, 2, '1998-09-13', '47 Sunset Boulevard, San Diego, CA', 'Master of Business Administration', '2025-02-14', 'Natalie Young', 'natalie.young@example.com', '+12025550114', '$2y$10$dummyHashedPassword014', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(15, 3, '2000-12-01', '132 Forest Drive, Charlotte, NC', 'Bachelor of Psychology', '2025-02-16', 'Casey Morgan', 'casey.morgan@example.com', '+12025550115', '$2y$10$dummyHashedPassword015', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(16, 1, '1995-04-27', '670 Lincoln Street, Columbus, OH', 'Bachelor of Civil Engineering', '2025-02-18', 'Ethan Brooks', 'ethan.brooks@example.com', '+12025550116', '$2y$10$dummyHashedPassword016', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(17, 2, '1999-07-16', '91 Rose Garden Lane, Nashville, TN', 'Bachelor of Economics', '2025-02-20', 'Chloe Bennett', 'chloe.bennett@example.com', '+12025550117', '$2y$10$dummyHashedPassword017', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(18, 1, '1996-11-11', '305 Ocean Avenue, Tampa, FL', 'Master of Data Science', '2025-02-22', 'Benjamin Scott', 'benjamin.scott@example.com', '+12025550118', '$2y$10$dummyHashedPassword018', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(19, 2, '2002-03-09', '78 Green Park, Las Vegas, NV', 'Bachelor of Architecture', '2025-02-24', 'Lily Adams', 'lily.adams@example.com', '+12025550119', '$2y$10$dummyHashedPassword019', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(20, 3, '1998-08-30', '510 Hillcrest Avenue, Minneapolis, MN', 'Bachelor of Environmental Science', '2025-02-26', 'Taylor Reed', 'taylor.reed@example.com', '+12025550120', '$2y$10$dummyHashedPassword020', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(21, 1, '1999-01-02', 'Hazi Camp', 'Bachelor of Business Administration', '2026-07-25', 'Md. Ibrahim', 'ibrahim@yahoo.com', '015', '7c4a8d09ca3762af61e59520943dc26494f8941b', '4885961785041728_smiling-schoolboy-holding-a-book-with-backpack-on-transparent-background-png.webp', 1, '2026-07-26 04:47:49', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
