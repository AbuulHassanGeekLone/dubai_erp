-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 07:51 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dubai_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_management`
--

CREATE TABLE `account_management` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_type` int(11) UNSIGNED NOT NULL,
  `account_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'No description',
  `opening_balance` decimal(18,2) UNSIGNED DEFAULT 0.00,
  `status` tinyint(1) DEFAULT NULL,
  `ordered_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_management`
--

INSERT INTO `account_management` (`id`, `account_type`, `account_name`, `description`, `opening_balance`, `status`, `ordered_uuid`, `created_at`, `updated_at`) VALUES
(26, 2, 'current asset', NULL, '0.00', 1, '', '2020-07-28 04:55:22', '2020-07-28 04:55:22'),
(27, 11, 'Cash', NULL, '500000.00', NULL, '', '2020-07-28 08:26:42', '2020-08-11 20:25:05'),
(28, 5, 'costs of goods sold', NULL, '25000.00', 1, '', '2020-07-29 06:38:26', '2020-07-29 06:38:26'),
(29, 1, 'alfalah bank', NULL, '12000.00', 1, '', '2020-07-29 06:39:17', '2020-07-29 06:39:17'),
(31, 7, 'Opening Balance Equity', NULL, '12000.00', 1, '', '2020-07-29 06:40:32', '2020-07-29 06:40:32'),
(32, 1, 'habib bank', NULL, '0.00', 1, '', '2020-08-04 07:28:58', '2020-08-04 07:28:58'),
(33, 7, 'equity1', NULL, '0.00', 1, '', '2020-08-04 10:22:17', '2020-08-04 10:22:17'),
(34, 6, 'uncategorized expense', NULL, '0.00', 1, '', '2020-08-05 03:29:08', '2020-08-05 03:29:08'),
(35, 4, 'sales', NULL, '0.00', 1, '', '2020-08-05 04:57:39', '2020-08-05 04:57:39'),
(36, 3, 'ufc ARcv', NULL, '0.00', NULL, '', '2020-08-05 08:44:31', '2020-08-15 19:43:04'),
(37, 10, 'ijk Apay', NULL, '0.00', NULL, '', '2020-08-05 08:47:48', '2020-08-15 19:43:33'),
(38, 4, 'uncategorized income', NULL, '0.00', 1, '', '2020-08-05 09:59:29', '2020-08-05 09:59:29'),
(71, 6, 'Salary', NULL, NULL, NULL, '914afc82-9edc-42e3-9875-5f6e37aa9fe2', '2020-08-15 19:28:20', '2020-08-15 19:28:20'),
(72, 6, 'Food', NULL, NULL, NULL, '914b0359-1503-480f-a89e-91efdb2abca1', '2020-08-15 19:47:27', '2020-08-15 19:47:27'),
(73, 6, 'Transport Charges', 'sanaullah', NULL, NULL, '914b05b8-d8f5-4b44-8278-a78a7029c46d', '2020-08-15 19:54:05', '2020-08-15 19:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `account_models`
--

CREATE TABLE `account_models` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` tinyint(1) NOT NULL,
  `model_type_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_models`
--

