-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2020 at 10:43 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fantasy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_type` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `role_type`, `remember_token`, `created_at`, `updated_at`, `name`) VALUES
(1, 'admin@admin.com', '$2y$10$cWX5XdZRF4gGMQgjdfaZNO7sjsumxRm2Zqp5kmgUR0snfPRHEFKpa', '1', 'nFVfhkI3y8KCY2ZFytd3FJY9Dtekz5mvPbrjLwZH79sW1kWUvfieUW62LxBg', NULL, '2020-08-26 11:41:39', 'admin'),
(2, 'master@admin.com', '$2y$10$cWX5XdZRF4gGMQgjdfaZNO7sjsumxRm2Zqp5kmgUR0snfPRHEFKpa', '1', 'YlR9Dwl3ZZlWnuKRavXrGgmAMGevf9YOc2BKQZAAq3B8JPyzl9A6hBCoNmbE', NULL, '2020-07-27 22:48:08', 'Dev Jangde');

-- --------------------------------------------------------

--
-- Table structure for table `apk_updates`
--

CREATE TABLE `apk_updates` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `apk` varchar(255) DEFAULT NULL,
  `version_code` int(11) DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) DEFAULT NULL,
  `release_notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `bank_branch` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `account_type` text,
  `bank_passbook_url` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actiontype` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `url`, `actiontype`, `photo`, `description`, `status`, `created_at`, `updated_at`) VALUES
(8, 'ADD', 'https://sportsfight.in/storage/uploads/banner/15955673691594155965zbonus-2.png', NULL, '15955673691594155965zbonus-2.png', 'add', 1, '2020-07-24 10:38:53', '2020-07-24 10:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `batsman_statistics`
--

CREATE TABLE `batsman_statistics` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `batsman_id` int(11) UNSIGNED DEFAULT NULL,
  `batting` varchar(255) NOT NULL DEFAULT 'FALSE',
  `role` varchar(255) DEFAULT NULL,
  `runs` int(11) DEFAULT '0',
  `balls_faced` int(11) DEFAULT '0',
  `fours` int(11) NOT NULL DEFAULT '0',
  `sixes` int(11) NOT NULL DEFAULT '0',
  `run0` int(11) NOT NULL DEFAULT '0',
  `run1` int(11) NOT NULL DEFAULT '0',
  `run2` int(11) NOT NULL DEFAULT '0',
  `run4` int(11) NOT NULL DEFAULT '0',
  `run5` int(11) NOT NULL DEFAULT '0',
  `how_out` varchar(255) NOT NULL,
  `dismissal` varchar(255) NOT NULL,
  `strike_rate` float(10,2) NOT NULL DEFAULT '0.00',
  `bowler_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bowler_statistics`
--

CREATE TABLE `bowler_statistics` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `bowler_id` int(11) UNSIGNED DEFAULT NULL,
  `bowling` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `overs` int(11) DEFAULT NULL,
  `maidens` int(11) DEFAULT NULL,
  `runs_conceded` int(11) DEFAULT NULL,
  `wickets` int(11) DEFAULT NULL,
  `noballs` int(11) DEFAULT NULL,
  `wides` int(11) DEFAULT NULL,
  `econ` int(11) DEFAULT NULL,
  `runs0` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `capture_screen_times`
--

CREATE TABLE `capture_screen_times` (
  `id` int(11) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cash_bonus`
--

