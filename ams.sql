-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2025 at 12:24 AM
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
(19, 1, 'Accessed Manage Users page', 'Admin \'Admin\' (ID: 1) accessed the Manage Users page', '2025-06-06 01:16:01');

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
(1, 'Admin', 'hussein@gmail.com', 'INFORMATION TECHNOLOGY', '0658216348', 'Male', '$2y$10$7d51wUjTP85kV3RoBAqAQ.wwDjgqqkCsBmQuibLEm6lTxdFwLLHj2', 'admin', '2025-06-05 15:00:30', '1_1749152008.png', NULL, NULL, NULL, NULL, 1),
(2, 'muda', 'muda@gmail.com', '', '', 'Male', '$2y$10$IEqDP/0rN8lluvXLq9oCDe4aPWeNrWsEY7FpkP33ydcCJ2/hP0R.W', 'user', '2025-06-05 20:09:46', '1749154186_1748461004_IMG-20250528-WA0049.jpg', NULL, 'cyber security', '3', 'Degree', 1),
(3, 'sylvia', 'sylvia@gmail.com', '', '', 'Male', '$2y$10$.lixucvJBbYkG9Oh.rSR9.KXQjXnv3A5CQ/4JzhIB4PJ0LcHvoERy', 'user', '2025-06-05 20:59:54', '1749157809_1748461281_IMG-20250528-WA0048.jpg', NULL, 'Bachelor Degree in Information Technology', '2', 'Diploma', 1),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
