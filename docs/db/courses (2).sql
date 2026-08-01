-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2026 at 08:40 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
