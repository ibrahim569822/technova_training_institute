-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2026 at 05:29 AM
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
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `trainee_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `enrollment_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Enrolled, 1 = Completed, 2 = Dropped',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `trainee_id` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_type` int(11) DEFAULT NULL COMMENT '1 = Percent, 2 = Fixed',
  `vat` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invoice_no` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `status` int(11) DEFAULT 1 COMMENT '0=Inactive, 1=Active',
  `payment_status` int(11) DEFAULT 0 COMMENT '0=Paid,1=Pending,2=Fixed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL COMMENT 'References users(id)',
  `updated_by` int(11) DEFAULT NULL COMMENT 'References users(id)'
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `password`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'kamal', 'kamal@yahoo.com', '0105', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, '2026-07-25 06:19:50', '2026-07-25 06:19:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_enrollment_trainee` (`trainee_id`),
  ADD KEY `fk_enrollment_course` (`course_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`),
  ADD KEY `trainee_id` (`trainee_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `fk_enrollment_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_enrollment_trainee` FOREIGN KEY (`trainee_id`) REFERENCES `trainees` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`trainee_id`) REFERENCES `trainees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