CREATE TABLE `cash_bonus` (
  `id` int(11) NOT NULL,
  `deposit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bonus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `used_count` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_group_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_group_image` text COLLATE utf8_unicode_ci,
  `category_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(10) UNSIGNED DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `cid` int(11) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `abbr` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `match_format` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `season` varchar(255) DEFAULT NULL,
  `datestart` varchar(255) DEFAULT NULL,
  `dateend` varchar(255) DEFAULT NULL,
  `total_matches` int(11) DEFAULT NULL,
  `total_rounds` int(11) DEFAULT NULL,
  `total_teams` int(11) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subject` varchar(500) DEFAULT NULL,
  `comments` text,
  `request_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contest_types`
--

CREATE TABLE `contest_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `contest_type` varchar(255) DEFAULT NULL,
  `description` text,
  `max_entries` int(11) DEFAULT NULL,
  `cancellable` varchar(255) DEFAULT NULL,
  `sort_by` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `create_contests`
--

CREATE TABLE `create_contests` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `contest_type` int(11) UNSIGNED DEFAULT NULL,
  `total_winning_prize` int(11) UNSIGNED DEFAULT NULL,
  `entry_fees` int(11) UNSIGNED DEFAULT NULL,
  `total_spots` int(11) UNSIGNED DEFAULT NULL,
  `filled_spot` int(11) UNSIGNED DEFAULT '0',
  `first_prize` float(10,2) DEFAULT '0.00',
  `winner_percentage` float(10,2) DEFAULT '0.00',
  `prize_percentage` int(11) DEFAULT '0',
  `cancellation` varchar(255) DEFAULT NULL,
  `default_contest_id` int(11) UNSIGNED DEFAULT NULL,
  `is_cancelled` tinyint(1) DEFAULT '0',
  `is_cancelable` tinyint(1) NOT NULL DEFAULT '0',
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `is_cloned` tinyint(1) NOT NULL DEFAULT '0',
  `is_full` int(11) NOT NULL DEFAULT '0',
  `sort_by` int(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usable_bonus` int(11) NOT NULL DEFAULT '0',
  `bonus_contest` tinyint(1) DEFAULT NULL,
  `auto_create` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `create_teams`
--

CREATE TABLE `create_teams` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `contest_id` int(11) UNSIGNED DEFAULT NULL,
  `team_id` varchar(255) DEFAULT NULL,
  `teams` text,
  `captain` varchar(255) DEFAULT NULL,
  `vice_captain` varchar(255) DEFAULT NULL,
  `trump` varchar(255) DEFAULT NULL,
  `team_count` varchar(255) NOT NULL DEFAULT 'T1',
  `team_join_status` tinyint(1) NOT NULL DEFAULT '0',
  `points` float(10,1) NOT NULL DEFAULT '0.0',
  `rank` int(11) DEFAULT '0',
  `isWinning` varchar(255) NOT NULL DEFAULT 'false',
  `prize_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `edit_team_count` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crons`
--

CREATE TABLE `crons` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` text,
  `frequery` int(11) DEFAULT NULL,
  `run_count` int(11) DEFAULT NULL,
  `cron_type` varchar(255) DEFAULT NULL,
  `run_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `default_contents`
--

CREATE TABLE `default_contents` (
  `id` int(11) NOT NULL,
  `contest_type` int(11) DEFAULT NULL,
  `entry_fees` int(11) DEFAULT NULL,
  `total_spots` varchar(255) DEFAULT NULL,
  `first_prize` int(11) DEFAULT NULL,
  `prize_percentage` float DEFAULT NULL,
  `winner_percentage` int(11) DEFAULT '50',
  `cancellation` varchar(255) DEFAULT NULL,
  `total_winning_prize` int(11) DEFAULT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bonus_contest` tinyint(1) DEFAULT NULL,
  `usable_bonus` int(11) DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_contents`
--

INSERT INTO `default_contents` (`id`, `contest_type`, `entry_fees`, `total_spots`, `first_prize`, `prize_percentage`, `winner_percentage`, `cancellation`, `total_winning_prize`, `match_id`, `is_free`, `deleted_at`, `created_at`, `updated_at`, `bonus_contest`, `usable_bonus`) VALUES
(5, 1, 39, '222', 1100, 83, 50, 'This contest is non cancellable', 7189, NULL, 0, '2020-06-13 13:16:18', '2020-03-21 00:44:18', '2020-06-13 13:16:18', NULL, 10),
(6, 11, 5, '30', 35, 90, 55, 'This contest is not cancellable', 135, NULL, 0, '2020-06-19 19:41:39', '2020-03-21 01:02:20', '2020-06-19 19:41:39', NULL, 10),
(9, 3, 999, '2', 1800, 100, 50, 'No', 1800, NULL, 0, '2020-06-14 00:02:41', '2020-04-25 17:18:58', '2020-06-14 00:02:41', NULL, 10),
(10, 5, 12, '2', 20, 20, 50, 'Non cancellable', 20, NULL, 0, '2020-07-03 23:17:59', '2020-04-25 19:44:49', '2020-07-07 23:13:19', NULL, 0),
(11, 1, 0, '15', 100, 1, 1, 'no', 100, NULL, 0, '2020-06-01 03:45:14', '2020-05-23 18:40:29', '2020-06-01 03:45:14', NULL, 10),
(12, 1, 39, '222', 1100, 83, 50, 'This contest is non cancellable', 7189, NULL, 0, '2020-06-13 15:54:49', '2020-06-01 02:49:15', '2020-06-13 15:54:49', NULL, 10),
(13, 1, 49, '111', 800, 74, 50, 'This contest is non cancellable', 4060, NULL, 0, '2020-06-13 15:56:15', '2020-06-01 02:55:58', '2020-06-13 15:56:15', NULL, 10),
(14, 3, 99, '5', 199, 70, 55, 'This contest is non cancellable', 349, NULL, 0, '2020-06-29 09:13:47', '2020-06-01 03:01:59', '2020-06-29 09:13:47', NULL, 10),
(15, 3, 149, '3', 300, 67, 33, 'This is non cancellable', 300, NULL, 0, '2020-07-03 12:52:21', '2020-06-01 03:04:16', '2020-07-03 12:52:21', NULL, 10),
(16, 5, 2875, '2', 5233, 90, 50, NULL, 5233, NULL, 0, '2020-06-13 23:59:41', '2020-06-01 03:05:58', '2020-07-07 23:13:24', NULL, 0),
(17, 5, 1875, '2', 3413, 91, 50, NULL, 3413, NULL, 0, '2020-06-14 00:01:12', '2020-06-01 03:09:21', '2020-07-07 23:13:28', NULL, 0),
(18, 5, 1111, '2', 2022, 91, 50, NULL, 2022, NULL, 0, '2020-06-14 00:01:06', '2020-06-01 03:10:58', '2020-07-07 23:13:32', NULL, 0),
(19, 5, 599, '2', 1090, 91, 50, NULL, 1090, NULL, 0, '2020-06-14 00:01:00', '2020-06-01 03:12:19', '2020-07-07 23:13:42', NULL, 0),
(20, 5, 399, '2', 726, 91, 50, NULL, 726, NULL, 0, '2020-06-14 00:00:29', '2020-06-01 03:14:06', '2020-07-07 23:13:37', NULL, 0),
(21, 5, 299, '2', 544, 91, 50, NULL, 544, NULL, 0, '2020-06-14 00:00:02', '2020-06-01 03:15:42', '2020-07-07 23:13:47', NULL, 0),
(22, 5, 199, '2', 362, 91, 50, NULL, 362, NULL, 0, '2020-06-13 23:59:53', '2020-06-01 03:16:25', '2020-07-07 23:13:56', NULL, 0),
(23, 5, 89, '2', 150, 1, 50, '1', 150, NULL, 0, NULL, '2020-06-01 03:17:38', '2020-08-27 23:21:27', 0, 3),
(24, 5, 49, '2', 79, 1, 50, '1', 79, 44952, 0, '2020-08-03 20:21:41', '2020-06-01 03:18:38', '2020-08-03 20:21:41', 0, 0),
(25, 5, 30, '2', 50, 1, 50, '1', 50, NULL, 0, NULL, '2020-06-01 03:19:30', '2020-08-27 23:23:52', 0, 3),
(26, 5, 21, '2', 35, 1, 50, '1', 35, NULL, 0, NULL, '2020-06-01 03:20:29', '2020-08-27 23:24:06', 0, 3),
(27, 5, 12, '2', 19, 1, 50, '1', 19, NULL, 0, NULL, '2020-06-01 03:21:38', '2020-08-27 23:26:52', 0, 3),
(28, 5, 7, '2', 12, 1, 50, '1', 12, NULL, 0, NULL, '2020-06-01 03:22:36', '2020-08-28 19:26:38', 0, 0),
(29, 5, 5, '2', 10, 100, 50, NULL, 10, NULL, 0, '2020-06-12 00:48:22', '2020-06-01 03:23:28', '2020-07-07 23:14:56', NULL, 0),
(30, 5, 2, '2', 4, 100, 100, NULL, 4, NULL, 0, '2020-06-12 00:39:55', '2020-06-01 03:25:03', '2020-07-07 23:14:47', NULL, 0),
(31, 9, 1, '100', 100, 100, 1, 'No', 100, NULL, 0, '2020-06-05 13:34:09', '2020-06-01 03:43:42', '2020-06-05 13:34:09', NULL, 10),
(32, 9, 0, '100', 100, 100, 50, 'No', 100, NULL, 0, '2020-06-02 22:01:31', '2020-06-01 03:57:40', '2020-06-03 20:44:53', NULL, 10),
(35, 9, 0, '100', 100, 100, 1, 'No', 100, NULL, 0, '2020-06-02 22:01:31', '2020-06-01 03:57:40', '2020-06-02 19:23:53', NULL, 10),
(36, 9, 0, '50', 10, 50, 50, 'no', 50, 40963, 1, '2020-06-12 00:43:19', '2020-06-04 20:08:53', '2020-06-12 00:43:19', NULL, 10),
(37, 9, 0, '20', 30, 50, 50, 'Non cancellable', 100, NULL, 0, '2020-06-12 00:44:25', '2020-06-05 13:29:22', '2020-06-12 00:44:25', NULL, 10),
(40, 7, 51, '5', 120, 90, 66, '1', 245, NULL, 0, '2020-07-09 14:07:02', '2020-06-11 23:53:56', '2020-07-09 14:07:02', 0, 0),
(41, 9, 0, '50', 100, 100, 1, 'No', 100, 44597, 0, '2020-08-01 19:22:49', '2020-06-13 13:36:34', '2020-08-01 19:22:49', NULL, 10),
(42, 9, 0, '30', 25, 95, 50, 'no', 95, NULL, 0, '2020-06-27 01:06:32', '2020-06-13 15:49:06', '2020-06-27 01:06:32', NULL, 10),
(43, 1, 39, '30', 300, 90, 50, 'yes', 1020, NULL, 0, '2020-06-13 23:59:20', '2020-06-13 16:44:18', '2020-06-13 23:59:20', NULL, 10),
(44, 11, 5, '10', 10, 50, 50, NULL, 40, 44655, 0, NULL, '2020-06-16 17:41:57', '2020-06-16 17:50:06', NULL, 10),
(45, 11, 19, '50', 250, 82, 40, '0', 780, 44979, 0, '2020-07-19 00:38:28', '2020-06-19 19:36:25', '2020-07-19 00:38:28', 0, 0),
(46, 9, 0, '100', 50, 50, 50, 'This is cancellable', 200, 44765, 1, '2020-08-01 19:22:59', '2020-06-26 17:22:15', '2020-08-01 19:22:59', NULL, 10),
(47, 11, 5, '10', 15, 90, 50, '1', 40, 44751, 0, NULL, '2020-06-27 15:25:26', '2020-07-08 09:53:38', 0, 0),
(48, 9, 0, '100', 25, 100, 20, 'no', 100, 44753, 1, '2020-08-01 19:23:07', '2020-06-27 15:59:35', '2020-08-01 19:23:07', NULL, 10),
(49, 12, 0, '50', 15, 100, 30, 'no', 50, 44790, 1, NULL, '2020-06-28 01:06:31', '2020-06-28 01:06:31', NULL, 10),
(50, 12, 0, '50', 15, 100, 15, 'no', 50, 44791, 0, NULL, '2020-06-28 01:23:21', '2020-06-28 01:25:45', NULL, 10),
(51, 12, 0, '50', 15, 100, 15, 'no', 50, 44769, 1, NULL, '2020-06-28 01:25:37', '2020-06-28 01:25:37', NULL, 10),
(52, 5, 125, '2', 200, 1, 50, '1', 200, NULL, 0, NULL, '2020-06-28 21:20:26', '2020-08-27 23:29:59', 0, 5),
(53, 5, 185, '2', 300, 1, 50, '1', 300, NULL, 0, NULL, '2020-06-28 21:21:04', '2020-08-27 23:31:31', 0, 5),
(54, 5, 230, '2', 411, 1, 95, '1', 411, NULL, 0, NULL, '2020-06-29 09:17:02', '2020-08-27 23:33:57', 0, 5),
(55, 5, 230, '2', 370, 80, 50, '1', 370, NULL, 0, '2020-07-18 16:16:55', '2020-06-29 09:17:57', '2020-07-18 16:16:55', 0, 0),
(56, 5, 300, '2', 500, 1, 50, '0', 500, 44618, 0, '2020-08-27 23:11:54', '2020-06-29 09:18:27', '2020-08-27 23:11:54', 0, 0),
(57, 5, 459, '2', 751, 1, 91, '1', 751, NULL, 0, NULL, '2020-06-29 09:20:18', '2020-08-27 23:38:38', 0, 8),
(58, 5, 540, '2', 901, 1, 91, '1', 901, NULL, 0, NULL, '2020-06-29 09:20:45', '2020-08-27 23:39:27', 0, 8),
(59, 5, 575, '2', 1021, 1, 91, '0', 1021, 44618, 0, '2020-08-03 20:22:45', '2020-06-29 09:21:14', '2020-08-03 20:22:45', 0, 0),
(60, 5, 795, '2', 1301, 1, 91, '1', 1301, NULL, 0, NULL, '2020-06-29 09:21:49', '2020-08-27 23:40:37', 0, 10),
(61, 5, 962, '2', 1601, 1, 91, '1', 1601, NULL, 0, NULL, '2020-06-29 09:23:17', '2020-08-27 23:41:54', 0, 10),
(62, 5, 1081, '2', 1801, 1, 91, '1', 1801, NULL, 0, NULL, '2020-06-29 09:23:51', '2020-08-27 23:46:41', 0, 10),
(63, 5, 1221, '2', 2001, 1, 91, '1', 2001, NULL, 0, NULL, '2020-06-29 09:24:24', '2020-08-27 23:50:14', 0, 10),
(64, 3, 11, '3', 29, 87, 87, NULL, 29, NULL, 0, '2020-07-03 00:20:48', '2020-06-29 09:33:32', '2020-07-03 00:20:48', NULL, 10),
(65, 3, 15, '3', 40, 88, 88, NULL, 40, NULL, 0, '2020-07-03 12:51:38', '2020-06-29 09:35:11', '2020-07-03 12:51:38', NULL, 10),
(66, 13, 21, '11', 50, 80, 71, '1', 185, 44932, 0, '2020-07-24 01:41:07', '2020-06-29 09:38:39', '2020-07-24 01:41:07', 0, 20),
(67, 11, 2, '100', 20, 2, 1, '0', 30, NULL, 0, '2020-08-01 00:48:09', '2020-06-29 13:20:14', '2020-08-01 00:48:09', 0, 0),
(68, 3, 149, '3', 375, 83, 33, 'yes', 375, 44864, 0, NULL, '2020-07-03 12:54:58', '2020-07-03 12:54:58', NULL, 10),
(69, 3, 15, '3', 40, 90, 33, 'yes', 40, 44864, 0, NULL, '2020-07-03 12:56:45', '2020-07-03 12:56:45', NULL, 10),
(70, 3, 15, '3', 40, 90, 33, '1', 40, 44823, 0, NULL, '2020-07-03 18:02:40', '2020-07-08 09:55:47', 0, 5),
(71, 3, 149, '3', 375, 85, 33, 'yes', 375, 44823, 0, NULL, '2020-07-03 18:04:12', '2020-07-03 18:04:12', NULL, 10),
(72, 11, 11, '11', 30, 1, 55, '1', 99, 44872, 0, NULL, '2020-07-04 19:55:06', '2020-07-24 01:46:31', 0, 10),
(73, 3, 15, '3', 39, 1, 33, '1', 39, NULL, 0, NULL, '2020-07-04 19:57:07', '2020-07-24 15:51:54', 0, 0),
(74, 14, 65, '100', 45, 50, 1, '0', 65, 44854, 0, '2020-07-11 09:52:35', '2020-07-06 00:14:44', '2020-07-11 09:52:35', 1, 100),
(75, 14, 35, '35', 35, 1, 1, '0', 35, 44855, 0, '2020-07-11 09:52:21', '2020-07-06 14:02:05', '2020-07-11 09:52:21', 1, 100),
(76, 9, 55, '100', 55, 100, 1, '1', 55, 44886, 0, '2020-08-01 19:23:15', '2020-07-06 21:21:19', '2020-08-01 19:23:15', 1, 100),
(77, 7, 3401, '3', 9999, 50, 50, '1', 9999, NULL, 0, '2020-07-07 23:11:21', '2020-07-07 17:38:05', '2020-07-07 23:11:21', 0, 0),
(78, 1, 50, '80', 430, 85, 30, '0', 1675, NULL, 0, '2020-07-11 23:17:58', '2020-07-08 00:50:11', '2020-07-11 23:17:58', 0, 50),
(79, 14, 65, '101', 65, 100, 1, '0', 100, 44916, 1, NULL, '2020-07-09 11:49:32', '2020-07-11 09:48:44', 1, 100),
(80, 11, 149, '10', 800, 70, 80, '1', 1300, NULL, 0, '2020-07-11 10:31:39', '2020-07-10 19:13:15', '2020-07-11 10:31:39', 0, 0),
(81, 1, 1, '550', 399, 90, 1, '1', 399, NULL, 0, '2020-07-11 23:12:07', '2020-07-11 10:03:14', '2020-07-11 23:12:07', 0, 0),
(82, 1, 2, '350', 499, 50, 1, '0', 499, NULL, 0, '2020-07-11 12:59:43', '2020-07-11 10:10:04', '2020-07-11 12:59:43', 0, 0),
(83, 1, 3, '280', 599, 50, 1, '0', 599, NULL, 0, '2020-07-11 12:59:53', '2020-07-11 10:17:49', '2020-07-11 12:59:53', 0, 0),
(84, 11, 100, '32', 800, 78, 50, '1', 2335, NULL, 0, '2020-07-18 10:01:14', '2020-07-11 10:27:37', '2020-07-18 10:01:14', 0, 0),
(85, 7, 600, '3', 1600, 50, 1, '1', 1600, NULL, 0, '2020-07-19 00:44:14', '2020-07-11 10:34:51', '2020-07-19 00:44:14', 0, 0),
(86, 7, 288, '3', 700, 1, 1, '1', 700, NULL, 0, NULL, '2020-07-11 10:38:05', '2020-08-22 10:30:43', 0, 0),
(87, 7, 161, '4', 601, 1, 1, '1', 601, NULL, 0, NULL, '2020-07-11 10:42:25', '2020-08-22 10:34:56', 0, 0),
(88, 7, 117, '3', 325, 1, 1, '1', 325, NULL, 0, NULL, '2020-07-11 10:43:47', '2020-08-22 10:35:33', 0, 0),
(89, 7, 81, '4', 300, 1, 1, '1', 300, NULL, 0, NULL, '2020-07-11 10:46:04', '2020-08-22 10:35:50', 0, 0),
(90, 7, 36, '3', 100, 1, 1, '1', 100, NULL, 0, NULL, '2020-07-11 10:47:15', '2020-08-22 10:37:16', 0, 0),
(91, 7, 32, '3', 90, 1, 1, '1', 90, NULL, 0, NULL, '2020-07-11 10:48:29', '2020-08-22 10:37:30', 0, 0),
(92, 7, 20, '3', 50, 1, 1, '1', 50, NULL, 0, NULL, '2020-07-11 10:49:33', '2020-07-24 15:54:11', 0, 0),
(93, 9, 0, '500', 5, 1, 1, '0', 5, NULL, 0, '2020-08-29 02:28:17', '2020-07-11 23:16:49', '2020-08-29 02:28:17', 0, 0),
(94, 1, 50, '80', 430, 83, 31, '0', 1675, 44934, 0, '2020-07-11 23:30:35', '2020-07-11 23:20:47', '2020-07-11 23:30:35', 0, 30),
(95, 1, 50, '80', 430, 80, 30, '0', 1620, 44934, 0, '2020-07-19 00:45:35', '2020-07-11 23:31:37', '2020-07-19 00:45:35', 0, 30),
(96, 1, 35, '80', 430, 80, 30, '0', 1620, 44935, 0, '2020-07-19 00:45:41', '2020-07-11 23:31:37', '2020-07-19 00:45:41', 0, 20),
(97, 1, 39, '60', 430, 60, 30, '1', 1620, 44936, 0, '2020-07-19 00:43:56', '2020-07-11 23:31:37', '2020-07-19 00:43:56', 0, 20),
(98, 1, 50, '80', 430, 80, 30, '0', 1620, 44937, 0, '2020-07-12 18:04:56', '2020-07-11 23:31:37', '2020-07-12 18:04:56', 0, 30),
(99, 1, 39, '50', 300, 90, 40, '0', 20, NULL, 0, '2020-07-12 20:18:33', '2020-07-12 20:18:17', '2020-07-12 20:18:33', 0, 20),
(100, 1, 39, '60', 415, 85, 40, '0', 1600, 44900, 0, '2020-07-19 00:43:08', '2020-07-12 20:20:48', '2020-07-19 00:43:08', 0, 20),
(101, 1, 31, '50', 300, 85, 40, '0', 1165, 44954, 0, '2020-07-19 00:45:48', '2020-07-12 20:20:48', '2020-07-19 00:45:48', 0, 20),
(102, 1, 55, '200', 100, 10, 10, '0', 500, 44617, 0, '2020-07-19 00:45:54', '2020-07-15 20:07:28', '2020-07-19 00:45:54', 1, 100),
(103, 1, 31, '60', 50, 5, 2, '0', 100, 44961, 0, '2020-07-19 00:45:24', '2020-07-16 20:45:31', '2020-07-19 00:45:24', 0, 100),
(104, 1, 31, '60', 50, 5, 2, '1', 100, 44961, 0, '2020-07-19 00:46:00', '2020-07-16 20:46:14', '2020-07-19 00:46:00', 1, 100),
(105, 1, 29, '300', 50, 103, 1, '0', 100, 44952, 0, '2020-07-18 16:09:24', '2020-07-16 20:47:24', '2020-07-18 16:09:24', 1, 100),
(106, 1, 11, '50', 75, 20, 40, '0', 400, NULL, 1, '2020-07-25 14:44:24', '2020-07-18 02:34:18', '2020-07-25 14:44:24', 0, 0),
(107, 1, 19, '50', 250, 82, 40, '0', 780, 44979, 0, '2020-08-11 00:05:37', '2020-07-19 00:38:54', '2020-08-11 00:05:37', 0, 0),
(108, 1, 19, '50', 250, 82, 40, '1', 780, NULL, 0, '2020-07-20 23:00:16', '2020-07-19 00:47:42', '2020-07-20 23:00:16', 0, 0),
(109, 1, 100, '300', 100, 50, 10, '0', 500, 44618, 0, '2020-08-07 12:51:40', '2020-07-22 00:02:49', '2020-08-07 12:51:40', 1, 100),
(110, 9, 0, '100', 0, 0, 0, '0', 0, NULL, 0, '2020-07-24 15:46:57', '2020-07-24 02:03:38', '2020-07-24 15:46:57', 0, 0),
(111, 1, 19, '50', 150, 20, 40, '0', 750, 44999, 0, '2020-08-11 00:05:32', '2020-07-24 19:22:44', '2020-08-11 00:05:32', 0, 0),
(112, 1, 11, '50', 75, 20, 40, '0', 400, NULL, 1, '2020-07-25 14:43:43', '2020-07-18 02:34:18', '2020-07-25 14:43:43', 0, 0),
(113, 1, 11, '44', 77, 15, 33, '0', 300, 45044, 0, '2020-08-11 00:05:28', '2020-07-25 14:54:17', '2020-08-11 00:05:28', 0, 10),
(114, 14, 11, '111', 11, 1, 1, '0', 11, 44978, 0, '2020-08-09 01:47:42', '2020-07-27 15:53:11', '2020-08-09 01:47:42', 1, 100),
(115, 14, 11, '111', 21, 1, 1, '0', 21, 45041, 0, '2020-08-03 20:22:34', '2020-07-28 23:58:15', '2020-08-03 20:22:34', 0, 100),
(116, 1, 39, '50', 400, 20, 40, '0', 1450, 44995, 0, '2020-08-03 20:22:52', '2020-07-29 13:04:38', '2020-08-03 20:22:52', 0, 10),
(117, 11, 5, '11', 25, 3, 3, '1', 50, 45040, 0, '2020-08-11 00:05:21', '2020-07-29 23:03:03', '2020-08-11 00:05:21', 0, 0),
(118, 14, 11, '111', 11, 1, 1, '0', 11, 45033, 0, '2020-08-11 00:04:28', '2020-07-30 00:12:10', '2020-08-11 00:04:28', 1, 100),
(119, 1, 15, '25', 70, 8, 30, '0', 300, 44995, 0, '2020-08-03 20:21:48', '2020-07-30 18:12:46', '2020-08-03 20:21:48', 0, 0),
(121, 15, 9, '0', 9, 1, 1, '0', 0, NULL, 0, '2020-08-11 02:25:16', '2020-07-31 01:18:21', '2020-08-11 02:25:16', 0, 0),
(122, 6, 3999, '30', 10000, 10, 33, '1', 100000, NULL, 0, '2020-08-03 20:20:49', '2020-07-31 01:55:20', '2020-08-03 20:20:49', 0, 15),
(123, 6, 2999, '20', 10000, 5, 25, '1', 50000, NULL, 0, '2020-08-03 20:21:19', '2020-07-31 01:58:19', '2020-08-03 20:21:19', 0, 10),
(124, 6, 7777, '7', 10000, 5, 71, '1', 44000, NULL, 0, '2020-08-03 20:20:44', '2020-07-31 02:08:36', '2020-08-03 20:20:44', 0, 5),
(125, 6, 1390, '25', 10000, 10, 40, '1', 30000, NULL, 0, '2020-08-03 20:21:24', '2020-07-31 02:15:26', '2020-08-03 20:21:24', 0, 10),
(126, 6, 777, '7', 2222, 4, 57, '1', 4444, NULL, 0, '2020-08-03 20:22:58', '2020-07-31 02:21:23', '2020-08-03 20:22:58', 0, 10),
(127, 6, 999, '6', 3000, 2, 33, '1', 5000, NULL, 0, '2020-08-03 20:23:09', '2020-07-31 02:24:35', '2020-08-03 20:23:09', 0, 10),
(128, 6, 590, '10', 1000, 5, 50, '1', 5000, NULL, 0, '2020-08-03 20:23:05', '2020-07-31 02:26:40', '2020-08-03 20:23:05', 0, 10),
(129, 7, 3850, '3', 10000, 1, 33, '1', 10000, NULL, 0, '2020-08-03 20:20:54', '2020-07-31 18:18:35', '2020-08-03 20:20:54', 0, 0),
(130, 7, 1799, '4', 6000, 1, 25, '1', 6000, NULL, 0, '2020-08-03 20:21:14', '2020-07-31 18:20:08', '2020-08-03 20:21:14', 0, 5),
(131, 7, 1499, '4', 5000, 1, 33, '1', 5000, NULL, 0, '2020-08-03 20:21:55', '2020-07-31 18:21:37', '2020-08-03 20:21:55', 0, 5),
(132, 7, 1547, '3', 4000, 1, 33, '1', 4000, NULL, 0, '2020-08-03 20:21:09', '2020-07-31 18:23:00', '2020-08-03 20:21:09', 0, 5),
(133, 7, 899, '4', 3000, 1, 33, '1', 3000, NULL, 0, '2020-08-03 20:22:17', '2020-07-31 18:28:36', '2020-08-03 20:22:17', 0, 7),
(134, 7, 1150, '3', 3000, 1, 33, '1', 3000, NULL, 0, '2020-08-03 20:22:03', '2020-07-31 18:29:57', '2020-08-03 20:22:03', 0, 5),
(135, 14, 11, '50', 11, 1, 1, '0', 11, 45047, 0, '2020-08-11 00:05:15', '2020-07-31 19:46:18', '2020-08-11 00:05:15', 1, 100),
(136, 14, 21, '51', 21, 1, 1, '0', 21, NULL, 0, '2020-08-11 02:24:48', '2020-08-01 00:51:46', '2020-08-11 02:24:48', 1, 100),
(137, 1, 25, '222', 1000, 90, 40, '0', 4450, 44997, 0, '2020-08-11 00:04:39', '2020-08-03 10:56:24', '2020-08-11 00:04:39', 0, 0),
(138, 1, 11, '33', 90, 10, 30, '0', 300, 45155, 0, '2020-08-07 12:50:56', '2020-08-03 14:34:16', '2020-08-07 12:50:56', 0, 0),
(139, 1, 11, '33', 90, 10, 33, '0', 300, 45169, 0, '2020-08-07 12:50:49', '2020-08-03 15:13:33', '2020-08-07 12:50:49', 0, 0),
(140, 14, 55, '100', 70, 3, 3, '0', 100, 44997, 1, '2020-08-11 00:04:45', '2020-08-03 22:06:38', '2020-08-11 00:04:45', 1, 100),
(141, 9, 0, '150', 15, 1, 1, '0', 15, 44997, 0, '2020-08-11 00:05:07', '2020-08-04 11:28:33', '2020-08-11 00:05:07', 0, 0),
(142, 9, 0, '500', 11, 1, 1, '0', 11, 44625, 0, '2020-08-11 00:05:03', '2020-08-05 01:54:56', '2020-08-11 00:05:03', 0, 0),
(143, 1, 25, '111', 600, 40, 40, '0', 2200, 44625, 0, '2020-08-11 00:04:59', '2020-08-05 02:05:41', '2020-08-11 00:04:59', 0, 0),
(144, 14, 21, '100', 21, 1, 1, '0', 51, 44625, 0, '2020-08-11 00:04:54', '2020-08-01 00:51:46', '2020-08-11 00:04:54', 1, 100),
(145, 15, 5, '0', 5, 1, 1, '0', 5, NULL, 0, '2020-08-11 21:17:38', '2020-08-11 00:06:37', '2020-08-11 21:17:38', 0, 0),
(146, 1, 25, '20', 60, 7, 33, '0', 250, 45265, 0, NULL, '2020-08-11 21:24:29', '2020-08-12 12:41:47', 0, 30),
(147, 14, 31, '51', 31, 2, 1, '0', 51, NULL, 0, '2020-08-19 01:19:25', '2020-08-14 23:43:59', '2020-08-19 01:19:25', 1, 100),
(148, 14, 55, '100', 75, 2, 1, '0', 100, 45116, 1, '2020-08-19 01:19:33', '2020-08-15 00:33:54', '2020-08-19 01:19:33', 1, 100),
(149, 1, 35, '111', 700, 45, 60, '0', 3000, 44629, 0, NULL, '2020-08-15 11:39:17', '2020-08-28 18:03:20', 0, 0),
(150, 5, 9, '2', 15, 1, 50, '1', 15, 45116, 0, NULL, '2020-08-18 20:53:32', '2020-08-18 20:53:32', 0, 0),
(151, 5, 9, '2', 15, 1, 50, '1', 15, 45116, 0, NULL, '2020-08-18 20:53:53', '2020-08-18 20:53:53', 0, 0),
(152, 1, 10, '21', 21, 1, 1, '0', 21, 45117, 0, '2020-08-18 21:44:12', '2020-08-18 21:43:52', '2020-08-18 21:44:12', 0, 90),
(153, 14, 51, '61', 51, 2, 1, '0', 71, NULL, 0, '2020-08-20 02:54:36', '2020-08-19 01:21:37', '2020-08-20 02:54:36', 1, 100),
(154, 3, 99, '10', 790, 2, 10, '0', 890, 45118, 0, '2020-08-19 02:14:29', '2020-08-19 01:55:15', '2020-08-19 02:14:29', 0, 0),
(155, 3, 99, '10', 790, 2, 10, '0', 890, 45118, 0, '2020-08-19 02:14:09', '2020-08-19 01:55:45', '2020-08-19 02:14:09', 0, 0),
(156, 3, 99, '10', 650, 2, 20, '0', 889, 44629, 0, NULL, '2020-08-19 02:01:20', '2020-08-28 18:01:17', 0, 5),
(157, 13, 10, '21', 21, 1, 1, '0', 21, 45117, 0, '2020-08-19 02:09:04', '2020-08-19 02:02:02', '2020-08-19 02:09:04', 0, 90),
(158, 14, 51, '100', 51, 10, 10, '0', 171, NULL, 0, '2020-08-20 13:25:54', '2020-08-20 03:00:04', '2020-08-20 13:25:54', 1, 100),
(159, 1, 50, '111', 650, 50, 50, '0', 2725, 45120, 0, NULL, '2020-08-20 03:09:58', '2020-08-20 03:09:58', 0, 50),
(160, 1, 25, '20', 100, 8, 67, '0', 405, 45120, 0, NULL, '2020-08-20 17:03:46', '2020-08-20 17:03:46', 0, 0),
(161, 1, 50, '111', 650, 50, 50, '0', 2725, 45124, 0, NULL, '2020-08-20 03:09:58', '2020-08-21 10:41:31', 0, 50),
(162, 1, 25, '41', 300, 16, 50, '0', 890, 45376, 0, NULL, '2020-08-21 13:23:33', '2020-08-28 17:41:06', 0, 0),
(163, 1, 10, '21', 21, 1, 1, '0', 21, 45321, 0, NULL, '2020-08-23 20:19:55', '2020-08-23 20:19:55', 0, 90),
(164, 1, 10, '31', 31, 1, 1, '0', 31, 45330, 0, NULL, '2020-08-24 13:51:38', '2020-08-24 13:51:38', 0, 90),
(165, 1, 29, '111', 750, 45, 50, '0', 2575, 45128, 0, NULL, '2020-08-24 15:52:12', '2020-08-26 10:52:34', 0, 0),
(166, 11, 2, '131', 180, 1, 90, '0', 180, NULL, 0, '2020-08-28 00:02:58', '2020-08-28 00:01:41', '2020-08-28 00:02:58', 0, NULL),
(167, 11, 2, '131', 180, 1, 90, '1', 180, NULL, 0, NULL, '2020-08-28 00:02:01', '2020-08-28 00:02:24', 0, 0),
(168, 11, 1, '222', 180, 1, 90, '1', 180, NULL, 0, NULL, '2020-08-28 00:10:27', '2020-08-28 00:10:27', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `device_details`
--

CREATE TABLE `device_details` (
  `id` int(11) NOT NULL,
  `platform` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `robot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `robotName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `request` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `error_logs`
--

CREATE TABLE `error_logs` (
  `id` int(10) NOT NULL,
  `url` text,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `error_type` varchar(255) DEFAULT NULL,
  `file` text,
  `statusCode` varchar(255) DEFAULT NULL,
  `log` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventLogs`
--

CREATE TABLE `eventLogs` (
  `id` int(11) NOT NULL,
  `signature` text,
  `match_id` int(11) DEFAULT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `date_time` varchar(255) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `eventLog` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `storage_permission` varchar(255) DEFAULT '0',
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fielder_statistic`
--

CREATE TABLE `fielder_statistic` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED NOT NULL,
  `fielder_id` int(11) UNSIGNED DEFAULT NULL,
  `fielder_name` varchar(255) DEFAULT NULL,
  `catches` varchar(255) DEFAULT NULL,
  `runout_thrower` int(11) DEFAULT NULL,
  `runout_catcher` int(11) DEFAULT NULL,
  `runout_direct_hit` int(11) DEFAULT NULL,
  `stumping` int(11) DEFAULT NULL,
  `is_substitute` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fows_statistics`
--

CREATE TABLE `fows_statistics` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED NOT NULL,
  `fielder_id` int(11) UNSIGNED DEFAULT NULL,
  `fielder_name` varchar(255) DEFAULT NULL,
  `catches` varchar(255) DEFAULT NULL,
  `runout_thrower` int(11) DEFAULT NULL,
  `runout_catcher` int(11) DEFAULT NULL,
  `runout_direct_hit` int(11) DEFAULT NULL,
  `stumping` int(11) DEFAULT NULL,
  `is_substitute` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hardware_infos`
--

CREATE TABLE `hardware_infos` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `device_details` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `innings_scores`
--

CREATE TABLE `innings_scores` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `iid` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scores` varchar(255) DEFAULT NULL,
  `scores_full` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `join_contests`
--

CREATE TABLE `join_contests` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `contest_id` int(11) UNSIGNED DEFAULT NULL,
  `created_team_id` int(11) UNSIGNED DEFAULT NULL,
  `teams` text,
  `team_count` varchar(255) NOT NULL DEFAULT 'T1',
  `ranks` int(11) DEFAULT '0',
  `points` float(10,2) NOT NULL DEFAULT '0.00',
  `prize_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `winning_amount` int(11) NOT NULL DEFAULT '0',
  `cancel_contest` tinyint(1) NOT NULL DEFAULT '0',
  `affiliated_user` int(11) DEFAULT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `pid` int(11) UNSIGNED DEFAULT NULL,
  `team_id` int(11) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `short_title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `format` tinyint(1) DEFAULT NULL,
  `format_str` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `status_str` varchar(255) DEFAULT NULL,
  `status_note` varchar(255) DEFAULT NULL,
  `verified` varchar(255) DEFAULT NULL,
  `pre_squad` varchar(255) NOT NULL,
  `odds_available` varchar(255) DEFAULT NULL,
  `game_state` tinyint(1) NOT NULL DEFAULT '0',
  `game_state_str` varchar(255) NOT NULL,
  `domestic` tinyint(1) DEFAULT '0',
  `competition_id` int(11) UNSIGNED DEFAULT NULL,
  `teama_id` int(11) UNSIGNED DEFAULT NULL,
  `teamb_id` int(11) DEFAULT NULL,
  `date_start` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL,
  `timestamp_start` int(11) NOT NULL,
  `timestamp_end` int(11) NOT NULL,
  `venue_id` int(11) UNSIGNED DEFAULT NULL,
  `umpires` varchar(255) DEFAULT NULL,
  `referee` varchar(255) DEFAULT NULL,
  `equation` varchar(255) DEFAULT NULL,
  `live` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `result_type` varchar(255) DEFAULT NULL,
  `win_margin` varchar(255) DEFAULT NULL,
  `winning_team_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `commentary` tinyint(1) NOT NULL DEFAULT '0',
  `wagon` tinyint(1) NOT NULL DEFAULT '0',
  `latest_inning_number` tinyint(4) DEFAULT NULL,
  `toss_id` int(11) UNSIGNED DEFAULT NULL,
  `current_status` tinyint(1) NOT NULL DEFAULT '0',
  `is_cancelled` tinyint(1) NOT NULL DEFAULT '0',
  `upload_type` varchar(255) DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `match_contents`
--

CREATE TABLE `match_contents` (
  `id` int(11) NOT NULL,
  `match_id` int(11) DEFAULT NULL,
  `content` longtext,
  `method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `match_player_points`
--

CREATE TABLE `match_player_points` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `pid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT '0.0',
  `point` varchar(255) NOT NULL DEFAULT '0',
  `starting11` varchar(255) DEFAULT '0',
  `run` varchar(255) NOT NULL DEFAULT '0',
  `four` varchar(255) NOT NULL DEFAULT '0',
  `six` varchar(255) NOT NULL DEFAULT '0',
  `sr` varchar(255) NOT NULL DEFAULT '0',
  `fifty` varchar(255) NOT NULL DEFAULT '0',
  `duck` varchar(255) NOT NULL DEFAULT '0',
  `wkts` varchar(255) NOT NULL DEFAULT '0',
  `maidenover` varchar(255) NOT NULL DEFAULT '0',
  `er` varchar(255) NOT NULL DEFAULT '0',
  `catch` varchar(255) NOT NULL DEFAULT '0',
  `runoutstumping` varchar(255) NOT NULL DEFAULT '0',
  `runoutthrower` varchar(255) NOT NULL DEFAULT '0',
  `runoutcatcher` varchar(255) NOT NULL DEFAULT '0',
  `directrunout` varchar(255) NOT NULL DEFAULT '0',
  `stumping` varchar(255) NOT NULL DEFAULT '0',
  `thirty` varchar(255) NOT NULL DEFAULT '0',
  `bonus` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `match_scores`
--

CREATE TABLE `match_scores` (
  `id` bigint(20) NOT NULL,
  `iid` bigint(20) DEFAULT '0',
  `match_id` bigint(20) DEFAULT NULL,
  `number` int(11) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `batting_team_id` bigint(20) NOT NULL DEFAULT '0',
  `fielding_team_id` bigint(20) NOT NULL DEFAULT '0',
  `scores` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `scores_full` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `batsmen` bigint(20) NOT NULL DEFAULT '0',
  `bowlers` bigint(20) NOT NULL DEFAULT '0',
  `fielder` bigint(20) NOT NULL DEFAULT '0',
  `fows` bigint(20) NOT NULL DEFAULT '0',
  `last_wicket` text COLLATE utf8_unicode_ci,
  `extra_runs` text COLLATE utf8_unicode_ci,
  `equations` text COLLATE utf8_unicode_ci,
  `current_partnership` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `match_stats`
--

CREATE TABLE `match_stats` (
  `id` int(10) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `points` float(10,2) DEFAULT '0.00',
  `ranking` int(11) NOT NULL DEFAULT '0',
  `join_contest_id` bigint(20) DEFAULT NULL,
  `contest_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mega_data`
--

CREATE TABLE `mega_data` (
  `id` int(11) NOT NULL,
  `match_id` int(11) DEFAULT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `join_contest_id` int(11) DEFAULT NULL,
  `created_team_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `route_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `parent_id`, `route_name`, `action`, `url`, `display_order`, `created_at`, `updated_at`) VALUES
(12, 'user', 0, NULL, NULL, NULL, NULL, '2020-04-14 16:53:47', '2020-04-17 21:06:45'),
(13, 'match', 0, NULL, NULL, NULL, NULL, '2020-04-14 16:54:03', '2020-04-17 20:26:12'),
(14, 'Create User', 12, NULL, NULL, NULL, NULL, '2020-04-14 16:54:15', '2020-04-14 17:19:41'),
(15, 'Show  All Match', 13, NULL, NULL, NULL, NULL, '2020-04-14 16:54:34', '2020-04-14 17:36:27'),
(16, 'Show Users', 12, NULL, NULL, NULL, NULL, '2020-04-14 16:56:02', '2020-04-14 17:21:34'),
(19, 'program', 0, NULL, NULL, NULL, NULL, '2020-04-17 20:18:20', '2020-04-17 20:26:22'),
(20, 'Create Program', 19, NULL, NULL, NULL, NULL, '2020-04-17 20:18:38', '2020-04-17 20:19:49'),
(21, 'View Program', 19, NULL, NULL, NULL, NULL, '2020-04-17 20:18:54', '2020-04-17 20:19:34'),
(22, 'banner', 0, NULL, NULL, NULL, NULL, '2020-04-17 20:20:30', '2020-04-17 20:20:30'),
(23, 'Create Banner', 22, NULL, NULL, NULL, NULL, '2020-04-17 20:20:44', '2020-04-17 20:20:44'),
(24, 'Show Banner', 22, NULL, NULL, NULL, NULL, '2020-04-17 20:20:52', '2020-04-17 20:20:52'),
(25, 'defaultContest', 0, NULL, NULL, NULL, NULL, '2020-04-17 20:21:39', '2020-04-17 20:21:39'),
(26, 'Create DefaultContest', 25, NULL, NULL, NULL, NULL, '2020-04-17 20:22:06', '2020-04-17 20:22:06'),
(27, 'Show DefaultContest', 25, NULL, NULL, NULL, NULL, '2020-04-17 20:22:15', '2020-04-17 20:22:15'),
(28, 'contestType', 0, NULL, NULL, NULL, NULL, '2020-04-17 20:22:33', '2020-04-17 20:22:33'),
(29, 'Create Contest Type', 28, NULL, NULL, NULL, NULL, '2020-04-17 20:22:53', '2020-04-17 20:22:53'),
(30, 'Show contestType', 28, NULL, NULL, NULL, NULL, '2020-04-17 20:23:05', '2020-04-17 20:23:05'),
(31, 'apkUpdate', 0, NULL, NULL, NULL, NULL, '2020-04-17 20:23:27', '2020-04-17 20:23:27'),
(32, 'Create Apk', 31, NULL, NULL, NULL, NULL, '2020-04-17 20:23:43', '2020-04-17 20:23:43'),
(33, 'Show Apk', 31, NULL, NULL, NULL, NULL, '2020-04-17 20:23:53', '2020-04-17 20:23:53'),
(34, 'content', 0, NULL, NULL, NULL, NULL, '2020-04-17 20:24:42', '2020-04-17 20:24:42'),
(35, 'Create Page', 34, NULL, NULL, NULL, NULL, '2020-04-17 20:24:57', '2020-04-17 20:24:57'),
(36, 'Show page', 34, NULL, NULL, NULL, NULL, '2020-04-17 20:25:14', '2020-04-17 20:25:14'),
(37, 'setting', 0, NULL, NULL, NULL, NULL, '2020-04-17 20:27:27', '2020-04-17 20:27:27'),
(38, 'Website Settings', 37, NULL, NULL, NULL, NULL, '2020-04-17 20:27:55', '2020-04-17 20:27:55'),
(44, 'updatePlayerPoints', 0, NULL, NULL, NULL, NULL, '2020-04-22 21:35:35', '2020-04-22 21:35:35'),
(45, 'Create Player Points', 44, NULL, NULL, NULL, NULL, '2020-04-22 21:35:47', '2020-04-22 21:35:47'),
(46, 'View  Player Points', 44, NULL, NULL, NULL, NULL, '2020-04-22 21:36:01', '2020-04-22 21:36:01'),
(47, 'prizeDistribution', 0, NULL, NULL, NULL, NULL, '2020-04-26 13:04:49', '2020-04-26 13:04:49'),
(48, 'View Prize List', 47, NULL, NULL, NULL, NULL, '2020-04-26 13:05:16', '2020-04-26 13:05:16'),
(49, 'payments', 0, NULL, NULL, NULL, NULL, '2020-04-26 13:05:42', '2020-04-26 13:05:42'),
(50, 'Withdraw Request', 49, NULL, NULL, NULL, NULL, '2020-04-26 13:05:56', '2020-04-26 13:05:56'),
(51, 'paymentsHistory', 0, NULL, NULL, NULL, NULL, '2020-04-26 13:06:21', '2020-04-26 13:06:21'),
(52, 'Payment History', 51, NULL, NULL, NULL, NULL, '2020-04-26 13:06:49', '2020-04-26 13:06:49'),
(53, 'documents', 0, NULL, NULL, NULL, NULL, '2020-04-26 13:07:05', '2020-04-26 13:07:05'),
(54, 'Verify Documents', 53, NULL, NULL, NULL, NULL, '2020-04-26 13:07:24', '2020-04-26 13:07:24'),
(55, 'bankAccount', 0, NULL, NULL, NULL, NULL, '2020-04-26 13:07:41', '2020-04-26 13:07:41'),
(56, 'Account Details', 55, NULL, NULL, NULL, NULL, '2020-04-26 13:07:59', '2020-04-26 13:07:59'),
(57, 'notification', 0, 'notification', 'index', '/admin/notification', 1, '2020-05-30 02:45:19', '2020-05-29 21:16:45'),
(58, 'Notification', 57, 'notification', 'index', '/admin/notification', 1, '2020-05-30 02:47:36', '2020-05-30 02:47:36'),
(59, 'Create', 57, 'notification', 'create', '/admin/notification/create', 2, '2020-05-30 02:48:15', '2020-05-30 02:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `metas`
--

CREATE TABLE `metas` (
  `id` int(11) NOT NULL,
  `meta_title` text,
  `meta_key` text,
  `meta_description` text,
  `url` text,
  `slug` text,
  `page_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metas`
--

INSERT INTO `metas` (`id`, `meta_title`, `meta_key`, `meta_description`, `url`, `slug`, `page_id`, `updated_at`, `created_at`) VALUES
(2, 'services2', 'services3', 'services3', 'services2 fdsf', 'services2 sdfdsf', 1, '2018-07-23 15:09:04', '2018-07-23 18:55:56'),
(3, 'services', 'services', 'services', 'services', 'services', 2, '2018-07-23 18:56:29', '2018-07-23 18:56:29');

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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_16_095517_create_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_contacts`
--

CREATE TABLE `mobile_contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile_numer` varchar(255) DEFAULT NULL,
  `details` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mobile_otp`
--

CREATE TABLE `mobile_otp` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `timezone` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `message_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notified_user` int(11) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL COMMENT 'eg. task id, Comment id',
  `entity_type` enum('task_add','task_update','task_delete','comment_add','comment_replied','comment_delete','user_register','offers_add','offers_update','offers_delete') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'eUhYfmN6HAoTYMhvLi58wTPzJT9mThyeQrXtlbKx', 'http://localhost', 1, 0, 0, '2020-03-22 03:56:12', '2020-03-22 03:56:12'),
(2, NULL, 'Laravel Password Grant Client', 'S98f9DlmIwn8gwg7k8GVKbYtgRqZY6NCk3RUraDd', 'http://localhost', 0, 1, 0, '2020-03-22 03:56:12', '2020-03-22 03:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-03-22 03:56:12', '2020-03-22 03:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `deposit_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `offer_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_percent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_fixed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `validity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `deposit_amount`, `offer_amount`, `discount_percent`, `discount_fixed`, `status`, `validity`, `created_at`, `updated_at`) VALUES
(1, '500', '625', '25', '125', 1, '30', '2020-08-25 09:25:29', '2020-08-25 09:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `page_content` longtext,
  `slug` text,
  `url` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_key` text,
  `meta_description` text,
  `images` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `page_content`, `slug`, `url`, `meta_title`, `meta_key`, `meta_description`, `images`, `created_at`, `updated_at`) VALUES
(9, 'Privacy Policy', '<h3 dir=\"ltr\">&nbsp;</h3>\r\n\r\n<p>This Privacy Policy describes the way in which the&nbsp;<strong>Sportsfight</strong>&nbsp;group company or companies that provide the careers website and those to which you apply for a position (otherwise referred to as &quot;<strong>we</strong>&quot;, &quot;<strong>us</strong>&quot;, &ldquo;<strong>our</strong>&rdquo; or &ldquo;<strong>sportsfight</strong>&rdquo;) deal with the information and data you provide to us to enable us to manage your relationship with sportsfight. We will process any personal information provided to us or otherwise held by us relating to you in the manner set out in this Privacy Policy. Information may be provided via the&nbsp;<strong>sportsfight</strong>&nbsp;website (the &quot;Website&quot;), telephone calls or any other means. By accepting this Privacy Policy you agree that you understand and accept the use of your personal information as set out in this Privacy Policy. If you do not agree with the terms of this Privacy Policy please do not use the Website or otherwise provide us with your personal information.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Purpose and Usage:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To avail certain Services on the Portal, Users would be required to provide certain information for the registration process namely:</p>\r\n\r\n<p>1. Username</p>\r\n\r\n<p>2. Password</p>\r\n\r\n<p>3. Email address&nbsp;</p>\r\n\r\n<p>4. Mobile Number&nbsp;</p>\r\n\r\n<p>5. Date of Birth&nbsp;&nbsp;</p>\r\n\r\n<p>In the course of providing you with access to the Services , and in order to provide you access to the features offered through the Portal and to verify your identity, you may be required to furnish additional information, including your Permanent Account Number.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In certain instances, we may also collect Sensitive Personal Information (&ldquo;SPI&rdquo;) from you on the Portal. SPI means such personal information which consists of information relating to your physical, physiological and mental health condition; medical records and history; biometric information, sexual orientation and financial information, such as information regarding the payment instrument/modes used by you to make such payments, which may include cardholder name, credit/debit card number (in encrypted form) with expiration date, banking details, wallet details etc. This information is presented to you at the time of making a payment to enable you to complete your payment expeditiously.</p>\r\n\r\n<p>Except for any financial information that you choose to provide while making payment for any Services on the Portal, Sportsfight does not collect any other SPI in the course of providing the Services . Any SPI collected by Sportsfight&nbsp; shall not be disclosed to any third party without your express consent, save as otherwise set out in this Privacy Policy or as provided in a separate written agreement between Sportsfight and you or as required by law. It is clarified that this condition shall not apply to publicly available information, including SPI, in relation to you on the Portal.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the course of providing the Services , Users may invite other existing Users or other users (&quot;Invited Users&quot;) to participate in any of the Services by providing the email address. Sportsfight may thereafter use this information to contact the Invited User and invite such user to register with Sportsfight&nbsp; (if such Invited User is not an existing User) and participate in the Game in relation to which such person was invited by the User. The participation of the Invited User in any of the Gameshall be subject to the terms of this Privacy Policy and the Terms and Conditions for the use of the Portal. The User hereby represents that the Invited Users have consented and agreed to such disclosure to and use of their email address.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>All required information is specific and based on the kind of Game/ Services the User wishes to participate in or access, and will be utilized for the purpose of providing services, including but not limited to the Services requested by the User. The information as supplied by the Users enables us to improve the Services and provide you the most user-friendly game experience.</p>\r\n\r\n<p>Sportsfight may also share such information with affiliates and third parties in limited circumstances, including for the purpose of providing services requested by the User, complying with legal process, preventing fraud or imminent harm, and ensuring the security of our network and services.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Disclosure/Sharing:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may also share information as provided by you and data concerning usage of the Services and participation in the Games with third party service providers engaged by Sportsfight, for the purpose of data analytics or other similar purposes, for the purpose of storage, improving the services and helping Sportsfight serve you better.</p>\r\n\r\n<p>Where we propose to use your personal information (that is, information that that may be used to identify the User and that is not otherwise publicly available) for any other uses we will ensure that we notify you first. You will also be given the opportunity to withhold or withdraw your consent for your use other than as listed above.</p>\r\n\r\n<p>By using the Portal, you hereby expressly agree and grant consent to the collection, use and storage of this information by Sportsfight. Sportsfight reserves the right to share, disclose and transfer information collected hereunder with its own affiliates. In the event Sportsfight sells or transfers all or a portion of its business assets, consumer information may be one of the business assets that are shared, disclosed or transferred as part of the transaction. You hereby expressly grant consent and permission to Sportsfight for disclosure and transfer of information to such third parties. Sportsfight may share information as provided by you and data concerning usage of the Services and participation in the Game with its commercial partners for the purpose of facilitating user engagement, for marketing and promotional purposes and other related purposes. Further, Sportsfight reserves the right to disclose personal information as obligated by law, in response to duly authorized legal process, governmental requests and as necessary to protect the rights and interests of Sportsfight.</p>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Use of Cookies:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To improve the effectiveness and usability of the Portal for our Users, we use &quot;cookies&quot;, or such similar electronic tools to collect information to assign each visitor a unique random number as a User Identification (User ID) to understand the User&#39;s individual interests using the identified computer. Unless the User voluntarily identifies himself/herself (e.g., through registration), Sportsfight has no way of knowing who the User is, even if we assign a cookie to the User&#39;s computer. The only personal information a cookie can contain is information supplied by the User. A cookie cannot read data off the User&#39;s hard drive. Sportsfight advertisers may also assign their own cookies to the User&#39;s browser (if the User clicks on their ad banners), a process that Sportsfight does not control.</p>\r\n\r\n<p>Sportsfight web servers automatically collect limited information about User&#39;s computer&#39;s connection to the Internet, including User&#39;s IP address, when the User visits the Portal. (User&#39;s IP address is a number that lets computers attached to the Internet know where to send data to the User -- such as the web pages viewed by the User). The User&#39;s IP address does not identify the User personally. Sportsfight uses this information to deliver its web pages to Users upon request, to tailor its Portal to the interests of its users, to measure traffic within the Portal and let advertisers know the geographic locations from where Sportsfight visitors come.</p>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Links:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight also includes links to other websites. Such websites are governed by their respective privacy policies, which are beyond Sportsfight control. Once the User leaves Sportsfight servers (the User can tell where he/she is by checking the URL in the location bar on the User&#39;s browser), use of any information provided by the User is governed by the privacy policy of the operator of the site which the User is visiting. That policy may differ from Sportsfight own. If the User can&#39;t find the privacy policy of any of these sites via a link from the site&#39;s homepage, the User may contact the site directly for more information. Sportsfight is not responsible for the privacy practices or the content of such websites.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Security Procedures:</strong></p>\r\n\r\n<p>All information gathered on Sportsfight is securely stored within Sportsfight controlled database. The database is stored on servers secured behind a firewall; access to such servers being password-protected and strictly limited based on need-to-know basis. However, we understand that as effective as our security measures are, no security system is impenetrable. Thus, we cannot guarantee the security of our database, nor can we guarantee that information you supply will not be intercepted while being transmitted to us over the Internet. Further, any information you include in a posting to the discussion areas will be available to anyone with Internet access. By using the Portal, you understand and agree that your information may be used in or transferred to countries other than India.</p>\r\n\r\n<p>Sportsfight also believes that the internet is an ever-evolving medium. We may periodically review from time to time and change our privacy policy to incorporate such future changes as may be considered appropriate, without any notice to you. Our use of any information we gather will always be consistent with the policy under which the information was collected, regardless of what the new policy may be. Any changes to our privacy policy will be posted on this page, so you are always aware of what information we collect, how we use it, how we store it and under what circumstances we disclose it.</p>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Advertising:</strong></p>\r\n\r\n<p>When Sportsfight presents information to it&#39;s online advertisers -- to help them understand our audience and confirm the value of advertising on the Portal -- it is usually in the form of aggregated statistics on traffic to various pages within our site. When you register with Sportsfight, we contact you from time to time about updating your content to provide features which we believe may benefit you.</p>\r\n\r\n<p>Several deceptive emails, websites, blogs etc. claiming to be from or associated with Sportsfight may or are circulating on the Internet. These emails, websites, blogs etc. often include our logo, photos, links, content or other information. Some emails, websites, blogs etc. call the user to provide login name, password etc. or that the user has won a prize/ gift or provide a method to commit illegal/ unauthorized act or deed or request detailed personal information or a payment of some kind. The sources and contents of these emails, websites, blogs etc. and accompanying materials are in no way associated with Sportsfight. For your own protection, we strongly recommend not responding to emails or using websites, blogs etc. We may use the information provided by you to Sportsfight, including your email address or phone number, to contact you about the Services availed by you or to inform you of our updated Services if any.</p>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Conditions of Use:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight DOES NOT WARRANT THAT THIS PORTAL, IT&rsquo;S SERVERS, OR EMAIL SENT BY US OR ON OUR BEHALF ARE VIRUS FREE. Sportsfight WILL NOT BE LIABLE FOR ANY DAMAGES OF ANY KIND ARISING FROM THE USE OF THIS PORTAL, INCLUDING, BUT NOT LIMITED TO COMPENSATORY, DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, SPECIAL AND CONSEQUENTIAL DAMAGES, LOSS OF DATA, GOODWILL, BUSINESS OPPORTUNITY, INCOME OR PROFIT, LOSS OF OR DAMAGE TO PROPERTY AND CLAIMS OF THIRD PARTIES. IN NO EVENT WILL Sportsfight BE LIABLE FOR ANY DAMAGES WHATSOEVER IN AN AMOUNT IN EXCESS OF AN AMOUNT OF INR 100.</p>\r\n\r\n<p><br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Retention of Data:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Your personal information may be retained and may continue to be used until: (i) the relevant purposes for the use of your information described in this Privacy Policy are no longer applicable; and (ii) we are no longer required by applicable law, regulations, contractual obligations or legitimate business purposes to retain your personal information and the retention of your personal information is not required for the establishment, exercise or defense of any legal claim.</p>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Applicable Law and Jurisdiction:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>By visiting this Portal, you agree that the laws of the Republic of India without regard to its conflict of laws principles, govern this Privacy Policy and any dispute arising in respect hereof shall be subject to and governed by the dispute resolution process set out in the&nbsp;<a href=\"https://sportsfight.in/terms-and-conditions\"><strong>Terms and Conditions</strong></a><strong>.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Updating Information:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You will promptly notify Sportsfight if there are any changes, updates or modifications to your information. Further, you may also review, update or modify your information and user preferences by logging into your Profile page on the Portal.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Contact Us:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any questions or clarifications with respect to this Policy or any complaints, comments, concerns or feedback can be sent to Sportsfight at:&nbsp;info@sportsfight.com&nbsp;or by normal/physical mail addressed to:</p>\r\n\r\n<p>Attn: Sportsfight Team</p>\r\n\r\n<p>House No 23 , Phase 3, Lotus City , Parshada Village , Kumhari&nbsp;</p>\r\n\r\n<p>Raipur ,490042 Chattisgarh , India.</p>\r\n\r\n<p>&nbsp;</p>', 'privacy-policy', 'privacy-policy', 'Privacy Policy', NULL, '<h3 dir=\"ltr\">&nbsp;</h3>\r\n\r\n<p>This Privacy Policy describes the way in which the&nbsp;<strong>Sportsfight</strong>&nbsp;group company or companies that provide the careers website and those to which you apply for a position (otherwise referred to as &quot;<strong>we</strong>&quot;, &quot;<strong>us</strong>&quot;, &ldquo;<strong>our</strong>&rdquo; or &ldquo;<strong>sportsfight</strong>&rdquo;) deal with the information and data you provide to us to enable us to manage your relationship with sportsfight. We will process any personal information provided to us or otherwise held by us relating to you in the manner set out in this Privacy', NULL, '2018-08-08 21:42:12', '2020-07-08 16:13:20'),
(13, 'About Us', '<p>&nbsp;</p>\r\n\r\n<p><strong>Sportsfight Fantasy League</strong></p>\r\n\r\n<p><strong>About Us </strong></p>\r\n\r\n<p>We drive one of the biggest virtual yet fancy sports platform. Also, we help you set-up your fan base by keeping a watch over shared posts in the feed. Not just this, but here you can enhance your performance by playing more to reach the next best level along with exciting cash rewards. Here you can create a team choosing your favourite players which help you gain more coins in any contest. Sportfight Fantasy League is a stage that permits you to play virtually opting amongst real-life players and earn points using your game expertise and knowledge</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Our Features</strong></p>\r\n\r\n<p><strong>Easy To Join Contest</strong></p>\r\n\r\n<p>Sportsfight Fantasy League allows you to participate in the fantasy sports where you can quickly level up your performance choosing your dream players. As you are just a step away from the contest, So, buy the entry ticket and get yourself enrolled for the upcoming contest just in a few clicks.</p>\r\n\r\n<p><strong>High Speedy App</strong></p>\r\n\r\n<p>Download the Sportsfight app to access exciting features easily. Also, the app is super easy to use as it fastens the speed so download it to win your cash rewards a few clicks away. Besides this, get instant notifications, offers and promotions in regards to your fantasy sport, upcoming contests, dream player, and so forth.</p>\r\n\r\n<p><strong>Full Protection</strong></p>\r\n\r\n<p>We understand safety measures, and that is why we make each participant register with their verified email address or phone number. Or you can log with your current Facebook or Google account as well. It will help check the user&rsquo;s details for undertaking further procedures. Do not worry, as your details are safe with us and we do not share it with any third party without your consent.</p>\r\n\r\n<p><strong>Easy To Withdraw</strong></p>\r\n\r\n<p>Sportsfight Fantasy League is a dream come true for the users, as they get an excellent chance to choose their ideal players alongside you can even earn points by winning the contest or a bonus by inviting a friend. After winning users switch to withdraw the earnings, with an easy withdrawal request procedure. As soon as the withdrawal request gets approved, your registered bank account will be verified to transfer the earnings into your account.</p>\r\n\r\n<p><strong>Our Works</strong></p>\r\n\r\n<p>We are here to help you generate income out of your interest by serving you with the best fantasy sports opportunity. We help accomplish your dream of playing a digital sport picking your favourite players with a live Leadership board to track top winners performances. Along with this, we undertake the fan code by serving you the hands-on experience over your prediction via fantasy sport.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Our Steps</strong></p>\r\n\r\n<p>Check Out Contest For the League</p>\r\n\r\n<p>You are allowed to check over the participating teams based on the previous match listings, and you can also check the entry ticket amount</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Create your Best Team</strong></p>\r\n\r\n<p>Sportsfight gives you an opportunity to organize the best team, choosing from real-life players and get paid for your knowledge &amp; expertise by winning the cash rewards.</p>\r\n\r\n<p><strong>Pay Small and Win Big</strong></p>\r\n\r\n<p>Pay small and win big is the concept of winning a considerable amount by taking part in the contest with a small token of entry amount. Not just this, but also all the participants are getting rewarded based on their ranks.</p>', 'about-us', 'about-us', 'About Us', NULL, '<p dir=\"ltr\" style=\"text-align:center\"><strong>Sportsfight Fantasy League</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p dir=\"ltr\"><strong>About Us</strong></p>\r\n\r\n<p dir=\"ltr\">&nbsp;</p>\r\n\r\n<p dir=\"ltr\"><span style=\"background-color:transparent; color:rgb(0, 0, 0); font-family:times new roman; font-size:12pt\">We drive one of the biggest virtuals yet fancy sports platforms. Also, we help you set-up your fan base by keeping a watch over shared posts in the feed. Not just this, but here you can enhance your performance by playing more to reach the next best level along with exciting rewards. Here you can create a team choosing your favourite players along with', NULL, '2018-08-08 21:46:56', '2020-04-24 00:38:34'),
(17, 'FAQs', '<p><strong>Q1 &ndash; What types of payment modes are accepted?</strong><br />\r\nAns: You can choose either of these options<br />\r\nPayTM or Google Pay</p>\r\n\r\n<p><strong>Q2 &ndash; How To Play Fantasy Cricket and Win Cash Daily?</strong><br />\r\n<strong>Ans:</strong>&nbsp;The definitions of these are as follows:</p>\r\n\r\n<p><strong>Selecting the Match -&nbsp;</strong></p>\r\n\r\n<p>Once you head to the cricket page, you&#39;ll see a list of upcoming cricket matches that you can participate in. Pick the match that suits you want to play.</p>\r\n\r\n<p><strong>Creating a Team -&nbsp;</strong></p>\r\n\r\n<p>After you&#39;ve selected a match, it&#39;s time to put your sports knowledge and analytical skills to good use by picking the right team. This is critical as creating the best team will help you win bigger rewards in Cash Contests.</p>\r\n\r\n<p><strong>Cash Contests -&nbsp;</strong></p>\r\n\r\n<p>Once you&#39;ve created your team, you will be redirected to the contests page. Select a Cash Contest that fits your budget. You can also test your skills in Practice Contests. That&#39;s it! You&#39;re all set for the fantasy cricket game.</p>', 'faqs', 'faqs', 'FAQs', NULL, '<p><strong>Q1 &ndash; What types of payment modes are accepted?</strong><br />\r\nAns: You can choose either of these options<br />\r\nBank Wire Transfer / Online Payment through Credit Card / PayPal</p>\r\n\r\n<p><strong>Q2 &ndash; What is the difference between single user, multi-user and enterprise license?</strong><br />\r\n<strong>Ans:</strong>&nbsp;The definitions of these licenses are as follows:</p>\r\n\r\n<ul>\r\n	<li>The purchase of a &lsquo;Single User License&rsquo; grants access to a specific report for one person only and must not be shared with other employees within the same company.</li>\r\n	<li>The purchase of a &lsquo;Multi', NULL, '2018-08-08 21:48:18', '2020-04-25 14:58:38');
INSERT INTO `pages` (`id`, `title`, `page_content`, `slug`, `url`, `meta_title`, `meta_key`, `meta_description`, `images`, `created_at`, `updated_at`) VALUES
(18, 'Terms  and conditions', '<p><span style=\"color:#008080\"><strong>Sportsfight</strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight is the flagship brand of Radhadevi Technologies Private Limited (&quot;Sportsfight&quot;). Through Sportsfight, along with its sub-pages, and the Sportsfight App, Sportsfight operates five separate portals through which it offers cricket-based, football-based, basketball based, volleyball based, hockey based and kabaddi based online fantasy games. Sportsfight, as used herein, shall be construed as a collective reference to Sportsfight and the Sportsfight App.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Usage of Sportsfight</strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any person (&quot;User&quot;) accessing Sportsfight or the Sportsfight App (Sportsfight platform&#39;) for participating in the various contests and games (including fantasy games), available on Sportsfight platform (&quot;Contest(s)&quot;) (Sportsfight Services&#39;) shall be bound by these Terms and Conditions, and all other rules, regulations and terms of use referred to herein or provided by Sportsfight in relation to any Sportsfight Services.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight shall be entitled to modify these Terms and Conditions, rules, regulations and terms of use referred to herein or provided by Sportsfight in relation to any Sportsfight Services, at any time, by posting the same on Sportsfight. Use of Sportsfight constitutes the User&#39;s acceptance of such Terms and Conditions, rules, regulations and terms of use referred to herein or provided by Sportsfight in relation to any Sportsfight Services, as may be amended from time to time. Sportsfight may, at its sole discretion, also notify the User of any change or modification in these Terms and Conditions, rules, regulations and terms of use referred to herein or provided by Sportsfight, by way of sending an email to the User&#39;s registered email address or posting notifications in the User accounts. The User may then exercise the options provided in such an email or notification to indicate non-acceptance of the modified Terms and Conditions, rules, regulations and terms of use referred to herein or provided by Sportsfight. If such options are not exercised by the User within the time frame prescribed in the email or notification, the User will be deemed to have accepted the modified Terms and Conditions, rules, regulations and terms of use referred to herein or provided by Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Certain Sportsfight Services being provided on Sportsfight may be subject to additional rules and regulations set down in that respect. To the extent that these Terms and Conditions are inconsistent with the additional conditions set down, the additional conditions shall prevail.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may, at its sole and absolute discretion:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Restrict, suspend, or terminate any User&#39;s access to all or any part of Sportsfight or Sportsfight Platform Services;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Change, suspend, or discontinue all or any part of the Sportsfight Platform Services;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Reject, move, or remove any material that may be submitted by a User;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Move or remove any content that is available on Sportsfight Platform;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Deactivate or delete a User&#39;s account and all related information and files on the account;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Establish general practices and limits concerning use of Sportsfight Platform;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Offer discounts to its users in form it deems fit (&quot;Cash Bonus&quot;). All such discounts shall be credited in a separate account called as Cash Bonus Account.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Revise or make additions and/or deletions to the roster of players available for selection in a Contest on account of revisions to the roster of players involved in the relevant Sports Event;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Assign its rights and liabilities to all User accounts hereunder to any entity (post such assignment intimation of such assignment shall be sent to all Users to their registered email ids)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the event any User breaches, or Sportsfight reasonably believes that such User has breached these Terms and Conditions, or has illegally or improperly used Sportsfight or the Sportsfight Services, Sportsfight may, at its sole and absolute discretion, and without any notice to the User, restrict, suspend or terminate such User&#39;s access to all or any part of Sportsfight Contests or the Sportsfight Platform, deactivate or delete the User&#39;s account and all related information on the account, delete any content posted by the User on Sportsfight and further, take technical and legal steps as it deems necessary.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>If Sportsfight charges its Users a platform fee in respect of any Sportsfight Services, Sportsfight shall, without delay, repay such platform fee in the event of suspension or removal of the User&#39;s account or Sportsfight Services on account of any negligence or deficiency on the part of Sportsfight, but not if such suspension or removal is effected due to:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>any breach or inadequate performance by the User of any of these Terms and Conditions; or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>any circumstances beyond the reasonable control of Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users consent to receiving communications such as announcements, administrative messages and advertisements from Sportsfight or any of its partners, licensors or associates.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Intellectual Property</strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight includes a combination of content created by Sportsfight, its partners, affiliates, licensors, associates and/or Users. The intellectual property rights (&quot;Intellectual Property Rights&quot;) in all software underlying Sportsfight and the Sportsfight Platform and material published on Sportsfight, including (but not limited to) games, Contests, software, advertisements, written content, photographs, graphics, images, illustrations, marks, logos, audio or video clippings and Flash animation, is owned by Sportsfight, its partners, licensors and/or associates. Users may not modify, publish, transmit, participate in the transfer or sale of, reproduce, create derivative works of, distribute, publicly perform, publicly display, or in any way exploit any of the materials or content on Sportsfight either in whole or in part without express written license from Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users may request permission to use any Sportsfight content by writing in to Sportsfight Helpdesk.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users are solely responsible for all materials (whether publicly posted or privately transmitted) that they upload, post, e-mail, transmit, or otherwise make available on Sportsfight (&quot;Users&#39; Content&quot;). Each User represents and warrants that he/she owns all Intellectual Property Rights in the User&#39;s Content and that no part of the User&#39;s Content infringes any third party rights. Users further confirm and undertake to not display or use of the names, logos, marks, labels, trademarks, copyrights or intellectual and proprietary rights of any third party on Sportsfight. Users agree to indemnify and hold harmless Sportsfight, its directors, employees, affiliates and assigns against all costs, damages, loss and harm including towards litigation costs and counsel fees, in respect of any third party claims that may be initiated including for infringement of Intellectual Property Rights arising out of such display or use of the names, logos, marks, labels, trademarks, copyrights or intellectual and proprietary rights on Sportsfight, by such User or through the User&#39;s commissions or omissions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users hereby grant to Sportsfight and its affiliates, partners, licensors and associates a worldwide, irrevocable, royalty-free, non-exclusive, sub-licensable license to use, reproduce, create derivative works of, distribute, publicly perform, publicly display, transfer, transmit, and/or publish Users&#39; Content for any of the following purposes:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>displaying Users&#39; Content on Sportsfight</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>distributing Users&#39; Content, either electronically or via other media, to other Users seeking to download or otherwise acquire it, and/or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>storing Users&#39; Content in a remote database accessible by end users, for a charge.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This license shall apply to the distribution and the storage of Users&#39; Content in any form, medium, or technology.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>All names, logos, marks, labels, trademarks, copyrights or intellectual and proprietary rights on Sportsfight(s) belonging to any person (including User), entity or third party are recognized as proprietary to the respective owners and any claims, controversy or issues against these names, logos, marks, labels, trademarks, copyrights or intellectual and proprietary rights must be directly addressed to the respective parties under notice to Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style=\"color:#008080\">Third Party Sites, Services and Products</span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may contain links to other Internet sites owned and operated by third parties. Users&#39; use of each of those sites is subject to the conditions, if any, posted by the sites. Sportsfight does not exercise control over any Internet sites apart from Sportsfight and cannot be held responsible for any content residing in any third-party Internet site. Sportsfight inclusion of third-party content or links to third-party Internet sites is not an endorsement by Sportsfight of such third-party Internet site.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users&#39; correspondence, transactions/offers or related activities with third parties, including payment providers and verification service providers, are solely between the User and that third party. Users&#39; correspondence, transactions and usage of the services/offers of such third party shall be subject to the terms and conditions, policies and other service terms adopted/implemented by such third party, and the User shall be solely responsible for reviewing the same prior to transacting or availing of the services/offers of such third party. User agrees that Sportsfight will not be responsible or liable for any loss or damage of any sort incurred as a result of any such transactions/offers with third parties. Any questions, complaints, or claims related to any third party product or service should be directed to the appropriate vendor.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight contains content that is created by Sportsfight as well as content provided by third parties. Sportsfight does not guarantee the accuracy, integrity, quality of the content provided by third parties and such content may not relied upon by the Users in utilizing the Sportsfight Services provided on Sportsfight including while participating in any of the contests hosted on Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style=\"color:#008080\">Privacy Policy</span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>All information collected from Users, such as registration and credit card information, is subject to Sportsfight Privacy Policy which is available at Privacy Policy</p>\r\n\r\n<p>User Conduct</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree to abide by these Terms and Conditions and all other rules, regulations and terms of use of the Website. In the event User does not abide by these Terms and Conditions and all other rules, regulations and terms of use, Sportsfight may, at its sole and absolute discretion, take necessary remedial action, including but not limited to:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>restricting, suspending, or terminating any User&#39;s access to all or any part of Sportsfight Services;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>deactivating or deleting a User&#39;s account and all related information and files on the account. Any amount remaining unused in the User&#39;s Game account or Winnings Account on the date of deactivation or deletion shall be transferred to the User&#39;s bank account on record with Sportsfight subject to a processing fee (if any) applicable on such transfers as set out herein; or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>refraining from awarding any prize(s) to such User.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree to provide true, accurate, current and complete information at the time of registration and at all other times (as required by Sportsfight). Users further agree to update and keep updated their registration information.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A User shall not register or operate more than one User account with Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree to ensure that they can receive all communication from Sportsfight by marking e-mails or sending SMSs from Sportsfight as part of their &quot;safe senders&quot; list. Sportsfight shall not be held liable if any e-mail/SMS remains unread by a User as a result of such e-mail getting delivered to the User&#39;s junk or spam folder.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any password issued by Sportsfight to a User may not be revealed to anyone else. Users may not use anyone else&#39;s password. Users are responsible for maintaining the confidentiality of their accounts and passwords. Users agree to immediately notify Sportsfight of any unauthorized use of their passwords or accounts or any other breach of security.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree to exit/log-out of their accounts at the end of each session. Sportsfight shall not be responsible for any loss or damage that may result if the User fails to comply with these requirements.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree not to use cheats, exploits, automation, software, bots, hacks or any unauthorised third party software designed to modify or interfere with Sportsfight Services and/or Sportsfight experience or assist in such activity.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree not to copy, modify, rent, lease, loan, sell, assign, distribute, reverse engineer, grant a security interest in, or otherwise transfer any right to the technology or software underlying Sportsfight or Sportsfight Services.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree that without Sportsfight express written consent, they shall not modify or cause to be modified any files or software that are part of Sportsfight Services.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree not to disrupt, overburden, or aid or assist in the disruption or overburdening of (a) any computer or server used to offer or support Sportsfight or the Sportsfight Services (each a &quot;Server&quot;); or (2) the enjoyment of Sportsfight Services by any other User or person.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree not to institute, assist or become involved in any type of attack, including without limitation to distribution of a virus, denial of service, or other attempts to disrupt Sportsfight Services or any other person&#39;s use or enjoyment of Sportsfight Services.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users shall not attempt to gain unauthorised access to the User accounts, Servers or networks connected to Sportsfight Services by any means other than the User interface provided by Sportsfight, including but not limited to, by circumventing or modifying, attempting to circumvent or modify, or encouraging or assisting any other person to circumvent or modify, any security, technology, device, or software that underlies or is part of Sportsfight Services.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Without limiting the foregoing, Users agree not to use Sportsfight for any of the following:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To engage in any obscene, offensive, indecent, racial, communal, anti-national, objectionable, defamatory or abusive action or communication;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To harass, stalk, threaten, or otherwise violate any legal rights of other individuals;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To publish, post, upload, e-mail, distribute, or disseminate (collectively, &quot;Transmit&quot;) any inappropriate, profane, defamatory, infringing, obscene, indecent, or unlawful content;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To Transmit files that contain viruses, corrupted files, or any other similar software or programs that may damage or adversely affect the operation of another person&#39;s computer, Sportsfight, any software, hardware, or telecommunications equipment;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To advertise, offer or sell any goods or services for any commercial purpose on Sportsfight without the express written consent of Sportsfight;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To download any file, recompile or disassemble or otherwise affect our products that you know or reasonably should know cannot be legally obtained in such manner;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To falsify or delete any author attributions, legal or other proper notices or proprietary designations or labels of the origin or the source of software or other material;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To restrict or inhibit any other user from using and enjoying any public area within our sites;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To collect or store personal information about other Users;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To interfere with or disrupt Sportsfight, servers, or networks;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To impersonate any person or entity, including, but not limited to, a representative of Sportsfight, or falsely state or otherwise misrepresent User&#39;s affiliation with a person or entity;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To forge headers or manipulate identifiers or other data in order to disguise the origin of any content transmitted through Sportsfight or to manipulate User&#39;s presence on Sportsfight(s);</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To take any action that imposes an unreasonably or disproportionately large load on our infrastructure;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To engage in any illegal activities. You agree to use our bulletin board services, chat areas, news groups, forums, communities and/or message or communication facilities (collectively, the &quot;Forums&quot;) only to send and receive messages and material that are proper and related to that particular Forum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>If a User chooses a username that, in Sportsfight considered opinion is obscene, indecent, abusive or that might subject Sportsfight to public disparagement or scorn, Sportsfight reserves the right, without prior notice to the User, to change such username and intimate the User or delete such username and posts from Sportsfight, deny such User access to Sportsfight, or any combination of these options.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Unauthorized access to Sportsfight is a breach of these Terms and Conditions, and a violation of the law. Users agree not to access Sportsfight by any means other than through the interface that is provided by Sportsfight for use in accessing Sportsfight. Users agree not to use any automated means, including, without limitation, agents, robots, scripts, or spiders, to access, monitor, or copy any part of our sites, except those automated means that we have approved in advance and in writing.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Use of Sportsfight is subject to existing laws and legal processes. Nothing contained in these Terms and Conditions shall limit Sportsfight right to comply with governmental, court, and law-enforcement requests or requirements relating to Users&#39; use of Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users may reach out to Sportsfight through -</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Helpdesk if the user has any concerns with regard to a match and/or contest within Forty Eight (48) hours of winner declaration for the concerned contest.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Persons below the age of eighteen (18) years are not allowed to participate on any of the contests, games (by whatever name called) on the Sportsfight Platform. The Users will have to disclose their real age at the time of getting access into the Sportsfight Platform.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may not be held responsible for any content contributed by Users on the Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Conditions of Participation:</strong></span></p>\r\n\r\n<p>By entering a Contest, user agrees to be bound by these Terms and the decisions of Sportsfight. Subject to the terms and conditions stipulated herein below, the Company, at its sole discretion, may disqualify any user from a Contest, refuse to award benefits or prizes and require the return of any prizes, if the user engages in unfair conduct, which the Company deems to be improper, unfair or otherwise adverse to the operation of the Contest or is in any way detrimental to other Users which includes, but is not limited to:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Falsifying ones&rsquo; own personal information (including, but not limited to, name, email address, bank account details and/or any other information or documentation as may be requested by Sportsfight to enter a contest and/or claim a prize/winning.;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Engaging in any type of financial fraud or misrepresentation including unauthorized use of credit/debit instruments, payment wallet accounts etc. to enter a Contest or claim a prize. It is expressly clarified that the onus to prove otherwise shall solely lie on the user.;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Colluding with any other user(s) or engaging in any type of syndicate play;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any violation of Contest rules or the Terms of Use;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Accumulating points or prizes through unauthorized methods such as automated bots, or other automated means;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Using automated means (including but not limited to harvesting bots, robots, parser, spiders or screen scrapers) to obtain, collect or access any information on the Website or of any User for any purpose</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any type of Cash Bonus misuse, misuse of the Invite Friends program, or misuse of any other offers or promotions;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tampering with the administration of a Contest or trying to in any way tamper with the computer programs or any security measure associated with a Contest;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Obtaining other users&rsquo; information without their express consent and/or knowledge and/or spamming other users (Spamming may include but shall not be limited to send unsolicited emails to users, sending bulk emails to Sportsfight Users, sending unwarranted email content either to selected Users or in bulk); or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Abusing the Website in any way (&lsquo;unparliamentary language, slangs or disrespectful words&rsquo; are some of the examples of Abuse)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>It is clarified that in case a User is found to be in violation of this policy, Sportsfight reserves its right to initiate appropriate Civil/Criminal remedies as it may be advised other than forfeiture and/or recovery of prize money if any.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Registration for a contest</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style=\"color:#008080\">In order to register for the Contest(s), Participants are required to accurately provide the following information:</span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Full Name</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Team Name(s)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>E-mail address</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Password</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>State of Residence</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Gender</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Date of birth</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participants are also required to confirm that they have read, and shall abide by, these Terms and Conditions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the event a Participant indicates, while entering an address, that he/she is a resident of either Assam, Odisha, Sikkim, Nagaland or Telangana, such Participant will not be permitted to proceed to sign up for any match in the paid version of the Contest as described below.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Once the Participants have entered the above information, and clicked on the &quot;register&quot; tab, and such Participants are above the age of 18 years, they are sent an email confirming their registration and containing their login information.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contest(s), Participation and Prizes</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>As part of its services, Sportsfight may make available the contest(s) on the Sportsfight platform.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Currently, following contests are made available on Sportsfight platform: 1) A fantasy cricket game and 2) A fantasy football game; and 3) A fantasy kabaddi game 4) A fantasy basketball game and 5) A volleyball game and 6) A fantasy hockey game. Individual users wishing to participate in the such contest (&quot;Participants&quot;) are invited to create their own fantasy teams (&quot;Team/s&quot;) consisting of real life cricketers, footballers, basketball players, volleyball players, hockey players or kabaddi players (as applicable) involved in the real-life cricket/football/kabaddi/volleyball/hockey/basketball match (as applicable), series or tournament (each a &quot;Sport Event&quot;) to which the fantasy game relates. Sportsfight offers its platform to Participants for fantasy game Contest(s) being created relating to each Sport Event, and Participants can participate in such Contest(s) with their Teams.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Depending upon the circumstances of each match, the participants can edit their teams till the official match start time as declared by the officials of the Sport Event or adjusted deadline, as specified below.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight reserves the right to abandon a specific round or adjust the deadline of a round in certain specific, uncertain scenarios, which are beyond Sportsfight reasonable control, including but not limited to the ones&rsquo; mentioned herein below:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Actual match start time is before the official deadline:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>All sports other than Cricket-</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight reserves the right to adjust the deadline to a maximum of 10 minutes post actual match start time. In case the actual match start time is more than 10 minutes of official deadline, the contest will be abandoned.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Cricket -</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight reserves the right to adjust the deadline by a Maximum of 10 minutes or 3 overs bowled, whichever is less, before the official match start time.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In cases where official match time cannot be verified by Sportsfight through reliable and/or publicly available sources, Sportsfight reserves the right to adjust the deadline to such a time by which a maximum of 3 overs in the given match are bowled.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Actual match start time is after the official deadline:</p>\r\n\r\n<p>Sportsfight reserves the right to extend the deadline or abandon the contest/game based on the circumstances such as delayed toss, interruption on account of weather, non-appearance of teams, technical/equipment glitches causing delays etc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight shall endeavor to send communications through emails and/or SMS communication, about any such change as is contemplated in the aforementioned paragraphs to keep the User updated.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Teams are awarded points on the basis of the real life cricketers&#39;, footballers&#39;, &lsquo;basketball players&rsquo;, &#39;volleyball players&#39;, &lsquo;hockey players&rsquo; or kabaddi players (as applicable) performances at the end of a designated match, match or tournament of the Contest(s). The Participant(s) whose Team(s) have achieved the highest aggregate score(s) in the Contest(s) shall be declared winners (&quot;Winners&quot;). In certain pre-specified Contests, there may be more than one Winner and distribution of prizes to such Winners will be in increasing order of their Team&#39;s aggregate score at the end of the designated match(s) of the Contests.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Contest(s) across the Sportsfight Services shall, in addition to the Terms and Conditions, rules and regulations mentioned herein, be governed by:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&quot;Fantasy Rules&quot; available at How To Play - Fantasy Cricket or How To Play Fantasy Football or How To Play - Fantasy Kabaddi or How To Play - Fantasy Volleyball or How to Play Fantasy Hockey or How to Play Fantasy Basketball</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Other rules and regulations (including rules and regulation in relation to any payments made to participate in the Contest(s); and all Participants agree to abide by the same.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Currently, there are paid versions of the Contest(s) made available on Sportsfight platform. Users may participate in the Contest(s) by paying the pre-designated amount as provided on the relevant Contest page. The &lsquo;pre-designated amount&rsquo; means and includes pre-determined platform fee for accessing Sportsfight services and pre-determined participant&#39;s contribution towards prize money pool. The Participant with the highest aggregate points at the end of the pre-determined match shall be eligible to win a pre-designated prize which is disbursed out of prize money pool, as stated on the relevant Contest(s) page.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A Participant may create different Teams for participation in Contest(s) in relation to a Sport Event across the Sportsfight Services. However, unless Sportsfight specifies otherwise in relation to any Contest (&quot;Multiple Entry Contest&quot;), Participants acknowledge and agree that they may enter only one Team in any Contest offered in relation to a Sport Event. In case of Multiple Entry Contest(s), a Participant may enter more than one Team in a single Multiple Entry Contest. In addition, it is expressly clarified that Sportsfight may, from time to time, restrict the maximum number of Teams that may be created by a single User account (for each format of the contest) or which a single User account may enter in a particular Multiple Entry Contest, in each case to such number as determined by Sportsfight in its sole discretion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participant shall pay a pre-designated amount for participating in the contest(s) being created on the Sportsfight platform.</p>\r\n\r\n<p>In the event a Participant indicates, while entering an address, that he/she is a resident of either Assam, Odisha, Sikkim, Nagaland or Telangana, such Participant will not be permitted to proceed to sign up for the match or contest and may not participate in any paid version of the Contest(s).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In two member and/or three member only public and/or contests, where all participants have entered the contest with the exact same teams, including the captain and vice-captain in such event, contest prize money shall be equally divided amongst all participants and the amount shall be deposited in the Sportsfight winning account of all participants and the remaining amount shall be credited in the Cash Bonus account of such participants.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In Starting Lineup Feature : Purpose of indicating a player&#39;s inclusion in final starting lineup is only to provide information and assist a user in selecting his/her team on Sportsfight. While indicating a Player&#39;s inclusion in starting lineup is given by Sportsfight on the basis of information/data received through feed providers, publicly available information. Users are advised to do a thorough research of their own from official sources and/or other available sources of information. Sportsfight, shall not take any liability, if a player earlier indicated as &#39;Playing&#39; does not play or start for any reason whatsoever.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Substitutes on the field will not be awarded points for any contribution they make. However, &#39;Concussion Substitutes&#39; will be awarded points awarded four (4) points for making an appearance in a match and will be awarded points any contribution they make as per the Fantasy Points System (w.e.f Nov 25 2019).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contest Formats</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Currently two formats of contest(s) are made available on Sportsfight platform (1) Public Contest where Users can participate in a Contest with other Users without any restriction on participation and (2) private contests, where Users can invite specific Users into a Contest and restrict participation to such invited Users. A user can enter into a maximum of 500 contest (including both Public contests and Private contests) per match. Any participation in a contest more than 500 shall be automatically prohibited. All rules applicable to Contest(s) as set out herein shall be applicable to both formats of the Contest(s). Users by participating in a Contest(s) hereby authorize Sportsfight to appoint a third party/ Trustee/Escrow Agent to manage users funds on users behalf.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Public contest</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the Public contest format of the Contest(s), Sportsfight may make available the Contest(s) comprising of 2 - 100 Participants or any other pre-designated number of Participants.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may create this format of the Contest(s) as a paid format and the Winner will be determinable at the end of the match as per rule of the contests.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The number of Participants required to make the Contest(s) operational will be pre-specified and once the number of Participants in such Contest(s) equals the pre-specified number required for that Contest(s), such Contest(s) shall be operational. In case the number of Participants is less than the pre-specified number at the time of commencement of the match, such Contest(s) will not be operational and the pre-designated amount paid by each Participant shall be returned to the account of such User without any charge or deduction.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In certain Contests across the Sportsfight Services, designated as &quot;Confirmed contests&quot;, the Contest(s) shall become operational only when a minimum of two users join a Confirmed Contest. The pre-specified number of winners to be declared in such Contest(s), even if all available Participant slots (as pre-specified in relation to the Contest(s)) remain unfilled. It is clarified that notwithstanding the activation of such Contest(s), Participants can continue to join such Contest(s) till either (i) all available Participant slots of such Contest(s) are filled or (ii) the match to which the Contest (s) relates commences, whichever is earlier. In the event of shortfall in the number of participants joining the Confirmed Contest, Sportsfight shall continue with such contests and the short fall in the prize pool shall be borne by Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Private contest</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the Private contest format of the Contest(s), Sportsfight enables Users to create a contest (&quot;Private contest&quot;) and invite other users, whether existing Users or otherwise, (&quot;Invited User&quot;) to create Teams and participate in the Contest(s). Users may create a Private contest to consist of a pre-specified number of Participants, that is, consisting of either 2 -100 Participants. The User creating the Private contest shall pay the pre-designated amount for such Private contest and thereby join that Private contest and shall supply a name for the Private contest and be provided with a unique identification code (&quot;contest Code&quot;) (which will be issued to the account of such User). The User agrees and understands that once the Private contest is created no change shall be permitted in the terms or constitution of the Private contest, except for a change in the name of the contest. The User creating the Private contest shall provide Sportsfight with the email address or Facebook account username of Invited Users to enable Sportsfight to send a message or mail inviting such Invited User to register with Sportsfight (if necessary) and participate in the Private contest in relation to which the invite has been issued.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In order to participate in the Private contest, an Invited User shall input the contest Code associated with the Private contest and pay the pre-designated amount for the Private contest. Once the number of Participants in a Private contest equals the number of pre-specified Participants for that Private contest, the Private contest shall be rendered operative and no other Invited Users or Users shall be permitted to participate in the Private contest. In the event that any Private contest does not contain the pre-specified number of Participants for that Private contest within 1 hour prior to the commencement of the match/Contest, the Platform will initiate an automatic refund of the amount deposited. Such refund shall be processed after the expiry of the deadline for filling of participants for such Private Contest.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>It is clarified that the participation of Invited Users in any Private contest is subject to the pre-specified number of Participants for that Private contest, and Sportsfight shall not be liable to any person for the inability of any Invited User to participate in any Private contest due to any cause whatsoever, including without limitation due to a hardware or technical malfunction or lack of eligibility of such Invited User to participate in the Contest(s).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Legality of Game of Skill</strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Games of skill are legal, as they are excluded from the ambit of Indian gambling legislations including, the Public Gambling Act of 1867.The Indian Supreme Court in the cases of State of Andhra Pradesh v. K Satyanarayana (AIR 1968 SC 825) and KR Lakshmanan v. State of Tamil Nadu (AIR 1996 SC 1153) has held that a game in which success depends predominantly upon the superior knowledge, training, attention, experience and adroitness of the player shall be classified as a game of skill.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Contest (s) described above (across the Sportsfight Services) are games of skill as success of Participants depends primarily on their superior knowledge of the games of cricket and/or football and/or basketball and/or hockey and/or volleyball and/or kabaddi statistics, knowledge of players&#39; relative form, players&#39; performance in a particular territory, conditions and/or format (such as ODIs, test cricket and Twenty20 in the cricket fantasy game), attention and dedication towards the Contest(s) and adroitness in playing the Contest(s). The Contest(s) also requires Participants to field well-balanced sides with limited resources and make substitutions at appropriate times to gain the maximum points.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>By participating in this Contest(s), each Participant acknowledges and agrees that he/she is participating in a game of skill.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Eligibility</strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Contest(s) are open only to persons above the age of 18 years.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Contest(s) are open only to persons, currently residing in India.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may, in accordance with the laws prevailing in certain Indian states, bar individuals residing in those states from participating in the Contest(s). Currently, individuals residing in the Indian states of Assam, Odisha, Sikkim, Nagaland or Telangana may not participate in the paid version of the Contest as the laws of these states bar persons from participating in games of skill where participants are required to pay to enter.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Persons who wish to participate must have a valid email address.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may on receipt of information bar a person from participation and/or withdrawing winning amounts if such person is found to be one with insider knowledge of participating teams in any given contests/match, organizing boards, leagues etc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Only those Participants who have successfully registered on the Sportsfight as well as registered prior to each match in accordance with the procedure outlined above shall be eligible to participate in the Contest and win prizes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style=\"color:#008080\">Payment Terms</span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In respect of any transactions entered into on the Sportsfight platform, including making a payment to participate in the paid versions of Contest(s), Users agree to be bound by the following payment terms:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The payment of pre-designated amount Users make to participate in the Contest(s) is inclusive of the pre-designated platform fee for access to the Sportsfight Services charged by Sportsfight and pre-determined participant&rsquo;s contribution towards prize money pool.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Subject to these Terms and Conditions, all amounts collected from the User are held in a separate non-interest earning bank Accounts. The said accounts are operated by a third party appointed by Sportsfight in accordance with Clause 10 of these Terms and Conditions. From these bank accounts, the payouts can be made to (a) Users (towards their withdrawals), (b) Sportsfight (towards its Platform Fees) and to (c) Government (towards TDS on Winnings Amount). Sportsfight receives only its share of the platform Fees through the said Escrow Agent.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Sportsfight reserves the right to charge a Platform Fee, which would be specified and notified by Sportsfight on the Contest page, being created on Sportsfight platform, prior to a User&#39;s joining of such Contest. The Platform Fee (inclusive of applicable tax thereon) will be debited from the User&rsquo;s account balance and Sportsfight shall issue an invoice for such debit to the User.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The User may participate in a Contest wherein the User has to contribute a pre-specified contribution towards the Prize Money Pool of such Contest, which will be passed on to the Winner(s) of the Contest after the completion of the Contest as per the terms and conditions of such Contest. It is clarified that Sportsfight has no right or interest in this Prize Money Pool, and only acts as an intermediary engaged in collecting and distributing the Prize Money Pool in accordance with the Contest terms and conditions. The amount to be paid-in by the User towards the Prize Money Pool would also be debited from the User&rsquo;s account balance maintained with the Trustee.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any user availing Sportsfight&nbsp; services are provided with two categories of accounts for the processing and reconciliation of payments: (i) &#39;Unutilized&#39; Account, (ii) Winnings Account. It is clarified that in no instance the transfer of any amounts in the User&#39;s accounts to any other category of account held by the user or any third party account, including a bank account held by a third party:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>User&#39;s winnings in any Contest will reflect as credits to the User&#39;s Winnings Account.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>User&rsquo;s remitting the amount the designated payment gateway shall be credited to User&rsquo;s Unutlized Account&rsquo;.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Each time a User participates in any contest on Sportsfight platform, the pre-designated amount shall be debited in the User&rsquo;s account. In debiting amounts from the User&rsquo;s accounts towards the pre-designated amount of such user shall be debited from the User&rsquo;s Unutilized Account and thereafter, any remaining amount of participation fee shall be debited from the User&rsquo;s Winning Account.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In case there is any amount remaining to be paid by the User in relation to such User&rsquo;s participation in any match(s) or Contest(s), the User will be taken to the designated payment gateway to give effect to such payment. In case any amount added by the User through such payment gateway exceeds the remaining amount of the pre-designated amount, the amount in excess shall be transferred to the User&rsquo;s &lsquo;Unutilized&rsquo; Account and will be available for use in participation in any match(s) or Contest(s) or for withdrawal in accordance with these Terms and Conditions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Debits from the &lsquo;Unutilized&rsquo; Account for the purpose of enabling a user&rsquo;s participation in a Contest shall be made in order of the date of credit of amounts in the &lsquo;Unutilized&rsquo; Account, and accordingly amounts credited into &lsquo;Unutilized&rsquo; Account earlier in time shall be debited first.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A User shall be permitted to withdraw any amounts credited into such User&#39;s &#39;Unutilized&#39; Account for any reason whatsoever by contacting Sportsfight Customer Support. All amounts credited into a User&#39;s &#39;Unutilized&#39; Account must be utilised within 335 days of credit. In case any unutilised amount lies in the &#39;Unutilized&#39; Account after the completion of 335 days from the date of credit of such amount, Sportsfight reserves the right to forfeit such unutilised amount, without liability or obligation to pay any compensation to the User.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Withdrawal of any amount standing to the User&#39;s credit in the Winnings Account may be made by way of a request to Sportsfight but shall occur automatically upon completion of 335 days from the date of credit of such amount in the User&#39;s Winnings Account. In either case, Sportsfight shall effect an online transfer to the User&#39;s bank account on record with Sportsfight within a commercially reasonable period of time. Such transfer will reflect as a debit to the User&#39;s Winnings Account. Sportsfight shall not charge any processing fee for the online transfer of such amount from the Winnings Account to the User&#39;s bank account on record with Sportsfight. Users are requested to note that they will be required to provide valid photo identification and address proof documents for proof of identity and address in order for Sportsfight to process the withdrawal request. The name mentioned on the User&#39;s photo identification document should correspond with the name provided by the User at the time of registration on Sportsfight, as well as the name and address existing in the records of the User&#39;s bank account as provided to Sportsfight. In the event that no bank account has been registered by the User against such User&#39;s account with Sportsfight, or the User has not verified his/her User account with Sportsfight, to Sportsfight satisfaction and in accordance with these Terms and Conditions, Sportsfight shall provide such User with a notification to the User&#39;s email address as on record with Sportsfight at least 30 days prior to the Auto Transfer Date, and in case the User fails to register a bank account with his/her User Account and/or to verify his/her User Account by the Auto Transfer Date, Sportsfight shall be entitled to forfeit any amounts subject to transfer on the Auto Transfer Date. Failure to provide Sportsfight with a valid bank account or valid identification documents (to Sportsfight satisfaction) may result in the forfeiture of any amounts subject to transfer in accordance with this clause.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Further, in order to conduct promotional activities, Sportsfight may gratuitously issue Cash Bonus to the User for the purpose of participation in any Contest(s) and no User shall be permitted to transfer or request the transfer of any amount in to the Cash Bonus. The usage of any Cash Bonus issued shall be subject to the limitations and restrictions, including without limitation, restrictions as to time within which such Cash Bonus must be used, as applied by Sportsfight and notified to the User at the time of issue of such amount. The issue of any Cash Bonus to the user is subject to the sole discretion of Sportsfight and cannot be demanded by any User as a matter of right. The issue of any Cash Bonus by Deam11 on any day shall not entitle the user to demand the issuance of such Cash Bonus at any subsequent period in time nor create an expectation of recurring issue of such Cash Bonus by Sportsfight to such User. The Cash Bonus granted to the user may be used by such User for the purpose of setting off against the contribution to prize pool in any Contest, in accordance with these Terms and Conditions. The Cash Bonus shall not be withdraw-able or transferrable to any other account of the User, including the bank account of such User, or of any other User or person, other that as part of the winnings of a User in any Contest(s). In case the User terminates his/her account with Sportsfight or such account if terminated by Sportsfight, all Cash Bonus granted to the user shall return to Sportsfight and the User shall not have any right or interest on such points.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>All Cash Bonus credited in the User account shall be valid for a period of 30 days from the date of credit. The Cash Bonus shall lapse at the end of 30 days and the Cash Bonus amount shall not reflect in the User account</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree that once they confirm a transaction on Sportsfight, they shall be bound by and make payment for that transaction.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The User acknowledges that subject to time taken for bank reconciliations and such other external dependencies that Sportsfight has on third parties, any transactions on Sportsfight Platform may take up to 24 hours to be processed. Any amount paid or transferred into the User&#39;s &#39;Unutilized&#39; Account or Winnings Account may take up to 24 hours to reflect in the User&#39;s &#39;Unutilized&#39; Account or Winnings Account balance. Similarly, the utilization of the Cash Bonus or money debited from &#39;Unutilized&#39; Account or Winnings Account may take up to 24 hours to reflect in the User&#39;s &#39;Unutilized&#39; Account or Winnings Account balance. Users agree not to raise any complaint or claim against Sportsfight in respect of any delay, including any lost opportunity to join any Contest or match due to delay in crediting of transaction amount into any of the User&#39;s accounts</p>\r\n\r\n<p>A transaction, once confirmed, is final and no cancellation is permissible.</p>\r\n\r\n<p>Sportsfight may, in certain exceptional circumstances and at its sole and absolute discretion, refund the amount to the User after deducting applicable cancellation charges and taxes. At the time of the transaction, Users may also be required to take note of certain additional terms and conditions and such additional terms and conditions shall also govern the transaction. To the extent that the additional terms and conditions contain any clause that is conflicting with the present terms and conditions, the additional terms and conditions shall prevail.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tabulation of fantasy points</p>\r\n\r\n<p>Sportsfight may obtain the score feed and other information required for the computation and tabulation of fantasy points from third party service provider(s) and/or official website of the match organiser. In the rare event that any error in the computation or tabulation of fantasy points, selection of winners, abandonment of a match etc., as a result of inaccuracies in or incompleteness of the feed provided by the third party service provider and/or official website of the match organiser comes to its attention, Sportsfight shall use best efforts to rectify such error prior to the distribution of prizes. However, Sportsfight hereby clarifies that it relies on the accuracy and completeness of such third party score/statistic feeds and does not itself warrant or make any representations concerning the accuracy thereof and, in any event, shall take no responsibility for inaccuracies in computation and tabulation of fantasy points or the selection of winners as a result of any inaccurate or incomplete scores/statistics received from such third party service provider. Users and Participants agree not to make any claim or raise any complaint against Sportsfight in this respect.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Selection and Verification of Winners and Conditions relating to the Prizes</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style=\"color:#008080\">Selection of Winners</span></strong></p>\r\n\r\n<p>Winners will be decided on the basis of the scores of the Teams in a designated match (which may last anywhere between one day and an entire tournament) of the Contest(s). The Participant(s) owning the Team(s) with the highest aggregate score in a particular match shall be declared the Winner(s). In certain pre-specified Contests, Sportsfight may declare more than one Winner and distribute prizes to such Winners in increasing order of their Team&#39;s aggregate score at the end of the designated match of the Contest. The contemplated number of Winners and the prize due to each Winner in such Contest shall be as specified on the Contest page prior to the commencement of the Contest.</p>\r\n\r\n<p>Participants creating Teams on behalf of any other Participant or person shall be disqualified.</p>\r\n\r\n<p>In the event of a tie, the winning Participants shall be declared Winners and the prize shall be equally divided among such Participants.</p>\r\n\r\n<p>Sportsfight shall not be liable to pay any prize if it is discovered that the Winner(s) have not abided by these Terms and Conditions, and other rules and regulations in relation to the use of the Sportsfight, Contest, &quot;Fantasy Rules&quot;, etc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contacting Winners</p>\r\n\r\n<p>Winners shall be contacted by Sportsfight or the third party conducting the Contest on the e-mail address provided at the time of registration. The verification process and the documents required for the collection of prize shall be detailed to the Winners at this stage. As a general practice, winners will be required to provide following documents:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Photocopy of the User&#39;s PAN card;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Photocopy of a government-issued residence proof;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>User&#39;s bank account details and proof of the same.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight shall not permit a Winner to withdraw his/her prize(s)/accumulated winnings unless the above-mentioned documents have been received and verified within the time-period stipulated by Sportsfight. The User represents and warrants that the documents provided in the course of the verification process are true copies of the original documents to which they relate.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participants are required to provide proper and complete details at the time of registration. Sportsfight shall not be responsible for communications errors, commissions or omissions including those of the Participants due to which the results may not be communicated to the Winner.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The list of Winners shall be posted on a separate web-page on the Sportsfight. The winners will also be intimated by e-mail.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the event that a Participant has been declared a Winner on the abovementioned web-page but has not received any communication from Sportsfight, such Participant may contact Sportsfight within the time specified on the webpage.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style=\"color:#008080\">Verification process</span></strong></p>\r\n\r\n<p>Only those Winners who successfully complete the verification process and provide the required documents within the time limit specified by Sportsfight shall be permitted to withdraw/receive their accumulated winnings (or any part thereof). Sportsfight shall not entertain any claims or requests for extension of time for submission of documents.</p>\r\n\r\n<p>Sportsfight shall scrutinize all documents submitted and may, at its sole and absolute discretion, disqualify any Winner from withdrawing his accumulated winnings (or any part thereof) on the following matchs:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Determination by Sportsfight that any document or information submitted by the Participant is incorrect, misleading, false, fabricated, incomplete or illegible; or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participant does not fulfill the Eligibility Criteria specified in Clause 10 above; or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any other match.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Taxes Payable</p>\r\n\r\n<p>All prizes shall be subject to deduction of tax (&quot;TDS&quot;) as per the Income Tax Act 1961. As of April 1, 2018, the TDS rate prescribed by the Government of India with respect to any prize money amount that is in excess of Rs. 10,000/- is 31.2% of the total prize money amount. In case of any revisions by the Government of India to the aforementioned rate in the future, TDS will be deducted by Sportsfight in accordance with the then current prescribed TDS rate. Winners will be provided TDS certificates in respect of such tax deductions. The Winners shall be responsible for payment of any other applicable tax, including but not limited to, income tax, gift tax, etc. in respect of the prize money.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Miscellaneous</p>\r\n\r\n<p>The decision of Sportsfight with respect to the awarding of prizes shall be final, binding and non-contestable.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participants playing the paid formats of the Contest(s) confirm that they are not residents of any of the following Indian states - Assam, Odisha, Sikkim, Nagaland or Telangana. If it is found that a Participant playing the paid formats of the Contest(s) is a resident of any of the abovementioned states, Sportsfight shall disqualify such Participant and forfeit any prize won by such Participant. Further Sportsfight may, at its sole and absolute discretion, suspend or terminate such Participant&#39;s account with Sportsfight. Any amount remaining unused in the User&#39;s Game Account or Winnings Account on the date of deactivation or deletion shall be reimbursed to the User by an online transfer to the User&#39;s bank account on record with Sportsfight, subject to the processing fee (if any) applicable on such transfers as set out herein.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>If it is found that a Participant playing the paid formats of the Contest(s) is under the age of eighteen (18), Sportsfight shall be entitled, at its sole and absolute discretion, to disqualify such Participant and forfeit his/her prize. Further, Sportsfight may, at its sole and absolute discretion, suspend or terminate such Participant&#39;s account.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To the extent permitted by law, Sportsfight makes no representations or warranties as to the quality, suitability or merchantability of any prizes and shall not be liable in respect of the same.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may, at its sole and absolute discretion, vary or modify the prizes being offered to winners. Participants shall not raise any claim against Sportsfight or question its right to modify such prizes being offered, prior to closure of the Contest.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight will not bear any responsibility for the transportation or packaging of prizes to the respective winners. Sportsfight shall not be held liable for any loss or damage caused to any prizes at the time of such transportation.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Winners shall bear the shipping, courier or any other delivery cost in respect of the prizes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Winners shall bear all transaction charges levied for delivery of cash prizes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>All prizes are non-transferable and non-refundable. Prizes cannot be exchanged / redeemed for cash or kind. No cash claims can be made in lieu of prizes in kind.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Publicity</p>\r\n\r\n<p>Acceptance of a prize by the Winner constitutes permission for Sportsfight, and its affiliates to use the Winner&#39;s name, likeness, voice and comments for advertising and promotional purposes in any media worldwide for purposes of advertising and trade without any further permissions or consents and / or additional compensation whatsoever.</p>\r\n\r\n<p>The Winners further undertake that they will be available for promotional purposes as planned and desired by Sportsfight without any charge. The exact dates remain the sole discretion of Sportsfight. Promotional activities may include but not be limited to press events, internal meetings and ceremonies/functions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style=\"color:#008080\">General Conditions</span></strong></p>\r\n\r\n<p>If it comes to the notice of Sportsfight that any governmental, statutory or regulatory compliances or approvals are required for conducting any Contest(s) or if it comes to the notice of Sportsfight that conduct of any such Contest(s) is prohibited, then Sportsfight shall withdraw and / or cancel such Contest(s) without prior notice to any Participants or winners of any Contest(s). Users agree not to make any claim in respect of such cancellation or withdrawal of the Contest or Contest it in any manner.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Employees, directors, affiliates, relatives and family members of Sportsfight, will not be eligible to participate in any Contest(s).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dispute and Dispute Resolution</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The courts of competent jurisdiction at Mumbai shall have exclusive jurisdiction to determine any and all disputes arising out of, or in connection with, the Sportsfight Services provided by Sportsfight (including the Contest(s)), the construction, validity, interpretation and enforceability of these Terms and Conditions, or the rights and obligations of the User(s) (including Participants) or Sportsfight, as well as the exclusive jurisdiction to grant interim or preliminary relief in case of any dispute referred to arbitration as given below. All such issues and questions shall be governed and construed in accordance with the laws of the Republic of India.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the event of any legal dispute (which may be a legal issue or question) which may arise, the party raising the dispute shall provide a written notification (&quot;Notification&quot;) to the other party. On receipt of Notification, the parties shall first try to resolve the dispute through discussions. In the event that the parties are unable to resolve the dispute within fifteen (15) days of receipt of Notification, the dispute shall be settled by arbitration.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The place of arbitration shall be Mumbai, India. All arbitration proceedings shall be conducted in English and in accordance with the provisions of the Arbitration and Conciliation Act, 1996, as amended from time to time.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The arbitration award will be final and binding on the Parties, and each Party will bear its own costs of arbitration and equally share the fees of the arbitrator unless the arbitral tribunal decides otherwise. The arbitrator shall be entitled to pass interim orders and awards, including the orders for specific performance and such orders would be enforceable in competent courts. The arbitrator shall give a reasoned award.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nothing contained in these Terms and Conditions shall prevent Sportsfight from seeking and obtaining interim or permanent equitable or injunctive relief, or any other relief available to safeguard Sportsfight interest prior to, during or following the filing of arbitration proceedings or pending the execution of a decision or award in connection with any arbitration proceedings from any court having jurisdiction to grant the same. The pursuit of equitable or injunctive relief shall not constitute a waiver on the part of Sportsfight to pursue any remedy for monetary damages through the arbitration described herein.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Release and Limitations of Liability</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users shall access the Sportsfight Services provided on Sportsfight voluntarily and at their own risk. Sportsfight shall, under no circumstances be held responsible or liable on account of any loss or damage sustained (including but not limited to any accident, injury, death, loss of property) by Users or any other person or entity during the course of access to the Sportsfight Services (including participation in the Contest(s)) or as a result of acceptance of any prize.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>By entering the contests and accessing the Sportsfight Services provided therein, Users hereby release from and agree to indemnify Sportsfight, and/ or any of its directors, employees, partners, associates and licensors, from and against all liability, cost, loss or expense arising out their access to the Sportsfight Services including (but not limited to) personal injury and damage to property and whether direct, indirect, consequential, foreseeable, due to some negligent act or omission on their part, or otherwise.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight accepts no liability, whether jointly or severally, for any errors or omissions, whether on behalf of itself or third parties in relation to the prizes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users shall be solely responsible for any consequences which may arise due to their access of Sportsfight Services by conducting an illegal act or due to non-conformity with these Terms and Conditions and other rules and regulations in relation to Sportsfight Services, including provision of incorrect address or other personal details. Users also undertake to indemnify Sportsfight and their respective officers, directors, employees and agents on the happening of such an event (including without limitation cost of attorney, legal charges etc.) on full indemnity basis for any loss/damage suffered by Sportsfight on account of such act on the part of the Users.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users shall indemnify, defend, and hold Sportsfight harmless from any third party/entity/organization claims arising from or related to such User&#39;s engagement with the Sportsfight or participation in any Contest. In no event shall Sportsfight be liable to any User for acts or omissions arising out of or related to User&#39;s engagement with the Sportsfight or his/her participation in any Contest(s).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In consideration of Sportsfight allowing Users to access the Sportsfight Services, to the maximum extent permitted by law, the Users waive and release each and every right or claim, all actions, causes of actions (present or future) each of them has or may have against Sportsfight, its respective agents, directors, officers, business associates, group companies, sponsors, employees, or representatives for all and any injuries, accidents, or mishaps (whether known or unknown) or (whether anticipated or unanticipated) arising out of the provision of Sportsfight Services or related to the Contests or the prizes of the Contests.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Disclaimers</strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To the extent permitted under law, neither Sportsfight nor its parent/holding company, subsidiaries, affiliates, directors, officers, professional advisors, employees shall be responsible for the deletion, the failure to store, the mis-delivery, or the untimely delivery of any information or material.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To the extent permitted under law, Sportsfight shall not be responsible for any harm resulting from downloading or accessing any information or material, the quality of servers, games, products, Sportsfight services or sites, cancellation of competition and prizes. Sportsfight disclaims any responsibility for, and if a User pays for access to one of Sportsfight Services the User will not be entitled to a refund as a result of, any inaccessibility that is caused by Sportsfight maintenance on the servers or the technology that underlies our sites, failures of Sportsfight service providers (including telecommunications, hosting, and power providers), computer viruses, natural disasters or other destruction or damage of our facilities, acts of nature, war, civil disturbance, or any other cause beyond our reasonable control. In addition, Sportsfight does not provide any warranty as to the content on the Sportsfight(s). Sportsfight(s) content is distributed on an &quot;as is, as available&quot; basis.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any material accessed, downloaded or otherwise obtained through Sportsfight is done at the User&#39;s discretion, competence, acceptance and risk, and the User will be solely responsible for any potential damage to User&#39;s computer system or loss of data that results from a User&#39;s download of any such material.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight shall make best endeavours to ensure that the Sportsfight(s) is error-free and secure, however, neither Sportsfight nor any of its partners, licensors or associates makes any warranty that:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>the Sportsfight(s) will meet Users&#39; requirements,</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight(s) will be uninterrupted, timely, secure, or error free</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>the results that may be obtained from the use of Sportsfight(s) will be accurate or reliable; and</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>the quality of any products, Sportsfight Services, information, or other material that Users purchase or obtain through Sportsfight.in will meet Users&#39; expectations.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In case Sportsfight discovers any error, including any error in the determination of Winners or in the transfer of amounts to a User&#39;s account, Sportsfight reserves the right (exercisable at its discretion) to rectify the error in such manner as it deems fit, including through a set-off of the erroneous payment from amounts due to the User or deduction from the User&#39;s account of the amount of erroneous payment. In case of exercise of remedies in accordance with this clause, Sportsfight agrees to notify the User of the error and of the exercise of the remedy(ies) to rectify the same.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To the extent permitted under law, neither Sportsfight nor its partners, licensors or associates shall be liable for any direct, indirect, incidental, special, or consequential damages arising out of the use of or inability to use our sites, even if we have been advised of the possibility of such damages.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any Sportsfight Services, events or Contest(s) being hosted or provided, or intended to be hosted on Sportsfight platform and requiring specific permission or authority from any statutory authority or any state or the central government, or the board of directors shall be deemed cancelled or terminated, if such permission or authority is either not obtained or denied either before or after the availability of the relevant Sportsfight Services, events or Contest(s) are hosted or provided.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To the extent permitted under law, in the event of suspension or closure of any Services, events or Contests, Users (including Participants) shall not be entitled to make any demands, claims, on any nature whatsoever.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Standard Terms and Conditions of Promotions</strong></p>\r\n\r\n<p>These standard terms and conditions of promotions (&ldquo;Standard Terms&rdquo;) supplement the terms of promotions undertaken on the Sportsfight website and which reference these Standard Terms (each a &ldquo;Promotion&rdquo;):</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participation in any Promotion will be subject to a user complying with the Promotion Terms implemented by Sportsfight in respect of such Promotion (&ldquo;Promotion Terms&rdquo;) and these Standard Terms. By participating in any Promotion, the participant further consents to and agrees to adhere with the terms and conditions of the Sportsfight game and Sportsfight privacy policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Promotions are only open to users in India. Participation in the Promotions by proxy is not permitted.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participation in the Promotions is voluntary.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participation in one Promotion does not guarantee that such user will be eligible to participate in another Promotion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A user may participate in a Promotion and avail of each Promotion only through one account. An existing user of Sportsfight shall not register a new account or operate more than one user account with Sportsfight or participate in a Promotion by registering a new account.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users intending to participate in a Promotion may be required to verify their mobile number and other account details in accordance with the Promotion Terms for such Promotion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Persons intending to participate in a Promotion, who have listed their phone numbers on the National Do Not Call Registry (&ldquo;NDNC Registry&rdquo;), shall de-register themselves from the NDNC Registry till the completion of such Promotion (including the delivery of Bonus Amount (if any) or the free-entry (if any) under such Promotion). Such persons agree not to make any claim or raise any complaint whatsoever against Sportsfight in this respect. Please note that persons intending to participate in a Promotion who have not de-registered themselves from the NDNC Registry shall also have no right to make any claim or raise any complaints against Sportsfight if they do or do not receive any call or SMS with respect to their participation and all other matters pertaining to a Promotion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The verification process may require you to submit personal information about yourself. You agree to receive communication from Sportsfight. Any information collected in respect of your identity and contact details as part of a Promotion or otherwise in the course of your use of the Sportsfight Website shall be subject to Sportsfight Privacy Policy</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may, at its sole and absolute discretion, disqualify any user from a Promotion if such user engages in or it is found that such user has engaged in any illegal, unlawful or improper conduct (with regard to any of the Promotions or otherwise).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Bonus Amount (if any) deposited into the user&rsquo;s account can be used to join cash contests and contests on Sportsfight. However, the Bonus Amount (if any) cannot be: (i) used to join 2-member contests; or (ii) withdrawn or transferred to any other cash balance account held by you with Sportsfight or to any third party account or to any bank/payment instrument account. THE BONUS AMOUNT (IF ANY) SHALL EXPIRE AND BE WITHOUT EFFECT AT THE END OF FOURTEEN DAYS FROM THE DATE OF CREDIT OF THE BONUS AMOUNT (IF ANY).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The deposit of the Bonus Amount (if applicable) or the grant of the free-entry (if any) shall be at the sole discretion of Sportsfight and shall be subject to the user&rsquo;s compliance with these Standard Terms and the applicable Promotion Terms. Sportsfight may substitute or change the Bonus Amount(if any) or free-entry (if any) offered under a Promotion at any time without notice. Users may not substitute Bonus Amount (if any) or free-entry (if any) for other items or exchange for cash.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight reserves the right to withhold or forfeit the benefits of a Promotion (including a free-entry or Bonus Amount due to a participant or any prizes/winnings earned by the participant by using such benefits) in the event that it determines or reasonably believes that the participating user has violated these Standard Terms, the applicable Promotion Terms or the terms and conditions of the Sportsfight fantasy game(s).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Mere participation in a Promotion does not entitle the participant to receive any free-entry or Bonus Amount(s) indicated as a prize under such Promotion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The decision of Sportsfight will be final and binding with respect to the Promotions, and the prizes therein and no correspondence, objection, complaints, etc. will be entertained in this regard.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Each Promotion cannot be clubbed with any of other contest/offer/promotion that are running simultaneously and organised or conducted by Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight reserves the right to change/modify/or withdraw any of the Promotions and/or change these Standard Terms and/or the Promotion Terms without any prior notice of the same at its sole discretion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight does not make any commitment, express or implied, to respond to any feedback, suggestion and, or, queries of the participants of the Promotions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Notwithstanding anything contained herein, the aggregate liability of Sportsfight to a participating user in relation to any Promotion for any reason whatsoever shall not exceed Rs. 50.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Promotions shall be governed by the laws of the Republic of India, and any disputes or disagreements in respect of this Promotion shall be subject to the exclusive jurisdiction of the courts of Mumbai.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Standard Terms and Conditions of &quot;Invite Friends&quot; program.</p>\r\n\r\n<p>The Sportsfight Invite Friends Program lets you invite friends to join Sportsfight (&quot;Program&quot;). In the event that you and your referred friend meet the criteria and complete all the steps specified in these terms, you and your friend can earn a Cash Bonus from Sportsfight of upto Rs. 100 (&quot;Bonus Amount&quot;), which Bonus Amount will be redeemable to join cash contests and contests through the Sportsfight mobile application for the iOS and/or Android mobile devices (&quot;Sportsfight Application&quot;). To participate in the Program, please note our terms and conditions (&quot;Terms&quot;) in this respect, as they govern your participation in the Program:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Eligibility &ndash; All users who: (i) have an account registered with Sportsfight fantasy gaming platform (&quot;Platform&quot;) which account has been verified by Sportsfight; and (ii) are eligible to participate in the pay-to play Sportsfight fantasy cricket, fantasy basketball, fantasy hockey, fantasy volleyball, fantasy kabbadi or football game (as per the Sportsfight terms and conditions, accessible at https://sportsfight.in/in/termsandconditions); and (iii) have downloaded and installed the Sportsfight Application on their respective mobile devices, will be eligible to participate in the Program. Participation in the Program by proxy is not permitted.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participation in the Program is voluntary. A user shall not register or operate more than one user account with Sportsfight and shall not participate in the Program with more than one user account with Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Program will be open for participation from Indian Standard Time 18:00:00 hours on 25th January 2017 till IST 23:59:59 hours on 28th February, 2020.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>By participating in the Program, you agree to and accept these Terms.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>For the purpose of participation in the Program, you are required to have the Sportsfight Application downloaded and installed on your mobile device. Through the Sportsfight Application, you will be provided with a unique link or code, which can be shared by you (&quot;Inviter&quot;) with friends (each an &quot;Invitee&quot;) for the purpose of inviting such friends to create and register an account with Sportsfight and download the Sportsfight Application. On receiving the link or code from the Inviter, the Invitee may either: (i) Click on the link, consequent to which such Invitee will be directed to a registration page and will be provided the option to register an account with Sportsfight and download and install the Sportsfight Application on his/her device; or (ii) download and install the Sportsfight Application on his/her device independently, register for a Sportsfight account through the Sportsfight Application and enter the unique code shared by the Inviter where prompted in the Deam11 Application.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Inviter and the Invitee will be eligible to earn the Bonus Amount subject to (amongst other terms specified in these Terms): (i) the Invitee not being an existing user of Sportsfight; and (ii) the Inviter and Invitee being eligible to participate in the pay-to play Sportsfight fantasy cricket, fantasy basketball, fantasy hockey, fantasy volleyball, fantasy kabbadi or football game; and (iii) the Invitee successfully registering for an account with Sportsfight through the unique link or by using the unique code shared by the Inviter; and (iv) the Inviter and Invitee agreeing to the license agreement for the Sportsfight Application and downloading and installing the Sportsfight Application as available for the Inviter&rsquo;s and Invitee&rsquo;s respective mobile devices; and (v) the Inviter and Invitee verifying the Inviter&rsquo;s and the Invitee&rsquo;s respective mobile number as provided at the time of registration within thirty (30) days from the date on which Invitee registers for an account with Sportsfight (&quot;Verification Period&quot;). For the purposes of these Terms, an &#39;existing user of Sportsfight shall mean a user who presently operates an account with the Platform or operated an account with the Platform at any point of time.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>An Invitee who is an existing user of Sportsfight is not permitted to register a new account with the Platform for the purpose of availing of the Bonus Amount. Sportsfight will determine in its sole discretion whether an Invitee is an existing user of Sportsfight or not and take appropriate action.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The verification process may require an Inviter/Invitee to submit personal information about the user (Inviter/Invitee) and documents identifying the Inviter/Invitee. The Inviter agrees to receive communication from Sportsfight and to allow Sportsfight to communicate with Invitees referred by you about the Inviter&#39;s participation in the Program. Any information collected in respect of the Inviter/Invitee as part of the Program or otherwise in the course of such person&#39;s use of the Website shall be subject to Sportsfight Privacy Policy (available here:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The verification of an Inviter/Invitee shall be completed at the time of first withdrawal by the Inviter/Invitee from the Inviter&rsquo;s/Invitee&#39;s &#39;Your Winnings&#39; account or &#39;Your Deposits&#39; account with the Platform. An Inviter/Invitee may voluntarily seek verification of the Inviter/Invitee by clicking on the &#39;Verify Now&#39; tab of the Account Balance page of the Inviter/Invitee&#39;s account with the Platform. In the event that the Invitee opts to register for a Sportsfight account through the Sportsfight Application, the Invitee can verify his/her contact information at the time of registration.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Invitee will be eligible to earn a Bonus of Rs.100 (&ldquo;Invitee Bonus&rdquo;) upon a) successful verification of the Invitee&rsquo;s mobile number. b) Provided that the Invitee completes the step mentioned in a) above within the Verification Period, the applicable Invitee Bonus shall be credited to the Invitee&#39;s Cash Bonus Account with the Platform, within fifteen (15) days of completion of successful verification of the Invitee&rsquo;s mobile number. In the event that the Invitee fails to verify the Invitee&#39;s mobile number within the Verification Period or omits to provide documents requested for such verification, the Invitee shall not receive the applicable Invitee Bonus specified above due to the Invitee for completing such verification process.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Inviter Bonus a) In order for an Inviter to be eligible to earn the Bonus Amount due to him/her (&quot;Inviter Bonus&quot;), the Inviter must also download and install the Sportsfight Application on his/her mobile device verify his/her mobile number and email address prior to the completion of the Verification Period. b) The credit of the Inviter Bonus is contingent on the Invitee&#39;s participation in cash contests on the Platform. For every Rs. 1 spent by the Invitee to join cash contests on the Platform, the Inviter will be eligible to earn a bonus amount of Rs. 0.50 subject to a maximum of Rs. 100. As an example, in the event that the invitee uses Rs. 100 from his Cash Bonus Account or Unutilized Account to join a cash contest or contest through a Sportsfight Application, the Inviter shall be eligible to receive Rs. 50 as Inviter Bonus upon the successful completion of such contest or contest, provided that the Inviter has successfully completed the requisite steps detailed in a) above that make him/her eligible to receive such amount. c) Subject to the provisions of a) and b) above, the applicable Inviter Bonus earned by the Inviter shall be credited to the Inviter&#39;s Cash Bonus Account within fifteen (15) days of the completion of the cash contest or contest in which Invitee has used the Invitee Bonus or within fifteen (15) days of the Inviter completing the relevant step verification process, as the case may be. In the event that the Inviter fails to complete any of the verification steps within the Verification Period or omits to provide documents requested for such verification, the Inviter shall not be eligible to earn the applicable Inviter Bonus. d) It is clarified that the Inviter will be eligible to receive the Inviter Bonus with respect to any contests or contests only in the event the winners are declared for such contests or contests only. In the event that the contest entry amount paid by the Invitee is refunded to the Invitee with respect to any cash contest or contest, for any reason, the Inviter shall not be eligible to receive any Inviter Bonus for such contest or contest.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Bonus Amounts credited to the Inviter/Invitee can be used by the Inviter/Invitee to join cash contests and contests offered by Sportsfight through the Platform. No part of the Bonus Amount may be used to join private contests or be withdrawn or transferred to any other cash balance account held by the Inviter/Invitee with Sportsfight or to any third party account or to any bank/payment instrument account. THE BONUS AMOUNT SHALL EXPIRE AND BE WITHOUT EFFECT AT THE END OF FOURTEEN DAYS FROM THE DATE OF CREDIT OF THE BONUS AMOUNT.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The deposit of the Bonus Amount shall be at the sole discretion of Sportsfight and shall be subject to the Inviter&rsquo;s/Invitee&rsquo;s compliance with these Terms. Sportsfight may substitute or change the Bonus Amount offered under the Program at any time without notice. An Inviter/Invitee may not substitute the amount of Bonus Amount or substitute offering for other items or exchange for cash.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight reserves the right to:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>withhold the deposit of the Bonus Amount; and/or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>forfeit any deposited Bonus Amount to an Inviter/Invitee or any prizes/winnings earned by the participant by using such Bonus Amount; and/or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>deactivate the accounts of the Inviter/Invitee, in the event that it determines or reasonably believes that such Inviter/Invitee has violated these Terms or the terms and conditions of the Sportsfight fantasy games.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Mere participation in the Program does not entitle the Inviter/Invitee to receive any Bonus Amount.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may, at its sole and absolute discretion, disqualify any Inviter/Invitee if such Inviter/Invitee engages in or it is found that such Inviter/Invitee has engaged in any illegal, unlawful or improper conduct (with regard to the Program or otherwise).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The decision of Sportsfight will be final and binding with regard to the Program, and the deposit of the Bonus Amount and no correspondence, objection, complaints, etc. will be entertained in this regard.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This Program cannot be clubbed with any other contests/promotions/programs that are running simultaneously and organised or conducted by Sportsfight.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight reserves the right to change/modify/or withdraw the Program and/or change these terms and conditions without any prior notice of the same at its sole discretion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Terms and Conditions, as applicable to the Sportsfight fantasy games and services, will apply to and govern the Program.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight does not make any commitment, express or implied, to respond to any feedback, suggestion and, or, queries of the participants (Inviter/Invitee) of the Program.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Notwithstanding anything contained herein, the aggregate liability of Sportsfight&nbsp; to a participating Inviter/Invitee in relation to the Program for any reason whatsoever shall not exceed Rs.100.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'terms-and-conditions', 'terms-and-conditions', 'Terms and conditions', NULL, '<p>&nbsp;</p>\r\n\r\n<h5 dir=\"ltr\"><strong>Last Updated: 11 April, 2020</strong></h5>\r\n\r\n<ol>\r\n	<li dir=\"ltr\">\r\n	<p dir=\"ltr\"><strong><span style=\"background-color:transparent; font-size:9pt\">Sportsfight</span></strong><br />\r\n	<span style=\"background-color:transparent; font-size:9pt\">Sportsfight</span><span style=\"background-color:transparent; font-size:9pt\"> is the flagship brand of Radhadevi Technologies Private Limited (&quot;</span><span style=\"background-color:transparent; font-size:9pt\">Sportsfight</span><span style=\"background-color:transparent; font-size:9pt\">&quot;). Through </span><span style=\"background-color:transparent; font-size:9pt\">Sportsfight</span><span style=\"background-color:transparent; font-size:9pt\">, along with its sub-pages, and the </span><span style=\"background-color:transparent; font-size:9pt\">Sportsfight</span><span style=\"background-color:transparent; font-size:9pt\"> App, </span><span style=\"background-color:transparent; font-size:9pt\">Sportsfight</span><span style=\"background-color:transparent; font-size:9pt\"> operates five separate portals through which it offers cricket based, football based, basketball based, volleyball based, hockey based and kabaddi based online fantasy games. </span><span style=\"background-color:transparent; font-size:9pt\">Sportsfight</span><span style=\"background-color:transparent;', NULL, '2020-04-12 01:56:50', '2020-04-21 00:21:34');
INSERT INTO `pages` (`id`, `title`, `page_content`, `slug`, `url`, `meta_title`, `meta_key`, `meta_description`, `images`, `created_at`, `updated_at`) VALUES
(22, 'Disclaimer', '<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">To the extent permitted under law, neither Sportsfight nor its parent/holding company, subsidiaries, affiliates, directors, officers, professional advisors, employees shall be responsible for the deletion, the failure to store, the misdelivery, or the untimely delivery of any information or material.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">To the extent permitted under law, Sportsfight shall not be responsible for any harm resulting from downloading or accessing any information or material, the quality of servers, games, products, Sportsfight services or sites, cancellation of competition and prizes. Sportsfight disclaims any responsibility for, and if a User pays for access to one of Sportsfight Services the User will not be entitled to a refund as a result of, any inaccessibility that is caused by Sportsfight maintenance on the servers or the technology that underlies our sites, failures of Sportsfight service providers (including telecommunications, hosting, and power providers), computer viruses, natural disasters or other destruction or damage of our facilities, acts of nature, war, civil disturbance, or any other cause beyond our reasonable control. In addition, Sportsfight does not provide any warranty as to the content on the Sportsfight(s). Sportsfight(s) content is distributed on an &quot;as is, as available&quot; basis.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Any material accessed, downloaded or otherwise obtained through Sportsfight is done at the User&#39;s discretion, competence, acceptance and risk, and the User will be solely responsible for any potential damage to User&#39;s computer system or loss of data that results from a User&#39;s download of any such material.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Sportsfight shall make best endeavours to ensure that the Sportsfight(s) is error-free and secure, however, neither Sportsfight nor any of its partners, licensors or associates makes any warranty that:</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">the Sportsfight(s) will meet Users&#39; requirements,</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Sportsfight(s) will be uninterrupted, timely, secure, or error free</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">the results that may be obtained from the use of Sportsfight(s) will be accurate or reliable; and</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">the quality of any products, Sportsfight Services, information, or other material that Users purchase or obtain through Sportsfight.in will meet Users&#39; expectations.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">In case Sportsfight discovers any error, including any error in the determination of Winners or in the transfer of amounts to a User&#39;s account, Sportsfight reserves the right (exercisable at its discretion) to rectify the error in such manner as it deems fit, including through a set-off of the erroneous payment from amounts due to the User or deduction from the User&#39;s account of the amount of erroneous payment. In case of exercise of remedies in accordance with this clause, Sportsfight agrees to notify the User of the error and of the exercise of the remedy(ies) to rectify the same.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">To the extent permitted under law, neither Sportsfight nor its partners, licensors or associates shall be liable for any direct, indirect, incidental, special, or consequential damages arising out of the use of or inability to use our sites, even if we have been advised of the possibility of such damages.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Any Sportsfight Services, events or Contest(s) being hosted or provided, or intended to be hosted on Sportsfight platform and requiring specific permission or authority from any statutory authority or any state or the central government, or the board of directors shall be deemed cancelled or terminated, if such permission or authority is either not obtained or denied either before or after the availability of the relevant Sportsfight Services, events or Contest(s) are hosted or provided.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">To the extent permitted under law, in the event of suspension or closure of any Services, events or Contests, Users (including Participants) shall not be entitled to make any demands, claims, on any nature whatsoever.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Standard Terms and Conditions of Promotions</span></p>\r\n\r\n<p><span style=\"color:#000000\">These standard terms and conditions of promotions (&ldquo;Standard Terms&rdquo;) supplement the terms of promotions undertaken on the Sportsfight website and which reference these Standard Terms (each a &ldquo;Promotion&rdquo;):</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Participation in any Promotion will be subject to a user complying with the Promotion Terms implemented by Sportsfight in respect of such Promotion (&ldquo;Promotion Terms&rdquo;) and these Standard Terms. By participating in any Promotion, the participant further consents to and agrees to adhere with the terms and conditions of the Sportsfight game and Sportsfight privacy policy.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The Promotions are only open to users in India. Participation in the Promotions by proxy is not permitted.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Participation in the Promotions is voluntary.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Participation in one Promotion does not guarantee that such user will be eligible to participate in another Promotion.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">A user may participate in a Promotion and avail of each Promotion only through one account. An existing user of Sportsfight shall not register a new account or operate more than one user account with Sportsfight or participate in a Promotion by registering a new account.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Users intending to participate in a Promotion may be required to verify their mobile number and other account details in accordance with the Promotion Terms for such Promotion.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Persons intending to participate in a Promotion, who have listed their phone numbers on the National Do Not Call Registry (&ldquo;NDNC Registry&rdquo;), shall de-register themselves from the NDNC Registry till the completion of such Promotion (including the delivery of Bonus Amount (if any) or the free-entry (if any) under such Promotion). Such persons agree not to make any claim or raise any complaint whatsoever against Sportsfight in this respect. Please note that persons intending to participate in a Promotion who have not de-registered themselves from the NDNC Registry shall also have no right to make any claim or raise any complaints against Sportsfight if they do or do not receive any call or SMS with respect to their participation and all other matters pertaining to a Promotion.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The verification process may require you to submit personal information about yourself. You agree to receive communication from Sportsfight. Any information collected in respect of your identity and contact details as part of a Promotion or otherwise in the course of your use of the Sportsfight Website shall be subject to Sportsfight Privacy Policy</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Sportsfight may, at its sole and absolute discretion, disqualify any user from a Promotion if such user engages in or it is found that such user has engaged in any illegal, unlawful or improper conduct (with regard to any of the Promotions or otherwise).</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The Bonus Amount (if any) deposited into the user&rsquo;s account can be used to join cash contests and contests on Sportsfight. However, the Bonus Amount (if any) cannot be: (i) used to join 2-member contests; or (ii) withdrawn or transferred to any other cash balance account held by you with Sportsfight or to any third party account or to any bank/payment instrument account. THE BONUS AMOUNT (IF ANY) SHALL EXPIRE AND BE WITHOUT EFFECT AT THE END OF FOURTEEN DAYS FROM THE DATE OF CREDIT OF THE BONUS AMOUNT (IF ANY).</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The deposit of the Bonus Amount (if applicable) or the grant of the free-entry (if any) shall be at the sole discretion of Sportsfight and shall be subject to the user&rsquo;s compliance with these Standard Terms and the applicable Promotion Terms. Sportsfight may substitute or change the Bonus Amount(if any) or free-entry (if any) offered under a Promotion at any time without notice. Users may not substitute Bonus Amount (if any) or free-entry (if any) for other items or exchange for cash.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Sportsfight reserves the right to withhold or forfeit the benefits of a Promotion (including a free-entry or Bonus Amount due to a participant or any prizes/winnings earned by the participant by using such benefits) in the event that it determines or reasonably believes that the participating user has violated these Standard Terms, the applicable Promotion Terms or the terms and conditions of the Sportsfight fantasy game(s).</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Mere participation in a Promotion does not entitle the participant to receive any free-entry or Bonus Amount(s) indicated as a prize under such Promotion.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The decision of Sportsfight will be final and binding with respect to the Promotions, and the prizes therein and no correspondence, objection, complaints, etc. will be entertained in this regard.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Each Promotion cannot be clubbed with any of other contest/offer/promotion that are running simultaneously and organised or conducted by Sportsfight.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Sportsfight reserves the right to change/modify/or withdraw any of the Promotions and/or change these Standard Terms and/or the Promotion Terms without any prior notice of the same at its sole discretion.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Sportsfight does not make any commitment, express or implied, to respond to any feedback, suggestion and, or, queries of the participants of the Promotions.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Notwithstanding anything contained herein, the aggregate liability of Sportsfight to a participating user in relation to any Promotion for any reason whatsoever shall not exceed Rs. 50.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The Promotions shall be governed by the laws of the Republic of India, and any disputes or disagreements in respect of this Promotion shall be subject to the exclusive jurisdiction of the courts of Mumbai.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Standard Terms and Conditions of &quot;Invite Friends&quot; program.</span></p>\r\n\r\n<p><span style=\"color:#000000\">The Sportsfight Invite Friends Program lets you invite friends to join Sportsfight (&quot;Program&quot;). In the event that you and your referred friend meet the criteria and complete all the steps specified in these terms, you and your friend can earn a Cash Bonus from Sportsfight of upto Rs. 100 (&quot;Bonus Amount&quot;), which Bonus Amount will be redeemable to join cash contests and contests through the Sportsfight mobile application for the iOS and/or Android mobile devices (&quot;Sportsfight Application&quot;). To participate in the Program, please note our terms and conditions (&quot;Terms&quot;) in this respect, as they govern your participation in the Program:</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Eligibility &ndash; All users who: (i) have an account registered with Sportsfight fantasy gaming platform (&quot;Platform&quot;) which account has been verified by Sportsfight; and (ii) are eligible to participate in the pay-to play Sportsfight fantasy cricket, fantasy basketball, fantasy hockey, fantasy volleyball, fantasy kabbadi or football game (as per the Sportsfight terms and conditions, accessible at https://sportsfight.in/in/termsandconditions); and (iii) have downloaded and installed the Sportsfight Application on their respective mobile devices, will be eligible to participate in the Program. Participation in the Program by proxy is not permitted.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Participation in the Program is voluntary. A user shall not register or operate more than one user account with Sportsfight and shall not participate in the Program with more than one user account with Sportsfight.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The Program will be open for participation from Indian Standard Time 18:00:00 hours on 25th January 2017 till IST 23:59:59 hours on 28th February, 2020.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">By participating in the Program, you agree to and accept these Terms.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">For the purpose of participation in the Program, you are required to have the Sportsfight Application downloaded and installed on your mobile device. Through the Sportsfight Application, you will be provided with a unique link or code, which can be shared by you (&quot;Inviter&quot;) with friends (each an &quot;Invitee&quot;) for the purpose of inviting such friends to create and register an account with Sportsfight and download the Sportsfight Application. On receiving the link or code from the Inviter, the Invitee may either: (i) Click on the link, consequent to which such Invitee will be directed to a registration page and will be provided the option to register an account with Sportsfight and download and install the Sportsfight Application on his/her device; or (ii) download and install the Sportsfight Application on his/her device independently, register for a Sportsfight account through the Sportsfight Application and enter the unique code shared by the Inviter where prompted in the Deam11 Application.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The Inviter and the Invitee will be eligible to earn the Bonus Amount subject to (amongst other terms specified in these Terms): (i) the Invitee not being an existing user of Sportsfight; and (ii) the Inviter and Invitee being eligible to participate in the pay-to play Sportsfight fantasy cricket, fantasy basketball, fantasy hockey, fantasy volleyball, fantasy kabbadi or football game; and (iii) the Invitee successfully registering for an account with Sportsfight through the unique link or by using the unique code shared by the Inviter; and (iv) the Inviter and Invitee agreeing to the license agreement for the Sportsfight Application and downloading and installing the Sportsfight Application as available for the Inviter&rsquo;s and Invitee&rsquo;s respective mobile devices; and (v) the Inviter and Invitee verifying the Inviter&rsquo;s and the Invitee&rsquo;s respective mobile number as provided at the time of registration within thirty (30) days from the date on which Invitee registers for an account with Sportsfight (&quot;Verification Period&quot;). For the purposes of these Terms, an &#39;existing user of Sportsfight shall mean a user who presently operates an account with the Platform or operated an account with the Platform at any point of time.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">An Invitee who is an existing user of Sportsfight is not permitted to register a new account with the Platform for the purpose of availing of the Bonus Amount. Sportsfight will determine in its sole discretion whether an Invitee is an existing user of Sportsfight or not and take appropriate action.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The verification process may require an Inviter/Invitee to submit personal information about the user (Inviter/Invitee) and documents identifying the Inviter/Invitee. The Inviter agrees to receive communication from Sportsfight and to allow Sportsfight to communicate with Invitees referred by you about the Inviter&#39;s participation in the Program. Any information collected in respect of the Inviter/Invitee as part of the Program or otherwise in the course of such person&#39;s use of the Website shall be subject to Sportsfight Privacy Policy (available here:</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The verification of an Inviter/Invitee shall be completed at the time of first withdrawal by the Inviter/Invitee from the Inviter&rsquo;s/Invitee&#39;s &#39;Your Winnings&#39; account or &#39;Your Deposits&#39; account with the Platform. An Inviter/Invitee may voluntarily seek verification of the Inviter/Invitee by clicking on the &#39;Verify Now&#39; tab of the Account Balance page of the Inviter/Invitee&#39;s account with the Platform. In the event that the Invitee opts to register for a Sportsfight account through the Sportsfight Application, the Invitee can verify his/her contact information at the time of registration.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The Invitee will be eligible to earn a Bonus of Rs.100 (&ldquo;Invitee Bonus&rdquo;) upon a) successful verification of the Invitee&rsquo;s mobile number. b) Provided that the Invitee completes the step mentioned in a) above within the Verification Period, the applicable Invitee Bonus shall be credited to the Invitee&#39;s Cash Bonus Account with the Platform, within fifteen (15) days of completion of successful verification of the Invitee&rsquo;s mobile number. In the event that the Invitee fails to verify the Invitee&#39;s mobile number within the Verification Period or omits to provide documents requested for such verification, the Invitee shall not receive the applicable Invitee Bonus specified above due to the Invitee for completing such verification process.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Inviter Bonus a) In order for an Inviter to be eligible to earn the Bonus Amount due to him/her (&quot;Inviter Bonus&quot;), the Inviter must also download and install the Sportsfight Application on his/her mobile device verify his/her mobile number and email address prior to the completion of the Verification Period. b) The credit of the Inviter Bonus is contingent on the Invitee&#39;s participation in cash contests on the Platform. For every Rs. 1 spent by the Invitee to join cash contests on the Platform, the Inviter will be eligible to earn a bonus amount of Rs. 0.50 subject to a maximum of Rs. 100. As an example, in the event that the invitee uses Rs. 100 from his Cash Bonus Account or Unutilized Account to join a cash contest or contest through a Sportsfight Application, the Inviter shall be eligible to receive Rs. 50 as Inviter Bonus upon the successful completion of such contest or contest, provided that the Inviter has successfully completed the requisite steps detailed in a) above that make him/her eligible to receive such amount. c) Subject to the provisions of a) and b) above, the applicable Inviter Bonus earned by the Inviter shall be credited to the Inviter&#39;s Cash Bonus Account within fifteen (15) days of the completion of the cash contest or contest in which Invitee has used the Invitee Bonus or within fifteen (15) days of the Inviter completing the relevant step verification process, as the case may be. In the event that the Inviter fails to complete any of the verification steps within the Verification Period or omits to provide documents requested for such verification, the Inviter shall not be eligible to earn the applicable Inviter Bonus. d) It is clarified that the Inviter will be eligible to receive the Inviter Bonus with respect to any contests or contests only in the event the winners are declared for such contests or contests only. In the event that the contest entry amount paid by the Invitee is refunded to the Invitee with respect to any cash contest or contest, for any reason, the Inviter shall not be eligible to receive any Inviter Bonus for such contest or contest.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The Bonus Amounts credited to the Inviter/Invitee can be used by the Inviter/Invitee to join cash contests and contests offered by Sportsfight through the Platform. No part of the Bonus Amount may be used to join private contests or be withdrawn or transferred to any other cash balance account held by the Inviter/Invitee with Sportsfight or to any third party account or to any bank/payment instrument account. THE BONUS AMOUNT SHALL EXPIRE AND BE WITHOUT EFFECT AT THE END OF FOURTEEN DAYS FROM THE DATE OF CREDIT OF THE BONUS AMOUNT.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The deposit of the Bonus Amount shall be at the sole discretion of Sportsfight and shall be subject to the Inviter&rsquo;s/Invitee&rsquo;s compliance with these Terms. Sportsfight may substitute or change the Bonus Amount offered under the Program at any time without notice. An Inviter/Invitee may not substitute the amount of Bonus Amount or substitute offering for other items or exchange for cash.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Sportsfight reserves the right to:</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">withhold the deposit of the Bonus Amount; and/or</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">forfeit any deposited Bonus Amount to an Inviter/Invitee or any prizes/winnings earned by the participant by using such Bonus Amount; and/or</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">deactivate the accounts of the Inviter/Invitee, in the event that it determines or reasonably believes that such Inviter/Invitee has violated these Terms or the terms and conditions of the Sportsfight fantasy games.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Mere participation in the Program does not entitle the Inviter/Invitee to receive any Bonus Amount.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Sportsfight may, at its sole and absolute discretion, disqualify any Inviter/Invitee if such Inviter/Invitee engages in or it is found that such Inviter/Invitee has engaged in any illegal, unlawful or improper conduct (with regard to the Program or otherwise).</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The decision of Sportsfight will be final and binding with regard to the Program, and the deposit of the Bonus Amount and no correspondence, objection, complaints, etc. will be entertained in this regard.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">This Program cannot be clubbed with any other contests/promotions/programs that are running simultaneously and organised or conducted by Sportsfight.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Sportsfight reserves the right to change/modify/or withdraw the Program and/or change these terms and conditions without any prior notice of the same at its sole discretion.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">The Terms and Conditions, as applicable to the Sportsfight fantasy games and services, will apply to and govern the Program.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Sportsfight does not make any commitment, express or implied, to respond to any feedback, suggestion and, or, queries of the participants (Inviter/Invitee) of the Program.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">Notwithstanding anything contained herein, the aggregate liability of Sportsfight&nbsp; to a participating Inviter/Invitee in relation to the Program for any reason whatsoever shall not exceed Rs.100.</span></p>', 'disclaimer', 'disclaimer', 'Disclaimer', 'disclaimer', '<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">To the extent permitted under law, neither Sportsfight nor its parent/holding company, subsidiaries, affiliates, directors, officers, professional advisors, employees shall be responsible for the deletion, the failure to store, the misdelivery, or the untimely delivery of any information or material.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\">To the extent permitted under law, Sportsfight shall not be responsible for any harm resulting from downloading or accessing any information or material, the quality of servers, games, products, Sportsfight services or sites, cancellation of competition and prizes. Sportsfight', NULL, '2020-04-21 00:04:39', '2020-04-21 00:22:57'),
(23, 'Legality', '<p><span style=\"color:#008080\"><strong>Sportsfight Legality</strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Games of skill are legal, as they are excluded from the ambit of Indian gambling legislations including, the Public Gambling Act of 1867. The Indian Supreme Court in the cases of State of Andhra Pradesh v. K Satyanarayana (AIR 1968 SC 825) and KR Lakshmanan v. State of Tamil Nadu (AIR 1996 SC 1153) has held that a game in which success depends predominantly upon the superior knowledge, training, attention, experience, and adroitness of the player shall be classified as a game of skill.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Contest (s) described above (across the Sportsfight Services) are games of skill as success of Participants depends primarily on their superior knowledge of the games of cricket and/or football and/or basketball and/or hockey and/or volleyball and/or kabaddi statistics, knowledge of players&#39; relative form, players&#39; performance in a particular territory, conditions and/or format (such as ODIs, test cricket and Twenty20 in the cricket fantasy game), attention and dedication towards the Contest(s) and adroitness in playing the Contest(s). The Contest(s) also requires Participants to field well-balanced sides with limited resources and make substitutions at appropriate times to gain the maximum points.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>By participating in this Contest(s), each Participant acknowledges and agrees that he/she is participating in a game of skill.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Eligibility</strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Contest(s) are open only to persons above the age of 18 years.</p>\r\n\r\n<p>The Contest(s) are open only to persons, currently residing in India.</p>\r\n\r\n<p>Sportsfight may, in accordance with the laws prevailing in certain Indian states, bar individuals residing in those states from participating in the Contest(s). Currently, individuals residing in the Indian states of Assam, Odisha, Sikkim, Nagaland or Telangana may not participate in the paid version of the Contest as the laws of these states bar persons from participating in games of skill where participants are required to pay to enter.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Persons who wish to participate must have a valid email address.</p>\r\n\r\n<p>Sportsfight may on receipt of information bar a person from participation and/or withdrawing winning amounts if such person is found to be one with insider knowledge of participating teams in any given contests/match, organizing boards, leagues, etc.</p>\r\n\r\n<p>Only those Participants who have successfully registered on the Sportsfight as well as registered prior to each match in accordance with the procedure outlined above shall be eligible to participate in the Contest and win prizes.</p>', 'legality', 'legality', 'Legality', 'legality , sportsfight', '<p><span style=\"color:#008080\"><strong>Sportsfight Legality</strong></span></p>\r\n\r\n<p>Games of skill are legal, as they are excluded from the ambit of Indian gambling legislations including, the Public Gambling Act of 1867. The Indian Supreme Court in the cases of State of Andhra Pradesh v. K Satyanarayana (AIR 1968 SC 825) and KR Lakshmanan v. State of Tamil Nadu (AIR 1996 SC 1153) has held that a game in which success depends predominantly upon the superior knowledge, training, attention, experience, and adroitness of the player shall be', NULL, '2020-04-21 00:10:43', '2020-04-21 00:13:09');
INSERT INTO `pages` (`id`, `title`, `page_content`, `slug`, `url`, `meta_title`, `meta_key`, `meta_description`, `images`, `created_at`, `updated_at`) VALUES
(24, 'Payment Terms', '<p>&nbsp;</p>\r\n\r\n<p>In respect of any transactions entered into on the Sportsfight platform, including making a payment to participate in the paid versions of Contest(s), Users agree to be bound by the following payment terms:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The payment of pre-designated amount Users make to participate in the Contest(s) is inclusive of the pre-designated platform fee for access to the Sportsfight Services charged by Sportsfight and pre-determined participant&rsquo;s contribution towards prize money pool.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Subject to these Terms and Conditions, all amounts collected from the User are held in a separate non-interest earning bank Accounts. The said accounts are operated by a third party appointed by Sportsfight in accordance with Clause 10 of these Terms and Conditions. From these bank accounts, the payouts can be made to (a) Users (towards their withdrawals), (b) Sportsfight (towards its Platform Fees) and to (c) Government (towards TDS on Winnings Amount). Sportsfight receives only its share of the platform Fees through the said Escrow Agent.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Sportsfight reserves the right to charge a Platform Fee, which would be specified and notified by Sportsfight on the Contest page, being created on Sportsfight platform, prior to a User&#39;s joining of such Contest. The Platform Fee (inclusive of applicable tax thereon) will be debited from the User&rsquo;s account balance and Sportsfight shall issue an invoice for such debit to the User.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The User may participate in a Contest wherein the User has to contribute a pre-specified contribution towards the Prize Money Pool of such Contest, which will be passed on to the Winner(s) of the Contest after the completion of the Contest as per the terms and conditions of such Contest. It is clarified that Sportsfight has no right or interest in this Prize Money Pool, and only acts as an intermediary engaged in collecting and distributing the Prize Money Pool in accordance with the Contest terms and conditions. The amount to be paid-in by the User towards the Prize Money Pool would also be debited from the User&rsquo;s account balance maintained with the Trustee.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any user availing Sportsfight&nbsp; services are provided with two categories of accounts for the processing and reconciliation of payments: (i) &#39;Unutilized&#39; Account, (ii) Winnings Account. It is clarified that in no instance the transfer of any amounts in the User&#39;s accounts to any other category of account held by the user or any third party account, including a bank account held by a third party:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>User&#39;s winnings in any Contest will reflect as credits to the User&#39;s Winnings Account.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>User&rsquo;s remitting the amount the designated payment gateway shall be credited to User&rsquo;s Unutlized Account&rsquo;.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Each time a User participates in any contest on Sportsfight platform, the pre-designated amount shall be debited in the User&rsquo;s account. In debiting amounts from the User&rsquo;s accounts towards the pre-designated amount of such user shall be debited from the User&rsquo;s Unutilized Account and thereafter, any remaining amount of participation fee shall be debited from the User&rsquo;s Winning Account.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In case there is any amount remaining to be paid by the User in relation to such User&rsquo;s participation in any match(s) or Contest(s), the User will be taken to the designated payment gateway to give effect to such payment. In case any amount added by the User through such payment gateway exceeds the remaining amount of the pre-designated amount, the amount in excess shall be transferred to the User&rsquo;s &lsquo;Unutilized&rsquo; Account and will be available for use in participation in any match(s) or Contest(s) or for withdrawal in accordance with these Terms and Conditions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Debits from the &lsquo;Unutilized&rsquo; Account for the purpose of enabling a user&rsquo;s participation in a Contest shall be made in order of the date of credit of amounts in the &lsquo;Unutilized&rsquo; Account, and accordingly amounts credited into &lsquo;Unutilized&rsquo; Account earlier in time shall be debited first.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A User shall be permitted to withdraw any amounts credited into such User&#39;s &#39;Unutilized&#39; Account for any reason whatsoever by contacting Sportsfight Customer Support. All amounts credited into a User&#39;s &#39;Unutilized&#39; Account must be utilised within 335 days of credit. In case any unutilised amount lies in the &#39;Unutilized&#39; Account after the completion of 335 days from the date of credit of such amount, Sportsfight reserves the right to forfeit such unutilised amount, without liability or obligation to pay any compensation to the User.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Withdrawal of any amount standing to the User&#39;s credit in the Winnings Account may be made by way of a request to Sportsfight but shall occur automatically upon completion of 335 days from the date of credit of such amount in the User&#39;s Winnings Account. In either case, Sportsfight shall effect an online transfer to the User&#39;s bank account on record with Sportsfight within a commercially reasonable period of time. Such transfer will reflect as a debit to the User&#39;s Winnings Account. Sportsfight shall not charge any processing fee for the online transfer of such amount from the Winnings Account to the User&#39;s bank account on record with Sportsfight. Users are requested to note that they will be required to provide valid photo identification and address proof documents for proof of identity and address in order for Sportsfight to process the withdrawal request. The name mentioned on the User&#39;s photo identification document should correspond with the name provided by the User at the time of registration on Sportsfight, as well as the name and address existing in the records of the User&#39;s bank account as provided to Sportsfight. In the event that no bank account has been registered by the User against such User&#39;s account with Sportsfight, or the User has not verified his/her User account with Sportsfight, to Sportsfight satisfaction and in accordance with these Terms and Conditions, Sportsfight shall provide such User with a notification to the User&#39;s email address as on record with Sportsfight at least 30 days prior to the Auto Transfer Date, and in case the User fails to register a bank account with his/her User Account and/or to verify his/her User Account by the Auto Transfer Date, Sportsfight shall be entitled to forfeit any amounts subject to transfer on the Auto Transfer Date. Failure to provide Sportsfight with a valid bank account or valid identification documents (to Sportsfight satisfaction) may result in the forfeiture of any amounts subject to transfer in accordance with this clause.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Further, in order to conduct promotional activities, Sportsfight may gratuitously issue Cash Bonus to the User for the purpose of participation in any Contest(s) and no User shall be permitted to transfer or request the transfer of any amount in to the Cash Bonus. The usage of any Cash Bonus issued shall be subject to the limitations and restrictions, including without limitation, restrictions as to time within which such Cash Bonus must be used, as applied by Sportsfight and notified to the User at the time of issue of such amount. The issue of any Cash Bonus to the user is subject to the sole discretion of Sportsfight and cannot be demanded by any User as a matter of right. The issue of any Cash Bonus by Deam11 on any day shall not entitle the user to demand the issuance of such Cash Bonus at any subsequent period in time nor create an expectation of recurring issue of such Cash Bonus by Sportsfight to such User. The Cash Bonus granted to the user may be used by such User for the purpose of setting off against the contribution to prize pool in any Contest, in accordance with these Terms and Conditions. The Cash Bonus shall not be withdraw-able or transferrable to any other account of the User, including the bank account of such User, or of any other User or person, other that as part of the winnings of a User in any Contest(s). In case the User terminates his/her account with Sportsfight or such account if terminated by Sportsfight, all Cash Bonus granted to the user shall return to Sportsfight and the User shall not have any right or interest on such points.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>All Cash Bonus credited in the User account shall be valid for a period of 30 days from the date of credit. The Cash Bonus shall lapse at the end of 30 days and the Cash Bonus amount shall not reflect in the User account</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users agree that once they confirm a transaction on Sportsfight, they shall be bound by and make payment for that transaction.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The User acknowledges that subject to time taken for bank reconciliations and such other external dependencies that Sportsfight has on third parties, any transactions on Sportsfight Platform may take up to 24 hours to be processed. Any amount paid or transferred into the User&#39;s &#39;Unutilized&#39; Account or Winnings Account may take up to 24 hours to reflect in the User&#39;s &#39;Unutilized&#39; Account or Winnings Account balance. Similarly, the utilization of the Cash Bonus or money debited from &#39;Unutilized&#39; Account or Winnings Account may take up to 24 hours to reflect in the User&#39;s &#39;Unutilized&#39; Account or Winnings Account balance. Users agree not to raise any complaint or claim against Sportsfight in respect of any delay, including any lost opportunity to join any Contest or match due to delay in crediting of transaction amount into any of the User&#39;s accounts</p>\r\n\r\n<p>A transaction, once confirmed, is final and no cancellation is permissible.</p>\r\n\r\n<p>Sportsfight may, in certain exceptional circumstances and at its sole and absolute discretion, refund the amount to the User after deducting applicable cancellation charges and taxes. At the time of the transaction, Users may also be required to take note of certain additional terms and conditions and such additional terms and conditions shall also govern the transaction. To the extent that the additional terms and conditions contain any clause that is conflicting with the present terms and conditions, the additional terms and conditions shall prevail.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style=\"color:#008080\">Tabulation of fantasy points</span></strong></p>\r\n\r\n<p>Sportsfight may obtain the score feed and other information required for the computation and tabulation of fantasy points from third party service provider(s) and/or official website of the match organiser. In the rare event that any error in the computation or tabulation of fantasy points, selection of winners, abandonment of a match etc., as a result of inaccuracies in or incompleteness of the feed provided by the third party service provider and/or official website of the match organiser comes to its attention, Sportsfight shall use best efforts to rectify such error prior to the distribution of prizes. However, Sportsfight hereby clarifies that it relies on the accuracy and completeness of such third party score/statistic feeds and does not itself warrant or make any representations concerning the accuracy thereof and, in any event, shall take no responsibility for inaccuracies in computation and tabulation of fantasy points or the selection of winners as a result of any inaccurate or incomplete scores/statistics received from such third party service provider. Users and Participants agree not to make any claim or raise any complaint against Sportsfight in this respect.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Selection and Verification of Winners and Conditions relating to the Prizes</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Selection of Winners</strong></span></p>\r\n\r\n<p>Winners will be decided on the basis of the scores of the Teams in a designated match (which may last anywhere between one day and an entire tournament) of the Contest(s). The Participant(s) owning the Team(s) with the highest aggregate score in a particular match shall be declared the Winner(s). In certain pre-specified Contests, Sportsfight may declare more than one Winner and distribute prizes to such Winners in increasing order of their Team&#39;s aggregate score at the end of the designated match of the Contest. The contemplated number of Winners and the prize due to each Winner in such Contest shall be as specified on the Contest page prior to the commencement of the Contest.</p>\r\n\r\n<p>Participants creating Teams on behalf of any other Participant or person shall be disqualified.</p>\r\n\r\n<p>In the event of a tie, the winning Participants shall be declared Winners and the prize shall be equally divided among such Participants.</p>\r\n\r\n<p>Sportsfight shall not be liable to pay any prize if it is discovered that the Winner(s) have not abided by these Terms and Conditions, and other rules and regulations in relation to the use of the Sportsfight, Contest, &quot;Fantasy Rules&quot;, etc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Contacting Winners</strong></span></p>\r\n\r\n<p>Winners shall be contacted by Sportsfight or the third party conducting the Contest on the e-mail address provided at the time of registration. The verification process and the documents required for the collection of the prize shall be detailed to the Winners at this stage. As a general practice, winners will be required to provide the following documents:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Photocopy of the User&#39;s PAN card;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Photocopy of a government-issued residence proof;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>User&#39;s bank account details and proof of the same.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight shall not permit a Winner to withdraw his/her prize(s)/accumulated winnings unless the above-mentioned documents have been received and verified within the time-period stipulated by Sportsfight. The User represents and warrants that the documents provided in the course of the verification process are true copies of the original documents to which they relate.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participants are required to provide proper and complete details at the time of registration. Sportsfight shall not be responsible for communications errors, commissions or omissions including those of the Participants due to which the results may not be communicated to the Winner.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The list of Winners shall be posted on a separate web-page on the Sportsfight. The winners will also be intimated by e-mail.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the event that a Participant has been declared a Winner on the abovementioned web-page but has not received any communication from Sportsfight, such Participant may contact Sportsfight within the time specified on the webpage.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Verification process</strong></span></p>\r\n\r\n<p>Only those Winners who successfully complete the verification process and provide the required documents within the time limit specified by Sportsfight shall be permitted to withdraw/receive their accumulated winnings (or any part thereof). Sportsfight shall not entertain any claims or requests for extension of time for submission of documents.</p>\r\n\r\n<p>Sportsfight shall scrutinize all documents submitted and may, at its sole and absolute discretion, disqualify any Winner from withdrawing his accumulated winnings (or any part thereof) on the following matches:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Determination by Sportsfight that any document or information submitted by the Participant is incorrect, misleading, false, fabricated, incomplete or illegible; or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participant does not fulfill the Eligibility Criteria specified in Clause 10 above; or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any other match.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Taxes Payable</p>\r\n\r\n<p>All prizes shall be subject to deduction of tax (&quot;TDS&quot;) as per the Income Tax Act 1961. As of April 1, 2018, the TDS rate prescribed by the Government of India with respect to any prize money amount that is in excess of Rs. 10,000/- is 31.2% of the total prize money amount. In case of any revisions by the Government of India to the aforementioned rate in the future, TDS will be deducted by Sportsfight in accordance with the then current prescribed TDS rate. Winners will be provided TDS certificates in respect of such tax deductions. The Winners shall be responsible for payment of any other applicable tax, including but not limited to, income tax, gift tax, etc. in respect of the prize money.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Miscellaneous</strong></p>\r\n\r\n<p>The decision of Sportsfight with respect to the awarding of prizes shall be final, binding and non-contestable.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Participants playing the paid formats of the Contest(s) confirm that they are not residents of any of the following Indian states - Assam, Odisha, Sikkim, Nagaland or Telangana. If it is found that a Participant playing the paid formats of the Contest(s) is a resident of any of the abovementioned states, Sportsfight shall disqualify such Participant and forfeit any prize won by such Participant. Further Sportsfight may, at its sole and absolute discretion, suspend or terminate such Participant&#39;s account with Sportsfight. Any amount remaining unused in the User&#39;s Game Account or Winnings Account on the date of deactivation or deletion shall be reimbursed to the User by an online transfer to the User&#39;s bank account on record with Sportsfight, subject to the processing fee (if any) applicable on such transfers as set out herein.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>If it is found that a Participant playing the paid formats of the Contest(s) is under the age of eighteen (18), Sportsfight shall be entitled, at its sole and absolute discretion, to disqualify such Participant and forfeit his/her prize. Further, Sportsfight may, at its sole and absolute discretion, suspend or terminate such Participant&#39;s account.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To the extent permitted by law, Sportsfight makes no representations or warranties as to the quality, suitability or merchantability of any prizes and shall not be liable in respect of the same.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight may, at its sole and absolute discretion, vary or modify the prizes being offered to winners. Participants shall not raise any claim against Sportsfight or question its right to modify such prizes being offered, prior to closure of the Contest.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight will not bear any responsibility for the transportation or packaging of prizes to the respective winners. Sportsfight shall not be held liable for any loss or damage caused to any prizes at the time of such transportation.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Winners shall bear the shipping, courier or any other delivery cost in respect of the prizes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Winners shall bear all transaction charges levied for delivery of cash prizes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>All prizes are non-transferable and non-refundable. Prizes cannot be exchanged / redeemed for cash or kind. No cash claims can be made in lieu of prizes in kind.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Publicity</strong></p>\r\n\r\n<p>Acceptance of a prize by the Winner constitutes permission for Sportsfight, and its affiliates to use the Winner&#39;s name, likeness, voice and comments for advertising and promotional purposes in any media worldwide for purposes of advertising and trade without any further permissions or consents and / or additional compensation whatsoever.</p>\r\n\r\n<p>The Winners further undertake that they will be available for promotional purposes as planned and desired by Sportsfight without any charge. The exact dates remain the sole discretion of Sportsfight. Promotional activities may include but not be limited to press events, internal meetings and ceremonies/functions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>General Conditions</strong></p>\r\n\r\n<p>If it comes to the notice of Sportsfight that any governmental, statutory or regulatory compliances or approvals are required for conducting any Contest(s) or if it comes to the notice of Sportsfight that conduct of any such Contest(s) is prohibited, then Sportsfight shall withdraw and / or cancel such Contest(s) without prior notice to any Participants or winners of any Contest(s). Users agree not to make any claim in respect of such cancellation or withdrawal of the Contest or Contest it in any manner.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Employees, directors, affiliates, relatives and family members of Sportsfight, will not be eligible to participate in any Contest(s).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dispute and Dispute Resolution</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The courts of competent jurisdiction at Mumbai shall have exclusive jurisdiction to determine any and all disputes arising out of, or in connection with, the Sportsfight Services provided by Sportsfight (including the Contest(s)), the construction, validity, interpretation and enforceability of these Terms and Conditions, or the rights and obligations of the User(s) (including Participants) or Sportsfight, as well as the exclusive jurisdiction to grant interim or preliminary relief in case of any dispute referred to arbitration as given below. All such issues and questions shall be governed and construed in accordance with the laws of the Republic of India.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the event of any legal dispute (which may be a legal issue or question) which may arise, the party raising the dispute shall provide a written notification (&quot;Notification&quot;) to the other party. On receipt of Notification, the parties shall first try to resolve the dispute through discussions. In the event that the parties are unable to resolve the dispute within fifteen (15) days of receipt of Notification, the dispute shall be settled by arbitration.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The place of arbitration shall be Mumbai, India. All arbitration proceedings shall be conducted in English and in accordance with the provisions of the Arbitration and Conciliation Act, 1996, as amended from time to time.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The arbitration award will be final and binding on the Parties, and each Party will bear its own costs of arbitration and equally share the fees of the arbitrator unless the arbitral tribunal decides otherwise. The arbitrator shall be entitled to pass interim orders and awards, including the orders for specific performance and such orders would be enforceable in competent courts. The arbitrator shall give a reasoned award.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nothing contained in these Terms and Conditions shall prevent Sportsfight from seeking and obtaining interim or permanent equitable or injunctive relief, or any other relief available to safeguard Sportsfight interest prior to, during or following the filing of arbitration proceedings or pending the execution of a decision or award in connection with any arbitration proceedings from any court having jurisdiction to grant the same. The pursuit of equitable or injunctive relief shall not constitute a waiver on the part of Sportsfight to pursue any remedy for monetary damages through the arbitration described herein.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008080\"><strong>Release and Limitations of Liability</strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users shall access the Sportsfight Services provided on Sportsfight voluntarily and at their own risk. Sportsfight shall, under no circumstances be held responsible or liable on account of any loss or damage sustained (including but not limited to any accident, injury, death, loss of property) by Users or any other person or entity during the course of access to the Sportsfight Services (including participation in the Contest(s)) or as a result of acceptance of any prize.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>By entering the contests and accessing the Sportsfight Services provided therein, Users hereby release from and agree to indemnify Sportsfight, and/ or any of its directors, employees, partners, associates and licensors, from and against all liability, cost, loss or expense arising out their access to the Sportsfight Services including (but not limited to) personal injury and damage to property and whether direct, indirect, consequential, foreseeable, due to some negligent act or omission on their part, or otherwise.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sportsfight accepts no liability, whether jointly or severally, for any errors or omissions, whether on behalf of itself or third parties in relation to the prizes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users shall be solely responsible for any consequences which may arise due to their access of Sportsfight Services by conducting an illegal act or due to non-conformity with these Terms and Conditions and other rules and regulations in relation to Sportsfight Services, including the provision of incorrect address or other personal details. Users also undertake to indemnify Sportsfight and their respective officers, directors, employee,&nbsp;&nbsp;and agents on the happening of such an event (including without limitation cost of an attorney, legal charges etc.&nbsp;On full indemnity basis for any loss/damage suffered by Sportsfight on account of such activity on the part of the Users.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Users shall indemnify, defend, and hold Sportsfight harmless from any third party/entity/organization claims arising from or related to such User&#39;s engagement with the Sportsfight or participation in any Contest. In no event shall Sportsfight be liable to any User for acts or omissions arising out of or related to User&#39;s engagement with the Sportsfight or his/her participation in any Contest(s).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In consideration of Sportsfight allowing Users to access the Sportsfight Services, to the maximum extent permitted by law, the Users waive and release each and every right or claim, all actions, causes of actions (present or future) each of them has or may have against Sportsfight, its respective agents, directors, officers, business associates, group companies, sponsors, employees, or representatives for all and any injuries, accidents, or mishaps (whether known or unknown) or (whether anticipated or unanticipated) arising out of the provision of Sportsfight Services or related to the Contests or the prizes of the Contests.</p>', 'payment-terms', 'payment-terms', 'Payment Terms', NULL, '<p>&nbsp;</p>\r\n\r\n<p>In respect of any transactions entered into on the Sportsfight platform, including making a payment to participate in the paid versions of Contest(s), Users agree to be bound by the following payment terms:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The payment of pre-designated amount Users make to participate in the Contest(s) is inclusive of the pre-designated platform fee for access to the Sportsfight Services charged by Sportsfight and pre-determined participant&rsquo;s contribution towards prize money pool.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Subject to these Terms and Conditions, all amounts collected from the User are', NULL, '2020-04-21 00:27:04', '2020-04-21 00:29:18'),
(25, 'Refund Policy', '<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#008080\"><strong>REFUND&nbsp;</strong><strong>POLICY</strong></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">All contests&nbsp;are final. Sportsfight offers&nbsp;fantasy playing cricket contest&nbsp;evaluation to ensure our fantasy program and services shall meet the customer requirements, thus we offer NO REFUNDS and CANCELLATIONS. Before deciding to subscribe to our fantasy program, please make sure that you understand the fantasy world and read our terms and conditions. We do not offer refunds on any contest that has already been taken. Also, no Partial Refund or Cancellation is allowed on once you join the contest.</p>\r\n\r\n<p style=\"text-align:justify\">Due to any technical reason, if payment is received twice for a single transaction, the one transaction amount will be refunded via the same source within 07 to 10 working days.</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><strong>Use and refund policy of personal information&#39;?</strong></p>\r\n\r\n<p style=\"text-align:justify\"><br />\r\nFor this reason, we strongly recommend that before payment, Read all information about our products, services, and support given to our clients.</p>\r\n\r\n<ul>\r\n	<li>Read About Us</li>\r\n	<li>Read our Terms of Conditions.</li>\r\n	<li>Read our Privacy Policy.</li>\r\n	<li>Disclaimer</li>\r\n	<li>Payment Terms</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">Do not allow children or other unauthorized family members or friends to access your credit cards or your account at the payment site to ensure that no one pays for a Membership without your permission. By making a payment for Membership to our site, you acknowledge that you have read and agree to the above No Refund and no cancellation Policy.</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>', 'refund-policy', 'refund-policy', 'Refund Policy', 'refund-policy', '<p style=\"text-align:justify\"><strong>REFUND&nbsp;</strong><strong>POLICY</strong></p>\r\n\r\n<p style=\"text-align:justify\">All contests&nbsp;are final. Sportsfight offers&nbsp;fantasy playing cricket contest&nbsp;evaluation to ensure our fantasy program and services shall meet the customer requirements, thus we offer NO REFUNDS and CANCELLATIONS. Before deciding to subscribe to our fantasy program, please make sure that you understand the fantasy world and read our terms and conditions. We do not offer refunds on any contest that has already been taken. Also, no Partial Refund or Cancellation is allowed on once you join the contest.</p>\r\n\r\n<p style=\"text-align:justify\">Due', NULL, '2020-04-21 00:40:59', '2020-04-21 00:42:10'),
(26, 'How To Play', '<ul>\r\n	<li>Sportsfight is a fantasy platform for all the cricket buffs to experience the most earnest cricket experience, virtually!</li>\r\n	<li>It lets you try your skills and explore your knowledge of the field.</li>\r\n	<li>So, it&#39;s time to take matters in your own hands and Change the Game!</li>\r\n	<li>Simply follow these easy steps and get set for your fantastic fantasy experience!</li>\r\n	<li>The concept is simple; you play wisely with the right team, earn points, and cash. It&rsquo;s all about the three C&rsquo;s; Compete, Conquer and become a Champion!</li>\r\n</ul>', 'how-to-play', 'how-to-play', NULL, 'how-to-play', NULL, NULL, '2020-05-01 16:52:21', '2020-05-01 16:52:21'),
(27, 'Digital-marketing', '<p>Enquiry Form</p>', 'digital-marketing', 'digital-marketing', 'Digital-marketing', NULL, '<p>Form</p>', NULL, '2020-07-29 22:00:34', '2020-07-29 22:13:27');

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
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `service_charge` decimal(14,2) NOT NULL DEFAULT '0.00',
  `payable_amount` decimal(14,2) NOT NULL DEFAULT '0.00',
  `mode` varchar(100) DEFAULT NULL,
  `currency` varchar(10) DEFAULT 'INR',
  `remarks` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `request_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` float(10,2) NOT NULL DEFAULT '0.00',
  `content` longtext,
  `method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paytm`
--

CREATE TABLE `paytm` (
  `id` int(11) NOT NULL,
  `paytm` text,
  `user_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `deposit_amount` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paytm`
--

INSERT INTO `paytm` (`id`, `paytm`, `user_id`, `email`, `deposit_amount`, `transaction_id`, `payment_mode`, `payment_status`, `created_at`, `updated_at`, `event_type`) VALUES
(12, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"1\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"otp\":null,\"password\":null,\"payment_mode\":\"paytm\",\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"20200708111212800110168393035397461\",\"user_id\":395,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '395', NULL, '1', '20200708111212800110168393035397461', 'paytm', 'success', '2020-07-07 20:40:36', '2020-07-07 20:40:36', NULL),
(13, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"1\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"order_id\":\"392694\",\"otp\":null,\"password\":null,\"payment_mode\":\"paytm\",\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"20200708111212800110168174934892103\",\"user_id\":285,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '285', NULL, '1', '20200708111212800110168174934892103', 'paytm', 'success', '2020-07-07 21:59:01', '2020-07-07 21:59:01', NULL),
(14, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"2\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"order_id\":\"023067\",\"otp\":null,\"password\":null,\"payment_mode\":\"paytm\",\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"20200708111212800110168523234756027\",\"user_id\":1491,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '1491', NULL, '2', '20200708111212800110168523234756027', 'paytm', 'success', '2020-07-08 02:15:24', '2020-07-08 02:15:24', NULL),
(15, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"777\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"order_id\":\"895402\",\"otp\":null,\"password\":null,\"payment_mode\":\"paytm\",\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"20200708111212800110168425535137740\",\"user_id\":1246,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '1246', NULL, '777', '20200708111212800110168425535137740', 'paytm', 'success', '2020-07-08 06:52:13', '2020-07-08 06:52:13', NULL),
(16, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"500\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"order_id\":\"050043\",\"otp\":null,\"password\":null,\"payment_mode\":\"paytm\",\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"20200708111212800110168762735141290\",\"user_id\":1517,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '1517', NULL, '500', '20200708111212800110168762735141290', 'paytm', 'success', '2020-07-08 06:54:33', '2020-07-08 06:54:33', NULL),
(17, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"1000\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"order_id\":null,\"otp\":null,\"password\":null,\"payment_mode\":null,\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"SBI1d0d6e2f588a4026947d8c09a8406a73\",\"user_id\":1520,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '1520', NULL, '1000', 'SBI1d0d6e2f588a4026947d8c09a8406a73', NULL, 'success', '2020-07-08 07:00:56', '2020-07-08 07:00:56', NULL),
(18, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"555\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"order_id\":\"976292\",\"otp\":null,\"password\":null,\"payment_mode\":\"paytm\",\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"20200708111212800110168992634965859\",\"user_id\":1172,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '1172', NULL, '555', '20200708111212800110168992634965859', 'paytm', 'success', '2020-07-08 07:02:13', '2020-07-08 07:02:13', NULL),
(19, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"30\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"order_id\":\"494830\",\"otp\":null,\"password\":null,\"payment_mode\":\"paytm\",\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"20200708111212800110168822635215726\",\"user_id\":428,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '428', NULL, '30', '20200708111212800110168822635215726', 'paytm', 'success', '2020-07-08 07:07:58', '2020-07-08 07:07:58', NULL),
(20, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"111\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"order_id\":\"639692\",\"otp\":null,\"password\":null,\"payment_mode\":\"paytm\",\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"20200708111212800110168792835279419\",\"user_id\":1438,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '1438', NULL, '111', '20200708111212800110168792835279419', 'paytm', 'success', '2020-07-08 07:41:45', '2020-07-08 07:41:45', NULL),
(21, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"5\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"order_id\":\"263919\",\"otp\":null,\"password\":null,\"payment_mode\":\"paytm\",\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"20200708111212800110168342834989766\",\"user_id\":285,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '285', NULL, '5', '20200708111212800110168342834989766', 'paytm', 'success', '2020-07-08 07:51:45', '2020-07-08 07:51:45', NULL),
(22, '{\"action_type\":null,\"city\":null,\"contest_id\":null,\"current_password\":null,\"dateOfBirth\":null,\"deposit_amount\":\"100\",\"device_id\":null,\"discountOnBonusAmount\":null,\"documents_type\":null,\"email\":null,\"entryFees\":null,\"event_name\":null,\"gender\":null,\"image_url\":null,\"match_id\":null,\"mobile_number\":null,\"name\":null,\"new_password\":null,\"order_id\":\"184045\",\"otp\":null,\"password\":null,\"payment_mode\":\"paytm\",\"payment_status\":\"success\",\"pinCode\":null,\"provider_id\":null,\"referral_code\":null,\"role_type\":0,\"state\":null,\"team_id\":0,\"team_name\":null,\"token\":null,\"totalPaidAmount\":null,\"transaction_id\":\"20200708111212800110168563634746740\",\"user_id\":428,\"user_type\":null,\"username\":null,\"version_code\":0,\"withdraw_amount\":0}', '428', NULL, '100', '20200708111212800110168563634746740', 'paytm', 'success', '2020-07-08 09:51:16', '2020-07-08 09:51:16', NULL),
(23, '{\"user_id\":null,\"allowme\":\"true\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-25 20:44:53', '2020-07-25 20:44:53', NULL),
(24, '{\"ORDERID\":\"215767\",\"MID\":\"xmHOCa32667710380797\",\"TXNID\":\"20200726111212800110168058937802834\",\"TXNAMOUNT\":\"25.00\",\"PAYMENTMODE\":\"PPI\",\"CURRENCY\":\"INR\",\"TXNDATE\":\"2020-07-26 02:26:48.0\",\"STATUS\":\"TXN_SUCCESS\",\"RESPCODE\":\"01\",\"RESPMSG\":\"Txn Success\",\"GATEWAYNAME\":\"WALLET\",\"BANKTXNID\":\"141728802838\",\"BANKNAME\":\"WALLET\",\"CHECKSUMHASH\":\"slyb3n7KQLf40+P\\/bTWkzf2aN9YfjBE5HqZAXsXQYulxuUAPHVn1qB4FefgMiSNRkWPBBggIzH+b2CmQDgGEKwNbcfoXuWi2mWLRU36BIOw=\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-25 20:57:00', '2020-07-25 20:57:00', NULL),
(25, '{\"BANKNAME\":\"WALLET\",\"BANKTXNID\":\"141728892927\",\"CHECKSUMHASH\":\"u6rj4UyWbGA2MCcalP4desfQG1mJsjA3RW+1w13cSWeUiPOxDS6fLgMsa9N+ImQQ47+GrF3kdyNEc7Ee7nyRQbZi2yEorBnCORn8fxbM40M=\",\"CURRENCY\":\"INR\",\"GATEWAYNAME\":\"WALLET\",\"MID\":\"xmHOCa32667710380797\",\"ORDERID\":\"524384\",\"PAYMENTMODE\":\"PPI\",\"RESPCODE\":\"01\",\"RESPMSG\":\"Txn Success\",\"STATUS\":\"TXN_SUCCESS\",\"TXNAMOUNT\":\"10.00\",\"TXNDATE\":\"2020-07-26 02:53:57.0\",\"TXNID\":\"20200726111212800110168183137412948\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-25 21:24:27', '2020-07-25 21:24:27', NULL),
(26, '{\"ORDERID\":\"694842\",\"MID\":\"xmHOCa32667710380797\",\"TXNID\":\"20200726111212800110168188637471724\",\"TXNAMOUNT\":\"1.00\",\"CURRENCY\":\"INR\",\"STATUS\":\"TXN_FAILURE\",\"RESPCODE\":\"141\",\"RESPMSG\":\"User has not completed transaction.\",\"BANKTXNID\":null,\"CHECKSUMHASH\":\"NIRd\\/mpO+WBOlRxuGVhA1DKSJ7rANwpNOsrrZI7uFiZ6vSJTtfSSsdzfTjaqGtR+HvabU8csj4LbbCMUOKEmLLwK44GIVbU9ferEpgdr4lI=\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-25 21:33:04', '2020-07-25 21:33:04', NULL),
(27, '{\"ORDERID\":\"814827\",\"MID\":\"xmHOCa32667710380797\",\"TXNID\":\"20200726111212800110168184537475182\",\"TXNAMOUNT\":\"1.00\",\"CURRENCY\":\"INR\",\"STATUS\":\"TXN_FAILURE\",\"RESPCODE\":\"141\",\"RESPMSG\":\"User has not completed transaction.\",\"BANKTXNID\":null,\"CHECKSUMHASH\":\"dcZd7zGq4zvT4F54HaUtJ0Njy\\/0WVyxAzEKRslphyXFH3N1bPlWyzcydbOPb0MO4QT+kr3Hbxn0VEETcO95MAJ4cxsw3U3XEzWbmzYFPHNY=\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-25 21:38:09', '2020-07-25 21:38:09', NULL),
(28, '{\"ORDERID\":\"721311\",\"MID\":\"xmHOCa32667710380797\",\"TXNID\":\"20200726111212800110168185537494537\",\"TXNAMOUNT\":\"1.00\",\"CURRENCY\":\"INR\",\"STATUS\":\"TXN_FAILURE\",\"RESPCODE\":\"141\",\"RESPMSG\":\"User has not completed transaction.\",\"BANKTXNID\":null,\"CHECKSUMHASH\":\"QeVG3MOPPpYLxDgcoBHg\\/BZtfhEt8U3CO+bzAOI6Z4Q9kGG9ixdfAysOhreSLYOARtsaWoGNZhblO80uYbH04C+p9ejdELpWWqZ\\/x0kJ9Ho=\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-25 21:38:51', '2020-07-25 21:38:51', NULL),
(29, '{\"ORDERID\":\"243604\",\"MID\":\"xmHOCa32667710380797\",\"TXNID\":\"20200726111212800110168180537497551\",\"TXNAMOUNT\":\"1.00\",\"PAYMENTMODE\":\"PPI\",\"CURRENCY\":\"INR\",\"TXNDATE\":\"2020-07-26 03:10:03.0\",\"STATUS\":\"TXN_SUCCESS\",\"RESPCODE\":\"01\",\"RESPMSG\":\"Txn Success\",\"GATEWAYNAME\":\"WALLET\",\"BANKTXNID\":\"141728938029\",\"BANKNAME\":\"WALLET\",\"CHECKSUMHASH\":\"PsCLo22NXwN2rhmod0zsqVxCybl2g9lbU0Agq3lb1HQvzlqIgSwI6+Ea+S6OHF39HeXCuKifel6FGJ+dxVPNilaiCXvoVqIVf1mJxi5YnnA=\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-25 21:40:41', '2020-07-25 21:40:41', NULL),
(30, '{\"ORDERID\":\"198166\",\"MID\":\"xmHOCa32667710380797\",\"TXNID\":\"20200729111212800110168936138342935\",\"TXNAMOUNT\":\"500.00\",\"CURRENCY\":\"INR\",\"STATUS\":\"TXN_FAILURE\",\"RESPCODE\":\"141\",\"RESPMSG\":\"User has not completed transaction.\",\"BANKTXNID\":null,\"CHECKSUMHASH\":\"4lMakpAAtFlwv73S0CHkUWvvS+M+X1ucIGcdaPoYPlaOL\\/YZMjphbCieEhtbwtI4ptuYKe703xfl9z06rD0Wv0q\\/VzLSrMBPzUniVK4XFvI=\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-29 17:45:35', '2020-07-29 17:45:35', NULL),
(31, '{\"ORDERID\":\"882627\",\"MID\":\"xmHOCa32667710380797\",\"TXNID\":\"20200730111212800110168213938186409\",\"TXNAMOUNT\":\"500.00\",\"CURRENCY\":\"INR\",\"STATUS\":\"TXN_FAILURE\",\"RESPCODE\":\"141\",\"RESPMSG\":\"User has not completed transaction.\",\"BANKTXNID\":null,\"CHECKSUMHASH\":\"J1Qy0bpSfag\\/hvTzPNSnzBU7om0LuxsWM1Oaub\\/XpAe7VMdhHeo5t8Z42z4GoZwxncqhSxJ1KrFUiz5up9Qh7Gb78pCl09d4f4SZxX5xyYM=\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-30 12:12:21', '2020-07-30 12:12:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `playing11` varchar(10) DEFAULT 'false',
  `team_id` int(11) UNSIGNED DEFAULT NULL,
  `cid` int(11) UNSIGNED DEFAULT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `primary_team` text,
  `thumb_url` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `playing_role` varchar(255) DEFAULT NULL,
  `batting_style` varchar(255) DEFAULT NULL,
  `bowling_style` varchar(255) DEFAULT NULL,
  `fielding_position` varchar(255) DEFAULT NULL,
  `recent_match` int(11) DEFAULT '0',
  `recent_appearance` int(11) NOT NULL DEFAULT '0',
  `fantasy_player_rating` varchar(255) DEFAULT '0.0',
  `nationality` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `player_analytics`
--

CREATE TABLE `player_analytics` (
  `id` int(11) NOT NULL,
  `match_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_team_id` int(11) DEFAULT NULL,
  `trump` int(11) DEFAULT NULL,
  `vice_captain` int(11) DEFAULT NULL,
  `captain` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `player_points`
--

CREATE TABLE `player_points` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `point` varchar(255) DEFAULT NULL,
  `starting11` varchar(255) DEFAULT NULL,
  `run` varchar(255) DEFAULT NULL,
  `four` varchar(255) DEFAULT NULL,
  `six` varchar(255) DEFAULT NULL,
  `sr` varchar(255) DEFAULT NULL,
  `fifty` varchar(255) DEFAULT NULL,
  `duck` varchar(255) DEFAULT NULL,
  `wkts` varchar(255) DEFAULT NULL,
  `maidenover` varchar(255) DEFAULT NULL,
  `er` varchar(255) DEFAULT NULL,
  `catch` varchar(255) DEFAULT NULL,
  `runoutstumping` varchar(255) DEFAULT NULL,
  `runoutthrower` varchar(255) DEFAULT NULL,
  `runoutcatcher` varchar(255) DEFAULT NULL,
  `directrunout` varchar(255) DEFAULT NULL,
  `stumping` varchar(255) DEFAULT NULL,
  `thirty` varchar(255) NOT NULL,
  `bonus` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prize_breakups`
--

CREATE TABLE `prize_breakups` (
  `id` int(11) UNSIGNED NOT NULL,
  `default_contest_id` int(11) UNSIGNED DEFAULT NULL,
  `contest_type_id` int(11) UNSIGNED DEFAULT NULL,
  `rank_from` int(11) DEFAULT NULL,
  `rank_upto` int(11) DEFAULT NULL,
  `prize_amount` float(10,1) NOT NULL DEFAULT '0.0',
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `contest_id` int(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prize_distributions`
--

CREATE TABLE `prize_distributions` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `contest_id` int(11) UNSIGNED DEFAULT NULL,
  `created_team_id` int(11) UNSIGNED DEFAULT NULL,
  `team_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_id` text COLLATE utf8_unicode_ci,
  `contest_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_fees` int(11) DEFAULT NULL,
  `total_spots` int(11) DEFAULT NULL,
  `filled_spot` int(11) DEFAULT NULL,
  `first_prize` int(11) DEFAULT NULL,
  `default_contest_id` int(11) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `prize_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `points` float(10,2) NOT NULL DEFAULT '0.00',
  `contest_type_id` int(11) DEFAULT NULL,
  `captain` int(11) DEFAULT NULL,
  `vice_captain` int(11) DEFAULT NULL,
  `trump` int(11) DEFAULT NULL,
  `match_team_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_teams` text COLLATE utf8_unicode_ci,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_trigger` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programms`
--

CREATE TABLE `programms` (
  `id` int(10) UNSIGNED NOT NULL,
  `campaign_name` varchar(255) DEFAULT NULL,
  `reward_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=Fixed,2=Percentage',
  `amount` float(10,2) NOT NULL DEFAULT '0.00',
  `promotion_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=Bonus,2=Referral',
  `trigger_condition` tinyint(1) DEFAULT '0' COMMENT '1=Sign up,2=First Transaction',
  `status` tinyint(1) DEFAULT '3' COMMENT '1=Active,2=Planned,3=Draft',
  `customer_type` tinyint(1) DEFAULT '1' COMMENT '1=Public',
  `description` text,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programms`
--

INSERT INTO `programms` (`id`, `campaign_name`, `reward_type`, `amount`, `promotion_type`, `trigger_condition`, `status`, `customer_type`, `description`, `start_date`, `end_date`, `start_time`, `end_time`, `created_by`, `created_at`, `updated_at`) VALUES
(5, 'Sign up', 1, 100.00, 2, 1, 1, 1, 'public', '2020-04-20', '2020-04-30', '12:47:09', '12:47:09', NULL, '2020-04-18 00:47:09', '2020-04-18 00:47:09'),
(6, 'Referral', 1, 100.00, 1, 1, 2, 1, 'erew', '2020-05-04', '2020-05-13', '04:58:54 PM', '04:58:54 PM', NULL, '2020-04-18 01:33:56', '2020-07-07 16:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `contest_id` int(10) UNSIGNED DEFAULT NULL,
  `match_id` int(10) UNSIGNED DEFAULT NULL,
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `rank` int(10) DEFAULT NULL,
  `prize` double DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `points` float(10,2) DEFAULT '0.00',
  `teamname` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referral_codes`
--

CREATE TABLE `referral_codes` (
  `id` int(11) NOT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `referral_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `refer_by` int(11) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) DEFAULT '0',
  `is_unique_device` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modules` text COLLATE utf8_unicode_ci,
  `permission` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `modules`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin', NULL, NULL, NULL, NULL),
(2, 'Sales', 'Sales', 'Sales', NULL, NULL, NULL, NULL),
(3, 'Customer', 'Customer', 'Customer', NULL, NULL, NULL, NULL),
(4, 'Supports', 'Supports', 'Supports', 'null', '[\"read\",\"write\"]', NULL, '2018-02-01 02:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `field_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `field_key`, `field_value`, `created_at`, `updated_at`) VALUES
(1, 'service_charge', '59', '2018-07-04 00:00:00', '2020-03-30 18:49:18'),
(3, 'website_title', 'Admin Panel', '2018-07-28 06:45:30', '2020-07-18 03:52:07'),
(4, 'website_url', 'https://www.sportsfight.in', '2018-07-28 06:45:30', '2020-05-23 12:33:15'),
(5, 'phone', '0000000000', '2018-07-28 06:45:30', '2019-10-13 14:27:43'),
(6, 'mobile', '0000000000', '2018-07-28 06:45:30', '2019-10-13 14:27:53'),
(7, 'website_email', 'info@Sportsfight.in', '2018-07-28 06:45:30', '2020-05-23 12:33:15'),
(8, 'meta_title', 'Sportsfight', '2018-07-28 06:45:30', '2020-05-23 12:33:15'),
(9, 'meta_key', 'Sportsfight', '2018-07-28 06:45:30', '2020-05-23 12:33:15'),
(10, 'meta_description', 'Sportsfight', '2018-07-28 06:45:31', '2020-05-23 12:33:15'),
(11, 'currency', 'INR', '2018-07-28 06:45:31', '2020-01-05 03:47:50'),
(12, 'company_address', 'AjY Startup Hub Sendhwa INDIA', '2018-07-28 06:45:31', '2020-03-05 13:37:51'),
(13, 'website_description', 'Fantasy', '2018-07-28 06:45:31', '2020-05-23 12:33:15'),
(14, 'facebook_url', 'https://www.facebook.com/', '2018-07-28 06:45:31', '2020-05-23 12:33:15'),
(15, 'linkedin_url', 'https://www.linkedin.com/', '2018-07-28 06:45:31', '2020-05-23 12:33:15'),
(16, 'twitter_url', 'https://twitter.com/', '2018-07-28 06:45:31', '2020-05-23 12:33:15'),
(17, 'website_logo', '1585227579d.webp', '2018-07-29 16:26:26', '2020-03-26 12:59:39'),
(18, 'payment_status', 'enable', '2019-10-13 08:37:41', '2019-12-01 06:17:05'),
(19, '_method', 'PATCH', '2019-10-13 10:03:43', '2019-10-13 10:03:43'),
(20, 'instagram_url', 'https://www.instagram.com/edify', '2020-04-09 10:31:07', '2020-04-09 10:31:07'),
(21, 'playstore_url', 'https://play.google.com/store/apps/details?id=com.edify.atrist', '2020-04-09 10:37:51', '2020-04-09 10:37:51'),
(22, 'ip1', '49.36.61.126', NULL, NULL),
(23, 'ip2', '49.36.61.126', NULL, NULL),
(24, 'maintainance', 'false', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `squads`
--

CREATE TABLE `squads` (
  `id` int(11) NOT NULL,
  `match_id` int(11) DEFAULT NULL,
  `teama_id` int(11) NOT NULL,
  `teamb_id` int(11) NOT NULL,
  `teams_id` int(11) NOT NULL,
  `players_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED DEFAULT NULL,
  `team_a` text,
  `team_b` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `team_a`
--

CREATE TABLE `team_a` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED NOT NULL,
  `team_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `logo_url` varchar(500) NOT NULL,
  `local_img_url` varchar(500) DEFAULT NULL,
  `thumb_url` varchar(255) DEFAULT NULL,
  `scores_full` varchar(255) DEFAULT '0/0 (0 ov)',
  `scores` varchar(255) DEFAULT '0/0',
  `overs` varchar(255) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `team_a_squads`
--

CREATE TABLE `team_a_squads` (
  `id` int(11) NOT NULL,
  `match_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `role_str` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `playing11` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `team_b`
--

CREATE TABLE `team_b` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED NOT NULL,
  `team_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `logo_url` varchar(500) NOT NULL,
  `local_img_url` varchar(500) DEFAULT NULL,
  `thumb_url` varchar(255) DEFAULT NULL,
  `scores_full` varchar(255) DEFAULT '0/0 (0 ov)',
  `scores` varchar(255) DEFAULT '0/0',
  `overs` varchar(255) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `team_b_squads`
--

CREATE TABLE `team_b_squads` (
  `id` int(11) NOT NULL,
  `match_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `role_str` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `playing11` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_matches`
--

CREATE TABLE `temp_matches` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED NOT NULL,
  `pid` text,
  `team_id` text,
  `title` varchar(255) NOT NULL,
  `short_title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `format` tinyint(1) DEFAULT NULL,
  `format_str` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `status_str` varchar(255) DEFAULT NULL,
  `status_note` varchar(255) DEFAULT NULL,
  `verified` varchar(255) DEFAULT NULL,
  `pre_squad` varchar(255) NOT NULL,
  `odds_available` varchar(255) DEFAULT NULL,
  `game_state` tinyint(1) NOT NULL DEFAULT '0',
  `game_state_str` varchar(255) NOT NULL,
  `domestic` tinyint(1) DEFAULT '0',
  `competition_id` text,
  `teama_id` text,
  `teamb_id` text,
  `date_start` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL,
  `timestamp_start` int(11) NOT NULL,
  `timestamp_end` int(11) NOT NULL,
  `venue_id` text,
  `umpires` varchar(255) DEFAULT NULL,
  `referee` varchar(255) DEFAULT NULL,
  `equation` varchar(255) DEFAULT NULL,
  `live` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `result_type` varchar(255) DEFAULT NULL,
  `win_margin` varchar(255) DEFAULT NULL,
  `winning_team_id` text,
  `commentary` tinyint(1) NOT NULL DEFAULT '0',
  `wagon` tinyint(1) NOT NULL DEFAULT '0',
  `latest_inning_number` tinyint(4) DEFAULT NULL,
  `toss_id` text,
  `current_status` tinyint(1) NOT NULL DEFAULT '0',
  `upload_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `toss`
--

CREATE TABLE `toss` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `winner` int(11) NOT NULL DEFAULT '0',
  `decision` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=default user, 1=special user, 3=runtime user',
  `team_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8_unicode_ci,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modeOfreach` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT '4',
  `current_balance` float(10,2) NOT NULL DEFAULT '0.00',
  `total_balance` float(10,2) NOT NULL DEFAULT '0.00',
  `profile_completion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_alert` enum('true','false') COLLATE utf8_unicode_ci DEFAULT 'true',
  `mobile_alert` enum('true','false') COLLATE utf8_unicode_ci DEFAULT 'true',
  `validate_user` text COLLATE utf8_unicode_ci,
  `login_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `device_id` text COLLATE utf8_unicode_ci,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateOfBirth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pinCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_account_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `all` text COLLATE utf8_unicode_ci,
  `block_referral` tinyint(1) NOT NULL DEFAULT '0',
  `affiliate_user` tinyint(1) NOT NULL DEFAULT '0',
  `affiliate_commission` float(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_agents`
--

CREATE TABLE `user_agents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `USER_DEVICE_IP` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COUNTRY_CODE` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SERVER_ADDR` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SERVER_NAME` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `REMOTE_ADDR` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `REQUEST_METHOD` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HTTP_USER_AGENT` text COLLATE utf8_unicode_ci,
  `HTTP_HOST` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DETAILS` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `message_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notified_user` int(11) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL COMMENT 'eg. task id, Comment id',
  `entity_type` enum('task_add','task_update','task_delete','comment_add','comment_replied','comment_delete','user_register','offers_add','offers_update','offers_delete') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) UNSIGNED NOT NULL,
  `match_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `verify_documents`
--

CREATE TABLE `verify_documents` (
  `id` int(11) UNSIGNED NOT NULL,
  `doc_type` varchar(255) DEFAULT NULL,
  `doc_number` varchar(255) DEFAULT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `doc_url_front` text,
  `doc_url_back` text,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `validate_user` varchar(255) DEFAULT NULL,
  `payment_type` tinyint(1) DEFAULT '1' COMMENT '1=bonus,2=referral,3=deposit,4=prize,5=withdraw',
  `payment_type_string` varchar(255) NOT NULL DEFAULT 'Bonus',
  `amount` float(10,2) NOT NULL DEFAULT '0.00',
  `bonus_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `referal_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `prize_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `deposit_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `usable_amount` float(10,2) DEFAULT NULL,
  `usable_amount_validation` text,
  `total_withdrawal_amount` float(10,2) DEFAULT NULL,
  `prize_distributed_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `amount` float(10,2) NOT NULL DEFAULT '0.00',
  `payment_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=bonus,2=referral,3=deposit,4=prize,5=withdraw,6=join contest,7=refunded',
  `payment_type_string` varchar(255) NOT NULL DEFAULT 'Bonus',
  `transaction_id` text,
  `payment_mode` varchar(255) DEFAULT NULL,
  `payment_details` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `prize_distributed_id` int(11) DEFAULT NULL,
  `debit_credit_status` varchar(10) DEFAULT '+',
  `withdraw_status` tinyint(1) NOT NULL DEFAULT '0',
  `refund_id` int(11) DEFAULT NULL,
  `match_id` bigint(20) DEFAULT NULL,
  `contest_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apk_updates`
--
ALTER TABLE `apk_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batsman_statistics`
--
ALTER TABLE `batsman_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bowler_statistics`
--
ALTER TABLE `bowler_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `capture_screen_times`
--
ALTER TABLE `capture_screen_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_bonus`
--
ALTER TABLE `cash_bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest_types`
--
ALTER TABLE `contest_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `create_contests`
--
ALTER TABLE `create_contests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `create_teams`
--
ALTER TABLE `create_teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `crons`
--
ALTER TABLE `crons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_contents`
--
ALTER TABLE `default_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_details`
--
ALTER TABLE `device_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_logs`
--
ALTER TABLE `error_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventLogs`
--
ALTER TABLE `eventLogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fielder_statistic`
--
ALTER TABLE `fielder_statistic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fows_statistics`
--
ALTER TABLE `fows_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hardware_infos`
--
ALTER TABLE `hardware_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `innings_scores`
--
ALTER TABLE `innings_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `join_contests`
--
ALTER TABLE `join_contests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `contest_id` (`contest_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`match_id`),
  ADD KEY `index` (`match_id`),
  ADD KEY `match_status` (`status`);

--
-- Indexes for table `match_contents`
--
ALTER TABLE `match_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_player_points`
--
ALTER TABLE `match_player_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playerpoints` (`match_id`,`pid`);

--
-- Indexes for table `match_scores`
--
ALTER TABLE `match_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_stats`
--
ALTER TABLE `match_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mega_data`
--
ALTER TABLE `mega_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_otp`
--
ALTER TABLE `mobile_otp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paytm`
--
ALTER TABLE `paytm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`) USING BTREE,
  ADD KEY `match_id` (`match_id`),
  ADD KEY `tid` (`team_id`);

--
-- Indexes for table `player_analytics`
--
ALTER TABLE `player_analytics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `pid` (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `player_points`
--
ALTER TABLE `player_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prize_breakups`
--
ALTER TABLE `prize_breakups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pbreakup` (`default_contest_id`,`rank_from`,`rank_upto`);

--
-- Indexes for table `prize_distributions`
--
ALTER TABLE `prize_distributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cid` (`created_team_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programms`
--
ALTER TABLE `programms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_codes`
--
ALTER TABLE `referral_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `squads`
--
ALTER TABLE `squads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_a`
--
ALTER TABLE `team_a`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `team_a_squads`
--
ALTER TABLE `team_a_squads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mpoint` (`match_id`,`player_id`);

--
-- Indexes for table `team_b`
--
ALTER TABLE `team_b`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `team_b_squads`
--
ALTER TABLE `team_b_squads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mplayer` (`match_id`,`player_id`);

--
-- Indexes for table `temp_matches`
--
ALTER TABLE `temp_matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toss`
--
ALTER TABLE `toss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `user_agents`
--
ALTER TABLE `user_agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_documents`
--
ALTER TABLE `verify_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apk_updates`
--
ALTER TABLE `apk_updates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `batsman_statistics`
--
ALTER TABLE `batsman_statistics`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bowler_statistics`
--
ALTER TABLE `bowler_statistics`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `capture_screen_times`
--
ALTER TABLE `capture_screen_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_bonus`
--
ALTER TABLE `cash_bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest_types`
--
ALTER TABLE `contest_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `create_contests`
--
ALTER TABLE `create_contests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `create_teams`
--
ALTER TABLE `create_teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crons`
--
ALTER TABLE `crons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `default_contents`
--
ALTER TABLE `default_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `device_details`
--
ALTER TABLE `device_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `error_logs`
--
ALTER TABLE `error_logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventLogs`
--
ALTER TABLE `eventLogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fielder_statistic`
--
ALTER TABLE `fielder_statistic`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fows_statistics`
--
ALTER TABLE `fows_statistics`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hardware_infos`
--
ALTER TABLE `hardware_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `innings_scores`
--
ALTER TABLE `innings_scores`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `join_contests`
--
ALTER TABLE `join_contests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_contents`
--
ALTER TABLE `match_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_player_points`
--
ALTER TABLE `match_player_points`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_scores`
--
ALTER TABLE `match_scores`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_stats`
--
ALTER TABLE `match_stats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mega_data`
--
ALTER TABLE `mega_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `metas`
--
ALTER TABLE `metas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mobile_otp`
--
ALTER TABLE `mobile_otp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paytm`
--
ALTER TABLE `paytm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_analytics`
--
ALTER TABLE `player_analytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_points`
--
ALTER TABLE `player_points`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prize_breakups`
--
ALTER TABLE `prize_breakups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prize_distributions`
--
ALTER TABLE `prize_distributions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programms`
--
ALTER TABLE `programms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral_codes`
--
ALTER TABLE `referral_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `squads`
--
ALTER TABLE `squads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_a`
--
ALTER TABLE `team_a`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_a_squads`
--
ALTER TABLE `team_a_squads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_b`
--
ALTER TABLE `team_b`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_b_squads`
--
ALTER TABLE `team_b_squads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_matches`
--
ALTER TABLE `temp_matches`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `toss`
--
ALTER TABLE `toss`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_agents`
--
ALTER TABLE `user_agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verify_documents`
--
ALTER TABLE `verify_documents`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
