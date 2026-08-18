-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2026 at 08:47 PM
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
-- Table structure for table `account_heads`
--

CREATE TABLE `account_heads` (
  `id` int(10) NOT NULL,
  `account_code` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_type` int(11) NOT NULL COMMENT '1=Asset, 2=Liability, 3=Income, 4=Expense, 5=Equity, 6=VAT',
  `account_subtype` varchar(50) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `opening_balance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `current_balance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_debit` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_credit` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive, 1=Active',
  `last_transaction_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_heads`
--

INSERT INTO `account_heads` (`id`, `account_code`, `account_name`, `account_type`, `account_subtype`, `parent_id`, `opening_balance`, `current_balance`, `total_debit`, `total_credit`, `status`, `last_transaction_date`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'erfet', 'qr', 2, 'rq', 0, 0.09, 0.00, 0.00, 0.00, 1, NULL, 'rwet', '2026-08-16 16:00:49', '2026-08-16 16:00:49', 3, NULL, NULL);

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
(6, 4, 6, '2026-08-13', '2026-08-20', 18000.00, 0.14, 2, '23:45:00', '14:45:00', '12', '2026-08-08 15:45:12', '2026-08-08 15:45:12', 3, NULL, NULL, 'Python Programming - Aug 2026', 10, 0),
(7, 5, 6, '2026-08-03', '2027-01-03', 22000.00, 0.00, 1, '12:04:00', '21:08:00', '12', '2026-08-16 15:04:53', '2026-08-16 15:04:53', 3, NULL, NULL, 'Mobile App Development - Aug 2026', 12, 2);

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
(1, 'Web Develpment', 'Web Development is a practical course designed to teach students how to build modern, responsive, and user-friendly websites. Students will learn HTML, CSS, JavaScript, Bootstrap, PHP, MySQL, database management, and basic CRUD operations. The course focu', '2026-08-13 04:04:59', '2026-08-13 06:05:12'),
(2, 'Web Develpment', 'Web Development is a practical course designed to teach students how to build modern, responsive, and user-friendly websites. Students will learn HTML, CSS, JavaScript, Bootstrap, PHP, MySQL, database management, and basic CRUD operations. The course focu', '2026-08-13 04:06:04', '2026-08-13 06:06:40'),
(3, 'Web Develpment', 'Web Development is a practical course designed to teach students how to build modern websites.', '2026-08-13 04:07:38', '2026-08-13 06:11:16'),
(4, 'Python', 'Python is a powerful and beginner-friendly programming language used for web development, automation, data analysis, AI, and software development.', '2026-08-13 04:09:44', '2026-08-13 06:09:57'),
(5, 'Python Programming', 'Python is a powerful and beginner-friendly programming language used for web development, automation, data analysis, AI, and software development.', '2026-08-13 04:10:12', '2026-08-13 06:10:48'),
(6, 'Web Develpment', '1.Web Development is a technology category focused on designing, developing, and maintaining websites and web applications.', '2026-08-13 04:12:08', NULL),
(7, 'Programming', 'Programming is a technology category focused on learning programming languages and developing software, applications, and digital solutions.', '2026-08-13 04:12:49', NULL);

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
(14, 21, 'INV-2026-0001', '2026-08-08', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 1, 0.00, '2026-08-08 17:19:09', '2026-08-09 03:07:30', 3, 3, '2026-08-08 23:07:30'),
(15, 21, 'INV-2026-0002', '2026-08-08', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 0, 0.00, '2026-08-08 17:19:31', '2026-08-09 03:05:57', 3, NULL, '2026-08-08 23:05:57'),
(16, 21, 'INV-2026-0003', '2026-08-08', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 0, 0.00, '2026-08-08 17:21:29', '2026-08-09 03:05:52', 3, NULL, '2026-08-08 23:05:52'),
(17, 21, 'INV-2026-0004', '2026-08-09', 18000.00, 25.20, 1, 2696.22, 20671.02, '', 0, -0.01, '2026-08-09 03:04:48', '2026-08-09 03:05:49', 3, NULL, '2026-08-08 23:05:49'),
(18, 21, 'INV-2026-0005', '2026-08-09', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 0, 0.00, '2026-08-09 03:05:37', '2026-08-09 03:05:43', 3, NULL, '2026-08-08 23:05:43'),
(33, 21, 'INV-2026-0019', '2026-08-09', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 0, 600.00, '2026-08-09 04:04:38', '2026-08-09 04:04:38', 3, NULL, NULL),
(34, 21, 'INV-2026-0034', '2026-08-09', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 0, 600.00, '2026-08-09 04:06:10', '2026-08-09 04:06:10', 3, NULL, NULL),
(35, 21, 'INV-2026-0035', '2026-08-16', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 1, 11500.00, '2026-08-16 15:05:36', '2026-08-16 15:06:02', 3, 3, NULL),
(36, 21, 'INV-2026-0036', '2026-08-16', 10000.00, 0.00, 1, 1500.00, 11500.00, '', 1, 11500.00, '2026-08-16 15:56:08', '2026-08-16 15:56:26', 3, 3, NULL);

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
(11, 16, 5, 3, 10000.00, 0.00, 1, 1500.00, 11500.00, 1, 0, '2026-08-08 17:21:29', '2026-08-08 17:21:29', 3, NULL, NULL),
(12, 17, 6, 4, 18000.00, 25.20, 1, 2696.22, 20671.02, 1, 0, '2026-08-09 03:04:48', '2026-08-09 03:04:48', 3, NULL, NULL),
(13, 18, 5, 3, 10000.00, 0.00, 1, 1500.00, 11500.00, 1, 0, '2026-08-09 03:05:37', '2026-08-09 03:05:37', 3, NULL, NULL),
(14, 33, 5, 3, 10000.00, 0.00, 1, 1500.00, 11500.00, 1, 0, '2026-08-09 04:04:38', '2026-08-09 04:04:38', 3, NULL, NULL),
(15, 34, 5, 3, 10000.00, 0.00, 1, 1500.00, 11500.00, 1, 0, '2026-08-09 04:06:10', '2026-08-09 04:06:10', 3, NULL, NULL),
(16, 35, 5, 3, 10000.00, 0.00, 1, 1500.00, 11500.00, 1, 0, '2026-08-16 15:05:36', '2026-08-16 15:05:36', 3, NULL, NULL),
(17, 36, 5, 3, 10000.00, 0.00, 1, 1500.00, 11500.00, 1, 0, '2026-08-16 15:56:08', '2026-08-16 15:56:08', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `journal_vouchers`
--

CREATE TABLE `journal_vouchers` (
  `id` int(10) NOT NULL,
  `voucher_no` varchar(50) NOT NULL,
  `voucher_date` date NOT NULL,
  `narration` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive, 1=Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_voucher_details`
--

CREATE TABLE `journal_voucher_details` (
  `id` int(10) NOT NULL,
  `journal_voucher_id` int(10) NOT NULL,
  `account_head_id` int(10) NOT NULL,
  `dr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(10) NOT NULL,
  `payment_voucher_id` int(10) DEFAULT NULL,
  `receive_voucher_id` int(10) DEFAULT NULL,
  `journal_voucher_id` int(10) DEFAULT NULL,
  `account_head_id` int(10) NOT NULL,
  `dr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `amount`, `payment_date`, `payment_method`, `payment_status`, `transaction_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 33, 600.00, '2026-08-09', 0, 2, 'TXN-20260809-4469', '2026-08-09 04:04:38', '2026-08-09 04:04:38', 3, NULL, NULL),
(2, 34, 600.00, '2026-08-09', 0, 2, 'TXN-20260809-1276', '2026-08-09 04:06:10', '2026-08-09 04:06:10', 3, NULL, NULL),
(3, 35, 122.00, '2026-08-16', 1, 2, 'TXN-20260816-7012', '2026-08-16 15:05:36', '2026-08-16 15:05:36', 3, NULL, NULL),
(4, 35, 11378.00, '2026-08-16', 0, 1, NULL, '2026-08-16 15:06:02', '2026-08-16 15:06:02', 3, NULL, NULL),
(5, 36, 11500.00, '2026-08-16', 0, 1, 'TXN-20260816-6447', '2026-08-16 15:56:08', '2026-08-16 15:56:08', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_vouchers`
--

CREATE TABLE `payment_vouchers` (
  `id` int(10) NOT NULL,
  `voucher_no` varchar(50) NOT NULL,
  `voucher_date` date NOT NULL,
  `pay_to` varchar(100) NOT NULL,
  `narration` text DEFAULT NULL,
  `invoice_id` int(10) DEFAULT NULL,
  `dr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive, 1=Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_voucher_details`
--

CREATE TABLE `payment_voucher_details` (
  `id` int(10) NOT NULL,
  `payment_voucher_id` int(10) NOT NULL,
  `account_head_id` int(10) NOT NULL,
  `dr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receive_vouchers`
--

CREATE TABLE `receive_vouchers` (
  `id` int(10) NOT NULL,
  `voucher_no` varchar(50) NOT NULL,
  `voucher_date` date NOT NULL,
  `received_from` varchar(100) NOT NULL,
  `narration` text DEFAULT NULL,
  `invoice_id` int(10) DEFAULT NULL,
  `dr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive, 1=Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receive_voucher_details`
--

CREATE TABLE `receive_voucher_details` (
  `id` int(10) NOT NULL,
  `receive_voucher_id` int(10) NOT NULL,
  `account_head_id` int(10) NOT NULL,
  `dr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cr` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
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
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `selected_option` int(11) NOT NULL,
  `is_correct` int(11) NOT NULL DEFAULT 0 COMMENT '0 Incorrect 1 correct',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_answers`
--

INSERT INTO `student_answers` (`id`, `student_id`, `exam_id`, `question_id`, `selected_option`, `is_correct`, `created_at`) VALUES
(1, 21, 1, 1, 1, 1, '0000-00-00 00:00:00'),
(2, 21, 1, 2, 1, 0, '0000-00-00 00:00:00'),
(3, 1, 2, 2, 2, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_exam`
--

CREATE TABLE `student_exam` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `start_at` int(11) NOT NULL,
  `finish_at` int(11) DEFAULT NULL,
  `exam_date` date NOT NULL,
  `total_marks` decimal(10,0) DEFAULT NULL,
  `pass_status` int(11) DEFAULT 0 COMMENT '0 pending 1 Pass 2 fail',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_exam`
--

INSERT INTO `student_exam` (`id`, `student_id`, `exam_id`, `start_at`, `finish_at`, `exam_date`, `total_marks`, `pass_status`, `created_at`, `updated_at`) VALUES
(1, 21, 1, 1786863019, 1786863024, '2026-08-16', 1, 0, '2026-08-16 06:50:24', NULL),
(2, 1, 1, 1786863275, 0, '2026-08-16', 0, 0, '2026-08-16 06:54:35', NULL),
(3, 1, 2, 1786863686, 1786863688, '2026-08-16', 1, 0, '2026-08-16 07:01:28', NULL);

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
-- Table structure for table `trainer_attendance`
--

CREATE TABLE `trainer_attendance` (
  `id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=Present, 1=Absent, 2=Leave',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer_attendance`
--

INSERT INTO `trainer_attendance` (`id`, `trainer_id`, `attendance_date`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 6, '2026-08-11', 2, '2026-08-18 14:59:29', '2026-08-18 14:59:43', 3, 3, '2026-08-18 10:59:43'),
(2, 6, '2026-08-18', 0, '2026-08-18 16:04:19', '2026-08-18 16:04:19', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainer_leaves`
--

CREATE TABLE `trainer_leaves` (
  `id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `leave_type` tinyint(4) NOT NULL COMMENT '0=Casual, 1=Sick, 2=Annual',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2=Rejected',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer_leaves`
--

INSERT INTO `trainer_leaves` (`id`, `trainer_id`, `leave_type`, `start_date`, `end_date`, `reason`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 6, 1, '2026-08-12', '2026-08-11', 'xbvdf', 1, '2026-08-18 15:00:48', '2026-08-18 15:01:02', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainer_leave_balances`
--

CREATE TABLE `trainer_leave_balances` (
  `id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `month` varchar(7) NOT NULL COMMENT 'Format: YYYY-MM',
  `total_balance` int(11) NOT NULL DEFAULT 4,
  `used_balance` int(11) NOT NULL DEFAULT 0,
  `remaining_balance` int(11) NOT NULL DEFAULT 4,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainer_loans`
--

CREATE TABLE `trainer_loans` (
  `id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `loan_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remaining_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `installment_count` int(11) NOT NULL DEFAULT 1,
  `installment_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `start_date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Active, 1=Completed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainer_salary_payments`
--

CREATE TABLE `trainer_salary_payments` (
  `id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `month` varchar(7) NOT NULL COMMENT 'Format: YYYY-MM',
  `basic_salary` decimal(12,2) NOT NULL DEFAULT 0.00,
  `absent_deduction` decimal(12,2) NOT NULL DEFAULT 0.00,
  `loan_deduction` decimal(12,2) NOT NULL DEFAULT 0.00,
  `net_payable` decimal(12,2) NOT NULL DEFAULT 0.00,
  `payment_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Paid, 1=Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `account_heads`
--
ALTER TABLE `account_heads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_code` (`account_code`);

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
-- Indexes for table `journal_vouchers`
--
ALTER TABLE `journal_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_no` (`voucher_no`);

--
-- Indexes for table `journal_voucher_details`
--
ALTER TABLE `journal_voucher_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_voucher_id` (`journal_voucher_id`),
  ADD KEY `account_head_id` (`account_head_id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_voucher_id` (`payment_voucher_id`),
  ADD KEY `receive_voucher_id` (`receive_voucher_id`),
  ADD KEY `journal_voucher_id` (`journal_voucher_id`),
  ADD KEY `account_head_id` (`account_head_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `payment_vouchers`
--
ALTER TABLE `payment_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_no` (`voucher_no`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `payment_voucher_details`
--
ALTER TABLE `payment_voucher_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_voucher_id` (`payment_voucher_id`),
  ADD KEY `account_head_id` (`account_head_id`);

--
-- Indexes for table `receive_vouchers`
--
ALTER TABLE `receive_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_no` (`voucher_no`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `receive_voucher_details`
--
ALTER TABLE `receive_voucher_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receive_voucher_id` (`receive_voucher_id`),
  ADD KEY `account_head_id` (`account_head_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_exam`
--
ALTER TABLE `student_exam`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `trainer_attendance`
--
ALTER TABLE `trainer_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `trainer_leaves`
--
ALTER TABLE `trainer_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `trainer_leave_balances`
--
ALTER TABLE `trainer_leave_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `trainer_loans`
--
ALTER TABLE `trainer_loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `trainer_salary_payments`
--
ALTER TABLE `trainer_salary_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`);

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
-- AUTO_INCREMENT for table `account_heads`
--
ALTER TABLE `account_heads`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `journal_vouchers`
--
ALTER TABLE `journal_vouchers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_voucher_details`
--
ALTER TABLE `journal_voucher_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_vouchers`
--
ALTER TABLE `payment_vouchers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_voucher_details`
--
ALTER TABLE `payment_voucher_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receive_vouchers`
--
ALTER TABLE `receive_vouchers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receive_voucher_details`
--
ALTER TABLE `receive_voucher_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_exam`
--
ALTER TABLE `student_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `trainer_attendance`
--
ALTER TABLE `trainer_attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trainer_leaves`
--
ALTER TABLE `trainer_leaves`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trainer_leave_balances`
--
ALTER TABLE `trainer_leave_balances`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainer_loans`
--
ALTER TABLE `trainer_loans`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainer_salary_payments`
--
ALTER TABLE `trainer_salary_payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `journal_voucher_details`
--
ALTER TABLE `journal_voucher_details`
  ADD CONSTRAINT `journal_voucher_details_ibfk_1` FOREIGN KEY (`journal_voucher_id`) REFERENCES `journal_vouchers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `journal_voucher_details_ibfk_2` FOREIGN KEY (`account_head_id`) REFERENCES `account_heads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ledger`
--
ALTER TABLE `ledger`
  ADD CONSTRAINT `ledger_ibfk_1` FOREIGN KEY (`payment_voucher_id`) REFERENCES `payment_vouchers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ledger_ibfk_2` FOREIGN KEY (`receive_voucher_id`) REFERENCES `receive_vouchers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ledger_ibfk_3` FOREIGN KEY (`journal_voucher_id`) REFERENCES `journal_vouchers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ledger_ibfk_4` FOREIGN KEY (`account_head_id`) REFERENCES `account_heads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_vouchers`
--
ALTER TABLE `payment_vouchers`
  ADD CONSTRAINT `payment_vouchers_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payment_voucher_details`
--
ALTER TABLE `payment_voucher_details`
  ADD CONSTRAINT `payment_voucher_details_ibfk_1` FOREIGN KEY (`payment_voucher_id`) REFERENCES `payment_vouchers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_voucher_details_ibfk_2` FOREIGN KEY (`account_head_id`) REFERENCES `account_heads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receive_vouchers`
--
ALTER TABLE `receive_vouchers`
  ADD CONSTRAINT `receive_vouchers_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `receive_voucher_details`
--
ALTER TABLE `receive_voucher_details`
  ADD CONSTRAINT `receive_voucher_details_ibfk_1` FOREIGN KEY (`receive_voucher_id`) REFERENCES `receive_vouchers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `receive_voucher_details_ibfk_2` FOREIGN KEY (`account_head_id`) REFERENCES `account_heads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainer_attendance`
--
ALTER TABLE `trainer_attendance`
  ADD CONSTRAINT `trainer_attendance_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainer_leaves`
--
ALTER TABLE `trainer_leaves`
  ADD CONSTRAINT `trainer_leaves_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainer_leave_balances`
--
ALTER TABLE `trainer_leave_balances`
  ADD CONSTRAINT `trainer_leave_balances_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainer_loans`
--
ALTER TABLE `trainer_loans`
  ADD CONSTRAINT `trainer_loans_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainer_salary_payments`
--
ALTER TABLE `trainer_salary_payments`
  ADD CONSTRAINT `trainer_salary_payments_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