INSERT INTO `account_models` (`id`, `name`, `model_type`, `model_type_name`) VALUES
(1, 'customer', 1, 'Account recievable'),
(2, 'vendor', 2, 'Account payable'),
(3, 'cash&bank', 3, 'Deposits');

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transection_type_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `name`, `transection_type_id`, `created_at`, `updated_at`) VALUES
(1, 'bank', 3, '2020-07-16 04:22:31', '2020-07-16 04:22:31'),
(2, 'asset', 3, '2020-07-18 03:00:25', '2020-07-18 03:00:25'),
(3, 'Account Recievable', 1, NULL, NULL),
(4, 'income', 1, NULL, NULL),
(5, 'cost of goods sold', 4, NULL, NULL),
(6, 'expense', 4, NULL, NULL),
(7, 'equity', 3, NULL, NULL),
(10, 'account payable', 2, NULL, NULL),
(11, 'cash', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `alis`
--

CREATE TABLE `alis` (
  `id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tv', '2021-05-10 13:40:16', '2021-05-10 13:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 'Dubai', 1, '2020-08-09 16:32:15', '2020-08-09 16:32:15'),
(8, 'BANDAR ABBAS', 4, '2020-08-09 17:00:47', '2020-08-09 17:00:47'),
(9, 'Bala', 5, '2021-05-10 13:34:10', '2021-05-10 13:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` decimal(18,2) UNSIGNED DEFAULT 0.00,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rtn` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` int(11) UNSIGNED NOT NULL,
  `city_id` int(11) UNSIGNED NOT NULL,
  `ordered_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `opening_balance`, `mobile`, `email`, `rtn`, `address`, `region_id`, `city_id`, `ordered_uuid`, `created_at`, `updated_at`) VALUES
(1, 'ABDOLLAH ISLAMI', '0.00', '00971556767786', 'mrxoobi@gmail.com', '10090084038403', 'bandar abbas', 4, 8, '914411d7-4fa1-4735-b0ff-15e67c10faaa', '2020-08-12 08:57:11', '2020-08-14 20:22:52'),
(2, 'ZOHAIB HANIF', '0.00', '00971556767786', 'mrxWWoobi@gmail.com', '10090084038403', 'bandar abbas', 4, 8, '914415a3-c53e-4c70-9181-766afd2cfca5', '2020-08-12 09:07:48', '2020-08-12 09:07:48'),
(3, 'Hassan 2', '5000000.00', '321654987', 'abuulhassan44@gmail.com', '123564', '1076, F Block', 5, 9, '936641f3-6294-4e4b-ae49-f804a93b5d46', '2021-05-10 14:13:44', '2021-05-10 14:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(11) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(11) UNSIGNED NOT NULL,
  `journal_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transection_type_id` int(11) UNSIGNED NOT NULL COMMENT 'recievable,payable,general',
  `s_p_am_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'sale,purchase,account manager id',
  `s_p_am_type` int(11) UNSIGNED NOT NULL COMMENT 'sale,purchase,account manager type',
  `account_id` int(11) UNSIGNED NOT NULL COMMENT 'vendor name,customer name',
  `account_type_id` int(11) UNSIGNED NOT NULL,
  `advance_reverse` tinyint(1) UNSIGNED DEFAULT 0,
  `amount` decimal(18,2) UNSIGNED DEFAULT 0.00,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `journal_uuid`, `transection_type_id`, `s_p_am_id`, `s_p_am_type`, `account_id`, `account_type_id`, `advance_reverse`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, '91490cad-4be5-4568-adb2-609b34d8c865', 1, NULL, 3, 27, 11, 0, '1500000.00', 'Opening Balance', '2020-08-14 20:21:53', '2020-08-14 20:21:53'),
(2, '91490cad-4be5-4568-adb2-609b34d8c865', 2, NULL, 3, 31, 7, 0, '1500000.00', 'Opening Balance', '2020-08-14 20:21:53', '2020-08-14 20:21:53'),
(3, '91490e03-6c11-4549-84a7-b4168f3131c9', 1, 1, 3, 26, 2, 0, '460000.00', 'Purchase From Vendor', '2020-08-14 20:25:37', '2020-08-14 20:25:37'),
(4, '91490e03-6c11-4549-84a7-b4168f3131c9', 2, 1, 2, 1, 0, 0, '460000.00', 'Purchase From Vendor', '2020-08-14 20:25:37', '2020-08-14 20:25:37'),
(5, '91490e17-d073-4544-affa-c3992f58e012', 1, 1, 2, 1, 0, 0, '460000.00', 'vender payment', '2020-08-14 20:25:50', '2020-08-14 20:25:50'),
(6, '91490e17-d073-4544-affa-c3992f58e012', 2, 1, 3, 27, 11, 0, '460000.00', 'vender payment', '2020-08-14 20:25:50', '2020-08-14 20:25:50'),
(7, '91490ef0-f8dc-4604-9413-cda4d8f83a42', 1, 2, 3, 26, 2, 0, '170000.00', 'Purchase From Vendor', '2020-08-14 20:28:13', '2020-08-14 20:28:13'),
(8, '91490ef0-f8dc-4604-9413-cda4d8f83a42', 2, 2, 2, 2, 0, 0, '170000.00', 'Purchase From Vendor', '2020-08-14 20:28:13', '2020-08-14 20:28:13'),
(9, '91490f1b-fb9a-4a28-8290-ac225713201b', 1, 2, 2, 2, 0, 0, '50000.00', 'vender payment', '2020-08-14 20:28:41', '2020-08-14 20:28:41'),
(10, '91490f1b-fb9a-4a28-8290-ac225713201b', 2, 2, 3, 27, 11, 0, '50000.00', 'vender payment', '2020-08-14 20:28:41', '2020-08-14 20:28:41'),
(11, '91492055-b73e-47eb-909b-2b2d506ca3af', 1, 1, 1, 1, 0, 0, '240000.00', 'Sale to Customer', '2020-08-14 21:16:51', '2020-08-14 21:16:51'),
(12, '91492055-b73e-47eb-909b-2b2d506ca3af', 2, 1, 3, 35, 4, 0, '240000.00', 'Sale to Customer', '2020-08-14 21:16:51', '2020-08-14 21:16:51'),
(13, '91492055-b73e-47eb-909b-2b2d506ca3af', 1, 1, 3, 28, 5, 0, '230000.00', 'Sale to Customer', '2020-08-14 21:16:51', '2020-08-14 21:16:51'),
(14, '91492055-b73e-47eb-909b-2b2d506ca3af', 2, 1, 3, 26, 2, 0, '230000.00', 'Sale to Customer', '2020-08-14 21:16:51', '2020-08-14 21:16:51'),
(15, '914921af-4e8b-4324-9efc-637f6bc1fd1e', 1, 1, 3, 27, 11, 0, '240000.00', 'Customer payment', '2020-08-14 21:20:37', '2020-08-14 21:20:37'),
(16, '914921af-4e8b-4324-9efc-637f6bc1fd1e', 2, 1, 1, 1, 0, 0, '240000.00', 'customer payment', '2020-08-14 21:20:37', '2020-08-14 21:20:37'),
(17, '9149220a-ef2c-479c-98ba-7015133d694d', 1, 2, 1, 2, 0, 0, '86500.00', 'Sale to Customer', '2020-08-14 21:21:37', '2020-08-14 21:21:37'),
(18, '9149220a-ef2c-479c-98ba-7015133d694d', 2, 2, 3, 35, 4, 0, '86500.00', 'Sale to Customer', '2020-08-14 21:21:37', '2020-08-14 21:21:37'),
(19, '9149220a-ef2c-479c-98ba-7015133d694d', 1, 2, 3, 28, 5, 0, '85000.00', 'Sale to Customer', '2020-08-14 21:21:37', '2020-08-14 21:21:37'),
(20, '9149220a-ef2c-479c-98ba-7015133d694d', 2, 2, 3, 26, 2, 0, '85000.00', 'Sale to Customer', '2020-08-14 21:21:37', '2020-08-14 21:21:37'),
(21, '914922c3-be93-4b4d-92bd-ad81fd048803', 1, 2, 3, 27, 11, 0, '60000.00', 'Customer payment', '2020-08-14 21:23:38', '2020-08-14 21:23:38'),
(22, '914922c3-be93-4b4d-92bd-ad81fd048803', 2, 2, 1, 2, 0, 0, '60000.00', 'customer payment', '2020-08-14 21:23:38', '2020-08-14 21:23:38'),
(23, '9149360d-fda4-45f6-8c3c-5aa250d88cef', 1, NULL, 3, 27, 11, 0, '1000.00', 'advance cash', '2020-08-14 22:17:35', '2020-08-14 22:17:35'),
(24, '9149360d-fda4-45f6-8c3c-5aa250d88cef', 2, NULL, 1, 1, 0, 0, '1000.00', 'advance cash', '2020-08-14 22:17:35', '2020-08-14 22:17:35'),
(25, '914a3068-f23b-49c1-bedc-f0f015cf9b0d', 1, 3, 1, 1, 0, 0, '86500.00', 'Sale to Customer', '2020-08-15 09:57:37', '2020-08-15 09:57:37'),
(26, '914a3068-f23b-49c1-bedc-f0f015cf9b0d', 2, 3, 3, 35, 4, 0, '86500.00', 'Sale to Customer', '2020-08-15 09:57:37', '2020-08-15 09:57:37'),
(27, '914a3068-f23b-49c1-bedc-f0f015cf9b0d', 1, 3, 3, 28, 5, 0, '85000.00', 'Sale to Customer', '2020-08-15 09:57:37', '2020-08-15 09:57:37'),
(28, '914a3068-f23b-49c1-bedc-f0f015cf9b0d', 2, 3, 3, 26, 2, 0, '85000.00', 'Sale to Customer', '2020-08-15 09:57:37', '2020-08-15 09:57:37'),
(29, '914a3176-1813-46b3-9dda-bbd5b7f056de', 1, 4, 1, 2, 0, 0, '240000.00', 'Sale to Customer', '2020-08-15 10:00:34', '2020-08-15 10:00:34'),
(30, '914a3176-1813-46b3-9dda-bbd5b7f056de', 2, 4, 3, 35, 4, 0, '240000.00', 'Sale to Customer', '2020-08-15 10:00:34', '2020-08-15 10:00:34'),
(31, '914a3176-1813-46b3-9dda-bbd5b7f056de', 1, 4, 3, 28, 5, 0, '230000.00', 'Sale to Customer', '2020-08-15 10:00:34', '2020-08-15 10:00:34'),
(32, '914a3176-1813-46b3-9dda-bbd5b7f056de', 2, 4, 3, 26, 2, 0, '230000.00', 'Sale to Customer', '2020-08-15 10:00:34', '2020-08-15 10:00:34'),
(33, '914a3254-b8df-425e-9477-6e82e92d2844', 1, 3, 3, 27, 11, 0, '86500.00', 'Customer payment', '2020-08-15 10:03:00', '2020-08-15 10:03:00'),
(34, '914a3254-b8df-425e-9477-6e82e92d2844', 2, 3, 1, 1, 0, 0, '86500.00', 'customer payment', '2020-08-15 10:03:00', '2020-08-15 10:03:00'),
(35, '914a3297-d88a-434f-a8ca-fba1b3cfee6f', 1, 4, 3, 27, 11, 0, '240000.00', 'Customer payment', '2020-08-15 10:03:44', '2020-08-15 10:03:44'),
(36, '914a3297-d88a-434f-a8ca-fba1b3cfee6f', 2, 4, 1, 2, 0, 0, '240000.00', 'customer payment', '2020-08-15 10:03:44', '2020-08-15 10:03:44'),
(37, '914a32d9-8472-435c-944e-94a64a092d47', 1, 2, 3, 27, 11, 0, '26500.00', 'Customer payment', '2020-08-15 10:04:27', '2020-08-15 10:04:27'),
(38, '914a32d9-8472-435c-944e-94a64a092d47', 2, 2, 1, 2, 0, 0, '26500.00', 'customer payment', '2020-08-15 10:04:27', '2020-08-15 10:04:27'),
(39, '914a4c2f-4f4d-4a3d-99cb-2650d32e7d0f', 1, 3, 3, 26, 2, 0, '110000.00', 'Purchase From Vendor', '2020-08-15 11:15:17', '2020-08-15 11:15:17'),
(40, '914a4c2f-4f4d-4a3d-99cb-2650d32e7d0f', 2, 3, 2, 1, 0, 0, '110000.00', 'Purchase From Vendor', '2020-08-15 11:15:17', '2020-08-15 11:15:17'),
(41, '914a4ea9-269b-40ac-b128-f59b926f92f5', 1, NULL, 3, 27, 11, 0, '50000.00', 'cash amount RECEIVED', '2020-08-15 11:22:13', '2020-08-15 11:22:13'),
(42, '914a4ea9-269b-40ac-b128-f59b926f92f5', 2, NULL, 1, 1, 0, 0, '50000.00', 'cash amount RECEIVED', '2020-08-15 11:22:13', '2020-08-15 11:22:13'),
(43, '914afd38-f6fe-4186-8889-e1903085c843', 1, NULL, 3, 71, 6, 0, '5000.00', 'salary paid for nov 2020', '2020-08-15 19:30:19', '2020-08-15 19:30:19'),
(44, '914afd38-f6fe-4186-8889-e1903085c843', 2, NULL, 3, 27, 11, 0, '5000.00', 'salary paid for nov 2020', '2020-08-15 19:30:19', '2020-08-15 19:30:19'),
(45, '914b02e8-a9d4-4a4a-b88e-45248579ab7c', 1, 3, 2, 1, 0, 0, '110000.00', 'vender payment', '2020-08-15 19:46:13', '2020-08-15 19:46:13'),
(46, '914b02e8-a9d4-4a4a-b88e-45248579ab7c', 2, 3, 3, 27, 11, 0, '110000.00', 'vender payment', '2020-08-15 19:46:13', '2020-08-15 19:46:13'),
(47, '914b03a3-da84-4ffe-ad3d-23980547c588', 1, NULL, 3, 72, 6, 0, '50.00', NULL, '2020-08-15 19:48:16', '2020-08-15 19:48:16'),
(48, '914b03a3-da84-4ffe-ad3d-23980547c588', 2, NULL, 3, 27, 11, 0, '50.00', NULL, '2020-08-15 19:48:16', '2020-08-15 19:48:16'),
(49, '914b04f3-7790-49f9-b70d-fdc70da3f2b1', 1, NULL, 3, 71, 6, 0, '5000.00', 'salary paid for dec 2020', '2020-08-15 19:51:56', '2020-08-15 19:51:56'),
(50, '914b04f3-7790-49f9-b70d-fdc70da3f2b1', 2, NULL, 3, 27, 11, 0, '5000.00', 'salary paid for dec 2020', '2020-08-15 19:51:56', '2020-08-15 19:51:56'),
(51, '914b061b-2bc7-49ca-84b9-8195014a9684', 1, NULL, 3, 73, 6, 0, '20000.00', 'june month', '2020-08-15 19:55:10', '2020-08-15 19:55:10'),
(52, '914b061b-2bc7-49ca-84b9-8195014a9684', 2, NULL, 3, 27, 11, 0, '20000.00', 'june month', '2020-08-15 19:55:10', '2020-08-15 19:55:10'),
(53, '91511748-ea09-4337-bdb1-264c894ef6a8', 1, 2, 2, 2, 0, 0, '120000.00', 'vender payment', '2020-08-18 08:18:10', '2020-08-18 08:18:10'),
(54, '91511748-ea09-4337-bdb1-264c894ef6a8', 2, 2, 3, 27, 11, 0, '120000.00', 'vender payment', '2020-08-18 08:18:10', '2020-08-18 08:18:10'),
(55, '935c0f38-9b94-48a5-b068-897249e84edf', 1, 8, 3, 26, 2, 0, '850.00', 'Purchase From Vendor', '2021-05-05 12:33:36', '2021-05-05 12:33:36'),
(56, '935c0f38-9b94-48a5-b068-897249e84edf', 2, 8, 2, 1, 0, 0, '850.00', 'Purchase From Vendor', '2021-05-05 12:33:36', '2021-05-05 12:33:36'),
(57, '935c0f65-faae-45fd-a8f2-d6fc7540396c', 1, 8, 2, 1, 0, 0, '850.00', 'vender payment', '2021-05-05 12:34:06', '2021-05-05 12:34:06'),
(58, '935c0f65-faae-45fd-a8f2-d6fc7540396c', 2, 8, 3, 27, 11, 0, '850.00', 'vender payment', '2021-05-05 12:34:06', '2021-05-05 12:34:06'),
(61, '935c7366-6024-4852-b464-3344db789efa', 1, 10, 3, 26, 2, 0, '56.00', 'Purchase From Vendor', '2021-05-05 17:13:43', '2021-05-05 17:13:43'),
(62, '935c7366-6024-4852-b464-3344db789efa', 2, 10, 2, 1, 0, 0, '56.00', 'Purchase From Vendor', '2021-05-05 17:13:43', '2021-05-05 17:13:43'),
(63, '935c737d-223b-4ad3-a4a3-3b814df9461a', 1, 10, 2, 1, 0, 0, '30.00', 'vender payment', '2021-05-05 17:13:58', '2021-05-05 17:13:58'),
(64, '935c737d-223b-4ad3-a4a3-3b814df9461a', 2, 10, 3, 27, 11, 0, '30.00', 'vender payment', '2021-05-05 17:13:58', '2021-05-05 17:13:58'),
(65, '935e1bd8-4c6f-41a6-95e8-c12bfa0e4156', 1, 11, 3, 26, 2, 0, '200000.00', 'Purchase From Vendor', '2021-05-06 13:00:33', '2021-05-06 13:00:33'),
(66, '935e1bd8-4c6f-41a6-95e8-c12bfa0e4156', 2, 11, 2, 0, 0, 0, '200000.00', 'Purchase From Vendor', '2021-05-06 13:00:33', '2021-05-06 13:00:33'),
(67, '935e1bf4-4154-4aa9-a4fb-a4898d87036b', 1, 11, 2, 0, 0, 0, '200000.00', 'vender payment', '2021-05-06 13:00:52', '2021-05-06 13:00:52'),
(68, '935e1bf4-4154-4aa9-a4fb-a4898d87036b', 2, 11, 3, 27, 11, 0, '200000.00', 'vender payment', '2021-05-06 13:00:52', '2021-05-06 13:00:52'),
(69, '935e1c2f-1dba-4c22-8a59-cc0f54a106e0', 1, 0, 1, 1, 0, 0, '2500.00', 'Sale to Customer', '2021-05-06 13:01:30', '2021-05-06 13:01:30'),
(70, '935e1c2f-1dba-4c22-8a59-cc0f54a106e0', 2, 0, 3, 35, 4, 0, '2500.00', 'Sale to Customer', '2021-05-06 13:01:30', '2021-05-06 13:01:30'),
(71, '935e1c2f-2106-4a34-9dba-0b7587b2bc4a', 1, 0, 3, 28, 5, 0, '2000.00', 'Sale to Customer', '2021-05-06 13:01:30', '2021-05-06 13:01:30'),
(72, '935e1c2f-2106-4a34-9dba-0b7587b2bc4a', 2, 0, 3, 26, 2, 0, '2000.00', 'Sale to Customer', '2021-05-06 13:01:30', '2021-05-06 13:01:30'),
(73, '935e1c49-a885-4518-9ec0-f37b6da33dfd', 1, 0, 1, 1, 0, 1, '1500.00', 'Advance Reverse', '2021-05-06 13:01:48', '2021-05-06 13:01:48'),
(74, '935e1c49-a885-4518-9ec0-f37b6da33dfd', 2, 0, 3, 27, 11, 1, '1500.00', 'Advance Reverse', '2021-05-06 13:01:48', '2021-05-06 13:01:48'),
(75, '935e1c49-a885-4518-9ec0-f37b6da33dfd', 1, 0, 3, 27, 11, 2, '1500.00', 'Customer payment', '2021-05-06 13:01:48', '2021-05-06 13:01:48'),
(76, '935e1c49-a885-4518-9ec0-f37b6da33dfd', 2, 0, 1, 1, 0, 2, '1500.00', 'Customer payment', '2021-05-06 13:01:48', '2021-05-06 13:01:48'),
(77, '935efee5-08a3-40da-bdfa-e082a6cb8a82', 1, 12, 3, 26, 2, 0, '3400.00', 'Purchase From Vendor', '2021-05-06 23:35:26', '2021-05-06 23:35:26'),
(78, '935efee5-08a3-40da-bdfa-e082a6cb8a82', 2, 12, 2, 1, 0, 0, '3400.00', 'Purchase From Vendor', '2021-05-06 23:35:26', '2021-05-06 23:35:26'),
(79, '935efef8-a7ea-4aa4-b5f9-da2b613746c0', 1, 12, 2, 1, 0, 0, '3400.00', 'vender payment', '2021-05-06 23:35:39', '2021-05-06 23:35:39'),
(80, '935efef8-a7ea-4aa4-b5f9-da2b613746c0', 2, 12, 3, 27, 11, 0, '3400.00', 'vender payment', '2021-05-06 23:35:39', '2021-05-06 23:35:39'),
(81, '936634b0-14a3-46aa-92b9-c864f43335d6', 1, 13, 3, 26, 2, 0, '1120.00', 'Purchase From Vendor', '2021-05-10 13:36:39', '2021-05-10 13:36:39'),
(82, '936634b0-14a3-46aa-92b9-c864f43335d6', 2, 13, 2, 1, 0, 0, '1120.00', 'Purchase From Vendor', '2021-05-10 13:36:39', '2021-05-10 13:36:39'),
(83, '936634c1-5821-4226-96f0-752f7f26dd3d', 1, 13, 2, 1, 0, 0, '1120.00', 'vender payment', '2021-05-10 13:36:50', '2021-05-10 13:36:50'),
(84, '936634c1-5821-4226-96f0-752f7f26dd3d', 2, 13, 3, 27, 11, 0, '1120.00', 'vender payment', '2021-05-10 13:36:50', '2021-05-10 13:36:50'),
(85, '936641f3-6294-4e4b-ae49-f804a93b5d46', 1, NULL, 1, 3, 0, 0, '5000000.00', 'Opening balance', '2021-05-10 14:13:44', '2021-05-10 14:13:44'),
(86, '936641f3-6294-4e4b-ae49-f804a93b5d46', 2, NULL, 3, 38, 4, 0, '5000000.00', 'Opening balance', '2021-05-10 14:13:44', '2021-05-10 14:13:44'),
(87, '93664256-8764-4f5d-997f-750975acbb60', 1, 14, 3, 26, 2, 0, '2200.00', 'Purchase From Vendor', '2021-05-10 14:14:49', '2021-05-10 14:14:49'),
(88, '93664256-8764-4f5d-997f-750975acbb60', 2, 14, 2, 5, 0, 0, '2200.00', 'Purchase From Vendor', '2021-05-10 14:14:49', '2021-05-10 14:14:49'),
(89, '93664268-e783-40d9-99d9-8f47b15c6649', 1, 14, 2, 5, 0, 0, '1000.00', 'vender payment', '2021-05-10 14:15:01', '2021-05-10 14:15:01'),
(90, '93664268-e783-40d9-99d9-8f47b15c6649', 2, 14, 3, 27, 11, 0, '1000.00', 'vender payment', '2021-05-10 14:15:01', '2021-05-10 14:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'Range Hood', 3, NULL, '2021-05-06 12:55:20', '2021-05-06 12:55:20'),
(2, 'Q4\' MATIC - H12C3', 2, NULL, '2020-08-09 16:56:59', '2020-08-09 16:56:59'),
(3, 'Q4\' MATIC - H18C3', 2, NULL, '2020-08-09 16:57:10', '2020-08-09 16:57:10'),
(4, 'Q4\' MATIC - H24C3', 2, NULL, '2020-08-09 16:57:22', '2020-08-09 16:57:22'),
(5, 'ACCENT - H12H1', 2, NULL, '2020-08-09 16:57:40', '2020-08-09 16:59:14'),
(7, 'ACCENT - H24H1', 2, NULL, '2020-08-09 16:58:20', '2020-08-09 16:58:20'),
(8, 'ACCENT - H18H1', 2, NULL, '2020-08-09 16:58:55', '2020-08-09 16:58:55'),
(9, '50UK775 - KELEC', 3, NULL, '2020-08-10 14:54:59', '2020-08-10 14:54:59'),
(10, 'G4\'MATIC-H12C3', 2, NULL, '2020-08-10 14:55:20', '2020-08-10 14:55:20'),
(11, 'G4\'MATIC-H30C3', 2, NULL, '2020-08-10 14:57:24', '2020-08-10 14:57:24'),
(12, 'G4\'MATIC-H24C3', 2, NULL, '2020-08-10 14:58:43', '2020-08-10 14:58:43'),
(13, 'chang hong ruba', 1, NULL, '2021-05-10 13:40:32', '2021-05-10 13:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) UNSIGNED NOT NULL,
  `pay_date` date DEFAULT NULL,
  `vendor_id` int(11) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` decimal(18,2) UNSIGNED DEFAULT NULL,
  `total_amount` decimal(18,2) UNSIGNED DEFAULT NULL,
  `ordered_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(18,2) UNSIGNED DEFAULT 0.00,
  `extra_discount` decimal(18,2) UNSIGNED DEFAULT 0.00,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `pay_date`, `vendor_id`, `status`, `type`, `paid_amount`, `total_amount`, `ordered_uuid`, `discount`, `extra_discount`, `remarks`, `created_at`, `updated_at`) VALUES
(8, '2021-05-05', 1, 1, 'Cash', '850.00', '850.00', '935c0f38-9b94-48a5-b068-897249e84edf', '0.00', '0.00', NULL, '2021-05-05 12:33:36', '2021-05-05 12:33:36'),
(10, '2021-05-05', 1, 2, 'Cash', '30.00', '56.00', '935c7366-6024-4852-b464-3344db789efa', '0.00', '0.00', NULL, '2021-05-05 17:13:43', '2021-05-05 17:13:43'),
(11, '2021-05-06', 0, 1, 'Cash', '200000.00', '200000.00', '935e1bd8-4c6f-41a6-95e8-c12bfa0e4156', '0.00', '0.00', NULL, '2021-05-06 13:00:33', '2021-05-06 13:00:33'),
(12, '2021-05-07', 1, 1, 'Cash', '3400.00', '3400.00', '935efee5-08a3-40da-bdfa-e082a6cb8a82', '0.00', '0.00', NULL, '2021-05-06 23:35:26', '2021-05-06 23:35:26'),
(13, '2021-05-10', 1, 1, 'Cash', '1120.00', '1120.00', '936634b0-14a3-46aa-92b9-c864f43335d6', '0.00', '0.00', NULL, '2021-05-10 13:36:39', '2021-05-10 13:36:39'),
(14, '2021-05-10', 5, 2, 'Cash', '1000.00', '2200.00', '93664256-8764-4f5d-997f-750975acbb60', '0.00', '0.00', NULL, '2021-05-10 14:14:49', '2021-05-10 14:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `purchase_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL,
  `unit_price` decimal(18,2) UNSIGNED NOT NULL,
  `sale_price` decimal(18,2) UNSIGNED NOT NULL,
  `discount` decimal(18,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `quantity`, `unit_price`, `sale_price`, `discount`, `created_at`, `updated_at`) VALUES
(1, 10, 7, 1, '56.00', '100.00', '0.00', '2021-05-05 17:13:43', '2021-05-05 17:13:43'),
(2, 11, 0, 100, '2000.00', '2500.00', '0.00', '2021-05-06 13:00:33', '2021-05-06 13:00:33'),
(3, 12, 9, 10, '100.00', '150.00', '0.00', '2021-05-06 23:35:26', '2021-05-06 23:35:26'),
(4, 12, 5, 20, '120.00', '130.00', '0.00', '2021-05-06 23:35:26', '2021-05-06 23:35:26'),
(5, 13, 9, 10, '100.00', '150.00', '0.00', '2021-05-10 13:36:39', '2021-05-10 13:36:39'),
(6, 13, 5, 1, '120.00', '130.00', '0.00', '2021-05-10 13:36:39', '2021-05-10 13:36:39'),
(7, 14, 9, 10, '100.00', '150.00', '0.00', '2021-05-10 14:14:49', '2021-05-10 14:14:49'),
(8, 14, 5, 10, '120.00', '130.00', '0.00', '2021-05-10 14:14:49', '2021-05-10 14:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'UAE', '2020-08-09 16:32:05', '2020-08-09 16:32:05'),
(2, 'United Arab Emirates', '2020-08-09 16:46:38', '2020-08-09 16:46:38'),
(4, 'IRAN', '2020-08-09 17:00:37', '2020-08-09 17:00:37'),
(5, 'Khola', '2021-05-10 13:33:59', '2021-05-10 13:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `pay_date` date DEFAULT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` decimal(18,2) UNSIGNED DEFAULT 0.00,
  `total_amount` decimal(18,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `ordered_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordered_uuid_cost` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(18,2) UNSIGNED DEFAULT 0.00,
  `extra_discount` decimal(18,2) UNSIGNED DEFAULT 0.00,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `pay_date`, `customer_id`, `status`, `type`, `paid_amount`, `total_amount`, `ordered_uuid`, `ordered_uuid_cost`, `discount`, `extra_discount`, `remarks`, `created_at`, `updated_at`) VALUES
(1, '2020-08-14', 1, 1, 'Cash', '240000.00', '240000.00', '', '', '0.00', '0.00', NULL, '2020-08-14 21:16:51', '2020-08-14 21:16:51'),
(2, '2020-08-15', 2, 1, 'Cash', '86500.00', '86500.00', '', '', '0.00', '0.00', NULL, '2020-08-14 21:21:37', '2020-08-14 21:21:37'),
(3, '2020-08-15', 1, 1, 'Cash', '86500.00', '86500.00', '', '', '0.00', '0.00', NULL, '2020-08-15 09:57:37', '2020-08-15 09:57:37'),
(4, '2020-08-15', 2, 1, 'Cash', '240000.00', '240000.00', '', '', '0.00', '0.00', NULL, '2020-08-15 10:00:34', '2020-08-15 10:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `sale_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL,
  `unit_price` decimal(18,2) UNSIGNED NOT NULL,
  `discount` decimal(18,2) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `discount`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 50, '1050.00', '0.00', '2020-08-14 21:16:51', '2020-08-14 21:16:51'),
(2, 1, 7, 50, '1250.00', '0.00', '2020-08-14 21:16:51', '2020-08-14 21:16:51'),
(3, 1, 8, 50, '1150.00', '0.00', '2020-08-14 21:16:51', '2020-08-14 21:16:51'),
(4, 1, 10, 50, '1350.00', '0.00', '2020-08-14 21:16:51', '2020-08-14 21:16:51'),
(5, 2, 9, 100, '865.00', '0.00', '2020-08-14 21:21:37', '2020-08-14 21:21:37'),
(6, 3, 9, 100, '865.00', '0.00', '2020-08-15 09:57:37', '2020-08-15 09:57:37'),
(7, 4, 5, 50, '1050.00', '0.00', '2020-08-15 10:00:34', '2020-08-15 10:00:34'),
(8, 4, 7, 50, '1250.00', '0.00', '2020-08-15 10:00:34', '2020-08-15 10:00:34'),
(9, 4, 8, 50, '1150.00', '0.00', '2020-08-15 10:00:34', '2020-08-15 10:00:34'),
(10, 4, 10, 50, '1350.00', '0.00', '2020-08-15 10:00:34', '2020-08-15 10:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Sheraz  Zafar Traders', 'Company Name', NULL, NULL),
(2, 'Okara Mandi', 'Company Address', NULL, NULL),
(3, 'test@gmail.com', ' Company Email', NULL, NULL),
(4, '055-425587', 'Company Phone', NULL, NULL),
(5, '0', 'Company TRN', NULL, NULL),
(6, '0', 'Company Vat', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transection_histories`
--

CREATE TABLE `transection_histories` (
  `id` int(11) UNSIGNED NOT NULL,
  `number` int(11) UNSIGNED NOT NULL,
  `transection_type_id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(18,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `paid` decimal(18,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transection_histories`
--

INSERT INTO `transection_histories` (`id`, `number`, `transection_type_id`, `account_id`, `description`, `amount`, `paid`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Purchase From Vendor', '460000.00', '0.00', '2020-08-14 20:25:37', '2020-08-14 20:25:37'),
(2, 1, 2, 1, 'Payment to Vendor', '0.00', '460000.00', '2020-08-14 20:25:50', '2020-08-14 20:25:50'),
(4, 2, 2, 2, 'Purchase By Vendor updated', '170000.00', '0.00', '2020-08-14 20:28:29', '2020-08-14 20:28:29'),
(5, 2, 2, 2, 'Payment to Vendor', '0.00', '50000.00', '2020-08-14 20:28:41', '2020-08-14 20:28:41'),
(6, 1, 1, 1, 'Billed to Customer', '240000.00', '0.00', '2020-08-14 21:16:51', '2020-08-14 21:16:51'),
(7, 1, 1, 1, 'Payment by Customer', '0.00', '240000.00', '2020-08-14 21:20:37', '2020-08-14 21:20:37'),
(8, 2, 1, 2, 'Billed to Customer', '86500.00', '0.00', '2020-08-14 21:21:37', '2020-08-14 21:21:37'),
(9, 2, 1, 2, 'Payment by Customer', '0.00', '60000.00', '2020-08-14 21:23:38', '2020-08-14 21:23:38'),
(10, 3, 1, 1, 'Billed to Customer', '86500.00', '0.00', '2020-08-15 09:57:37', '2020-08-15 09:57:37'),
(11, 4, 1, 2, 'Billed to Customer', '240000.00', '0.00', '2020-08-15 10:00:34', '2020-08-15 10:00:34'),
(12, 3, 1, 1, 'Payment by Customer', '0.00', '86500.00', '2020-08-15 10:03:00', '2020-08-15 10:03:00'),
(13, 4, 1, 2, 'Payment by Customer', '0.00', '240000.00', '2020-08-15 10:03:44', '2020-08-15 10:03:44'),
(14, 2, 1, 2, 'Payment by Customer', '0.00', '26500.00', '2020-08-15 10:04:27', '2020-08-15 10:04:27'),
(15, 3, 2, 1, 'Purchase From Vendor', '110000.00', '0.00', '2020-08-15 11:15:17', '2020-08-15 11:15:17'),
(16, 3, 2, 1, 'Payment to Vendor', '0.00', '110000.00', '2020-08-15 19:46:13', '2020-08-15 19:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `transection_types`
--

CREATE TABLE `transection_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transection_types`
--

INSERT INTO `transection_types` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'recievable', NULL, NULL),
(2, 'payable', NULL, NULL),
(3, 'general', NULL, NULL),
(4, 'expense', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) UNSIGNED DEFAULT NULL,
  `status` int(11) UNSIGNED DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `state`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@admin.com', NULL, 1, 1, NULL, '$2y$10$fOqUG61kl8RIfb55ErkFf.Hazkg2i9yFKYnX7hsEKmkwUknW08HEu', NULL, '2020-07-24 02:28:11', '2020-07-24 02:28:11'),
(3, 'User', 'user@user.com', NULL, 0, 1, NULL, '$2y$10$1bbeWfHta7vpkimCveuVt.P9OxS63VtAwovKri.IjbpjURTlbGPEC', NULL, '2020-07-24 02:28:11', '2020-07-28 01:32:45'),
(21, 'amir', 'amir@amir.com', NULL, 1, 0, NULL, '$2y$10$gssggTYHrSNNydMOi.Uay.gZ63ndR1HnbWtbSVx1gumZKZ1dmQ1lS', NULL, '2020-07-27 07:07:25', '2020-07-27 07:07:25'),
(24, 'ahmad', 'ahmad@gmail.com', NULL, 0, 0, NULL, '$2y$10$buSrIFNhj.SeTO.0qzUFcuzS5NYdQFTMehYe2NQvCbV9KJebobvgi', NULL, '2020-07-27 08:25:22', '2020-07-27 08:54:32'),
(26, 'Abdul Hassan', 'admin44@admin.com', NULL, 0, 1, NULL, '$2y$10$Tru2RXW.qI3D.ETHo6vUw.g3t0sEFoYM5Q5O6dGcnOD/t.5ErsNnW', NULL, '2020-08-08 15:50:21', '2020-08-08 15:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` decimal(18,2) UNSIGNED DEFAULT 0.00,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rtn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(11) UNSIGNED NOT NULL,
  `city_id` int(11) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `opening_balance`, `mobile`, `email`, `rtn`, `region_id`, `city_id`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Mehboob Afzal 1', '0.00', '3460648097', 'mehboob@email.com', 'fsvdfadsS', 1, 1, 'RTFUYHT', '2021-05-06 12:54:14', '2021-05-10 13:35:45'),
(2, 'FLAIR GLOBAL FZE', '0.00', '00971556767786', 'mrxoobi@gmail.com', '10102901000000', 1, 1, 'JEBEL ALI', '2020-08-11 20:14:59', '2020-08-11 20:14:59'),
(3, 'GRAND FORTUNE', '0.00', '00971556767786', 'mrxWWoobi@gmail.com', '10102901000000', 1, 1, 'JEBEL ALI', '2020-08-11 20:15:33', '2020-08-11 20:15:33'),
(4, 'Hassan', '0.00', '321654987', 'abuulhassan44@gmail.com', '123564', 5, 9, '1076, F Block', '2021-05-10 13:34:20', '2021-05-10 13:34:20'),
(5, 'Asif Ali', '0.00', '9876543210', 'asif@gmail.com', 'EGRWFEQ', 1, 1, 'house#3, Street5, Block Q', '2021-05-10 14:14:14', '2021-05-10 14:14:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_management`
--
ALTER TABLE `account_management`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UDX_acc_name` (`account_name`);

--
-- Indexes for table `account_models`
--
ALTER TABLE `account_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alis`
--
ALTER TABLE `alis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uidx_c_name` (`name`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uidx_city_name` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uidx_customer_name` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_uuid` (`journal_uuid`) USING BTREE,
  ADD KEY `idx_acc_type_id` (`account_type_id`),
  ADD KEY `inx_spam_type` (`s_p_am_type`),
  ADD KEY `UN_spam_account_type` (`s_p_am_type`,`account_type_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uidx_P_name` (`name`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uidx_region_name` (`name`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transection_histories`
--
ALTER TABLE `transection_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transection_types`
--
ALTER TABLE `transection_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uidx_vendor_name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_management`
--
ALTER TABLE `account_management`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `account_models`
--
ALTER TABLE `account_models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `alis`
--
ALTER TABLE `alis`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transection_histories`
--
ALTER TABLE `transection_histories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transection_types`
--
ALTER TABLE `transection_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
