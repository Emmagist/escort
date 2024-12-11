-- phpMyAdmin SQL Dump
-- version 5.2.1deb1ubuntu0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 06, 2024 at 08:32 PM
-- Server version: 10.11.2-MariaDB-1
-- PHP Version: 8.1.12-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escort`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `token_guid` varchar(50) NOT NULL,
  `category` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `web_address` varchar(250) NOT NULL,
  `icon` varchar(250) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `token_guid`, `category`, `slug`, `web_address`, `icon`, `created_at`, `updated_at`) VALUES
(1, '67543388$re386yf32198765430op87697', 'Travel Companion', 'travel-companion', 'travel-companion.php', 'ti ti-article', '2024-08-27 12:24:51', '2024-09-07 22:17:22'),
(2, '5675-56798-0987-5432-65489-4321-8997', 'girl company', 'girl-company', 'girl-company.php', 'ti ti-alert-circle\"', '2024-09-07 22:15:37', '2024-09-07 22:18:49'),
(3, '5675-56798-0987-5432-65489-4321-8990', 'part invitation', 'party-invitation', 'party-invitation.php', 'ti ti-cards', '2024-09-07 22:15:37', '2024-09-07 22:19:16'),
(4, '5675-56798-0987-5432-65489-4321-8987', 'dinner date', 'dinner-date', 'dinner-date.php', 'ti ti-file-description', '2024-09-07 22:15:37', '2024-09-07 22:19:40'),
(5, '5675-56798-0987-5432-65489-4321-8993', 'relaxing incall', 'relaxing-incall', 'relaxing-incall.php', 'ti ti-typography', '2024-09-07 22:15:37', '2024-09-07 22:20:08'),
(6, '5675-56798-0987-5432-65489-4321-8975', 'outcall hotel visits', 'outcall-hotel-visits', 'outcall-hotel-visits.php', 'ti ti-file', '2024-09-07 22:15:37', '2024-09-07 22:23:35'),
(7, '5675-56798-0987-5432-65489-4321-8981', 'home visits', 'home-visits', 'home-visits.php', 'ti ti-home', '2024-09-07 22:15:37', '2024-09-07 22:24:18'),
(8, '5675-56798-0987-5432-65489-4321-8933', 'dance partner', 'dance-partner', 'dance-partner.php', 'ti ti-users', '2024-09-07 22:15:37', '2024-09-07 22:27:57'),
(9, '5675-56798-0987-5432-65489-4321-8978', 'fuck mate', 'fuck-mate', 'fuck-mate.php', 'ti ti-user', '2024-09-07 22:15:37', '2024-09-07 22:28:02'),
(11, '5875-56798-0987-5432-65489-4321-8936', 'Stripper', 'stripper', 'stripper.php', 'ti ti-napster', '2024-09-21 01:04:36', '2024-09-21 01:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `escorts`
--

CREATE TABLE `escorts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `entity_guid` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `period_prices` enum('hour','day','week') NOT NULL DEFAULT 'hour',
  `prices` float NOT NULL,
  `currency` enum('ngn','usd','gbp','euro') NOT NULL DEFAULT 'ngn',
  `username` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL DEFAULT 'female',
  `comments` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ethnicity` varchar(50) NOT NULL,
  `hair_long` varchar(50) NOT NULL,
  `hair_color` varchar(50) NOT NULL,
  `bust_size` enum('l','xl','xxl','xxxl') NOT NULL DEFAULT 'l',
  `smoker` enum('yes','no') NOT NULL DEFAULT 'yes',
  `alcohol` enum('yes','no') NOT NULL DEFAULT 'no',
  `build` varchar(50) NOT NULL,
  `sexual_orientation` varchar(50) NOT NULL,
  `profile_image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `escorts`
--

