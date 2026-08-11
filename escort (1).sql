-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 11, 2026 at 05:04 PM
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
  `user_name` varchar(50) NOT NULL,
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

INSERT INTO `escorts` (`id`, `user_id`, `category_id`, `entity_guid`, `age`, `height`, `weight`, `period_prices`, `prices`, `currency`, `user_name`, `gender`, `comments`, `created_at`, `updated_at`, `ethnicity`, `hair_long`, `hair_color`, `bust_size`, `smoker`, `alcohol`, `build`, `sexual_orientation`, `profile_image`) VALUES
(1, '67543388$re386yf32198765430op876y$', '67543388$re386yf32198765430op87697', '67543388$re386yf32198765430op876y$', 23, 170, 50, 'hour', 10000, 'ngn', 'marybabe', 'female', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.', '2024-08-31 04:05:15', '2024-09-11 08:05:14', 'black', 'long', 'black', 'l', 'yes', 'no', 'curve', 'bisexual', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_uuid` varchar(250) NOT NULL,
  `order_entity` varchar(250) NOT NULL,
  `payments_log_id` varchar(250) NOT NULL,
  `order_status` enum('waiting','failed','successful') NOT NULL DEFAULT 'waiting',
  `order_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `order_updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_uuid`, `order_entity`, `payments_log_id`, `order_status`, `order_created_at`, `order_updated_at`) VALUES
(1, '67543388$re386yf32198765430op876y$', '67f1c1b7-9594-11f1-a9fe-00bb60976a80', '6012be3c-9594-11f1-a9fe-00bb60976a80', 'waiting', '2026-08-11 10:53:25', '2026-08-11 10:53:25');

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments_log`
--

INSERT INTO `payments_log` (`id`, `payment_entity`, `escortee_id`, `escorte_id`, `category_id`, `invoice_code`, `paystack_invoice`, `amount`, `payment_channel`, `conditions`, `escortee_date`, `escortee_time`, `contact_number`, `location`, `messages`, `created_at`, `updated_at`) VALUES
(1, '6012be3c-9594-11f1-a9fe-00bb60976a80', '5eecefa82675721af78bebe1ebd39f74aff78e40f16604f53d', '67543388$re386yf32198765430op876y$', '67543388$re386yf32198765430op87697', 'kzone_960293', 'Inv628078122', 10000, 'Squade', 'successful', '2026-08-13', '22:55:00', '9031985816', 'ikeja', 'dress nice', '2026-08-11 10:53:12', '2026-08-11 14:53:25');

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
(1, '5eecefa82675721af78bebe1ebd39f74aff78e40f16604f53d', '936393f5-956f-11f1-a9fe-00bb60976a80', '8375-56898-0987-5432-65489-4321-8999', 2000, 'kzone_254042', 'Inv247669107', 'Paystack', 'successful', 'active', '2026-08-11 12:49:05', '2026-08-12 12:49:05', '2026-08-11 06:29:47', '2026-08-11 06:49:05');

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
  `password` varchar(250) NOT NULL,
  `gender` enum('female','male') NOT NULL DEFAULT 'female',
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

INSERT INTO `users` (`id`, `user_guid`, `role_id`, `name`, `username`, `email`, `password`, `gender`, `phone_number`, `nin_number`, `picture`, `address`, `created_at`, `updated_at`) VALUES
(1, '67543388$re386yf32198765430op876y$', 2, 'Blessing Mary', 'Marybabe', 'example@gmail.com', '', 'female', NULL, NULL, NULL, NULL, '2024-09-03 11:15:12', '2024-09-11 08:01:31'),
(2, '', 2, 'Akin', 'odobodobo', 'root@gmail.com', '$2y$10$Cp5o3xj5oMQoT9raku3fD.ld6SaYWxnw3AtycWXqt7ewQdNNN66Di', 'female', NULL, NULL, NULL, NULL, '2024-09-11 08:12:02', '2024-09-11 08:12:30'),
(3, 'b513cf8d63a035b3055ed7afe9e5735f59f2276d1610f3c374', 3, 'joey hurt', NULL, 'roots@gmail.com', '$2y$10$v83qnjiVAjjdfQhuH0qCruFHEhzgeb0OirZWBe6WvslMzpEd6B90.', 'female', NULL, NULL, NULL, NULL, '2024-09-11 08:13:21', '2024-09-11 08:14:04'),
(4, 'c42c4088e3f4d55e48034147e6b46d73b519c4fe98f2310ad8', 3, 'wike', NULL, 'wike@gmail.com', '$2y$10$J/T1g58lA8LjtdxfMunwN.xfBTt5/4u4d6v1WFQjI/9sgKFt8tsH2', 'female', NULL, NULL, NULL, NULL, '2024-09-11 08:15:05', '2024-09-11 08:15:05'),
(5, '6c001ed80ba6ded21a7bffe3ee94774c4bc3a019e867aa6b37', 3, 'anuli anjoes', NULL, 'joes@gmail.com', '$2y$10$VIFCS0wqHO9ISyaSwTPonOjrFkYER25xVAnRXzsCkTEvAafr6rFxG', 'female', NULL, NULL, NULL, NULL, '2024-09-11 08:20:46', '2024-09-11 08:20:46'),
(6, '908f1f53eabbfc7afc0e91bc2466533424c15b185f090058a9', 3, 'anuli anjoes', NULL, 'rest@gmail.com', '$2y$10$dVPuINp7rhITEsThkQJHKux9ApKJZWzjU/OucGAGTzLgVotf/g6lm', 'female', NULL, NULL, NULL, NULL, '2024-09-11 08:24:52', '2024-09-11 08:24:52'),
(7, '5eecefa82675721af78bebe1ebd39f74aff78e40f16604f53d', 3, 'emma', NULL, 'emma1994204@gmail.com', '$2y$10$W2JU2Aex7D8Tc2wnYR.jVuh79u4rPNxDzbajRv6doaxKP7pa2on22', 'male', NULL, NULL, NULL, NULL, '2026-07-27 11:32:48', '2026-07-27 11:44:32');

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments_log`
--
ALTER TABLE `payments_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
