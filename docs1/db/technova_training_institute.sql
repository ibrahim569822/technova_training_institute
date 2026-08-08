-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2026 at 08:54 PM
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
(5, 3, 5, '2026-08-11', '2026-09-19', 10000.00, 0.00, 1, '12:39:00', '12:39:00', '12', '2026-08-05 15:39:27', '2026-08-05 15:43:12', 3, 3, NULL, 'Digital Marketing - Aug 2026', 12, 0),
(6, 4, 6, '2026-08-13', '2026-08-20', 18000.00, 0.14, 2, '23:45:00', '14:45:00', '12', '2026-08-08 15:45:12', '2026-08-08 15:45:12', 3, NULL, NULL, 'Python Programming - Aug 2026', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `category` text DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `fee` decimal(10,2) DEFAULT 0.00,
  `trainer_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
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

INSERT INTO `courses` (`id`, `course_name`, `category`, `duration`, `fee`, `trainer_id`, `start_date`, `end_date`, `status`, `description`, `image`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(3, 'Digital Marketing', 'Marketing', '2.5 Months', 10000.00, 3, '2026-04-01', '2026-06-15', 1, '', '', '2026-07-27 06:42:12', '2026-07-30 03:42:27', NULL, 1, 1),
(4, 'Python Programming', 'Programming', '4 Months', 18000.00, 1, '2026-09-01', '2026-12-31', 2, '', '', '2026-07-27 06:42:12', '2026-07-30 03:42:39', NULL, 1, 1),
(5, 'Mobile App Development', 'App Development', '5 Months', 22000.00, 4, '2026-06-01', '2026-10-31', 0, '', '', '2026-07-27 06:42:12', '2026-07-30 03:42:55', NULL, 1, 1),
(7, 'Web Fundamental', '1', '3 month', 15000.00, 1, '2026-08-28', '2026-09-30', 1, 'Web Fundamentals Course Description\r\n\r\nThe \'Web Fundamentals\' course is designed for beginners who want to build a strong foundation in modern web development. It provides a comprehensive introduction to the core technologies used to create professional, ', '5697001785561833_Capture.PNG', '2026-08-01 05:23:53', '2026-08-01 05:23:53', NULL, NULL, NULL),
(8, 'web programming', '2', '3 month', 1500.00, 2, '2026-09-01', '2026-11-30', 1, 'Web Fundamentals Course Description\r\n\r\nThe \'Web Fundamentals\' course is designed for beginners who want to build a strong foundation in modern web development. It provides a comprehensive introduction to the core technologies used to create professional, responsive, and interactive websites. Throughout the course, learners will explore \'HTML\', \'CSS\', and \'JavaScript\', while gaining practical experience through hands-on projects, coding exercises, quizzes, and real-world examples.\r\n\r\nThe course begins with an overview of \'the Internet\', \'web browsers\', \'web servers\', \'domain names\', and \'web hosting\', helping students understand how websites are created, stored, and delivered to users. Learners will then move on to mastering \'HTML\', where they will create well-structured web pages using semantic elements, headings, paragraphs, images, links, tables, forms, multimedia, and navigation menus.\r\n\r\nIn the \'CSS\' section, students will learn how to design visually appealing websites using colors, typography, spacing, backgrounds, borders, Flexbox, CSS Grid, positioning, animations, transitions, and responsive design techniques. They will understand how to build layouts that automatically adapt to desktops, tablets, and mobile devices for an improved user experience.\r\n\r\nThe \'JavaScript\' module introduces the fundamentals of programming for the web. Students will work with variables, data types, operators, conditional statements, loops, functions, arrays, objects, events, and DOM manipulation. By the end of this section, learners will be able to create dynamic web pages, validate forms, respond to user interactions, and update page content without reloading the browser.\r\n\r\nStudents will also become familiar with professional development tools such as \'Visual Studio Code\', browser developer tools, and the basics of \'Git\' for version control. Best practices for writing clean, organized, and maintainable code will be emphasized throughout the course.\r\n\r\nPractical learning is at the heart of this program. Every module includes coding exercises, quizzes, assignments, and mini projects that reinforce key concepts. Learners will build projects such as a personal portfolio website, responsive landing page, business homepage, image gallery, contact form, and several interactive web components before completing a final capstone project.\r\n\r\nThe course also introduces essential concepts of \'website performance optimization\', \'accessibility\', \'cross-browser compatibility\', and \'basic web security\'. Students will learn how to optimize images, improve page loading speed, write efficient code, and follow secure coding practices.\r\n\r\nBy the end of the course, learners will have the confidence to build complete responsive websites from scratch and will be well prepared to continue their journey into advanced front-end frameworks and full-stack web development.\r\n\r\nCourse Details\r\nCourse Name: \'Web Fundamentals\'\r\nCourse Level: \'Beginner\'\r\nDuration: \'8 Weeks\'\r\nTotal Learning Hours: \'30+ Hours\'\r\nVideo Lessons: \'50+\'\r\nCoding Exercises: \'40+\'\r\nAssignments: \'12\'\r\nQuizzes: \'20\'\r\nMini Projects: \'10\'\r\nCapstone Project: \'1 Complete Responsive Website\'\r\nLanguage: \'English\'\r\nCertificate: \'Provided Upon Successful Completion\'\r\nAccess: \'Lifetime Access\'\r\nDevice Support: \'Desktop\', \'Laptop\', \'Tablet\', and \'Mobile\'\r\nPrerequisites: \'Basic Computer Knowledge\' and \'Internet Browsing Skills\'\r\nLearning Format: \'Video Lectures\', \'Practical Demonstrations\', \'Hands-on Coding\', \'Assignments\', \'Projects\', and \'Quizzes\'\r\nLearning Outcomes\r\n\r\nAfter completing the \'Web Fundamentals\' course, learners will be able to:\r\n\r\nBuild well-structured web pages using \'HTML\'.\r\nDesign responsive layouts using \'CSS\'.\r\nCreate interactive websites with \'JavaScript\'.\r\nDevelop responsive websites for desktop and mobile devices.\r\nBuild forms with client-side validation.\r\nDebug and test websites using browser developer tools.\r\nOrganize web projects using professional development practices.\r\nCreate complete responsive websites from scratch.\r\nApply modern web development standards and best practices.\r\nContinue learning advanced technologies such as \'Bootstrap\', \'React\', \'Node.js\', and full-stack web development with confidence.', '5214061785562106_Capture.PNG', '2026-08-01 05:28:26', '2026-08-01 06:10:12', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `trainee_id` int(10) NOT NULL,
  `batch_id` int(10) NOT NULL,
  `invoice_id` int(10) DEFAULT NULL,
  `course_id` int(10) NOT NULL,
  `enrollment_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Enrolled, 1 = Completed, 2 = Dropped',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `trainee_id`, `batch_id`, `invoice_id`, `course_id`, `enrollment_date`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 21, 5, NULL, 3, '2026-08-08', 0, '2026-08-08 11:08:38', '2026-08-08 11:08:38', 3, NULL, NULL),
(2, 21, 6, NULL, 4, '2026-08-08', 0, '2026-08-08 15:45:29', '2026-08-08 15:45:29', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) NOT NULL,
  `trainee_id` int(10) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `invoice_date` date NOT NULL,
  `sub_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Fixed, 2=Percentage',
  `vat` decimal(10,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Paid, 2=Partial',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `trainee_id`, `invoice_no`, `invoice_date`, `sub_total`, `discount_amount`, `discount_type`, `vat`, `grand_total`, `notes`, `payment_status`, `paid_amount`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(14, 21, 'INV-2026-0001', '2026-08-08', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 0, 0.00, '2026-08-08 17:19:09', '2026-08-08 17:19:09', 3, NULL, NULL),
(15, 21, 'INV-2026-0002', '2026-08-08', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 0, 0.00, '2026-08-08 17:19:31', '2026-08-08 17:19:31', 3, NULL, NULL),
(16, 21, 'INV-2026-0003', '2026-08-08', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 0, 0.00, '2026-08-08 17:21:29', '2026-08-08 17:21:29', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(10) NOT NULL,
  `invoice_id` int(10) NOT NULL,
  `batch_id` int(10) NOT NULL,
  `course_id` int(10) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = Percent, 2 = Fixed',
  `vat` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sub_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = Inactive, 1 = Active',
  `payment_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Unpaid, 1 = Paid, 2 = Partial',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `batch_id`, `course_id`, `price`, `discount_amount`, `discount_type`, `vat`, `sub_total`, `status`, `payment_status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(9, 14, 5, 3, 10000.00, 0.00, 1, 1500.00, 11500.00, 1, 0, '2026-08-08 17:19:09', '2026-08-08 17:19:09', 3, NULL, NULL),
(10, 15, 5, 3, 10000.00, 0.00, 1, 1500.00, 11500.00, 1, 0, '2026-08-08 17:19:31', '2026-08-08 17:19:31', 3, NULL, NULL),
(11, 16, 5, 3, 10000.00, 0.00, 1, 1500.00, 11500.00, 1, 0, '2026-08-08 17:21:29', '2026-08-08 17:21:29', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) NOT NULL,
  `invoice_id` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Bkash, 1 = Cash, 2 = Nagad, 3 = Card, 4 = Bank',
  `payment_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Paid, 2 = Failed',
  `transaction_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `access` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `access`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Full access to all system features', 1, '2026-07-25 05:51:10', '2026-07-25 05:51:10'),
(2, 'Admin', 'Manage users, settings, and reports', 1, '2026-07-25 05:51:10', '2026-07-25 05:51:10');

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
(20, 3, '1998-08-30', '510 Hillcrest Avenue, Minneapolis, MN', 'Bachelor of Environmental Science', '2025-02-26', 'Taylor Reed', 'taylor.reed@example.com', '+12025550120', '$2y$10$dummyHashedPassword020', NULL, 1, '2026-07-26 04:19:07', NULL, NULL, NULL, NULL),
(21, 1, '1999-01-02', 'Hazi Camp', 'Bachelor of Business Administration', '2026-07-25', 'Md. Ibrahim', 'ibrahim@yahoo.com', '015', '7c4a8d09ca3762af61e59520943dc26494f8941b', '4885961785041728_smiling-schoolboy-holding-a-book-with-backpack-on-transparent-background-png.webp', 1, '2026-07-26 04:47:49', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '1=Male, 2=Female, 3=Other',
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `user_id`, `specialization`, `qualification`, `experience`, `salary`, `joining_date`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `dob`, `gender`, `address`, `image`) VALUES
(4, 12, 'tujty', 'tuhfykj', 0, 0.00, '2026-08-06', '2026-08-03 17:33:12', '2026-08-04 05:17:04', '2026-08-04 01:17:04', 3, 3, '2026-08-14', 3, 'eterhfjy', '8705171785815276_IMG_0355.JPG'),
(5, 15, 'as', 'as', 0, 1234.00, '2026-08-15', '2026-08-04 05:56:02', '2026-08-08 06:35:52', '2026-08-08 02:35:52', 3, NULL, '2026-08-19', 3, 'as', ''),
(6, 16, 'edwfr', 'sefes', 0, 0.00, '2026-08-07', '2026-08-04 06:10:16', '2026-08-04 06:10:31', NULL, 3, 3, '2026-08-21', 2, 'sqawfd', '7134051785823831_IMG_0355.JPG'),
(7, 17, 'msc', 'asfik', 0, 12222.00, '2026-08-12', '2026-08-08 05:34:36', '2026-08-08 06:35:50', '2026-08-08 02:35:50', 3, NULL, '2005-02-08', 1, 'cda', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `password`, `role_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'kamal', 'kamal@yahoo.com', '0105', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, '2026-07-25 06:19:50', '2026-07-25 06:19:50', NULL),
(3, 'nasrat ', 'anika@gmail.com', '01234', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1, 1, '2026-08-02 03:45:13', '2026-08-02 03:45:13', NULL),
(4, 'tafrin', 'tafrin@gmail.com', '01234', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1, 1, '2026-08-03 06:18:47', '2026-08-03 06:18:47', NULL),
(12, 'nasrat tafrin', 'nasrat.tafrin2000@gmail.com', '01234', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, 1, '2026-08-03 17:33:12', '2026-08-03 17:33:12', NULL),
(15, 'nasrat tafrin', 't@gmail.com', '01234', '8cb2237d0679ca88db6464eac60da96345513964', 3, 1, '2026-08-04 05:56:02', '2026-08-04 05:56:02', NULL),
(16, 'nasrat tafrin', 'a@gmail.com', '01234', '7c222fb2927d828af22f592134e8932480637c0d', 3, 1, '2026-08-04 06:10:16', '2026-08-04 06:10:31', NULL),
(17, 'ashik', 'ashik@gmail.com', '123456', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, 1, '2026-08-08 05:34:36', '2026-08-08 05:34:36', NULL);

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
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_enrollment_trainee` (`trainee_id`),
  ADD KEY `fk_enrollment_course` (`course_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`),
  ADD KEY `trainee_id` (`trainee_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batches_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `fk_enrollment_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_enrollment_trainee` FOREIGN KEY (`trainee_id`) REFERENCES `trainees` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`trainee_id`) REFERENCES `trainees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_details_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_details_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
