-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 01, 2026 at 07:08 PM
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
(11, '5875-56798-0987-5432-65489-4321-8936', 'Stripper', 'stripper', 'stripper.php', 'ti ti-napster', '2024-09-21 01:04:36', '2024-09-21 01:12:04'),
(13, '9675-56798-0987-5452-65489-4321-8931', 'Private Chef', 'private_chef', '', 'ti ti-chef', '2026-08-24 12:32:35', '2026-08-24 12:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `escorts`
--

CREATE TABLE `escorts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `entity_guid` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `period_prices` enum('hour','day','week','long_period') DEFAULT 'hour',
  `prices` float DEFAULT NULL,
  `currency` enum('ngn','usd','gbp','euro') DEFAULT NULL,
  `comments` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ethnicity` varchar(50) NOT NULL,
  `hair_long` varchar(50) NOT NULL,
  `hair_color` varchar(50) NOT NULL,
  `bust_size` enum('l','xl','xxl','xxxl') DEFAULT NULL,
  `smoker` enum('yes','no') NOT NULL DEFAULT 'yes',
  `alcohol` enum('yes','no') NOT NULL DEFAULT 'no',
  `build` varchar(50) NOT NULL,
  `sexual_orientation` varchar(50) NOT NULL,
  `profile_image` varchar(250) NOT NULL,
  `state` varchar(30) NOT NULL,
  `lga` varchar(50) NOT NULL,
  `escorts_status` enum('inactive','active') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `escorts`
--

INSERT INTO `escorts` (`id`, `user_id`, `category_id`, `entity_guid`, `user_name`, `age`, `height`, `weight`, `period_prices`, `prices`, `currency`, `comments`, `created_at`, `updated_at`, `ethnicity`, `hair_long`, `hair_color`, `bust_size`, `smoker`, `alcohol`, `build`, `sexual_orientation`, `profile_image`, `state`, `lga`, `escorts_status`) VALUES
(1, '67543388$re386yf32198765430op876y$', '67543388$re386yf32198765430op87697', '67543388$re386yf32198765430op876y$', 'marybae', 23, 170, 50, 'day', 50000, 'ngn', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.', '2024-08-31 04:05:15', '2026-08-17 14:32:02', 'black', 'long', 'black', 'l', 'yes', 'no', 'curve', 'bisexual', '', 'lagos', 'ikeja', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_uuid` varchar(250) NOT NULL,
  `order_entity` varchar(250) NOT NULL,
  `payments_log_id` varchar(250) NOT NULL,
  `payment_status` enum('pending','unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `order_status` enum('waiting','accept','decline','done') NOT NULL DEFAULT 'waiting',
  `complaint` text DEFAULT NULL,
  `order_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `order_updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_uuid`, `order_entity`, `payments_log_id`, `payment_status`, `order_status`, `complaint`, `order_created_at`, `order_updated_at`) VALUES
(2, '67543388$re386yf32198765430op876y$', '6012be3c-9594-11f1-a9fe-00bb60976a42', '6012be3c-9594-11f1-a9fe-00bb60976a80', 'paid', 'done', '', '2026-08-24 17:29:30', '2026-09-01 07:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `payments_log`
--

CREATE TABLE `payments_log` (
  `id` int(11) NOT NULL,
  `payment_entity` varchar(50) NOT NULL,
  `escortee_id` varchar(50) NOT NULL,
  `escorte_id` varchar(50) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `invoice_code` varchar(12) NOT NULL,
  `paystack_invoice` varchar(12) DEFAULT NULL,
  `amount` float NOT NULL,
  `payment_channel` varchar(20) NOT NULL,
  `conditions` enum('processing','cancelled','successful') NOT NULL DEFAULT 'processing',
  `escortee_date` date NOT NULL,
  `escortee_time` time NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `location` varchar(100) NOT NULL,
  `messages` text NOT NULL,
  `pay_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `pay_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments_log`
--

INSERT INTO `payments_log` (`id`, `payment_entity`, `escortee_id`, `escorte_id`, `category_id`, `invoice_code`, `paystack_invoice`, `amount`, `payment_channel`, `conditions`, `escortee_date`, `escortee_time`, `contact_number`, `location`, `messages`, `pay_created_at`, `pay_updated_at`) VALUES
(1, '6012be3c-9594-11f1-a9fe-00bb60976a80', '5f183f835bf47f66980182a98396975773b9dd319c9f57dd59', '67543388$re386yf32198765430op876y$', '67543388$re386yf32198765430op87697', 'kzone_960293', 'Inv628078122', 10000, 'Squade', 'successful', '2026-08-13', '22:55:00', '9031985816', 'ikeja', 'dress nice', '2026-08-11 10:53:12', '2026-08-24 21:33:57');

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
  `gif` varchar(250) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `video_approval_status` enum('pending','approved') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `porn_videos`
--

INSERT INTO `porn_videos` (`id`, `user_id`, `entity_guid`, `sex_cat_id`, `title`, `contents`, `porn_video`, `gif`, `img`, `video_approval_status`, `created_at`, `updated_at`) VALUES
(1, '5eecefa82675721af78bebe1ebd39f74aff78e40f16604f53d', '6012be3c-9594-11f1-a9fe-00bb60976a80', '5675-56798-0987-5432-65489-4321-8997', 'my step sister was lying about pregnancy', '', '../porn_video/Xvideos_sishd_-_my_step_sis_was_lying_about_pregnancy_HD.mp4', '../porn_gif/Xvideos_sishd_-_my_step_sis_was_lying_about_pregnancy_HD-ezgif.com-optimize.gif', '../porn_img/Xvideos_sishd_-_my_step_sis_was_lying_about_pregnancy_HD.jpg', 'approved', '2026-08-24 12:53:59', '2026-08-24 13:57:04'),
(2, '5eecefa82675721af78bebe1ebd39f74aff78e40f16604f53d', '6012be3c-9594-11f1-a9fe-00bb60973a84', '5675-56798-0987-5432-65489-4321-8997', 'i spied on my stepsister masturbating and i fucked her hard untill i cum in her ass', '', '../porn_video/Xvideos_i_spied_on_my_stepsister_masturbating_and_i_fucked_her_hard_until_i_cum_in_her_ass_hl_HD.mp4', '../porn_gif/Xvideos_i_spied_on_my_stepsister_masturbating_and_i_fucked_her_hard_until_i_cum_in_her_ass_hl_HD-ezgif.com-optimize.gif', '../porn_img/Xvideos_i_spied_on_my_stepsister_masturbating_and_i_fucked_her_hard_until_i_cum_in_her_ass_hl_HD-ezgif.com-optimize.jpg', 'approved', '2026-08-24 14:04:28', '2026-08-24 14:28:21');

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
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `guid` varchar(50) NOT NULL,
  `plan_id` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `invoice_code` varchar(15) NOT NULL,
  `paystack_invoice` varchar(15) NOT NULL,
  `payment_channel` enum('Paystack','Squad') NOT NULL DEFAULT 'Paystack',
  `sub_condition` enum('processing','failed','successful') NOT NULL DEFAULT 'processing',
  `sub_status` enum('inactive','active') NOT NULL DEFAULT 'inactive',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `sub_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `sub_updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `guid`, `plan_id`, `amount`, `invoice_code`, `paystack_invoice`, `payment_channel`, `sub_condition`, `sub_status`, `start_date`, `end_date`, `sub_created_at`, `sub_updated_at`) VALUES
(1, '5f183f835bf47f66980182a98396975773b9dd319c9f57dd59', '936393f5-956f-11f1-a9fe-00bb60976a80', '8375-56898-0987-5432-65489-4321-8999', 2000, 'kzone_254042', 'Inv247669107', 'Paystack', 'successful', 'inactive', '2026-08-24 12:49:05', '2026-08-25 12:49:05', '2026-08-11 06:29:47', '2026-08-25 13:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` int(11) NOT NULL,
  `plan_guid` varchar(250) NOT NULL,
  `plan` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `duration` int(11) NOT NULL,
  `plan_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `plan_updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `plan_guid`, `plan`, `price`, `duration`, `plan_created_at`, `plan_updated_at`) VALUES
(24, '8375-56898-0987-5432-65489-4321-8999', 'starter', 2000, 1, '2026-08-06 14:33:04', '2026-08-06 14:33:04'),
(25, '8375-56898-0987-5432-65489-4321-8097', 'silver', 10000, 7, '2026-08-06 14:33:04', '2026-08-06 14:33:18'),
(26, '8375-56898-0987-5432-65489-4321-8946', 'gold', 20000, 30, '2026-08-06 14:33:04', '2026-08-06 14:33:25'),
(27, '8375-56898-0987-5432-65489-4321-8534', 'premium', 100000, 180, '2026-08-06 14:33:04', '2026-08-06 14:33:34');

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
  `email_verify` enum('unverified','verified') NOT NULL DEFAULT 'unverified',
  `password` varchar(250) NOT NULL,
  `gender` enum('female','male') NOT NULL DEFAULT 'female',
  `connect` enum('s_daddy','s_mummy','none') NOT NULL DEFAULT 'none',
  `phone_number` varchar(15) DEFAULT NULL,
  `nin_number` bigint(11) DEFAULT NULL,
  `nin_slip` varchar(250) DEFAULT NULL,
  `recent_passport` varchar(250) DEFAULT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `escort_approval` enum('waiting','approved','denied') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_guid`, `role_id`, `name`, `username`, `email`, `email_verify`, `password`, `gender`, `connect`, `phone_number`, `nin_number`, `nin_slip`, `recent_passport`, `picture`, `address`, `escort_approval`, `created_at`, `updated_at`) VALUES
(1, '67543388$re386yf32198765430op876y$', 2, 'Blessing Mary', 'Marybabe', 'example@gmail.com', 'unverified', '$2y$10$B8SphBUhXCce6WsgHqwrR.WwAUwFsv6wSEqj0HPkxKz2EZAbs6ZTC', 'female', 'none', NULL, NULL, '', '', NULL, NULL, 'approved', '2024-09-03 11:15:12', '2026-08-25 09:22:06'),
(3, 'b513cf8d63a035b3055ed7afe9e5735f59f2276d1610f3c374', 3, 'joey hurt', NULL, 'roots@gmail.com', 'unverified', '$2y$10$v83qnjiVAjjdfQhuH0qCruFHEhzgeb0OirZWBe6WvslMzpEd6B90.', 'female', 'none', NULL, NULL, '', '', NULL, NULL, 'waiting', '2024-09-11 08:13:21', '2024-09-11 08:14:04'),
(4, 'c42c4088e3f4d55e48034147e6b46d73b519c4fe98f2310ad8', 3, 'wike', NULL, 'wike@gmail.com', 'unverified', '$2y$10$J/T1g58lA8LjtdxfMunwN.xfBTt5/4u4d6v1WFQjI/9sgKFt8tsH2', 'female', 'none', NULL, NULL, '', '', NULL, NULL, 'waiting', '2024-09-11 08:15:05', '2024-09-11 08:15:05'),
(5, '6c001ed80ba6ded21a7bffe3ee94774c4bc3a019e867aa6b37', 3, 'anuli anjoes', NULL, 'joes@gmail.com', 'unverified', '$2y$10$VIFCS0wqHO9ISyaSwTPonOjrFkYER25xVAnRXzsCkTEvAafr6rFxG', 'female', 'none', NULL, NULL, '', '', NULL, NULL, 'waiting', '2024-09-11 08:20:46', '2024-09-11 08:20:46'),
(6, '908f1f53eabbfc7afc0e91bc2466533424c15b185f090058a9', 3, 'anuli anjoes', NULL, 'rest@gmail.com', 'unverified', '$2y$10$dVPuINp7rhITEsThkQJHKux9ApKJZWzjU/OucGAGTzLgVotf/g6lm', 'female', 'none', NULL, NULL, '', '', NULL, NULL, 'waiting', '2024-09-11 08:24:52', '2024-09-11 08:24:52'),
(7, '5eecefa82675721af78bebe1ebd39f74aff78e40f16604f53d', 2, 'emma gist', 'brain', 'emma1994204@gmail.com', 'unverified', '$2y$10$W2JU2Aex7D8Tc2wnYR.jVuh79u4rPNxDzbajRv6doaxKP7pa2on22', 'male', 'none', '9031985816', 90874567381, '../nin_slip/omogbon.jpeg', '../passport/omogbon.jpeg', NULL, 'ojota', 'approved', '2026-07-27 11:32:48', '2026-08-24 12:18:27'),
(8, '5f183f835bf47f66980182a98396975773b9dd319c9f57dd59', 3, 'jerry', NULL, 'jerry@gmail.com', 'unverified', '$2y$10$B8SphBUhXCce6WsgHqwrR.WwAUwFsv6wSEqj0HPkxKz2EZAbs6ZTC', 'male', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-24 11:01:41', '2026-08-25 09:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` varchar(70) NOT NULL,
  `entity_uuid` varchar(70) NOT NULL,
  `credit` float DEFAULT NULL,
  `pending_funds` float DEFAULT NULL,
  `wallet_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `wallet_updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `entity_uuid`, `credit`, `pending_funds`, `wallet_created_at`, `wallet_updated_at`) VALUES
(1, '67543388$re386yf32198765430op876y$', 'a81d9be5-a07b-11f1-85ca-50660d112cab', 130000, 0, '2026-08-25 07:53:58', '2026-09-01 08:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `user_id` varchar(70) NOT NULL,
  `withdrawal_token` varchar(70) NOT NULL,
  `amount` float NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `acc_number` bigint(10) NOT NULL,
  `acc_name` varchar(100) NOT NULL,
  `with_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `with_updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `withdrawal_token`, `amount`, `bank_name`, `acc_number`, `acc_name`, `with_created_at`, `with_updated_at`) VALUES
(1, '5eecefa82675721af78bebe1ebd39f74aff78e40f16604f53d', '06d9972a-9fd1-11f1-85ca-50660d112cab', 50, 'gtb', 1234567890, 'brain', '2026-08-24 11:32:33', '2026-08-24 11:32:33');

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
  ADD UNIQUE KEY `cat_id` (`category_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments_log`
--
ALTER TABLE `payments_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_code` (`invoice_code`),
  ADD UNIQUE KEY `payment_entity` (`payment_entity`),
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
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `guid` (`guid`),
  ADD UNIQUE KEY `plan_id` (`plan_id`),
  ADD UNIQUE KEY `invoice_code` (`invoice_code`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
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
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `escorts`
--
ALTER TABLE `escorts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments_log`
--
ALTER TABLE `payments_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `porn_videos`
--
ALTER TABLE `porn_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
