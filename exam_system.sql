-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 12:32 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cloquestions`
--

CREATE TABLE `cloquestions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clo_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cloquestions`
--

INSERT INTO `cloquestions` (`id`, `clo_id`, `question_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-01-23 18:39:22', '2023-01-23 18:39:22'),
(2, 2, 1, '2023-01-23 18:39:22', '2023-01-23 18:39:22'),
(3, 6, 2, '2023-01-23 18:41:48', '2023-01-23 18:41:48'),
(4, 7, 2, '2023-01-23 18:41:48', '2023-01-23 18:41:48'),
(7, 2, 5, '2023-01-23 19:27:25', '2023-01-23 19:27:25'),
(9, 1, 6, '2023-01-25 22:35:21', '2023-01-25 22:35:21'),
(10, 1, 7, '2023-01-25 22:35:44', '2023-01-25 22:35:44'),
(11, 1, 8, '2023-01-28 00:27:23', '2023-01-28 00:27:23'),
(12, 2, 8, '2023-01-28 00:27:23', '2023-01-28 00:27:23'),
(13, 1, 9, '2023-01-28 00:29:15', '2023-01-28 00:29:15'),
(14, 2, 9, '2023-01-28 00:29:15', '2023-01-28 00:29:15'),
(20, 5, 3, '2023-01-30 20:23:09', '2023-01-30 20:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `clos`
--

CREATE TABLE `clos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clo_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clos`
--

INSERT INTO `clos` (`id`, `clo_name`, `subject_id`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'One', 1, 1, '2023-01-23 18:05:11', '2023-01-23 18:05:11'),
(2, 'Two', 1, 1, '2023-01-23 18:05:11', '2023-01-23 18:05:11'),
(3, 'Three', 1, 1, '2023-01-23 18:05:11', '2023-01-23 18:05:11'),
(4, 'Five', 1, 1, '2023-01-23 18:05:11', '2023-01-23 18:05:11'),
(5, 'Four', 1, 1, '2023-01-23 18:05:11', '2023-01-23 18:05:11'),
(6, 'clo 1', 2, 1, '2023-01-23 18:05:47', '2023-01-23 18:05:47'),
(7, 'clo 2', 2, 1, '2023-01-23 18:05:47', '2023-01-23 18:05:47'),
(8, 'clo 3', 2, 1, '2023-01-23 18:05:47', '2023-01-23 18:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genration_type` int(11) NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `year` int(11) NOT NULL,
  `total_score` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `genration_type`, `subject_id`, `semester`, `code`, `duration`, `date`, `year`, `total_score`, `author_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 5, 1, 1, '2023-01-25 21:19:56', '2023-01-30 20:37:02'),
(2, 'test 12222', 1, 1, 'semester', 'code', '3 hours', '2023-01-02', 2023, NULL, 1, 0, '2023-01-25 22:16:47', '2023-01-26 22:14:56'),
(3, 'test 123', 1, 2, 'semester', 'code', '3 hours', '2023-01-02', 2023, NULL, 1, 0, '2023-01-25 22:17:16', '2023-01-26 23:18:18'),
(5, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-25 22:21:41', '2023-01-25 22:21:41'),
(6, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-25 22:26:13', '2023-01-25 22:26:13'),
(7, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-25 22:29:08', '2023-01-25 22:29:08'),
(8, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-25 22:29:42', '2023-01-25 22:29:42'),
(10, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-25 22:36:00', '2023-01-25 22:36:00'),
(11, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-25 22:38:16', '2023-01-25 22:38:16'),
(13, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:23:24', '2023-01-27 21:23:24'),
(14, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:25:14', '2023-01-27 21:25:14'),
(15, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:39:23', '2023-01-27 21:39:23'),
(16, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:47:18', '2023-01-27 21:47:18'),
(17, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:49:47', '2023-01-27 21:49:47'),
(18, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:51:05', '2023-01-27 21:51:05'),
(19, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:52:07', '2023-01-27 21:52:07'),
(20, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:54:54', '2023-01-27 21:54:54'),
(21, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:55:43', '2023-01-27 21:55:43'),
(22, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:56:23', '2023-01-27 21:56:23'),
(23, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:58:20', '2023-01-27 21:58:20'),
(24, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 21:59:29', '2023-01-27 21:59:29'),
(25, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 4, 2, 1, '2023-01-27 22:01:52', '2023-01-27 22:01:52'),
(26, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 5, 2, 1, '2023-01-27 22:02:05', '2023-01-27 22:02:06'),
(27, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 2, 1, '2023-01-27 22:07:44', '2023-01-27 22:07:44'),
(28, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 22:08:37', '2023-01-27 22:08:37'),
(29, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 2, 1, '2023-01-27 22:10:19', '2023-01-27 22:10:19'),
(30, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 2, 1, '2023-01-27 22:11:34', '2023-01-27 22:11:35'),
(31, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 22:20:44', '2023-01-27 22:20:44'),
(32, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 22:21:25', '2023-01-27 22:21:25'),
(33, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 22:22:39', '2023-01-27 22:22:39'),
(34, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 22:23:06', '2023-01-27 22:23:06'),
(35, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 2, 1, '2023-01-27 22:23:56', '2023-01-27 22:23:57'),
(36, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 2, 1, '2023-01-27 22:24:10', '2023-01-27 22:24:10'),
(37, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 2, 0, '2023-01-27 22:24:47', '2023-01-27 22:24:47'),
(38, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 2, 1, '2023-01-27 22:27:07', '2023-01-27 22:27:07'),
(39, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 2, 1, '2023-01-27 22:39:20', '2023-01-27 22:39:21'),
(40, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 13, 2, 1, '2023-01-27 22:40:19', '2023-01-27 22:40:19'),
(41, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-27 23:11:08', '2023-01-27 23:11:08'),
(42, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 12, 1, 1, '2023-01-27 23:11:15', '2023-01-27 23:11:16'),
(43, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 13, 1, 1, '2023-01-27 23:17:58', '2023-01-27 23:17:58'),
(44, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-27 23:20:12', '2023-01-27 23:20:12'),
(45, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 12, 1, 1, '2023-01-28 00:53:58', '2023-01-28 00:53:58'),
(46, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 11, 1, 1, '2023-01-28 00:55:05', '2023-01-28 00:55:05'),
(47, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 11, 1, 1, '2023-01-28 00:55:57', '2023-01-28 00:55:57'),
(48, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 10, 1, 1, '2023-01-28 00:56:29', '2023-01-28 00:56:29'),
(49, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-28 00:58:51', '2023-01-28 00:58:51'),
(50, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-28 00:59:46', '2023-01-28 00:59:46'),
(51, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-28 01:00:01', '2023-01-28 01:00:02'),
(52, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-28 01:03:03', '2023-01-28 01:03:03'),
(53, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-28 01:05:40', '2023-01-28 01:05:40'),
(54, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-28 01:06:21', '2023-01-28 01:06:21'),
(55, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-28 01:08:30', '2023-01-28 01:08:30'),
(56, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 2, 1, 1, '2023-01-28 01:09:11', '2023-01-28 01:09:11'),
(57, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-28 01:11:32', '2023-01-28 01:11:32'),
(58, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 4, 1, 1, '2023-01-28 01:13:28', '2023-01-28 01:13:28'),
(59, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 4, 1, 1, '2023-01-28 01:21:27', '2023-01-28 01:21:27'),
(60, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-29 20:44:59', '2023-01-29 20:44:59'),
(61, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-29 20:53:02', '2023-01-29 20:53:02'),
(62, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 4, 1, 1, '2023-01-29 20:56:31', '2023-01-29 20:56:31'),
(63, 'test 1', 1, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 4, 1, 1, '2023-01-29 20:57:01', '2023-01-29 20:57:02'),
(64, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-29 21:00:22', '2023-01-29 21:00:22'),
(65, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-29 21:02:44', '2023-01-29 21:02:45'),
(66, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-29 21:19:33', '2023-01-29 21:19:34'),
(67, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-29 21:20:49', '2023-01-29 21:20:49'),
(68, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-29 21:21:06', '2023-01-29 21:21:06'),
(69, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-29 21:21:24', '2023-01-29 21:21:24'),
(70, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 0, 1, 1, '2023-01-29 21:21:39', '2023-01-29 21:21:39'),
(71, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, NULL, 1, 0, '2023-01-29 21:24:29', '2023-01-29 21:24:29'),
(72, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 10, 1, 1, '2023-01-29 21:25:48', '2023-01-29 21:25:49'),
(73, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 10, 1, 1, '2023-01-29 21:27:46', '2023-01-29 21:27:46'),
(74, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 10, 1, 1, '2023-01-29 21:36:26', '2023-01-29 21:36:27'),
(75, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 10, 1, 1, '2023-01-30 19:15:33', '2023-01-30 19:15:33'),
(76, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 10, 1, 1, '2023-01-30 19:17:50', '2023-01-30 19:17:50'),
(77, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 12, 1, 1, '2023-01-30 19:20:46', '2023-01-30 19:20:47'),
(78, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 12, 1, 1, '2023-01-30 19:22:05', '2023-01-30 19:22:05'),
(79, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 8, 1, 1, '2023-01-30 19:22:59', '2023-01-30 19:23:00'),
(80, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 8, 1, 1, '2023-01-30 21:01:49', '2023-01-30 21:01:49'),
(81, 'test 1', 2, 1, 'sem', 'code', '2 hours', '2023-01-01', 2023, 20, 1, 1, '2023-01-30 21:12:49', '2023-01-30 21:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `exam_id`, `question_id`, `score`, `created_at`, `updated_at`) VALUES
(3, 7, 1, NULL, '2023-01-25 22:29:08', '2023-01-25 22:29:08'),
(4, 8, 5, NULL, '2023-01-25 22:29:42', '2023-01-25 22:29:42'),
(7, 10, 3, NULL, '2023-01-25 22:36:00', '2023-01-25 22:36:00'),
(8, 11, 1, NULL, '2023-01-25 22:38:16', '2023-01-25 22:38:16'),
(9, 11, 3, NULL, '2023-01-25 22:38:16', '2023-01-25 22:38:16'),
(10, 11, 6, NULL, '2023-01-25 22:38:16', '2023-01-25 22:38:16'),
(11, 11, 5, NULL, '2023-01-25 22:38:16', '2023-01-25 22:38:16'),
(22, 3, 1, NULL, '2023-01-26 23:18:18', '2023-01-26 23:18:18'),
(23, 3, 2, NULL, '2023-01-26 23:18:18', '2023-01-26 23:18:18'),
(24, 3, 3, NULL, '2023-01-26 23:18:18', '2023-01-26 23:18:18'),
(25, 15, 1, 2, '2023-01-27 21:39:23', '2023-01-27 21:39:23'),
(26, 15, 2, 2, '2023-01-27 21:39:23', '2023-01-27 21:39:23'),
(27, 16, 1, 2, '2023-01-27 21:47:18', '2023-01-27 21:47:18'),
(28, 16, 2, 2, '2023-01-27 21:47:18', '2023-01-27 21:47:18'),
(29, 17, 1, 2, '2023-01-27 21:49:47', '2023-01-27 21:49:47'),
(30, 17, 2, 2, '2023-01-27 21:49:47', '2023-01-27 21:49:47'),
(31, 18, 1, 2, '2023-01-27 21:51:05', '2023-01-27 21:51:05'),
(32, 18, 2, 2, '2023-01-27 21:51:05', '2023-01-27 21:51:05'),
(33, 19, 1, 2, '2023-01-27 21:52:07', '2023-01-27 21:52:07'),
(34, 19, 2, 2, '2023-01-27 21:52:07', '2023-01-27 21:52:07'),
(35, 20, 1, 2, '2023-01-27 21:54:54', '2023-01-27 21:54:54'),
(36, 20, 2, 2, '2023-01-27 21:54:54', '2023-01-27 21:54:54'),
(37, 21, 1, 2, '2023-01-27 21:55:43', '2023-01-27 21:55:43'),
(38, 21, 2, 2, '2023-01-27 21:55:43', '2023-01-27 21:55:43'),
(39, 22, 1, 2, '2023-01-27 21:56:23', '2023-01-27 21:56:23'),
(40, 22, 2, 2, '2023-01-27 21:56:23', '2023-01-27 21:56:23'),
(41, 23, 1, 2, '2023-01-27 21:58:20', '2023-01-27 21:58:20'),
(42, 23, 2, 2, '2023-01-27 21:58:20', '2023-01-27 21:58:20'),
(43, 24, 1, 2, '2023-01-27 21:59:29', '2023-01-27 21:59:29'),
(44, 24, 2, 2, '2023-01-27 21:59:29', '2023-01-27 21:59:29'),
(45, 25, 1, 2, '2023-01-27 22:01:52', '2023-01-27 22:01:52'),
(46, 25, 2, 2, '2023-01-27 22:01:52', '2023-01-27 22:01:52'),
(47, 26, 1, 2, '2023-01-27 22:02:06', '2023-01-27 22:02:06'),
(48, 26, 2, 3, '2023-01-27 22:02:06', '2023-01-27 22:02:06'),
(49, 27, 1, NULL, '2023-01-27 22:07:44', '2023-01-27 22:07:44'),
(50, 27, 5, NULL, '2023-01-27 22:07:44', '2023-01-27 22:07:44'),
(51, 28, 1, NULL, '2023-01-27 22:08:38', '2023-01-27 22:08:38'),
(52, 28, 3, NULL, '2023-01-27 22:08:38', '2023-01-27 22:08:38'),
(53, 28, 7, NULL, '2023-01-27 22:08:38', '2023-01-27 22:08:38'),
(54, 29, 1, NULL, '2023-01-27 22:10:19', '2023-01-27 22:10:19'),
(55, 29, 3, NULL, '2023-01-27 22:10:19', '2023-01-27 22:10:19'),
(56, 29, 1, NULL, '2023-01-27 22:10:19', '2023-01-27 22:10:19'),
(57, 29, 5, NULL, '2023-01-27 22:10:19', '2023-01-27 22:10:19'),
(58, 30, 1, NULL, '2023-01-27 22:11:34', '2023-01-27 22:11:34'),
(59, 30, 6, NULL, '2023-01-27 22:11:34', '2023-01-27 22:11:34'),
(60, 30, 1, NULL, '2023-01-27 22:11:34', '2023-01-27 22:11:34'),
(61, 30, 5, NULL, '2023-01-27 22:11:34', '2023-01-27 22:11:34'),
(62, 35, 1, NULL, '2023-01-27 22:23:56', '2023-01-27 22:23:56'),
(63, 35, 7, NULL, '2023-01-27 22:23:56', '2023-01-27 22:23:56'),
(64, 35, 6, NULL, '2023-01-27 22:23:56', '2023-01-27 22:23:56'),
(65, 35, 1, NULL, '2023-01-27 22:23:57', '2023-01-27 22:23:57'),
(66, 35, 5, NULL, '2023-01-27 22:23:57', '2023-01-27 22:23:57'),
(67, 36, 6, NULL, '2023-01-27 22:24:10', '2023-01-27 22:24:10'),
(68, 36, 7, NULL, '2023-01-27 22:24:10', '2023-01-27 22:24:10'),
(69, 36, 7, NULL, '2023-01-27 22:24:10', '2023-01-27 22:24:10'),
(70, 36, 1, NULL, '2023-01-27 22:24:10', '2023-01-27 22:24:10'),
(71, 36, 5, NULL, '2023-01-27 22:24:10', '2023-01-27 22:24:10'),
(72, 37, 3, NULL, '2023-01-27 22:24:48', '2023-01-27 22:24:48'),
(73, 37, 6, NULL, '2023-01-27 22:24:48', '2023-01-27 22:24:48'),
(74, 37, 7, NULL, '2023-01-27 22:24:48', '2023-01-27 22:24:48'),
(75, 37, 3, NULL, '2023-01-27 22:24:48', '2023-01-27 22:24:48'),
(76, 38, 1, NULL, '2023-01-27 22:27:07', '2023-01-27 22:27:07'),
(77, 38, 3, NULL, '2023-01-27 22:27:07', '2023-01-27 22:27:07'),
(78, 38, 7, NULL, '2023-01-27 22:27:07', '2023-01-27 22:27:07'),
(79, 38, 1, NULL, '2023-01-27 22:27:07', '2023-01-27 22:27:07'),
(80, 38, 5, NULL, '2023-01-27 22:27:07', '2023-01-27 22:27:07'),
(81, 39, 1, NULL, '2023-01-27 22:39:21', '2023-01-27 22:39:21'),
(82, 39, 6, NULL, '2023-01-27 22:39:21', '2023-01-27 22:39:21'),
(83, 39, 7, NULL, '2023-01-27 22:39:21', '2023-01-27 22:39:21'),
(84, 39, 1, NULL, '2023-01-27 22:39:21', '2023-01-27 22:39:21'),
(85, 39, 5, NULL, '2023-01-27 22:39:21', '2023-01-27 22:39:21'),
(86, 40, 1, NULL, '2023-01-27 22:40:19', '2023-01-27 22:40:19'),
(87, 40, 7, NULL, '2023-01-27 22:40:19', '2023-01-27 22:40:19'),
(88, 40, 6, NULL, '2023-01-27 22:40:19', '2023-01-27 22:40:19'),
(89, 40, 1, NULL, '2023-01-27 22:40:19', '2023-01-27 22:40:19'),
(90, 40, 5, NULL, '2023-01-27 22:40:19', '2023-01-27 22:40:19'),
(91, 42, 3, NULL, '2023-01-27 23:11:16', '2023-01-27 23:11:16'),
(92, 42, 6, NULL, '2023-01-27 23:11:16', '2023-01-27 23:11:16'),
(93, 42, 3, NULL, '2023-01-27 23:11:16', '2023-01-27 23:11:16'),
(94, 42, 1, NULL, '2023-01-27 23:11:16', '2023-01-27 23:11:16'),
(95, 42, 5, NULL, '2023-01-27 23:11:16', '2023-01-27 23:11:16'),
(96, 43, 1, 2, '2023-01-27 23:17:58', '2023-01-27 23:17:58'),
(97, 43, 7, 3, '2023-01-27 23:17:58', '2023-01-27 23:17:58'),
(98, 43, 7, 3, '2023-01-27 23:17:58', '2023-01-27 23:17:58'),
(99, 43, 1, 2, '2023-01-27 23:17:58', '2023-01-27 23:17:58'),
(100, 43, 5, 3, '2023-01-27 23:17:58', '2023-01-27 23:17:58'),
(101, 45, 3, 2, '2023-01-28 00:53:58', '2023-01-28 00:53:58'),
(102, 45, 7, 3, '2023-01-28 00:53:58', '2023-01-28 00:53:58'),
(103, 45, 8, 2, '2023-01-28 00:53:58', '2023-01-28 00:53:58'),
(104, 45, 5, 3, '2023-01-28 00:53:58', '2023-01-28 00:53:58'),
(105, 45, 9, 2, '2023-01-28 00:53:58', '2023-01-28 00:53:58'),
(106, 46, 1, 2, '2023-01-28 00:55:05', '2023-01-28 00:55:05'),
(107, 46, 6, 3, '2023-01-28 00:55:05', '2023-01-28 00:55:05'),
(108, 46, 1, 2, '2023-01-28 00:55:05', '2023-01-28 00:55:05'),
(109, 46, 1, 2, '2023-01-28 00:55:05', '2023-01-28 00:55:05'),
(110, 46, 8, 2, '2023-01-28 00:55:05', '2023-01-28 00:55:05'),
(111, 47, 1, 2, '2023-01-28 00:55:57', '2023-01-28 00:55:57'),
(112, 47, 7, 3, '2023-01-28 00:55:57', '2023-01-28 00:55:57'),
(113, 47, 8, 2, '2023-01-28 00:55:57', '2023-01-28 00:55:57'),
(114, 47, 8, 2, '2023-01-28 00:55:57', '2023-01-28 00:55:57'),
(115, 47, 9, 2, '2023-01-28 00:55:57', '2023-01-28 00:55:57'),
(116, 48, 1, 2, '2023-01-28 00:56:29', '2023-01-28 00:56:29'),
(117, 48, 8, 2, '2023-01-28 00:56:29', '2023-01-28 00:56:29'),
(118, 48, 9, 2, '2023-01-28 00:56:29', '2023-01-28 00:56:29'),
(119, 48, 8, 2, '2023-01-28 00:56:29', '2023-01-28 00:56:29'),
(120, 48, 9, 2, '2023-01-28 00:56:29', '2023-01-28 00:56:29'),
(121, 50, 1, NULL, '2023-01-28 00:59:46', '2023-01-28 00:59:46'),
(122, 50, 3, NULL, '2023-01-28 00:59:46', '2023-01-28 00:59:46'),
(123, 50, 7, NULL, '2023-01-28 00:59:46', '2023-01-28 00:59:46'),
(124, 50, 8, NULL, '2023-01-28 00:59:46', '2023-01-28 00:59:46'),
(125, 50, 9, NULL, '2023-01-28 00:59:46', '2023-01-28 00:59:46'),
(126, 50, 6, NULL, '2023-01-28 00:59:47', '2023-01-28 00:59:47'),
(127, 51, 1, NULL, '2023-01-28 01:00:01', '2023-01-28 01:00:01'),
(128, 51, 3, NULL, '2023-01-28 01:00:01', '2023-01-28 01:00:01'),
(129, 51, 8, NULL, '2023-01-28 01:00:01', '2023-01-28 01:00:01'),
(130, 51, 9, NULL, '2023-01-28 01:00:02', '2023-01-28 01:00:02'),
(131, 51, 9, NULL, '2023-01-28 01:00:02', '2023-01-28 01:00:02'),
(132, 51, 1, NULL, '2023-01-28 01:00:02', '2023-01-28 01:00:02'),
(133, 51, 5, NULL, '2023-01-28 01:00:02', '2023-01-28 01:00:02'),
(134, 51, 8, NULL, '2023-01-28 01:00:02', '2023-01-28 01:00:02'),
(135, 51, 9, NULL, '2023-01-28 01:00:02', '2023-01-28 01:00:02'),
(136, 56, 1, 2, '2023-01-28 01:09:11', '2023-01-28 01:09:11'),
(137, 58, 1, 2, '2023-01-28 01:13:28', '2023-01-28 01:13:28'),
(138, 58, 2, 2, '2023-01-28 01:13:28', '2023-01-28 01:13:28'),
(139, 59, 1, 2, '2023-01-28 01:21:27', '2023-01-28 01:21:27'),
(140, 59, 2, 2, '2023-01-28 01:21:27', '2023-01-28 01:21:27'),
(141, 62, 1, 2, '2023-01-29 20:56:31', '2023-01-29 20:56:31'),
(142, 62, 2, 2, '2023-01-29 20:56:31', '2023-01-29 20:56:31'),
(143, 63, 1, 2, '2023-01-29 20:57:01', '2023-01-29 20:57:01'),
(144, 63, 2, 2, '2023-01-29 20:57:02', '2023-01-29 20:57:02'),
(145, 72, 3, 2, '2023-01-29 21:25:48', '2023-01-29 21:25:48'),
(146, 72, 6, 2, '2023-01-29 21:25:48', '2023-01-29 21:25:48'),
(147, 72, 8, 2, '2023-01-29 21:25:48', '2023-01-29 21:25:48'),
(148, 72, 1, 2, '2023-01-29 21:25:49', '2023-01-29 21:25:49'),
(149, 72, 8, 2, '2023-01-29 21:25:49', '2023-01-29 21:25:49'),
(150, 73, 6, 2, '2023-01-29 21:27:46', '2023-01-29 21:27:46'),
(151, 73, 9, 2, '2023-01-29 21:27:46', '2023-01-29 21:27:46'),
(152, 73, 7, 2, '2023-01-29 21:27:46', '2023-01-29 21:27:46'),
(153, 73, 1, 2, '2023-01-29 21:27:46', '2023-01-29 21:27:46'),
(154, 73, 8, 2, '2023-01-29 21:27:46', '2023-01-29 21:27:46'),
(155, 74, 3, 2, '2023-01-29 21:36:26', '2023-01-29 21:36:26'),
(156, 74, 7, 2, '2023-01-29 21:36:26', '2023-01-29 21:36:26'),
(157, 74, 7, 2, '2023-01-29 21:36:26', '2023-01-29 21:36:26'),
(158, 74, 1, 2, '2023-01-29 21:36:26', '2023-01-29 21:36:26'),
(159, 74, 8, 2, '2023-01-29 21:36:26', '2023-01-29 21:36:26'),
(160, 75, 1, 2, '2023-01-30 19:15:33', '2023-01-30 19:15:33'),
(161, 75, 9, 2, '2023-01-30 19:15:33', '2023-01-30 19:15:33'),
(162, 75, 6, 2, '2023-01-30 19:15:33', '2023-01-30 19:15:33'),
(163, 75, 1, 2, '2023-01-30 19:15:33', '2023-01-30 19:15:33'),
(164, 75, 8, 2, '2023-01-30 19:15:33', '2023-01-30 19:15:33'),
(165, 76, 6, 2, '2023-01-30 19:17:50', '2023-01-30 19:17:50'),
(166, 76, 7, 2, '2023-01-30 19:17:50', '2023-01-30 19:17:50'),
(167, 76, 7, 2, '2023-01-30 19:17:50', '2023-01-30 19:17:50'),
(168, 76, 5, 2, '2023-01-30 19:17:50', '2023-01-30 19:17:50'),
(169, 76, 9, 2, '2023-01-30 19:17:50', '2023-01-30 19:17:50'),
(170, 77, 6, 2, '2023-01-30 19:20:46', '2023-01-30 19:20:46'),
(171, 77, 9, 2, '2023-01-30 19:20:46', '2023-01-30 19:20:46'),
(172, 77, 6, 2, '2023-01-30 19:20:47', '2023-01-30 19:20:47'),
(173, 77, 8, 2, '2023-01-30 19:20:47', '2023-01-30 19:20:47'),
(174, 77, 1, 2, '2023-01-30 19:20:47', '2023-01-30 19:20:47'),
(175, 77, 8, 2, '2023-01-30 19:20:47', '2023-01-30 19:20:47'),
(176, 78, 1, 2, '2023-01-30 19:22:05', '2023-01-30 19:22:05'),
(177, 78, 8, 2, '2023-01-30 19:22:05', '2023-01-30 19:22:05'),
(178, 78, 8, 2, '2023-01-30 19:22:05', '2023-01-30 19:22:05'),
(179, 78, 9, 2, '2023-01-30 19:22:05', '2023-01-30 19:22:05'),
(180, 78, 8, 2, '2023-01-30 19:22:05', '2023-01-30 19:22:05'),
(181, 78, 9, 2, '2023-01-30 19:22:05', '2023-01-30 19:22:05'),
(182, 79, 1, 2, '2023-01-30 19:22:59', '2023-01-30 19:22:59'),
(183, 79, 9, 2, '2023-01-30 19:23:00', '2023-01-30 19:23:00'),
(184, 79, 5, 2, '2023-01-30 19:23:00', '2023-01-30 19:23:00'),
(185, 79, 8, 2, '2023-01-30 19:23:00', '2023-01-30 19:23:00'),
(192, 1, 1, 3, '2023-01-30 20:37:02', '2023-01-30 20:37:02'),
(193, 1, 2, 2, '2023-01-30 20:37:02', '2023-01-30 20:37:02'),
(194, 80, 1, 2, '2023-01-30 21:01:49', '2023-01-30 21:01:49'),
(195, 80, 6, 2, '2023-01-30 21:01:49', '2023-01-30 21:01:49'),
(196, 80, 1, 2, '2023-01-30 21:01:49', '2023-01-30 21:01:49'),
(197, 80, 8, 2, '2023-01-30 21:01:49', '2023-01-30 21:01:49'),
(198, 81, 1, 2, '2023-01-30 21:12:49', '2023-01-30 21:12:49'),
(199, 81, 6, 2, '2023-01-30 21:12:49', '2023-01-30 21:12:49'),
(200, 81, 7, 2, '2023-01-30 21:12:49', '2023-01-30 21:12:49'),
(201, 81, 8, 2, '2023-01-30 21:12:49', '2023-01-30 21:12:49'),
(202, 81, 9, 2, '2023-01-30 21:12:49', '2023-01-30 21:12:49'),
(203, 81, 1, 2, '2023-01-30 21:12:49', '2023-01-30 21:12:49'),
(204, 81, 5, 2, '2023-01-30 21:12:49', '2023-01-30 21:12:49'),
(205, 81, 8, 2, '2023-01-30 21:12:49', '2023-01-30 21:12:49'),
(206, 81, 9, 2, '2023-01-30 21:12:49', '2023-01-30 21:12:49'),
(207, 81, 5, 2, '2023-01-30 21:12:49', '2023-01-30 21:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mcqanswers`
--

CREATE TABLE `mcqanswers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcqanswers`
--

INSERT INTO `mcqanswers` (`id`, `question_id`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'OTP 1', 0, '2023-01-23 18:39:22', '2023-01-23 18:39:22'),
(2, 1, 'OTP 2', 1, '2023-01-23 18:39:22', '2023-01-23 18:39:22'),
(3, 1, 'OTP 3', 0, '2023-01-23 18:39:22', '2023-01-23 18:39:22'),
(6, 8, 'test', 0, '2023-01-28 00:27:23', '2023-01-28 00:27:23'),
(7, 8, 'test2', 1, '2023-01-28 00:27:23', '2023-01-28 00:27:23'),
(8, 9, 'test', 0, '2023-01-28 00:29:15', '2023-01-28 00:29:15'),
(9, 9, 'test2', 1, '2023-01-28 00:29:15', '2023-01-28 00:29:15'),
(10, 3, 'test', 0, '2023-01-30 20:23:09', '2023-01-30 20:23:09'),
(11, 3, 'test2', 1, '2023-01-30 20:23:09', '2023-01-30 20:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_22_171349_create_subjects_table', 1),
(6, '2023_01_06_183514_create_clos_table', 1),
(7, '2023_01_06_184858_create_subjectsassigns_table', 1),
(8, '2023_01_07_183716_create_questions_table', 1),
(9, '2023_01_07_194524_create_mcqanswers_table', 1),
(10, '2023_01_07_194747_create_textanswers_table', 1),
(11, '2023_01_07_200903_create_cloquestions_table', 1),
(12, '2023_01_25_200212_create_exams_table', 2),
(13, '2023_01_25_201921_create_exam_questions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\User', 1, 'myappToken', '41c835545b6c0accb16f5f8adbfb5ae366bdc6710990a9c3bc258bef31fd6855', '[\"*\"]', '2023-01-27 19:48:45', NULL, '2023-01-27 10:10:03', '2023-01-27 19:48:45'),
(4, 'App\\Models\\User', 1, 'myappToken', '6af71a94a5507a21217b5e6bde38354297e98559596261f453587539dbdf0917', '[\"*\"]', '2023-11-21 20:02:31', NULL, '2023-01-27 21:20:11', '2023-11-21 20:02:31'),
(5, 'App\\Models\\User', 1, 'myappToken', '570af58dc89dec93ce6f3a1ce0b499357aec56f2bb12ae335d63ea69ecb5e3e7', '[\"*\"]', '2023-11-21 20:06:58', NULL, '2023-11-21 20:01:03', '2023-11-21 20:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `level` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `answer_type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `body`, `subject_id`, `level`, `author_id`, `answer_type`, `created_at`, `updated_at`) VALUES
(1, '<p>Question One </p>', 1, 1, 1, 1, '2023-01-23 18:39:22', '2023-01-23 18:39:22'),
(2, '<p>Question Two User Case</p>', 2, 2, 1, 0, '2023-01-23 18:41:47', '2023-01-23 18:41:47'),
(3, 'test 10', 1, 1, 1, 1, '2023-01-23 18:51:40', '2023-01-30 19:32:00'),
(5, '<p>test question final </p>', 1, 0, 1, 0, '2023-01-23 19:27:25', '2023-01-23 19:27:25'),
(6, '<p>tttttttttttttttttttttttttttt</p>', 1, 0, 1, 0, '2023-01-25 22:35:21', '2023-01-25 22:35:21'),
(7, '<p>gffffffffffff</p>', 1, 0, 1, 0, '2023-01-25 22:35:44', '2023-01-25 22:35:44'),
(8, 'test 6', 1, 1, 1, 1, '2023-01-28 00:27:23', '2023-01-28 00:27:23'),
(9, 'test 7', 1, 1, 1, 1, '2023-01-28 00:29:15', '2023-01-28 00:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'Subject 1', '1', '2023-01-23 18:03:30', '2023-01-23 18:03:30'),
(2, 'Subject 2', '1', '2023-01-23 18:03:36', '2023-01-23 18:03:36'),
(3, 'Subject 3', '1', '2023-01-23 18:03:42', '2023-01-23 18:03:42'),
(4, 'Subject 4', '1', '2023-01-23 18:03:47', '2023-01-23 18:03:47'),
(5, 'Subject 5', '1', '2023-01-23 18:03:54', '2023-01-23 18:03:54'),
(6, 'Subject Final', '1', '2023-01-23 18:04:02', '2023-01-23 18:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `subjectsassigns`
--

CREATE TABLE `subjectsassigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `author_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjectsassigns`
--

INSERT INTO `subjectsassigns` (`id`, `subject_id`, `teacher_id`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '1', '2023-01-23 19:06:25', '2023-01-23 19:06:25'),
(2, 2, 4, '1', '2023-01-23 19:06:25', '2023-01-23 19:06:25'),
(3, 3, 4, '1', '2023-01-23 19:14:15', '2023-01-23 19:14:15'),
(4, 4, 4, '1', '2023-01-23 19:14:22', '2023-01-23 19:14:22'),
(5, 1, 3, '1', '2023-01-23 19:26:01', '2023-01-23 19:26:01'),
(6, 3, 3, '1', '2023-01-23 19:26:01', '2023-01-23 19:26:01'),
(7, 1, 2, '1', '2023-01-30 20:41:01', '2023-01-30 20:41:01'),
(8, 2, 2, '1', '2023-01-30 20:41:01', '2023-01-30 20:41:01'),
(9, 3, 2, '1', '2023-01-30 20:41:39', '2023-01-30 20:41:39'),
(10, 4, 2, '1', '2023-01-30 20:42:28', '2023-01-30 20:42:28'),
(11, 4, 3, '1', '2023-01-30 20:42:28', '2023-01-30 20:42:28'),
(12, 6, 2, '1', '2023-01-30 20:46:47', '2023-01-30 20:46:47');

-- --------------------------------------------------------

--
-- Table structure for table `textanswers`
--

CREATE TABLE `textanswers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `textanswers`
--

INSERT INTO `textanswers` (`id`, `question_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 2, '<p>Test answer Finallllllllllllllllllllllllllllllllllllllllllllllllllllll</p>', '2023-01-23 18:41:48', '2023-01-23 18:41:48'),
(3, 5, '<p>anser of test question final</p>', '2023-01-23 19:27:25', '2023-01-23 19:27:25'),
(4, 6, '<p>dddddddddddddddddddd</p>', '2023-01-25 22:35:21', '2023-01-25 22:35:21'),
(5, 7, '<p>dkkdkdkdkdkdk</p>', '2023-01-25 22:35:44', '2023-01-25 22:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `email_verified_at`, `password`, `role`, `status`, `author_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin name', 'admin@example.com', NULL, '$2y$10$N86v3EYkTTr6UFtbUKlh0.tIEYH5AGHCRPiRc7EZYgWzCtayzEBbG', 'super admin', 'active', NULL, NULL, '2023-01-23 17:55:06', '2023-01-23 17:55:06'),
(2, 'Admin Onw', 'adminone@example.com', NULL, '$2y$10$M1JkbqPpWL4WIklZhPjIZeObtTX5XqzhcElaCacHctMcvqz7S4Lny', 'admin', 'active', '1', NULL, '2023-01-23 19:04:28', '2023-01-30 20:41:01'),
(3, 'Teacher Two', 'teachertwo@demo.com', NULL, '$2y$10$K8VQEUUgCNdntSqQPVVB4ePL1UWFEZW0MMrnKTjpl0czqnjIxa0ve', 'teacher', 'active', '1', NULL, '2023-01-23 19:05:35', '2023-01-23 19:26:01'),
(4, 'Teacher One', 'teacherone@gmail.com', NULL, '$2y$10$Pzb.p8KocYBLE9lPtFWcCuOeHAdn14cTvxkJCrdr8s5ADNARiLTgK', 'teacher', 'deactivated', '1', NULL, '2023-01-23 19:06:12', '2023-01-23 21:45:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cloquestions`
--
ALTER TABLE `cloquestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cloquestions_clo_id_foreign` (`clo_id`),
  ADD KEY `cloquestions_question_id_foreign` (`question_id`);

--
-- Indexes for table `clos`
--
ALTER TABLE `clos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clos_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_questions_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_questions_question_id_foreign` (`question_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `mcqanswers`
--
ALTER TABLE `mcqanswers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mcqanswers_question_id_foreign` (`question_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjectsassigns`
--
ALTER TABLE `subjectsassigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjectsassigns_subject_id_foreign` (`subject_id`),
  ADD KEY `subjectsassigns_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `textanswers`
--
ALTER TABLE `textanswers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `textanswers_question_id_foreign` (`question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cloquestions`
--
ALTER TABLE `cloquestions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clos`
--
ALTER TABLE `clos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mcqanswers`
--
ALTER TABLE `mcqanswers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjectsassigns`
--
ALTER TABLE `subjectsassigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `textanswers`
--
ALTER TABLE `textanswers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cloquestions`
--
ALTER TABLE `cloquestions`
  ADD CONSTRAINT `cloquestions_clo_id_foreign` FOREIGN KEY (`clo_id`) REFERENCES `clos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cloquestions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clos`
--
ALTER TABLE `clos`
  ADD CONSTRAINT `clos_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mcqanswers`
--
ALTER TABLE `mcqanswers`
  ADD CONSTRAINT `mcqanswers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjectsassigns`
--
ALTER TABLE `subjectsassigns`
  ADD CONSTRAINT `subjectsassigns_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subjectsassigns_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `textanswers`
--
ALTER TABLE `textanswers`
  ADD CONSTRAINT `textanswers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
