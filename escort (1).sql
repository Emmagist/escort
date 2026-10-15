-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for escort
DROP DATABASE IF EXISTS `escort`;
CREATE DATABASE IF NOT EXISTS `escort` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `escort`;

-- Dumping structure for table escort.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token_guid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `web_address` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `web_address` (`web_address`),
  UNIQUE KEY `token` (`token_guid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.coin_packages
DROP TABLE IF EXISTS `coin_packages`;
CREATE TABLE IF NOT EXISTS `coin_packages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `package_guid` varchar(70) NOT NULL,
  `name` varchar(100) NOT NULL,
  `coins` int unsigned NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(10) NOT NULL DEFAULT 'NGN',
  `bonus_coins` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `package_guid` (`package_guid`),
  KEY `idx_active` (`is_active`),
  KEY `idx_sort` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.coin_transactions
DROP TABLE IF EXISTS `coin_transactions`;
CREATE TABLE IF NOT EXISTS `coin_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_guid` varchar(70) NOT NULL,
  `user_id` varchar(70) NOT NULL,
  `type` enum('purchase','gift_sent','gift_received','refund','admin_credit','admin_debit') NOT NULL,
  `coins` bigint NOT NULL,
  `balance_before` bigint unsigned NOT NULL DEFAULT '0',
  `balance_after` bigint unsigned NOT NULL DEFAULT '0',
  `reference` varchar(150) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('pending','successful','failed','cancelled') NOT NULL DEFAULT 'successful',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaction_guid` (`transaction_guid`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_type` (`type`),
  KEY `idx_reference` (`reference`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.escorts
DROP TABLE IF EXISTS `escorts`;
CREATE TABLE IF NOT EXISTS `escorts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `entity_guid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `age` int NOT NULL,
  `height` int NOT NULL,
  `weight` int NOT NULL,
  `period_prices` enum('hour','day','week','long_period') COLLATE utf8mb4_general_ci DEFAULT 'hour',
  `prices` float DEFAULT NULL,
  `currency` enum('ngn','usd','gbp','euro') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ethnicity` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `hair_long` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `hair_color` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `bust_size` enum('l','xl','xxl','xxxl') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smoker` enum('yes','no') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'yes',
  `alcohol` enum('yes','no') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'no',
  `build` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sexual_orientation` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_image` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `lga` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `escorts_status` enum('inactive','active') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `entity` (`entity_guid`),
  UNIQUE KEY `cat_id` (`category_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.live_coin_packages
DROP TABLE IF EXISTS `live_coin_packages`;
CREATE TABLE IF NOT EXISTS `live_coin_packages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `package_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `coins` int unsigned NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'NGN',
  `bonus_coins` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `package_guid` (`package_guid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.live_coin_wallets
DROP TABLE IF EXISTS `live_coin_wallets`;
CREATE TABLE IF NOT EXISTS `live_coin_wallets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `wallet_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `coins` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wallet_guid` (`wallet_guid`),
  UNIQUE KEY `unique_user_wallet` (`user_id`),
  KEY `idx_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.live_follows
DROP TABLE IF EXISTS `live_follows`;
CREATE TABLE IF NOT EXISTS `live_follows` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `live_follw_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `follower_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `streamer_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `live_follw_guid` (`live_follw_guid`),
  UNIQUE KEY `unique_follow` (`follower_id`,`streamer_id`),
  KEY `follower_id` (`follower_id`),
  KEY `streamer_id` (`streamer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.live_gifts
DROP TABLE IF EXISTS `live_gifts`;
CREATE TABLE IF NOT EXISTS `live_gifts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `gift_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `coins` int unsigned NOT NULL DEFAULT '0',
  `streamer_coins` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gift_guid` (`gift_guid`),
  KEY `coins` (`coins`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.live_gift_transactions
DROP TABLE IF EXISTS `live_gift_transactions`;
CREATE TABLE IF NOT EXISTS `live_gift_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `stream_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `sender_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `streamer_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `gift_id` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `quantity` int unsigned NOT NULL DEFAULT '1',
  `coins_spent` int unsigned NOT NULL DEFAULT '0',
  `streamer_coins` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaction_guid` (`transaction_guid`),
  KEY `stream_guid` (`stream_guid`),
  KEY `sender_id` (`sender_id`),
  KEY `streamer_id` (`streamer_id`),
  KEY `gift_id` (`gift_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.live_gift_wallets
DROP TABLE IF EXISTS `live_gift_wallets`;
CREATE TABLE IF NOT EXISTS `live_gift_wallets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `lg_wallet_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `coins` int unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lg_wallet_guid` (`lg_wallet_guid`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.live_likes
DROP TABLE IF EXISTS `live_likes`;
CREATE TABLE IF NOT EXISTS `live_likes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `live_likes_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `stream_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `live_likes_guid` (`live_likes_guid`)
) ENGINE=InnoDB AUTO_INCREMENT=618 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.live_messages
DROP TABLE IF EXISTS `live_messages`;
CREATE TABLE IF NOT EXISTS `live_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `stream_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `message_guid` (`message_guid`),
  KEY `idx_stream` (`stream_guid`),
  KEY `idx_user` (`user_id`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_uuid` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `order_entity` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `payments_log_id` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_status` enum('pending','unpaid','paid') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'unpaid',
  `order_status` enum('waiting','accept','decline','done') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'waiting',
  `complaint` text COLLATE utf8mb4_general_ci,
  `order_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.payments_log
DROP TABLE IF EXISTS `payments_log`;
CREATE TABLE IF NOT EXISTS `payments_log` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `pay_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pay_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_code` (`invoice_code`),
  UNIQUE KEY `payment_entity` (`payment_entity`),
  KEY `user_guid` (`escortee_id`),
  KEY `investment_plan_id` (`category_id`),
  KEY `escorte_id` (`escorte_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table escort.porn_videos
DROP TABLE IF EXISTS `porn_videos`;
CREATE TABLE IF NOT EXISTS `porn_videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `entity_guid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sex_cat_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `contents` text COLLATE utf8mb4_general_ci NOT NULL,
  `porn_video` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `gif` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video_approval_status` enum('pending','approved') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sex_categories` (`sex_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.requests
DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entity` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `escortee` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `escorter` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` float NOT NULL,
  `request_comments` text COLLATE utf8mb4_general_ci NOT NULL,
  `request_status` enum('hold','accept','decline','ongoing','done') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'hold',
  `comments` text COLLATE utf8mb4_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.sex_categories
DROP TABLE IF EXISTS `sex_categories`;
CREATE TABLE IF NOT EXISTS `sex_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `identity_guid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sex_category` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `slugs` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.streams
DROP TABLE IF EXISTS `streams`;
CREATE TABLE IF NOT EXISTS `streams` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `stream_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `room_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('scheduled','live','ended','cancelled') COLLATE utf8mb4_general_ci DEFAULT 'scheduled',
  `is_public` tinyint(1) DEFAULT '1',
  `viewer_count` int unsigned DEFAULT '0',
  `started_at` datetime DEFAULT NULL,
  `ended_at` datetime DEFAULT NULL,
  `stream_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stream_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `like_count` bigint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `stream_guid` (`stream_guid`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `room_name` (`room_name`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `streams_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_guid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.stream_comments
DROP TABLE IF EXISTS `stream_comments`;
CREATE TABLE IF NOT EXISTS `stream_comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `st_cm_key` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `stream_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `st_cm_key` (`st_cm_key`),
  KEY `stream_id` (`stream_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `stream_comments_ibfk_1` FOREIGN KEY (`stream_id`) REFERENCES `streams` (`stream_guid`) ON DELETE CASCADE,
  CONSTRAINT `stream_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_guid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.stream_events
DROP TABLE IF EXISTS `stream_events`;
CREATE TABLE IF NOT EXISTS `stream_events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_guid` char(36) NOT NULL,
  `stream_guid` varchar(64) NOT NULL,
  `actor_user_id` varchar(191) NOT NULL,
  `event_type` varchar(30) NOT NULL,
  `payload` json NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_stream_event_guid` (`event_guid`),
  KEY `idx_stream_events_feed` (`stream_guid`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.stream_keys
DROP TABLE IF EXISTS `stream_keys`;
CREATE TABLE IF NOT EXISTS `stream_keys` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `st_key_guid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `stream_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `stream_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stream_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `st_key_guid` (`st_key_guid`),
  UNIQUE KEY `stream_key` (`stream_key`),
  KEY `stream_id` (`stream_id`),
  CONSTRAINT `stream_keys_ibfk_1` FOREIGN KEY (`stream_id`) REFERENCES `streams` (`stream_guid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.stream_viewers
DROP TABLE IF EXISTS `stream_viewers`;
CREATE TABLE IF NOT EXISTS `stream_viewers` (
  `stream_guid` varchar(64) NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `last_seen` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stream_guid`,`user_id`),
  KEY `idx_stream_viewers_last_seen` (`last_seen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.subscriptions
DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `guid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `plan_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` float NOT NULL,
  `invoice_code` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `paystack_invoice` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_channel` enum('Paystack','Squad') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Paystack',
  `sub_condition` enum('processing','failed','successful') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'processing',
  `sub_status` enum('inactive','active') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'inactive',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `sub_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sub_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `guid` (`guid`),
  UNIQUE KEY `plan_id` (`plan_id`),
  UNIQUE KEY `invoice_code` (`invoice_code`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.subscription_plans
DROP TABLE IF EXISTS `subscription_plans`;
CREATE TABLE IF NOT EXISTS `subscription_plans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plan_guid` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `plan` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `duration` int NOT NULL,
  `plan_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `plan_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.sub_categories
DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_category` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `entity_guid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.sugar_request
DROP TABLE IF EXISTS `sugar_request`;
CREATE TABLE IF NOT EXISTS `sugar_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `enti_guid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `age` int NOT NULL,
  `currency` enum('ngn','usd') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'ngn',
  `business` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `age_request` int NOT NULL,
  `ethnicity` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `smoker` enum('yes','no') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'yes',
  `alcohol` enum('yes','no') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'yes',
  `weight_request` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `height_request` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `complexion` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `upload_file` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_guid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email_verify` enum('unverified','verified') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'unverified',
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` enum('female','male') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'female',
  `connect` enum('s_daddy','s_mummy','none') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'none',
  `phone_number` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nin_number` bigint DEFAULT NULL,
  `nin_slip` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `recent_passport` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `picture` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `escort_approval` enum('waiting','approved','denied') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_guid` (`user_guid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.wallets
DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `entity_uuid` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `credit` float DEFAULT NULL,
  `pending_funds` float DEFAULT NULL,
  `wallet_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wallet_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table escort.withdrawals
DROP TABLE IF EXISTS `withdrawals`;
CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `withdrawal_token` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` float NOT NULL,
  `bank_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `acc_number` bigint NOT NULL,
  `acc_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `with_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `with_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
