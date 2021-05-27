-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 18, 2020 at 06:18 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `opening_balance` decimal(18,2) UNSIGNED DEFAULT '0.00',
  `status` tinyint(1) DEFAULT NULL,
  `ordered_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_management`
--

INSERT INTO `account_management` (`id`, `account_type`, `account_name`, `description`, `opening_balance`, `status`, `ordered_uuid`, `created_at`, `updated_at`) VALUES
(26, 2, 'current asset', NULL, '0.00', 1, '', '2020-07-28 09:55:22', '2020-07-28 09:55:22'),
(27, 11, 'Cash', NULL, '500000.00', NULL, '', '2020-07-28 13:26:42', '2020-08-12 01:25:05'),
(28, 5, 'costs of goods sold', NULL, '25000.00', 1, '', '2020-07-29 11:38:26', '2020-07-29 11:38:26'),
(29, 1, 'alfalah bank', NULL, '12000.00', 1, '', '2020-07-29 11:39:17', '2020-07-29 11:39:17'),
(31, 7, 'Opening Balance Equity', NULL, '12000.00', 1, '', '2020-07-29 11:40:32', '2020-07-29 11:40:32'),
(32, 1, 'habib bank', NULL, '0.00', 1, '', '2020-08-04 12:28:58', '2020-08-04 12:28:58'),
(33, 7, 'equity1', NULL, '0.00', 1, '', '2020-08-04 15:22:17', '2020-08-04 15:22:17'),
(34, 6, 'uncategorized expense', NULL, '0.00', 1, '', '2020-08-05 08:29:08', '2020-08-05 08:29:08'),
(35, 4, 'sales', NULL, '0.00', 1, '', '2020-08-05 09:57:39', '2020-08-05 09:57:39'),
(36, 3, 'ufc ARcv', NULL, '0.00', NULL, '', '2020-08-05 13:44:31', '2020-08-16 00:43:04'),
(37, 10, 'ijk Apay', NULL, '0.00', NULL, '', '2020-08-05 13:47:48', '2020-08-16 00:43:33'),
(38, 4, 'uncategorized income', NULL, '0.00', 1, '', '2020-08-05 14:59:29', '2020-08-05 14:59:29'),
(71, 6, 'Salary', NULL, NULL, NULL, '914afc82-9edc-42e3-9875-5f6e37aa9fe2', '2020-08-16 00:28:20', '2020-08-16 00:28:20'),
(72, 6, 'Food', NULL, NULL, NULL, '914b0359-1503-480f-a89e-91efdb2abca1', '2020-08-16 00:47:27', '2020-08-16 00:47:27'),
(73, 6, 'Transport Charges', 'sanaullah', NULL, NULL, '914b05b8-d8f5-4b44-8278-a78a7029c46d', '2020-08-16 00:54:05', '2020-08-16 00:54:05');

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
(1, 'bank', 3, '2020-07-16 09:22:31', '2020-07-16 09:22:31'),
(2, 'asset', 3, '2020-07-18 08:00:25', '2020-07-18 08:00:25'),
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
(1, 'TV', '2020-08-09 21:38:38', '2020-08-09 21:38:38'),
(2, 'GREE AC', '2020-08-09 21:56:55', '2020-08-09 21:56:55'),
(3, 'KELEC TV', '2020-08-10 19:54:56', '2020-08-10 19:54:56');

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
(1, 'Dubai', 1, '2020-08-09 21:32:15', '2020-08-09 21:32:15'),
(8, 'BANDAR ABBAS', 4, '2020-08-09 22:00:47', '2020-08-09 22:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` decimal(18,2) UNSIGNED DEFAULT '0.00',
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rtn` varchar(20) COLLATE utf8mb4_unicode_ci NULL,
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
(1, 'ABDOLLAH ISLAMI', '0.00', '00971556767786', 'mrxoobi@gmail.com', '10090084038403', 'bandar abbas', 4, 8, '914411d7-4fa1-4735-b0ff-15e67c10faaa', '2020-08-12 13:57:11', '2020-08-15 01:22:52'),
(2, 'ZOHAIB HANIF', '0.00', '00971556767786', 'mrxWWoobi@gmail.com', '10090084038403', 'bandar abbas', 4, 8, '914415a3-c53e-4c70-9181-766afd2cfca5', '2020-08-12 14:07:48', '2020-08-12 14:07:48');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `advance_reverse` tinyint(1) UNSIGNED DEFAULT '0',
  `amount` decimal(18,2) UNSIGNED DEFAULT '0.00',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `journal_uuid`, `transection_type_id`, `s_p_am_id`, `s_p_am_type`, `account_id`, `account_type_id`, `advance_reverse`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, '91490cad-4be5-4568-adb2-609b34d8c865', 1, NULL, 3, 27, 11, 0, '1500000.00', 'Opening Balance', '2020-08-15 01:21:53', '2020-08-15 01:21:53'),
(2, '91490cad-4be5-4568-adb2-609b34d8c865', 2, NULL, 3, 31, 7, 0, '1500000.00', 'Opening Balance', '2020-08-15 01:21:53', '2020-08-15 01:21:53'),
(3, '91490e03-6c11-4549-84a7-b4168f3131c9', 1, 1, 3, 26, 2, 0, '460000.00', 'Purchase From Vendor', '2020-08-15 01:25:37', '2020-08-15 01:25:37'),
(4, '91490e03-6c11-4549-84a7-b4168f3131c9', 2, 1, 2, 1, 0, 0, '460000.00', 'Purchase From Vendor', '2020-08-15 01:25:37', '2020-08-15 01:25:37'),
(5, '91490e17-d073-4544-affa-c3992f58e012', 1, 1, 2, 1, 0, 0, '460000.00', 'vender payment', '2020-08-15 01:25:50', '2020-08-15 01:25:50'),
(6, '91490e17-d073-4544-affa-c3992f58e012', 2, 1, 3, 27, 11, 0, '460000.00', 'vender payment', '2020-08-15 01:25:50', '2020-08-15 01:25:50'),
(7, '91490ef0-f8dc-4604-9413-cda4d8f83a42', 1, 2, 3, 26, 2, 0, '170000.00', 'Purchase From Vendor', '2020-08-15 01:28:13', '2020-08-15 01:28:13'),
(8, '91490ef0-f8dc-4604-9413-cda4d8f83a42', 2, 2, 2, 2, 0, 0, '170000.00', 'Purchase From Vendor', '2020-08-15 01:28:13', '2020-08-15 01:28:13'),
(9, '91490f1b-fb9a-4a28-8290-ac225713201b', 1, 2, 2, 2, 0, 0, '50000.00', 'vender payment', '2020-08-15 01:28:41', '2020-08-15 01:28:41'),
(10, '91490f1b-fb9a-4a28-8290-ac225713201b', 2, 2, 3, 27, 11, 0, '50000.00', 'vender payment', '2020-08-15 01:28:41', '2020-08-15 01:28:41'),
(11, '91492055-b73e-47eb-909b-2b2d506ca3af', 1, 1, 1, 1, 0, 0, '240000.00', 'Sale to Customer', '2020-08-15 02:16:51', '2020-08-15 02:16:51'),
(12, '91492055-b73e-47eb-909b-2b2d506ca3af', 2, 1, 3, 35, 4, 0, '240000.00', 'Sale to Customer', '2020-08-15 02:16:51', '2020-08-15 02:16:51'),
(13, '91492055-b73e-47eb-909b-2b2d506ca3af', 1, 1, 3, 28, 5, 0, '230000.00', 'Sale to Customer', '2020-08-15 02:16:51', '2020-08-15 02:16:51'),
(14, '91492055-b73e-47eb-909b-2b2d506ca3af', 2, 1, 3, 26, 2, 0, '230000.00', 'Sale to Customer', '2020-08-15 02:16:51', '2020-08-15 02:16:51'),
(15, '914921af-4e8b-4324-9efc-637f6bc1fd1e', 1, 1, 3, 27, 11, 0, '240000.00', 'Customer payment', '2020-08-15 02:20:37', '2020-08-15 02:20:37'),
(16, '914921af-4e8b-4324-9efc-637f6bc1fd1e', 2, 1, 1, 1, 0, 0, '240000.00', 'customer payment', '2020-08-15 02:20:37', '2020-08-15 02:20:37'),
(17, '9149220a-ef2c-479c-98ba-7015133d694d', 1, 2, 1, 2, 0, 0, '86500.00', 'Sale to Customer', '2020-08-15 02:21:37', '2020-08-15 02:21:37'),
(18, '9149220a-ef2c-479c-98ba-7015133d694d', 2, 2, 3, 35, 4, 0, '86500.00', 'Sale to Customer', '2020-08-15 02:21:37', '2020-08-15 02:21:37'),
(19, '9149220a-ef2c-479c-98ba-7015133d694d', 1, 2, 3, 28, 5, 0, '85000.00', 'Sale to Customer', '2020-08-15 02:21:37', '2020-08-15 02:21:37'),
(20, '9149220a-ef2c-479c-98ba-7015133d694d', 2, 2, 3, 26, 2, 0, '85000.00', 'Sale to Customer', '2020-08-15 02:21:37', '2020-08-15 02:21:37'),
(21, '914922c3-be93-4b4d-92bd-ad81fd048803', 1, 2, 3, 27, 11, 0, '60000.00', 'Customer payment', '2020-08-15 02:23:38', '2020-08-15 02:23:38'),
(22, '914922c3-be93-4b4d-92bd-ad81fd048803', 2, 2, 1, 2, 0, 0, '60000.00', 'customer payment', '2020-08-15 02:23:38', '2020-08-15 02:23:38'),
(23, '9149360d-fda4-45f6-8c3c-5aa250d88cef', 1, NULL, 3, 27, 11, 0, '1000.00', 'advance cash', '2020-08-15 03:17:35', '2020-08-15 03:17:35'),
(24, '9149360d-fda4-45f6-8c3c-5aa250d88cef', 2, NULL, 1, 1, 0, 0, '1000.00', 'advance cash', '2020-08-15 03:17:35', '2020-08-15 03:17:35'),
(25, '914a3068-f23b-49c1-bedc-f0f015cf9b0d', 1, 3, 1, 1, 0, 0, '86500.00', 'Sale to Customer', '2020-08-15 14:57:37', '2020-08-15 14:57:37'),
(26, '914a3068-f23b-49c1-bedc-f0f015cf9b0d', 2, 3, 3, 35, 4, 0, '86500.00', 'Sale to Customer', '2020-08-15 14:57:37', '2020-08-15 14:57:37'),
(27, '914a3068-f23b-49c1-bedc-f0f015cf9b0d', 1, 3, 3, 28, 5, 0, '85000.00', 'Sale to Customer', '2020-08-15 14:57:37', '2020-08-15 14:57:37'),
(28, '914a3068-f23b-49c1-bedc-f0f015cf9b0d', 2, 3, 3, 26, 2, 0, '85000.00', 'Sale to Customer', '2020-08-15 14:57:37', '2020-08-15 14:57:37'),
(29, '914a3176-1813-46b3-9dda-bbd5b7f056de', 1, 4, 1, 2, 0, 0, '240000.00', 'Sale to Customer', '2020-08-15 15:00:34', '2020-08-15 15:00:34'),
(30, '914a3176-1813-46b3-9dda-bbd5b7f056de', 2, 4, 3, 35, 4, 0, '240000.00', 'Sale to Customer', '2020-08-15 15:00:34', '2020-08-15 15:00:34'),
(31, '914a3176-1813-46b3-9dda-bbd5b7f056de', 1, 4, 3, 28, 5, 0, '230000.00', 'Sale to Customer', '2020-08-15 15:00:34', '2020-08-15 15:00:34'),
(32, '914a3176-1813-46b3-9dda-bbd5b7f056de', 2, 4, 3, 26, 2, 0, '230000.00', 'Sale to Customer', '2020-08-15 15:00:34', '2020-08-15 15:00:34'),
(33, '914a3254-b8df-425e-9477-6e82e92d2844', 1, 3, 3, 27, 11, 0, '86500.00', 'Customer payment', '2020-08-15 15:03:00', '2020-08-15 15:03:00'),
(34, '914a3254-b8df-425e-9477-6e82e92d2844', 2, 3, 1, 1, 0, 0, '86500.00', 'customer payment', '2020-08-15 15:03:00', '2020-08-15 15:03:00'),
(35, '914a3297-d88a-434f-a8ca-fba1b3cfee6f', 1, 4, 3, 27, 11, 0, '240000.00', 'Customer payment', '2020-08-15 15:03:44', '2020-08-15 15:03:44'),
(36, '914a3297-d88a-434f-a8ca-fba1b3cfee6f', 2, 4, 1, 2, 0, 0, '240000.00', 'customer payment', '2020-08-15 15:03:44', '2020-08-15 15:03:44'),
(37, '914a32d9-8472-435c-944e-94a64a092d47', 1, 2, 3, 27, 11, 0, '26500.00', 'Customer payment', '2020-08-15 15:04:27', '2020-08-15 15:04:27'),
(38, '914a32d9-8472-435c-944e-94a64a092d47', 2, 2, 1, 2, 0, 0, '26500.00', 'customer payment', '2020-08-15 15:04:27', '2020-08-15 15:04:27'),
(39, '914a4c2f-4f4d-4a3d-99cb-2650d32e7d0f', 1, 3, 3, 26, 2, 0, '110000.00', 'Purchase From Vendor', '2020-08-15 16:15:17', '2020-08-15 16:15:17'),
(40, '914a4c2f-4f4d-4a3d-99cb-2650d32e7d0f', 2, 3, 2, 1, 0, 0, '110000.00', 'Purchase From Vendor', '2020-08-15 16:15:17', '2020-08-15 16:15:17'),
(41, '914a4ea9-269b-40ac-b128-f59b926f92f5', 1, NULL, 3, 27, 11, 0, '50000.00', 'cash amount RECEIVED', '2020-08-15 16:22:13', '2020-08-15 16:22:13'),
(42, '914a4ea9-269b-40ac-b128-f59b926f92f5', 2, NULL, 1, 1, 0, 0, '50000.00', 'cash amount RECEIVED', '2020-08-15 16:22:13', '2020-08-15 16:22:13'),
(43, '914afd38-f6fe-4186-8889-e1903085c843', 1, NULL, 3, 71, 6, 0, '5000.00', 'salary paid for nov 2020', '2020-08-16 00:30:19', '2020-08-16 00:30:19'),
(44, '914afd38-f6fe-4186-8889-e1903085c843', 2, NULL, 3, 27, 11, 0, '5000.00', 'salary paid for nov 2020', '2020-08-16 00:30:19', '2020-08-16 00:30:19'),
(45, '914b02e8-a9d4-4a4a-b88e-45248579ab7c', 1, 3, 2, 1, 0, 0, '110000.00', 'vender payment', '2020-08-16 00:46:13', '2020-08-16 00:46:13'),
(46, '914b02e8-a9d4-4a4a-b88e-45248579ab7c', 2, 3, 3, 27, 11, 0, '110000.00', 'vender payment', '2020-08-16 00:46:13', '2020-08-16 00:46:13'),
(47, '914b03a3-da84-4ffe-ad3d-23980547c588', 1, NULL, 3, 72, 6, 0, '50.00', NULL, '2020-08-16 00:48:16', '2020-08-16 00:48:16'),
(48, '914b03a3-da84-4ffe-ad3d-23980547c588', 2, NULL, 3, 27, 11, 0, '50.00', NULL, '2020-08-16 00:48:16', '2020-08-16 00:48:16'),
(49, '914b04f3-7790-49f9-b70d-fdc70da3f2b1', 1, NULL, 3, 71, 6, 0, '5000.00', 'salary paid for dec 2020', '2020-08-16 00:51:56', '2020-08-16 00:51:56'),
(50, '914b04f3-7790-49f9-b70d-fdc70da3f2b1', 2, NULL, 3, 27, 11, 0, '5000.00', 'salary paid for dec 2020', '2020-08-16 00:51:56', '2020-08-16 00:51:56'),
(51, '914b061b-2bc7-49ca-84b9-8195014a9684', 1, NULL, 3, 73, 6, 0, '20000.00', 'june month', '2020-08-16 00:55:10', '2020-08-16 00:55:10'),
(52, '914b061b-2bc7-49ca-84b9-8195014a9684', 2, NULL, 3, 27, 11, 0, '20000.00', 'june month', '2020-08-16 00:55:10', '2020-08-16 00:55:10'),
(53, '91511748-ea09-4337-bdb1-264c894ef6a8', 1, 2, 2, 2, 0, 0, '120000.00', 'vender payment', '2020-08-18 13:18:10', '2020-08-18 13:18:10'),
(54, '91511748-ea09-4337-bdb1-264c894ef6a8', 2, 2, 3, 27, 11, 0, '120000.00', 'vender payment', '2020-08-18 13:18:10', '2020-08-18 13:18:10');

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
(2, 'Q4\' MATIC - H12C3', 2, NULL, '2020-08-09 21:56:59', '2020-08-09 21:56:59'),
(3, 'Q4\' MATIC - H18C3', 2, NULL, '2020-08-09 21:57:10', '2020-08-09 21:57:10'),
(4, 'Q4\' MATIC - H24C3', 2, NULL, '2020-08-09 21:57:22', '2020-08-09 21:57:22'),
(5, 'ACCENT - H12H1', 2, NULL, '2020-08-09 21:57:40', '2020-08-09 21:59:14'),
(7, 'ACCENT - H24H1', 2, NULL, '2020-08-09 21:58:20', '2020-08-09 21:58:20'),
(8, 'ACCENT - H18H1', 2, NULL, '2020-08-09 21:58:55', '2020-08-09 21:58:55'),
(9, '50UK775 - KELEC', 3, NULL, '2020-08-10 19:54:59', '2020-08-10 19:54:59'),
(10, 'G4\'MATIC-H12C3', 2, NULL, '2020-08-10 19:55:20', '2020-08-10 19:55:20'),
(11, 'G4\'MATIC-H30C3', 2, NULL, '2020-08-10 19:57:24', '2020-08-10 19:57:24'),
(12, 'G4\'MATIC-H24C3', 2, NULL, '2020-08-10 19:58:43', '2020-08-10 19:58:43');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) UNSIGNED NOT NULL,
  `pay_date` date DEFAULT NULL,
  `vendor_id` int(11) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` decimal(18,2) UNSIGNED DEFAULT NULL,
  `total_amount` decimal(18,2) UNSIGNED DEFAULT NULL,
  `ordered_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(18,2) UNSIGNED DEFAULT '0.00',
  `extra_discount` decimal(18,2) UNSIGNED DEFAULT '0.00',
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `pay_date`, `vendor_id`, `status`, `type`, `paid_amount`, `total_amount`, `ordered_uuid`, `discount`, `extra_discount`, `remarks`, `created_at`, `updated_at`) VALUES
(1, '2020-08-14', 1, 1, 'Cash', '460000.00', '460000.00', '', '0.00', '0.00', NULL, '2020-08-15 01:25:37', '2020-08-15 01:25:37'),
(2, '2020-08-18', 2, 1, 'Cash', '170000.00', '170000.00', '', '0.00', '0.00', NULL, '2020-08-15 01:28:29', '2020-08-15 01:28:29'),
(3, '2020-08-15', 1, 1, 'Cash', '110000.00', '110000.00', '', '0.00', '0.00', NULL, '2020-08-15 16:15:17', '2020-08-15 16:15:17');

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
(1, 1, 5, 100, '1000.00', '1050.00', '0.00', '2020-08-15 01:25:37', '2020-08-15 01:25:37'),
(2, 1, 8, 100, '1100.00', '1150.00', '0.00', '2020-08-15 01:25:37', '2020-08-15 01:25:37'),
(3, 1, 7, 100, '1200.00', '1250.00', '0.00', '2020-08-15 01:25:37', '2020-08-15 01:25:37'),
(4, 1, 10, 100, '1300.00', '1350.00', '0.00', '2020-08-15 01:25:37', '2020-08-15 01:25:37'),
(6, 2, 9, 200, '850.00', '865.00', '0.00', '2020-08-15 01:28:29', '2020-08-15 01:28:29'),
(7, 3, 8, 100, '1100.00', '1150.00', '0.00', '2020-08-15 16:15:17', '2020-08-15 16:15:17');

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
(1, 'UAE', '2020-08-09 21:32:05', '2020-08-09 21:32:05'),
(2, 'United Arab Emirates', '2020-08-09 21:46:38', '2020-08-09 21:46:38'),
(4, 'IRAN', '2020-08-09 22:00:37', '2020-08-09 22:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `pay_date` date DEFAULT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` decimal(18,2) UNSIGNED DEFAULT '0.00',
  `total_amount` decimal(18,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `ordered_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordered_uuid_cost` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(18,2) UNSIGNED DEFAULT '0.00',
  `extra_discount` decimal(18,2) UNSIGNED DEFAULT '0.00',
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `pay_date`, `customer_id`, `status`, `type`, `paid_amount`, `total_amount`, `ordered_uuid`, `ordered_uuid_cost`, `discount`, `extra_discount`, `remarks`, `created_at`, `updated_at`) VALUES
(1, '2020-08-14', 1, 1, 'Cash', '240000.00', '240000.00', '', '', '0.00', '0.00', NULL, '2020-08-15 02:16:51', '2020-08-15 02:16:51'),
(2, '2020-08-15', 2, 1, 'Cash', '86500.00', '86500.00', '', '', '0.00', '0.00', NULL, '2020-08-15 02:21:37', '2020-08-15 02:21:37'),
(3, '2020-08-15', 1, 1, 'Cash', '86500.00', '86500.00', '', '', '0.00', '0.00', NULL, '2020-08-15 14:57:37', '2020-08-15 14:57:37'),
(4, '2020-08-15', 2, 1, 'Cash', '240000.00', '240000.00', '', '', '0.00', '0.00', NULL, '2020-08-15 15:00:34', '2020-08-15 15:00:34');

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
(1, 1, 5, 50, '1050.00', '0.00', '2020-08-15 02:16:51', '2020-08-15 02:16:51'),
(2, 1, 7, 50, '1250.00', '0.00', '2020-08-15 02:16:51', '2020-08-15 02:16:51'),
(3, 1, 8, 50, '1150.00', '0.00', '2020-08-15 02:16:51', '2020-08-15 02:16:51'),
(4, 1, 10, 50, '1350.00', '0.00', '2020-08-15 02:16:51', '2020-08-15 02:16:51'),
(5, 2, 9, 100, '865.00', '0.00', '2020-08-15 02:21:37', '2020-08-15 02:21:37'),
(6, 3, 9, 100, '865.00', '0.00', '2020-08-15 14:57:37', '2020-08-15 14:57:37'),
(7, 4, 5, 50, '1050.00', '0.00', '2020-08-15 15:00:34', '2020-08-15 15:00:34'),
(8, 4, 7, 50, '1250.00', '0.00', '2020-08-15 15:00:34', '2020-08-15 15:00:34'),
(9, 4, 8, 50, '1150.00', '0.00', '2020-08-15 15:00:34', '2020-08-15 15:00:34'),
(10, 4, 10, 50, '1350.00', '0.00', '2020-08-15 15:00:34', '2020-08-15 15:00:34');

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
(1, 'Dubai Erp System', 'Company Name', NULL, NULL),
(2, 'Dubai Sharja, 1st Floor', 'Company Address', NULL, NULL),
(3, 'dubaierp@gmail.com', ' Company Email', NULL, NULL),
(4, '055-425587', 'Company Phone', NULL, NULL),
(5, '789-458', 'Company TRN', NULL, NULL),
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
  `amount` decimal(18,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `paid` decimal(18,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transection_histories`
--

INSERT INTO `transection_histories` (`id`, `number`, `transection_type_id`, `account_id`, `description`, `amount`, `paid`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Purchase From Vendor', '460000.00', '0.00', '2020-08-15 01:25:37', '2020-08-15 01:25:37'),
(2, 1, 2, 1, 'Payment to Vendor', '0.00', '460000.00', '2020-08-15 01:25:50', '2020-08-15 01:25:50'),
(4, 2, 2, 2, 'Purchase By Vendor updated', '170000.00', '0.00', '2020-08-15 01:28:29', '2020-08-15 01:28:29'),
(5, 2, 2, 2, 'Payment to Vendor', '0.00', '50000.00', '2020-08-15 01:28:41', '2020-08-15 01:28:41'),
(6, 1, 1, 1, 'Billed to Customer', '240000.00', '0.00', '2020-08-15 02:16:51', '2020-08-15 02:16:51'),
(7, 1, 1, 1, 'Payment by Customer', '0.00', '240000.00', '2020-08-15 02:20:37', '2020-08-15 02:20:37'),
(8, 2, 1, 2, 'Billed to Customer', '86500.00', '0.00', '2020-08-15 02:21:37', '2020-08-15 02:21:37'),
(9, 2, 1, 2, 'Payment by Customer', '0.00', '60000.00', '2020-08-15 02:23:38', '2020-08-15 02:23:38'),
(10, 3, 1, 1, 'Billed to Customer', '86500.00', '0.00', '2020-08-15 14:57:37', '2020-08-15 14:57:37'),
(11, 4, 1, 2, 'Billed to Customer', '240000.00', '0.00', '2020-08-15 15:00:34', '2020-08-15 15:00:34'),
(12, 3, 1, 1, 'Payment by Customer', '0.00', '86500.00', '2020-08-15 15:03:00', '2020-08-15 15:03:00'),
(13, 4, 1, 2, 'Payment by Customer', '0.00', '240000.00', '2020-08-15 15:03:44', '2020-08-15 15:03:44'),
(14, 2, 1, 2, 'Payment by Customer', '0.00', '26500.00', '2020-08-15 15:04:27', '2020-08-15 15:04:27'),
(15, 3, 2, 1, 'Purchase From Vendor', '110000.00', '0.00', '2020-08-15 16:15:17', '2020-08-15 16:15:17'),
(16, 3, 2, 1, 'Payment to Vendor', '0.00', '110000.00', '2020-08-16 00:46:13', '2020-08-16 00:46:13');

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
  `status` int(11) UNSIGNED DEFAULT '1',
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
(2, 'Admin', 'admin@admin.com', NULL, 1, 1, NULL, '$2y$10$fOqUG61kl8RIfb55ErkFf.Hazkg2i9yFKYnX7hsEKmkwUknW08HEu', NULL, '2020-07-24 07:28:11', '2020-07-24 07:28:11'),
(3, 'User', 'user@user.com', NULL, 0, 1, NULL, '$2y$10$1bbeWfHta7vpkimCveuVt.P9OxS63VtAwovKri.IjbpjURTlbGPEC', NULL, '2020-07-24 07:28:11', '2020-07-28 06:32:45'),
(21, 'amir', 'amir@amir.com', NULL, 1, 0, NULL, '$2y$10$gssggTYHrSNNydMOi.Uay.gZ63ndR1HnbWtbSVx1gumZKZ1dmQ1lS', NULL, '2020-07-27 12:07:25', '2020-07-27 12:07:25'),
(24, 'ahmad', 'ahmad@gmail.com', NULL, 0, 0, NULL, '$2y$10$buSrIFNhj.SeTO.0qzUFcuzS5NYdQFTMehYe2NQvCbV9KJebobvgi', NULL, '2020-07-27 13:25:22', '2020-07-27 13:54:32'),
(26, 'Abdul Hassan', 'admin44@admin.com', NULL, 0, 1, NULL, '$2y$10$Tru2RXW.qI3D.ETHo6vUw.g3t0sEFoYM5Q5O6dGcnOD/t.5ErsNnW', NULL, '2020-08-08 20:50:21', '2020-08-08 20:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` decimal(18,2) UNSIGNED DEFAULT '0.00',
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
(1, 'FLAIR GLOBAL FZE', '0.00', '00971556767786', 'mrxoobi@gmail.com', '10102901000000', 1, 1, 'JEBEL ALI', '2020-08-12 01:14:59', '2020-08-12 01:14:59'),
(2, 'GRAND FORTUNE', '0.00', '00971556767786', 'mrxWWoobi@gmail.com', '10102901000000', 1, 1, 'JEBEL ALI', '2020-08-12 01:15:33', '2020-08-12 01:15:33');

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
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `uidx_user_name` (`name`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
