-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 01:55 AM
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
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `timestamp`) VALUES
(1, 1, 'Logout', 'User logged out', '2025-06-06 00:37:51'),
(2, 1, 'Login', 'Admin logged in', '2025-06-06 00:38:15'),
(3, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 00:43:01'),
(4, 1, 'Updated user (ID: 2) - username: \'muda\', email: \'muda@gmail.com\', department_id: 1, course: \'cyber security\', year: 3, level: \'Degree\'', '', '2025-06-06 00:51:43'),
(5, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 00:56:35'),
(6, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 00:56:40'),
(7, 1, 'Admin \'Admin\' updated user \'sylvia\' (ID: 3)', '', '2025-06-06 00:56:56'),
(8, 1, 'Admin \'Admin\' accessed Manage Users page', '', '2025-06-06 01:02:35'),
(9, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:05:39'),
(10, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:09:24'),
(11, 1, 'Add User', 'Added user: wakas, email: wakas@gmail.om', '2025-06-06 01:10:43'),
(12, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:10:45'),
(13, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:11:15'),
(14, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:11:25'),
(15, 1, 'Updated Profile', 'User \'Admin\' (ID: 1) updated their profile details: email=\'hussein@gmail.com\', address=\'INFORMATION TECHNOLOGY\', phone=\'0658216348\', gender=\'Male\', department_id=1, profile_image=\'1_1749152008.png\'', '2025-06-06 01:11:31'),
(16, 1, 'Logout', 'User logged out', '2025-06-06 01:15:30'),
(17, 1, 'Login', 'Admin logged in', '2025-06-06 01:15:51'),
(18, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:15:53'),
(19, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:16:01'),
(20, 1, 'Login', 'Admin logged in', '2025-06-06 01:27:28'),
(21, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:27:32'),
(22, 1, 'Updated Profile', 'User \'Admin\' (ID: 1) updated their profile details: email=\'hussein@gmail.com\', address=\'INFORMATION TECHNOLOGY\', phone=\'0658216348\', gender=\'Male\', department_id=1, profile_image=\'1_1749152008.png\'', '2025-06-06 01:28:10'),
(23, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:28:40'),
(24, 1, 'Logout', 'User logged out', '2025-06-06 01:28:51'),
(25, 1, 'Login', 'Admin logged in', '2025-06-06 01:29:40'),
(26, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:29:42'),
(27, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:29:45'),
(28, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:29:54'),
(29, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:31:29'),
(30, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:33:50'),
(31, 1, 'Deleted User', 'Admin \'Admin\' (ID: 1) deleted user \'muda\' (ID: 2)', '2025-06-06 01:33:57'),
(32, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:33:59'),
(33, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:36:31'),
(34, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:36:46'),
(35, 1, 'Login', 'Admin logged in', '2025-06-06 01:39:58'),
(36, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:40:02'),
(37, 1, 'Login', 'Admin logged in', '2025-06-06 01:40:31'),
(38, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 01:40:33'),
(39, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:40:38'),
(40, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:40:45'),
(41, 1, 'Logout', 'User logged out', '2025-06-06 01:41:39'),
(42, 1, 'Login', 'Admin logged in', '2025-06-06 10:23:46'),
(43, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 10:23:48'),
(44, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 10:24:13'),
(45, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 10:33:16'),
(46, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 10:33:46'),
(47, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 10:34:08'),
(48, 1, 'Logout', 'User logged out', '2025-06-06 10:34:13'),
(49, 1, 'Login', 'Admin logged in', '2025-06-06 10:34:37'),
(50, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 10:34:40'),
(51, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 10:34:56'),
(52, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 10:35:36'),
(53, 1, 'Updated User', 'Admin \'Admin\' (ID: 1) updated user \'radhia\' (ID: 3) with email \'radhia@gmail.com\', department_id 1, course \'Bachelor Degree in Information Technology\', year 2, level \'Diploma\', profile image \'1749157809_1748461281_IMG-20250528-WA0048.jpg\'', '2025-06-06 10:36:20'),
(54, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 10:36:23'),
(55, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 10:41:55'),
(56, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 10:42:01'),
(57, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 10:43:50'),
(58, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 10:45:19'),
(59, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 10:46:35'),
(60, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 10:46:43'),
(61, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 10:54:28'),
(62, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 10:55:41'),
(63, 1, 'Updated Profile', 'User \'Admin\' (ID: 1) updated their profile details: email=\'hussein@gmail.com\', address=\'INFORMATION TECHNOLOGY\', phone=\'0658216348\', gender=\'Male\', department_id=1, profile_image=\'1_1749196591.png\'', '2025-06-06 10:56:31'),
(64, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 10:56:39'),
(65, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:00:54'),
(66, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 11:09:35'),
(67, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:10:12'),
(68, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:10:18'),
(69, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:10:22'),
(70, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:11:05'),
(71, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:11:21'),
(72, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:11:34'),
(73, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:17:21'),
(74, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:17:24'),
(75, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:17:27'),
(76, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 11:17:30'),
(77, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:19:00'),
(78, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:19:44'),
(79, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:21:57'),
(80, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:21:58'),
(81, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:22:09'),
(82, 1, 'Logout', 'User logged out', '2025-06-06 11:22:13'),
(83, 1, 'Login', 'Admin logged in', '2025-06-06 11:22:34'),
(84, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:22:36'),
(85, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:23:33'),
(86, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:23:40'),
(87, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:23:50'),
(88, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:23:54'),
(89, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 11:23:55'),
(90, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:25:19'),
(91, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:25:22'),
(92, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:27:50'),
(93, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:28:13'),
(94, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:28:49'),
(95, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:28:52'),
(96, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:30:41'),
(97, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:32:45'),
(98, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:33:24'),
(99, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:39:18'),
(100, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:39:26'),
(101, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:43:26'),
(102, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:44:27'),
(103, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:46:44'),
(104, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:47:19'),
(105, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:50:58'),
(106, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:52:24'),
(107, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:57:22'),
(108, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:58:07'),
(109, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 11:58:08'),
(110, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 12:03:00'),
(111, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 12:03:02'),
(112, 1, 'Logout', 'User logged out', '2025-06-06 12:03:13'),
(113, 3, 'Login', 'User logged in', '2025-06-06 12:03:23'),
(114, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:03:24'),
(115, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:04:16'),
(116, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:04:17'),
(117, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:04:17'),
(118, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:04:17'),
(119, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:04:34'),
(120, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:05:02'),
(121, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:05:31'),
(122, 3, 'Logout', 'User logged out', '2025-06-06 12:05:34'),
(123, 3, 'Failed Login', 'Incorrect password', '2025-06-06 12:05:40'),
(124, 3, 'Login', 'User logged in', '2025-06-06 12:05:51'),
(125, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:05:53'),
(126, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:11:13'),
(127, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:11:38'),
(128, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:11:56'),
(129, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:12:00'),
(130, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:12:02'),
(131, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:12:05'),
(132, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:12:08'),
(133, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:12:32'),
(134, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:12:35'),
(135, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:13:18'),
(136, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:13:38'),
(137, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:15:06'),
(138, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:18:23'),
(139, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:18:57'),
(140, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 12:18:59'),
(141, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 12:19:07'),
(142, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 12:19:30'),
(143, 3, 'Submit Appeal', 'Appeal titled \'Math\' submitted.', '2025-06-06 12:19:30'),
(144, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:19:32'),
(145, 3, 'Logout', 'User logged out', '2025-06-06 12:19:36'),
(146, 1, 'Login', 'Admin logged in', '2025-06-06 12:19:48'),
(147, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 12:19:50'),
(148, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 12:20:27'),
(149, 1, 'Logout', 'User logged out', '2025-06-06 12:22:55'),
(150, 3, 'Failed Login', 'Incorrect password', '2025-06-06 12:23:03'),
(151, 3, 'Login', 'User logged in', '2025-06-06 12:23:15'),
(152, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:23:17'),
(153, 3, 'Logout', 'User logged out', '2025-06-06 12:23:23'),
(154, 1, 'Login', 'Admin logged in', '2025-06-06 12:23:34'),
(155, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 12:23:35'),
(156, 1, 'Logout', 'User logged out', '2025-06-06 12:26:35'),
(157, 3, 'Login', 'User logged in', '2025-06-06 12:26:45'),
(158, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 12:26:47'),
(159, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 12:26:50'),
(160, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 12:27:06'),
(161, 3, 'Submit Appeal', 'Appeal titled \'admin\' submitted.', '2025-06-06 12:27:06'),
(162, 3, 'Logout', 'User logged out', '2025-06-06 12:27:08'),
(163, 1, 'Login', 'Admin logged in', '2025-06-06 12:27:23'),
(164, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 12:27:24'),
(165, 1, 'Logout', 'User logged out', '2025-06-06 13:43:25'),
(166, 3, 'Login', 'User logged in', '2025-06-06 13:43:39'),
(167, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 13:43:41'),
(168, 3, 'Logout', 'User logged out', '2025-06-06 13:43:53'),
(169, 1, 'Login', 'Admin logged in', '2025-06-06 13:44:07'),
(170, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 13:44:09'),
(171, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 13:51:27'),
(172, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 13:51:31'),
(173, 1, 'Logout', 'User logged out', '2025-06-06 13:51:33'),
(174, 3, 'Login', 'User logged in', '2025-06-06 13:51:45'),
(175, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 13:51:46'),
(176, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 13:51:59'),
(177, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 13:52:03'),
(178, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 14:37:58'),
(179, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 14:38:04'),
(180, 3, 'View Appeals Page', 'User viewed the list of appeals', '2025-06-06 14:38:29'),
(181, 3, 'Access Appeals Page', 'User viewed their appeal submissions', '2025-06-06 14:44:21'),
(182, 3, 'Access Appeals Page', 'User viewed their appeal submissions', '2025-06-06 14:46:32'),
(183, 3, 'View Appeals', 'User viewed their appeals', '2025-06-06 14:48:49'),
(184, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 14:48:55'),
(185, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 14:48:56'),
(186, 3, 'View Appeals', 'User viewed their appeals', '2025-06-06 14:48:58'),
(187, 3, 'View Appeals', 'Visited appeals table', '2025-06-06 14:54:46'),
(188, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 14:54:51'),
(189, 3, 'View Appeals', 'Visited appeals table', '2025-06-06 14:54:57'),
(190, 3, 'Delete Appeal', 'User deleted appeal ID 1', '2025-06-06 14:55:08'),
(191, 3, 'View Appeals', 'Visited appeals table', '2025-06-06 14:55:08'),
(192, 3, 'View Appeals', 'Visited appeals table', '2025-06-06 14:55:56'),
(193, 3, 'Visited Dashboard', 'Viewed dashboard with appeals', '2025-06-06 14:57:48'),
(194, 3, 'Visited Dashboard', 'Viewed dashboard with appeals', '2025-06-06 14:57:51'),
(195, 3, 'Visited Dashboard', 'Viewed dashboard with appeals', '2025-06-06 14:57:52'),
(196, 3, 'Visited Dashboard', 'Viewed dashboard with appeals', '2025-06-06 14:57:53'),
(197, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 14:57:55'),
(198, 3, 'View Appeals', 'Visited appeals table', '2025-06-06 14:59:43'),
(199, 3, 'View Appeals', 'Visited appeals table', '2025-06-06 15:01:35'),
(200, 3, 'Edit Appeal', 'Edited appeal ID 3', '2025-06-06 15:02:11'),
(201, 3, 'View Appeals', 'Visited appeals table', '2025-06-06 15:02:19'),
(202, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 15:10:38'),
(203, 3, 'Updated Profile', 'User \'radhia\' (ID: 3) updated their profile details: email=\'radhia@gmail.com\', address=\'Arusha\', phone=\'0694506245\', gender=\'Female\', department_id=1, profile_image=\'1749157809_1748461281_IMG-20250528-WA0048.jpg\'', '2025-06-06 15:13:15'),
(204, 3, 'Updated Profile', 'User \'radhia\' (ID: 3) updated their profile details: email=\'radhia@gmail.com\', address=\'Arusha\', phone=\'0694506245\', gender=\'Female\', department_id=1, profile_image=\'3_1749212017.jpg\'', '2025-06-06 15:13:37'),
(205, 3, 'Updated Profile', 'User \'radhia\' (ID: 3) updated their profile details: email=\'radhia@gmail.com\', address=\'Arusha\', phone=\'0694506245\', gender=\'Female\', department_id=1, profile_image=\'3_1749212030.jpg\'', '2025-06-06 15:13:50'),
(206, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 15:14:04'),
(207, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 15:15:05'),
(208, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 15:15:34'),
(209, 3, 'Password Changed', 'User changed their password', '2025-06-06 15:16:22'),
(210, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 15:18:12'),
(211, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 15:18:13'),
(212, 3, 'View Appeals', 'Visited appeals table', '2025-06-06 15:18:14'),
(213, 3, 'Logout', 'User logged out', '2025-06-06 15:18:19'),
(214, 1, 'Login', 'Admin logged in', '2025-06-06 15:18:43'),
(215, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:18:45'),
(216, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:20:02'),
(217, 1, 'Approve Appeal', 'Appeal ID: 3, Subject: \'admin\' set to Approved', '2025-06-06 15:34:21'),
(218, 1, 'Approve Appeal', 'Appeal ID: 2, Subject: \'Math\' set to Approved', '2025-06-06 15:36:01'),
(219, 1, 'Deleted Appeal', 'Appeal ID: 2, Subject: \'Math\' deleted', '2025-06-06 15:36:12'),
(220, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:36:20'),
(221, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:39:11'),
(222, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:39:16'),
(223, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:39:17'),
(224, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:39:17'),
(225, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:39:18'),
(226, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:39:20'),
(227, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:42:01'),
(228, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:42:15'),
(229, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:42:18'),
(230, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:46:24'),
(231, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:46:26'),
(232, 1, 'Logout', 'User logged out', '2025-06-06 15:50:22'),
(233, 3, 'Login', 'User logged in', '2025-06-06 15:50:47'),
(234, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 15:50:49'),
(235, 3, 'Logout', 'User logged out', '2025-06-06 15:53:46'),
(236, 1, 'Login', 'Admin logged in', '2025-06-06 15:54:03'),
(237, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:54:05'),
(238, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:56:46'),
(239, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:56:47'),
(240, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:56:47'),
(241, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:56:47'),
(242, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:56:48'),
(243, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:56:48'),
(244, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:56:49'),
(245, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 15:58:00'),
(246, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 16:00:37'),
(247, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 16:00:42'),
(248, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 16:02:46'),
(249, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 16:02:51'),
(250, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 16:02:51'),
(251, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:03:20'),
(252, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:03:24'),
(253, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:05:07'),
(254, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:05:25'),
(255, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:07:15'),
(256, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:07:36'),
(257, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:07:38'),
(258, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:07:49'),
(259, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:12:13'),
(260, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:12:25'),
(261, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 17:14:42'),
(262, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 17:14:45'),
(263, 1, 'Updated User', 'Admin \'Admin\' (ID: 1) updated user \'radhia\' (ID: 3) with email \'radhia@gmail.com\', department_id 1, course \'Bachelor Degree in Information Technology\', year 2, level \'Diploma\', profile image \'3_1749212030.jpg\'', '2025-06-06 17:16:22'),
(264, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 17:16:24'),
(265, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:16:29'),
(266, 1, 'Logout', 'User logged out', '2025-06-06 17:16:36'),
(267, 4, 'Login', 'User logged in', '2025-06-06 17:16:57'),
(268, 4, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 17:16:59'),
(269, 4, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 17:17:03'),
(270, 4, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 17:17:05'),
(271, 4, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 17:17:15'),
(272, 4, 'Submit Appeal', 'Appeal titled \'abarani\' submitted.', '2025-06-06 17:17:15'),
(273, 4, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 17:17:19'),
(274, 4, 'View Appeals', 'Visited appeals table', '2025-06-06 17:17:24'),
(275, 4, 'Edit Appeal', 'Edited appeal ID 4', '2025-06-06 17:17:48'),
(276, 4, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 17:18:22'),
(277, 4, 'Logout', 'User logged out', '2025-06-06 17:18:25'),
(278, 1, 'Login', 'Admin logged in', '2025-06-06 17:18:37'),
(279, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:18:38'),
(280, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:22:20'),
(281, 1, 'Logout', 'User logged out', '2025-06-06 17:24:01'),
(282, 3, 'Login', 'User logged in', '2025-06-06 17:24:12'),
(283, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 17:24:15'),
(284, 3, 'Access Add Appeal Page', 'User opened the add appeal form', '2025-06-06 17:24:24'),
(285, 3, 'View Appeals', 'Visited appeals table', '2025-06-06 17:24:27'),
(286, 3, 'Logout', 'User logged out', '2025-06-06 17:24:42'),
(291, 3, 'Login', 'User logged in', '2025-06-06 17:29:24'),
(292, 3, 'Access Dashboard', 'User accessed the dashboard', '2025-06-06 17:29:26'),
(293, 3, 'Logout', 'User logged out', '2025-06-06 17:29:28'),
(295, NULL, 'Failed Login', 'User not found: william@gmail.com', '2025-06-06 17:32:00'),
(296, NULL, 'Failed Login', 'User not found: william@gmail.com', '2025-06-06 17:32:04'),
(297, NULL, 'Failed Login', 'User not found: william@gmail.com', '2025-06-06 17:32:07'),
(298, 1, 'Login', 'Admin logged in', '2025-06-06 17:32:29'),
(299, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:32:30'),
(300, 1, 'Approve Appeal', 'Appeal ID: 4, Subject: \'abarani\' set to Approved', '2025-06-06 17:32:46'),
(301, 1, 'Access Dashboard', 'Admin accessed the dashboard page', '2025-06-06 17:32:49'),
(302, 1, 'Logout', 'User logged out', '2025-06-06 17:33:30'),
(303, NULL, 'Failed Login', 'User not found: william@gmail.com', '2025-06-06 17:33:37'),
(304, NULL, 'Failed Login', 'User not found: william@gmail.com', '2025-06-06 17:34:33'),
(305, NULL, 'Failed Login', 'User not found: william@gmail.com', '2025-06-06 17:34:38'),
(306, NULL, 'Failed Login', 'User not found: william@gmail.com', '2025-06-06 17:35:31'),
(307, NULL, 'Failed Login', 'User not found: william@gmail.com', '2025-06-07 02:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `appeals`
--

CREATE TABLE `appeals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appeals`
--

INSERT INTO `appeals` (`id`, `user_id`, `subject`, `message`, `attachment`, `status`, `created_at`) VALUES
(3, 3, 'admin', 'no answer', 'BIT-01-0011-2023023-04-2025 .pdf', 'Approved', '2025-06-06 09:27:06'),
(4, 4, 'abarani', 'wasddd', 'LARAVEL.docx', 'Approved', '2025-06-06 14:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `campus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `campus`) VALUES
(1, 'Basic Technician Certificate in Accountancy', 'Arusha'),
(2, 'Basic Technician Certificate in Accountancy with IT', 'Arusha'),
(3, 'Basic Technician Certificate in Business Management', 'Arusha'),
(4, 'Basic Technician Certificate in Business Management with Chinese', 'Arusha'),
(5, 'Basic Technician Certificate in Computer Networking', 'Arusha'),
(6, 'Basic Technician Certificate in Computing and Information Technology', 'Arusha'),
(7, 'Basic Technician Certificate in Economics and Finance', 'Arusha'),
(8, 'Basic Technician Certificate in Finance and Banking', 'Arusha'),
(9, 'Basic Technician Certificate in Human Resources Management', 'Arusha'),
(10, 'Basic Technician Certificate in Insurance and Risk Management', 'Arusha'),
(11, 'Basic Technician Certificate in Library and Information studies', 'Arusha'),
(12, 'Basic Technician Certificate in Marketing and Public Relations', 'Arusha'),
(13, 'Basic Technician Certificate in Mobile Application Development', 'Arusha'),
(14, 'Basic Technician Certificate in Multimedia', 'Arusha'),
(15, 'Basic Technician Certificate in Procurement and Supply Chain Management', 'Arusha'),
(16, 'Basic Technician Certificate in Records and Information Management', 'Arusha'),
(17, 'Diploma in Accountancy', 'Arusha'),
(18, 'Diploma in Accountancy with IT', 'Arusha'),
(19, 'Diploma in Business Management', 'Arusha'),
(20, 'Diploma in Business Management with Chinese', 'Arusha'),
(21, 'Diploma in Computer Networking', 'Arusha'),
(22, 'Diploma in Computer Science', 'Arusha'),
(23, 'Diploma in Economics and Finance', 'Arusha'),
(24, 'Diploma in Finance and Banking', 'Arusha'),
(25, 'Diploma in Human Resources Management', 'Arusha'),
(26, 'Diploma in Information Technology', 'Arusha'),
(27, 'Diploma in Insurance and Risk Management', 'Arusha'),
(28, 'Diploma in Library and Information Studies', 'Arusha'),
(29, 'Diploma in Marketing & Public Relations', 'Arusha'),
(30, 'Diploma in Mobile Applications Development', 'Arusha'),
(31, 'Diploma in Multimedia', 'Arusha'),
(32, 'Diploma in Procurement and Supply Chain Management', 'Arusha'),
(33, 'Diploma in Records and Information Management', 'Arusha'),
(34, 'Bachelor Degree in Accountancy', 'Arusha'),
(35, 'Bachelor Degree In Accountancy and Finance', 'Arusha'),
(36, 'Bachelor Degree in Accountancy with Information Technology', 'Arusha'),
(37, 'Bachelor Degree in Auditing and Assurance', 'Arusha'),
(38, 'Bachelor Degree in Banking with Apprenticeship', 'Arusha'),
(39, 'Bachelor Degree in Business Management', 'Arusha'),
(40, 'Bachelor Degree in Computer Science', 'Arusha'),
(41, 'Bachelor Degree in Credit Management', 'Arusha'),
(42, 'Bachelor Degree in Cyber Security', 'Arusha'),
(43, 'Bachelor Degree in Economics and Finance', 'Arusha'),
(44, 'Bachelor Degree in Economics and Project Management', 'Arusha'),
(45, 'Bachelor Degree in Economics and Taxation', 'Arusha'),
(46, 'Bachelor Degree in Education with Computer Science', 'Arusha'),
(47, 'Bachelor Degree in Finance and Banking', 'Arusha'),
(48, 'Bachelor Degree in Human Resources and Management', 'Arusha'),
(49, 'Bachelor Degree in Information Technology', 'Arusha'),
(50, 'Bachelor Degree in Insurance and Risk Management with Apprenticeship', 'Arusha'),
(51, 'Bachelor Degree in Library Studies and Information Science', 'Arusha'),
(52, 'Bachelor Degree in Marketing and Public Relations', 'Arusha'),
(53, 'Bachelor Degree in Multimedia and Mass Communication', 'Arusha'),
(54, 'Bachelor Degree in Procurement and Supply Chain Management', 'Arusha'),
(55, 'Bachelor Degree In Records and Information Management', 'Arusha'),
(56, 'Bachelor Degree in Security and Strategic Studies', 'Arusha'),
(57, 'Bachelor Degree in Tourism and Hospitality Management with Apprenticeship', 'Arusha'),
(58, 'Master of Accountancy', 'Arusha'),
(59, 'Master of Accounting and Finance', 'Arusha'),
(60, 'Master of Arts in Peace and Security Studies', 'Arusha'),
(61, 'Master of Business Administration in Corporate Management', 'Arusha'),
(62, 'Master of Business Administration in Information Technology Management', 'Arusha'),
(63, 'Master of Business Administration in Leadership and Governance', 'Arusha'),
(64, 'Master of Business Administration in Policy Development and Execution', 'Arusha'),
(65, 'Master of Business Administration in Procurement and Supply Management', 'Arusha'),
(66, 'Master of Education Management', 'Arusha'),
(67, 'Master of Finance and Investment', 'Arusha'),
(68, 'Master of Human Resources Management', 'Arusha'),
(69, 'Master of Information Security', 'Arusha'),
(70, 'Master of Project Planning and Management', 'Arusha'),
(71, 'Master of Science in Economics and Finance', 'Arusha'),
(72, 'Master of Science in Finance and Banking', 'Arusha');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Information Technology'),
(2, 'Accounting'),
(3, 'Procurement and Logistics'),
(4, 'Marketing'),
(5, 'Business Administration'),
(6, 'Banking and Finance'),
(7, 'Human Resource Management'),
(8, 'Public Sector Accounting'),
(9, 'Economics'),
(10, 'Insurance and Risk Management');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT 'default.png',
  `department` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `address`, `phone`, `gender`, `password`, `role`, `created_at`, `profile_image`, `department`, `course`, `year`, `level`, `department_id`) VALUES
(1, 'Admin', 'hussein@gmail.com', 'INFORMATION TECHNOLOGY', '0658216348', 'Male', '$2y$10$VoQj8670ewPRAX6UlTcRS.ZLfMWSvEvjNnwYl0qsSsDhpW/HzcAgC', 'admin', '2025-06-05 15:00:30', '1_1749196591.png', NULL, NULL, NULL, NULL, 1),
(3, 'radhia', 'radhia@gmail.com', 'Arusha', '0694506245', 'Female', '$2y$10$/cbWRnPApxr3VGcU0UdYruT27thJ/ngnlzV8QtbkOXLcXy.EDgmtS', 'user', '2025-06-05 20:59:54', '3_1749212030.jpg', NULL, 'Bachelor Degree in Information Technology', '2', 'Diploma', 1),
(4, 'wakas', 'wakas@gmail.om', '', '', 'Male', '$2y$10$eA1POFAWPFIh1xN1iIFxR.nlNjzYNaVeM0FVes9nrxOShePjP02t6', 'user', '2025-06-05 22:10:43', '1749161443_passport.png', NULL, 'Bachelor Degree in Cyber Security', '1', 'Degree', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `appeals`
--
ALTER TABLE `appeals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_department_user` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `appeals`
--
ALTER TABLE `appeals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_department_user` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