INSERT INTO `escorts` (`id`, `user_id`, `category_id`, `entity_guid`, `age`, `height`, `weight`, `period_prices`, `prices`, `currency`, `username`, `gender`, `comments`, `created_at`, `updated_at`, `ethnicity`, `hair_long`, `hair_color`, `bust_size`, `smoker`, `alcohol`, `build`, `sexual_orientation`, `profile_image`) VALUES
(1, '67543388$re386yf32198765430op876y$', '67543388$re386yf32198765430op87697', '67543388$re386yf32198765430op876y$', 23, 170, 50, 'hour', 10000, 'ngn', 'marybabe', 'female', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.', '2024-08-31 04:05:15', '2024-09-11 08:05:14', 'black', 'long', 'black', 'l', 'yes', 'no', 'curve', 'bisexual', '');

-- --------------------------------------------------------

--
-- Table structure for table `payments_log`
--

CREATE TABLE `payments_log` (
  `id` int(11) NOT NULL,
  `escortee_id` varchar(50) NOT NULL,
  `escorte_id` varchar(50) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `invoice_code` varchar(12) NOT NULL,
  `paystack_invoice` varchar(12) DEFAULT NULL,
  `amount` float NOT NULL,
  `payment_channel` varchar(20) NOT NULL,
  `conditions` enum('processing','cancelled','successful') NOT NULL DEFAULT 'processing',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments_log`
--

INSERT INTO `payments_log` (`id`, `escortee_id`, `escorte_id`, `category_id`, `invoice_code`, `paystack_invoice`, `amount`, `payment_channel`, `conditions`, `created_at`, `updated_at`) VALUES
(1, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '1', 'sanm799653', 'Inv269977776', 1500, 'Paystack', 'successful', '2022-10-28 06:14:09', '2022-10-28 10:15:41'),
(2, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '1', 'sanm085695', '', 2000, 'Paystack', 'processing', '2022-10-28 14:24:48', '2022-10-28 18:24:48'),
(3, '5db413652766addc06ad97b96e31753361e0462d4c253daee4', '', '3', 'sanm396969', '', 2000, 'Paystack', 'processing', '2022-10-29 03:37:18', '2022-10-29 07:37:18'),
(4, '5db413652766addc06ad97b96e31753361e0462d4c253daee4', '', '1', 'sanm221159', '', 2000, 'Paystack', 'processing', '2022-10-29 03:38:17', '2022-10-29 07:38:17'),
(5, 'd6e3f0aadec82d76a1151097dfd35357d263eebe6ac41f9c28', '', '1', 'sanm051853', '', 500, 'Paystack', 'processing', '2022-10-29 04:49:02', '2022-10-29 08:49:02'),
(7, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '1', 'sanm059668', '', 1500, 'Paystack', 'processing', '2022-10-29 09:05:55', '2022-10-29 13:05:55'),
(8, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '1', 'sanm589905', '', 1500, 'Paystack', 'processing', '2022-10-29 09:07:41', '2022-10-29 13:07:41'),
(9, '44d5d5d3ec98a43f1acbfb4fe35733033f39635e0713c12d23', '', '5', 'sanm320112', '', 0, 'Paystack', 'processing', '2022-10-29 10:31:13', '2022-10-29 14:31:13'),
(10, '1b3d0a0fef9f9c0d83462858af1347a6133940ac0400ae4e58', '', '1', 'sanm588571', '', 0, 'Paystack', 'processing', '2022-10-29 12:57:30', '2022-10-29 16:57:30'),
(12, 'b6ef34880576c7d463298c16ea3124dd635f97b9b36cbbc51c', '', '5', 'sanm410815', '', 1500, 'Paystack', 'processing', '2022-10-30 03:44:58', '2022-10-30 07:44:58'),
(13, 'b6ef34880576c7d463298c16ea3124dd635f97b9b36cbbc51c', '', '2', 'sanm237640', '', 1500, 'Paystack', 'processing', '2022-10-30 03:45:25', '2022-10-30 07:45:25'),
(14, 'b6ef34880576c7d463298c16ea3124dd635f97b9b36cbbc51c', '', '1', 'sanm606235', 'Inv177456871', 1500, 'Paystack', 'successful', '2022-10-30 03:45:45', '2022-10-30 07:47:35'),
(15, '21f7784bfda489e992f4ad32d1c0e8f875efca008aecf172d3', '', '1', 'sanm148859', '', 1500, 'Paystack', 'processing', '2022-10-30 03:46:09', '2022-10-30 07:46:09'),
(16, '21c71bba2276bddd94661ce566c28426fe33ba252a432d31a3', '', '1', 'sanm769069', '', 1500, 'Paystack', 'processing', '2022-10-31 03:11:47', '2022-10-31 07:11:47'),
(17, '4f7b2d6c2bad1a0a813b40da7cc12fc76d9c37f9a894e49a79', '', '2', 'sanm098051', '', 0, 'Paystack', 'processing', '2022-10-31 03:24:46', '2022-10-31 07:24:46'),
(18, '4f7b2d6c2bad1a0a813b40da7cc12fc76d9c37f9a894e49a79', '', '1', 'sanm280792', '', 5000, 'Paystack', 'processing', '2022-10-31 03:25:52', '2022-10-31 07:25:52'),
(19, '5a8a561a3050bd7272d27933b91a924403c1b3876491b4e229', '', '1', 'sanm691458', '', 0, 'Paystack', 'processing', '2022-10-31 05:18:54', '2022-10-31 09:18:54'),
(20, 'd95b7ca158872fe291a6717e0ea62f5859ede7a94329a0308f', '', '1', 'sanm753299', '', 0, 'Paystack', 'processing', '2022-10-31 09:36:31', '2022-10-31 13:36:31'),
(21, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm753924', '', 20000, 'Paystack', 'processing', '2022-10-31 10:50:39', '2022-10-31 14:50:39'),
(22, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm062165', '', 20000, 'Paystack', 'processing', '2022-10-31 10:55:22', '2022-10-31 14:55:22'),
(23, '0d406e78037f92389e7b3c3fe16bea0c3a47b169d88717846d', '', '1', 'sanm837903', '', 2000, 'Paystack', 'successful', '2022-10-31 21:01:07', '2022-11-01 08:39:47'),
(24, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '1', 'sanm147470', '', 1000, 'Paystack', 'processing', '2022-11-01 17:16:01', '2022-11-01 21:16:01'),
(25, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '3', 'sanm741297', '', 5000, 'Paystack', 'processing', '2022-11-01 17:20:44', '2022-11-01 21:20:44'),
(27, '1b3d0a0fef9f9c0d83462858af1347a6133940ac0400ae4e58', '', '2', 'sanm633232', '', 2500, 'Paystack', 'processing', '2022-11-01 18:08:59', '2022-11-01 22:08:59'),
(29, '1b3d0a0fef9f9c0d83462858af1347a6133940ac0400ae4e58', '', '3', 'sanm177951', '', 10000, 'Paystack', 'processing', '2022-11-01 18:28:20', '2022-11-01 22:28:20'),
(30, '1b3d0a0fef9f9c0d83462858af1347a6133940ac0400ae4e58', '', '1', 'sanm608844', '', 1500, 'Paystack', 'processing', '2022-11-01 18:28:40', '2022-11-01 22:28:40'),
(31, '1b3d0a0fef9f9c0d83462858af1347a6133940ac0400ae4e58', '', '1', 'sanm395346', '', 2500, 'Paystack', 'processing', '2022-11-01 18:29:08', '2022-11-01 22:29:08'),
(32, '3e60b4caca3db689593feb25a9bcfdb2c9d6761df8bae5150e', '', '1', 'sanm327828', '', 1500, 'Paystack', 'processing', '2022-11-02 03:47:46', '2022-11-02 07:47:46'),
(33, '3e60b4caca3db689593feb25a9bcfdb2c9d6761df8bae5150e', '', '1', 'sanm151806', 'Inv347297296', 1500, 'Paystack', 'successful', '2022-11-02 03:48:31', '2022-11-02 07:52:30'),
(34, '51bdc1b4cf9227d62bcf0302767f6ce8f9b4156a144afe7347', '', '4', 'sanm456401', '', 1500, 'Paystack', 'processing', '2022-11-04 05:31:27', '2022-11-04 09:31:27'),
(35, 'ee6123725577dd0e3c416828ef144610962a306184e856c3a4', '', '1', 'sanm425132', 'Inv778814925', 2000, 'Paystack', 'successful', '2022-11-04 05:42:19', '2022-11-04 09:45:39'),
(36, '51bdc1b4cf9227d62bcf0302767f6ce8f9b4156a144afe7347', '', '1', 'sanm460933', '', 1500, 'Paystack', 'processing', '2022-11-04 06:02:15', '2022-11-04 10:02:15'),
(37, '51bdc1b4cf9227d62bcf0302767f6ce8f9b4156a144afe7347', '', '1', 'sanm793214', 'Inv101781935', 1500, 'Paystack', 'successful', '2022-11-04 06:10:30', '2022-11-04 10:13:29'),
(38, '51bdc1b4cf9227d62bcf0302767f6ce8f9b4156a144afe7347', '', '2', 'sanm850725', '', 1500, 'Paystack', 'processing', '2022-11-04 06:18:54', '2022-11-04 10:18:54'),
(39, '51bdc1b4cf9227d62bcf0302767f6ce8f9b4156a144afe7347', '', '1', 'sanm147304', '', 1500, 'Paystack', 'processing', '2022-11-04 06:25:57', '2022-11-04 10:25:57'),
(40, 'fde232910eafcefc267d5ce56ab2b445e083da844a47c47bc1', '', '1', 'sanm124712', '', 1500, 'Paystack', 'processing', '2022-11-04 08:11:57', '2022-11-04 12:11:57'),
(41, '4f7b2d6c2bad1a0a813b40da7cc12fc76d9c37f9a894e49a79', '', '1', 'sanm827893', '', 5000, 'Paystack', 'processing', '2022-11-04 14:57:53', '2022-11-04 18:57:53'),
(42, '4f7b2d6c2bad1a0a813b40da7cc12fc76d9c37f9a894e49a79', '', '1', 'sanm243576', '', 5000, 'Paystack', 'processing', '2022-11-04 14:58:40', '2022-11-04 18:58:40'),
(43, '512202135dec69c47b46bb821ed562ca67abb991b4335ef353', '', '1', 'sanm328035', 'Inv957649470', 1500, 'Paystack', 'successful', '2022-11-07 15:20:45', '2022-11-07 20:21:46'),
(44, '82fd94c0102a6ab57d8298931ed2fff9f050ed175295915045', '', '3', 'sanm857819', 'Inv318284766', 25000, 'Paystack', 'successful', '2022-11-09 01:56:20', '2022-11-09 07:00:42'),
(45, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '1', 'sanm829502', '', 1500, 'Paystack', 'processing', '2022-11-09 03:15:11', '2022-11-09 08:15:11'),
(46, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '1', 'sanm314982', '', 1500, 'Paystack', 'processing', '2022-11-09 03:16:41', '2022-11-09 08:16:41'),
(47, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '1', 'sanm898528', '', 1500, 'Paystack', 'processing', '2022-11-09 03:20:19', '2022-11-09 08:20:19'),
(48, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '1', 'sanm683258', '', 1500, 'Paystack', 'processing', '2022-11-09 03:21:15', '2022-11-09 08:21:15'),
(49, '3e60b4caca3db689593feb25a9bcfdb2c9d6761df8bae5150e', '', '4', 'sanm227733', '', 1500, 'Paystack', 'processing', '2022-11-09 12:25:09', '2022-11-09 17:25:09'),
(51, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm638078', '', 20000, 'Paystack', 'processing', '2022-11-10 06:01:31', '2022-11-10 11:01:31'),
(52, '5f233f37ed4c56d22412ed09263d90cce904ae83148197b798', '', '1', 'sanm197273', '', 1000, 'Paystack', 'processing', '2022-11-10 08:59:45', '2022-11-10 13:59:45'),
(54, '5f233f37ed4c56d22412ed09263d90cce904ae83148197b798', '', '2', 'sanm801083', '', 1500, 'Paystack', 'processing', '2022-11-10 09:00:39', '2022-11-10 14:00:39'),
(56, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '1', 'sanm825017', 'Inv711321536', 1500, 'Paystack', 'successful', '2022-11-10 11:35:20', '2022-11-10 16:40:24'),
(57, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '3', 'sanm633205', '', 20000, 'Paystack', 'processing', '2022-11-11 04:30:44', '2022-11-11 09:30:44'),
(58, 'ee6123725577dd0e3c416828ef144610962a306184e856c3a4', '', '1', 'sanm950837', '', 2300, 'Paystack', 'processing', '2022-11-11 08:35:24', '2022-11-11 13:35:24'),
(59, '054a4176b6ba87c721f063a8805823464330aea026112c1c86', '', '1', 'sanm314557', '', 2000, 'Paystack', 'processing', '2022-11-14 09:37:33', '2022-11-14 14:37:33'),
(61, '51bdc1b4cf9227d62bcf0302767f6ce8f9b4156a144afe7347', '', '1', 'sanm923633', '', 1725, 'Paystack', 'processing', '2022-11-14 11:25:38', '2022-11-14 16:25:38'),
(62, '09dd9e5a95d3a8fa74f084207b1f021106091e83ccbbb51a76', '', '1', 'sanm231449', '', 10000, 'Paystack', 'processing', '2022-11-14 16:33:14', '2022-11-14 21:33:14'),
(63, '0d406e78037f92389e7b3c3fe16bea0c3a47b169d88717846d', '', '1', 'sanm558576', '', 2300, 'Wallet', 'successful', '2022-11-16 04:11:15', '2022-11-16 09:11:15'),
(64, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '3', 'sanm902904', '', 1500, 'FlutterWave', 'processing', '2022-11-20 05:49:03', '2022-11-20 10:49:03'),
(66, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm159188', '', 5000, 'FlutterWave', 'processing', '2022-11-20 23:32:31', '2022-11-21 04:32:31'),
(68, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm127944', '', 5000, 'FlutterWave', 'processing', '2022-11-20 23:35:41', '2022-11-21 04:35:41'),
(69, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm800451', '', 100, 'FlutterWave', 'processing', '2022-11-20 23:39:49', '2022-11-21 04:39:49'),
(70, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm352002', '', 100, 'FlutterWave', 'processing', '2022-11-20 23:44:47', '2022-11-21 04:44:47'),
(71, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm655261', 'undefined', 100, 'FlutterWave', 'successful', '2022-11-20 23:48:27', '2022-11-21 04:49:04'),
(72, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '3', 'sanm556379', 'Inv871657349', 15000, 'FlutterWave', 'successful', '2022-11-20 23:51:33', '2022-11-21 04:52:03'),
(73, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '1', 'sanm898900', '', 1000, 'FlutterWave', 'processing', '2022-11-20 23:53:54', '2022-11-21 04:53:54'),
(74, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '4', 'sanm989932', '', 100, 'FlutterWave', 'processing', '2022-11-21 00:56:00', '2022-11-21 05:56:00'),
(75, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '5', 'sanm815864', '', 40000, 'FlutterWave', 'processing', '2022-11-22 07:50:20', '2022-11-22 12:50:20'),
(120, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '5', 'sanm555706', '', 100000, 'FlutterWave', 'processing', '2022-11-22 09:53:22', '2022-11-22 14:53:22'),
(127, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '4', 'sanm426011', '', 100000, 'FlutterWave', 'processing', '2022-11-22 12:26:27', '2022-11-22 17:26:27'),
(129, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '4', 'sanm371244', '', 150000, 'FlutterWave', 'processing', '2022-11-22 12:39:24', '2022-11-22 17:39:24'),
(130, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '4', 'sanm856677', '', 150000, 'FlutterWave', 'processing', '2022-11-22 12:44:18', '2022-11-22 17:44:18'),
(131, '3e60b4caca3db689593feb25a9bcfdb2c9d6761df8bae5150e', '', '6', 'sanm955335', '', 2000, 'FlutterWave', 'processing', '2022-11-22 16:47:33', '2022-11-22 21:47:33'),
(132, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '2', 'sanm422469', '', 1500, 'FlutterWave', 'processing', '2022-11-23 05:45:15', '2022-11-23 10:45:15'),
(133, 'ff3be481b18111d351bdd808928b4732a2d137953dcdce4008', '', '2', 'sanm312519', '', 10000, 'FlutterWave', 'processing', '2022-11-24 03:49:08', '2022-11-24 08:49:08'),
(134, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm681509', '', 1500, 'FlutterWave', 'processing', '2022-11-25 01:46:39', '2022-11-25 06:46:39'),
(136, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '1', 'sanm009868', 'Inv894500711', 1500, 'FlutterWave', 'successful', '2022-11-25 03:55:33', '2022-11-25 08:59:10'),
(137, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '1', 'sanm455274', '', 1500, 'FlutterWave', 'processing', '2022-11-25 04:17:56', '2022-11-25 09:17:56'),
(138, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '1', 'sanm544313', 'Inv785197457', 1500, 'FlutterWave', 'successful', '2022-11-25 04:28:13', '2022-11-25 09:30:09'),
(139, '0d406e78037f92389e7b3c3fe16bea0c3a47b169d88717846d', '', '1', 'sanm167006', '', 2645, 'Wallet', 'successful', '2022-11-25 06:33:45', '2022-11-25 11:33:45'),
(140, '6fee78814c72f1756ee43b188214375dd528437f0308f2e7c9', '', '5', 'sanm397284', '', 1500, 'FlutterWave', 'processing', '2022-11-25 17:00:41', '2022-11-25 22:00:41'),
(141, '992d3a4147554be8e5d38ded5de4e2ca1b652fee6765e8a0f7', '', '1', 'sanm059750', '', 1500, 'FlutterWave', 'processing', '2022-11-26 13:22:29', '2022-11-26 18:22:29'),
(142, '992d3a4147554be8e5d38ded5de4e2ca1b652fee6765e8a0f7', '', '2', 'sanm278232', '', 2, 'FlutterWave', 'processing', '2022-11-26 13:45:52', '2022-11-26 18:45:52'),
(143, '992d3a4147554be8e5d38ded5de4e2ca1b652fee6765e8a0f7', '', '1', 'sanm486971', '', 2000, 'FlutterWave', 'processing', '2022-11-26 13:46:17', '2022-11-26 18:46:17'),
(146, '992d3a4147554be8e5d38ded5de4e2ca1b652fee6765e8a0f7', '', '1', 'sanm763933', '', 1500, 'FlutterWave', 'processing', '2022-11-26 13:50:38', '2022-11-26 18:50:38'),
(148, '992d3a4147554be8e5d38ded5de4e2ca1b652fee6765e8a0f7', '', '1', 'sanm673050', '', 1500, 'FlutterWave', 'processing', '2022-11-26 14:02:39', '2022-11-26 19:02:39'),
(149, 'a32005d8c9767c5cba8340916b311353d3fc538429fc1c6963', '', '2', 'sanm483680', '', 15000, 'FlutterWave', 'processing', '2022-11-26 15:02:52', '2022-11-26 20:02:52'),
(150, 'a32005d8c9767c5cba8340916b311353d3fc538429fc1c6963', '', '2', 'sanm157656', '', 15000, 'FlutterWave', 'processing', '2022-11-26 15:04:30', '2022-11-26 20:04:30'),
(151, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '2', 'sanm406091', '', 1500, 'FlutterWave', 'processing', '2022-11-26 17:15:26', '2022-11-26 22:15:26'),
(152, '6ce7aa24459d41c3706e4c00b542a4483e552c1e9a27766ffa', '', '1', 'sanm290347', '', 2000, 'FlutterWave', 'processing', '2022-11-27 23:04:09', '2022-11-28 04:04:09'),
(153, '6ce7aa24459d41c3706e4c00b542a4483e552c1e9a27766ffa', '', '1', 'sanm366827', '', 2000, 'FlutterWave', 'processing', '2022-11-28 03:03:52', '2022-11-28 08:03:52'),
(155, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm978427', '', 5000, 'FlutterWave', 'processing', '2022-11-28 03:09:54', '2022-11-28 08:09:54'),
(156, '6ce7aa24459d41c3706e4c00b542a4483e552c1e9a27766ffa', '', '1', 'sanm725547', '', 2000, 'FlutterWave', 'processing', '2022-11-28 03:10:07', '2022-11-28 08:10:07'),
(157, '6ce7aa24459d41c3706e4c00b542a4483e552c1e9a27766ffa', '', '1', 'sanm227567', '', 2000, 'FlutterWave', 'processing', '2022-11-28 03:13:05', '2022-11-28 08:13:05'),
(158, '6ce7aa24459d41c3706e4c00b542a4483e552c1e9a27766ffa', '', '1', 'sanm138877', '', 2000, 'FlutterWave', 'processing', '2022-11-28 03:16:42', '2022-11-28 08:16:42'),
(159, '6ce7aa24459d41c3706e4c00b542a4483e552c1e9a27766ffa', '', '1', 'sanm769621', '', 2000, 'FlutterWave', 'processing', '2022-11-28 03:24:25', '2022-11-28 08:24:25'),
(160, '26e0591773e71ed0ccf0fd7cebee247e8eb916816466efdb78', '', '2', 'sanm824638', '', 1500, 'FlutterWave', 'processing', '2022-11-29 12:22:48', '2022-11-29 17:22:48'),
(161, '26e0591773e71ed0ccf0fd7cebee247e8eb916816466efdb78', '', '1', 'sanm495823', 'Inv963662102', 1500, 'FlutterWave', 'successful', '2022-11-29 12:23:24', '2022-11-29 17:26:50'),
(162, '0256b8be08e6b6c056259713f3f6fa6b8891722b2c50da8659', '', '1', 'sanm852247', '', 2000, 'FlutterWave', 'processing', '2022-11-29 12:39:12', '2022-11-29 17:39:12'),
(163, '8ecd70c3c1479f2ef701c1caafcde4756bab7eff580ea63788', '', '1', 'sanm828913', '', 1500, 'FlutterWave', 'processing', '2022-11-29 12:56:48', '2022-11-29 17:56:48'),
(164, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '3', 'sanm772098', '', 5000, 'FlutterWave', 'processing', '2022-11-29 13:18:37', '2022-11-29 18:18:37'),
(165, 'a32005d8c9767c5cba8340916b311353d3fc538429fc1c6963', '', '2', 'sanm679218', '', 5000, 'FlutterWave', 'processing', '2022-11-30 04:34:27', '2022-11-30 09:34:27'),
(166, 'a32005d8c9767c5cba8340916b311353d3fc538429fc1c6963', '', '1', 'sanm580524', '', 5000, 'FlutterWave', 'processing', '2022-11-30 04:35:18', '2022-11-30 09:35:18'),
(167, '3ac646571601f757aaafb5f3716687332483c32cfc8aaccd4d', '', '1', 'sanm169261', '', 1500, 'FlutterWave', 'processing', '2022-12-01 05:02:18', '2022-12-01 10:02:18'),
(168, 'e21a6aeea7e1dd2ebf5cd4aa992f7eaf3aa956c2bcf6f8230b', '', '1', 'sanm660955', '', 2000, 'FlutterWave', 'processing', '2022-12-02 17:40:51', '2022-12-02 22:40:51'),
(169, 'e21a6aeea7e1dd2ebf5cd4aa992f7eaf3aa956c2bcf6f8230b', '', '2', 'sanm080205', '', 2000, 'FlutterWave', 'processing', '2022-12-02 17:45:32', '2022-12-02 22:45:32'),
(170, 'e21a6aeea7e1dd2ebf5cd4aa992f7eaf3aa956c2bcf6f8230b', '', '1', 'sanm497084', 'Inv812745819', 1600, 'FlutterWave', 'successful', '2022-12-02 17:45:50', '2022-12-02 22:46:47'),
(171, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '1', 'sanm986069', '', 1500, 'FlutterWave', 'processing', '2022-12-02 21:22:28', '2022-12-03 02:22:28'),
(173, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '3', 'sanm806050', '', 5000, 'FlutterWave', 'processing', '2022-12-02 21:26:41', '2022-12-03 02:26:41'),
(174, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '3', 'sanm321225', '', 10000, 'FlutterWave', 'processing', '2022-12-02 23:06:36', '2022-12-03 04:06:36'),
(176, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm295486', '', 5000, 'Wallet', 'successful', '2022-12-02 23:11:12', '2022-12-03 04:11:12'),
(177, '8ecd70c3c1479f2ef701c1caafcde4756bab7eff580ea63788', '', '1', 'sanm368726', '', 1500, 'FlutterWave', 'processing', '2022-12-03 07:36:28', '2022-12-03 12:36:28'),
(178, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '2', 'sanm314890', '', 5000, 'FlutterWave', 'processing', '2022-12-03 12:59:50', '2022-12-03 17:59:50'),
(179, 'e21a6aeea7e1dd2ebf5cd4aa992f7eaf3aa956c2bcf6f8230b', '', '9', 'sanm326955', '', 40, 'FlutterWave', 'processing', '2022-12-04 02:28:24', '2022-12-04 07:28:24'),
(180, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm398537', '', 5000, 'FlutterWave', 'processing', '2022-12-04 14:41:56', '2022-12-04 19:41:56'),
(181, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm045706', 'Inv795843765', 5000, 'FlutterWave', 'successful', '2022-12-04 14:50:14', '2022-12-04 19:53:23'),
(182, '0d406e78037f92389e7b3c3fe16bea0c3a47b169d88717846d', '', '1', 'sanm606398', '', 3042, 'Wallet', 'successful', '2022-12-04 16:29:27', '2022-12-04 21:29:27'),
(183, '3ac646571601f757aaafb5f3716687332483c32cfc8aaccd4d', '', '1', 'sanm429104', '', 1500, 'FlutterWave', 'processing', '2022-12-13 09:41:12', '2022-12-13 14:41:12'),
(184, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm920388', '', 5000, 'Wallet', 'successful', '2022-12-16 09:34:46', '2022-12-16 14:34:46'),
(185, '0d406e78037f92389e7b3c3fe16bea0c3a47b169d88717846d', '', '1', 'sanm679473', '', 3096, 'Wallet', 'successful', '2022-12-20 18:25:15', '2022-12-20 23:25:15'),
(186, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '2', 'sanm906292', '', 1500, 'FlutterWave', 'processing', '2022-12-22 02:17:37', '2022-12-22 07:17:37'),
(188, '66870b8bf39b8a2e1e02e752483843d54463687c9661f4dd2e', '', '2', 'sanm209852', 'Inv105302398', 5000, 'FlutterWave', 'processing', '2022-12-22 02:21:59', '2022-12-22 09:11:11'),
(189, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '1', 'sanm012136', 'Inv276210331', 1500, 'FlutterWave', 'successful', '2022-12-22 09:22:04', '2022-12-22 14:29:03'),
(190, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm880405', '', 5000, 'Wallet', 'successful', '2022-12-24 10:49:11', '2022-12-24 15:49:11'),
(191, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm488296', '', 30000, 'FlutterWave', 'processing', '2022-12-30 01:32:28', '2022-12-30 06:32:28'),
(192, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm590119', '', 5000, 'Wallet', 'successful', '2023-01-03 12:28:40', '2023-01-03 17:28:40'),
(193, '0d406e78037f92389e7b3c3fe16bea0c3a47b169d88717846d', '', '1', 'sanm693079', '', 3560, 'Wallet', 'successful', '2023-01-04 03:16:48', '2023-01-04 08:16:48'),
(194, '35658754c43223194e061fac27e90d75e2e6593bb9dc100ed4', '', '1', 'sanm811985', '', 1500, 'FlutterWave', 'processing', '2023-01-10 04:59:22', '2023-01-10 09:59:22'),
(195, '35658754c43223194e061fac27e90d75e2e6593bb9dc100ed4', '', '1', 'sanm132291', '', 1500, 'FlutterWave', 'processing', '2023-01-10 05:02:16', '2023-01-10 10:02:16'),
(196, '35658754c43223194e061fac27e90d75e2e6593bb9dc100ed4', '', '5', 'sanm685170', '', 2000, 'FlutterWave', 'processing', '2023-01-10 05:17:21', '2023-01-10 10:17:21'),
(197, '90a839ed34ad99e09f480b4ecb749aca76b668530505bf64cf', '', '5', 'sanm342698', '', 2000, 'FlutterWave', 'processing', '2023-01-10 05:43:16', '2023-01-10 10:43:16'),
(198, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '0', 'sanm_613576', 'Inv756230549', 2000, 'FlutterWave', 'successful', '2023-01-11 12:15:43', '2023-01-11 17:18:25'),
(199, '90a839ed34ad99e09f480b4ecb749aca76b668530505bf64cf', '', '1', 'sanm_729531', '', 1500, 'FlutterWave', 'processing', '2023-01-14 03:35:42', '2023-01-14 08:35:42'),
(202, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm_907998', '', 10000, 'Wallet', 'successful', '2023-01-15 06:14:37', '2023-01-15 11:14:37'),
(203, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_527286', '', 20000, 'FlutterWave', 'processing', '2023-01-19 06:30:06', '2023-01-19 11:30:06'),
(205, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm_509044', '', 5000, 'FlutterWave', 'processing', '2023-01-19 06:32:04', '2023-01-19 11:32:04'),
(207, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm_561226', '', 5000, 'FlutterWave', 'processing', '2023-01-19 09:19:53', '2023-01-19 14:19:53'),
(208, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_201029', '', 20000, 'FlutterWave', 'processing', '2023-01-19 09:49:39', '2023-01-19 14:49:39'),
(209, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_252649', '', 20000, 'FlutterWave', 'processing', '2023-01-19 09:58:55', '2023-01-19 14:58:55'),
(211, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_929597', '', 20000, 'FlutterWave', 'processing', '2023-01-19 12:07:11', '2023-01-19 17:07:11'),
(212, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm_478340', '', 5000, 'FlutterWave', 'processing', '2023-01-19 12:12:14', '2023-01-19 17:12:14'),
(213, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_173925', '', 20000, 'FlutterWave', 'processing', '2023-01-19 13:23:46', '2023-01-19 18:23:46'),
(214, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '2', 'sanm_853308', '', 5000, 'FlutterWave', 'processing', '2023-01-19 14:17:57', '2023-01-19 19:17:57'),
(215, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm_452946', '', 10000, 'Wallet', 'successful', '2023-01-24 00:36:09', '2023-01-24 05:36:09'),
(216, '1333ac166842d9acd0425ce343bedc5cde87beff1f1645104a', '', '1', 'sanm_687836', '', 1000, 'FlutterWave', 'processing', '2023-01-26 03:29:48', '2023-01-26 08:29:48'),
(217, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '0', 'sanm_900516', '', 2000, 'FlutterWave', 'processing', '2023-01-27 08:10:22', '2023-01-27 13:10:22'),
(218, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm_438349', '', 10000, 'Wallet', 'successful', '2023-02-01 15:08:25', '2023-02-01 20:08:25'),
(219, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_594521', '', 5000, 'FlutterWave', 'processing', '2023-02-07 06:30:46', '2023-02-07 11:30:46'),
(221, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_917091', '', 5000, 'FlutterWave', 'processing', '2023-02-07 10:27:12', '2023-02-07 15:27:12'),
(222, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_112761', '', 5000, 'FlutterWave', 'processing', '2023-02-07 11:58:23', '2023-02-07 16:58:23'),
(223, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_194970', '', 5000, 'Wallet', 'successful', '2023-02-07 13:51:22', '2023-02-07 18:51:22'),
(224, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '1', 'sanm_940822', '', 2000, 'FlutterWave', 'processing', '2023-02-15 10:15:28', '2023-02-15 15:15:28'),
(226, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '0', 'sanm_735490', '', 3750, 'FlutterWave', 'processing', '2023-02-17 15:05:51', '2023-02-17 20:05:51'),
(227, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '0', 'sanm_942788', '', 3750, 'FlutterWave', 'processing', '2023-02-17 16:03:58', '2023-02-17 21:03:58'),
(228, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_797439', '', 10000, 'Wallet', 'successful', '2023-02-17 17:19:36', '2023-02-17 22:19:36'),
(229, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm_822304', '', 10000, 'Wallet', 'successful', '2023-02-27 07:24:53', '2023-02-27 12:24:53'),
(230, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_727600', '', 12500, 'Wallet', 'successful', '2023-02-27 10:09:28', '2023-02-27 15:09:28'),
(231, 'a5265518cbe6052d4a52dae7eab3cb521662dcf55b1671705c', '', '2', 'sanm_749631', '', 20000, 'Wallet', 'successful', '2023-03-15 05:23:30', '2023-03-15 09:23:30'),
(232, '3644ea7f5ecae058ee85fb38546323ab72100dd8c0f3821fb1', '', '2', 'sanm_031534', '', 2500, 'FlutterWave', 'processing', '2023-03-15 22:32:31', '2023-03-16 02:32:31'),
(233, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '2', 'sanm_483232', '', 5000, 'Wallet', 'successful', '2023-03-16 15:17:50', '2023-03-16 19:17:50'),
(234, '3123a6e9e19309a3aa488a82b15e3dfd6fb4e09dae4cc7da7b', '', '0', 'sanm_171798', '', 10000, 'FlutterWave', 'processing', '2023-03-17 02:00:22', '2023-03-17 06:00:22'),
(235, 'c7477ecd4e0ebcfcd234a38284ffc7d10de3bc6b4f0eaad60e', '', '0', 'sanm_169150', '', 1000, 'FlutterWave', 'processing', '2023-03-20 07:54:44', '2023-03-20 11:54:44'),
(243, '2349a53b3ce25b96917bc61beae8762bbc16de9fc6adb86a9e', '', '1', 'sanm_875139', '', 5000, 'Wallet', 'successful', '2023-03-21 16:09:48', '2023-03-21 20:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `porn_videos`
--

CREATE TABLE `porn_videos` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `entity_guid` varchar(50) NOT NULL,
  `sex_cat_id` varchar(50) NOT NULL,
  `title` varchar(2000) NOT NULL,
  `contents` text NOT NULL,
  `porn_video` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `entity` varchar(50) NOT NULL,
  `escortee` varchar(50) NOT NULL,
  `escorter` varchar(50) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `request_comments` text NOT NULL,
  `request_status` enum('hold','accept','decline','ongoing','done') NOT NULL DEFAULT 'hold',
  `comments` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `entity`, `escortee`, `escorter`, `category_id`, `amount`, `request_comments`, `request_status`, `comments`, `created_at`, `updated_at`) VALUES
(1, '6754-388$re3-6yf3219-765430-p876y$', 'b513cf8d63a035b3055ed7afe9e5735f59f2276d1610f3c374', '67543388$re386yf32198765430op876y$', '67543388$re386yf32198765430op87697', 100000, 'Start coming by 2pm', 'hold', NULL, '2024-09-22 16:29:22', '2024-09-22 18:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `sex_categories`
--

CREATE TABLE `sex_categories` (
  `id` int(11) NOT NULL,
  `identity_guid` varchar(50) NOT NULL,
  `sex_category` varchar(250) NOT NULL,
  `slugs` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sex_categories`
--

INSERT INTO `sex_categories` (`id`, `identity_guid`, `sex_category`, `slugs`, `created_at`, `updated_at`) VALUES
(1, '5675-56798-0987-5432-65489-4321-8997', 'Big black ass', 'big-black-ass', '2024-09-29 23:47:50', '2024-09-29 23:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `sub_category` varchar(250) NOT NULL,
  `entity_guid` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sugar_request`
--

CREATE TABLE `sugar_request` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `enti_guid` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `currency` enum('ngn','usd') NOT NULL DEFAULT 'ngn',
  `business` varchar(250) NOT NULL,
  `age_request` int(11) NOT NULL,
  `ethnicity` varchar(50) NOT NULL,
  `smoker` enum('yes','no') NOT NULL DEFAULT 'yes',
  `alcohol` enum('yes','no') NOT NULL DEFAULT 'yes',
  `weight_request` varchar(50) NOT NULL,
  `height_request` varchar(50) NOT NULL,
  `complexion` varchar(250) NOT NULL,
  `upload_file` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_guid` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `nin_number` int(12) DEFAULT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_guid`, `role_id`, `name`, `username`, `email`, `password`, `phone_number`, `nin_number`, `picture`, `address`, `created_at`, `updated_at`) VALUES
(1, '67543388$re386yf32198765430op876y$', 2, 'Blessing Mary', 'Marybabe', 'example@gmail.com', '', NULL, NULL, NULL, NULL, '2024-09-03 11:15:12', '2024-09-11 08:01:31'),
(2, '', 2, 'Akin', 'odobodobo', 'root@gmail.com', '$2y$10$Cp5o3xj5oMQoT9raku3fD.ld6SaYWxnw3AtycWXqt7ewQdNNN66Di', NULL, NULL, NULL, NULL, '2024-09-11 08:12:02', '2024-09-11 08:12:30'),
(3, 'b513cf8d63a035b3055ed7afe9e5735f59f2276d1610f3c374', 3, 'joey hurt', NULL, 'roots@gmail.com', '$2y$10$v83qnjiVAjjdfQhuH0qCruFHEhzgeb0OirZWBe6WvslMzpEd6B90.', NULL, NULL, NULL, NULL, '2024-09-11 08:13:21', '2024-09-11 08:14:04'),
(4, 'c42c4088e3f4d55e48034147e6b46d73b519c4fe98f2310ad8', 3, 'wike', NULL, 'wike@gmail.com', '$2y$10$J/T1g58lA8LjtdxfMunwN.xfBTt5/4u4d6v1WFQjI/9sgKFt8tsH2', NULL, NULL, NULL, NULL, '2024-09-11 08:15:05', '2024-09-11 08:15:05'),
(5, '6c001ed80ba6ded21a7bffe3ee94774c4bc3a019e867aa6b37', 3, 'anuli anjoes', NULL, 'joes@gmail.com', '$2y$10$VIFCS0wqHO9ISyaSwTPonOjrFkYER25xVAnRXzsCkTEvAafr6rFxG', NULL, NULL, NULL, NULL, '2024-09-11 08:20:46', '2024-09-11 08:20:46'),
(6, '908f1f53eabbfc7afc0e91bc2466533424c15b185f090058a9', 3, 'anuli anjoes', NULL, 'rest@gmail.com', '$2y$10$dVPuINp7rhITEsThkQJHKux9ApKJZWzjU/OucGAGTzLgVotf/g6lm', NULL, NULL, NULL, NULL, '2024-09-11 08:24:52', '2024-09-11 08:24:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `web_address` (`web_address`),
  ADD UNIQUE KEY `token` (`token_guid`);

--
-- Indexes for table `escorts`
--
ALTER TABLE `escorts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `entity` (`entity_guid`),
  ADD UNIQUE KEY `cat_id` (`category_id`);

--
-- Indexes for table `payments_log`
--
ALTER TABLE `payments_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_code` (`invoice_code`),
  ADD KEY `user_guid` (`escortee_id`),
  ADD KEY `investment_plan_id` (`category_id`),
  ADD KEY `escorte_id` (`escorte_id`);

--
-- Indexes for table `porn_videos`
--
ALTER TABLE `porn_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sex_categories` (`sex_cat_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sex_categories`
--
ALTER TABLE `sex_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sugar_request`
--
ALTER TABLE `sugar_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `escorts`
--
ALTER TABLE `escorts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments_log`
--
ALTER TABLE `payments_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `porn_videos`
--
ALTER TABLE `porn_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sex_categories`
--
ALTER TABLE `sex_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sugar_request`
--
ALTER TABLE `sugar_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
