-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 08:46 AM
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
-- Database: `crust_house`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_state` varchar(255) DEFAULT NULL,
  `branch_city` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `branch_initials` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `branch_code` varchar(255) DEFAULT NULL,
  `branch_address` varchar(255) DEFAULT NULL,
  `branch_web_address` varchar(255) DEFAULT NULL,
  `max_discount_percentage` decimal(8,2) DEFAULT 20.00,
  `receipt_message` varchar(255) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `receipt_tagline` varchar(255) DEFAULT NULL,
  `riderOption` tinyint(1) DEFAULT NULL,
  `onlineDeliveryOption` tinyint(1) DEFAULT NULL,
  `DiningOption` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_state`, `branch_city`, `company_name`, `branch_initials`, `branch_name`, `branch_code`, `branch_address`, `branch_web_address`, `max_discount_percentage`, `receipt_message`, `feedback`, `receipt_tagline`, `riderOption`, `onlineDeliveryOption`, `DiningOption`, `created_at`, `updated_at`) VALUES
(1, 'Capital', 'Islamabad', 'CrustHouse', 'CH', 'CrustHouse12', 'ISB-162', 'Itehhad Center 1st Floor Shop#2, Main Muree Rd, opposite Attock Pump, ISB', 'www.crusthouse.com.pk', 15.00, 'THANK YOU FOR YOUR VISIT', 'SHARE YOUR FEEDBACk', 'ENJOY YOUR MEAL', 0, 1, 1, '2024-08-05 05:40:45', '2024-08-16 10:12:06'),
(4, 'Punjab', 'Wah Cantonment', 'Tehzeeb Bakers', 'TH', 'Tehzeeb Wah', 'WAH-677', 'Opposite Keyani Restaurant, Main GT Road, Wah', 'BabuShona.com', 15.00, 'Thank You Babu', 'Babu', 'Meray babu ny thana thaya', 0, 1, 1, '2024-08-08 01:16:52', '2024-08-19 07:59:55'),
(6, 'Punjab', 'Arifwala', 'Crust-House', 'CH', 'CrustHouse14', 'ARF-455', 'Opposite Keyani Restaurant, Main GT Road, Wah', NULL, 20.00, NULL, NULL, NULL, 0, 0, 1, '2024-08-21 12:49:19', '2024-08-21 12:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `branch_categories`
--

CREATE TABLE `branch_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch_categories`
--

INSERT INTO `branch_categories` (`id`, `category_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-07-18 16:36:24', '2024-07-18 16:36:24'),
(2, 2, 1, '2024-07-18 16:36:39', '2024-07-18 16:36:39'),
(3, 3, 1, '2024-07-18 16:37:04', '2024-07-18 16:37:04'),
(4, 4, 1, '2024-07-18 16:37:13', '2024-07-18 16:37:13'),
(6, 6, 1, '2024-07-21 09:47:57', '2024-07-21 09:47:57'),
(7, 7, 1, '2024-07-21 09:54:58', '2024-07-21 09:54:58'),
(8, 8, 1, '2024-07-21 10:11:01', '2024-07-21 10:11:01'),
(9, 9, 1, '2024-07-21 10:44:39', '2024-07-21 10:44:39'),
(10, 10, 1, '2024-07-21 10:54:15', '2024-07-21 10:54:15'),
(11, 11, 1, '2024-07-21 10:54:25', '2024-07-21 10:54:25'),
(12, 12, 1, '2024-07-21 11:11:43', '2024-07-21 11:11:43'),
(13, 13, 1, '2024-07-21 11:23:13', '2024-07-21 11:23:13'),
(14, 14, 4, '2024-08-08 02:18:11', '2024-08-08 02:18:11'),
(15, 15, 4, '2024-08-08 02:20:44', '2024-08-08 02:20:44'),
(26, 26, 4, '2024-08-08 02:26:43', '2024-08-08 02:26:43'),
(27, 27, 4, '2024-08-08 02:26:56', '2024-08-08 02:26:56'),
(28, 28, 4, '2024-08-08 02:27:16', '2024-08-08 02:27:16'),
(29, 29, 1, '2024-08-09 07:48:15', '2024-08-09 07:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salesman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productPrice` varchar(255) DEFAULT NULL,
  `productAddon` varchar(255) DEFAULT NULL,
  `addonPrice` varchar(255) DEFAULT NULL,
  `productVariation` varchar(255) DEFAULT NULL,
  `VariationPrice` varchar(255) DEFAULT NULL,
  `drinkFlavour` varchar(255) DEFAULT NULL,
  `drinkFlavourPrice` varchar(255) DEFAULT NULL,
  `productQuantity` varchar(255) DEFAULT NULL,
  `totalPrice` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoryImage` varchar(255) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryImage`, `categoryName`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, '1722858547.jpeg', 'Appetizer', 1, '2024-07-18 16:36:24', '2024-08-05 06:49:07'),
(2, '1722858558.jpg', 'Burger', 1, '2024-07-18 16:36:39', '2024-08-05 06:49:18'),
(3, '1722858570.jpg', 'Pizza', 1, '2024-07-18 16:37:04', '2024-08-05 06:49:30'),
(4, '1722858588.jpg', 'Fries', 1, '2024-07-18 16:37:13', '2024-08-09 11:12:19'),
(6, '1722858607.jpg', 'Baked Pasta', 1, '2024-07-21 09:47:57', '2024-08-05 06:50:07'),
(7, '1722858629.jpg', 'Sandwich', 1, '2024-07-21 09:54:58', '2024-08-05 06:50:29'),
(8, '1722858642.jpeg', 'Spin Roll', 1, '2024-07-21 10:11:01', '2024-08-05 06:50:42'),
(9, '1722858663.png', 'Addons', 1, '2024-07-21 10:44:39', '2024-08-05 06:51:03'),
(10, '1722858700.jpeg', 'Platter', 1, '2024-07-21 10:54:15', '2024-08-05 06:51:40'),
(11, '1722858714.jpg', 'Others', 1, '2024-07-21 10:54:25', '2024-08-05 06:51:54'),
(12, '1722858735.jpeg', 'Chicken Pieces', 1, '2024-07-21 11:11:43', '2024-08-05 06:52:15'),
(13, '1722858757.png', 'Drinks', 1, '2024-07-21 11:23:13', '2024-08-05 06:52:37'),
(14, '1723101491.png', 'Cake', 4, '2024-08-08 02:18:11', '2024-08-08 02:18:11'),
(15, '1723101682.png', 'Pastry', 4, '2024-08-08 02:20:44', '2024-08-08 02:21:38'),
(26, '1723102003.png', 'Ice Cream', 4, '2024-08-08 02:26:43', '2024-08-08 02:26:43'),
(27, '1723102016.png', 'Cookies', 4, '2024-08-08 02:26:56', '2024-08-08 02:26:56'),
(28, '1723102036.png', 'Croissant', 4, '2024-08-08 02:27:16', '2024-08-08 02:27:16'),
(29, '1723189695.jpeg', 'xyz', 1, '2024-08-09 07:48:15', '2024-08-09 07:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dealImage` varchar(255) DEFAULT NULL,
  `dealTitle` varchar(255) NOT NULL,
  `dealStatus` varchar(255) NOT NULL,
  `dealActualPrice` varchar(255) DEFAULT NULL,
  `dealDiscountedPrice` varchar(255) DEFAULT NULL,
  `dealEndDate` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `dealImage`, `dealTitle`, `dealStatus`, `dealActualPrice`, `dealDiscountedPrice`, `dealEndDate`, `branch_id`, `created_at`, `updated_at`) VALUES
(3, '1722858819.jpeg', 'Double Deal', 'active', '1238 Pkr', '1099 Pkr', '2024-08-30', 1, '2024-07-21 11:25:29', '2024-08-05 07:27:57'),
(4, '1722858830.jpeg', 'Yummy Deal', 'not active', '1788 Pkr', '1299 Pkr', '2024-08-10', 1, '2024-07-21 11:26:48', '2024-08-15 07:35:16'),
(5, '1722858848.jpg', 'Super Deal', 'not active', '2548 Pkr', '2099 Pkr', '2024-08-10', 1, '2024-07-21 11:27:59', '2024-08-15 07:35:16'),
(6, '1722858866.jpeg', 'Family Deal', 'not active', '5947 Pkr', '4949 Pkr', '2024-08-10', 1, '2024-07-21 11:30:03', '2024-08-15 07:35:16'),
(7, '1722859069.jpeg', 'Student Deal', 'not active', '828 Pkr', '789 Pkr', '2024-08-10', 1, '2024-07-21 11:33:06', '2024-08-15 07:35:16'),
(8, '1722859095.jpeg', 'Crunch Deal', 'not active', '1137 Pkr', '999 Pkr', '2024-08-10', 1, '2024-07-21 11:36:29', '2024-08-15 07:35:16'),
(9, '1722859124.jpeg', 'Saver Deal', 'not active', '1735 Pkr', '1549 Pkr', '2024-08-10', 1, '2024-07-21 11:38:28', '2024-08-15 07:35:16'),
(10, '1722859196.jpeg', 'Big Deal', 'active', '2842 Pkr', '2599 Pkr', '2024-08-24', 1, '2024-07-21 11:41:39', '2024-08-05 06:59:56'),
(11, '1722859250.webp', 'Good Deal', 'active', '2698 Pkr', '2449 Pkr', '2024-08-17', 1, '2024-07-21 11:43:52', '2024-08-05 07:00:50'),
(12, '1722859265.jpeg', 'classic Deal', 'active', '2245 Pkr', '2049 Pkr', '2024-11-02', 1, '2024-07-21 11:47:21', '2024-08-05 07:01:05'),
(14, '1723108590.png', 'FUN ONE', 'not active', '260 Pkr', '220 Pkr', '2024-08-09', 4, '2024-08-08 04:16:30', '2024-08-09 10:12:17'),
(15, '1723108629.png', 'FUN ONE', 'not active', '260 Pkr', '220 Pkr', '2024-08-09', 4, '2024-08-08 04:17:09', '2024-08-09 10:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `dine_in_tables`
--

CREATE TABLE `dine_in_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_number` varchar(255) DEFAULT NULL,
  `max_sitting_capacity` varchar(255) DEFAULT NULL,
  `table_status` decimal(8,2) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dine_in_tables`
--

INSERT INTO `dine_in_tables` (`id`, `table_number`, `max_sitting_capacity`, `table_status`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'H1T1', '6 Chairs', 1.00, 1, '2024-08-15 05:50:24', '2024-08-15 05:50:24'),
(2, 'H1T2', '10 Chairs', 1.00, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discount_reason` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount_reason`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Family Discount', 1, '2024-07-21 20:01:06', '2024-07-21 20:01:12'),
(2, 'General Discount', 1, '2024-07-25 05:43:58', '2024-07-25 05:43:58'),
(3, 'Family', 4, '2024-08-08 05:32:11', '2024-08-08 05:32:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `handlers`
--

CREATE TABLE `handlers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deal_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_total_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `handlers`
--

INSERT INTO `handlers` (`id`, `deal_id`, `product_id`, `product_quantity`, `product_total_price`, `created_at`, `updated_at`) VALUES
(7, 3, 57, 2, '998.00 Pkr', NULL, NULL),
(9, 4, 54, 1, '1299.00 Pkr', NULL, NULL),
(10, 4, 18, 1, '249.00 Pkr', NULL, NULL),
(12, 5, 83, 1, '1649.00 Pkr', NULL, NULL),
(13, 5, 1, 1, '399.00 Pkr', NULL, NULL),
(15, 6, 79, 3, '4947.00 Pkr', NULL, NULL),
(17, 7, 5, 1, '399.00 Pkr', NULL, NULL),
(18, 7, 18, 1, '249.00 Pkr', NULL, NULL),
(20, 8, 5, 2, '798.00 Pkr', NULL, NULL),
(21, 8, 18, 1, '249.00 Pkr', NULL, NULL),
(23, 9, 5, 2, '798.00 Pkr', NULL, NULL),
(24, 9, 18, 1, '249.00 Pkr', NULL, NULL),
(25, 9, 135, 2, '498.00 Pkr', NULL, NULL),
(27, 10, 5, 4, '1596.00 Pkr', NULL, NULL),
(28, 10, 135, 4, '996.00 Pkr', NULL, NULL),
(30, 11, 87, 1, '1649.00 Pkr', NULL, NULL),
(31, 11, 34, 1, '799.00 Pkr', NULL, NULL),
(33, 12, 5, 5, '1995.00 Pkr', NULL, NULL),
(36, 7, 162, 1, '90.00 Pkr', '2024-08-05 06:57:39', '2024-08-05 06:57:39'),
(37, 3, 155, 1, '120.00 Pkr', '2024-08-05 07:27:18', '2024-08-05 07:27:18'),
(38, 4, 151, 1, '120.00 Pkr', '2024-08-05 07:28:44', '2024-08-05 07:28:44'),
(39, 5, 157, 1, '250.00 Pkr', '2024-08-05 07:29:16', '2024-08-05 07:29:16'),
(40, 6, 157, 2, '500.00 Pkr', '2024-08-05 07:35:46', '2024-08-05 07:35:46'),
(41, 14, 168, 1, '80.00 Pkr', NULL, NULL),
(42, 14, 171, 1, '180.00 Pkr', NULL, NULL),
(43, 15, 168, 1, '80.00 Pkr', NULL, NULL),
(44, 15, 171, 1, '180.00 Pkr', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2024_04_05_072955_create_branches_table', 1),
(4, '2024_04_05_072956_create_users_table', 1),
(5, '2024_04_15_063251_create_categories_table', 1),
(6, '2024_04_15_113706_create_products_table', 1),
(7, '2024_04_16_180743_create_deals_table', 1),
(8, '2024_04_17_115459_create_handlers_table', 1),
(9, '2024_04_18_120307_create_stocks_table', 1),
(10, '2024_04_25_175949_create_recipes_table', 1),
(11, '2024_05_17_153449_create_notifications_table', 1),
(12, '2024_05_21_154456_create_orders_table', 1),
(13, '2024_05_21_154709_create_order_items_table', 1),
(14, '2024_06_03_084319_create_carts_table', 1),
(15, '2024_06_07_163852_create_stock_histories_table', 1),
(16, '2024_07_03_163720_create_branch_categories_table', 1),
(17, '2024_07_12_130544_create_taxes_table', 1),
(18, '2024_07_12_175536_create_discounts_table', 1),
(19, '2024_07_23_152003_create_owner_settings_table', 1),
(20, '2024_07_25_103142_create_payment_methods_table', 1),
(21, '2024_08_09_174134_create_dine_in_tables_table', 2),
(22, '2024_08_15_153836_adda_field_to_branch', 3),
(23, '2024_08_16_161216_adda_field_to_order', 4),
(24, '2024_08_23_114609_add_field_to_user', 5),
(25, '2024_08_26_160532_add_field_to_orders', 6),
(26, '2024_08_27_151103_create_online_orders_table', 7),
(27, '2024_08_27_152145_create_online_notifications_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_notifications`
--

CREATE TABLE `online_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `toast` int(11) DEFAULT 0,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salesman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_bill` varchar(255) DEFAULT NULL,
  `taxes` decimal(8,2) DEFAULT 0.00,
  `delivery_charge` varchar(255) DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT 0.00,
  `discount_reason` varchar(255) DEFAULT 'None',
  `discount_type` varchar(255) DEFAULT 'None',
  `payment_method` varchar(255) DEFAULT NULL,
  `received_cash` decimal(8,2) DEFAULT NULL,
  `return_change` decimal(8,2) DEFAULT NULL,
  `ordertype` varchar(255) DEFAULT NULL,
  `order_address` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 2,
  `order_cancel_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `customer_id`, `salesman_id`, `branch_id`, `total_bill`, `taxes`, `delivery_charge`, `discount`, `discount_reason`, `discount_type`, `payment_method`, `received_cash`, `return_change`, `ordertype`, `order_address`, `status`, `order_cancel_by`, `created_at`, `updated_at`) VALUES
(7, 'CH-100', NULL, 10, 1, 'Rs. 1474.545', 37.43, NULL, 4.00, 'General Discount', '%', 'NayaPAY', 1600.00, 65.58, 'Takeaway', NULL, 1, NULL, '2024-08-06 07:17:11', '2024-08-06 07:17:11'),
(8, 'TZ-101', NULL, 25, 4, 'Rs. 3200', 0.00, NULL, NULL, NULL, NULL, 'Cash', 5000.00, 1800.00, 'Dine-In', NULL, 1, NULL, '2024-08-08 05:21:42', '2024-08-08 05:25:18'),
(9, 'TZ-102', NULL, 25, 4, 'Rs. 300', 0.00, NULL, NULL, NULL, '%', 'Cash', 400.00, 100.00, 'Dine-In', NULL, 3, NULL, '2024-08-08 05:24:14', '2024-08-08 05:24:41'),
(10, 'TZ-103', NULL, 25, 4, 'Rs. 240', 0.00, NULL, NULL, NULL, '%', 'Cash', 240.00, 0.00, 'Dine-In', NULL, 1, NULL, '2024-08-08 05:27:21', '2024-08-08 05:27:36'),
(11, 'TZ-104', NULL, 25, 4, 'Rs. 1640', 40.00, NULL, NULL, NULL, '%', 'Cash', 2000.00, 360.00, 'dine-in', NULL, 1, NULL, '2024-08-08 05:52:57', '2024-08-08 05:53:25'),
(12, 'TZ-105', NULL, 25, 4, 'Rs. 123', 3.00, NULL, NULL, NULL, '%', 'Cash', 125.00, 2.00, 'dine-in', NULL, 1, NULL, '2024-08-08 05:53:14', '2024-08-08 05:53:28'),
(13, 'TZ-106', NULL, 25, 4, 'Rs. 144', 4.00, NULL, 20.00, 'Family', '-', 'Cash', 170.00, 6.00, 'dine-in', NULL, 1, NULL, '2024-08-08 05:55:57', '2024-08-08 06:07:17'),
(14, 'TZ-107', NULL, 25, 4, 'Rs. -954', 6.00, NULL, 500.00, 'none', '%', 'Cash', 500.00, 254.00, 'dine-in', NULL, 1, NULL, '2024-08-08 05:57:05', '2024-08-08 06:07:27'),
(15, 'TZ-108', NULL, 25, 4, 'Rs. 111', 3.00, NULL, 10.00, 'none', '%', 'Cash', 150.00, 27.00, 'dine-in', NULL, 1, NULL, '2024-08-08 05:57:56', '2024-08-08 06:07:18'),
(16, 'TZ-109', NULL, 28, 4, 'Rs. 103', 3.00, NULL, 20.00, 'Family', '-', 'Jazzcash', 150.00, 27.00, 'dine-in', NULL, 1, NULL, '2024-08-08 06:01:15', '2024-08-08 06:07:25'),
(17, 'TZ-110', NULL, 28, 4, 'Rs. 74', 2.00, NULL, 10.00, 'Family', '%', 'Jazzcash', 100.00, 18.00, 'dine-in', NULL, 1, NULL, '2024-08-08 06:05:15', '2024-08-08 06:07:21'),
(18, 'TZ-111', NULL, 28, 4, 'Rs. 246', 6.00, NULL, NULL, NULL, '%', 'Cash', 1000.00, 754.00, 'dine-in', NULL, 1, NULL, '2024-08-08 06:06:25', '2024-08-08 06:07:24'),
(19, 'TZ-112', NULL, 28, 4, 'Rs. 123', 3.00, NULL, NULL, NULL, NULL, 'Cash', 123.00, 0.00, 'takeaway', NULL, 1, NULL, '2024-08-08 06:09:02', '2024-08-08 06:09:13'),
(20, 'TZ-113', NULL, 25, 4, 'Rs. 525', 25.00, NULL, 500.00, 'none', '-', 'Cash', 1500.00, 475.00, 'dine-in', NULL, 1, NULL, '2024-08-08 06:31:24', '2024-08-08 06:31:34'),
(21, 'TZ-114', NULL, 25, 4, 'Rs. 820', 20.00, NULL, NULL, NULL, '%', 'Cash', 1000.00, 180.00, 'dine-in', NULL, 1, NULL, '2024-08-08 06:33:35', '2024-08-08 06:39:05'),
(22, 'TZ-115', NULL, 25, 4, 'Rs. 222', 6.00, NULL, 10.00, 'none', '%', 'Cash', 300.00, 54.00, 'dine-in', NULL, 1, NULL, '2024-08-08 06:33:55', '2024-08-08 06:39:08'),
(23, 'TZ-116', NULL, 28, 4, 'Rs. 259', 7.00, NULL, 10.00, 'Family', '%', 'Jazzcash', 300.00, 13.00, 'dine-in', NULL, 1, NULL, '2024-08-08 06:35:15', '2024-08-08 06:39:10'),
(24, 'TZ-117', NULL, 28, 4, 'Rs. 123', 3.00, NULL, NULL, NULL, '%', 'Cash', 150.00, 27.00, 'takeaway', NULL, 1, NULL, '2024-08-08 06:35:55', '2024-08-08 06:39:13'),
(25, 'TZ-118', NULL, 28, 4, 'Rs. 385', 11.00, NULL, 15.00, 'Family', '%', 'Cash', 400.00, 16.65, 'takeaway', NULL, 1, NULL, '2024-08-08 06:55:45', '2024-08-08 07:18:52'),
(26, 'TZ-119', NULL, 28, 4, 'Rs. 1700', 44.75, NULL, 134.75, 'none', '-', 'Cash', 1700.00, 0.00, 'dine-in', NULL, 1, NULL, '2024-08-08 07:01:59', '2024-08-08 07:18:53'),
(29, 'CH-101', NULL, 10, 1, 'Rs. 818.975', 19.98, NULL, NULL, NULL, '%', 'Cash', 900.00, 81.02, 'Takeaway', NULL, 2, NULL, '2024-08-15 11:21:04', '2024-08-16 10:28:23'),
(30, 'TH-120', NULL, 25, 4, 'Rs. 82', 2.00, NULL, NULL, NULL, '%', 'Cash', 100.00, 18.00, 'takeaway', NULL, 2, NULL, '2024-08-15 11:23:38', '2024-08-15 11:23:38'),
(31, 'CH-102', NULL, 10, 1, 'Rs. 585.225', 16.23, NULL, 80.00, 'none', '-', 'Sadapay', 600.00, 15.00, 'Takeaway', NULL, 2, NULL, '2024-08-16 08:05:23', '2024-08-16 11:01:20'),
(32, 'CH-103', NULL, 10, 1, 'Rs. 365.085', 9.98, NULL, 11.00, NULL, '%', 'Cash', 400.00, 37.00, 'Takeaway', NULL, 2, NULL, '2024-08-16 08:06:56', '2024-08-16 11:34:39'),
(33, 'CH-104', NULL, 10, 1, 'Rs. 1136.625', 32.48, NULL, 15.00, 'Family Discount', '%', 'Cash', 1150.00, 19.00, 'Takeaway', NULL, 2, NULL, '2024-08-16 09:38:01', '2024-08-16 11:35:52'),
(34, 'CH-105', NULL, 10, 1, 'Rs. 1331.475', 32.48, NULL, NULL, NULL, NULL, 'Cash', 1400.00, 69.00, 'Takeaway', NULL, 2, NULL, '2024-08-16 11:39:53', '2024-08-16 11:39:53'),
(40, 'OL-ORD-100', 37, 10, NULL, '1596', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'Cb 656 sajjadtown asifabad wah cantt', 5, NULL, '2024-08-26 11:47:30', '2024-08-27 07:25:44'),
(41, 'OL-ORD-101', 37, 10, 1, '1995', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'Cb 656 sajjadtown asifabad wah cantt', 1, NULL, '2024-08-26 11:50:38', '2024-08-27 06:41:31'),
(42, 'OL-ORD-102', 37, NULL, NULL, '1197', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'gdgdfgdfdgbdfgbdfgdfg', 3, NULL, '2024-08-27 05:24:42', '2024-08-27 05:24:42'),
(43, 'OL-ORD-103', 37, 10, 1, '11745', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'aa4s5ed6rdftfyguygiuhoijoijioj', 5, NULL, '2024-08-27 07:34:24', '2024-08-27 10:06:20'),
(44, 'OL-ORD-104', 37, 10, 1, '1898', 0.00, '0', 0.00, 'None', 'None', 'Credit Card', NULL, NULL, 'online', 'fguhfjhgjhgjhb', 5, NULL, '2024-08-27 07:34:55', '2024-08-27 12:18:31'),
(45, 'OL-ORD-105', 37, NULL, NULL, '399', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'aqwsedrfgthyjuiklokp', 2, NULL, '2024-08-27 10:35:03', '2024-08-27 10:35:03'),
(46, 'OL-ORD-106', 37, NULL, NULL, '848', 0.00, '0', 0.00, 'None', 'None', 'Credit Card', NULL, NULL, 'online', 'Cb 656 sajjadtown asifabad wah cantt', 2, NULL, '2024-08-27 10:44:54', '2024-08-27 10:44:54'),
(47, 'OL-ORD-107', 37, NULL, NULL, '499', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'dsgdfh', 2, NULL, '2024-08-27 10:50:21', '2024-08-27 10:50:21'),
(48, 'OL-ORD-108', 37, NULL, NULL, '399', 0.00, '0', 0.00, 'None', 'None', 'Credit Card', NULL, NULL, 'online', 'zasxdcfvgbhnm,.,gvfcdxs', 2, NULL, '2024-08-27 10:55:28', '2024-08-27 10:55:28'),
(49, 'OL-ORD-109', 37, NULL, NULL, '399', 0.00, '0', 0.00, 'None', 'None', 'Credit Card', NULL, NULL, 'online', 'dgfdhgfhgdfhgc', 2, NULL, '2024-08-27 11:15:50', '2024-08-27 11:15:50'),
(50, 'OL-ORD-110', 37, NULL, NULL, '499', 0.00, '0', 0.00, 'None', 'None', 'Credit Card', NULL, NULL, 'online', 'vjhgjhghjghjghjgjh', 2, NULL, '2024-08-27 11:21:51', '2024-08-27 11:21:51'),
(51, 'OL-ORD-111', 37, NULL, NULL, '399', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'asf', 2, NULL, '2024-08-27 12:01:37', '2024-08-27 12:01:37'),
(52, 'OL-ORD-112', 37, NULL, NULL, '349', 0.00, '0', 0.00, 'None', 'None', 'Credit Card', NULL, NULL, 'online', 'jhfhgfjhgf', 2, NULL, '2024-08-27 12:02:11', '2024-08-27 12:02:11'),
(53, 'OL-ORD-113', 37, NULL, NULL, '649', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'hjvhjhjghjgjhgjh', 2, NULL, '2024-08-27 12:02:44', '2024-08-27 12:02:44'),
(54, 'OL-ORD-114', 37, NULL, NULL, '399', 0.00, '0', 0.00, 'None', 'None', 'Credit Card', NULL, NULL, 'online', 'vcv', 2, NULL, '2024-08-27 12:03:11', '2024-08-27 12:03:11'),
(55, 'OL-ORD-115', 37, NULL, NULL, '399', 0.00, '0', 0.00, 'None', 'None', 'Credit Card', NULL, NULL, 'online', 'bnm,', 2, NULL, '2024-08-27 12:11:01', '2024-08-27 12:11:01'),
(56, 'OL-ORD-116', 37, NULL, NULL, '798', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'Cb 656 sajjadtown asifabad wah cantt', 2, NULL, '2024-08-27 12:41:57', '2024-08-27 12:41:57'),
(57, 'OL-ORD-117', 37, NULL, NULL, '4196', 0.00, '0', 0.00, 'None', 'None', 'Credit Card', NULL, NULL, 'online', 'azsdcfv', 2, NULL, '2024-08-27 12:49:38', '2024-08-27 12:49:38'),
(58, 'OL-ORD-118', 37, NULL, NULL, '6891', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'Cb 656 sajjadtown asifabad wah cantt', 2, NULL, '2024-08-28 06:31:43', '2024-08-28 06:31:43'),
(59, 'OL-ORD-119', 37, NULL, NULL, '6891', 0.00, '0', 0.00, 'None', 'None', 'Cash On Delivery', NULL, NULL, 'online', 'Cb 656 sajjadtown asifabad wah cantt', 2, NULL, '2024-08-28 06:32:44', '2024-08-28 06:32:44'),
(60, 'CH-001', NULL, 10, 1, 'Rs. 2866.925', 69.93, NULL, NULL, NULL, '%', 'Easypaisa', 3000.00, 134.00, 'Takeaway', NULL, 2, NULL, '2024-08-28 06:41:44', '2024-08-28 06:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_variation` varchar(255) DEFAULT NULL,
  `addons` varchar(255) DEFAULT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `order_number`, `product_id`, `product_name`, `product_variation`, `addons`, `product_price`, `product_quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(8, 7, 'CH-100', 5, 'Only Burger Zinger Burger', 'Only Burger', '', 'Rs. 399', '2', 'Rs. 798', '2024-08-06 07:17:11', '2024-08-06 07:17:11'),
(9, 7, 'CH-100', 38, 'Regular Pizza Sandwich', 'Regular', '', 'Rs. 699', '1', 'Rs. 699', '2024-08-06 07:17:11', '2024-08-06 07:17:11'),
(10, 8, 'TZ-101', 166, '1 Pound Chocolate Cake', '1 Pound', '', 'Rs. 800', '4', 'Rs. 3200', '2024-08-08 05:21:42', '2024-08-08 05:21:42'),
(11, 9, 'TZ-102', 169, 'Large Vanilla Ice Cream', 'Large', '', 'Rs. 150', '2', 'Rs. 300', '2024-08-08 05:24:14', '2024-08-08 05:24:14'),
(12, 10, 'TZ-103', 172, '3 Scoop Vanilla', '3 Scoop', '', 'Rs. 240', '1', 'Rs. 240', '2024-08-08 05:27:21', '2024-08-08 05:27:21'),
(13, 11, 'TZ-104', 166, '1 Pound Chocolate Cake', '1 Pound', '', 'Rs. 800', '2', 'Rs. 1600', '2024-08-08 05:52:57', '2024-08-08 05:52:57'),
(14, 12, 'TZ-105', 170, '1 Scoop Vanilla', '1 Scoop', '', 'Rs. 120', '1', 'Rs. 120', '2024-08-08 05:53:14', '2024-08-08 05:53:14'),
(15, 13, 'TZ-106', 168, 'Small Vanilla Ice Cream', 'Small', '', 'Rs. 80', '2', 'Rs. 160', '2024-08-08 05:55:57', '2024-08-08 05:55:57'),
(16, 14, 'TZ-107', 170, '1 Scoop Vanilla', '1 Scoop', '', 'Rs. 120', '2', 'Rs. 240', '2024-08-08 05:57:05', '2024-08-08 05:57:05'),
(17, 15, 'TZ-108', 170, '1 Scoop Vanilla', '1 Scoop', '', 'Rs. 120', '1', 'Rs. 120', '2024-08-08 05:57:56', '2024-08-08 05:57:56'),
(18, 16, 'TZ-109', 170, '1 Scoop Vanilla', '1 Scoop', '', 'Rs. 120', '1', 'Rs. 120', '2024-08-08 06:01:15', '2024-08-08 06:01:15'),
(19, 17, 'TZ-110', 168, 'Small Vanilla Ice Cream', 'Small', '', 'Rs. 80', '1', 'Rs. 80', '2024-08-08 06:05:15', '2024-08-08 06:05:15'),
(20, 18, 'TZ-111', 172, '3 Scoop Vanilla', '3 Scoop', '', 'Rs. 240', '1', 'Rs. 240', '2024-08-08 06:06:25', '2024-08-08 06:06:25'),
(21, 19, 'TZ-112', 170, '1 Scoop Vanilla', '1 Scoop', '', 'Rs. 120', '1', 'Rs. 120', '2024-08-08 06:09:02', '2024-08-08 06:09:02'),
(22, 20, 'TZ-113', 166, '1 Pound Chocolate Cake', '1 Pound', '', 'Rs. 800', '1', 'Rs. 800', '2024-08-08 06:31:24', '2024-08-08 06:31:24'),
(23, 20, 'TZ-113', 168, 'Small Vanilla Ice Cream', 'Small', '', 'Rs. 80', '1', 'Rs. 80', '2024-08-08 06:31:24', '2024-08-08 06:31:24'),
(24, 20, 'TZ-113', 170, '1 Scoop Vanilla', '1 Scoop', '', 'Rs. 120', '1', 'Rs. 120', '2024-08-08 06:31:24', '2024-08-08 06:31:24'),
(25, 21, 'TZ-114', 166, '1 Pound Chocolate Cake', '1 Pound', '', 'Rs. 800', '1', 'Rs. 800', '2024-08-08 06:33:35', '2024-08-08 06:33:35'),
(26, 22, 'TZ-115', 170, '1 Scoop Vanilla', '1 Scoop', '', 'Rs. 120', '2', 'Rs. 240', '2024-08-08 06:33:55', '2024-08-08 06:33:55'),
(27, 23, 'TZ-116', 170, '1 Scoop Vanilla', '1 Scoop', '', 'Rs. 120', '1', 'Rs. 120', '2024-08-08 06:35:15', '2024-08-08 06:35:15'),
(28, 23, 'TZ-116', 168, 'Small Vanilla Ice Cream', 'Small', '', 'Rs. 80', '2', 'Rs. 160', '2024-08-08 06:35:15', '2024-08-08 06:35:15'),
(29, 24, 'TZ-117', 170, '1 Scoop Vanilla', '1 Scoop', '', 'Rs. 120', '1', 'Rs. 120', '2024-08-08 06:35:56', '2024-08-08 06:35:56'),
(30, 25, 'TZ-118', 14, 'FUN ONE', NULL, '', 'Rs. 220', '2', 'Rs. 440', '2024-08-08 06:55:45', '2024-08-08 06:55:45'),
(31, 26, 'TZ-119', 166, '1 Pound Chocolate Cake', '1 Pound', '', 'Rs. 800', '1', 'Rs. 800', '2024-08-08 07:01:59', '2024-08-08 07:01:59'),
(32, 26, 'TZ-119', 169, 'Large Vanilla Ice Cream', 'Large', '', 'Rs. 150', '3', 'Rs. 450', '2024-08-08 07:01:59', '2024-08-08 07:01:59'),
(33, 26, 'TZ-119', 171, '2 Scoop Vanilla', '2 Scoop', '', 'Rs. 180', '3', 'Rs. 540', '2024-08-08 07:01:59', '2024-08-08 07:01:59'),
(34, 29, 'CH-101', 28, 'Large Crunchy', 'Large', '', 'Rs. 799', '1', 'Rs. 799', '2024-08-15 11:21:04', '2024-08-15 11:21:04'),
(35, 30, 'TH-120', 168, 'Small Vanilla Ice Cream', 'Small', '', 'Rs. 80', '1', 'Rs. 80', '2024-08-15 11:23:38', '2024-08-15 11:23:38'),
(36, 31, 'CH-102', 13, 'Small Square Pizza', 'Small', '', 'Rs. 649', '1', 'Rs. 649', '2024-08-16 08:05:23', '2024-08-16 08:05:23'),
(37, 32, 'CH-103', 5, 'Only Burger Zinger Burger', 'Only Burger', '', 'Rs. 399', '1', 'Rs. 399', '2024-08-16 08:06:56', '2024-08-16 08:06:56'),
(38, 33, 'CH-104', 7, 'Medium Crown Crust', 'Medium', '', 'Rs. 1299', '1', 'Rs. 1299', '2024-08-16 09:38:02', '2024-08-16 09:38:02'),
(39, 34, 'CH-105', 54, 'Medium Kabab Stuffer', 'Medium', '', 'Rs. 1299', '1', 'Rs. 1299', '2024-08-16 11:39:53', '2024-08-16 11:39:53'),
(42, 40, 'OL-ORD-100', NULL, 'Bar B Q Wings', '6 Pieces', NULL, '399', '1', '399', '2024-08-26 11:47:30', '2024-08-26 11:47:30'),
(43, 40, 'OL-ORD-100', NULL, 'Sweet Chilli Wings', '6 Pieces', NULL, '399', '3', '1197', '2024-08-26 11:47:30', '2024-08-26 11:47:30'),
(44, 41, 'OL-ORD-101', NULL, 'Bar B Q Wings', '6 Pieces', NULL, '399', '2', '798', '2024-08-26 11:50:38', '2024-08-26 11:50:38'),
(45, 41, 'OL-ORD-101', NULL, 'Sweet Chilli Wings', '6 Pieces', NULL, '399', '3', '1197', '2024-08-26 11:50:38', '2024-08-26 11:50:38'),
(46, 42, 'OL-ORD-102', NULL, 'Peri Peri Wings', '6 Pieces', NULL, '399', '2', '798', '2024-08-27 05:24:42', '2024-08-27 05:24:42'),
(47, 42, 'OL-ORD-102', NULL, 'Bar B Q Wings', '6 Pieces', NULL, '399', '1', '399', '2024-08-27 05:24:42', '2024-08-27 05:24:42'),
(48, 43, 'OL-ORD-103', NULL, 'Cheese Stuffer', 'XLarge', NULL, '1299', '5', '11745', '2024-08-27 07:34:24', '2024-08-27 07:34:24'),
(49, 44, 'OL-ORD-104', NULL, 'Zinger Burger', 'Only Burger', NULL, '399', '1', '399', '2024-08-27 07:34:55', '2024-08-27 07:34:55'),
(50, 44, 'OL-ORD-104', NULL, 'Chicken tikka pizza', 'Small', NULL, '499', '1', '499', '2024-08-27 07:34:55', '2024-08-27 07:34:55'),
(51, 44, 'OL-ORD-104', NULL, 'Bone Fire', 'Small', NULL, '549', '2', '1000', '2024-08-27 07:34:55', '2024-08-27 07:34:55'),
(52, 45, 'OL-ORD-105', NULL, 'Sweet Chilli Wings', '6 Pieces', NULL, '399', '1', '399', '2024-08-27 10:35:03', '2024-08-27 10:35:03'),
(53, 46, 'OL-ORD-106', NULL, 'Grill Burger', 'Only Burger', NULL, '449', '1', '449', '2024-08-27 10:44:54', '2024-08-27 10:44:54'),
(54, 46, 'OL-ORD-106', NULL, 'Oven Baked Wings', '6 Pieces', NULL, '399', '1', '399', '2024-08-27 10:44:54', '2024-08-27 10:44:54'),
(55, 47, 'OL-ORD-107', NULL, 'Chicken Tandoori', 'Small', NULL, '499', '1', '499', '2024-08-27 10:50:21', '2024-08-27 10:50:21'),
(56, 48, 'OL-ORD-108', NULL, 'Bar B Q Wings', '6 Pieces', NULL, '399', '1', '399', '2024-08-27 10:55:28', '2024-08-27 10:55:28'),
(57, 49, 'OL-ORD-109', NULL, 'Zinger Burger', 'Only Burger', NULL, '399', '1', '399', '2024-08-27 11:15:50', '2024-08-27 11:15:50'),
(58, 50, 'OL-ORD-110', NULL, 'Chicken Supereme', 'Small', NULL, '499', '1', '499', '2024-08-27 11:21:51', '2024-08-27 11:21:51'),
(59, 51, 'OL-ORD-111', NULL, 'Oven Baked Wings', '6 Pieces', NULL, '399', '1', '399', '2024-08-27 12:01:37', '2024-08-27 12:01:37'),
(60, 52, 'OL-ORD-112', NULL, 'Chicken petty Burger', 'Only Burger', NULL, '349', '1', '349', '2024-08-27 12:02:11', '2024-08-27 12:02:11'),
(61, 53, 'OL-ORD-113', NULL, 'Square Pizza', 'Small', NULL, '649', '1', '649', '2024-08-27 12:02:44', '2024-08-27 12:02:44'),
(62, 54, 'OL-ORD-114', NULL, 'Bar B Q Wings', '6 Pieces', NULL, '399', '1', '399', '2024-08-27 12:03:11', '2024-08-27 12:03:11'),
(63, 55, 'OL-ORD-115', NULL, 'Bar B Q Wings', '6 Pieces', NULL, '399', '1', '399', '2024-08-27 12:11:01', '2024-08-27 12:11:01'),
(64, 56, 'OL-ORD-116', NULL, 'Bar B Q Wings', '6 Pieces', NULL, '399', '1', '399', '2024-08-27 12:41:57', '2024-08-27 12:41:57'),
(65, 56, 'OL-ORD-116', NULL, 'Sweet Chilli Wings', '6 Pieces', NULL, '399', '1', '399', '2024-08-27 12:41:57', '2024-08-27 12:41:57'),
(66, 57, 'OL-ORD-117', NULL, 'Oven Baked Wings', '6 Pieces', NULL, '399', '2', '798', '2024-08-27 12:49:38', '2024-08-27 12:49:38'),
(67, 57, 'OL-ORD-117', NULL, 'Square Pizza', 'Large', NULL, '649', '2', '3398', '2024-08-27 12:49:38', '2024-08-27 12:49:38'),
(68, 58, 'OL-ORD-118', NULL, 'Oven Baked Wings', '12 Pieces', '', '399', '3', '2247', '2024-08-28 06:31:43', '2024-08-28 06:31:43'),
(69, 58, 'OL-ORD-118', NULL, 'Square Pizza', 'Medium', 'Chicken Topping Medium', '649', '3', '4644', '2024-08-28 06:31:43', '2024-08-28 06:31:43'),
(70, 59, 'OL-ORD-119', NULL, 'Oven Baked Wings', '12 Pieces', '', '399', '3', '2247', '2024-08-28 06:32:44', '2024-08-28 06:32:44'),
(71, 59, 'OL-ORD-119', NULL, 'Square Pizza', 'Medium', 'Chicken Topping Medium', '649', '3', '4644', '2024-08-28 06:32:44', '2024-08-28 06:32:44'),
(72, 60, 'CH-001', 28, 'Large Crunchy', 'Large', '', 'Rs. 799', '1', 'Rs. 799', '2024-08-28 06:41:44', '2024-08-28 06:41:44'),
(73, 60, 'CH-001', 49, 'Large Malai Boti', 'Large', 'Chicken Topping ', 'Rs. 1998', '1', 'Rs. 1998', '2024-08-28 06:41:44', '2024-08-28 06:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `order_type` varchar(255) DEFAULT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `payment_method`, `order_type`, `discount_type`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Cash', NULL, NULL, 1, '2024-07-25 05:43:09', '2024-07-25 05:43:09'),
(2, 'Jazzcash', NULL, NULL, 1, '2024-07-25 05:43:15', '2024-07-25 05:43:26'),
(3, 'Sadapay', NULL, NULL, 1, '2024-07-25 05:43:33', '2024-07-25 05:43:33'),
(4, 'Easypaisa', NULL, NULL, 1, '2024-07-25 05:43:41', '2024-07-25 05:43:41'),
(5, NULL, NULL, 'Fixed', 1, '2024-07-25 05:44:09', '2024-07-25 19:38:56'),
(6, NULL, NULL, 'Percentage', 1, '2024-07-25 05:44:16', '2024-07-25 19:39:03'),
(7, NULL, 'Dine-In', NULL, 1, '2024-07-25 05:44:24', '2024-07-25 19:39:12'),
(8, NULL, 'Takeaway', NULL, 1, '2024-07-25 05:44:33', '2024-07-25 19:39:20'),
(9, 'NayaPAY', NULL, NULL, 1, '2024-07-30 23:38:44', '2024-07-30 23:38:44'),
(11, 'Cash', NULL, NULL, 4, '2024-08-08 05:20:35', '2024-08-08 05:20:35'),
(12, 'Jazzcash', NULL, NULL, 4, '2024-08-08 05:20:43', '2024-08-08 05:20:43'),
(13, NULL, NULL, 'Fixed', 4, '2024-08-08 05:35:02', '2024-08-08 05:35:02'),
(14, NULL, NULL, 'Percentage', 4, '2024-08-08 05:35:09', '2024-08-08 05:35:09'),
(15, NULL, 'dine-in', NULL, 4, '2024-08-08 05:41:33', '2024-08-08 05:41:33'),
(16, NULL, 'takeaway', NULL, 4, '2024-08-08 05:41:47', '2024-08-08 05:41:47'),
(17, 'CASH', NULL, NULL, 4, '2024-08-08 06:56:03', '2024-08-08 06:56:03'),
(18, 'sadapay', NULL, NULL, 4, '2024-08-08 06:56:25', '2024-08-08 06:56:25'),
(19, 'easypaisa', NULL, NULL, 4, '2024-08-08 06:56:31', '2024-08-08 06:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productVariation` varchar(255) DEFAULT NULL,
  `productPrice` varchar(255) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productImage`, `productName`, `productVariation`, `productPrice`, `category_name`, `category_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, '17229412274.jpg', 'Oven Baked Wings', '6 Pieces', '399', 'Appetizer', 1, 1, '2024-07-18 16:38:59', '2024-08-06 05:47:07'),
(2, '17229412274.jpg', 'Oven Baked Wings', '12 Pieces', '749', 'Appetizer', 1, 1, '2024-07-18 16:38:59', '2024-08-06 05:47:07'),
(3, '17229412393.jpg', 'Bar B Q Wings', '6 Pieces', '399', 'Appetizer', 1, 1, '2024-07-18 16:39:33', '2024-08-06 05:47:19'),
(4, '17229412393.jpg', 'Bar B Q Wings', '12 Pieces', '749', 'Appetizer', 1, 1, '2024-07-18 16:39:33', '2024-08-06 05:47:19'),
(5, '17228595329.jpeg', 'Zinger Burger', 'Only Burger', '399', 'Burger', 2, 1, '2024-07-18 16:40:13', '2024-08-05 07:05:32'),
(6, '17228595625.jpg', 'Grill Burger', 'Only Burger', '449', 'Burger', 2, 1, '2024-07-18 16:40:40', '2024-08-05 07:06:02'),
(7, '17228600357.jpg', 'Crown Crust', 'Medium', '1299', 'Pizza', 3, 1, '2024-07-18 16:42:26', '2024-08-05 07:13:55'),
(8, '17228600357.jpg', 'Crown Crust', 'Large', '1749', 'Pizza', 3, 1, '2024-07-18 16:42:26', '2024-08-05 07:13:55'),
(9, '17228600357.jpg', 'Crown Crust', 'XLarge', '2299', 'Pizza', 3, 1, '2024-07-18 16:42:26', '2024-08-05 07:13:55'),
(13, '17228600522.jpg', 'Square Pizza', 'Small', '649', 'Pizza', 3, 1, '2024-07-18 16:44:00', '2024-08-05 07:14:12'),
(14, '17228600522.jpg', 'Square Pizza', 'Medium', '1299', 'Pizza', 3, 1, '2024-07-18 16:44:00', '2024-08-05 07:14:12'),
(15, '17228600522.jpg', 'Square Pizza', 'Large', '1699', 'Pizza', 3, 1, '2024-07-18 16:44:00', '2024-08-05 07:14:12'),
(17, '172285988510.jpeg', 'Plain Fries', 'Large', '349', 'Fries', 4, 1, '2024-07-18 16:44:52', '2024-08-05 07:11:25'),
(18, '172285988510.jpeg', 'Plain Fries', 'Regular', '249', 'Fries', 4, 1, '2024-07-18 16:44:52', '2024-08-05 07:11:25'),
(24, '17228593905.jpg', 'Peri Peri Wings', '6 Pieces', '399', 'Appetizer', 1, 1, '2024-07-21 09:35:19', '2024-08-05 07:03:10'),
(25, '17228593905.jpg', 'Peri Peri Wings', '12 Pieces', '749', 'Appetizer', 1, 1, '2024-07-21 09:35:19', '2024-08-05 07:03:10'),
(26, '17228594065.jpeg', 'Sweet Chilli Wings', '6 Pieces', '399', 'Appetizer', 1, 1, '2024-07-21 09:46:00', '2024-08-05 07:03:26'),
(27, '17228594065.jpeg', 'Sweet Chilli Wings', '12 Pieces', '749', 'Appetizer', 1, 1, '2024-07-21 09:46:00', '2024-08-05 07:03:26'),
(28, '172285945510.jpeg', 'Crunchy', 'Large', '799', 'Baked Pasta', 6, 1, '2024-07-21 09:49:06', '2024-08-05 07:04:15'),
(29, '17228594769.jpeg', 'Fettucine', 'Small', '499', 'Baked Pasta', 6, 1, '2024-07-21 09:50:19', '2024-08-05 07:04:36'),
(30, '17228594769.jpeg', 'Fettucine', 'Large', '799', 'Baked Pasta', 6, 1, '2024-07-21 09:50:19', '2024-08-05 07:04:36'),
(31, '17228594937.jpeg', 'Mughlai', 'Small', '499', 'Baked Pasta', 6, 1, '2024-07-21 09:51:53', '2024-08-05 07:04:53'),
(32, '17228594937.jpeg', 'Mughlai', 'Large', '799', 'Baked Pasta', 6, 1, '2024-07-21 09:51:53', '2024-08-05 07:04:53'),
(33, '17228595057.jpeg', 'Chef Special Pasta', 'Small', '499', 'Baked Pasta', 6, 1, '2024-07-21 09:53:37', '2024-08-05 07:05:05'),
(34, '17228595057.jpeg', 'Chef Special Pasta', 'Large', '799', 'Baked Pasta', 6, 1, '2024-07-21 09:53:37', '2024-08-05 07:05:05'),
(35, '172286059010.jpg', 'Chicken Grill Sandwich', 'Regular', '699', 'Sandwich', 7, 1, '2024-07-21 10:01:05', '2024-08-05 07:23:10'),
(36, '17228606245.jpg', 'Mexico Sandwich', 'Regular', '699', 'Sandwich', 7, 1, '2024-07-21 10:02:29', '2024-08-05 07:23:44'),
(37, '17228606416.jpg', 'Mughlai Sandwich', 'Regular', '699', 'Sandwich', 7, 1, '2024-07-21 10:04:51', '2024-08-05 07:24:01'),
(38, '17228606574.jpg', 'Pizza Sandwich', 'Regular', '699', 'Sandwich', 7, 1, '2024-07-21 10:05:43', '2024-08-05 07:24:17'),
(39, '17228595735.jpeg', 'Chicken petty Burger', 'Only Burger', '349', 'Burger', 2, 1, '2024-07-21 10:07:10', '2024-08-05 07:06:13'),
(40, '17228596093.jpeg', 'Double Decker Burger', 'Only Burger', '699', 'Burger', 2, 1, '2024-07-21 10:07:37', '2024-08-05 07:06:49'),
(41, '17228596347.jpg', 'Smash Beef Burger', 'Only Burger', '649', 'Burger', 2, 1, '2024-07-21 10:08:55', '2024-08-05 07:07:14'),
(42, '17228606854.jpeg', 'Bihari Roll', 'Regular', '699', 'Spin Roll', 8, 1, '2024-07-21 10:12:38', '2024-08-05 07:24:45'),
(43, '17228607079.jpeg', 'Kabab Roll', 'Regular', '399', 'Spin Roll', 8, 1, '2024-07-21 10:15:29', '2024-08-05 07:25:07'),
(44, '17228607344.png', 'Mughali Roll', 'Regular', '699', 'Spin Roll', 8, 1, '2024-07-21 10:15:57', '2024-08-05 07:25:34'),
(45, '17228607588.jpg', 'Peri Peri Roll', 'Regular', '699', 'Spin Roll', 8, 1, '2024-07-21 10:16:25', '2024-08-05 07:25:58'),
(46, '17228607767.jpeg', 'Zinger Roll', 'Regular', '399', 'Spin Roll', 8, 1, '2024-07-21 10:16:53', '2024-08-05 07:26:16'),
(47, '17228607867.jpeg', 'Crust House Special', 'Regular', '699', 'Spin Roll', 8, 1, '2024-07-21 10:17:35', '2024-08-05 07:26:26'),
(48, '17228600746.jpeg', 'Malai Boti', 'Medium', '1199', 'Pizza', 3, 1, '2024-07-21 10:20:17', '2024-08-05 07:14:34'),
(49, '17228600746.jpeg', 'Malai Boti', 'Large', '1749', 'Pizza', 3, 1, '2024-07-21 10:20:17', '2024-08-05 07:14:34'),
(50, '17228600746.jpeg', 'Malai Boti', 'XLarge', '2299', 'Pizza', 3, 1, '2024-07-21 10:20:17', '2024-08-05 07:14:34'),
(51, '17228601031.jpeg', 'Cheese Stuffer', 'Medium', '1299', 'Pizza', 3, 1, '2024-07-21 10:21:18', '2024-08-05 07:15:03'),
(52, '17228601031.jpeg', 'Cheese Stuffer', 'Large', '1849', 'Pizza', 3, 1, '2024-07-21 10:21:18', '2024-08-05 07:15:03'),
(53, '17228601031.jpeg', 'Cheese Stuffer', 'XLarge', '2349', 'Pizza', 3, 1, '2024-07-21 10:21:18', '2024-08-05 07:15:03'),
(54, '172286014210.jpg', 'Kabab Stuffer', 'Medium', '1299', 'Pizza', 3, 1, '2024-07-21 10:22:18', '2024-08-05 07:15:42'),
(55, '172286014210.jpg', 'Kabab Stuffer', 'Large', '1849', 'Pizza', 3, 1, '2024-07-21 10:22:18', '2024-08-05 07:15:42'),
(56, '172286014210.jpg', 'Kabab Stuffer', 'XLarge', '2349', 'Pizza', 3, 1, '2024-07-21 10:22:18', '2024-08-05 07:15:42'),
(57, '17228601747.jpeg', 'Chicken tikka pizza', 'Small', '499', 'Pizza', 3, 1, '2024-07-21 10:24:12', '2024-08-05 07:16:14'),
(58, '17228601747.jpeg', 'Chicken tikka pizza', 'Medium', '1099', 'Pizza', 3, 1, '2024-07-21 10:24:12', '2024-08-05 07:16:14'),
(59, '17228601747.jpeg', 'Chicken tikka pizza', 'Large', '1649', 'Pizza', 3, 1, '2024-07-21 10:24:12', '2024-08-05 07:16:14'),
(60, '17228601747.jpeg', 'Chicken tikka pizza', 'X-Large', '2049', 'Pizza', 3, 1, '2024-07-21 10:24:12', '2024-08-05 07:16:14'),
(61, '17228601968.jpg', 'Chicken Fajitta', 'Small', '499', 'Pizza', 3, 1, '2024-07-21 10:24:59', '2024-08-05 07:16:36'),
(62, '17228601968.jpg', 'Chicken Fajitta', 'Medium', '1099', 'Pizza', 3, 1, '2024-07-21 10:24:59', '2024-08-05 07:16:36'),
(63, '17228601968.jpg', 'Chicken Fajitta', 'Large', '1649', 'Pizza', 3, 1, '2024-07-21 10:24:59', '2024-08-05 07:16:36'),
(64, '17228601968.jpg', 'Chicken Fajitta', 'X-Large', '2049', 'Pizza', 3, 1, '2024-07-21 10:24:59', '2024-08-05 07:16:36'),
(65, '17228602274.jpeg', 'Chicken Supereme', 'Small', '499', 'Pizza', 3, 1, '2024-07-21 10:28:45', '2024-08-05 07:17:07'),
(66, '17228602274.jpeg', 'Chicken Supereme', 'Medium', '1099', 'Pizza', 3, 1, '2024-07-21 10:28:45', '2024-08-05 07:17:07'),
(67, '17228602274.jpeg', 'Chicken Supereme', 'Large', '1649', 'Pizza', 3, 1, '2024-07-21 10:28:45', '2024-08-05 07:17:07'),
(68, '17228602274.jpeg', 'Chicken Supereme', 'X-Large', '2049', 'Pizza', 3, 1, '2024-07-21 10:28:45', '2024-08-05 07:17:07'),
(69, '17228602509.jpeg', 'Chicken Tandoori', 'Small', '499', 'Pizza', 3, 1, '2024-07-21 10:29:49', '2024-08-05 07:17:30'),
(70, '17228602509.jpeg', 'Chicken Tandoori', 'Medium', '1099', 'Pizza', 3, 1, '2024-07-21 10:29:49', '2024-08-05 07:17:30'),
(71, '17228602509.jpeg', 'Chicken Tandoori', 'Large', '1649', 'Pizza', 3, 1, '2024-07-21 10:29:49', '2024-08-05 07:17:30'),
(72, '17228602509.jpeg', 'Chicken Tandoori', 'X-Large', '2049', 'Pizza', 3, 1, '2024-07-21 10:29:49', '2024-08-05 07:17:30'),
(73, '17228602734.jpeg', 'Cheese Lover', 'Small', '499', 'Pizza', 3, 1, '2024-07-21 10:30:48', '2024-08-05 07:17:53'),
(74, '17228602734.jpeg', 'Cheese Lover', 'Medium', '1099', 'Pizza', 3, 1, '2024-07-21 10:30:48', '2024-08-05 07:17:53'),
(75, '17228602734.jpeg', 'Cheese Lover', 'Large', '1649', 'Pizza', 3, 1, '2024-07-21 10:30:48', '2024-08-05 07:17:53'),
(76, '17228602734.jpeg', 'Cheese Lover', 'X-Large', '2049', 'Pizza', 3, 1, '2024-07-21 10:30:48', '2024-08-05 07:17:53'),
(77, '17228602976.jpeg', 'Euro', 'Small', '499', 'Pizza', 3, 1, '2024-07-21 10:31:59', '2024-08-05 07:18:17'),
(78, '17228602976.jpeg', 'Euro', 'Medium', '1099', 'Pizza', 3, 1, '2024-07-21 10:31:59', '2024-08-05 07:18:17'),
(79, '17228602976.jpeg', 'Euro', 'Large', '1649', 'Pizza', 3, 1, '2024-07-21 10:31:59', '2024-08-05 07:18:17'),
(80, '17228602976.jpeg', 'Euro', 'X-Large', '2049', 'Pizza', 3, 1, '2024-07-21 10:31:59', '2024-08-05 07:18:17'),
(81, '17228603478.jpeg', 'Hot N Spicy', 'Small', '499', 'Pizza', 3, 1, '2024-07-21 10:32:35', '2024-08-05 07:19:07'),
(82, '17228603478.jpeg', 'Hot N Spicy', 'Medium', '1099', 'Pizza', 3, 1, '2024-07-21 10:32:35', '2024-08-05 07:19:07'),
(83, '17228603478.jpeg', 'Hot N Spicy', 'Large', '1649', 'Pizza', 3, 1, '2024-07-21 10:32:35', '2024-08-05 07:19:07'),
(84, '17228603478.jpeg', 'Hot N Spicy', 'X-Large', '2049', 'Pizza', 3, 1, '2024-07-21 10:32:35', '2024-08-05 07:19:07'),
(85, '17228603621.jpeg', 'Veggle Lover', 'Small', '499', 'Pizza', 3, 1, '2024-07-21 10:33:17', '2024-08-05 07:19:22'),
(86, '17228603621.jpeg', 'Veggle Lover', 'Medium', '1099', 'Pizza', 3, 1, '2024-07-21 10:33:17', '2024-08-05 07:19:22'),
(87, '17228603621.jpeg', 'Veggle Lover', 'Large', '1649', 'Pizza', 3, 1, '2024-07-21 10:33:17', '2024-08-05 07:19:22'),
(88, '17228603621.jpeg', 'Veggle Lover', 'X-Large', '2049', 'Pizza', 3, 1, '2024-07-21 10:33:18', '2024-08-05 07:19:22'),
(89, '172286037910.jpeg', 'Bone Fire', 'Small', '549', 'Pizza', 3, 1, '2024-07-21 10:38:00', '2024-08-05 07:19:39'),
(90, '172286037910.jpeg', 'Bone Fire', 'Medium', '1199', 'Pizza', 3, 1, '2024-07-21 10:38:00', '2024-08-05 07:19:39'),
(91, '172286037910.jpeg', 'Bone Fire', 'Large', '1749', 'Pizza', 3, 1, '2024-07-21 10:38:00', '2024-08-05 07:19:39'),
(92, '172286037910.jpeg', 'Bone Fire', 'X-Large', '2199', 'Pizza', 3, 1, '2024-07-21 10:38:00', '2024-08-05 07:19:39'),
(93, '17228604376.jpeg', 'Deluxe', 'Medium', '1199', 'Pizza', 3, 1, '2024-07-21 10:38:46', '2024-08-05 07:20:37'),
(94, '17228604376.jpeg', 'Deluxe', 'Large', '1749', 'Pizza', 3, 1, '2024-07-21 10:38:46', '2024-08-05 07:20:37'),
(95, '17228604376.jpeg', 'Deluxe', 'XLarge', '2199', 'Pizza', 3, 1, '2024-07-21 10:38:46', '2024-08-05 07:20:37'),
(96, '17228604634.jpeg', 'Half & Half', 'Medium', '1199', 'Pizza', 3, 1, '2024-07-21 10:40:06', '2024-08-05 07:21:03'),
(97, '17228604634.jpeg', 'Half & Half', 'Large', '1749', 'Pizza', 3, 1, '2024-07-21 10:40:06', '2024-08-05 07:21:03'),
(98, '17228604634.jpeg', 'Half & Half', 'XLarge', '2199', 'Pizza', 3, 1, '2024-07-21 10:40:06', '2024-08-05 07:21:03'),
(99, '17228604793.jpg', 'Mughali Pizza', 'Small', '549', 'Pizza', 3, 1, '2024-07-21 10:40:56', '2024-08-05 07:21:19'),
(100, '17228604793.jpg', 'Mughali Pizza', 'Medium', '1199', 'Pizza', 3, 1, '2024-07-21 10:40:56', '2024-08-05 07:21:19'),
(101, '17228604793.jpg', 'Mughali Pizza', 'Large', '1749', 'Pizza', 3, 1, '2024-07-21 10:40:56', '2024-08-05 07:21:19'),
(102, '17228604793.jpg', 'Mughali Pizza', 'X-Large', '2199', 'Pizza', 3, 1, '2024-07-21 10:40:56', '2024-08-05 07:21:19'),
(103, '17228604972.jpeg', 'Pepperoni Pizza', 'Small', '549', 'Pizza', 3, 1, '2024-07-21 10:41:41', '2024-08-05 07:21:37'),
(104, '17228604972.jpeg', 'Pepperoni Pizza', 'Medium', '1199', 'Pizza', 3, 1, '2024-07-21 10:41:41', '2024-08-05 07:21:37'),
(105, '17228604972.jpeg', 'Pepperoni Pizza', 'Large', '1749', 'Pizza', 3, 1, '2024-07-21 10:41:41', '2024-08-05 07:21:37'),
(106, '17228604972.jpeg', 'Pepperoni Pizza', 'X-Large', '2199', 'Pizza', 3, 1, '2024-07-21 10:41:41', '2024-08-05 07:21:37'),
(107, '17228605184.jpeg', 'Seekh Kabab', 'Small', '549', 'Pizza', 3, 1, '2024-07-21 10:42:23', '2024-08-05 07:21:58'),
(108, '17228605184.jpeg', 'Seekh Kabab', 'Medium', '1199', 'Pizza', 3, 1, '2024-07-21 10:42:23', '2024-08-05 07:21:58'),
(109, '17228605184.jpeg', 'Seekh Kabab', 'Large', '1749', 'Pizza', 3, 1, '2024-07-21 10:42:23', '2024-08-05 07:21:58'),
(110, '17228605184.jpeg', 'Seekh Kabab', 'X-Large', '2199', 'Pizza', 3, 1, '2024-07-21 10:42:23', '2024-08-05 07:21:58'),
(111, '17228605326.jpeg', 'Special Crust House', 'Small', '549', 'Pizza', 3, 1, '2024-07-21 10:44:05', '2024-08-05 07:22:12'),
(112, '17228605326.jpeg', 'Special Crust House', 'Medium', '1199', 'Pizza', 3, 1, '2024-07-21 10:44:05', '2024-08-05 07:22:12'),
(113, '17228605326.jpeg', 'Special Crust House', 'Large', '1749', 'Pizza', 3, 1, '2024-07-21 10:44:05', '2024-08-05 07:22:12'),
(114, '17228605326.jpeg', 'Special Crust House', 'X-Large', '2199', 'Pizza', 3, 1, '2024-07-21 10:44:05', '2024-08-05 07:22:12'),
(115, '17228593279.jpeg', 'Chicken Topping', 'Small', '149', 'Addons', 9, 1, '2024-07-21 10:47:22', '2024-08-05 07:02:07'),
(116, '17228593279.jpeg', 'Chicken Topping', 'Medium', '249', 'Addons', 9, 1, '2024-07-21 10:47:22', '2024-08-05 07:02:07'),
(117, '17228593279.jpeg', 'Chicken Topping', 'Large', '299', 'Addons', 9, 1, '2024-07-21 10:47:22', '2024-08-05 07:02:07'),
(118, '17228593279.jpeg', 'Chicken Topping', 'X-Large', '399', 'Addons', 9, 1, '2024-07-21 10:47:22', '2024-08-05 07:02:07'),
(119, '17228593372.jpeg', 'Cheese Topping', 'Small', '149', 'Addons', 9, 1, '2024-07-21 10:48:27', '2024-08-05 07:02:17'),
(120, '17228593372.jpeg', 'Cheese Topping', 'Medium', '249', 'Addons', 9, 1, '2024-07-21 10:48:27', '2024-08-05 07:02:17'),
(121, '17228593372.jpeg', 'Cheese Topping', 'Large', '299', 'Addons', 9, 1, '2024-07-21 10:48:27', '2024-08-05 07:02:17'),
(122, '17228593372.jpeg', 'Cheese Topping', 'X-Large', '399', 'Addons', 9, 1, '2024-07-21 10:48:27', '2024-08-05 07:02:17'),
(123, '17228605548.jpeg', 'Special Platter', 'Regular', '1149', 'Platter', 10, 1, '2024-07-21 10:55:07', '2024-08-05 07:22:34'),
(124, '17228600013.jpg', 'CalZone', 'Small', '699', 'Others', 11, 1, '2024-07-21 10:56:47', '2024-08-05 07:13:21'),
(125, '17228600013.jpg', 'CalZone', 'Medium', '1299', 'Others', 11, 1, '2024-07-21 10:56:47', '2024-08-05 07:13:21'),
(126, '17228600013.jpg', 'CalZone', 'Large', '1799', 'Others', 11, 1, '2024-07-21 10:56:47', '2024-08-05 07:13:21'),
(127, '172285993610.webp', 'Special Fries', 'Large', '499', 'Fries', 4, 1, '2024-07-21 10:59:03', '2024-08-05 07:12:16'),
(128, '17228599658.jpeg', 'Pizza Fries', 'Large', '599', 'Fries', 4, 1, '2024-07-21 10:59:52', '2024-08-05 07:12:45'),
(129, '17228599833.jpeg', 'Pepperoni Fries', 'Large', '599', 'Fries', 4, 1, '2024-07-21 11:00:27', '2024-08-05 07:13:03'),
(130, '172285965310.jpeg', 'Fried Wings', '5 Pieces', '349', 'Chicken Pieces', 12, 1, '2024-07-21 11:15:47', '2024-08-05 07:07:33'),
(131, '172285965310.jpeg', 'Fried Wings', '10 Pieces', '599', 'Chicken Pieces', 12, 1, '2024-07-21 11:15:47', '2024-08-05 07:07:33'),
(132, '172285966710.jpg', 'Nuggets', '5 Pieces', '349', 'Chicken Pieces', 12, 1, '2024-07-21 11:16:33', '2024-08-05 07:07:47'),
(133, '172285966710.jpg', 'Nuggets', '10 Pieces', '599', 'Chicken Pieces', 12, 1, '2024-07-21 11:16:33', '2024-08-05 07:07:47'),
(134, '172285972310.jpg', 'Full Bucked Chicken pcs', '10 Pieces', '2199', 'Chicken Pieces', 12, 1, '2024-07-21 11:17:35', '2024-08-05 07:08:43'),
(135, '17228597452.jpeg', 'Fried chicken Pieces', '1 Piece', '249', 'Chicken Pieces', 12, 1, '2024-07-21 11:18:46', '2024-08-05 07:09:05'),
(136, '17228597595.jpeg', 'Hot Shot 20 Pieces', '10 Pieces', '699', 'Chicken Pieces', 12, 1, '2024-07-21 11:20:31', '2024-08-05 07:09:19'),
(137, '17228597746.jpg', 'Dip souce', '1 Piece', '79', 'Chicken Pieces', 12, 1, '2024-07-21 11:21:06', '2024-08-05 07:09:34'),
(138, '17228600176.jpg', 'Mineral Water', '500 ML', '70', 'Others', 11, 1, '2024-07-21 11:22:22', '2024-08-05 07:13:37'),
(139, '17228600176.jpg', 'Mineral Water', '1.5 Liter', '120', 'Others', 11, 1, '2024-07-21 11:22:22', '2024-08-05 07:13:37'),
(146, '17228597879.jpg', 'Sprite', '350 ML', '90', 'Drinks', 13, 1, '2024-07-30 19:36:41', '2024-08-05 07:09:47'),
(147, '17228597879.jpg', 'Sprite', '500 ML', '120', 'Drinks', 13, 1, '2024-07-30 19:36:41', '2024-08-05 07:09:47'),
(148, '17228597879.jpg', 'Sprite', '1 Liter', '190', 'Drinks', 13, 1, '2024-07-30 19:36:41', '2024-08-05 07:09:47'),
(149, '17228597879.jpg', 'Sprite', '1.5 Liter', '250', 'Drinks', 13, 1, '2024-07-30 19:36:41', '2024-08-05 07:09:47'),
(150, '17228598027.jpg', 'Coca Cola', '350 ML', '90', 'Drinks', 13, 1, '2024-07-30 19:38:00', '2024-08-05 07:10:02'),
(151, '17228598027.jpg', 'Coca Cola', '500 ML', '120', 'Drinks', 13, 1, '2024-07-30 19:38:00', '2024-08-05 07:10:02'),
(152, '17228598027.jpg', 'Coca Cola', '1 Liter', '190', 'Drinks', 13, 1, '2024-07-30 19:38:00', '2024-08-05 07:10:02'),
(153, '17228598027.jpg', 'Coca Cola', '1.5 Liter', '250', 'Drinks', 13, 1, '2024-07-30 19:38:00', '2024-08-05 07:10:02'),
(154, '17228598164.jpeg', 'Pepsi', '350 ML', '90', 'Drinks', 13, 1, '2024-07-30 19:38:59', '2024-08-05 07:10:16'),
(155, '17228598164.jpeg', 'Pepsi', '500 ML', '120', 'Drinks', 13, 1, '2024-07-30 19:38:59', '2024-08-05 07:10:16'),
(156, '17228598164.jpeg', 'Pepsi', '1 Liter', '190', 'Drinks', 13, 1, '2024-07-30 19:38:59', '2024-08-05 07:10:16'),
(157, '17228598164.jpeg', 'Pepsi', '1.5 Liter', '250', 'Drinks', 13, 1, '2024-07-30 19:38:59', '2024-08-05 07:10:16'),
(158, '17228598346.jpeg', '7up', '350 ML', '90', 'Drinks', 13, 1, '2024-07-30 19:39:40', '2024-08-05 07:10:34'),
(159, '17228598346.jpeg', '7up', '500 ML', '120', 'Drinks', 13, 1, '2024-07-30 19:39:40', '2024-08-05 07:10:34'),
(160, '17228598346.jpeg', '7up', '1 Liter', '190', 'Drinks', 13, 1, '2024-07-30 19:39:40', '2024-08-05 07:10:34'),
(161, '17228598346.jpeg', '7up', '1.5 Liter', '250', 'Drinks', 13, 1, '2024-07-30 19:39:40', '2024-08-05 07:10:34'),
(162, '17228598587.jpeg', 'Dew', '350 ML', '90', 'Drinks', 13, 1, '2024-07-30 19:41:08', '2024-08-05 07:10:58'),
(163, '17228598587.jpeg', 'Dew', '500 ML', '120', 'Drinks', 13, 1, '2024-07-30 19:41:08', '2024-08-05 07:10:58'),
(164, '17228598587.jpeg', 'Dew', '1 Liter', '190', 'Drinks', 13, 1, '2024-07-30 19:41:08', '2024-08-05 07:10:58'),
(165, '17228598587.jpeg', 'Dew', '1.5 Liter', '250', 'Drinks', 13, 1, '2024-07-30 19:41:08', '2024-08-05 07:10:58'),
(166, '1723108425_0_4080.png', 'Chocolate Cake', '1 Pound', '800', 'Cake', 14, 4, '2024-08-08 04:13:45', '2024-08-08 04:13:45'),
(167, '1723108425_1_7336.png', 'Chocolate Cake', '2 Pound', '1500', 'Cake', 14, 4, '2024-08-08 04:13:45', '2024-08-08 04:13:45'),
(168, '1723108473_0_9988.png', 'Vanilla Ice Cream', 'Small', '80', 'Pastry', 15, 4, '2024-08-08 04:14:33', '2024-08-08 04:14:33'),
(169, '1723108473_1_2709.png', 'Vanilla Ice Cream', 'Large', '150', 'Pastry', 15, 4, '2024-08-08 04:14:33', '2024-08-08 04:14:33'),
(170, '1723108545_0_7936.png', 'Vanilla', '1 Scoop', '120', 'Ice Cream', 26, 4, '2024-08-08 04:15:45', '2024-08-08 04:15:45'),
(171, '1723108545_1_9667.png', 'Vanilla', '2 Scoop', '180', 'Ice Cream', 26, 4, '2024-08-08 04:15:45', '2024-08-08 04:15:45'),
(172, '1723108545_2_3624.png', 'Vanilla', '3 Scoop', '240', 'Ice Cream', 26, 4, '2024-08-08 04:15:45', '2024-08-08 04:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `category_id`, `product_id`, `stock_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 3, 7, 1, '2 kg', '2024-08-05 07:37:31', '2024-08-05 07:37:31'),
(2, 14, 166, 2, '0.4 kg', '2024-08-08 04:21:53', '2024-08-08 04:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GEvAAVYxPEJkkx7viQ9npWADf04AUCaqae5teU4Z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUEtzZWI0dkpxdGQ5aUhtT3RYZEpzWkY1N1N3akVPa3R1d1lCQ1BzeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9nZXROb3RpZmljYXRpb25EYXRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo4OiJ1c2VybmFtZSI7czoxMDoiSGFzc2FuIEFsaSI7czoxMToicHJvZmlsZV9waWMiO3M6MTU6IjE3MjM3MDQxNzIuanBlZyI7czo4OiJzYWxlc21hbiI7YjoxO30=', 1724827506),
('Lupc5mb5vgudsQRJNUsnJ8j87XD3tSKzZuyAjwuK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmdzSzV4MVlOcGd5SnRSRmFKNkNGSmluTzRsZXd3SVpCRTR5ZXJHdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlcmVkQ3VzdG9tZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1724827446);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `itemQuantity` varchar(255) NOT NULL,
  `mimimumItemQuantity` varchar(255) NOT NULL,
  `unitPrice` varchar(255) NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `itemName`, `itemQuantity`, `mimimumItemQuantity`, `unitPrice`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'All-purpose flour', '4 kg', '1.00 kg', '100.00 Pkr', 1, '2024-08-05 07:37:13', '2024-08-16 11:35:52'),
(2, 'Flour123', '96.9 kg', '20kg', '100 Pkr', 4, '2024-08-08 04:19:23', '2024-08-08 07:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `stock_histories`
--

CREATE TABLE `stock_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `itemQuantity` varchar(255) NOT NULL,
  `mimimumItemQuantity` varchar(255) NOT NULL,
  `unitPrice` varchar(255) NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_histories`
--

INSERT INTO `stock_histories` (`id`, `itemName`, `itemQuantity`, `mimimumItemQuantity`, `unitPrice`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'All-purpose flour', '10.00 kg', '1.00 kg', '100.00 Pkr', 1, '2024-08-05 07:37:13', '2024-08-05 07:37:13'),
(2, 'Flour123', '100.50 kg', '20.00 kg', '100.00 Pkr', 4, '2024-08-08 04:19:23', '2024-08-08 04:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax_value` decimal(8,2) NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `tax_name`, `tax_value`, `branch_id`, `created_at`, `updated_at`) VALUES
(2, 'GST', 2.50, 1, '2024-08-06 00:47:47', '2024-08-06 00:47:47'),
(3, 'GST', 2.50, 4, '2024-08-08 05:36:33', '2024-08-08 05:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pos_logo` varchar(255) NOT NULL,
  `pos_primary_color` varchar(255) NOT NULL,
  `pos_secondary_color` varchar(255) NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `pos_logo`, `pos_primary_color`, `pos_secondary_color`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, '1723712704.jpg', '#ff4000', '#ffffff', 1, '2024-08-05 06:46:34', '2024-08-15 09:05:04'),
(3, '1723113811.png', '#000000', '#000000', 4, '2024-08-08 05:43:31', '2024-08-08 05:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'branchManager',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_picture`, `name`, `email`, `phone_number`, `role`, `email_verified_at`, `password`, `branch_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1724058149.jpeg', 'Danish Ejaz', 'anonymouscode786@gmail.com', NULL, 'owner', NULL, '$2y$12$4nIqYCO79bibH8EMPweCdulDV4Dy1QHfmEEGeGRumVV8.dCzVjy/u', NULL, NULL, '2024-07-19 02:27:28', '2024-08-20 07:01:55'),
(2, '1723709148.png', 'Muhammad Ali', 'muhammadali@gmail.com', NULL, 'branchManager', NULL, '$2y$12$83CVUqmdHC1EPNm9F2IMse4.FXsC9jzrGwEecWXd1l76Brw3ehaXW', 1, NULL, '2024-08-05 05:40:45', '2024-08-16 10:11:18'),
(10, '1723704172.jpeg', 'Hassan Ali', 'hassanali@gmail.com', NULL, 'salesman', NULL, '$2y$12$VoLtSsjTczWhehpfPdMLwu8hr2HFuBHvHQ0JwnAUzgB.FdvzeM5e.', 1, NULL, '2024-08-06 01:50:06', '2024-08-19 10:50:46'),
(12, '1723704189.png', 'Salesman ISB', 'chefisb@gmail.com', NULL, 'chef', NULL, '$2y$12$aSdJMsQL4wUM0eJZAUbeBuny4UuTO1jmO3OKnr9AAThPfMU3WOPa6', 1, NULL, '2024-08-06 03:00:50', '2024-08-27 07:02:06'),
(13, NULL, 'Muneeb Malik', 'anonkhan2k14@gmail.com', NULL, NULL, NULL, '$2y$12$SeIPsqVDLod8gPpIAlLZbOiKN856zgneSUcpBl9YvU.9erSfIFTFe', NULL, NULL, '2024-08-07 01:31:56', '2024-08-07 01:31:56'),
(14, NULL, 'sikander kiani', 'sikanderkiani999@yahoo.com', NULL, NULL, NULL, '$2y$12$XxL5lEYkpITmZkoQas42pes.a.Hg35/ENV0KBrgECC8ZTBquPOKJK', NULL, NULL, '2024-08-07 09:03:40', '2024-08-07 09:03:40'),
(16, '1723713846.jpeg', 'Babu shona', 'www.6767hammad@gmail.com', NULL, 'branchManager', NULL, '$2y$12$rseW0OL2UpITzsspwFQ5geBq3IMPkDHk91z6SHVk97GNxpitSCSbK', 4, NULL, '2024-08-08 01:16:52', '2024-08-15 11:22:24'),
(25, '1723109351.png', 'hassan', 'hassan@gmail.com', NULL, 'salesman', NULL, '$2y$12$rT/FCZHOAr/fMp3uY3YgwuHRLXN4x21aU8quYPCsu1FrCgCgzvp1y', 4, NULL, '2024-08-08 04:29:11', '2024-08-08 04:29:11'),
(26, '1723109378.png', 'ahmed', 'ahmed@gmail.com', NULL, 'chef', NULL, '$2y$12$OZrJcHptLOXjkLgaXM49Gex5vDh4OWE4loD5pl9G1aUBqOnvgNeZy', 4, NULL, '2024-08-08 04:29:38', '2024-08-08 05:15:47'),
(28, '1723109772.png', 'ayesha', 'ayesha@gmail.com', NULL, 'salesman', NULL, '$2y$12$ZZ0p.jiCIG30hTMPqcrxwObVRtxWsRYtX4wQ44bppjpJF7LCwg/72', 4, NULL, '2024-08-08 04:36:13', '2024-08-08 04:36:13'),
(30, NULL, NULL, 'abc@gmail.com', NULL, 'branchManager', NULL, '$2y$12$ST/DJ0/G9bX34AI6ZQAOdehHLN1fgeJyKAiKQiHOtU02cvxo0OWQi', 6, NULL, '2024-08-21 12:49:19', '2024-08-21 12:49:19'),
(35, NULL, 'Muhammad Ali', 'aliahmadm753@gmail.com', '+923028933706', 'customer', '2024-08-23 10:21:41', '$2y$12$mGwqwqEp7TfGfsoF41UsX.IJPdtzlBNi9PDQIY.bxp9yYhabnzaiq', NULL, NULL, '2024-08-23 10:21:26', '2024-08-23 10:21:41'),
(36, NULL, 'Danish Ejaz', 'm512d786@gmail.com', '+923028933706', NULL, NULL, '$2y$12$9M6TTwpj2YaZxpRytXQ1sOZtNXXQJKrqrVyVN3qNelUYvABuQEASi', NULL, 'K27hoVVPbcssmGRwRKenNVKqk1UlLBZ8', '2024-08-23 10:33:25', '2024-08-23 10:33:25'),
(37, NULL, 'Danish Ejaz', 'kohexeh204@ndiety.com', '+923028933706', 'customer', '2024-08-26 07:35:11', '$2y$12$VEKhGO15SdgAYJRxZKd/VO6qavQcvgHQqewzSL67HcetzwFOw9o4i', NULL, NULL, '2024-08-26 07:34:11', '2024-08-26 07:35:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_branch_code_unique` (`branch_code`);

--
-- Indexes for table `branch_categories`
--
ALTER TABLE `branch_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_categories_category_id_foreign` (`category_id`),
  ADD KEY `branch_categories_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_salesman_id_foreign` (`salesman_id`),
  ADD KEY `carts_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deals_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `dine_in_tables`
--
ALTER TABLE `dine_in_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dine_in_tables_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `handlers`
--
ALTER TABLE `handlers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `handlers_deal_id_foreign` (`deal_id`),
  ADD KEY `handlers_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_notifications`
--
ALTER TABLE `online_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_branch_id_foreign` (`branch_id`),
  ADD KEY `orders_salesman_id_foreign` (`salesman_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_methods_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipes_category_id_foreign` (`category_id`),
  ADD KEY `recipes_product_id_foreign` (`product_id`),
  ADD KEY `recipes_stock_id_foreign` (`stock_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `stock_histories`
--
ALTER TABLE `stock_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_histories_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxes_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theme_settings_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_branch_id_foreign` (`branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `branch_categories`
--
ALTER TABLE `branch_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dine_in_tables`
--
ALTER TABLE `dine_in_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `handlers`
--
ALTER TABLE `handlers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_notifications`
--
ALTER TABLE `online_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_histories`
--
ALTER TABLE `stock_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch_categories`
--
ALTER TABLE `branch_categories`
  ADD CONSTRAINT `branch_categories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `branch_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_salesman_id_foreign` FOREIGN KEY (`salesman_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deals`
--
ALTER TABLE `deals`
  ADD CONSTRAINT `deals_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dine_in_tables`
--
ALTER TABLE `dine_in_tables`
  ADD CONSTRAINT `dine_in_tables_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `handlers`
--
ALTER TABLE `handlers`
  ADD CONSTRAINT `handlers_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `handlers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_salesman_id_foreign` FOREIGN KEY (`salesman_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recipes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recipes_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_histories`
--
ALTER TABLE `stock_histories`
  ADD CONSTRAINT `stock_histories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `taxes`
--
ALTER TABLE `taxes`
  ADD CONSTRAINT `taxes_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD CONSTRAINT `theme_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
